@extends('layouts.app')
@section('title', 'Edição')
@section('content')

@if (Auth::user()->permission == 'imobiliaria')
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

                                <form action="{{route('update.user', $user)}}" method="POST" class="mx-1 mx-md-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="cnpj">CNPJ</label>
                                                <input type="text" id="cnpj" name="cnpj" class="form-control" maxlength="18" value="{{$user->cnpj}}"
                                                    required placeholder="00.000.000/0000-00" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="name">Fantasia</label>
                                                <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}" />
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="razao_social">Razão Social</label>
                                                <input type="text" id="razao_social" name="razao_social" class="form-control" value="{{$user->razao_social}}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="cep">CEP</label>
                                                <input type="text" id="cep" name="cep" maxlength="10" class="form-control"
                                                    value="{{$user->cep}}"
                                                    placeholder="xx.xxx-xxx" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="logradouro">Logradouro</label>
                                                <input type="text" id="logradouro" name="logradouro" class="form-control"
                                                    required value="{{$user->logradouro}}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="bairro">Bairro</label>
                                                <input type="text" id="bairro" name="bairro" class="form-control" value="{{$user->bairro}}" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="cidade">Cidade</label>
                                                <input type="text" id="cidade" name="cidade" class="form-control" value="{{$user->cidade}}" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="numero">Número</label>
                                                <input type="text" id="numero" name="numero" class="form-control" value="{{$user->numero}}" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="email">E-mail</label>
                                                <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}" />
                                            </div>
                                        </div>
                                        <div data-mdb-input-init class="form-outline col-md-6">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <label class="form-label" for="password">Senha</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="form-password" class="form-control"
                                                required placeholder="Digite a sua senha"
                                                pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$"
                                                title="A senha deve ter no mínimo 6 caracteres, incluindo pelo menos um número e um caractere especial !@#$%^&*." />
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
                                                <input type="telefone" id="telefone" name="telefone" class="form-control" value="{{$user->telefone}}" />
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

@endif

@if (Auth::user()->permission == 'vistoriador')
<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Editar Dados</p>

                                <form action="{{route('update.user', $user)}}" method="POST" class="mx-1 mx-md-4">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <label class="form-label" for="name">Nome</label>
                                            <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <!-- <i class="fas fa-user fa-lg me-3 fa-fw"></i> -->
                                            <label class="form-label" for="sobreNome">Sobrenome</label>
                                            <input type="text" id="sobreNome" name="sobreNome" class="form-control" value="{{$user->sobreNome}}" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <!-- <i class="fas fa-lock fa-lg me-3 fa-fw"></i> -->
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="cpf">CPF</label>
                                            <input type="text" id="cpf" name="cpf" maxlength="14" class="form-control" readonly
                                                value="{{$user->cpf}}" required placeholder="000.000.000-00" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}" />
                                        </div>
                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-3">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <label class="form-label" for="password">Senha</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="form-password" class="form-control"
                                                required placeholder="Digite a sua senha"
                                                pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$"
                                                title="A senha deve ter no mínimo 6 caracteres, incluindo pelo menos um número e um caractere especial !@#$%^&*." />
                                            <span class="input-group-text" onclick="togglePasswordVisibility()">
                                                <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Salvar</button>
                                    </div>
                                </form>

                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                    class="img-fluid" alt="Sample image">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
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
@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Erros de validação',
            text: "{{ implode(', ', $errors->all()) }}"
        });
    });
</script>
@endif

<script>
    //função para colocar a mascara no cep
    document.getElementById("cep").addEventListener("input", function(e) {
        let cep = e.target.value.replace(/\D/g, "");
        cep = cep.replace(/^(\d{2})(\d)/, "$1.$2");
        cep = cep.replace(/(\d{3})(\d{1,3})$/, "$1-$2");
        e.target.value = cep;
    });

    //Busca os cep na API viacep e preenche o formulario
    document.getElementById("cep").addEventListener("blur", function() {
        var cep = this.value.replace(/\D/g, "");
        if (cep.length == 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then((response) => response.json())
                .then((data) => {
                    if (!data.erro) {
                        document.getElementById("logradouro").value =
                            data.logradouro;
                        document.getElementById("bairro").value = data.bairro;
                        document.getElementById("cidade").value = data.localidade;
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Oops...",
                            text: "Cep Não Encontrado",
                        });
                    }
                });
        }
    });

    //função para colocar a mascara no CNPJ
    document.getElementById("cnpj").addEventListener("input", function(e) {
        let cnpj = e.target.value.replace(/\D/g, ""); // Remove caracteres não numéricos
        cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2");
        cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
        cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2");
        cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");
        e.target.value = cnpj;
    });

    //Função para buscar dados do CNPJ
    document.getElementById("cnpj").addEventListener("blur", function() {
        console.log("blur event fired");
        let cnpj = this.value.replace(/\D/g, ""); // Remove a máscara antes de buscar
        console.log(cnpj)
        if (cnpj.length === 14) {
            // Verifica se o CNPJ tem 14 dígitos
            fetch(`/api/buscar-cnpj/${cnpj}`)
                .then((response) => response.json())
                .then((data) => {
                    if (data.status === "OK") {
                        // Preenchendo os campos com os dados retornados
                        document.getElementById("name").value = data.fantasia || "";
                        document.getElementById("razao_social").value =
                            data.nome || "";
                        document.getElementById("logradouro").value =
                            data.logradouro || "";
                        document.getElementById("bairro").value = data.bairro || "";
                        document.getElementById("cidade").value =
                            data.municipio || "";
                        document.getElementById("numero").value = data.numero || "";
                        document.getElementById("cep").value = data.cep || "";
                        document.getElementById("email").value = data.email || "";
                        document.getElementById("telefone").value = data.telefone || "";
                    } else {
                        Swal.fire({
                            title: "CNPJ não encontrado.",
                            icon: "warning",
                            showClass: {
                                popup: `
                                animate__animated
                                animate__fadeInUp
                                animate__faster
                                `
                            },
                            hideClass: {
                                popup: `
                                animate__animated
                                animate__fadeOutDown
                                animate__faster
                                `
                            }
                        });

                    }
                })
                .catch((error) => {
                    console.log("Erro ao buscar o CNPJ:", error);
                    Swal.fire({
                        title: "Erro ao buscar o CNPJ.",
                        icon: "warning",
                        showClass: {
                            popup: `
                                animate__animated
                                animate__fadeInUp
                                animate__faster
                                `
                        },
                        hideClass: {
                            popup: `
                                animate__animated
                                animate__fadeOutDown
                                animate__faster
                                `
                        }
                    });

                });
        } else {
            Swal.fire({
                title: "Por favor, insira um CNPJ válido.",
                icon: "warning",
                showClass: {
                    popup: `
                                animate__animated
                                animate__fadeInUp
                                animate__faster
                                `
                },
                hideClass: {
                    popup: `
                                animate__animated
                                animate__fadeOutDown
                                animate__faster
                                `
                }
            });


        }
    });
</script>
<script>
    function validatePassword() {
        const passwordInput = document.getElementById("form-password");
        const password = passwordInput.value;
        const regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/;

        if (!regex.test(password)) {
            alert("A senha deve ter no mínimo 6 caracteres, incluindo pelo menos um número e um caractere especial !@#$%^&*.");
            return false; // Evita o envio do formulário
        }
        return true; // Permite o envio do formulário
    }

    document.querySelector("form").onsubmit = validatePassword;
</script>
@endsection