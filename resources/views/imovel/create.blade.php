@extends('layouts.app')
@section('title', 'Edição')
@section('content')


<section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-1">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h4 fw-bold mb-5 mx-1 mx-md-4 mt-2">Cadastro Imovel</p>

                                <form action="{{route('imovel.store')}}" method="POST" class="mx-1 mx-md-4">
                                    @csrf
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="cep">Cep</label>
                                            <input type="text" id="cep" name="cep" class="form-control" />
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-2">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="name">Nome</label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Ex: Casa, Apartamento..."/>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="logradouro">Logradouro</label>
                                            <input type="text" id="logradouro" name="logradouro" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="bairro">Bairro</label>
                                            <input type="text" id="bairro" name="bairro" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="cidade">Cidade</label>
                                            <input type="text" id="cidade" name="cidade" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="numero">Numero</label>
                                            <input type="text" id="numero" name="numero" class="form-control" required />
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
            </div>
        </div>
    </div>
</section>


    <script>
        $(document).ready(function() {
            $('#cep').on('change', function() {
                var cep = $(this).val();

                if (cep.length === 8) {
                    $.ajax({
                        url: 'https://viacep.com.br/ws/' + cep + '/json/',
                        method: 'GET',
                        success: function(data) {
                            if (!("erro" in data)) {
                                $('#logradouro').val(data.logradouro);
                                $('#bairro').val(data.bairro);
                                $('#cidade').val(data.localidade+'-'+data.uf);
                            } else {
                                alert('CEP não encontrado.');
                            }
                        },
                        error: function() {
                            alert('Erro ao buscar o CEP.');
                        }
                    });
                } else {
                    alert('Formato de CEP inválido.');
                }
            });
        });
    </script>

@endsection