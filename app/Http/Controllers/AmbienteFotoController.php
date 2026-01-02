<?php

namespace App\Http\Controllers;

use App\Models\AmbienteFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AmbienteFotoController extends Controller
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
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AmbienteFoto $ambienteFoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AmbienteFoto $ambienteFoto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AmbienteFoto $ambienteFoto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $foto = AmbienteFoto::findOrFail($id);

        Storage::disk('public')->delete($foto->imagem);

        $foto->delete();

        return response()->json(['success' => true]);
    }
}
