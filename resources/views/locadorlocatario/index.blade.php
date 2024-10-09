@extends('layouts.appimobiliaria')
@section('title', 'Edição')
@section('content')

<div class="container">

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>RG</th>
                    <th>CPF</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $locadorlocatarios as $locadorlocatario )
                <tr>
                    <th>{{$locadorlocatario->name}}</th>
                    <td>
                        {{$locadorlocatario->telefone}}
                    </td>
                    <td>{{$locadorlocatario->rg}}</td>
                    <td>{{$locadorlocatario->cpf}}</td>
                    <td style="display: flex; flex-direction: row;">
                        <a href="" class="btn btn-primary" style="margin-right: 5px;">Edit</a>
                        <form action="" method="POST">
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