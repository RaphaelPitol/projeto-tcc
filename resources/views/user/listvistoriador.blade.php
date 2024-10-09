@extends('layouts.appimobiliaria')
@section('title', 'Lista de Vistoriadores')
@section('content')


<div class="row gap-2 d-flex justify-content-between align-items-center">
    <h1 class="text-center ml-4">Lista de Vistoriadores</h1>
    <a class="btn btn-success mr-5" href="{{ route('vistoriador') }}">
        <i class="bi bi-plus-lg"></i> Cadastrar
    </a>
</div>


<div class="table-container">
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vistoriadores as $vistoriador)
            <tr>
                <td>{{$vistoriador->name}}</td>
                <th>{{$vistoriador->sobreNome}}</th>
                <td>{{$vistoriador->email}}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{route('edit.user', $vistoriador)}}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{route('destroy.vistoriador', $vistoriador)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Deseja realmente deletar?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>





@endsection