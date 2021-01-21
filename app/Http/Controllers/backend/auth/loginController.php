<?php

namespace App\Http\Controllers\front\auth;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function getLogin()
    {
        return view('BackEnd.auth.login.index');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = admin::where('username', $request->username)->first();
        if ($user != []) {
            if (Hash::check($request->password, $user->password)) {
                $remember = $request->has('remember') ? true : false;
                Auth::guard('admin')->loginUsingId($user->id, $remember);
                return redirect()->intended(route('admin_index'));
            } else {
                return back()->with('icon', 'error')->with('title', 'Maaf')->with('text', 'username atau password salah!');
            }
        } else {
            return back()->with('icon', 'error')->with('title', 'Maaf')->with('text', 'username atau password salah!');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin_login_get'));
    }
}
