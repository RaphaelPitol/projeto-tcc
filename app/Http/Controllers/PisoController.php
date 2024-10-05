<?php

namespace App\Http\Controllers;

use App\Models\Piso;
use Illuminate\Http\Request;

class PisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pisos = Piso::all();

        return view('piso.index', ['pisos'=> $pisos]);

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
        Piso::create($dados);

        $pisos = Piso::all();

        return view('piso.index', ['pisos'=> $pisos]);
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
        return view('piso.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($id);
        $request->validate([
            'tipo' => 'required|string|max:255',
        ]);

        $piso = Piso::find($id);
        $piso->update([
            'tipo' => $request->tipo,
        ]);

        return redirect()->back()->with('success', 'Tipo de piso atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $piso = Piso::find($id);
        $piso->delete();

        return redirect('/piso');
    }
}
