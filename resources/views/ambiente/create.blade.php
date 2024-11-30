@extends('layouts.app')
@section('title', 'Quarto')
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



<div class="container h-100 mt-5">
    <h2>Cadastro de Ambiente</h2>

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
            <button class="nav-link btn my-1 ml-1" id="formFim-tab" data-bs-toggle="tab" data-bs-target="#formFim" type="button" role="tab" aria-controls="formFim" aria-selected="false">Finalizar</button>
        </li>
        <li class="nav-item" role="presentation">
            <a id="voltar" class=" btn nav-link my-1 ml-1" href="{{ route('ambiente.index', $id) }}" type="submit">Voltar</a>
        </li>
    </ul>

    <form action="{{route('ambiente.store')}}" method="POST">

        @csrf
        <input type="text" name="vistoria_id" hidden value="{{$id}}">
        <label for="nome_ambiente">Nome Ambiente</label>
        <input type="text" class="form-control" name="nome_ambiente" required>

        <div class="tab-content mt-3" id="myTabContent">
            <div class="tab-pane fade" id="formEletrica" role="tabpanel" aria-labelledby="formEletrica-tab">
                <div class="mb-3" id="formEletrica">

                    <fieldset>
                        <legend>Cadastro de Eletrica</legend>
                        <div id="interruptores-section">

                        </div>
                        <!-- Botão para adicionar novos interruptores -->
                        <button type="button" class="btn btn-secondary mb-3" id="add-interruptor">Adicionar Interruptor</button>

                        <!-- Seção para as tomadas -->
                        <div id="tomadas-section">
                            <h4>Tomadas</h4>

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
                                <option value="{{$piso}}">{{$piso}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_piso">Estado de Conservação do Piso</label>
                            <select class="form-control" id="cons_piso" name="cons_piso">
                                <option value=""></option>
                                @foreach (Constants::estado as $cons )
                                <option value="{{$cons}}">{{$cons}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_piso">Descrição do Piso</label>
                            <select class="form-control" id="descricao_piso" name="descricao_piso[]" multiple>
                                @foreach (Constants::descricao_piso as $dado)
                                <option value="{{ $dado }}">{{ $dado }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="observacao_piso">Observação do Piso</label>
                            <textarea class="form-control" id="observacao_piso" name="observacao_piso" rows="3"></textarea>
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
                                <option value="{{$rodape}}">{{$rodape}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_rodape">Estado de Conservação do Rodapé</label>
                            <select class="form-control" id="cons_rodape" name="cons_rodape">
                                <option value=""></option>
                                @foreach (Constants::estado_rodapes as $estado_rodape)
                                <option value="{{$estado_rodape}}">{{$estado_rodape}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_rodape">Descrição do Rodapé</label>
                            <select class="form-control" id="descricao_rodape" name="descricao_rodape[]" multiple>
                                @foreach (Constants::descricao_rodapes as $descricao_rodape)
                                <option value="{{ $descricao_rodape }}">{{ $descricao_rodape }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_rodape">Observação do Rodapé</label>
                            <textarea class="form-control" id="observacao_rodape" name="observacao_rodape" rows="3"></textarea>
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
                            <select class="form-control" id="parede" name="parede">
                                <option value=""></option>
                                @foreach (Constants::tipos_paredes as $tipos_parede)
                                <option value="{{$tipos_parede}}">{{$tipos_parede}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_parede">Estado de Conservação do Parede</label>
                            <select class="form-control" id="cons_parede" name="cons_parede">
                                <option value=""></option>
                                @foreach (Constants::estado_conservacao_paredes as $estado_conservacao_parede)
                                <option value="{{$estado_conservacao_parede}}">{{$estado_conservacao_parede}}</option>

                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cor_parede">Pintura</label>
                            <select class="form-control" id="cor_parede" name="cor_parede">
                                <option value=""></option>
                                @foreach ( Constants::cores as $cor)
                                <option value="{{$cor}}">{{$cor}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_parede">Conservação da Pintura</label>
                            <select class="form-control" id="cons_pintura_parede" name="cons_pintura_parede">
                                <option value=""></option>
                                @foreach (Constants::estado_pintura as $estado_pint)
                                <option value="{{$estado_pint}}">{{$estado_pint}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_parede">Descrição da Parede</label>
                            <select class="form-control" id="descricao_parede" name="descricao_parede[]" multiple>
                                @foreach (Constants::descricao_parede as $descricao_pared)
                                <option value="{{$descricao_pared}}">{{ $descricao_pared}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_parede">Observação da Parede</label>
                            <textarea class="form-control" id="observacao_parede" name="observacao_parede" rows="3"></textarea>
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
                            <select class="form-control" id="teto" name="teto">
                                <option value=""></option>
                                @foreach (Constants::tipos_tetos as $tipos_teto)
                                <option value="{{$tipos_teto}}">{{$tipos_teto}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_teto">Estado de Conservação do Teto</label>
                            <select class="form-control" id="cons_teto" name="cons_teto">
                                <option value=""></option>
                                @foreach ( Constants::estado_conservacao_teto as $conservacao_teto)
                                <option value="{{$conservacao_teto}}">{{$conservacao_teto}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cor_teto">Pintura</label>
                            <select class="form-control" id="cor_teto" name="cor_teto">
                                <option value=""></option>
                                @foreach ( Constants::cores as $cor)
                                <option value="{{$cor}}">{{$cor}}</option>
                                @endforeach
                            </select>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_teto">Conservação Pintura</label>
                            <select class="form-control" id="cons_pintura_teto" name="cons_pintura_teto">
                                <option value=""></option>
                                @foreach (Constants::estado_pintura as $estado_pint)
                                <option value="{{$estado_pint}}">{{$estado_pint}}</option>

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_teto">Descrição do Teto</label>
                            <select class="form-control" id="descricao_teto" name="descricao_teto[]" multiple>
                                @foreach (Constants::descricao_teto as $descricao_teto)
                                <option value="{{$descricao_teto}}">{{$descricao_teto}}</option>

                                @endforeach
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_teto">Observação do Teto</label>
                            <textarea class="form-control" id="observacao_teto" name="observacao_teto" rows="3"></textarea>
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
                            <select class="form-control" id="porta" name="porta">
                                <option value=""></option>
                                @foreach (Constants::portas as $porta)
                                <option value="{{$porta}}">{{$porta}}</option>
                                @endforeach
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_porta">Estado de Conservação da Porta</label>
                            <select class="form-control" id="cons_porta" name="cons_porta">
                                <option value=""></option>
                                @foreach (Constants::conservacao_porta as $conservacao)
                                <option value="{{$conservacao}}">
                                    {{$conservacao}}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cor_porta">Pintura</label>
                            <select class="form-control" id="cor_porta" name="cor_porta">
                                <option value=""></option>
                                @foreach (Constants::cores_portas_janelas as $cores_portas_janela)
                                <option value="{{$cores_portas_janela}}">{{$cores_portas_janela}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_porta">Conservação Pintura</label>
                            <select class="form-control" id="cons_pintura_porta" name="cons_pintura_porta">
                                <option value=""></option>
                                @foreach (Constants::estado_pintura as $estado_pint)
                                <option value="{{$estado_pint}}">{{$estado_pint}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_porta">Descrição do Porta</label>
                            <select class="form-control" id="descricao_porta" name="descricao_porta[]" multiple>
                                @foreach ( Constants::descricao_porta as $descricao_port)
                                <option value="{{$descricao_port}}">{{$descricao_port}}</option>
                                @endforeach
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_porta">Observação do Porta</label>
                            <textarea class="form-control" id="observacao_porta" name="observacao_porta" rows="3"></textarea>
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
                                <option value="{{$tipos_janela}}">
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
                                <option value="{{$conservacao}}">
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
                                <option value="{{$cores_portas_janela}}">{{$cores_portas_janela}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_janela">Conservação Pintura</label>
                            <select class="form-control" id="cons_pintura_janela" name="cons_pintura_janela">
                                <option value=""></option>
                                @foreach (Constants::estado_pintura as $estado_pint)
                                <option value="{{$estado_pint}}">{{$estado_pint}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_janela">Descrição do Janela</label>
                            <select class="form-control" id="descricao_janela" name="descricao_janela[]" multiple>
                                @foreach ( Constants::descricao_janela as $descricao)
                                <option value="{{$descricao}}">
                                    {{$descricao}}
                                </option>
                                @endforeach
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="observacao_janela">Observação do Janelas</label>
                            <textarea class="form-control" id="observacao_janela" name="observacao_janela" rows="3"></textarea>
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
                    <textarea class="form-control" id="observacoes" name="observacoes" rows="3" placeholder="Digite observações adicionais"></textarea>
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
                            @foreach (Constants::interruptores as $dado)
                            <option>{{ $dado }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="quantidadeInterruptores">Quantidade de Interruptores</label>
                        <input type="number" class="form-control" name="quantidadeInterruptores[]" placeholder="Digite a quantidade de interruptores" min="0">
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="button" class="btn btn-danger remove-interruptor">Remover</button>
                    </div>
                </div>
            `);
            $('#interruptores-section').on('input', 'input[name="quantidadeInterruptores[]"]', function() {
                if ($(this).val() < 0) {
                    $(this).val(0);
                    Swal.fire({
                        icon: 'error',
                        title: 'Valor inválido!',
                        text: 'A quantidade de interruptores não pode ser menor que zero.',
                        confirmButtonText: 'Entendido'
                    });
                }
            });
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
                        <input type="number" class="form-control" name="quantidadeTomadas[]" placeholder="Digite a quantidade de tomadas" min="0">
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button type="button" class="btn btn-danger remove-tomada">Remover</button>
                    </div>
                </div>
            `);
            $('#tomadas-section').on('input', 'input[name="quantidadeTomadas[]"]', function() {
                if ($(this).val() < 0) {
                    $(this).val(0);
                    Swal.fire({
                        icon: 'error',
                        title: 'Valor inválido!',
                        text: 'A quantidade de tomadas não pode ser menor que zero.',
                        confirmButtonText: 'Entendido'
                    });
                }
            });
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