<x-app-layout>
    <div class="container content">
        <div class="row">
            <div class="col-md-4">
                <img alt="profil" src="{{$photo}}" class="profil-img" style="height:350px;"/>
                @if (Auth::user()->type == "admin")
                    <div class="mt-4 row">
                        <form  method="POST" action="{{ route('user.changeState', $user->id) }}">
                            @csrf
                            @method('PUT')
                            @if($user->etat==true)
                            <button type="submit" class="mr-4 btn btn-outline-danger" onclick="return confirm('Voulez-vous bloquer l\'utilisateur ?')">
                                BLOQUER
                            </button>
                            @else
                            <button type="submit" class="mr-4 btn btn-outline-success" onclick="return confirm('Voulez-vous debloquer l\'utilisateur ?')">
                                DEBLOQUER
                            </button>
                            @endif
                        </form>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="profil-name">
                    {{ $user->prenom." ".$user->nom }}
                    @if ($user->email == Auth::user()->email)
                        <a href="{{ route('edit_profil', $user->email) }}" class="align-items-center"> 
                            <button class="float-right btn btn-outline-warning">Modifier le profil</button>
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
                        Secteur d'activité:
                            @foreach ($secteurs as $secteur)
                                {{ " - ".$secteur }}    
                            @endforeach 
                    </div>
                @endif
                <div class="profil-description">
                    Curiculium Vitea: 
                    @if (voir_cv_profil($user->id) == false)
                        CV non uploader
                    @else
                        <a target="_blank" href="{{ voir_cv_profil($user->id) }}" class="btn-link">
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
