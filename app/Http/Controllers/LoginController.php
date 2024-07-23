<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        // dd($request);
        $credenciais = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [
                'email.required' => 'O Campo email é Obrigatório!',
                'email.email' => 'O email não é valido',
                'password.required' => 'O Campo senha é Obrigatório!'
            ]
        );

        if (Auth::attempt($credenciais)) {
            $request->session()->regenerate();
            return redirect()->intended('/layouts/app');
        } else {
            return redirect()->back()->with('erro', 'Email ou senha invalidos.');
        }
    }

    public function logout (Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
