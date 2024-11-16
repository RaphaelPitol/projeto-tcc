<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                            <input type="email" name="email" id="form3Example3" class="form-control form-control-lg" placeholder="Entre com e-mail válido" />
                        </div>

                        <!-- Password input -->

                        <div data-mdb-input-init class="form-outline mb-3">
                            <label class="form-label" for="password">Senha</label>
                            <input type="password" name="password" id="form3Example4" class="form-control form-control-lg" placeholder="nova senha" />
                        </div>

                        <div data-mdb-input-init class="form-outline mb-3">
                            <label class="form-label" for="password_confirmation">Confirmação de Senha</label>
                            <input type="password" name="password_confirmation" id="form3Example4" class="form-control form-control-lg" placeholder="confirme sua senha" />
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

</html>