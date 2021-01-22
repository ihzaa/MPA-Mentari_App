<?php

namespace App\Http\Livewire\Admin\Items;

use App\Models\item;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $id_items;
    public $paginate = 10;
    public $search = '';

    public function mount($id_items)
    {
        $this->id_items = $id_items;
    }

    public function render()
    {
        $data = array();
        $data['items'] = item::latest()->where('category_id', $this->id_items)->paginate($this->paginate);
        return view('livewire.admin.items.index', compact("data"))->extends('BackEnd.templates.all');
    }
}
