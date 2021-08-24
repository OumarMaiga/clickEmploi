<nav class="navbar navbar-expand-sm shadow-sm" id="navigation">
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
                <li class="nav-item dropdown d-none d-md-block">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @if (photo_profil(Auth::user()->email))
                            <img src="{{ photo_profil(Auth::user()->email) }}" class="photo_profil_nav">
                        @else
                            <img src='/storage/profil_pictures/default.jpg' class="photo_profil_nav"/>
                        @endif
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('profil', Auth::user()->email) }}">
                            {{ (Auth::user()->prenom || Auth::user()->nom) ? Auth::user()->prenom." ".Auth::user()->nom : Auth::user()->email }}
                        </a>
                        @if(Auth::user()->type == "admin" || Auth::user()->type == "partenaire")
                            <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            this.closest('form').submit();">
                                Deconnexion
                            </a>
                        </form>
                        

                    </div>
                </li>
                <div class="d-block d-md-none">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profil', Auth::user()->email) }}">
                            {{ (Auth::user()->prenom || Auth::user()->nom) ? Auth::user()->prenom." ".Auth::user()->nom : Auth::user()->email }}
                        </a>
                    </li>
                    @if(Auth::user()->type == "admin" || Auth::user()->type == "partenaire")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="btn btn-red" href="{{ route('logout') }}" onclick="event.preventDefault();
                            this.closest('form').submit();">
                                Deconnexion
                            </a>
                        </form>
                    </li>
                </div>
            @endguest
        </ul>
    </div>
</nav>
