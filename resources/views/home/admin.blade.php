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
                <tr>
                    <td>{{$imobiliaria->name}}</td>
                    <th>{{$imobiliaria->razao_social}}</th>
                    <td>{{$imobiliaria->email}}</td>
                    <td>{{$imobiliaria->telefone}}</td>
                    <td style="display: flex; flex-direction: row;">

                            <a href="" class="btn btn-primary" style="margin-right: 5px;">Edit</a>
                            <form action="" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Deseja realmente deletar?')">Delete</button>
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

@endsection