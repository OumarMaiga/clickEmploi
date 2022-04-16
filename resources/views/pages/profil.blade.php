<x-app-layout>
    <div class="profil-head">
        <div class="row">
            <div class="col-md-2 d-flex justify-content-center">
                <img alt="" src="{{$photo}}" class="profil-img"/>
            </div>
            <div class="col-md-10">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="profil-name">
                    {{ $user->prenom." ".$user->nom }}
                    @if ($user->email == Auth::user()->email)
                        <a href="{{ route('edit_profil', $user->email) }}" class="align-items-center"> 
                            <button class="btn-modif-profil btn btn-outline-custom">Modifier le profil</button>
                        </a>   
                    @endif
                </div>
                <div class="profil-description">
                    {{ $user->adresse }}
                </div>
                <div class="profil-description">
                    {{ $user->telephone }}
                </div> 
            </div>
        </div>
    </div>
    <div class="profil-body">
        @if ($user->type == "user")
        <div class="row mb-4">
            <div class="col-sm-3">
                Email
            </div> 
            <div class="col-sm-9 profil-description">
                {{ $user->email }}
            </div> 
        </div>
        @endif
        <div class="row mb-4">
            <div class="col-sm-3">
                Secteur d'activité
            </div> 
            <div class="col-sm-9 profil-description">
                {{ $activites->implode(', ') }}
            </div> 
        </div>
        <div class="row mb-4">
            <div class="col-sm-3">
                Adresse
            </div> 
            <div class="col-sm-9 profil-description">
                {{ $user->adresse }}
            </div> 
        </div>
        <div class="row mb-4">
            <div class="col-sm-3">
                Telephone
            </div> 
            <div class="col-sm-9 profil-description">
                {{ $user->telephone }}
            </div> 
        </div>
        <div class="row mb-4">
            <div class="col-sm-3">
                Date de creation de compte
            </div> 
            <div class="col-sm-9 profil-description">
                {{ custom_date($user->created_at) }}
            </div> 
        </div>
        <div class="row mb-4">
            <div class="col-sm-12">
                @if (voir_cv_profil($user->id) == false)
                    Pas de CV
                @else
                    <a target="_blank" href="{{ voir_cv_profil($user->id)->file_path }}" class="btn btn-custom">
                        <u>Voir le CV</u>
                    </a> 
                @endif 
            </div> 
        </div>
    </div>
</x-app-layout>
