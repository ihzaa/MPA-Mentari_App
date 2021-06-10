<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\item;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($id)
    {
        $data['product'] = item::find($id);
        return $data;
    }
}
