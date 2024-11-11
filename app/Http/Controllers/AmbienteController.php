<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\Vistoria;
use Illuminate\Http\Request;

class AmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $dadosVistoria = Vistoria::where('id', $id)->with('locador')->get();
        $dados = '';
        foreach($dadosVistoria as $dado){
           $dados = $dado->nome ."-" .$dado->locador->name;
        }

        $ambientes = Ambiente::where('vistoria_id', $id)->get();
        return view('ambiente.index', [
            'ambientes' => $ambientes,
            'id' => $id,
            'dados' => $dados
        ]);
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
        $dados = [
            "vistoria_id" => $request->vistoria_id,
            "nome_ambiente" => $request->nome_ambiente,
            "piso" => $request->piso,
            "cons_piso" => $request->cons_piso,
            "observacao_piso" => $request->observacao_piso,
            "rodape" => $request->rodape,
            "cons_rodape" => $request->cons_rodape,
            "observacao_rodape" => $request->observacao_rodape,
            "parede" => $request->parede,
            "cons_parede" => $request->cons_parede,
            "cor_parede" => $request->cor_parede,
            "cons_pintura_parede" => $request->cons_pintura_parede,
            "observacao_parede" => $request->observacao_parede,
            "teto" => $request->teto,
            "cons_teto" => $request->cons_teto,
            "cor_teto" => $request->cor_teto,
            "cons_pintura_teto" => $request->cons_pintura_teto,
            "observacao_teto" => $request->observacao_teto,
            "porta" => $request->porta,
            "cons_porta" => $request->cons_porta,
            "cor_porta" => $request->cor_porta,
            "cons_pintura_porta" => $request->cons_pintura_porta,
            "observacao_porta" => $request->observacao_porta,
            "janela" => $request->janela,
            "cons_janela" => $request->cons_janela,
            "cor_janela" => $request->cor_janela,
            "cons_pintura_janela" => $request->cons_pintura_janela,
            "observacao_janela" => $request->observacao_janela,
            "observacoes" => $request->observacoes,
            'detalhes' => json_encode([
                'tipoInterruptor' => $request->tipoInterruptor,
                'quantidadeInterruptores' => $request->quantidadeInterruptores,
                'tipoTomada' => $request->tipoTomada,
                'quantidadeTomadas' => $request->quantidadeTomadas,
                'descricao_piso' => $request->descricao_piso,
                "descricao_rodape" => $request->descricao_rodape,
                "descricao_parede" => $request->descricao_parede,
                "descricao_teto" => $request->descricao_teto,
                "descricao_porta" => $request->descricao_porta,
                "descricao_janela" => $request->descricao_janela,
            ]),
        ];
        // dd($dados);

        // Ambiente::create($dados);

        try {
            Ambiente::create($dados);
            $message = [
                'type' => 'success',
                'text' => 'Ambiente cadastrado com sucesso!'
            ];
        } catch (\Exception $e) {
            $message = [
                'type' => 'error',
                'text' => 'Erro ao cadastrar o ambiente: '
            ];
        }


        $ambientes = Ambiente::where('vistoria_id',  $request->input('vistoria_id'))->get();
        $dadosVistoria = Vistoria::where('id', $request->input('vistoria_id'))->with('locador')->get();
        $dados = '';
        foreach($dadosVistoria as $dado){
           $dados = $dado->nome ."-" .$dado->locador->name;
        }

        return view('ambiente.index', [
            'message' => $message,
            'id' => $request->input('vistoria_id'),
            'ambientes' => $ambientes,
            'dados' => $dados
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
    public function edit(string $id)
    {
        $ambientes = Ambiente::find($id);
        $detalhes = json_decode($ambientes->detalhes ?? '', true);

        return view('ambiente.edit', [

            'ambientes'=> $ambientes,
            // 'detalhes'=> $detalhes
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ambientes = Ambiente::find($id);

        // dd($ambientes);

        $ambientes->update([
            "vistoria_id" => $request->vistoria_id,
            "nome_ambiente" => $request->nome_ambiente,
            "piso" => $request->piso,
            "cons_piso" => $request->cons_piso,
            "observacao_piso" => $request->observacao_piso,
            "rodape" => $request->rodape,
            "cons_rodape" => $request->cons_rodape,
            "observacao_rodape" => $request->observacao_rodape,
            "parede" => $request->parede,
            "cons_parede" => $request->cons_parede,
            "cor_parede" => $request->cor_parede,
            "cons_pintura_parede" => $request->cons_pintura_parede,
            "observacao_parede" => $request->observacao_parede,
            "teto" => $request->teto,
            "cons_teto" => $request->cons_teto,
            "cor_teto" => $request->cor_teto,
            "cons_pintura_teto" => $request->cons_pintura_teto,
            "observacao_teto" => $request->observacao_teto,
            "porta" => $request->porta,
            "cons_porta" => $request->cons_porta,
            "cor_porta" => $request->cor_porta,
            "cons_pintura_porta" => $request->cons_pintura_porta,
            "observacao_porta" => $request->observacao_porta,
            "janela" => $request->janela,
            "cons_janela" => $request->cons_janela,
            "cor_janela" => $request->cor_janela,
            "cons_pintura_janela" => $request->cons_pintura_janela,
            "observacao_janela" => $request->observacao_janela,
            "observacoes" => $request->observacoes,
            'detalhes' => json_encode([
                'tipoInterruptor' => $request->tipoInterruptor,
                'quantidadeInterruptores' => $request->quantidadeInterruptores,
                'tipoTomada' => $request->tipoTomada,
                'quantidadeTomadas' => $request->quantidadeTomadas,
                'descricao_piso' => $request->descricao_piso,
                "descricao_rodape" => $request->descricao_rodape,
                "descricao_parede" => $request->descricao_parede,
                "descricao_teto" => $request->descricao_teto,
                "descricao_porta" => $request->descricao_porta,
                "descricao_janela" => $request->descricao_janela
            ]),
        ]);

        $ambientes = Ambiente::where('vistoria_id', $request->vistoria_id)->get();
        // dd($ambientes);

        return redirect()->route('ambiente.index', ['id' => $request->vistoria_id]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ambientes = Ambiente::find($id);

        $vistoria_id = $ambientes->vistoria_id;
        // dd($id);
        Ambiente::destroy($id);

        return redirect()->route('ambiente.index', ['id' => $vistoria_id]);
    }
}
