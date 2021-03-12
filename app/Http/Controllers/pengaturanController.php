<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class pengaturanController extends Controller
{
    public function index()
    {
        return view('BackEnd.pages.pengaturan');
    }

    public function edit_password(Request $request)
    {
        $validated = $request->validate([
            'old' => 'required',
            'new' => 'required|min:6',
            'confirm' => 'required|same:new',
        ]);

        $admin = admin::where('id', 1)->first();

        if (Hash::check($request->old, $admin->password)) {
            admin::find($admin->id)->update([
                'password' => Hash::make($request->new),
            ]);

            return redirect(route('admin_pengaturan'))->with('icon', 'success')->with('title', 'Berhasil')->with('message', 'Berhasil merubah password.');
        } else {
            return redirect(route('admin_pengaturan'))->with('icon', 'error')->with('title', 'Gagal')->with('message', 'Password lama salah.');
        }
    }
}
