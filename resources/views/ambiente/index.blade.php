@extends('layouts.app')
@section('title', 'Ambientes')
@section('content')

@if(!empty($message))

<script>
    document.addEventListener('DOMContentLoaded', () => {
        Swal.fire({
            icon: "{{ $message['type'] }}",
            title: "{{ $message['text']}}"
        });
    })
</script>

@endif

<div class="container">
    <div class="row gap-2 d-flex justify-content-between align-items-center">
        <h1 class="text-center ml-4">Ambientes Cadastrados</h1>
        <a class="btn btn-success mr-5" href="{{ route('ambiente.create', $id) }}">
            <i class="bi bi-plus-lg"></i> Cadastrar
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
            <tbody>
                <tr>
                    @foreach($ambientes as $ambiente)
                    <th>{{$ambiente->nome_ambiente}}</th>
                    <th>
                        <a href="" class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></a>

                        <a type="submit" class="btn btn-outline-danger" onclick= delet()><i class="bi bi-trash-fill"></i></a>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function delet() {
        Swal.fire({
            title: "Deletar?",
            text: "Você não poderá reverter isso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sim, deletar!"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            }
        });
    }
</script>
@endsection