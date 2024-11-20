<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- PWA  -->
    <!-- <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}"> -->

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="d-flex flex-column min-vh-100">
    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Sem permissão",
                text: "{{ session('error') }}",
                icon: "error"
            });
        })
    </script>
    @endif

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                @auth
                @if (Auth::user()->permission == 'vistoriador')
                <a class="navbar-brand d-flex align-items-center justify-content-center" href="{{route('vistoriador.home')}}">
                <img src="/image/casa.png" alt="" class="img-fluid align-middle" style="height: 1.2em; margin-right: 0.5em;">
                    {{ config('app.name', 'VistoriaPro') }}
                </a>
                @endif
                @if (Auth::user()->permission == 'admin')
                <a class="navbar-brand d-flex align-items-center justify-content-center" href="{{route('admin.home')}}">
                <img src="/image/casa.png" alt="" class="img-fluid align-middle" style="height: 1.2em; margin-right: 0.5em;">
                    {{ config('app.name', 'VistoriaPro') }}
                </a>
                @endif
                @if (Auth::user()->permission == 'imobiliaria')
                <a class="navbar-brand d-flex align-items-center justify-content-center" href="{{ route('imobiliaria.home') }}">
                    <img src="/image/casa.png" alt="" class="img-fluid align-middle" style="height: 1.2em; margin-right: 0.5em;">
                    {{ config('app.name', 'VistoriaPro') }}
                </a>
                @endif

                @endauth

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                        @if (Auth::user()->permission == 'admin')
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Gerenciamento
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{route(name: 'imobiliaria')}}">
                                    Imobiliaria
                                </a>

                                <div class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Piso
                                        <span class="dropdown-arrow"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{route('piso.index')}}">Tipo de Piso</a></li>
                                        <li><a class="dropdown-item" href="{{route('descricaoPiso.index')}}">Descrição de Piso</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Parede
                                        <span class="dropdown-arrow"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{route('parede.index')}}">Tipo de Parede</a></li>
                                        <li><a class="dropdown-item" href="#">Descrição de Parede</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Teto
                                        <span class="dropdown-arrow"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Tipo de Teto</a></li>
                                        <li><a class="dropdown-item" href="#">Descrição de Teto</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Porta
                                        <span class="dropdown-arrow"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Tipo de Porta</a></li>
                                        <li><a class="dropdown-item" href="#">Descrição de Porta</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Janela
                                        <span class="dropdown-arrow"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Tipo de Janela</a></li>
                                        <li><a class="dropdown-item" href="#">Descrição de Janela</a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-submenu">
                                    <a class="dropdown-item dropdown-toggle" href="#">Eletrica
                                        <span class="dropdown-arrow"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Tipo de Interruptor</a></li>
                                        <li><a class="dropdown-item" href="#">Tipo de Tomada</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @endif

                        @if (Auth::user()->permission == 'imobiliaria')
                        <li><a class="nav-link" href="{{route('locloca.index')}}">Locador/Locatario</a></li>
                        <li><a class="nav-link" href="{{route('vistoriadores.list')}}">Vistoriador</a></li>
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
                                <a class="dropdown-item" href="#" onclick="confirmLogout(event)">
                                    {{ __('Sair') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
    <main class="flex-grow-1">
        @yield('content')
    </main>
    <footer class="bg-dark text-light py-3 mt-auto">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Logo e Descrição -->
                <div class="col-md-6">
                    <h5 class="text-uppercase">
                        VistoriaPro</h5>
                    <p>Facilitando o gerenciamento e as vistorias de imóveis com tecnologia e precisão. Nosso compromisso é com a sua segurança e tranquilidade.</p>
                </div>
                <div class="col-md-4">
                    <h5 class="text-uppercase">Contato</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt"></i> Rua Exemplo, 123, Cidade</li>
                        <li><i class="fas fa-phone"></i> (11) 1234-5678</li>
                        <li><i class="fas fa-envelope"></i> contato@vistoriapro.com</li>
                    </ul>
                </div>
            </div>

            <!-- Direitos Autorais -->
            <div class="row">
                <div class="col text-center">
                    <small>&copy; {{ date('Y') }} VistoriaPro. Todos os direitos reservados.</small>
                </div>
            </div>
        </div>
    </footer>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        function confirmLogout(event) {
            event.preventDefault(); // Previne o comportamento padrão do link

            Swal.fire({
                title: 'Deseja realmente sair?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, sair',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }
    </script>
</body>

</html>