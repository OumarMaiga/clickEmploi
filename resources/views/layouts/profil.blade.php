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
<div class="home-profil-container">
    <img src="" alt="Profil de l'utisateur" class="home-profil-img"/>
    <h6 class="home-profil-title">
        {{ $name }}
    </h6>
    <div class="home-profil-tag">
        @foreach ($activite_par_profil as $activite)
            <a href="#" class="home-profil-tag-text">{{ $activite->libelle }}</a>
        @endforeach
        <!--<a href="#" class="home-profil-tag-text">Finance</a>
        <a href="#" class="home-profil-tag-text">Marketing</a>
        <a href="#" class="home-profil-tag-text">Communuty management</a>-->
    </div>
</div>