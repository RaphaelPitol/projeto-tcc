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
$rodapes = [
'MDF',
'PVC',
'Cerâmica',
'Porcelanato',
'Madeira',
'Poliestireno',
'Embutido',
'Alumínio',
'Pedra',
'Pintado',
'Inox',
'Granito',
'Mármore',
'Vinílico',
'Curvo'
];
$estado_rodapes = [
'Novo',
'Bom',
'Regular',
'Desgastado',
'Rachado',
'Descolado',
'Quebrado',
'Manchado',
'Envelhecido',
'Solto',
'Danificado',
'Riscado',
'Desbotado'
];
$descricao_rodapes = [
'Com marcas de arranhões',
'Desgastado nas extremidades',
'Desbotado pela exposição ao sol',
'Com manchas de umidade',
'Rachado em alguns pontos',
'Solto em algumas partes',
'Com presença de mofo',
'Descolado da parede',
'Com lascas ou quebras',
'Aparência envelhecida',
'Reparado recentemente',
'Com pintura descascada',
'Marcas de impacto visíveis',
'Dificuldade de fixação',
'Com tonalidade irregular'
];
$tipos_paredes = [
'Alvenaria',
'Gesso',
'Drywall',
'Madeira',
'Concreto',
'Marmorite',
'Cerâmica',
'Tijolo aparente',
'Pedra natural',
'PVC',
'Fibrocimento',
'Vidro',
'Metal',
'Cobogó',
'Papel de parede',
'Textura',
'Revestimento 3D',
'Azulejo',
'Ladrilho hidráulico',
'Painel de madeira'
];
$estado_conservacao_paredes = [
'Novo',
'Bom',
'Regular',
'Desgastado',
'Trincado',
'Manchado',
'Descascando',
'Com infiltração',
'Com mofo',
'Rachado',
'Desbotado',
'Requer reparo'
];
$estado_pintura = [
'Nova',
'Boa',
'Regular',
'Desgastada',
'Com manchas',
'Descascando',
'Com bolhas',
'Desbotada',
'Com infiltração',
'Com mofo',
'Rachada',
'Requer repintura'
];
$descricao_parede = [
'Rachaduras',
'Infiltração',
'Manchas de umidade',
'Desgaste na pintura',
'Furos de pregos ou parafusos',
'Desbotamento',
'Revestimento danificado',
'Pintura nova',
'Mofo',
'Desnível',
'Sujidade',
'Marcas de batidas',
'Trincas',
'Reboco solto',
'Descoloração',
'Textura áspera',
'Acabamento fino',
'Reparo recente',
'Isolamento acústico',
'Isolamento térmico'
];
$tipos_tetos = [
'Gesso liso',
'Forro de PVC',
'Laje de concreto',
'Madeira',
'Gesso rebaixado',
'Forro acústico',
'Forro mineral',
'Teto de estuque',
'Forro de drywall',
'Fibrocimento',
'Forro modular',
'Forro metálico',
'Teto pintado',
'Teto texturizado',
'Teto com sancas',
'Teto com iluminação embutida',
'Teto com moldura',
'Teto em bambu',
'Teto de palha',
'Laje aparente'
];
$estado_conservacao_teto = [
'Novo',
'Bom',
'Regular',
'Desgastado',
'Com manchas',
'Rachado',
'Com infiltrações',
'Com trincas',
'Desbotado',
'Sujo',
'Com mofo',
'Com fissuras',
'Com necessidade de pintura',
'Com bolhas',
'Com descolamento',
'Descascado',
'Com avarias',
'Com umidade',
'Com ferrugem',
'Danificado'
];
$cores = [
'Branco',
'Bege',
'Cinza claro',
'Cinza médio',
'Amarelo claro',
'Verde claro',
'Azul claro',
'Pêssego',
'Marfim',
'Off-white',
'Creme',
'Areia',
'Terracota',
'Azul escuro',
'Verde escuro',
'Vinho',
'Grafite',
'Marrom claro',
'Salmão',
'Lavanda',
'Rosa claro',
'Preto',
'Verde militar',
'Tijolo',
'Laranja suave'
];
$descricao_teto = [
'Manchas de umidade',
'Rachaduras visíveis',
'Fissuras leves',
'Pintura descascando',
'Teto com bolhas de pintura',
'Desnível perceptível',
'Sinais de infiltração',
'Marcas de mofo',
'Desgaste natural',
'Trincas estruturais',
'Pintura recente',
'Sem avarias visíveis',
'Gesso danificado',
'Reboco solto',
'Acabamento malfeito',
'Sujeira acumulada',
'Teto rebaixado intacto',
'Riscos leves',
'Falta de isolamento térmico',
'Presença de teias de aranha',
];
$portas = [
'Porta de madeira',
'Porta de vidro',
'Porta de alumínio',
'Porta de ferro',
'Porta de PVC',
'Porta de correr',
'Porta pivotante',
'Porta sanfonada',
'Porta de abrir',
'Porta de aço',
'Porta laminada',
'Porta acústica',
'Porta com veneziana',
'Porta frisada',
'Porta com visor',
'Porta maciça',
'Porta semi-sólida',
'Porta laqueada',
'Porta de duas folhas',
'Porta de correr embutida',
];
$conservacao_porta = [
'Nova - sem uso, em perfeitas condições',
'Excelente - sem desgastes ou danos visíveis',
'Boa - leve desgaste natural, sem danos estruturais',
'Regular - sinais de desgaste moderado, mas funcional',
'Desgastada - desgaste evidente, mas ainda utilizável',
'Danificada - com danos superficiais, como arranhões ou lascas',
'Precisa de pequenos reparos - desgastes leves ou ferragens soltas',
'Precisa de reparo - danos significativos que afetam a funcionalidade',
'Precisa de substituição - danos severos e comprometimento estrutural',
'Riscos visíveis - arranhões ou marcas superficiais',
'Amassada - danos causados por impactos',
'Com ferrugem - sinais de corrosão, especialmente em áreas metálicas',
'Com pintura descascando - desgastes de acabamento, necessitando repintura',
'Desalinhada - dificuldade de fechamento adequado',
'Fechadura danificada - trava ou fechadura com problemas de funcionamento',
'Infiltração ou umidade - áreas com sinais de mofo ou umidade',
];
$cores_portas_janelas = [
'Branco',
'Preto',
'Madeira (natural)',
'Madeira escura (mogno, marfim, etc.)',
'Cinza',
'Bege',
'Azul',
'Vermelho',
'Verde',
'Amarelo',
'Marrom',
'Off-white (branco sujo)',
'Branco gelo',
'Avelã',
'Nogueira',
'Carvalho',
'Imbuia',
'Pinho',
'Branco fosco',
'Preto fosco',
'Bronze',
'Cobre',
];
$descricao_porta = [
'Porta de madeira, com alguns arranhões superficiais',
'Porta de madeira com vidro, vidro quebrado em um dos painéis',
'Porta de vidro temperado, sem danos aparentes, mas com sujeira acumulada',
'Porta de alumínio, com leves amassados e necessidade de pintura',
'Porta de aço, com ferrugem visível nas extremidades',
'Porta de PVC, sem danos, mas com manchas de umidade',
'Porta de correr, funcionando corretamente, mas com trilho sujo',
'Porta pivotante, com acabamento desgastado e tinta descascada',
'Porta camarão, funcionando com dificuldades, com danos nas dobradiças',
'Porta de correr de vidro, com adesivos de proteção ainda aplicados',
'Porta de segurança, com tranca de alta qualidade, sem danos visíveis',
'Porta de madeira envelhecida, com desgastes naturais e riscos de uso',
'Porta de metal com design moderno, sem nenhum defeito',
'Porta blindada, sem danos estruturais, com sinais de uso',
'Porta de correr com trilho superior, funcionando, mas com trilho arranhado',
'Porta de ferro, com ferrugem em algumas partes, precisa de reparo',
'Porta de vidro laminado, sem rachaduras, mas com acúmulo de poeira',
'Porta acústica, bem conservada, sem falhas na vedação',
'Porta com pintura esmalte, com desgaste de tinta em áreas específicas',
'Porta com acabamento fosco, sem arranhões ou marcas de uso'
];
$tipos_janelas = [
'Correr',
'Abrir (bate-bate)',
'Guilhotina',
'Veneziana',
'Basculante',
'Fixa',
'Pivotante',
'Alumínio',
'Vidro temperado',
'PVC',
'Madeira',
'Aço',
'Panorâmica',
'Vidro refratário',
'Vidro laminado',
'Persiana embutida',
'Vidro jateado'
];
$conservacao_janela = [
    'Excelente',
    'Boa',
    'Regular',
    'Ruim',
    'Precisa de reparos',
    'Péssima',
    'Nova',
    'Reformada',
    'Desgastada'
];
$descricao_janela = [
    'Vidro trincado',
    'Vidro quebrado',
    'Vidro transparente',
    'Vidro fosco',
    'Vidro temperado',
    'Vidro com película',
    'Com veneziana',
    'Com cortina',
    'Com tela de proteção',
    'Com persiana',
    'Com pintura descascada',
    'Com pintura nova',
    'Com ferrugem',
    'Com vedação em bom estado',
    'Com vedação deteriorada',
    'Com abertura de correr',
    'Com abertura de batente',
    'Com acabamento de madeira',
    'Com acabamento de alumínio',
    'Com acabamento de PVC',
    'Com marca de uso',
    'Com acabamentos danificados'
];
$tomadas = [
    'Tomada 2 pinos',
    'Tomada 3 pinos',
    'Tomada Tipo N (10A)',
    'Tomada Tipo N (20A)',
    'Tomada Tipo C (2 pinos redondos)',
    'Tomada Tipo A (2 pinos planos)',
    'Tomada Tipo B (2 pinos planos + aterramento)',
    'Tomada tipo Schuko',
    'Tomada USB',
    'Tomada tripolar',
    'Tomada de força',
    'Tomada de uso geral',
    'Tomada para ar-condicionado',
    'Tomada para equipamentos industriais',
    'Tomada dupla (2 tomadas em uma caixa)',
    'Tomada tripla (3 tomadas em uma caixa)',
    'Tomada com interruptor (para ligar/desligar a luz)',
    'Tomada para interruptor (com a função de ligar/desligar equipamentos)',
    'Tomada embutida',
    'Tomada externa (para áreas externas, resistente à água)',
    'Tomada de superfície (montada na parede sem embutir)',
    'Tomada de rede (para internet, Ethernet)',
    'Tomada de TV (para antena)',
    'Tomada para áudio (para aparelhos de som)'
];
$interruptores = [
    'Interruptor simples (1 via)',
    'Interruptor duplo (2 vias)',
    'Interruptor triplo (3 vias)',
    'Interruptor paralelo',
    'Interruptor de cruzamento',
    'Interruptor de pressão',
    'Interruptor de luz (com botão luminoso)',
    'Interruptor com dimmer (para ajustar intensidade de luz)',
    'Interruptor de toque (sensível ao toque)',
    'Interruptor de efeito (com LED)',
    'Interruptor de espelho',
    'Interruptor de comando remoto',
    'Interruptor com temporizador (para desligamento automático)',
    'Interruptor inteligente (controlado por app ou Wi-Fi)',
    'Interruptor com tomada (combinado, tipo de interruptor e tomada na mesma caixa)',
    'Interruptor com tomada dupla (combinado com 2 tomadas)',
    'Interruptor com tomada tripla (combinado com 3 tomadas)',
    'Interruptor com tomada USB (comporta dispositivos USB)',
    'Interruptor de comando de ventilador (para controlar a velocidade)',
    'Interruptor para cortinas (automático ou manual)',
    'Interruptor de campainha',
    'Interruptor de alarme',
    'Interruptor de passagem (utilizado para controle em diferentes pontos)',
    'Interruptor de segurança (com travamento, usado em locais de risco)',
    'Interruptor de emergência (com luz de sinalização)',
    'Interruptor com controle remoto',
    'Interruptor de proteção (tipo fusível, para segurança adicional)'
];
@endphp


