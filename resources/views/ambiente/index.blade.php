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

<div class="container my-4">
    <div class="row mb-3 d-flex justify-content-between align-items-center">
        <div class="col-md-8 text-center text-md-start">
            <h2>Ambientes - <a href="{{route('show.vistoria', $id)}}">{{ $dados}}</a></h2>
        </div>
        <div class="col-md-4 text-md-end text-center">
            <a class="btn btn-success" href="{{ route('ambiente.create', $id) }}">
                <i class="bi bi-plus-lg"></i> Cadastrar
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="col-9">Nome</th>
                    <th class="col-3">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ambientes as $ambiente)
                <tr>
                    <td>{{ $ambiente->nome_ambiente }}</td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="{{ route('ambiente.edit', $ambiente) }}" class="btn btn-primary mr-2">
                                <i class="bi bi-pencil-fill"></i>
                            </a>

                            <form id="form-deletAmbiente-{{$ambiente->id}}" action="{{ route('ambiente.destroy', $ambiente) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" data-id="{{$ambiente->id}}" onclick="excluirAmbiente(event)">
                                    <i class="bi bi-trash-fill"></i>
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

@if (session('detalhes'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: "center",
                icon: "warning",
                title: "Endereço!",
                html: `
                {{ session('detalhes')->nome }} </br>
                Logradouro: {{ session('detalhes')->logradouro }}-{{ session('detalhes')->numero}}</br>
                Bairro: {{ session('detalhes')->bairro }}</br>
                Cidade: {{ session('detalhes')->cidade }}
                `,
                showConfirmButton: true,

            });
        });
    </script>
    @endif


<script>
    function excluirAmbiente(event) {
        event.preventDefault();
        const id = event.currentTarget.getAttribute('data-id');
        // console.log("Form ID:", 'form-locloca-' + id);
        Swal.fire({
            title: 'Deseja Excluir Ambiente?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: 'Sim',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('form-deletAmbiente-' + id);
                if (form) {
                    form.submit();
                } else {
                    console.error("Formulário não encontrado: ", 'form-deletAmbiente-' + id);
                }
            }
        });
    }
</script>
@endsection
