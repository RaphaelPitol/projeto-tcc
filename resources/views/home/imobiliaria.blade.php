@extends('layouts.app')
@section('title', 'Piso')
@section('content')


<h1 class="text-center mt-1">Vistorias</h1>
<div class="container mt-5 text-right">
    <div class="d-grid gap-2">
        <a class="btn btn-primary mr-3" href="{{ route('vistoria.create') }}">
            <i class="bi bi-plus-lg"></i> Vistoria
        </a>
    </div>
</div>
<div class="container mt-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white text-center">
                        <h3 class="card-title">Realizadas</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>Vistoria</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (isset($realizadas))
                            @foreach ($realizadas as $realizada)
                                <tr>
                                <td><a href="">{{$realizada->nome}}-{{$realizada->locador->name}}</a></td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                        <form action="{{route('vistoria.status', $realizada)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="numer" name="status" value="0" hidden>
                                                <button class="btn btn-outline-danger" type="submit" onclick="return confirm('Deseja alterar o status par Pendente?')"><i class="bi bi-hourglass"></i></button>
                                            </form>
                                            <a href="{{route('pdf.geraPDF')}}" class="btn btn-outline-secondary" target="_blank"><i class="bi bi-filetype-pdf"></i></a>
                                            <button class="btn btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-danger text-white text-center">
                        <h3 class="card-title">Pendentes</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-primary">
                                <tr>

                                    <th>Vistoria</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($pendentes))
                                @foreach ($pendentes as $pendente)
                                <tr>
                                        <td><a href="{{ route('ambiente.index', $pendente) }}">{{$pendente->nome}}-{{$pendente->locador->name}}</a>-{{\Carbon\Carbon::parse( $pendente->data_prazo)->format('d/m/Y') }}</td>

                                    <td>
                                        <div class="d-flex justify-content-around" >
                                            <form action="{{route('vistoria.status', $pendente)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="numer" name="status" value="1" hidden>
                                                <button class="btn btn-outline-danger" type="submit" onclick="return confirm('Deseja alterar o status par Realizada?')"><i class="bi bi-hourglass"></i></button>
                                            </form>
                                            <a href="{{route('vistoria.edit', $pendente)}}" class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></a>
                                            <form action="{{route('vistoria.destroy', $pendente)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Deseja Excluir a Vistoria?')"><i class="bi bi-trash-fill"></i></button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection