<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginGet()
    {
        return view('FrontEnd.pages.login');
    }

    public function loginPost(LoginRequest $request)
    {
        $request->validate();
        $user = User::whereEmail($request->email)->first();

        if ($user == []) {
            return back()->with('icon', 'error')->with('title', 'Maaf')->with('text', 'email atau password salah!');
        }
        if(Hash::check($request->password, $user->password)){
            $remember = $request->has('remember') ? true : false;
            Auth::guard('user')->loginUsingId($user->id, $remember);
            // return redirect()->intended(route('namenya route home'));
            return 'login berhasil';
        }
        return back()->with('icon', 'error')->with('title', 'Maaf')->with('text', 'email atau password salah!');
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return 'Logout berhasil dan redirect ke halaman home';
    }
}
