@extends('layouts.app')
@section('title', 'Edição')
@section('content')

<section class="vh-100 mb-04">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-1">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h4 fw-bold mb-5 mx-1 mx-md-4 mt-2">Edição Locador/Locatário</p>

                <form action="{{route('locloca.update', $locloca)}}" method="POST" class="mx-1 mx-md-4">
                @csrf
                @method('PUT')
                  <div class="d-flex flex-row align-items-center mb-2">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="name">Nome Completo</label>
                      <input type="text" id="name"  name="name" class="form-control" value="{{$locloca->name}}"/>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="telefone">Telefone</label>
                      <input type="tel" id="telefone" name="telefone" class="form-control" value="{{$locloca->telefone}}"/>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="rg" >RG</label>
                      <input type="text" id="rg" name="rg" class="form-control" required value="{{$locloca->rg}}"/>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <label class="form-label" for="cpf" >CPF</label>
                      <input type="text" id="cpf" name="cpf" class="form-control" required value="{{$locloca->cpf}}"/>
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Cadastrar</button>
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