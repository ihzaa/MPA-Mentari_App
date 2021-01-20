<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;

class kategoriController extends Controller
{
    public function getKategori()
    {
        $data = array();
        $data['kategori'] = category::all();
        return view('BackEnd.pages.kategori',compact('data'));
    }
}
