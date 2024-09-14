<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'VistoriaPro') }}</title>
    <!-- Adicionar CSS do jQuery UI -->
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

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{route('layouts.app')}}">
                    {{ config('app.name', 'VistoriaPro') }}

                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                        @if (Auth::user()->permission == 'imobiliaria')
                        <li><a class="nav-link" href="{{route('imovel.create')}}">Imovel</a></li>
                        <li><a class="nav-link" href="{{route('locloca.create')}}">Locador/Locatario</a></li>
                        <li><a class="nav-link" href="{{route('create.user')}}">Vistoriador</a></li>
                        @endif

                        @if (Auth::user()->permission == 'admin')
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Gerenciamento
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route('locloca.create')}}">
                                    Locador/Locátario
                                </a>
                                <a class="dropdown-item" href="{{route('imovel.create')}}">
                                    Imovel
                                </a>
                                <a class="dropdown-item" href="{{route('quarto')}}">
                                    Ambiente
                                </a>
                            </div>
                        </li>
                        @endif

                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Olá {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <form id="logout-form" action="{{route('login.logout')}}" method="GET" class="d-none">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="{{route('edit.user', Auth::user())}}">
                                    {{ __('Editar') }}
                                </a>
                                <a class="dropdown-item" href="{{route('login.logout')}}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container mt-3">
            @yield('content')

            @if (Auth::user()->permission == 'admin')
            <h1>Teste</h1>
            @endif

            @if (Auth::user()->permission == 'imobiliaria')
            <h1 class="text-center">Vistorias</h1>
            <div class="container mt-5 text-right">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-lg">
                        <i class="bi bi-plus-lg"></i> Vistoria
                    </button>
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
                @endif
        </main>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>
</body>

</html>