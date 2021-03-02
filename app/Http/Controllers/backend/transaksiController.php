<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\transaction;
use Illuminate\Support\Facades\DB;

class transaksiController extends Controller
{
    public function gettransaksi()
    {
        $data = array();
        $data['transaksi'] = transaction::all();
        return view('BackEnd.pages.transaksi', compact('data'));
    }

    public function getUserTransaction()
    {
        $data = array();
        $data['userTransaction'] = DB::select('SELECT transactions.id, transactions.created_at, transactions.status, users.name FROM transactions JOIN users ON users.id = transactions.user_id ORDER BY transactions.status ASC');
        return view('BackEnd.pages.transaksi', compact('data'));
    }

    public function getDetailTransaction()
    {
        $data = array();
        $data['detailTransaction'] = DB::select('SELECT transactions.id, transactions.created_at, transactions.status, users.name FROM transactions JOIN users ON users.id = transactions.user_id ORDER BY transactions.status ASC');
        return view('BackEnd.pages.transaksi', compact('data'));
    }

    public function showDetailTransaction($id)
    {
        // $transaksi = transaction::find($id);
        // $user = user::where('id', $transaksi)
        $data = array();
        $data['transaksi'] = DB::select('SELECT t.*, u.name, u.phone, a.address FROM transactions as t JOIN users as u ON t.user_id = u.id JOIN addresses as a ON t.address_id = a.id where t.id = ' . $id);
        $cart_id = json_decode($data['transaksi'][0]->cart_id, true);
        $cart_id = str_replace('[', '', $cart_id);
        $cart_id = str_replace(']', '', $cart_id);

        $cart_id = str_split($cart_id);
        // $cart_id = implode(',', array_map('intval', $cart_id));
        // dd($cart_id);
        // return gettype($cart_id);

        // $history = transaction::where('id', $id)->orderBy('created_at', 'desc')->get(['cart_id', 'created_at']);
        // $cart = cart::where('user_id', Auth::user()->id)->where('status', "1")->get(["id", 'item_id', 'quantity'])->keyBy('id');
        // $item = item::withTrashed()->pluck('name', 'id');

        $data['cart'] = DB::select('SELECT DISTINCT c.quantity,  i.name, i.price FROM carts as c JOIN items as i ON i.id = c.item_id WHERE c.id IN (' . implode(',', array_map('intval', $cart_id)) . ')');

        return response()->json([
            "data" => $data,
        ]);
    }

    public function kirim($id)
    {
        $kirim = transaction::find($id);
        $kirim->status = '1';
        $kirim->save();

        return redirect(route('admin_transaksi_get'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil merubah status transaksi!');
    }
    public function batalKirim($id)
    {
        $kirim = transaction::find($id);
        $kirim->status = '0';
        $kirim->save();

        return redirect(route('admin_transaksi_get'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil merubah status transaksi!');
    }
}
