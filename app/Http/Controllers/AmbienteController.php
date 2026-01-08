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
                "descricao_acessorios" => $request->descricao_acessorios,
                "observacao_acessorios" => $request->observacao_acessorios
            ]),
        ];

        // dd($dados);
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
    public function duplicar(string $id)
    {
        $ambiente = Ambiente::find($id);
        $json = json_decode($ambiente->detalhes);


           $dados = [
            "vistoria_id" => $ambiente->vistoria_id,
            "nome_ambiente" => $ambiente->nome_ambiente,
            "piso" => $ambiente->piso,
            "cons_piso" => $ambiente->cons_piso,
            "observacao_piso" => $ambiente->observacao_piso,
            "rodape" => $ambiente->rodape,
            "cons_rodape" => $ambiente->cons_rodape,
            "observacao_rodape" => $ambiente->observacao_rodape,
            "parede" => $ambiente->parede,
            "cons_parede" => $ambiente->cons_parede,
            "cor_parede" => $ambiente->cor_parede,
            "cons_pintura_parede" => $ambiente->cons_pintura_parede,
            "observacao_parede" => $ambiente->observacao_parede,
            "teto" => $ambiente->teto,
            "cons_teto" => $ambiente->cons_teto,
            "cor_teto" => $ambiente->cor_teto,
            "cons_pintura_teto" => $ambiente->cons_pintura_teto,
            "observacao_teto" => $ambiente->observacao_teto,
            "porta" => $ambiente->porta,
            "cons_porta" => $ambiente->cons_porta,
            "cor_porta" => $ambiente->cor_porta,
            "cons_pintura_porta" => $ambiente->cons_pintura_porta,
            "observacao_porta" => $ambiente->observacao_porta,
            "janela" => $ambiente->janela,
            "cons_janela" => $ambiente->cons_janela,
            "cor_janela" => $ambiente->cor_janela,
            "cons_pintura_janela" => $ambiente->cons_pintura_janela,
            "observacao_janela" => $ambiente->observacao_janela,
            "observacoes" => $ambiente->observacoes,
            'detalhes' => json_encode([
                'tipoInterruptor' => $json->tipoInterruptor,
                'quantidadeInterruptores' => $json->quantidadeInterruptores,
                'tipoTomada' => $json->tipoTomada,
                'quantidadeTomadas' => $json->quantidadeTomadas,
                'descricao_piso' => $json->descricao_piso,
                "descricao_rodape" => $json->descricao_rodape,
                "descricao_parede" => $json->descricao_parede,
                "descricao_teto" => $json->descricao_teto,
                "descricao_porta" => $json->descricao_porta,
                "descricao_janela" => $json->descricao_janela,
                "descricao_acessorios" => $json->descricao_acessorios,
                "observacao_acessorios" => $json->observacao_acessorios
            ]),
        ];
        Ambiente::create($dados);
       // dd("Ambiente Duplicado", $id);

        return redirect(route('ambiente.index', [
            'id' => $ambiente->vistoria_id,
        ]))->with('success', 'Ambiente Duplicado com sucesso.');
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
                "descricao_janela" => $request->descricao_janela,
                "descricao_acessorios" => $request->descricao_acessorios,
                "observacao_acessorios" => $request->observacao_acessorios
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
