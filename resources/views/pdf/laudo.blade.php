<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laudo de Vistoria de Imóvel</title>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        color: #333;
        margin: 20px;
        line-height: 1.5;
    }

    .header,
    .footer {
        text-align: center;
        margin-bottom: 20px;
    }

    .header h1 {
        margin: 0;
        font-size: 24px;
        color: #0056b3;
    }

    .header p {
        margin: 2px 0;
        font-size: 12px;
        color: #555;
    }

    .title {
        text-align: center;
        font-size: 22px;
        color: #333;
        margin: 20px 0 10px;
    }

    .section {
        margin-bottom: 20px;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }

    .section p {
        margin: 5px 0;
        font-size: 14px;
    }

    .section span {
        font-weight: bold;
    }

    .ambiente-info {
        font-size: 12px;
        margin-top: 10px;
    }
    .termo {
        font-size: 12px;
        margin-top: 10px;
    }

    hr {
        border: 1px solid #ccc;
        margin: 20px 0;
    }

    .signature-section {
        text-align: center;
        margin-top: 40px;
    }

    .signature {
        display: inline-block;
        margin: 0 20px;
        text-align: center;
    }

    .signature-line {
        margin-top: 60px;
        border-top: 1px solid #000;
        width: 200px;
    }

    .date-location {
        text-align: center;
        margin: 20px 0;
        font-size: 14px;
        color: #555;
    }
</style>

@php
$indice = 0;
@endphp

