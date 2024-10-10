@extends('layouts.appimobiliaria')
@section('title', 'Lista de Vistoriadores')
@section('content')

<div class="container">

    <div class="row gap-2 d-flex justify-content-between align-items-center">
        <h1 class="text-center ml-4">Vistoriadores</h1>
        <a class="btn btn-success mr-5" href="{{ route('vistoriador') }}">
            <i class="bi bi-plus-lg"></i> Cadastrar
        </a>
    </div>


    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
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
                    <td style="display: flex; flex-direction: row;">

                            <a href="{{route('edit.user', $vistoriador)}}" class="btn btn-primary" style="margin-right: 5px;">Edit</a>
                            <form action="{{route('destroy.vistoriador', $vistoriador)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Deseja realmente deletar?')">Delete</button>
                            </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>





@endsection