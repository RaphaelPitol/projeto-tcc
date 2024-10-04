@extends('layouts.app')
@section('title', 'Piso')
@section('content')

@php
$tipos = ["Ceramica", "Porcelanato", "Açoalho"]
@endphp

<div class="container mt-5">
    <h2 class="mb-4">Cadastrar Tipo de Piso</h2>

    <form action="" method="POST">
        @csrf
        <div class="row align-items-end mb-3">
            <div class="col-auto">
                <label for="tipo" class="form-label">Novo Tipo de Piso</label>
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Digite o tipo de piso" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
            </div>
        </div>
    </form>

    <div class="input-group mt-5">
        <span class="input-group-text" id="basic-addon1">
            <i class="bi bi-search"></i>
        </span>
        <input type="text" class="form-control" id="search" placeholder="Buscar tipo de piso..." onkeyup="searchFunction()">
    </div>


    <div class="mt-3">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Tipos de Piso</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tipos as $tipo)
                <tr>
                    <td>{{ $tipo }}</td>
                    <td class="text-end" style="width: 150px;">
                        <div class="d-flex justify-content-between">
                            <a href="" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a>
                            <form action="" method="POST">
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


    <!-- <div class="mt-3">
         $tipos->links()
    </div> -->
</div>

</div>

<script>
    function searchFunction() {
        let input = document.getElementById('search');
        let filter = input.value.toLowerCase();
        let ul = document.getElementById('lista-tipos');
        let li = ul.getElementsByTagName('li');

        for (let i = 0; i < li.length; i++) {
            let txtValue = li[i].textContent || li[i].innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>

@endsection