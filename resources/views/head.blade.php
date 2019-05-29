<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> @yield('title') </title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/script.js') }}" defer></script>
        <!-- Select2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7-rc.0/css/select2.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/select2-bootstrap.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7-rc.0/js/select2.full.js"></script>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body class="bg-dark text-white">
        <div id="app">

            <nav class="navbar navbar-expand-md navbar-light navbar-laravel bg-dark text-white">
                <div class="container">
                    <a class="navbar-brand text-white" href="{{ url('/') }}">
                        StrefaRP SAMS - Baza danych
                    </a>

                    <button class="navbar-toggler bg-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse bg-dark" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto bg-dark">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto bg-dark">
                            <!-- Authentication Links -->
                            @if(Auth::guest())
                            @else
                            <div class="nav-item bg-dark text-white">
                                <a class="nav-link text-white" href="{{Route('home')}}">Ostatnie wpisy</a>
                            </div>
                            <div class="nav-item dropdown bg-dark">
                                <div class="nav-link btn btn-default dropdown-toggle bg-dark text-white" data-toggle="dropdown" data-hover="dropdown">Listy<span class="caret"></span></div>
                                <ul class="dropdown-menu bg-dark">
                                    <li><a class="nav-link text-white" href="{{Route('insurance')}}">Lista ubezpieczonych</a></li>
                                    <li><a class="nav-link text-white" href="{{Route('Debtors')}}">Lista dłużników</a></li>
                                    <li><a class="nav-link text-white" href="{{Route('PatientsList')}}">Lista pacjentów</a></li>
                                    <li><a class="nav-link text-white" href="{{Route('EmployeesList')}}">Lista pracowników</a></li>
                                </ul>
                            </div>
                            <div class="nav-item dropdown bg-dark">
                                <div class="nav-link btn btn-default dropdown-toggle bg-dark text-white" data-toggle="dropdown" data-hover="dropdown">Dodania<span class="caret"></span></div>
                                <ul class="dropdown-menu bg-dark text-white">
                                    <li><a class="nav-link text-white" href="{{Route('CardIndexes')}}">Dodaj Zabieg</a></li>
                                    <li><a class="nav-link text-white" href="{{Route('addInsurance')}}">Dodaj ubezpieczenie</a></li>
                                    <li><a class="nav-link text-white" href="{{Route('patient')}}">Dodaj Pacjenta SAMS</a></li>
                                    <li><a class="nav-link text-white" href="{{Route('add')}}">Dodaj Pracownika SAMS</a></li>
                                </ul>
                            </div>
                            @endif
                            @guest
                                <li class="nav-item bg-dark text-white">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @else
                                <li class="nav-item dropdown bg-dark text-white">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right bg-dark text-white" aria-labelledby="navbarDropdown">
                                        @if(Auth::guest())
                                        @else
                                        @if(Auth::user()->name == 'allahaka' or Auth::user()->name == 'KaMisia' or Auth::user()->name == 'Dr_krawix')
                                            <a data-toggle="modal" data-target="#AddAccount" class="dropdown-item text-white">Dodaj konto</a>
                                        @endif()
                                        @endif()
                                        <a data-toggle="modal" data-target="#ChangePassword" class="dropdown-item text-white">Zmień hasło</a>
                                        <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Wyloguj się') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>

                </div>
            </nav>

            <div class="container bg-dark">

                @yield('body')
                @yield('content')

                @if(Auth::guest())
                @else
                    @if(Auth::user()->name == 'allahaka' or Auth::user()->name == 'KaMisia' or Auth::user()->name == 'Dr_krawix')
                        <div class="modal fade" id="AddAccount" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header bg-dark">
                                        <h3 class="modal-title" id="DelTitle">Dodaj konto</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('AddAccount') }}">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="login" class="col-md-4 col-form-label text-md-right">{{ __('Login') }}</label>
                                                <div class="col-md-6">
                                                    <input id="name" type="name" class="bg-dark text-white form-control" name="login" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="bg-dark text-white form-control" name="password" required>
                                                </div>
                                            </div>
                                                @include('popup.head')
                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-secondary">
                                                        Dodaj konto
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif()

                        <div class="modal fade" id="ChangePassword" tabindex="-1" role="dialog" aria-labelledby="DelCenter" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content bg-dark">
                                    <div class="modal-header bg-dark">
                                        <h3 class="modal-title" id="DelTitle">Zmień hasło</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="POST" action="{{ route('ChangePassword') }}">
                                            @csrf

                                            <input type="hidden" name="email" value="{{Auth::user()->name}}">
                                            <div class="form-group row">
                                                <label for="login" class="col-md-4 col-form-label text-md-right">{{ __('Nowe hasło') }}</label>
                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="bg-dark text-white form-control" name="pass" required>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Powtórz hasło') }}</label>
                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="bg-dark text-white form-control" name="rpass" required>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-secondary">
                                                        Zmień hasło
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                @endif()
            </div>
        </div>

        <script type="text/javascript">
            $("#imieSelect").select2({
                placeholder:'Wybierz pacjenta',
                theme: 'bootstrap',
            });
            $("#EmployeeSelect").select2({
                placeholder:'Wybierz pacjenta',
                theme: 'bootstrap',
            });
            $.fn.select2.defaults.set( "theme", "bootstrap" );
        </script>

    </body>
</html>
