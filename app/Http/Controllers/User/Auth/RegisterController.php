<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function registerGet()
    {
        return 'kasih return ke view nya register';
    }

    public function registerPost(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:email|email',
            'password' => 'required|min:8',
            'nama' => 'required',
            'phone' => 'numeric'
        ]);

        $user = User::create([
            'password' => Hash::make($request->password),
            'name' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        Auth::guard('user')->loginUsingId($user->id);
        return 'register berhasil dan otomatis login dan redirect ke halaman home';
    }
}
