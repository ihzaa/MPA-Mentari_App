<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'nama' => 'required',
            'phone' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah digunakan',
            'email.email' => 'Email yang diinputkan bukan dalam format Email',
            'password.required' => 'Password Wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'nama.required' => 'Nama harus diisi',
            'phone.required' => 'Nomer Telfon harus diisi',
            'phone.numeric' => 'Nomer telfon harus angka'
        ];
    }
}
