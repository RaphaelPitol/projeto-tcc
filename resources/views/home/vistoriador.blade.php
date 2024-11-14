@extends('layouts.app')
@section('title', 'Piso')
@section('content')


<h1 class="text-center mt-1">Vistorias</h1>
<!-- <div class="container mt-5 text-right">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-lg">
                            <i class="bi bi-plus-lg"></i> Vistoria
                        </button>
                    </div>
                </div> -->
<div class="container mt-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white text-center">
                        <h3 class="card-title">Realizadas</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>Vistoria</th>
                                    <th>Finalizada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($realizadas))
                                @foreach ($realizadas as $realizada)
                                <tr>
                                    <td><a href="{{route('pdf.geraPDF', $realizada)}}" target="_blank">{{$realizada->nome}}-{{$realizada->locador->name}}</a>

                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            {{\Carbon\Carbon::parse( $realizada->updated_at)->format('d/m/Y') }}
                                            <!-- <button class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></button> -->
                                            <!-- <button class="btn btn-outline-secondary"><i class="bi bi-filetype-pdf"></i></button> -->
                                            <!-- <button class="btn btn-outline-danger"><i class="bi bi-trash-fill"></i></button> -->
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-white text-center">
                        <h3 class="card-title">Pendentes</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>Vistoria</th>
                                    <th>Prazo</th>
                                    <th style="text-align: center;">Ações</th>
                                </tr>
                            </thead>
                            @if (isset($pendentes))
                            @foreach ($pendentes as $pendente)
                            <tr>
                                <td>
                                    <a href="{{ route('ambiente.index', $pendente) }}" type="submit">
                                        {{$pendente->nome}} - {{$pendente->locador->name}}
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($pendente->data_prazo)->format('d/m/Y') }}</td>
                                <td>
                                    <div class="row w-100 mx-0 text-center align-items-center">
                                        <!-- Ícone de Localização -->
                                        <div class="col-auto p-2">
                                            <a href="#" onclick="buscarRota('{{$pendente->logradouro}}', '{{$pendente->numero}}', '{{$pendente->cidade}}')" title="Ver rota no Google Maps" class="btn btn-light p-0">
                                            <i class="fas fa-map-marker-alt text-primary" style="font-size: 1.5rem;"></i>
                                            </a>
                                        </div>
                                        <!-- Botão de Status -->
                                        <div class="col-auto p-2">
                                            <form id="form-pendente-status-{{$pendente->id}}" action="{{route('vistoria.status', $pendente)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="status" value="1" hidden>
                                                <button class="btn btn-outline-danger p-1" data-id="{{$pendente->id}}" onclick="confirm(event)" title="Mudar status">
                                                    <i class="bi bi-hourglass"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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

    <script>
        function confirm(event) {
            event.preventDefault(); // Previne o comportamento padrão do link
            const id = event.currentTarget.getAttribute('data-id');

            Swal.fire({
                title: 'Deseja mudar o Status?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('form-pendente-status-' + id);
                    console.log(form);
                    if (form) {
                        form.submit();
                    } else {
                        console.error("Formulário não encontrado: ", 'form-pendente-status-' + id);
                    }
                }
            });
        }

        function buscarRota(logradouro, numero, cidade) {
            const enderecoImovel = `${logradouro}, ${numero}, ${cidade}`;

            // Verifica se o navegador suporta a API de Geolocalização
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Constrói a URL para abrir no Google Maps
                    const googleMapsUrl = `https://www.google.com/maps/dir/${latitude},${longitude}/${encodeURIComponent(enderecoImovel)}`;
                    window.open(googleMapsUrl, '_blank');
                }, function(error) {
                    alert('Não foi possível obter a localização atual.');
                });
            } else {
                alert('Geolocalização não é suportada neste navegador.');
            }
        }
    </script>

    @endsection