<body>

    @foreach ($vistoria as $v)
    <div class="header">
        <p>Razão Social: {{$v->imobiliaria->razao_social}} - CNPJ: {{$v->imobiliaria->cnpj}}</p>
        <p>Endereço: {{$v->imobiliaria->logradouro}} - Número: {{$v->imobiliaria->numero}}, Bairro: {{$v->imobiliaria->bairro}}, Cidade: {{$v->imobiliaria->cidade}}</p>
        <p>Telefone:{{$v->imobiliaria->telefone}}</p>
        <p>Email de Contato: {{$v->imobiliaria->email}}</p>
    </div>

    <h1 class="title">Termo de Vistoria</h1>

    <div class="section">
        <p><span>Tipo do Imóvel:</span> {{$v->nome}}</p>
        <p><span>Endereço Completo:</span> {{$v->logradouro}} Número {{$v->numero}}, Bairro {{$v->bairro}}, Cidade {{$v->cidade}}</p>
        <p><span>Locador:</span> {{$v->locador->name}}</p>
        <p><span>Locatário:</span> {{$v->locatario->name}}</p>
        <p><span>Vistoriador Responsável:</span> {{$v->vistoriador->name}} {{$v->vistoriador->sobreNome}}</p>
    </div>


    <div class="ambientes">
        @foreach ($ambientes as $ambiente)
        @php
        $indice += 1;
        $detalhes = json_decode($ambiente->detalhes);
        @endphp

        <h3 class="title">Ambiente {{$indice}}: {{$ambiente->nome_ambiente}}</h3>

        <div class="ambiente-info">
            <p>
                @if(!empty($ambiente->piso))<span>Piso:</span> {{$ambiente->piso}},@endif
                @if(!empty($ambiente->cons_piso))<span>Estado de Conservação:</span> {{$ambiente->cons_piso}},@endif
                @if(!empty($detalhes->descricao_piso))<span>Descrição:</span>
                @foreach ($detalhes->descricao_piso as $descricao_piso){{$descricao_piso}}, @endforeach
                @endif
                @if(!empty($ambiente->observacao_piso))<span>Observação:</span> {{$ambiente->observacao_piso}}. @endif
            </p>

            <p>
                @if(!empty($ambiente->rodape))<span>Roda-pé:</span> {{$ambiente->rodape}},@endif
                @if(!empty($ambiente->cons_rodape))<span>Estado de Conservação:</span> {{$ambiente->cons_rodape}},@endif
                @if(!empty($detalhes->descricao_rodape))<span>Descrição:</span>

                @foreach ($detalhes->descricao_rodape as $descricao_rodape){{$descricao_rodape}}, @endforeach
                @endif
                @if(!empty($ambiente->observacao_rodape))<span>Observação:</span> {{$ambiente->observacao_rodape}}.@endif
            </p>

            <p>
                @if(!empty($ambiente->parede))<span>Parede:</span> {{$ambiente->parede}},@endif
                @if(!empty($ambiente->cons_parede))<span>Estado de Conservação:</span> {{$ambiente->cons_parede}},@endif
                @if(!empty($ambiente->cor_parede))<span>Cor da Pintura:</span> {{$ambiente->cor_parede}},@endif
                @if(!empty($ambiente->cons_pintura_parede))<span>Conservação da Pintura:</span> {{$ambiente->cons_pintura_parede}},@endif
                @if(!empty($detalhes->descricao_parede))<span>Descrição:</span>
                @foreach ($detalhes->descricao_parede as $descricao_parede){{$descricao_parede}}, @endforeach
                @endif
                @if(!empty($ambiente->observacao_parede))<span>Observação:</span> {{$ambiente->observacao_parede}}. @endif
            </p>

            <p>
                @if(!empty($ambiente->teto))<span>Teto:</span> {{$ambiente->teto}},@endif
                @if(!empty($ambiente->cons_teto))<span>Estado de Conservação:</span> {{$ambiente->cons_teto}},@endif
                @if(!empty($ambiente->cor_teto))<span>Cor da Pintura:</span> {{$ambiente->cor_teto}},@endif
                @if(!empty($ambiente->cons_pintura_teto))<span>Conservação da Pintura:</span> {{$ambiente->cons_pintura_teto}},@endif
                @if(!empty($detalhes->descricao_teto))<span>Descrição:</span>
                @foreach ($detalhes->descricao_teto as $descricao_teto){{$descricao_teto}}, @endforeach
                @endif
                @if(!empty($ambiente->observacao_teto))<span>Observação:</span> {{$ambiente->observacao_teto}}.@endif
            </p>

            <p>
                @if(!empty($ambiente->porta))<span>Porta:</span> {{$ambiente->porta}},@endif
                @if(!empty($ambiente->cons_porta))<span>Estado de Conservação:</span> {{$ambiente->cons_porta}},@endif
                @if(!empty($ambiente->cor_porta))<span>Cor da Pintura:</span> {{$ambiente->cor_porta}},@endif
                @if(!empty($ambiente->cons_pintura_porta))<span>Conservação da Pintura:</span> {{$ambiente->cons_pintura_porta}},@endif
                @if (!empty($detalhes->descricao_porta))
                <span>Descrição:</span>
                @foreach ($detalhes->descricao_porta as $descricao_porta){{$descricao_porta}}, @endforeach
                @endif
                @if(!empty($ambiente->observacao_porta))<span>Observação:</span> {{$ambiente->observacao_porta}}.@endif
            </p>

            <p>
                @if(!empty($ambiente->janela))<span>Janela:</span> {{$ambiente->janela}},@endif
                @if(!empty($ambiente->cons_janela))<span>Estado de Conservação:</span> {{$ambiente->cons_janela}},@endif
                @if(!empty($ambiente->cor_janela))<span>Cor da Pintura:</span> {{$ambiente->cor_janela}},@endif
                @if(!empty($ambiente->cons_pintura_janela))<span>Conservação da Pintura:</span> {{$ambiente->cons_pintura_janela}},@endif
                @if (!empty($detalhes->descricao_janela))
                <span>Descrição:</span>
                @foreach ($detalhes->descricao_janela as $descricao_janela){{$descricao_janela}}, @endforeach
                @endif
                @if(!empty($ambiente->observacao_janela))<span>Observação:</span> {{$ambiente->observacao_janela}}.@endif
            </p>

            @if (isset($detalhes->tipoTomada))
            @foreach($detalhes->tipoTomada as $index => $tipo)
            <p><span>Tomada:</span> {{$tipo}}, <span>Quantidade:</span> {{$detalhes->quantidadeTomadas[$index]}}</p>
            @endforeach
            @endif

            @if (isset($detalhes->tipoInterruptor))
            @foreach($detalhes->tipoInterruptor as $index => $tipo)
            <p><span>Interruptor:</span> {{$tipo}}, <span>Quantidade:</span> {{$detalhes->quantidadeInterruptores[$index]}}</p>
            @endforeach
            @endif

            @if(!empty($ambiente->observacoes))<p><span>Observações Gerais do Ambiente:</span> {{$ambiente->observacoes}}</p>.@endif
        </div>
        <hr>
        @endforeach
    </div>
    <div class="termo" style="text-indent: 30px;">
        <p> 
            O locatário declara estar ciente de que deverá conferir o presente laudo de vistoria e, 
            caso identifique qualquer divergência, deverá registrá-la por escrito em duas (02) vias, 
            em documento separado, e apresentá-las à Imobiliária no prazo máximo de dez (10) dias corridos, 
            contados a partir da data de recebimento deste documento.
        </p>
        <p>
            O locatário reconhece as anotações constantes deste relatório, responsabilizando-se pela manutenção 
            do imóvel e comprometendo-se a devolvê-lo nas mesmas condições em que o recebe nesta data.
        </p>
    </div>

    <div class="date-location">
        <p>Umuarama - PR, {{ $v->updated_at->locale('pt_BR')->isoFormat('D [de] MMMM [de] YYYY') }}</p>
    </div>

    <!-- Sessão de Assinaturas -->
    <div class="signature-section">
        <div class="signature">
            <div class="signature-line"></div>
            {{$v->locador->name}}
            <p><span>Locador</span> </p>
        </div>

        <div class="signature">
            <div class="signature-line"></div>
            {{$v->locatario->name}}
            <p><span>Locatário</span> </p>
        </div>

        <div class="signature">
            <div class="signature-line"></div>
            {{$v->vistoriador->name}} {{$v->vistoriador->sobreNome}}
            <p><span>Vistoriador Responsável</span> </p>
        </div>
    </div>
    @endforeach

</body>

</html>