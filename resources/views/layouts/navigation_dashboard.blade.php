<nav class="row navbar navbar-expand-sm shadow-sm nav-dashboard" id="navigation">
    <!-- Primary Navigation Menu -->
    <!-- Logo -->
    <a class="navbar-brand" href="{{ route('accueil') }}">
        ClickEmploi
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fas fa-bars" style="color: #FFFFFF"></span>
    </button>

    <!-- Navigation Links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
