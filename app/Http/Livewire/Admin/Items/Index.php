<?php

namespace App\Http\Livewire\Admin\Items;

use App\Models\item;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $data = array();
        $data['items'] = item::latest()->get();
        return view('livewire.admin.items.index', compact("data"))->extends('BackEnd.templates.all',['']);
    }
}
