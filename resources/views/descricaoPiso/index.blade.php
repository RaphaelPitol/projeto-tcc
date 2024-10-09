@extends('layouts.appadmin')
@section('title', 'DescricaoPiso')
@section('content')

@php
$descricao = ["Bom", "Novo", "Com Ranhuras"]
@endphp


<div class="container mt-5">
    <h2 class="mb-4">Cadastrar Descrição de Piso</h2>

    <form action="{{route('descricaoPiso.store')}}" method="POST">
        @csrf
        <div class="row align-items-end mb-3">
            <div class="col-auto">
                <label for="descricao_piso" class="form-label">Nova Descrição de Piso</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Digite a descrição do piso" required>
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
        <input type="text" class="form-control" id="search" placeholder="Buscar descrição de piso..." onkeyup="searchFunction()">
    </div>


    <div class="mt-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Descrição de Piso</th>
                    <th class="text-end">Ações</th>
                </tr>
            </thead>
            <tbody id="lista-descricao">
                @foreach($descricao_pisos as $descricao)
                <tr>
                    <td>{{ $descricao->descricao }}</td>
                    <td class="text-end" style="width: 150px;">
                        <div class="d-flex justify-content-between">
                            <a href="javascript:void(0)"
                                class="btn btn-primary edit-descricao-piso-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#editDescricaoPisoModal"
                                data-id="{{ $descricao->id }}"
                                data-descricao="{{ $descricao->descricao }}">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{route('descricaoPiso.destroy', $descricao)}}" method="POST">
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
<div class="modal fade" id="editDescricaoPisoModal" tabindex="-1" aria-labelledby="editDescricaoPisoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDescricaoPisoModalLabel">Editar Descrição do Piso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>
            <div class="modal-body">
                <form id="editDescricaoPisoForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="descricaoPiso" class="form-label">Descrição do Piso</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" required>
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
        let tbody = document.getElementById('lista-descricao');
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
        const editButtons = document.querySelectorAll('.edit-descricao-piso-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const descricaoPisoId = this.getAttribute('data-id');
                const descricaoPisoDescricao = this.getAttribute('data-descricao');

                // Preencher o formulário com os dados do piso
                const form = document.getElementById('editDescricaoPisoForm');
                form.action = `/descricaoPiso/${descricaoPisoId}`; // Definir a URL do formulário
                form.querySelector('#descricao').value = descricaoPisoDescricao; // Preencher o input tipo
            });
        });
    });
</script>

@endsection