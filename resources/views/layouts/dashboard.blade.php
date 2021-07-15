<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Fonts Awesome -->
        <script src="https://kit.fontawesome.com/a0707a958b.js" crossorigin="anonymous"></script>
        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- BOOTSTRAP CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">    
        <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/auth.css') }}" rel="stylesheet" type="text/css" >

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="row">
            <div class="col-lg-2">
                <div class="sidebar">
                    <div class="sidebar-title">
                        <a href="{{ route('dashboard') }}" class="sidebar-link">
                            <i class="fas fa-home icon-sidebar"></i><span class="d-none d-lg-inline-block">Tableau de bord</span>
                        </a>
                    </div>
                    <ul class="sidebar-list">
                        @if (Auth::user()->type == "admin")
                            <li class="sidebar-item">
                                <a href="{{ route('partenaire.index') }}" class="sidebar-link">
                                    <i class="fas fa-user-friends icon-sidebar"></i><span class="d-none d-lg-inline-block">PARTENAIRE</span>
                                </a>
                            </li>
                        @endif
                        <li class="sidebar-item dropdown-btn">
                            <a href="#" class="sidebar-link">
                                <i class="fas fa-bullhorn icon-sidebar"></i><span class="d-none d-lg-inline-block">OPPORTUNITE</span>
                                <i class="fa fa-caret-down"></i>
                            </a>
                        </li>
                        <div class="dropdown-container">
                            <li class="sidebar-item">
                                <a href="{{ route('emploi.index') }}" class="sidebar-link">
                                    <i class="fas fa-suitcase icon-sidebar"></i><span class="d-none d-lg-inline-block">EMPLOI</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('formation.index') }}" class="sidebar-link">
                                    <i class="fas fa-graduation-cap icon-sidebar"></i><span class="d-none d-lg-inline-block">FORMATION</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('stage.index') }}" class="sidebar-link">
                                    <i class="fas fa-suitcase icon-sidebar"></i><span class="d-none d-lg-inline-block">STAGE</span>
                                </a>
                            </li>
                        </div>
                        <li class="sidebar-item">
                            <a href="{{ route('entreprise.index') }}" class="sidebar-link">
                                <i class="fas fa-building icon-sidebar"></i><span class="d-none d-lg-inline-block">ENTREPRISE</span>
                            </a>
                        </li>
                        @if (Auth::user()->type == "admin")
                            <li class="sidebar-item">
                                <a href="{{ route('abonnee') }}" class="sidebar-link">
                                    <i class="fas fa-user-shield icon-sidebar"></i><span class="d-none d-lg-inline-block">ABONNEE</span>
                                </a>
                            </li>
                        @endif
                        <li class="sidebar-item">
                            <a href="{{ route('user.index') }}" class="sidebar-link">
                                <i class="fas fa-users icon-sidebar"></i><span class="d-none d-lg-inline-block">UTILISATEUR</span>
                            </a>
                        </li>
                        @if (Auth::user()->type == "admin")
                            <li class="sidebar-item">
                                <a href="{{ route('config') }}" class="sidebar-link">
                                    <i class="fas fa-cog icon-sidebar"></i><span class="d-none d-lg-inline-block">CONFIGURATION</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-10 px-0 md-decalle">
                @include('layouts.navigation_dashboard')  
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>              
            </div>
        </div>
        

        <!-- BOOTSTRAP JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/dashboard.js') }}"></script>
    </body>
</html>
