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
        $data['items'] = DB::select('SELECT c.quantity as quantity, i.name, i.price, c.id as cart_id, i.promo, i.stock,(SELECT item_images.path FROM item_images WHERE item_images.item_id = i.id LIMIT 1) as img FROM `carts` as c JOIN items as i ON c.item_id = i.id WHERE c.status = "0" AND c.user_id = ' . Auth::user()->id);
        $data['addresses'] = address::where('user_id', Auth::user()->id)->get();
        // dd($data);
        return view('FrontEnd.pages.cart', compact('data'));
    }

    public function checkOut(Request $request)
    {
        if(count($request->item) == 0){
            return back()->with('icon','error')->with('title','Kesalahan')->with('text','Item belum dipilih');
        }
    }
}
