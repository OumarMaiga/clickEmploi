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
            <div class="col-md-2">
                <div class="sidebar">
                    <div class="sidebar-title">
                        <a href="{{ route('dashboard') }}" class="sidebar-link">
                            TABLEAU DE BORD
                        </a>
                    </div>
                    <ul class="sidebar-list">
                        <li class="sidebar-item">
                            <a href="{{ route('partenaire.index') }}" class="sidebar-link">
                                PARTENAIRE
                            </a>
                        </li>
                        <li class="sidebar-item dropdown-btn">
                            <a href="#" class="sidebar-link">
                                OPPORTUNITE
                                <i class="fa fa-caret-down"></i>
                            </a>
                        </li>
                            <div class="dropdown-container">
                                <li class="sidebar-item">
                                    <a href="{{ route('emploi.index') }}" class="sidebar-link">
                                        EMPLOI
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('formation.index') }}" class="sidebar-link">
                                        FORMATION
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ route('stage.index') }}" class="sidebar-link">
                                        STAGE
                                    </a>
                                </li>
                            </div>
                        <li class="sidebar-item">
                            <a href="{{ route('diplome.index') }}" class="sidebar-link">
                                DIPLOME
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('secteur.index') }}" class="sidebar-link">
                                SECTEUR D'ACTIVITE
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('entreprise.index') }}" class="sidebar-link">
                                ENTREPRISE
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('abonnee') }}" class="sidebar-link">
                                ABONNEE
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('user.index') }}" class="sidebar-link">
                                UTILISATEUR
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 offset-md-2">
                <div class="row">
                    <div class="col-md-12">
                        @include('layouts.navigation')
                    </div>
                    
                </div>
                
            </div>
        </div>
        

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>

        <!-- BOOTSTRAP JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/dashboard.js') }}"></script>
    </body>
</html>
