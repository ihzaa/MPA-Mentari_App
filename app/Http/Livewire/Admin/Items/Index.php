<?php

namespace App\Http\Livewire\Admin\Items;

use App\Models\item;
use App\Models\item_image;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $id_items;
    public $paginate = 10;
    public $search = '';
    public $modalTitle = '';
    public $isDelete;
    public $delete_id;
    public $modalCondition;
    public $updated_id;

    public $name, $price, $description, $stock, $photo, $oldPhoto;

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

    public function updatedPhoto()
    {
        $this->reset(['oldPhoto']);
        $this->validate([
            'photo' => 'image|max:1024',
        ]);
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
        // dd($data[])
        // $this->search == "" ?
        //     $data['items'] = DB::select(DB::raw('select * from `items` where `category_id` = ' . $this->id_items . ' order by `created_at` desc limit ' . $this->paginate))
        //     : $data['items'] = DB::select(DB::raw('select * from `items` where `category_id` = ' . $this->id_items . ' and `name` like %' . $this->search . '% order by `created_at` desc limit ' . $this->paginate));
        // dd($data['items']);
        $data['id_items'] = $this->id_items;
        return view('livewire.admin.items.index', compact("data"))->extends('BackEnd.templates.all');
    }

    public function openModalTambah()
    {
        $this->modalCondition = "tambah";
        $this->resetItem();
        $this->modalTitle = 'Tambah Item';
        $this->emit('jsOpenModal');
    }

    public function resetItem()
    {
        $this->reset(['name', 'price', 'description', 'stock', 'photo', 'oldPhoto']);
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

        $item = item::create([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'stock' => $this->stock,
            'category_id' => $this->id_items,
        ]);

        if ($this->photo) {
            $photoName = $item->id . '-img.' . $this->photo->getClientOriginalExtension();
            $this->photo->storeAs('public/items/images', $photoName);

            // item_image::create([
            //     'item_id' => $item->id,
            //     'path' => 'items/images/' . $photoName
            // ]);
            $item->image = 'items/images/' . $photoName;
        }

        $item->save();

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

    public function openModalEdit($item)
    {
        $this->modalCondition = "edit";
        $this->updated_id = $item['id'];
        $this->resetItem();
        $this->name = $item['name'];
        $this->price = $item['price'];
        $this->description = $item['description'];
        $this->stock = $item['stock'];
        $this->oldPhoto = asset('storage/' . $item['image']);
        $this->emit('jsOpenModal');
    }

    public function updateItem()
    {
        $validatedData = $this->validate();
        item::find($this->updated_id)->update([
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'stock' => $this->stock,
            'category_id' => $this->id_items
        ]);
        $item = item::find($this->updated_id);
        if ($this->photo) {
            $photoName = $this->updated_id . '-img.' . $this->photo->getClientOriginalExtension();
            $this->photo->storeAs('public/items/images', $photoName);

            // item_image::where('item_id', $this->updated_id)->update([
            //     'path' => 'items/images/' . $photoName
            // ]);
            // item_image::create([
            //     'item_id' => $this->updated_id,
            //     'path' => 'items/images/' . $photoName
            // ]);
            $item->image = 'items/images/' . $photoName;
        }

        $item->save();

        // session()->flash('message', 'Berhasil menambahkan item');
        $this->showAlert('bg-success', 'Berhasil', 'Berhasil merubah item');
        $this->reset(['name', 'price', 'description', 'stock', 'photo', 'oldPhoto']);
        $this->emit('jsCloseModal');
    }
}
