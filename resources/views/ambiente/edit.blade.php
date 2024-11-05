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
</style>

@php
$pisos = [
'Cerâmica',
'Porcelanato',
'Madeira',
'Laminado',
'Vinílico',
'Cimento Queimado',
'Granito',
'Mármore',
'Carpete',
'Epóxi',
'Piso Elevado',
'Piso Térmico',
'Pedra São Tomé',
'Ardósia',
'Bambu',
'Ladrilho Hidráulico',
'Piso de Borracha',
'Piso de Resina',
'Piso de Taco',
'Piso de Concreto'
];
$estado = [
'Novo',
'Usado',
'Bom',
'Regular',
'Desgastado',
'Danificado',
'Em Reforma',
'Necessita Reparos',
'Restaurado',
'Inutilizável'
];
$descricao_piso = [
'Rachaduras',
'Desgaste',
'Manchas',
'Infiltração',
'Desnivelamento',
'Descolamento',
'Arranhões',
'Falta de Brilho',
'Afundamento',
'Quebras',
'Danos por Umidade',
'Desbotamento',
'Desgaste nas Juntas',
'Avarias por Termitas',
'Desgaste por Produtos Químicos',
'Danos por Impacto',
'Revestimento Solto',
'Trincas',
'Desgaste nas Bordas',
'Defeitos de Instalação'
];
$dados = ["sem furos", "sem manchas", "com manchas"];

$tomadasdobanco = ["Tomada 20A", "Tomada 10A dupla"];

$qtdtomadasdobanco = ["5", "2"];

$interruptoresdobanco = ["Interruptor Paralelo", "Interruptor Intermediario"];

$qtdinterruptoresdobanco = ["3", "4"];


$interruptores = ["Simples", "Duplo", "Triplo", "Interruptor Paralelo", "Interruptor Intermediário"];
$tomadas = ["Simples", "Duplo", "Triplo", "Tomada 20A", "Tomada 10A dupla"];
@endphp

@php
$detalhes = json_decode($ambientes->detalhes);
@endphp


