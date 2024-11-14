@extends('layouts.app')
@section('title', 'Edição')
@section('content')


    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11 my-5">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Vistoriador</p>

                                <form action="{{route('store.user')}}" method="POST" class="mx-1 mx-md-4">
                                    @csrf
                                    <input type="text" name="id_imobiliaria" hidden value="{{Auth::user()->id}}">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <label class="form-label" for="name">Nome</label>
                                            <input type="text" id="name" name="name" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <!-- <i class="fas fa-user fa-lg me-3 fa-fw"></i> -->
                                            <label class="form-label" for="sobreNome">Sobrenome</label>
                                            <input type="text" id="sobreNome" name="sobreNome" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <!-- <i class="fas fa-lock fa-lg me-3 fa-fw"></i> -->
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="cpf">CPF</label>
                                            <input type="text" id="cpf" name="cpf" maxlength="14" class="form-control" required placeholder="000.000.000-00" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <label class="form-label" for="email">E-mail</label>
                                            <input type="email" id="email" name="email" class="form-control" />
                                        </div>
                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-3">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <label class="form-label" for="password">Senha</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="form-password" class="form-control"
                                                required placeholder="Digite a sua senha"
                                                pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$"
                                                title="A senha deve ter no mínimo 8 caracteres, incluindo pelo menos um número e um caractere especial !@#$%^&*." />
                                            <span class="input-group-text" onclick="togglePasswordVisibility()">
                                                <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <!-- <i class="fas fa-key fa-lg me-3 fa-fw"></i> -->
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="permission"></label>
                                            <select class="form-control" name="permission" hidden>
                                                <option value="vistoriador"></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Cadastrar</button>
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
    function validatePassword() {
        const passwordInput = document.getElementById("form-password");
        const password = passwordInput.value;
        const regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

        if (!regex.test(password)) {
            alert("A senha deve ter no mínimo 8 caracteres, incluindo pelo menos um número e um caractere especial !@#$%^&*.");
            return false; // Evita o envio do formulário
        }
        return true; // Permite o envio do formulário
    }

    document.querySelector("form").onsubmit = validatePassword;
    //função para colocar a mascara no CPF
    document.getElementById("cpf").addEventListener("input", function(e) {
        let cpf = e.target.value.replace(/\D/g, "");
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
        e.target.value = cpf;
    });
</script>

@endsection