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
        cart::create([
            'quantity' => 1,
            'status' => '0',
            'item_id' => $request->item_id,
            'user_id' => Auth::user()->id,
        ]);

        return back();
    }
}
