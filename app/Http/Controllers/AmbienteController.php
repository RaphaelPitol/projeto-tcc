<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use App\Models\AmbienteFoto;
use App\Models\Vistoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AmbienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $dadosVistoria = Vistoria::where('id', $id)->with('locador')->get();
        $dados = '';
        foreach ($dadosVistoria as $dado) {
            $dados = $dado->nome . "-" . $dado->locador->name;
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

        // Ambiente::create($dados);

        try {
            $ambiente = Ambiente::create($dados);


            if ($request->hasFile('imagens')) {

                $manager = new ImageManager(new Driver());

                foreach ($request->file('imagens') as $index => $imagem) {

                    // nome único
                    $nomeArquivo = Str::uuid()->toString() . '.jpg';

                    // caminho final (storage/app/public/...)
                    $diretorio = "vistorias/{$ambiente->vistoria_id}/ambientes/{$ambiente->id}";
                    $caminhoCompleto = storage_path("app/public/{$diretorio}/{$nomeArquivo}");

                    // garante que a pasta existe
                    if (!file_exists(dirname($caminhoCompleto))) {
                        mkdir(dirname($caminhoCompleto), 0755, true);
                    }

                    // lê, redimensiona e comprime
                    $image = $manager->read($imagem);
                    $image->scale(width: 1600);              // bom equilíbrio p/ PDF
                    $image->toJpeg(quality: 60)->save($caminhoCompleto);

                    // salva no banco
                    AmbienteFoto::create([
                        'vistoria_id' => $ambiente->vistoria_id,
                        'ambiente_id' => $ambiente->id,
                        'imagem'      => "{$diretorio}/{$nomeArquivo}",
                        'ordem'       => $index,
                    ]);
                }
            }

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
        foreach ($dadosVistoria as $dado) {
            $dados = $dado->nome . "-" . $dado->locador->name;
        }

        return redirect(route('ambiente.index', [
            'message' => $message,
            'id' => $request->input('vistoria_id'),
            'ambientes' => $ambientes,
            'dados' => $dados
        ]))->with('success', 'Ambiente gravado com sucesso.');
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
        $fotos = AmbienteFoto::where('ambiente_id', $ambientes->id)
            ->orderBy('ordem')
            ->get();
        $detalhes = json_decode($ambientes->detalhes ?? '', true);

        return view('ambiente.edit', [

            'ambientes' => $ambientes,
            'fotos' => $fotos,
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

        // $ambientes = Ambiente::where('vistoria_id', $request->vistoria_id)->get();
        // dd($ambientes);

        // return redirect()->route('ambiente.index', ['id' => $request->vistoria_id]);
        if ($request->hasFile('imagens')) {

            $manager = new ImageManager(new Driver());

            foreach ($request->file('imagens') as $index => $imagem) {

                // nome único
                $nomeArquivo = Str::uuid()->toString() . '.jpg';

                // caminho final (storage/app/public/...)
                $diretorio = "vistorias/{$ambientes->vistoria_id}/ambientes/{$ambientes->id}";
                $caminhoCompleto = storage_path("app/public/{$diretorio}/{$nomeArquivo}");

                // garante que a pasta existe
                if (!file_exists(dirname($caminhoCompleto))) {
                    mkdir(dirname($caminhoCompleto), 0755, true);
                }

                // lê, redimensiona e comprime
                $image = $manager->read($imagem);
                $image->scale(width: 1600);              // bom equilíbrio p/ PDF
                $image->toJpeg(quality: 60)->save($caminhoCompleto);

                // salva no banco
                AmbienteFoto::create([
                    'vistoria_id' => $ambientes->vistoria_id,
                    'ambiente_id' => $ambientes->id,
                    'imagem'      => "{$diretorio}/{$nomeArquivo}",
                    'ordem'       => $index,
                ]);
            }
        }

        return redirect(route('ambiente.index', [
            'id' => $request->vistoria_id,
        ]))->with('success', 'Ambiente Editado com sucesso.');
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
