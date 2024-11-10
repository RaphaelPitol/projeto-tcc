<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Validador\Validador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validador = new Validador();
        if (!$validador->validarCPF($request->cpf)) {
            return redirect()->back()->withErrors(['cpf' => 'CPF inválido.'])->withInput();
        }

        $isCpfDuplicado = User::where('cpf', $request->cpf)
            ->where('permission', 'vistoriador')
            ->where('id_imobiliaria', $request->id_imobiliaria)
            ->exists();

        if ($isCpfDuplicado) {
            return redirect()->back()->withErrors(['cpf' => 'Já existe um vistoriador cadastrado com este CPF para esta imobiliária.'])->withInput();
        }


        $isEmailDuplicado = User::where('email', $request->email)->exists();

        if ($isEmailDuplicado) {
            return redirect()->back()->withErrors(['email' => 'Este e-mail já está cadastrado.'])->withInput();
        }

        $dados = $request->except('_token');

        User::create($dados);

        if (Auth::user()->permission == 'admin') {
            return redirect('/home/admin')->with('success', 'Cadastrado com sucesso.');
        }

        if (Auth::user()->permission == 'imobiliaria') {
            return redirect('/vistoriadores')->with('success', 'Cadastrado com sucesso.');
        }

        // return view('home.vistoriador');
        return redirect('/home/vistoriador')->with('success', 'Cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        if (Auth::user()->permission === 'imobiliaria' && $user->permission === 'vistoriador') {

            return view('user.editVistoriador', [
                "user" => $user
            ]);
        }
        return view('user.edit', [
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->permission);
        if (Auth::user()->permission === 'imobiliaria' && $request->permission === 'vistoriador') {
            $validador = new Validador();
            if (!$validador->validarCPF($request->cpf)) {
                return redirect()->back()->withErrors(['cpf' => 'CPF inválido.'])->withInput();
            }
            $dados = $request->except('_token');
            $user = User::find($id);
            $user->update($dados);
            return redirect('/vistoriadores')->with('success', 'Edição realizada com sucesso.');
        }

        $dados = $request->except('_token');
        $user = User::find($id);
        $user->update($dados);

        if (Auth::user()->permission == 'admin') {
            return redirect('/home/admin')->with('success', 'Edição realizada com sucesso.');
        }

        if (Auth::user()->permission == 'imobiliaria') {
            return redirect('/home/imobiliaria')->with('success', 'Edição realizada com sucesso.');
        }

        // return view('home.vistoriador');
        return redirect('/home/vistoriador')->with('success', 'Edição realizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);

        return redirect()->back()->with('success', 'Excluido com sucesso.');
    }

    public function listvistoriador()
    {
        $vistoriadores = User::where('id_imobiliaria', Auth::user()->id)->get();

        return view('user.listvistoriador', ['vistoriadores' => $vistoriadores]);
    }
}
