<x-app-layout>
    <div class="container content">
        <div class="row">
            <div class="col-md-4">
                <img alt="profil" src="{{$photo}}" class="profil-img" style="height:350px;"/>
            
            </div>
            <div class="col-md-8">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div class="profil-name">
                    {{ $user->prenom." ".$user->nom }}
                    <a href="{{ route('edit_profil', $user->email) }}" class="align-items-center"> <button class="float-right btn btn-outline-warning">Modifier le profil</button></a>
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
                <div class="profil-description">
                    Secteur d'activité: Design, Economie, Football
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
