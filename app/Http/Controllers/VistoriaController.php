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
    public function index()
    {
        $locadores = LocadorLocatario::all();
        $locatarios = LocadorLocatario::all();
        $vistorias = Vistoria::where('id_imobiliaria', Auth::user()->id)->get();
        $vistoriadores = User::where('permission', 'vistoriador')->get();

        return view('vistoria.index', ["locadores"=>$locadores, "locatarios"=>$locatarios, "vistorias"=> $vistorias,"vistoriadores"=>$vistoriadores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vistoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->except('__token');
        $dados['id_imobiliaria'] = Auth::user()->id_imobiliaria;

        Vistoria::create($dados);

        return redirect('/vistoria.index');
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
        $vistoria = Vistoria::find($id);

        return view('vistorias.edit', ['vistoria'=> $vistoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vistoria = Vistoria::find($id);

        $vistoria->update([
            "id_locador" => $request->name,
            "id_locatario" => $request->name,
            "id_vistoriador" => $request->nome,
            "status" => $request->status,
            "nome" => $request->nome,
            "cep" => $request->cep,
            "logradouro" => $request->logradouro,
            "numero" => $request->numero,
            "bairro" => $request->bairro,
            "cidade" => $request->cidade,
            "data_prazo" => $request->data_prazo
        ]);

        return redirect('/vistoria/index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Vistoria::destroy($id);

        return redirect('/vistoria.index');
    }
}
