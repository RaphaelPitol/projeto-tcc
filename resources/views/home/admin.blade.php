@extends('layouts.app')
@section('title', 'Piso')
@section('content')

<div class="container">

    <div class="row gap-2 d-flex justify-content-between align-items-center">
        <h1 class="text-center ml-4">Imobiliarias</h1>
        <a class="btn btn-success mr-5" href="{{route(name: 'imobiliaria')}}">
            <i class="bi bi-plus-lg"></i> Cadastrar
        </a>
    </div>


    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Fantasia</th>
                    <th>Razão Social</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
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
                                <input type="numer" name="ativo" value="{{ $imobiliaria->ativo ? 0 : 1 }}" hidden>
                                <button class="btn btn-danger" data-id="{{$imobiliaria->id}}" onclick="inativar(event)">
                                    <i class="bi {{ $imobiliaria->ativo ? 'bi-toggle-off' : 'bi-toggle-on' }}"></i>
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