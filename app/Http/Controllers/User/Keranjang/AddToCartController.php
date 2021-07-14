<?php

namespace App\Http\Controllers\User\Keranjang;

use App\Http\Controllers\Controller;
use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddToCartController extends Controller
{
    public function addOneItem(Request $request)
    {
        $itemInCart = cart::where('user_id', Auth::user()->id)->where('item_id', $request->item_id)->where('status', '0')->first();
        if (!$itemInCart)
            cart::create([
                'quantity' => 1,
                'status' => '0',
                'item_id' => $request->item_id,
                'user_id' => Auth::user()->id,
            ]);
        else {
            $itemInCart->quantity++;
            $itemInCart->save();
        }

        return back()->with('icon', 'success')->with('title', 'Berhasil!')->with('text', 'Item berhasil ditambahkan.');
    }
}
