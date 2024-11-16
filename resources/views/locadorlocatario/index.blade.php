@extends('layouts.app')
@section('title', 'Edição')
@section('content')

<div class="container my-5">
    <div class="row gap-2 d-flex justify-content-between align-items-center">
        <h1 class="text-center ml-4">Locador/Locatarios</h1>
        <a class="btn btn-success mr-5" href="{{ route('locloca.create') }}">
            <i class="bi bi-plus-lg"></i> Cadastrar
        </a>
    </div>
    <div class="input-group my-2">
        <input type="text" class="form-control" id="search" placeholder="Buscar Locador/Locatario..." onkeyup="search()">
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
                        <th style="text-align: center;">Ações</th>
                    </tr>
                </thead>
            <tbody id="locloca">
                @foreach ( $locadorlocatarios as $locadorlocatario )
                <tr>
                    <th>{{$locadorlocatario->name}}</th>
                    <td>
                        {{$locadorlocatario->telefone}}
                    </td>
                    <td>{{$locadorlocatario->rg}}</td>
                    <td>{{$locadorlocatario->cpf}}</td>
                    <td>
                        <div style="display: flex; justify-content:center;">
                            <a href="{{route('locloca.edit', $locadorlocatario)}}" class="btn btn-primary" style="margin-right: 5px;"><i class="bi bi-pencil-fill"></i></a>
                            <form id="form-locloca-{{$locadorlocatario->id}}" action="{{route('locloca.destroy', $locadorlocatario)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" data-id="{{$locadorlocatario->id}}" onclick="excluirLocLoca(event)"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
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
    function excluirLocLoca(event) {
        event.preventDefault();
        const id = event.currentTarget.getAttribute('data-id');
        // console.log("Form ID:", 'form-locloca-' + id);
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
                const form = document.getElementById('form-locloca-' + id);
                if (form) {
                    form.submit();
                } else {
                    console.error("Formulário não encontrado: ", 'form-locloca-' + id);
                }
            }
        });
    }

    function search() {
            let input = document.getElementById('search');
            let filter = input.value.toLowerCase();
            let tbody = document.getElementById('locloca');
            let tr = tbody.getElementsByTagName('tr');

            for (let i = 0; i < tr.length; i++) {
                let txtValue = tr[i].textContent || tr[i].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
</script>
@endsection