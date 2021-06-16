<?php

namespace App\Http\Controllers\User\Keranjang;

use App\Http\Controllers\Controller;
use App\Models\address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $data['item'] = DB::select('SELECT c.quantity as quantity, i.name, i.price FROM `carts` as c JOIN items as i ON c.item_id = i.id WHERE c.status = "0" AND c.user_id = ' . Auth::user()->id);
        $data['alamat'] = address::where('user_id', Auth::user()->id)->get();
        return $data;
    }
}
