@extends('layouts.app')
@section('title', 'Vistoria')
@section('content')
<h1>{{$detalhes->nome}}</h1>
<h1>{{$detalhes->logradouro}}</h1>
<h1>{{$detalhes->bairro}}</h1>
<h1>{{$detalhes->numero}}</h1>
<h1>{{$detalhes->cidade}}</h1>
@endsection