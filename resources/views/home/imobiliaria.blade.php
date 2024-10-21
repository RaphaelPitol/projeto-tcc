@extends('layouts.appimobiliaria')
@section('title', 'Piso')
@section('content')


<h1 class="text-center mt-1">Vistorias</h1>
<div class="container mt-5 text-right">
    <div class="d-grid gap-2">
        <a class="btn btn-primary mr-3" href="{{ route('vistoria.index') }}">
            <i class="bi bi-plus-lg"></i> Vistoria
        </a>
    </div>
</div>
<div class="container mt-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white text-center">
                        <h3 class="card-title">Realizadas</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>Vistoria</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Apto-Fulano de Tal</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <button class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></button>
                                            <button class="btn btn-outline-secondary"><i class="bi bi-filetype-pdf"></i></button>
                                            <button class="btn btn-outline-danger"><i class="bi bi-trash-fill"></i></button>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <!-- <td>Dado 3</td>
                                                <td>Dado 4</td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-danger text-white text-center">
                        <h3 class="card-title">Pendentes</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-primary">
                                <tr>
                                    <th>Vistoria</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Apto-Fulano de Tal</td>
                                    <td>
                                        <div class="d-flex justify-content-around">
                                            <button class="btn btn-outline-danger"><i class="bi bi-hourglass"></i></button>
                                        </div>

                                    </td>
                                </tr>
                                <tr>
                                    <!-- <td>Dado C</td>
                                                <td>Dado D</td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection