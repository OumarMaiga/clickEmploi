<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="og:title" content="boutons de partage de réseaux sociaux clickemploi.com"/> 
        <meta property="og:image" content="lien de l'image de votre site"/> 
        <meta property="og:url " content="clickemploi.com"/> 
        <meta property="og:description" content="boutons de partage des réseaux sociaux php"/>

        <title>{{ config('app.name', 'Click emploi') }}</title>
        <!-- Fonts Awesome -->
        <script src="https://kit.fontawesome.com/a0707a958b.js" crossorigin="anonymous"></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- JQUERY -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <!-- BOOTSTRAP CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">    
        <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/auth.css') }}" rel="stylesheet" type="text/css" >
        <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css" >

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Tiny -->
        <script src="https://cdn.tiny.cloud/1/omdjpqfhd17dsn9me2xxarz1g3og7awzo2r3coi81zk6tn8j/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            @include('layouts.footer')
        </div>

        <!-- BOOTSTRAP JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    </body>
</html>
