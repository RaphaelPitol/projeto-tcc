<?php

namespace App\Http\Controllers;

use App\Models\Vistoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        //code...
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
        try {

            $user = \App\Models\User::where('email', $request->email)->first();
            // var_dump($user);
            // dd($user->ativo);
            if (!$user->ativo) {
                return redirect()->back()->with('erro', 'Sua conta está desativada. Entre em contato com Administrador!');
            }

            if (Auth::attempt($credenciais)) {
                $request->session()->regenerate();
                // dd(Auth::user()->permission);
                if (Auth::user()->permission == 'admin') {
                    return redirect('home/admin');
                }
                if (Auth::user()->permission == 'imobiliaria') {
                    return redirect('home/imobiliaria');
                }

                return redirect('home/vistoriador');
            } else {
                return redirect()->back()->with('erro', 'Email ou senha invalidos.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('erro', 'Problemas na conexão! Tente novamente mais tarde.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
