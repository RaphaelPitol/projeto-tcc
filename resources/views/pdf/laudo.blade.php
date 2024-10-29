<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laudo</title>
</head>


<body>
    <h1 style="text-align: center;">
        Laudo de Vistoria
    </h1>
    @foreach ($vistoria as $v)
    <p>Locador:{{$v->locador->name}}</p>
    <p>Locatario:{{$v->locatario->name}}</p>
    <p>Imobiliária:{{$v->imobiliaria->name}}</p>
    <p>Vistoriador:{{$v->vistoriador->name}}</p>
    @endforeach

    <div class="ambientes">

        <hr>
        @foreach ($ambientes as $ambiente )
        @php
        $detalhes = json_decode($ambiente->detalhes);
        @endphp

        <span>Ambiente</span>:{{$ambiente->nome_ambiente}}<br>
        <p>
            Piso: {{$ambiente->piso}},
            Conservação: {{$ambiente->cons_piso}},
            Descricao:
            @if (isset($detalhes->descricao_piso))
            @foreach ($detalhes->descricao_piso as $descricao_piso)
            {{$descricao_piso}},
            @endforeach
            @endif
            Observação: {{$ambiente->observacao_piso}}
        </p>
        <p>
            Roda-pé: {{$ambiente->rodape}},
            Conservação: {{$ambiente->cons_rodape}},
            Descricao:
            @if (isset($detalhes->descricao_rodape))
            @foreach ($detalhes->descricao_rodape as $descricao_rodape)
            {{$descricao_rodape}},
            @endforeach
            @endif
            Observação: {{$ambiente->observacao_rodape}}
        </p>
        <p>
            Parede: {{$ambiente->parede}},
            Conservação: {{$ambiente->cons_parede}},
            Cor Pintura: {{$ambiente->cor_parede}},
            Conservação Pintura: {{$ambiente->cons_pintura_parede}},
            Descricao:
            @if (isset($detalhes->descricao_parede))
            @foreach ($detalhes->descricao_parede as $descricao_parede)
            {{$descricao_parede}},
            @endforeach
            @endif
            Observação: {{$ambiente->observacao_parede}}
        </p>
        <p>
            Teto: {{$ambiente->teto}},
            Conservação: {{$ambiente->cons_teto}},
            Cor Pintura: {{$ambiente->cor_teto}},
            Conservação Pintura: {{$ambiente->cons_pintura_teto}},
            Descricao:
            @if (isset($detalhes->descricao_teto))
            @foreach ($detalhes->descricao_teto as $descricao_teto)
            {{$descricao_teto}},
            @endforeach
            @endif
            Observação: {{$ambiente->observacao_teto}}
        </p>
        <p>
            Porta: {{$ambiente->porta}},
            Conservação: {{$ambiente->cons_porta}},
            Cor Pintura: {{$ambiente->cor_porta}},
            Conservação Pintura: {{$ambiente->cons_pintura_porta}},
            Descricao:
            @if (isset($detalhes->descricao_porta))
            @foreach ($detalhes->descricao_porta as $descricao_porta)
            {{$descricao_porta}},
            @endforeach
            @endif
            Observação: {{$ambiente->observacao_porta}}
        </p>
        <p>
            Janela: {{$ambiente->janela}},
            Conservação: {{$ambiente->cons_janela}},
            Cor Pintura: {{$ambiente->cor_janela}},
            Conservação Pintura: {{$ambiente->cons_pintura_janela}},
            Descricao:
            @if (isset($detalhes->descricao_janela))
            @foreach ($detalhes->descricao_janela as $descricao_janela)
            {{$descricao_janela}},
            @endforeach
            @endif
            Observação: {{$ambiente->observacao_janela}}
        </p>
        <p>
            @if (isset($detalhes->tipoTomada))
            @foreach($detalhes->tipoTomada as $index => $tipo)
            Tomada: {{$tipo}}, Quantidade: {{$detalhes->quantidadeTomadas[$index]}} <br>
            @endforeach
            @endif

            @if (isset($detalhes->tipoInterruptor))
            @foreach($detalhes->tipoInterruptor as $index => $tipo)
            Interruptor: {{$tipo}}, Quantidade: {{$detalhes->quantidadeInterruptores[$index]}} <br>
            @endforeach
            @endif
        </p>
        <p>
            Observações gerais do Ambiente: {{$ambiente->observacoes}}
        </p>
        <hr>
        @endforeach
    </div>

</body>

</html>