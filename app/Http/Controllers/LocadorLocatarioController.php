<?php

namespace App\Http\Controllers;

use App\Models\LocadorLocatario;
use Illuminate\Http\Request;

class LocadorLocatarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locadorlocatarios = LocadorLocatario::all();

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

        return redirect('/layouts/app');
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
    public function edit(LocadorLocatario $locadorLocatario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LocadorLocatario $locadorLocatario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocadorLocatario $locadorLocatario)
    {
        //
    }
}
