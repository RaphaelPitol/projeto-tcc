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

    @foreach ($ambientes as $ambiente )
    <p>
       <span>Ambiente</span>:{{$ambiente->nome_ambiente}}<br>
       <span>Piso: </span>{{$ambiente->piso}}, Conservação do Piso: <span>{{$ambiente->cons_piso}}</span>
        @php
        $detalhes = json_decode($ambiente->detalhes);
        @endphp
        @foreach ($detalhes->descricao_piso as $descricao_piso)
        {{$descricao_piso}},
        @endforeach
    </p>
    @endforeach

</body>

</html>