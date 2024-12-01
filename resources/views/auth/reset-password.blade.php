<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>VistoriaPro</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">



    <!-- Adicionar jQuery e jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/script.js"></script>
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }

    </style>
</head>

<body>


    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form action="{{route('password.update')}}" method="POST">
                        @csrf

                        <input type="hidden" name="token" value="{{$token}}">

                        <div class="divider d-flex align-items-center my-4">
                            <h1 class="text-center fw-bold mx-3 mb-0">Redefinir Senha</h1>
                        </div>

                        @if ($mensagem = Session::get('erro'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erro',
                                    text: '{{ $mensagem }}'
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
                        <!-- Email input -->
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="email">Endereço de E-mail</label>
                            <input type="email" name="email" id="form3Example3" class="form-control form-control-lg" placeholder="Entre com e-mail válido" required/>
                        </div>

                        <!-- Password input -->

                        <div data-mdb-input-init class="form-outline mb-3">
                            <label class="form-label" for="password">Senha</label>
                            <input type="password" name="password" id="form-password1" class="form-control form-control-lg"
                                required placeholder="Digite a sua senha"
                                pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$"
                                title="A senha deve ter no mínimo 8 caracteres, incluindo pelo menos um número e um caractere especial !@#$%^&*." />
                        </div>

                        <div data-mdb-input-init class="form-outline mb-3">
                            <label class="form-label" for="password_confirmation">Confirmação de Senha</label>
                            <input type="password" name="password_confirmation"
                                id="form-password2" class="form-control form-control-lg"
                                placeholder="Confirme sua senha"
                                required
                                pattern="^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$"
                                title="A senha deve ter no mínimo 8 caracteres, incluindo pelo menos um número e um caractere especial !@#$%^&*." />

                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Recuperar Senha</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    function validatePassword() {
        const passwordInput1 = document.getElementById("form-password1");
        const passwordInput2 = document.getElementById("form-password2");
        const password1 = passwordInput1.value;
        const password2 = passwordInput2.value;
        const regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

        if (!regex.test(password1) && !regex.test(password2)) {
            alert("A senha deve ter no mínimo 8 caracteres, incluindo pelo menos um número e um caractere especial !@#$%^&*.");
            return false; // Evita o envio do formulário
        }
        return true; // Permite o envio do formulário
    }

    document.querySelector("form").onsubmit = validatePassword;
</script>

</html>