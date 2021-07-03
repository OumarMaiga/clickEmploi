<nav class="navbar navbar-expand-sm shadow-sm nav-custom" id="navigation">
    <!-- Primary Navigation Menu -->
    <!-- Logo -->
    <a class="navbar-brand" href="{{ route('accueil') }}">
        <img src="{{ url('/image/logo-white.jpeg')}}" alt="Logo" class="logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fas fa-bars" style="color: #FFFFFF"></span>
    </button>

    <!-- Navigation Links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">{{ __('Accueil') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('emploi.list') }}">{{ __('Emploi') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('stage.list') }}">{{ __('Stage') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('formation.list') }}">{{ __('Formation') }}</a>
            </li>
        </ul>

        <div class="d-block d-sm-none">
            <hr>
        </div>
        
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @if (photo_profil(Auth::user()->email))
                            <img src="{{ photo_profil() }}" class="photo_profil_nav">
                        @else
                            <img src='/storage/profil_pictures/default.jpg' class="photo_profil_nav"/>
                        @endif
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if(Auth::user()->type == "admin" || Auth::user()->type == "partenaire")
                            <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('profil', Auth::user()->email) }}">Profil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        

                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
