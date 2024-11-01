@extends('layouts.app')
@section('title', 'Edição')
@section('content')

<section class="vh-100 mb-4">
    @php
    if(isset($dados)){
    echo($dados);
    }
    @endphp
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Imobiliaria</p>

                                <form action="{{route('store.user')}}" method="POST" class="mx-1 mx-md-4">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="cnpj">CNPJ</label>
                                                <input type="text" id="cnpj" name="cnpj" class="form-control" maxlength="18" required placeholder="00.000.000/0000-00" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Fantasia</label>
                                                <input type="text" id="name" name="name" class="form-control" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="razao_social">Razão Social</label>
                                                <input type="text" id="razao_social" name="razao_social" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="cep">CEP</label>
                                                <input type="text" id="cep" name="cep" maxlength="10" class="form-control" placeholder="xx.xxx-xxx" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="logradouro">Logradouro</label>
                                                <input type="text" id="logradouro" name="logradouro" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="bairro">Bairro</label>
                                                <input type="text" id="bairro" name="bairro" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="cidade">Cidade</label>
                                                <input type="text" id="cidade" name="cidade" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="numero">Número</label>
                                                <input type="text" id="numero" name="numero" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="email">E-mail</label>
                                                <input type="email" id="email" name="email" class="form-control" />
                                            </div>
                                        </div>
                                        <div data-mdb-input-init class="form-outline col-md-6">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <label class="form-label" for="password">Senha</label>
                                            <div class="input-group">
                                                <input type="password" name="password" id="form3Example4" class="form-control" placeholder="Digite a sua senha" />
                                                <span class="input-group-text" onclick="togglePasswordVisibility()">
                                                    <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="permission" value="imobiliaria">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="telefone">Telefone</label>
                                                <input type="telefone" id="telefone" name="telefone" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-4">
                                            <div class="mb-3 ">
                                                <button type="submit" class="btn btn-primary btn-lg form-control">Cadastrar</button>
                                            </div>
                                        </div>
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

@endsection