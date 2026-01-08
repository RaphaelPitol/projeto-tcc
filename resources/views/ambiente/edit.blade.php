@extends('layouts.app')
@section('title', 'Edição Ambientes')
@section('content')


<style>
    fieldset {
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 20px;
    }

    legend {
        font-size: 1.2rem;
        font-weight: bold;
        padding: 0 10px;
        width: auto;
        border: none;
    }

    .nav-tabs .nav-link {
        background: #A9A9A9;
        color: black;
    }

    .nav-tabs .nav-link.active {
        background-color: #363636;
        /* Cor de fundo da aba ativa */
        color: white;
        /* Cor do texto da aba ativa */
        border-color: #363636;
        /* Cor da borda da aba ativa */
    }

    /* Estilo customizado para quando o cursor está sobre a aba ativa */
    .nav-tabs .nav-link.active:hover {
        background-color: #708090;
        /* Cor de fundo ao passar o mouse */
        border-color: #708090;
        /* Cor da borda ao passar o mouse */
    }

    #voltar {
        background: orange;
    }
</style>

@php
$detalhes = json_decode($ambientes->detalhes);
@endphp


<div class="container h-100 mt-5">
    <h2>Edição de Ambiente</h2>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active btn my-1 ml-1" id="formPiso-tab" data-bs-toggle="tab" data-bs-target="#formPiso" type="button" role="tab" aria-controls="formPiso" aria-selected="true">Piso</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn my-1 ml-1" id="formRodape-tab" data-bs-toggle="tab" data-bs-target="#formRodape" type="button" role="tab" aria-controls="formRodape" aria-selected="false">Roda-pé</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn my-1 ml-1" id="formParede-tab" data-bs-toggle="tab" data-bs-target="#formParede" type="button" role="tab" aria-controls="formParede" aria-selected="false">Parede</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn my-1 ml-1" id="formTeto-tab" data-bs-toggle="tab" data-bs-target="#formTeto" type="button" role="tab" aria-controls="formTeto" aria-selected="false">Teto</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn my-1 ml-1" id="formPorta-tab" data-bs-toggle="tab" data-bs-target="#formPorta" type="button" role="tab" aria-controls="formPorta" aria-selected="false">Porta</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn my-1 ml-1" id="formJanela-tab" data-bs-toggle="tab" data-bs-target="#formJanela" type="button" role="tab" aria-controls="formJanela" aria-selected="false">Janela</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn my-1 ml-1" id="formEletrica-tab" data-bs-toggle="tab" data-bs-target="#formEletrica" type="button" role="tab" aria-controls="formEletrica" aria-selected="false">Eletrica</button>
        </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link btn my-1 ml-1" id="formAcessorios-tab" data-bs-toggle="tab" data-bs-target="#formAcessorios" type="button" role="tab" aria-controls="formAcessorios" aria-selected="false">Acessorios</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link btn my-1 ml-1" id="formFim-tab" data-bs-toggle="tab" data-bs-target="#formFim" type="button" role="tab" aria-controls="formFim" aria-selected="false">Finalizar</button>
        </li>
        <li class="nav-item" role="presentation">
            <a id="voltar" class=" btn nav-link my-1 ml-1" href="{{ route('ambiente.index', $ambientes->vistoria_id) }}" type="submit">Voltar</a>
        </li>
    </ul>

    <form id= 'form-ambiente' action="{{route('ambiente.update', $ambientes)}}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')
        <input type="text" name="vistoria_id" hidden value="{{$ambientes->vistoria_id}}">
        <label for="nome_ambiente">Nome Ambiente</label>
        <input type="text" class="form-control" name="nome_ambiente" value="{{$ambientes->nome_ambiente}}" required>

        <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade" id="formEletrica" role="tabpanel" aria-labelledby="formEletrica-tab">
                <div class="mb-3" id="formEletrica">

                    <fieldset>
                        <legend>Cadastro de Eletrica</legend>
                        <div id="interruptores-section">
                            <h4>Interruptores</h4>
                            <!-- Loop para exibir os interruptores já cadastrados vindos do banco -->
                            @if (isset($detalhes->tipoInterruptor))

                            @foreach($detalhes->tipoInterruptor as $index => $interruptor)
                            <div class="form-group row">
                                <!-- Campo de seleção do tipo de interruptor -->
                                <div class="col-md-5">
                                    <label for="tipoInterruptor">Tipo de Interruptor</label>
                                    <select class="form-control" name="tipoInterruptor[]">
                                        <!-- Loop para criar as opções do dropdown -->
                                        @if (isset($detalhes->tipoInterruptor))
                                        @foreach (Constants::interruptores as $opcao)
                                        @foreach($detalhes->tipoInterruptor as $index => $tipo)

                                        <option value="{{ $opcao }}" {{ $opcao == $tipo ? 'selected' : '' }}>{{ $opcao }}</option>
                                        @endforeach
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <!-- Campo de entrada para a quantidade de interruptores -->
                                <div class="col-md-5">
                                    <label for="quantidadeInterruptores">Quantidade de Interruptores</label>
                                    <input type="number" class="form-control" name="quantidadeInterruptores[]" value="{{ $detalhes->quantidadeInterruptores[$index] }}" placeholder="Digite a quantidade de interruptores">
                                </div>
                                <!-- Botão para remover o interruptor -->
                                <div class="col-md-2 d-flex align-items-center">
                                    <button type="button" class="btn btn-danger remove-interruptor">Remover</button>
                                </div>
                            </div>
                            @endforeach

                            @endif

                        </div>
                        <!-- Botão para adicionar novos interruptores -->
                        <button type="button" class="btn btn-secondary mb-3" id="add-interruptor">Adicionar Interruptor</button>

                        <!-- Seção para as tomadas -->
                        <div id="tomadas-section">
                            <h4>Tomadas</h4>
                            <!-- Loop para exibir as tomadas já cadastradas vindas do banco -->

                            @if (isset($detalhes->tipoTomada))

                            @foreach($detalhes->tipoTomada as $index => $tomada)
                            <div class="form-group row">
                                <!-- Campo de seleção do tipo de tomada -->
                                <div class="col-md-5">
                                    <label for="tipoTomada">Tipo de Tomada</label>
                                    <select class="form-control" name="tipoTomada[]">
                                        <!-- Loop para criar as opções do dropdown -->
                                        @foreach (Constants::tomadas as $opcao)
                                        <!-- Verifica se a opção deve ser selecionada com base no dado do banco -->
                                        <option value="{{ $opcao }}" {{ $opcao == $tomada ? 'selected' : '' }}>{{ $opcao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Campo de entrada para a quantidade de tomadas -->
                                <div class="col-md-5">
                                    <label for="quantidadeTomadas">Quantidade de Tomadas</label>
                                    <input type="number" class="form-control" name="quantidadeTomadas[]" value="{{ $detalhes->quantidadeTomadas[$index] }}" placeholder="Digite a quantidade de tomadas">
                                </div>
                                <!-- Botão para remover a tomada -->
                                <div class="col-md-2 d-flex align-items-center">
                                    <button type="button" class="btn btn-danger remove-tomada">Remover</button>
                                </div>
                            </div>
                            @endforeach

                            @endif

                        </div>
                        <!-- Botão para adicionar novas tomadas -->
                        <button type="button" class="btn btn-secondary mb-3" id="add-tomada">Adicionar Tomada</button>
                    </fieldset>
                </div>
            </div>

            <!-- Parte 1 -->
            <div class="tab-pane fade show active" id="formPiso" role="tabpanel" aria-labelledby="formPiso-tab">

                <div class="mb-3" id="formPiso">
                    <fieldset>
                        <legend>Cadastro de Piso</legend>
                        <div class="form-group">
                            <label for="piso">Tipo de Piso</label>
                            <select class="form-control" id="piso" name="piso">
                                <option value=""></option>
                                @foreach (Constants::pisos as $piso )
                                <option value="{{$piso}}" {{ $piso == $ambientes->piso ? 'selected' : '' }}>{{$piso}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_piso">Estado de Conservação do Piso</label>
                            <select class="form-control" id="cons_piso" name="cons_piso">
                                <option value="bom">Bom</option>
                                @foreach (Constants::estado as $cons )
                                <option value="{{$cons}}" {{ $cons == $ambientes->cons_piso ? 'selected' : $cons }}>{{$cons}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_piso">Descrição do Piso</label>
                            <select class="form-control" id="descricao_piso" name="descricao_piso[]" multiple>
                                @foreach (Constants::descricao_piso as $dado)
                                <option value="{{ $dado }}"
                                    {{ isset($detalhes->descricao_piso) && in_array($dado, $detalhes->descricao_piso ?? []) ? 'selected' : '' }}>
                                    {{ $dado }}
                                </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="observacao_piso">Observação do Piso</label>
                            <textarea class="form-control" id="observacao_piso" name="observacao_piso" rows="3">{{$ambientes->observacao_piso}}</textarea>
                        </div>
                    </fieldset>
                </div>
            </div>

            <div class="tab-pane fade" id="formRodape" role="tabpanel" aria-labelledby="formRodape-tab">
                <div class="mb-3" id="formRodape">
                    <fieldset>
                        <legend>Cadastro de Roda-pé</legend>
                        <div class="form-group">
                            <label for="rodape">Tipo de Rodapé</label>
                            <select class="form-control" id="rodape" name="rodape">
                                <option value=""></option>
                                @foreach (Constants::rodapes as $rodape )
                                <option value="{{$rodape}}" {{ $rodape == $ambientes->rodape ? 'selected' : '' }}>{{$rodape}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_rodape">Estado de Conservação do Rodapé</label>
                            <select class="form-control" id="cons_rodape" name="cons_rodape" value="{{$ambientes->cons_rodape}}">
                                <option value=""></option>
                                @foreach (Constants::estado_rodapes as $estado_rodape)
                                <option value="{{$estado_rodape}}" {{$estado_rodape == $ambientes->cons_rodape ? 'selected' : ''}}>{{$estado_rodape}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_rodape">Descrição do Rodapé</label>
                            <select class="form-control" id="descricao_rodape" name="descricao_rodape[]" multiple>
                                @foreach (Constants::descricao_rodapes as $descricao_rodape)
                                <option value="{{ $descricao_rodape }}"
                                    {{ isset($detalhes->descricao_rodape) && in_array($descricao_rodape, $detalhes->descricao_rodape ?? []) ? 'selected' : '' }}>
                                    {{ $descricao_rodape }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_rodape">Observação do Rodapé</label>
                            <textarea class="form-control" id="observacao_rodape" name="observacao_rodape" rows="3">{{$ambientes->observacao_rodape}}</textarea>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="tab-pane fade" id="formParede" role="tabpanel" aria-labelledby="formParede-tab">
                <div class="mb-3" id="formParede">
                    <fieldset>
                        <legend>Cadastro de Parede</legend>
                        <div class="form-group">
                            <label for="parede">Tipo de Parede</label>
                            <select class="form-control" id="parede" name="parede" value="{{$ambientes->parede}}">
                                <option value=""></option>
                                @foreach (Constants::tipos_paredes as $tipos_parede)
                                <option value="{{$tipos_parede}}" {{$tipos_parede == $ambientes->parede ? 'selected' : ''}}>{{$tipos_parede}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_parede">Estado de Conservação do Parede</label>
                            <select class="form-control" id="cons_parede" name="cons_parede">
                                <option value=""></option>
                                @foreach (Constants::estado_conservacao_paredes as $estado_conservacao_parede)
                                <option value="{{$estado_conservacao_parede}}" {{$estado_conservacao_parede == $ambientes->cons_parede ? 'selected' : ''}}>{{$estado_conservacao_parede}}</option>

                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cor_parede">Pintura</label>
                            <select class="form-control" id="cor_parede" name="cor_parede">
                                <option value=""></option>
                                @foreach ( Constants::cores as $cor)
                                <option value="{{$cor}}" {{$cor == $ambientes->cor_parede ? 'selected' : ''}}>{{$cor}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_parede">Conservação da Pintura</label>
                            <select class="form-control" id="cons_pintura_parede" name="cons_pintura_parede">
                                <option value=""></option>
                                @foreach (Constants::estado_pintura as $estado_pint)
                                <option value="{{$estado_pint}}" {{$estado_pint == $ambientes->cons_pintura_parede ? 'selected' : ''}}>{{$estado_pint}}</option>

                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_parede">Descrição da Parede</label>
                            <select class="form-control" id="descricao_parede" name="descricao_parede[]" multiple value="{{$ambientes->detalhes['descricao_parede'] ?? ''}}">
                                <option value=""></option>
                                @foreach (Constants::descricao_parede as $descricao_pared)
                                <option value="{{$descricao_pared}}"
                                    {{ isset($detalhes->descricao_parede) && in_array($descricao_pared, $detalhes->descricao_parede ?? []) ? 'selected' : '' }}>
                                    {{ $descricao_pared}}
                                </option>

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_parede">Observação da Parede</label>
                            <textarea class="form-control" id="observacao_parede" name="observacao_parede" rows="3">{{$ambientes->observacao_parede}}</textarea>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="tab-pane fade" id="formTeto" role="tabpanel" aria-labelledby="formTeto-tab">
                <div class="mb-3" id="formTeto">

                    <fieldset>
                        <legend>Cadastro de Teto</legend>

                        <div class="form-group">
                            <label for="teto">Tipo de Teto</label>
                            <select class="form-control" id="teto" name="teto" value="{{$ambientes->teto}}">
                                <option value=""></option>
                                @foreach (Constants::tipos_tetos as $tipos_teto)

                                <option value="{{$tipos_teto}}" {{$tipos_teto == $ambientes->teto ? 'selected' : ''}}>{{$tipos_teto}}</option>
                                @endforeach


                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_teto">Estado de Conservação do Teto</label>
                            <select class="form-control" id="cons_teto" name="cons_teto">

                                <option value=""></option>
                                @foreach ( Constants::estado_conservacao_teto as $conservacao_teto)
                                <option value="{{$conservacao_teto}}" {{$conservacao_teto == $ambientes->cons_teto ? 'selected' : ''}}>{{$conservacao_teto}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cor_teto">Pintura</label>
                            <select class="form-control" id="cor_teto" name="cor_teto">
                                <option value=""></option>
                                @foreach ( Constants::cores as $cor)
                                <option value="{{$cor}}" {{$cor == $ambientes->cor_teto ? 'selected' : ''}}>{{$cor}}</option>
                                @endforeach
                            </select>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_teto">Conservação Pintura</label>
                            <select class="form-control" id="cons_pintura_teto" name="cons_pintura_teto">
                                <option value=""></option>
                                @foreach (Constants::estado_pintura as $estado_pint)
                                <option value="{{$estado_pint}}" {{$estado_pint == $ambientes->cons_pintura_teto ? 'selected' : ''}}>{{$estado_pint}}</option>

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_teto">Descrição do Teto</label>
                            <select class="form-control" id="descricao_teto" name="descricao_teto[]" multiple>
                                <option value=""></option>
                                @foreach (Constants::descricao_teto as $descricao_teto)
                                <option value="{{$descricao_teto}}"
                                    {{ isset($detalhes->descricao_teto) && in_array($descricao_teto, $detalhes->descricao_teto ?? []) ? 'selected' : '' }}>{{$descricao_teto}}</option>

                                @endforeach
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_teto">Observação do Teto</label>
                            <textarea class="form-control" id="observacao_teto" name="observacao_teto" rows="3">{{$ambientes->observacao_teto}}</textarea>
                        </div>
                    </fieldset>
                </div>
            </div>

            <div class="tab-pane fade" id="formPorta" role="tabpanel" aria-labelledby="formPorta-tab">
                <div class="mb-3" id="formPorta">
                    <fieldset>
                        <legend>Cadastro de Porta</legend>

                        <div class="form-group">
                            <label for="porta">Tipo de Porta</label>
                            <select class="form-control" id="porta" name="porta" value="{{$ambientes->porta}}">
                                <option value=""></option>
                                @foreach (Constants::portas as $porta)
                                <option value="{{$porta}}" {{$porta == $ambientes->porta ? 'selected' : ''}}>{{$porta}}</option>
                                @endforeach
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_porta">Estado de Conservação da Porta</label>
                            <select class="form-control" id="cons_porta" name="cons_porta">
                                <option value=""></option>
                                @foreach (Constants::conservacao_porta as $conservacao)
                                <option value="{{$conservacao}}" {{$conservacao == $ambientes->cons_porta ? 'selected' : ''}}>
                                    {{$conservacao}}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cor_porta">Pintura</label>
                            <select class="form-control" id="cor_porta" name="cor_porta" value="{{$ambientes->cor_porta}}">
                                <option value=""></option>
                                @foreach (Constants::cores_portas_janelas as $cores_portas_janela)
                                <option value="{{$cores_portas_janela}}" {{$cores_portas_janela == $ambientes->cor_porta ? 'selected' : ''}}>{{$cores_portas_janela}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_porta">Conservação Pintura</label>
                            <select class="form-control" id="cons_pintura_porta" name="cons_pintura_porta" value="{{$ambientes->cons_pintura_porta}}">
                                <option value=""></option>
                                @foreach (Constants::estado_pintura as $estado_pint)
                                <option value="{{$estado_pint}}" {{$estado_pint == $ambientes->cons_pintura_porta ? 'selected' : ''}}>{{$estado_pint}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_porta">Descrição do Porta</label>
                            <select class="form-control" id="descricao_porta" name="descricao_porta[]" multiple>
                                @foreach ( Constants::descricao_porta as $descricao_port)
                                <option value="{{$descricao_port}}"
                                    {{ isset($detalhes->descricao_porta) && in_array($descricao_port, $detalhes->descricao_porta ?? []) ? 'selected' : '' }}>{{$descricao_port}}</option>

                                @endforeach
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_porta">Observação do Porta</label>
                            <textarea class="form-control" id="observacao_porta" name="observacao_porta" rows="3">{{$ambientes->observacao_porta}}</textarea>
                        </div>
                    </fieldset>
                </div>
            </div>

            <div class="tab-pane fade" id="formJanela" role="tabpanel" aria-labelledby="formJanela-tab">
                <div class="mb-3" id="formJanela">

                    <fieldset>

                        <legend>Cadastro de Janela</legend>

                        <div class="form-group">
                            <label for="janela">Tipo de Janela</label>
                            <select class="form-control" id="janela" name="janela">
                                <option value=""></option>
                                @foreach (Constants::tipos_janelas as $tipos_janela)
                                <option value="{{$tipos_janela}}" {{$tipos_janela == $ambientes->janela ? 'selected' : ''}}>
                                    {{$tipos_janela}}
                                </option>

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_janela">Estado de Conservação da Janela</label>
                            <select class="form-control" id="cons_janela" name="cons_janela">
                                <option value=""></option>
                                @foreach (Constants::conservacao_janela as $conservacao)
                                <option value="{{$conservacao}}" {{$conservacao == $ambientes->cons_janela ? 'selected' : ''}}>
                                    {{$conservacao}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cor_janela">Pintura</label>
                            <select class="form-control" id="cor_janela" name="cor_janela">
                                <option value=""></option>
                                @foreach (Constants::cores_portas_janelas as $cores_portas_janela)
                                <option value="{{$cores_portas_janela}}" {{$cores_portas_janela == $ambientes->cor_janela ? 'selected' : ''}}>{{$cores_portas_janela}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_janela">Conservação Pintura</label>
                            <select class="form-control" id="cons_pintura_janela" name="cons_pintura_janela">
                                <option value=""></option>
                                @foreach (Constants::estado_pintura as $estado_pint)
                                <option value="{{$estado_pint}}" {{$estado_pint == $ambientes->cons_pintura_janela ? 'selected' : ''}}>{{$estado_pint}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_janela">Descrição do Janela</label>
                            <select class="form-control" id="descricao_janela" name="descricao_janela[]" multiple>
                                @foreach ( Constants::descricao_janela as $descricao)
                                <option value="{{$descricao}}"
                                    {{ isset($detalhes->descricao_porta) && in_array($descricao, $detalhes->descricao_janela ?? []) ? 'selected' : '' }}>
                                    {{$descricao}}
                                </option>

                                @endforeach
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_janela">Observação do Janelas</label>
                            <textarea class="form-control" id="observacao_janela" name="observacao_janela" rows="3">{{$ambientes->observacao_janela}}</textarea>
                        </div>
                    </fieldset>
                </div>
            </div>
               <div class="tab-pane fade" id="formAcessorios" role="tabpanel" aria-labelledby="formAcessorios-tab">
                <div class="mb-3" id="formAcessorios">

                    <fieldset>

                        <legend>Cadastro de Acessorios</legend>

                        <div class="form-group">
                            <label for="descricao_acessorios">Acessorios</label>
                            <select class="form-control" id="descricao_acessorios" name="descricao_acessorios[]" multiple>
                                @foreach ( Constants::acessorios as $descricao)
                               <option value="{{$descricao}}"
                                    {{ isset($detalhes->descricao_acessorios) && in_array($descricao, $detalhes->descricao_acessorios ?? []) ? 'selected' : '' }}>
                                    {{$descricao}}
                                </option>
                                @endforeach
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_acessorios">Observação do Acessorios</label>
                            <textarea class="form-control" id="observacao_acessorios" name="observacao_acessorios" rows="3">
                            {{isset($detalhes->observacao_acessorios) ? $detalhes->observacao_acessorios: ''}}
                            </textarea>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
        <!-- Campo de observações gerais -->
        <div class="tab-pane fade" id="formFim" role="tabpanel" aria-labelledby="formFim-tab">
            <div class="mb-3" id="formFim">
                <div class="form-group">
                    <label for="observacoes">Observações</label>
                    <textarea class="form-control" id="observacoes" name="observacoes" rows="3" placeholder="Digite observações adicionais">{{$ambientes->observacoes}}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fotos do ambiente</label>

                    @if($fotos->count())
                    <div class="row mb-3">
                        @foreach($fotos as $foto)
                        <div class="col-4 col-md-2 mb-3 text-center">
                            <img
                                src="{{ asset('storage/' . $foto->imagem) }}"
                                class="img-fluid rounded border"
                                style="height: 120px; object-fit: cover;">

                            <div class="mt-1">
                                <button
                                    type="button"
                                    class="btn btn-sm btn-danger"
                                    onclick="removerFoto(`{{ $foto->id }}`)">
                                    Remover
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <input
                        type="file"
                        id="imagens"
                        name="imagens[]"
                        class="form-control"
                        multiple
                        accept="image/*">
                </div>
                <div id="preview-imagens" class="row g-2"></div>

                <!-- Botão de envio do formulário -->
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </div>
</div>
</form>
</div>

<!-- Scripts para manipulação de DOM e adição de elementos dinâmicos -->
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
<script>
    new MultiSelectTag('descricao_piso') // id
    new MultiSelectTag('descricao_rodape')
    new MultiSelectTag('descricao_parede')
    new MultiSelectTag('descricao_teto')
    new MultiSelectTag('descricao_porta')
    new MultiSelectTag('descricao_janela')
    new MultiSelectTag('descricao_acessorios')
    $(document).ready(function() {
        // Função para adicionar novos interruptores dinamicamente
        $('#add-interruptor').click(function() {
            $('#interruptores-section').append(`
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="tipoInterruptor">Tipo de Interruptor</label>
                            <select class="form-control" name="tipoInterruptor[]">
                                @foreach (Constants::interruptores as $dado)
                                <option>{{ $dado }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="quantidadeInterruptores">Quantidade de Interruptores</label>
                            <input type="number" class="form-control" name="quantidadeInterruptores[]" placeholder="Digite a quantidade de interruptores">
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button type="button" class="btn btn-danger remove-interruptor">Remover</button>
                        </div>
                    </div>
                `);

        });

        // Função para adicionar novas tomadas dinamicamente
        $('#add-tomada').click(function() {
            $('#tomadas-section').append(`
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="tipoTomada">Tipo de Tomada</label>
                            <select class="form-control" name="tipoTomada[]">
                                @foreach (Constants::tomadas as $dado)
                                <option>{{ $dado }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="quantidadeTomadas">Quantidade de Tomadas</label>
                            <input type="number" class="form-control" name="quantidadeTomadas[]" placeholder="Digite a quantidade de tomadas">
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button type="button" class="btn btn-danger remove-tomada">Remover</button>
                        </div>
                    </div>
                `);


        });

        // Função para remover um interruptor
        $(document).on('click', '.remove-interruptor', function() {
            $(this).closest('.form-group').remove();
        });

        // Função para remover uma tomada
        $(document).on('click', '.remove-tomada', function() {
            $(this).closest('.form-group').remove();
        });
    });

    $('#tomadas-section').on('input', 'input[name="quantidadeTomadas[]"]', function() {
        if ($(this).val() <= 0) {
            $(this).val('');
            Swal.fire({
                icon: 'error',
                title: 'Valor inválido!',
                text: 'A quantidade de tomadas não pode ser menor ou igual zero.',
                confirmButtonText: 'Entendido'
            });
        }
    });

    $('#interruptores-section').on('input', 'input[name="quantidadeInterruptores[]"]', function() {
        if ($(this).val() <= 0) {
            $(this).val('');
            Swal.fire({
                icon: 'error',
                title: 'Valor inválido!',
                text: 'A quantidade de interruptores não pode ser menor ou igual zero.',
                confirmButtonText: 'Entendido'
            });
        }
    });

    const input = document.getElementById('imagens');
    const preview = document.getElementById('preview-imagens');

    let arquivos = [];

    input.addEventListener('change', function() {
        const novosArquivos = Array.from(this.files);

        novosArquivos.forEach(novo => {
            // evita duplicar o mesmo arquivo
            const existe = arquivos.some(antigo =>
                antigo.name === novo.name &&
                antigo.size === novo.size &&
                antigo.lastModified === novo.lastModified
            );

            if (!existe) {
                arquivos.push(novo);
            }
        });
        input.value = '';

        renderizarPreview();
    });

    function renderizarPreview() {
        preview.innerHTML = '';

        arquivos.forEach((file, index) => {
            if (!file.type.startsWith('image/')) return;

            const reader = new FileReader();

            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-6 col-md-3 preview-item';
                col.draggable = true;
                col.dataset.index = index;

                col.innerHTML = `
                <div class="card shadow-sm position-relative">
                    <button
                        type="button"
                        class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                        onclick="removerImagem(${index})"
                    >✕</button>

                    <img src="${e.target.result}" class="card-img-top">
                </div>
            `;

                adicionarEventosDrag(col);
                preview.appendChild(col);
            };

            reader.readAsDataURL(file);
        });

        atualizarInput();
    }

    function removerImagem(index) {
        arquivos.splice(index, 1);
        renderizarPreview();
    }

    function atualizarInput() {
        const dataTransfer = new DataTransfer();
        arquivos.forEach(file => dataTransfer.items.add(file));
        input.files = dataTransfer.files;
    }

    /* ===== DRAG & DROP ===== */

    let dragIndex = null;

    function adicionarEventosDrag(elemento) {
        elemento.addEventListener('dragstart', function() {
            dragIndex = this.dataset.index;
            this.classList.add('dragging');
        });

        elemento.addEventListener('dragend', function() {
            this.classList.remove('dragging');
        });

        elemento.addEventListener('dragover', function(e) {
            e.preventDefault();
        });

        elemento.addEventListener('drop', function() {
            const dropIndex = this.dataset.index;

            if (dragIndex === dropIndex) return;

            const temp = arquivos[dragIndex];
            arquivos.splice(dragIndex, 1);
            arquivos.splice(dropIndex, 0, temp);

            renderizarPreview();
        });
    }

    function removerFoto(id) {
        if (!confirm('Remover esta foto?')) return;

        fetch(`/ambiente/foto/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(() => location.reload());
    }
    document.getElementById('form-ambiente').addEventListener('submit', function() {
        document.getElementById('loading-overlay').style.display = 'flex';
    });
</script>
<style>
    #loading-overlay {
        position: fixed;
        inset: 0;
        background: rgba(255, 255, 255, 0.85);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loading-box {
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .spinner {
        width: 60px;
        height: 60px;
        border: 6px solid #ddd;
        border-top-color: #0d6efd;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto 15px;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>


<div id="loading-overlay" style="display:none;">
    <div class="loading-box">
        <div class="spinner"></div>
        <p>Salvando ambiente e processando imagens…</p>
        <small>Isso pode levar alguns segundos</small>
    </div>
</div>

@endsection