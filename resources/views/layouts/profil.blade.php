<?php
    $user = Auth::user();
    if($user->username != "") {
        $name = $user->username;
    }elseif ($user->prenom != "" || $user->nom != "") {
        $name = "$user->prenom $user->nom";
    } else {
        $name = $user->email;
    }
?>
<div class="home-profil-container d-none d-md-block">
    @if (photo_profil(Auth::user()->email))
        <img src="{{ photo_profil(Auth::user()->email) }}" alt="Profil de l'utisateur" class="home-profil-img">
    @else
        <img src='/storage/profil_pictures/default.jpg' alt="Profil de l'utisateur" class="home-profil-img"/>
    @endif
    <h6 class="home-profil-title">
        {{ $name }}
    </h6>
    <div class="home-profil-trait"></div>
    <div class="home-profil-button">
        <a href="{{ route('edit_profil', Auth::user()->email) }}" class="btn-outline-custom">Completez votre profil</a>
    </div>
    <div class="home-profil-tag">
        @foreach ($activite_par_profil as $activite)
            <a href="{{ route('opportunite.domaine', $activite->libelle) }}" class="home-profil-tag-text">{{ $activite->libelle }}</a>
        @endforeach
    </div>
</div>