@extends('layouts.appimobiliaria')
@section('title', 'Vistoria')
@section('content')

<section class="vh-100 mb-4">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-2">
                        <div class="row justify-content-center">
                            <div class="order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Edição de Vistoria</p>

                                <form action="{{ route('vistoria.update', $vistoria) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="id_imobiliaria" hidden value="{{Auth::user()->id}}">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label>Locador</label>
                                            <select name="id_locador" class="form-control">
                                                @foreach($locadores as $locador)
                                                <option value="{{ $locador->id }}" {{$locador->id == $vistoria->id_locador ? 'selected' : '' }}>{{ $locador->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-2">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label>Locatário</label>
                                            <select name="id_locatario" class="form-control">
                                                @foreach($locatarios as $locatario)
                                                <option value="{{ $locatario->id }}" {{$locatario->id == $vistoria->id_locatario ? 'selected' : '' }}>
                                                    {{ $locatario->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-2">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label>Vistoriador</label>
                                            <select name="id_vistoriador" class="form-control">
                                                @foreach($vistoriadores as $vistoriador)
                                                <option value="{{ $vistoriador->id }}" {{$vistoriador->id == $vistoria->id_vistoriador ? 'selected' : '' }}>
                                                    {{ $vistoriador->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="nome">Nome</label>
                                            <input type="text" id="nome" name="nome" class="form-control" value="{{$vistoria->nome}}" />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="cep">CEP</label>
                                            <input type="text" id="cep" name="cep" class="form-control" value="{{$vistoria->cep}}" required />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="logradouro">Rua</label>
                                            <input type="text" id="logradouro" name="logradouro" value="{{$vistoria->logradouro}}" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="numero">Número</label>
                                            <input type="text" id="numero" name="numero" value="{{$vistoria->numero}}" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="bairro">Bairro</label>
                                            <input type="text" id="bairro" name="bairro" value="{{$vistoria->bairro}}" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="cidade">Cidade</label>
                                            <input type="text" id="cidade" name="cidade" value="{{$vistoria->cidade}}" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="data_prazo">Data Prazo</label>
                                            <input type="date" id="data_prazo" name="data_prazo" value="{{$vistoria->data_prazo}}" class="form-control" required />
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Cadastrar</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('cep').addEventListener('blur', function() {
                        var cep = this.value.replace(/\D/g, '');
                        if (cep.length == 8) {
                            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                                .then(response => response.json())
                                .then(data => {
                                    if (!data.erro) {
                                        document.getElementById('logradouro').value = data.logradouro;
                                        document.getElementById('bairro').value = data.bairro;
                                        document.getElementById('cidade').value = data.localidade;
                                    } else {
                                        alert('CEP não encontrado.');
                                    }
                                });
                        }
                    });
                </script>

                @endsection