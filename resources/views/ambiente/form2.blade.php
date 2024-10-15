<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Configurações básicas de meta tags para charset e responsividade -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Instalação Elétrica</title>
    <!-- Inclusão do CSS do Bootstrap para estilização -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Inclusão do jQuery para manipulação de DOM e eventos -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <head>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </head>


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
    </style>
</head>

@php
// Simulando dados vindos do banco de dados para interruptores e tomadas
$tomadasdobanco = ["Tomada 20A", "Tomada 10A dupla"];
// Quantidade correspondente às tomadas
$qtdtomadasdobanco = ["5", "2"];

$interruptoresdobanco = ["Interruptor Paralelo", "Interruptor Intermediário"];
// Quantidade correspondente aos interruptores
$qtdinterruptoresdobanco = ["3", "4"];

// Definindo as opções disponíveis para seleção nos campos do formulário
$interruptores = ["Simples", "Duplo", "Triplo", "Interruptor Paralelo", "Interruptor Intermediário"];
$tomadas = ["Simples", "Duplo", "Triplo", "Tomada 20A", "Tomada 10A dupla"];
@endphp

<body>
    <div class="container mt-5">
        <h2>Cadastro de Ambiente</h2>
        <!-- Início do formulário com a rota definida para envio dos dados -->
        <form action="{{route('ambiente.store')}}" method="POST" class="mx-1 mx-md-3 ">
        @csrf


            <label for="nome_ambiente">Nome Ambiente</label>
            <input type="text" class="form-control" name="nome_ambiente">

            <!-- Botão para abrir/collapse o formulário de Piso -->
            <button class="btn btn-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#formPiso" aria-expanded="false" aria-controls="formPiso">
              Piso
            </button>


            <!-- Botão para abrir/collapse o formulário de Rodapé -->
            <button class="btn btn-secondary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#formRodape" aria-expanded="false" aria-controls="formRodape">
                Rodapé
            </button>


            <!-- Botão para abrir/collapse o formulário de Parede -->
            <button class="btn btn-danger mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#formParede" aria-expanded="false" aria-controls="formParede">
                Parede
            </button>



            <button class="btn btn-warning mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#formTeto" aria-expanded="false" aria-controls="formTeto">
                Teto
            </button>


            <button class="btn btn-dark mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#formPorta" aria-expanded="false" aria-controls="formPorta">
                Porta
            </button>


            <button class="btn btn-success mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#formJanela" aria-expanded="false" aria-controls="formJanela">
                Janela
            </button>

            <!-- Seção para os interruptores -->

            <button class="btn btn-info mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#formEletrica" aria-expanded="false" aria-controls="formEletrica">
                Eletrica
            </button>
            <div class="collapse mt-2" id="formEletrica">

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
                                    @foreach ($interruptores as $opcao)
                                    <!-- Verifica se a opção deve ser selecionada com base no dado do banco -->
                                    <option value="{{ $opcao }}" {{ $opcao == $interruptor ? 'selected' : '' }}>{{ $opcao }}</option>
                                    @endforeach
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
                                <select class="form-control" name="tipoTomada[]">
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

            <div class="collapse mt-2" id="formPiso">
                <fieldset>
                    <legend>Cadastro de Piso</legend>
                    <div class="form-group">
                        <label for="piso">Tipo de Piso</label>
                        <select class="form-control" id="piso" name="piso">
                            <option value="ceramica">Cerâmica</option>
                            <option value="porcelanato">Porcelanato</option>
                            <option value="madeira">Madeira</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cons_piso">Estado de Conservação do Piso</label>
                        <select class="form-control" id="cons_piso" name="cons_piso">
                            <option value="bom">Bom</option>
                            <option value="regular">Regular</option>
                            <option value="ruim">Ruim</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="descricao_piso">Descrição do Piso</label>
                        <select class="form-control" id="descricao_piso" name="descricao_piso">
                            <option value="sem furos, sem manchas">Sem furos, sem manchas</option>
                            <option value="com furos, pequenas manchas">Com furos, pequenas manchas</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="observacao_piso">Observação do Piso</label>
                        <textarea class="form-control" id="observacao_piso" name="observacao_piso" rows="3"></textarea>
                    </div>
                </fieldset>
            </div>
            <div class="collapse mt-2" id="formRodape">
                <fieldset>
                    <legend>Cadastro de Roda-pé</legend>
                    <div class="form-group">
                        <label for="rodape">Tipo de Rodapé</label>
                        <select class="form-control" id="rodape" name="rodape">
                            <option value="ceramica">Cerâmica</option>
                            <option value="porcelanato">Porcelanato</option>
                            <option value="madeira">Madeira</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cons_rodape">Estado de Conservação do Rodapé</label>
                        <select class="form-control" id="cons_rodape" name="cons_rodape">
                            <option value="bom">Bom</option>
                            <option value="regular">Regular</option>
                            <option value="ruim">Ruim</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="descricao_rodape">Descrição do Rodapé</label>
                        <select class="form-control" id="descricao_rodape" name="descricao_rodape">
                            <option value="em todo o contorno, inteiros">Em todo o contorno, inteiros</option>
                            <option value="faltando em alguns pontos, rachados">Faltando em alguns pontos, rachados</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="observacao_rodape">Observação do Rodapé</label>
                        <textarea class="form-control" id="observacao_rodape" name="observacao_rodape" rows="3"></textarea>
                    </div>
                </fieldset>
            </div>
            <div class="collapse mt-2" id="formParede">
                <fieldset>
                    <legend>Cadastro de Parede</legend>
                    <div class="form-group">
                        <label for="parede">Tipo de Parede</label>
                        <select class="form-control" id="parede" name="parede">
                            <option value="alvenaria">Alvenaria</option>
                            <option value="ceramica">Cerâmica</option>
                            <option value="porcelanato">Porcelanato</option>
                            <option value="madeira">Madeira</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cons_parede">Estado de Conservação do Parede</label>
                        <select class="form-control" id="cons_parede" name="cons_parede">
                            <option value="bom">Bom</option>
                            <option value="regular">Regular</option>
                            <option value="ruim">Ruim</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cor_parede">Pintura</label>
                        <select class="form-control" id="cor_parede" name="cor_parede">
                            <option value="branco">Branco</option>
                            <option value="preto">Preto</option>
                            <option value="roxo">Roxo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cons_pintura_parede">Conservação da Pintura</label>
                        <select class="form-control" id="cons_pintura_parede" name="cons_pintura_parede">
                            <option value="bom">Bom</option>
                            <option value="regular">Regular</option>
                            <option value="ruim">Ruim</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="descricao_parede">Descrição da Parede</label>
                        <select class="form-control" id="descricao_parede" name="descricao_parede">
                            <option value="sem furos, sem manchas">Sem furos, sem manchas</option>
                            <option value="com furos, pequenas manchas">Com furos, pequenas manchas</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="observacao_parede">Observação da Parede</label>
                        <textarea class="form-control" id="observacao_parede" name="observacao_parede" rows="3"></textarea>
                    </div>
                </fieldset>
            </div>
            <div class="collapse mt-2" id="formTeto">

                <fieldset>
                    <legend>Cadastro de Teto</legend>

                    <div class="form-group">
                        <label for="teto">Tipo de Teto</label>
                        <select class="form-control" id="teto" name="teto">
                            <option value="ceramica">Laje</option>
                            <option value="ceramica">Forro</option>
                            <option value="porcelanato">Gesso</option>
                            <option value="madeira">Madeira</option>
                            <!-- Adicione outras opções conforme necessário -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cons_teto">Estado de Conservação do Teto</label>
                        <select class="form-control" id="cons_teto" name="cons_teto">
                            <option value="bom">Bom</option>
                            <option value="regular">Regular</option>
                            <option value="ruim">Ruim</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cor_teto">Pintura</label>
                        <select class="form-control" id="cor_teto" name="cor_teto">
                            <option value="branco">Branco</option>
                            <option value="preto">Preto</option>
                            <option value="roxo">Roxo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cons_pintura_teto">Conservação Pintura</label>
                        <select class="form-control" id="cons_pintura_teto" name="cons_pintura_teto">
                            <option value="bom">Bom</option>
                            <option value="regular">Regular</option>
                            <option value="ruim">Ruim</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="descricao_teto">Descrição do Teto</label>
                        <select class="form-control" id="descricao_teto" name="descricao_teto">
                            <option value="sem furos, sem manchas">Sem furos, sem manchas</option>
                            <option value="com furos, pequenas manchas">Com furos, pequenas manchas</option>
                            <!-- Adicione outras opções conforme necessário -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="observacao_teto">Observação do Teto</label>
                        <textarea class="form-control" id="observacao_teto" name="observacao_teto" rows="3"></textarea>
                    </div>
                </fieldset>
            </div>
            <div class="collapse mt-2" id="formPorta">
                <fieldset>
                    <legend>Cadastro de Porta</legend>

                    <div class="form-group">
                        <label for="porta">Tipo de Porta</label>
                        <select class="form-control" id="porta" name="porta">
                            <option value="Vidro de correr">Vidro de correr</option>
                            <option value="Madeira de corre">Madeira de corre</option>
                            <!-- Adicione outras opções conforme necessário -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cons_porta">Estado de Conservação da Porta</label>
                        <select class="form-control" id="cons_porta" name="cons_porta">
                            <option value="bom">Bom</option>
                            <option value="regular">Regular</option>
                            <option value="ruim">Ruim</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cor_porta">Pintura</label>
                        <select class="form-control" id="cor_porta" name="cor_porta">
                            <option value="branco">Branco</option>
                            <option value="preto">Preto</option>
                            <option value="roxo">Roxo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cons_pintura_porta">Conservação Pintura</label>
                        <select class="form-control" id="cons_pintura_porta" name="cons_pintura_porta">
                            <option value="bom">Bom</option>
                            <option value="regular">Regular</option>
                            <option value="ruim">Ruim</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="descricao_porta">Descrição do Porta</label>
                        <select class="form-control" id="descricao_porta" name="descricao_porta">
                            <option value="Abre e fecha bem">Abre e fecha bem</option>
                            <option value="sem furos, sem manchas">Sem furos, sem manchas</option>
                            <option value="com furos, pequenas manchas">pequenas manchas</option>
                            <!-- Adicione outras opções conforme necessário -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="observacao_porta">Observação do Porta</label>
                        <textarea class="form-control" id="observacao_porta" name="observacao_porta" rows="3"></textarea>
                    </div>
                </fieldset>
            </div>
            <div class="collapse mt-2" id="formJanela">

                <fieldset>

                    <legend>Cadastro de Janela</legend>

                    <div class="form-group">
                        <label for="janela">Tipo de Janela</label>
                        <select class="form-control" id="janela" name="janela">
                            <option value="ceramica">Vidro de correr</option>
                            <option value="ceramica">Madeira de corre</option>
                            <!-- Adicione outras opções conforme necessário -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cons_janela">Estado de Conservação da Janela</label>
                        <select class="form-control" id="cons_janela" name="cons_janela">
                            <option value="bom">Bom</option>
                            <option value="regular">Regular</option>
                            <option value="ruim">Ruim</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cor_janela">Pintura</label>
                        <select class="form-control" id="cor_janela" name="cor_janela">
                            <option value="branco">Branco</option>
                            <option value="preto">Preto</option>
                            <option value="roxo">Roxo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cons_pintura_janela">Conservação Pintura</label>
                        <select class="form-control" id="cons_pintura_janela" name="cons_pintura_janela">
                            <option value="bom">Bom</option>
                            <option value="regular">Regular</option>
                            <option value="ruim">Ruim</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="descricao_janela">Descrição do Janela</label>
                        <select class="form-control" id="descricao_janela" name="descricao_janela">
                            <option value="com furos, pequenas manchas">Abre e fecha bem</option>
                            <option value="sem furos, sem manchas">Sem furos, sem manchas</option>
                            <option value="com furos, pequenas manchas">pequenas manchas</option>
                            <!-- Adicione outras opções conforme necessário -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="observacao_janela">Observação do Janelas</label>
                        <textarea class="form-control" id="observacao_janela" name="observacao_janela" rows="3"></textarea>
                    </div>
                </fieldset>
            </div>

            <!-- Campo de observações gerais -->
            <div class="form-group">
                <label for="observacoes">Observações</label>
                <textarea class="form-control" id="observacoes" rows="3" placeholder="Digite observações adicionais"></textarea>
            </div>

            <!-- Botão de envio do formulário -->
            <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
    </form>
    </div>

    <!-- Scripts para manipulação de DOM e adição de elementos dinâmicos -->
    <script>
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
</body>

</html>