<?php

namespace App\Http\Controllers\User\Keranjang;

use App\Http\Controllers\Controller;
use App\Models\address;
use App\Models\cart;
use App\Models\item;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $availableItem = item::where('stock', ">", "0")->pluck('stock', 'id')->toArray();
        cart::whereNotIn('item_id', array_keys($availableItem))->where('user_id', Auth::user()->id)->where('status', "0")->delete();
        $items = cart::where('user_id', Auth::user()->id)->where('status', "0")->get(['id', 'quantity', 'item_id'])->keyBy('id');
        foreach ($items as $id => $item) {
            if ($item->quantity > $availableItem[$item->item_id]) {
                cart::find($id)->update([
                    "quantity" => $availableItem[$item->item_id],
                ]);
            }
        }
        $data['items'] = DB::select('SELECT c.quantity as quantity, i.name, i.price, c.id as cart_id, i.promo, i.stock,(SELECT item_images.path FROM item_images WHERE item_images.item_id = i.id LIMIT 1) as img FROM `carts` as c JOIN items as i ON c.item_id = i.id WHERE c.status = "0" AND c.user_id = ' . Auth::user()->id);
        $data['addresses'] = address::where('user_id', Auth::user()->id)->get();

        // dd($data);
        return view('FrontEnd.pages.cart', compact('data'));
    }

    public function checkOut(Request $request)
    {
        if (count($request->item) == 0) {
            return back()->with('icon', 'error')->with('title', 'Kesalahan')->with('text', 'Item belum dipilih');
        }
        cart::whereIn('id', $request->item)->update([
            'status' => '1'
        ]);

        transaction::create([
            'cart_id' => json_encode($request->item),
            'user_id' => Auth::user()->id,
            'address_id' => $request->address
        ]);

        $cart = cart::whereIn('id', $request->item)->pluck('quantity', 'item_id');
        foreach ($cart as $k => $v) {
            item::find($k)->decrement('stock', $v);
        }

        return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Item berhasil dibeli');

    }

    public function decrease(Request $request)
    {
        $cart = cart::find($request->id);
        if ($cart->quantity == 1) {
            $cart->delete();
            return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus item');
        } else {
            $cart->quantity--;
            $cart->save();
            return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil mengurangi jumlah item');
        }
    }

    public function increase(Request $request)
    {
        $cart = cart::find($request->id);
        $item = item::find($cart->item_id);
        if (($cart->quantity + 1) <= $item->stock) {
            $cart->quantity++;
            $cart->save();
            return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menambah jumlah item');
        } else {
            return back()->with('icon', 'error')->with('title', 'Maaf')->with('text', 'Stock tidak mencukupi');
        }
    }

    public function changeQuantity(Request $request)
    {
        if ($request->quantity < 1) {
            return back()->with('icon', 'error')->with('title', 'Maaf!')->with('text', 'Perubahan jumlah item minimal 1');
        }
        $cart = cart::find($request->id);
        $item = item::find($cart->item_id);
        if ($item->stock >= $request->quantity) {
            $cart->quantity = $request->quantity;
            $cart->save();
            return back()->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menambah jumlah item');
        } else {
            return back()->with('icon', 'error')->with('title', 'Maaf')->with('text', 'Stock tidak mencukupi');
        }
    }

    public function delete(Request $request)
    {
        $cart = cart::find($request->id)->delete();
        session()->flash('icon', 'success');
        session()->flash('title', 'Berhasil');
        session()->flash('text', 'Berhasil menghapus item');
        return response(['status' => 'ok']);
    }
}
