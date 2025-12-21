@extends('layouts.app')
@section('title', 'Piso')
@section('content')

<div class="container my-5">

    <div class="row gap-2 d-flex justify-content-between align-items-center">
        <h1 class="text-center ml-4">Imobiliárias</h1>
        <a class="btn btn-success mr-5" href="{{route(name: 'imobiliaria')}}">
            <i class="bi bi-plus-lg"></i> Cadastrar
        </a>
    </div>
    <div class="input-group my-2">
        <span class="input-group-text" id="basic-addon1">
            <i class="bi bi-search"></i>
        </span>
        <input type="text" class="form-control" id="search" placeholder="Buscar imobiliárias..." onkeyup="searchFunction()">
    </div>


    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Fantasia</th>
                    <th>Razão Social</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody id="imobiliarias">
                @foreach($imobiliarias as $imobiliaria)
                <tr class="{{ $imobiliaria->ativo ? '' : 'bg-secondary text-white' }}">
                    <td>{{$imobiliaria->name}}</td>
                    <th>{{$imobiliaria->razao_social}}</th>
                    <td>{{$imobiliaria->email}}</td>
                    <td>{{$imobiliaria->telefone}}</td>
                    <td >
                        <div style="display: flex; ">

                            <a href="{{route('edit.user', $imobiliaria)}}" class="btn btn-primary" style="margin-right: 5px;"><i class="bi bi-pencil-fill"></i></a>
                            <form id="form-inativa-{{$imobiliaria->id}}" action="{{ route('update.user', $imobiliaria) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input  type="numer" name="ativo" value="{{ $imobiliaria->ativo ? 0 : 1 }}" hidden>
                                <button class="btn btn-danger" data-id="{{$imobiliaria->id}}" onclick="inativar(event)">
                                    <i id="ativo" class="bi {{ $imobiliaria->ativo ? 'bi-toggle-on' : 'bi-toggle-off' }}"></i>
                                </button>
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
            title: 'Erros de validação',
            text: "{{ implode(', ', $errors->all()) }}"
        });
    });
</script>
@endif

<script>
      function searchFunction() {
        let input = document.getElementById('search');
        let filter = input.value.toLowerCase();
        let tbody = document.getElementById('imobiliarias');
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


    function inativar(event) {
        event.preventDefault();
        const id = event.currentTarget.getAttribute('data-id');
        // console.log("Form ID:", 'form-locloca-' + id);
        Swal.fire({
            title: 'Deseja Ativar ou Inativar esta Imobiliaria?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'Sim',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('form-inativa-' + id);
                if (form) {
                    form.submit();
                } else {
                    console.error("Formulário não encontrado: ", 'form-inativa-' + id);
                }
            }
        });
    }
</script>

@endsection