<div class="container h-100 mt-5">
    <h2>Cadastro de Ambiente</h2>

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
                                @foreach ($pisos as $piso )
                                <option value="{{$piso}}">{{$piso}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_piso">Estado de Conservação do Piso</label>
                            <select class="form-control" id="cons_piso" name="cons_piso">
                                <option value="bom">Bom</option>
                                @foreach ($estado as $cons )
                                <option value="{{$cons}}">{{$cons}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_piso">Descrição do Piso</label>
                            <select class="form-control" id="descricao_piso" name="descricao_piso[]" multiple>
                                @foreach ($descricao_piso as $dado)
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
                                @foreach ($rodapes as $rodape )
                                <option value="{{$rodape}}">{{$rodape}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_rodape">Estado de Conservação do Rodapé</label>
                            <select class="form-control" id="cons_rodape" name="cons_rodape">
                                <option value=""></option>
                                @foreach ($estado_rodapes as $estado_rodape)
                                <option value="{{$estado_rodape}}">{{$estado_rodape}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_rodape">Descrição do Rodapé</label>
                            <select class="form-control" id="descricao_rodape" name="descricao_rodape[]" multiple>
                                @foreach ($descricao_rodapes as $descricao_rodape)
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
                                @foreach ($tipos_paredes as $tipos_parede)
                                <option value="{{$tipos_parede}}">{{$tipos_parede}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_parede">Estado de Conservação do Parede</label>
                            <select class="form-control" id="cons_parede" name="cons_parede">
                                <option value=""></option>
                                @foreach ($estado_conservacao_paredes as $estado_conservacao_parede)
                                <option value="{{$estado_conservacao_parede}}">{{$estado_conservacao_parede}}</option>

                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cor_parede">Pintura</label>
                            <select class="form-control" id="cor_parede" name="cor_parede">
                                <option value=""></option>
                                @foreach ( $cores as $cor)
                                <option value="{{$cor}}">{{$cor}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_parede">Conservação da Pintura</label>
                            <select class="form-control" id="cons_pintura_parede" name="cons_pintura_parede">
                                <option value=""></option>
                                @foreach ($estado_pintura as $estado_pint)
                                <option value="{{$estado_pint}}">{{$estado_pint}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_parede">Descrição da Parede</label>
                            <select class="form-control" id="descricao_parede" name="descricao_parede[]" multiple>
                                <option value=""></option>
                                @foreach ($descricao_parede as $descricao_pared)
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
                                @foreach ($tipos_tetos as $tipos_teto)

                                <option value="{{$tipos_teto}}">{{$tipos_teto}}</option>
                                @endforeach


                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_teto">Estado de Conservação do Teto</label>
                            <select class="form-control" id="cons_teto" name="cons_teto">

                                <option value=""></option>
                                @foreach ( $estado_conservacao_teto as $conservacao_teto)
                                <option value="{{$conservacao_teto}}">{{$conservacao_teto}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cor_teto">Pintura</label>
                            <select class="form-control" id="cor_teto" name="cor_teto">
                                <option value=""></option>
                                @foreach ( $cores as $cor)
                                <option value="{{$cor}}">{{$cor}}</option>
                                @endforeach
                            </select>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_teto">Conservação Pintura</label>
                            <select class="form-control" id="cons_pintura_teto" name="cons_pintura_teto">
                                <option value=""></option>
                                @foreach ($estado_pintura as $estado_pint)
                                <option value="{{$estado_pint}}">{{$estado_pint}}</option>

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_teto">Descrição do Teto</label>
                            <select class="form-control" id="descricao_teto" name="descricao_teto[]" multiple>
                                <option value=""></option>
                                @foreach ($descricao_teto as $descricao_teto)
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
                                @foreach ($portas as $porta)
                                <option value="{{$porta}}">{{$porta}}</option>
                                @endforeach
                                <!-- Adicione outras opções conforme necessário -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_porta">Estado de Conservação da Porta</label>
                            <select class="form-control" id="cons_porta" name="cons_porta">
                                <option value=""></option>
                                @foreach ($conservacao_porta as $conservacao)
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
                                @foreach ($cores_portas_janelas as $cores_portas_janela)
                                <option value="{{$cores_portas_janela}}">{{$cores_portas_janela}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_porta">Conservação Pintura</label>
                            <select class="form-control" id="cons_pintura_porta" name="cons_pintura_porta">
                                <option value=""></option>
                                @foreach ($estado_pintura as $estado_pint)
                                <option value="{{$estado_pint}}">{{$estado_pint}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_porta">Descrição do Porta</label>
                            <select class="form-control" id="descricao_porta" name="descricao_porta[]" multiple>
                                @foreach ( $descricao_porta as $descricao_port)
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
                                @foreach ($tipos_janelas as $tipos_janela)
                                <option value="{{$tipos_janela}}">
                                    {{$tipos_janela}}
                                </option>

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_janela">Estado de Conservação da Janela</label>
                            <select class="form-control" id="cons_janela" name="cons_janela" >
                                <option value=""></option>
                                @foreach ($conservacao_janela as $conservacao)
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
                                @foreach ($cores_portas_janelas as $cores_portas_janela)
                                <option value="{{$cores_portas_janela}}">{{$cores_portas_janela}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cons_pintura_janela">Conservação Pintura</label>
                            <select class="form-control" id="cons_pintura_janela" name="cons_pintura_janela" >
                            <option value=""></option>
                                @foreach ($estado_pintura as $estado_pint)
                                <option value="{{$estado_pint}}">{{$estado_pint}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="descricao_janela">Descrição do Janela</label>
                            <select class="form-control" id="descricao_janela" name="descricao_janela[]" multiple >
                            @foreach ( $descricao_janela as $descricao)
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