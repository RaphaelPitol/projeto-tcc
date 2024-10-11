<?php

namespace App\Http\Controllers;

use App\Models\LocadorLocatario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocadorLocatarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $locadorlocatarios = LocadorLocatario::where('id_imobiliaria', Auth::user()->id)->get();

        return view('locadorlocatario.index', ["locadorlocatarios" => $locadorlocatarios]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locadorlocatario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->except('_token');

        LocadorLocatario::create($dados);

        return redirect('/locloca/index');
    }

    /**
     * Display the specified resource.
     */
    public function show(LocadorLocatario $locadorLocatario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $locloca = LocadorLocatario::find($id);

        return view('locadorlocatario.edit', ['locloca'=> $locloca]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $locloca = LocadorLocatario::find($id);

        $locloca->update([
            "name" => $request->name,
            "telefone" => $request->telefone,
            "rg" => $request->rg,
            "cpf" => $request->cpf
        ]);

        return redirect('/locloca/index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        LocadorLocatario::destroy($id);

        return redirect('/locloca/index');
    }
}
