<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Vistoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        //dd($id);
        $ambientes = Ambiente::where('vistoria_id', $id)->get();
        return view('ambiente.index', ['ambientes' => $ambientes, 'id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        //dd($id);
        return view('ambiente.create', ['id' => $id]);
    }

    /**                                                                        
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $dados = $request->except('__token');
        Ambiente::create($dados);
        $ambientes = Ambiente::where('vistoria_id',  $request->input('vistoria_id'))->get();

        return view('ambiente.index', [
            'id' => $request->input('vistoria_id'),
            'ambientes' => $ambientes
        ]);
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
    public function edit(Ambiente $ambiente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ambiente $ambiente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ambiente $ambiente)
    {
        //
    }
}
