<x-app-layout>
    <div class="main-content">
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center">
                <img alt="profil" src="{{$photo}}" class="profil-img"/>
            </div>
            <div class="col-md-8">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="profil-name">
                    {{ $user->prenom." ".$user->nom }}
                    @if ($user->email == Auth::user()->email)
                        <a href="{{ route('edit_profil', $user->email) }}" class="align-items-center"> 
                            <button class="btn-modif-profil btn btn-outline-warning">Modifier le profil</button>
                        </a>   
                    @endif
                </div>
                <div class="profil-email">
                    {{ $user->email }}
                </div>
                <div class="profil-description">
                    Tel: {{ $user->telephone }}
                </div>
                <div class="profil-description">
                    Adresse: {{ $user->adresse }}
                </div>
                @if ($user->type == "user")
                    <div class="profil-description">
                        Secteur d'activité: {{ $activites->implode(', ') }}
                    </div>
                @endif
                <div class="profil-description">
                    Curiculium Vitea: 
                    @if (voir_cv_profil($user->id) == false)
                        CV non uploader
                    @else
                        <a target="_blank" href="{{ voir_cv_profil($user->id)->file_path }}" class="btn-link">
                            <u>Voir le CV</u>
                        </a> 
                    @endif 
                </div>  
                <br/>
                <hr/>
                <br/>
                <div class="row">
                    <div class="col text-center">
                        <h6 class="subtitle">Emploi publié</h6>
                        <p class="number">2</p>
                    </div>
                    <div class="col text-center">
                        <h6 class="subtitle">Formation publiée</h6>
                        <p class="number">1</p>
                    </div>
                    <div class="col text-center">
                        <h6 class="subtitle">Stage publié</h6>
                        <p class="number">5</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
