@extends('layouts.app')
@section('title', 'Edição')
@section('content')

<section class="vh-100">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Cadastre-se</p>

                                <form action="{{route('store.user')}}" method="POST" class="mx-1 mx-md-4">
                                    @csrf
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="name">Nome</label>
                                            <input type="text" id="name" name="name" class="form-control" required />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="email">E-mail</label>
                                            <input type="email" id="email" name="email" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div data-mdb-input-init class="form-outline mb-3">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <label class="form-label" for="password">Senha</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="form3Example4" class="form-control" placeholder="Digite a sua senha" />
                                            <span class="input-group-text" onclick="togglePasswordVisibility()">
                                                <i class="fa fa-eye" id="togglePasswordIcon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @if (Auth::user()->permission == 'admin')
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div data-mdb-input-init class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="permission">Permissões</label>
                                            <select class="form-control" name="permission">
                                                <option>-------</option>
                                                <option value="admin">Admin</option>
                                                <option value="vistoriador">Vistoriador</option>
                                                <option value="imobiliaria">Imobiliaria</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif

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
</section>
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

@endsection