<div class="container h-100 mt-5">
    <h2>Edição de Ambiente</h2>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="formPiso-tab" data-bs-toggle="tab" data-bs-target="#formPiso" type="button" role="tab" aria-controls="formPiso" aria-selected="true">Piso</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="formRodape-tab" data-bs-toggle="tab" data-bs-target="#formRodape" type="button" role="tab" aria-controls="formRodape" aria-selected="false">Roda-pé</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="formParede-tab" data-bs-toggle="tab" data-bs-target="#formParede" type="button" role="tab" aria-controls="formParede" aria-selected="false">Parede</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="formTeto-tab" data-bs-toggle="tab" data-bs-target="#formTeto" type="button" role="tab" aria-controls="formTeto" aria-selected="false">Teto</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="formPorta-tab" data-bs-toggle="tab" data-bs-target="#formPorta" type="button" role="tab" aria-controls="formPorta" aria-selected="false">Porta</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="formJanela-tab" data-bs-toggle="tab" data-bs-target="#formJanela" type="button" role="tab" aria-controls="formJanela" aria-selected="false">Janela</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="formEletrica-tab" data-bs-toggle="tab" data-bs-target="#formEletrica" type="button" role="tab" aria-controls="formEletrica" aria-selected="false">Eletrica</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="formFim-tab" data-bs-toggle="tab" data-bs-target="#formFim" type="button" role="tab" aria-controls="formFim" aria-selected="false">Finalizar</button>
        </li>
    </ul>

    <form action="{{route('ambiente.update', $ambientes)}}" method="POST">

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
                            @if (isset($interruptoresdobanco))

                            @foreach($interruptoresdobanco as $index => $interruptor)
                            <div class="form-group row">
                                <!-- Campo de seleção do tipo de interruptor -->
                                <div class="col-md-5">
                                    <label for="tipoInterruptor">Tipo de Interruptor</label>
                                    <select class="form-control" name="tipoInterruptor[]">
                                        <!-- Loop para criar as opções do dropdown -->
                                        @if (isset($detalhes->tipoInterruptor))
                                        @foreach ($interruptores as $opcao)
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
                                    <input type="number" class="form-control" name="quantidadeInterruptores[]" value="{{ $qtdinterruptoresdobanco[$index] }}" placeholder="Digite a quantidade de interruptores">
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

                            @if (isset($tomadasdobanco))

                            @foreach($tomadasdobanco as $index => $tomada)
                            <div class="form-group row">
                                <!-- Campo de seleção do tipo de tomada -->
                                <div class="col-md-5">
                                    <label for="tipoTomada">Tipo de Tomada</label>
                                    <select class="form-control" name="tipoTomada[]" value="{{$ambientes->detalhes['tipoTomada'] ?? ''}}">
                                        <!-- Loop para criar as opções do dropdown -->
                                        @foreach ($tomadas as $opcao)
                                        <!-- Verifica se a opção deve ser selecionada com base no dado do banco -->
                                        <option value="{{ $opcao }}" {{ $opcao == $tomada ? 'selected' : '' }}>{{ $opcao }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Campo de entrada para a quantidade de tomadas -->
                                <div class="col-md-5">
                                    <label for="quantidadeTomadas">Quantidade de Tomadas</label>
                                    <input type="number" class="form-control" name="quantidadeTomadas[]" value="{{ $qtdtomadasdobanco[$index] }}" placeholder="Digite a quantidade de tomadas">
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
                                @foreach ($pisos as $piso )
                                <option value="{{$piso}}" {{ $piso == $ambientes->piso ? 'selected' : '' }}>{{$piso}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_piso">Estado de Conservação do Piso</label>
                            <select class="form-control" id="cons_piso" name="cons_piso">
                                <option value="bom">Bom</option>
                                @foreach ($estado as $cons )
                                <option value="{{$cons}}" {{ $cons == $ambientes->cons_piso ? 'selected' : $cons }}>{{$cons}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_piso">Descrição do Piso</label>
                            <select class="form-control" id="descricao_piso" name="descricao_piso[]" multiple>
                                @foreach ($descricao_piso as $dado)
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
                            <select class="form-control" id="rodape" name="rodape" value="{{$ambientes->rodape}}">
                                <option value="ceramica">Cerâmica</option>
                                <option value="porcelanato">Porcelanato</option>
                                <option value="madeira">Madeira</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_rodape">Estado de Conservação do Rodapé</label>
                            <select class="form-control" id="cons_rodape" name="cons_rodape" value="{{$ambientes->cons_rodape}}">
                                <option value="bom">Bom</option>
                                <option value="regular">Regular</option>
                                <option value="ruim">Ruim</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_rodape">Descrição do Rodapé</label>
                            <select class="form-control" id="descricao_rodape" name="descricao_rodape[]" multiple value="{{$ambiente->detalhes['descricao_rodape'] ?? ''}}">
                                <option value="em todo o contorno, inteiros">Em todo o contorno, inteiros</option>
                                <option value="faltando em alguns pontos, rachados">Faltando em alguns pontos, rachados</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_rodape">Observação do Rodapé</label>
                            <textarea class="form-control" id="observacao_rodape" name="observacao_rodape" rows="3" value="{{$ambientes->observacao_rodape}}"></textarea>
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
                                <option value="alvenaria">Alvenaria</option>
                                <option value="ceramica">Cerâmica</option>
                                <option value="porcelanato">Porcelanato</option>
                                <option value="madeira">Madeira</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_parede">Estado de Conservação do Parede</label>
                            <select class="form-control" id="cons_parede" name="cons_parede" value="{{$ambientes->cons_parede}}">
                                <option value="bom">Bom</option>
                                <option value="regular">Regular</option>
                                <option value="ruim">Ruim</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cor_parede">Pintura</label>
                            <select class="form-control" id="cor_parede" name="cor_parede" value="{{$ambientes->cor_parede}}">
                                <option value="branco">Branco</option>
                                <option value="preto">Preto</option>
                                <option value="roxo">Roxo</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_parede">Conservação da Pintura</label>
                            <select class="form-control" id="cons_pintura_parede" name="cons_pintura_parede" value="{{$ambientes->cons_pintura_parede}}">
                                <option value="bom">Bom</option>
                                <option value="regular">Regular</option>
                                <option value="ruim">Ruim</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_parede">Descrição da Parede</label>
                            <select class="form-control" id="descricao_parede" name="descricao_parede[]" multiple value="{{$ambientes->detalhes['descricao_parede'] ?? ''}}">
                                <option value="sem furos, sem manchas">Sem furos, sem manchas</option>
                                <option value="com furos, pequenas manchas">Com furos, pequenas manchas</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_parede">Observação da Parede</label>
                            <textarea class="form-control" id="observacao_parede" name="observacao_parede" rows="3" value="{{$ambientes->observacao_parede}}"></textarea>
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
                                <option value="ceramica">Laje</option>
                                <option value="ceramica">Forro</option>
                                <option value="porcelanato">Gesso</option>
                                <option value="madeira">Madeira</option>
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_teto">Estado de Conservação do Teto</label>
                            <select class="form-control" id="cons_teto" name="cons_teto" value="{{$ambientes->cons_teto}}">
                                <option value="bom">Bom</option>
                                <option value="regular">Regular</option>
                                <option value="ruim">Ruim</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cor_teto">Pintura</label>
                            <select class="form-control" id="cor_teto" name="cor_teto" value="{{$ambientes->cor_teto}}">
                                <option value="branco">Branco</option>
                                <option value="preto">Preto</option>
                                <option value="roxo">Roxo</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_teto">Conservação Pintura</label>
                            <select class="form-control" id="cons_pintura_teto" name="cons_pintura_teto" value="{{$ambientes->cons_pintura_teto}}">
                                <option value="bom">Bom</option>
                                <option value="regular">Regular</option>
                                <option value="ruim">Ruim</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_teto">Descrição do Teto</label>
                            <select class="form-control" id="descricao_teto" name="descricao_teto[]" multiple value="{{$ambientes->detalhes['descricao_teto'] ?? ''}}">
                                <option value="sem furos, sem manchas">Sem furos, sem manchas</option>
                                <option value="com furos, pequenas manchas">Com furos, pequenas manchas</option>
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_teto">Observação do Teto</label>
                            <textarea class="form-control" id="observacao_teto" name="observacao_teto" rows="3" value="{{$ambientes->observacao_teto}}"></textarea>
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
                                <option value="Vidro de correr">Vidro de correr</option>
                                <option value="Madeira de corre">Madeira de corre</option>
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_porta">Estado de Conservação da Porta</label>
                            <select class="form-control" id="cons_porta" name="cons_porta" value="{{$ambientes->cons_porta}}">
                                <option value="bom">Bom</option>
                                <option value="regular">Regular</option>
                                <option value="ruim">Ruim</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cor_porta">Pintura</label>
                            <select class="form-control" id="cor_porta" name="cor_porta" value="{{$ambientes->cor_porta}}">
                                <option value="branco">Branco</option>
                                <option value="preto">Preto</option>
                                <option value="roxo">Roxo</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_porta">Conservação Pintura</label>
                            <select class="form-control" id="cons_pintura_porta" name="cons_pintura_porta" value="{{$ambientes->cons_pintura_porta}}">
                                <option value="bom">Bom</option>
                                <option value="regular">Regular</option>
                                <option value="ruim">Ruim</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_porta">Descrição do Porta</label>
                            <select class="form-control" id="descricao_porta" name="descricao_porta[]" multiple value="{{$ambientes->detalhes['descricao_porta'] ?? ''}}">
                                <option value="com furos, pequenas manchas">Abre e fecha bem</option>
                                <option value="sem furos, sem manchas">Sem furos, sem manchas</option>
                                <option value="com furos, pequenas manchas">pequenas manchas</option>
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_porta">Observação do Porta</label>
                            <textarea class="form-control" id="observacao_porta" name="observacao_porta" rows="3" value="{{$ambientes->observacao_porta}}"></textarea>
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
                            <select class="form-control" id="janela" name="janela" value="{{$ambientes->janela}}">
                                <option value="ceramica">Vidro de correr</option>
                                <option value="ceramica">Madeira de corre</option>
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_janela">Estado de Conservação da Janela</label>
                            <select class="form-control" id="cons_janela" name="cons_janela" value="{{$ambientes->cons_janela}}">
                                <option value="bom">Bom</option>
                                <option value="regular">Regular</option>
                                <option value="ruim">Ruim</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cor_janela">Pintura</label>
                            <select class="form-control" id="cor_janela" name="cor_janela" value="{{$ambientes->cor_janela}}">
                                <option value="branco">Branco</option>
                                <option value="preto">Preto</option>
                                <option value="roxo">Roxo</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_janela">Conservação Pintura</label>
                            <select class="form-control" id="cons_pintura_janela" name="cons_pintura_janela" value="{{$ambientes->cons_pintura_janela}}">
                                <option value="bom">Bom</option>
                                <option value="regular">Regular</option>
                                <option value="ruim">Ruim</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_janela">Descrição do Janela</label>
                            <select class="form-control" id="descricao_janela" name="descricao_janela[]" multiple value="{{$ambientes->detalhes['descricao_janela'] ?? ''}}">
                                <option value="com furos, pequenas manchas">Abre e fecha bem</option>
                                <option value="sem furos, sem manchas">Sem furos, sem manchas</option>
                                <option value="com furos, pequenas manchas">pequenas manchas</option>
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_janela">Observação do Janelas</label>
                            <textarea class="form-control" id="observacao_janela" name="observacao_janela" rows="3" value="{{$ambientes->obesrvacao_janela}}"></textarea>
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
                    <textarea class="form-control" id="observacoes" name="observacoes" rows="3" placeholder="Digite observações adicionais" value="{{$ambientes->observacao}}"></textarea>
                </div>

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
    $(document).ready(function() {
        // Função para adicionar novos interruptores dinamicamente
        $('#add-interruptor').click(function() {
            $('#interruptores-section').append(`
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="tipoInterruptor">Tipo de Interruptor</label>
                            <select class="form-control" name="tipoInterruptor[]">
                                @foreach ($interruptores as $dado)
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
                                @foreach ($tomadas as $dado)
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
</script>

@endsection