<nav class="navbar navbar-expand-sm shadow-sm nav-dashboard" id="navigation">
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
        <div class="d-block d-sm-none">
            <hr>
                <div class="sidebar-title">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="fas fa-home icon-sidebar"></i><span class="">TABLEAU DE BOARD</span>
                    </a>
                </div>
                <ul class="sidebar-list">
                    @if (Auth::user()->type == "admin")
                        <li class="sidebar-item">
                            <a href="{{ route('partenaire.index') }}" class="sidebar-link">
                                <i class="fas fa-user-friends icon-sidebar"></i><span class="pl-2">PARTENAIRE</span>
                            </a>
                        </li>
                    @endif
                    <li class="sidebar-item dropdown-btn">
                        <a href="#" class="sidebar-link">
                            <i class="fas fa-bullhorn icon-sidebar"></i><span class="pl-2">OPPORTUNITE</span>
                            <i class="fa fa-caret-down"></i>
                        </a>
                    </li>
                    <div class="dropdown-container">
                        <li class="sidebar-item">
                            <a href="{{ route('emploi.index') }}" class="sidebar-link">
                                <i class="fas fa-suitcase icon-sidebar"></i><span class="pl-2">EMPLOI</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('formation.index') }}" class="sidebar-link">
                                <i class="fas fa-graduation-cap icon-sidebar"></i><span class="pl-2">FORMATION</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('stage.index') }}" class="sidebar-link">
                                <i class="fas fa-suitcase icon-sidebar"></i><span class="pl-2">STAGE</span>
                            </a>
                        </li>
                    </div>
                    <li class="sidebar-item">
                        <a href="{{ route('entreprise.index') }}" class="sidebar-link">
                            <i class="fas fa-building icon-sidebar"></i><span class="pl-2">ENTREPRISE</span>
                        </a>
                    </li>
                    @if (Auth::user()->type == "admin")
                        <li class="sidebar-item">
                            <a href="{{ route('abonnee') }}" class="sidebar-link">
                                <i class="fas fa-user-shield icon-sidebar"></i><span class="pl-2">ABONNEE</span>
                            </a>
                        </li>
                    @endif
                    <li class="sidebar-item">
                        <a href="{{ route('user.index') }}" class="sidebar-link">
                            <i class="fas fa-users icon-sidebar"></i><span class="pl-2">UTILISATEUR</span>
                        </a>
                    </li>
                    @if (Auth::user()->type == "admin")
                        <li class="sidebar-item">
                            <a href="{{ route('config') }}" class="sidebar-link">
                                <i class="fas fa-cog icon-sidebar"></i><span class="pl-2">CONFIGURATION</span>
                            </a>
                        </li>
                    @endif
                </ul>
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
                    <div class="d-block d-sm-none">
                        <hr>
                    </div>
                <div class="d-block d-md-none">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profil', Auth::user()->email) }}">
                            {{ (Auth::user()->prenom || Auth::user()->nom) ? Auth::user()->prenom." ".Auth::user()->nom : Auth::user()->email }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
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
