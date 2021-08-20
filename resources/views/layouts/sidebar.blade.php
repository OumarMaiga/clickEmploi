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