<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class transaksiController extends Controller
{
    public function gettransaksi()
    {
        $data = array();
        $data['transaksi'] = transaction::all();
        return view('BackEnd.pages.transaksi',compact('data'));
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
        $data['transaksi'] = DB::select('SELECT t.*, u.name, u.phone, a.address FROM transactions as t JOIN users as u ON t.user_id = u.id JOIN addresses as a ON t.address_id = a.id where t.id = '.$id);
        $cart_id = json_decode($data['transaksi'][0]->cart_id,true);
        $cart_id = str_replace('[','',$cart_id);
        $cart_id = str_replace(']','',$cart_id);

        $cart_id = str_split($cart_id);
        // return gettype($cart_id);
        $data['cart'] = DB::select('SELECT DISTINCT c.quantity, i.name, i.price FROM carts as c JOIN items as i WHERE i.id IN ('.implode(',', array_map('intval', $cart_id)).')');

        return response()->json([
            "data"=>$data
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
