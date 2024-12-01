<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vistoria;
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
        if (Auth::user()->permission === 'admin'){
            $request->validate(
                [
                    'name' => ['required'],
                    'cnpj' => ['required'],
                    'email' => ['required', 'email'],
                    'razao_social' => ['required'],
                    'logradouro' => ['required'],
                    'cidade' => ['required'],
                    'password' => ['required'],
                ],
                [
                    'name.required' => 'o Nome Fantasia é Obrigatório!',
                    'cnpj.required' => 'O cnpj é Obrigatório!',
                    'email.required' => 'O Campo email é Obrigatório!',
                    'email.email' => 'O e-mail deve ser valido!',
                    'razao_social.required' => 'A Razão Social é Obrigatória!',
                    'logradouro.required' => 'O logradouro é Obrigatório!',
                    'cidade.required' => 'O :atributo é Obrigatório!',
                    'password.required' => 'A senha  é Obrigatória',

                ]
            );
        }
        if (Auth::user()->permission === 'imobiliaria'){
            $request->validate(
                [
                    'name' => ['required'],
                    'sobreNome' => ['required'],
                    'email' => ['required', 'email'],
                    'cpf' => ['required'],
                    'password' => ['required'],
                ],
                [
                    'email.required' => 'O Campo email é Obrigatório!',
                    'name.required' => 'O Nome é Obrigatório!',
                    'sobreNome.required' => 'O sobrenome é Obrigatório!',
                    'email.email' => 'O e-mail deve ser valido!',
                    'cpf.required' => 'O cpf é Obrigatório!',
                    'password.email' => 'A senha  é Obrigatória',

                ]
            );
        }
        // dd($request);
        $validador = new Validador();

        if (!$request->cpf == null) {
            if (!$validador->validarCPF($request->cpf)) {
                return redirect()->back()->withErrors(['cpf' => 'CPF inválido.'])->withInput();
            }
        }
        // dd($request);

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


        if (Auth::user()->permission === 'admin') {
            $isCnpjDuplicado = User::where('cnpj', $request->cnpj)->exists();
            if ($isCnpjDuplicado) {
                return redirect()->back()->withErrors(['cnpj' => 'Este cnpj já está cadastrado.'])->withInput();
            }
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
        if (Auth::user()->permission === 'admin' && $user->permission === 'admin') {

            return view('user.editAdmin', [
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
        // dd($request)
        $validador = new Validador();


        if (Auth::user()->permission === 'admin') {
            $imobiliaria = User::findOrFail($id);

            if ($request->input('ativo') == null){
                $dados = $request->except('_token');
                $user = User::find($id);
                $user->update($dados);
                return redirect('/home/admin')->with('success', 'Atualizado com sucesso.');
            }

            if ($imobiliaria) {
                $imobiliaria->ativo = $request->input('ativo');
                $imobiliaria->save();

                if ($imobiliaria->ativo == 0) {
                    User::where('id_imobiliaria', $imobiliaria->id)
                        ->where('permission', 'vistoriador')
                        ->update(['ativo' => 0]);
                } else {
                    User::where('id_imobiliaria', $imobiliaria->id)
                        ->where('permission', 'vistoriador')
                        ->update(['ativo' => 1]);
                }

                return redirect('/home/admin')->with('success', 'Imobiliária atualizados com sucesso.');
            }
        }




        if (!$request->password == null) {
            if (!$validador->validarSenha($request->password)) {
                return redirect()->back()->withErrors(['Senha' => 'Senha Invalida! Verifique os padroes exigidos.'])->withInput();
            }
        }
        // dd($request->permission);
        if (Auth::user()->permission === 'imobiliaria' && $request->permission === 'vistoriador') {
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
        $temVistoriador = Vistoria::where('id_vistoriador', $id)
            ->where('status', 1)
            ->exists();

        if ($temVistoriador) {
            return redirect()->back()->withErrors(['Locador' => 'Esse Vistoriador tem Vistoria finalizadas! Não é possivel Excluir.'])->withInput();
        }
        User::destroy($id);

        return redirect()->back()->with('success', 'Excluido com sucesso.');
    }

    public function listvistoriador()
    {
        $vistoriadores = User::where('id_imobiliaria', Auth::user()->id)->get();

        return view('user.listvistoriador', ['vistoriadores' => $vistoriadores]);
    }

    public function ativoInativo(Request $request, string $id){
        $dados = $request->except('_token');
        $user = User::find($id);
        $user->update($dados);

        return redirect('/vistoriadores')->with('success', 'Vistoriador atualizados com sucesso!');

    }
}
