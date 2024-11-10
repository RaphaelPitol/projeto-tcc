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
                                    <td>{{$realizada->nome}}-{{$realizada->locador->name}}</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <form id="form-realizada" action="{{route('vistoria.status', $realizada)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="numer" name="status" value="0" hidden>
                                                <button class="btn btn-outline-danger" onclick="confirm(event, 'form-realizada')"><i class="bi bi-hourglass"></i></button>
                                            </form>
                                            <a href="{{route('pdf.geraPDF', $realizada)}}" class="btn btn-outline-secondary" target="_blank"><i class="bi bi-filetype-pdf"></i></a>
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
                                        <div class="d-flex justify-content-around">
                                            <form id="form-pendente" action="{{route('vistoria.status', $pendente)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="numer" name="status" value="1" hidden>
                                                <button class="btn btn-outline-danger" onclick="confirm(event, 'form-pendente')"><i class="bi bi-hourglass"></i></button>
                                            </form>
                                            <a href="{{route('vistoria.edit', $pendente)}}" class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></a>
                                            <form id="form-pendente-excluir" action="{{route('vistoria.destroy', $pendente)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger" onclick="excluir(event)"><i class="bi bi-trash-fill"></i></button>
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

    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
    @endif

    <script>
        function confirm(event, formId) {
            event.preventDefault(); // Previne o comportamento padrão do link

            Swal.fire({
                title: 'Deseja mudar o Status?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }

        function excluir(event) {
            event.preventDefault(); // Previne o comportamento padrão do link

            Swal.fire({
                title: 'Deseja Excluira Vistoria?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: 'Sim',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-pendente-excluir').submit();
                }
            });
        }
    </script>

    @endsection