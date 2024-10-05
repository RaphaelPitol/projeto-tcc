<?php

namespace App\Http\Controllers;

use App\Models\DescricaoPiso;
use Illuminate\Http\Request;

class DescricaoPisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $descricao_pisos = DescricaoPiso::all();

        return view('descricaoPiso.index', ['descricao_pisos'=> $descricao_pisos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->except('__token');
        DescricaoPiso::create($dados);

        $descricao_pisos = DescricaoPiso::all();

        return view('descricaoPiso.index', ['descricao_pisos'=> $descricao_pisos]);
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
        return view('descricaoPiso.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
        ]);

        $descricaoPiso = DescricaoPiso::find($id);
        $descricaoPiso->update([
            'descricao' => $request->descricao,
        ]);

        return redirect()->back()->with('sucess', 'Descrição de piso atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $descricaoPiso = DescricaoPiso::find($id);
        $descricaoPiso->delete();

        return redirect('/decricaoPiso');
    }
}
