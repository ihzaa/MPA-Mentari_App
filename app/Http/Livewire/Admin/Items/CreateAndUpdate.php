<?php

namespace App\Http\Livewire\Admin\Items;

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.admin.items.create')->extends('BackEnd.templates.all');
    }
}
