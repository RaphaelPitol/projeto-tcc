@extends('layouts.app')
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

                        <a href="{{route('edit.user', $vistoriador)}}" class="btn btn-primary" style="margin-right: 5px;"><i class="bi bi-pencil-fill"></i></a>
                        <form id="vistoriador-{{$vistoriador->id}}" action="{{route('destroy.vistoriador', $vistoriador)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" data-id="{{$vistoriador->id}}" onclick="excluirVisto(event)"><i class="bi bi-trash-fill"></i></button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Erros',
            text: "{{ implode(', ', $errors->all()) }}"
        });
    });
</script>
@endif
<script>
    function excluirVisto(event) {
        event.preventDefault(); // Previne o comportamento padrão do link
        const id = event.currentTarget.getAttribute('data-id');

        Swal.fire({
            title: 'Deseja Excluir o Vistoriador?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'Sim',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('vistoriador-' + id);
                if (form) {
                    form.submit();
                } else {
                    console.error("Formulário não encontrado: ", 'form-locloca-' + id);
                }
            }
        });
    }
</script>



@endsection