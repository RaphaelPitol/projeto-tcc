@extends('layouts.appadmin')
@section('title', 'Piso')
@section('content')

@php
$tipos = ["Gesso", "Alvenaria", "Drywall"]
@endphp


<div class="container mt-5">
    <h2 class="mb-4">Cadastrar Tipo de Parede</h2>

    <form action="{{route('parede.store')}}" method="POST">
        @csrf
        <div class="row align-items-end mb-3">
            <div class="col-auto">
                <label for="tipo" class="form-label">Novo Tipo de Piso</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Digite o tipo de parede" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success w-100">Cadastrar</button>
            </div>
        </div>
    </form>

    <div class="input-group mt-5">
        <span class="input-group-text" id="basic-addon1">
            <i class="bi bi-search"></i>
        </span>
        <input type="text" class="form-control" id="search" placeholder="Buscar tipo de parede..." onkeyup="searchFunction()">
    </div>


    <div class="mt-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tipos de Parede</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody id="lista-tipos">
                @foreach($paredes as $parede)
                <tr>
                    <td>{{ $parede->tipo }}</td>
                    <td class="text-end" style="width: 150px;">
                        <div class="d-flex justify-content-between">
                            <a href="javascript:void(0)"
                                class="btn btn-primary edit-parede-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#editParedeModal"
                                data-id="{{ $parede->id }}"
                                data-tipo="{{ $parede->tipo }}">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{route('parede.destroy', $parede)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Deseja realmente deletar?')"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="editParedeModal" tabindex="-1" aria-labelledby="editParedeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editParedeModalLabel">Editar Tipo de Piso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form id="editParedeForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Parede</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function searchFunction() {
        let input = document.getElementById('search');
        let filter = input.value.toLowerCase();
        let tbody = document.getElementById('lista-tipos');
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


    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-parede-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const paredeId = this.getAttribute('data-id');
                const paredeTipo = this.getAttribute('data-tipo');

                // Preencher o formulário com os dados do piso
                const form = document.getElementById('editParedeForm');
                form.action = `/parede/${paredeId}`; // Definir a URL do formulário
                form.querySelector('#tipo').value = paredeTipo; // Preencher o input tipo
            });
        });
    });
</script>

@endsection