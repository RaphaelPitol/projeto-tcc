<?php

namespace App\Http\Controllers;

use App\Models\LocadorLocatario;
use App\Models\User;
use App\Models\Vistoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VistoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $locadores = LocadorLocatario::where('id_imobiliaria', Auth::user()->id)->get();
        $locatarios = LocadorLocatario::where('id_imobiliaria', Auth::user()->id)->get();
        $vistoriadores = User::where('permission', 'vistoriador')
            ->where('id_imobiliaria', Auth::user()->id)
            ->get();

        return view('vistoria.create', [
            "locadores" => $locadores,
            "locatarios" => $locatarios,
            "vistoriadores" => $vistoriadores
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $dados = $request->except('__token');
        // $dados['id_imobiliaria'] = Auth::user()->id_imobiliaria;

        Vistoria::create($dados);

        return view('home.imobiliaria');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vistoria = Vistoria::find($id);
        // dd($vistoria);

        return view('vistoria.show', [
            "vistoria" => $vistoria,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $locadores = LocadorLocatario::where('id_imobiliaria', Auth::user()->id)->get();
        $locatarios = LocadorLocatario::where('id_imobiliaria', Auth::user()->id)->get();
        $vistoriadores = User::where('permission', 'vistoriador')
            ->where('id_imobiliaria', Auth::user()->id)
            ->get();
        $vistoria = Vistoria::find($id);

        // dd($vistoria->id_locador);
        return view('vistoria.edit', [
            'vistoria' => $vistoria,
            "locadores" => $locadores,
            "locatarios" => $locatarios,
            "vistoriadores" => $vistoriadores
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vistoria = Vistoria::find($id);

        // dd($request);

        $vistoria->update([
            "id_locador" => $request->id_locador,
            "id_locatario" => $request->id_locatario,
            "id_vistoriador" => $request->id_vistoriador,
            "nome" => $request->nome,
            "cep" => $request->cep,
            "logradouro" => $request->logradouro,
            "numero" => $request->numero,
            "bairro" => $request->bairro,
            "cidade" => $request->cidade,
            "data_prazo" => $request->data_prazo
        ]);

        return view('home.imobiliaria');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        Vistoria::destroy($id);

        return view('home.imobiliaria');
    }

    public function status(Request $request, string $id)
    {
        // dd($request);
        $vistoria = Vistoria::find($id);

        $vistoria->update([
            "status" => $request->status,
        ]);

        if(Auth::user()->permission == 'vistoriador'){
            return view('home.vistoriador');

        }
        return view('home.imobiliaria');
    }
}
