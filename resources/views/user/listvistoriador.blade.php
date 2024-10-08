
@extends('layouts.app')
@section('title', 'Lista de Vistoriadores')
@section('content')
<h1>Lista de Vistoriadores</h1>

<table class="table table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Nome</th>
      <th>E-mail</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($vistoriadores as $vistoriador )
    <tr>
      <th>{{$vistoriador->id}}</th>
      <td>
        <a href="" style="text-decoration: none;">{{$vistoriador->name}}</a>
      </td>
      <td>{{$vistoriador->email}}</td>
      <td style="display: flex; flex-direction: row;">
        <a href="{{route('edit.user', $vistoriador)}}" class="btn btn-primary" style="margin-right: 5px;">Edit</a>
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



<a class="btn btn-success" href="{{route(name: 'vistoriador')}}">Cadastrar</a>


@endsection