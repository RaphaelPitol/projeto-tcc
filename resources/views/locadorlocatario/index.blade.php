@extends('layouts.app')
@section('title', 'Edição')
@section('content')

<div class="container">
<div class="row gap-2 d-flex justify-content-between align-items-center">
    <h1 class="text-center ml-4">Locador/Locatarios</h1>
    <a class="btn btn-success mr-5" href="{{ route('locloca.create') }}">
        <i class="bi bi-plus-lg"></i> Cadastrar
    </a>
</div>


<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <thead class="thead-dark">
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
                        <a href="{{route('locloca.edit', $locadorlocatario)}}" class="btn btn-primary" style="margin-right: 5px;"><i class="bi bi-pencil-fill"></i></a>
                        <form id="form-locloca" action="{{route('locloca.destroy', $locadorlocatario)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" onclick= "excluirLocLoca(event)"><i class="bi bi-trash-fill"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function excluirLocLoca(event) {
            event.preventDefault(); // Previne o comportamento padrão do link

            Swal.fire({
                title: 'Deseja Excluir Locador/Locatario?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: 'Sim',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-locloca').submit();
                }
            });
        }
</script>
@endsection