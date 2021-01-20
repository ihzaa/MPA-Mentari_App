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
        $data['kategori'] = category::withCount('items')->get();
        return view('BackEnd.pages.kategori',compact('data'));
    }

    public function addKategori(Request $request)
    {
        $this->validate($request, [
            'namaKategori' => ['required']
        ]);
        category::create([
            'name' => $request->namaKategori
        ]);

        return redirect(route('admin_kategori_get'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menambah kategori!');
    }

    public function editKategori(Request $request, $id)
    {
       if($request->namaKategori == null){
        return redirect(route('admin_kategori_get'))->with('icon', 'error')->with('title', 'Gagal')->with('text', 'Nama kategori tidak boleh kosong!');
       }
        category::find($id)->update([
            'name' => $request->namaKategori
        ]);

        return redirect(route('admin_kategori_get'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil merubah kategori!');
    }

    public function hapusKategori($id)
    {
        category::find($id)->delete();

        return redirect(route('admin_kategori_get'))->with('icon', 'success')->with('title', 'Berhasil')->with('text', 'Berhasil menghapus kategori!');
    }
}
