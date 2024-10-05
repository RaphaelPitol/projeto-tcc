<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Parede;
use Illuminate\Http\Request;

class ParedeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paredes = Parede::all();

        return view('parede.index', ['paredes'=> $paredes]);

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
        Parede::create($dados);

        $paredes = Parede::all();

        return view('parede.index', ['paredes'=> $paredes]);
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
        return view('parede.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
        ]);

        $parede = Parede::find($id);
        $parede->update([
            'tipo' => $request->tipo,
        ]);

        return redirect()->back()->with('success', 'Tipo de parede atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parede = Parede::find($id);
        $parede->delete();

        return redirect('/parede');
    }
}
