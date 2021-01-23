<?php

namespace App\Http\Livewire\Admin\Items;

use App\Models\item;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $id_items;
    public $paginate = 10;
    public $search = '';
    public $modalTitle = '';
    public $isDelete;
    public $delete_id;

    public $name, $price, $description, $stock;

    protected $rules = [
        'name' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|numeric',
        'description' => 'required'
    ];

    protected $listeners = ['cancelDelete', 'delete'];

    public function mount($id_items)
    {
        $this->id_items = $id_items;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteConfirm($id)
    {
        $this->delete_id = $id;
        $this->isDelete = true;
    }

    public function cancelDelete()
    {
        $this->delete_id = "";
        $this->isDelete = "";
    }

    public function delete()
    {
        item::find($this->delete_id)->delete();
        $this->showAlert('bg-success', 'Berhasil', 'Berhasil menghapus item');
        // session()->flash('message', 'Berhasil menghapus item');
    }

    public function render()
    {
        $data = array();
        // $data['items'] = $this->search === '' ? item::latest()->where('category_id', $this->id_items)->paginate($this->paginate)
        //     : item::latest()->where('category_id', $this->id_items)->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate);
        $data['items'] = item::latest()->where('category_id', $this->id_items)->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate);
        $data['id_items'] = $this->id_items;
        return view('livewire.admin.items.index', compact("data"))->extends('BackEnd.templates.all');
    }

    public function openModalTambah()
    {
        $this->reset(['name', 'price', 'description', 'stock']);
        $this->modalTitle = 'Tambah Item';
        $this->emit('jsOpenModal');
    }

    public function storeItem()
    {
        // $data = [
        //     'name' => $this->name,
        //     'price' => $this->price,
        //     'description' => $this->description,
        //     'stock' => $this->stock,
        //     'category_id' => $this->id_items
        // ];

        $validatedData = $this->validate();

        item::create([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'stock' => $this->stock,
            'category_id' => $this->id_items
        ]);
        // session()->flash('message', 'Berhasil menambahkan item');
        $this->showAlert('bg-success', 'Berhasil', 'Berhasil menambahkan item');
        $this->emit('jsCloseModal');
    }

    public function showAlert($icon, $title, $body)
    {
        $this->emit('swal:alert', [
            'icon'    => $icon,
            'title'   => $title,
            'body' => $body
        ]);
    }
}
