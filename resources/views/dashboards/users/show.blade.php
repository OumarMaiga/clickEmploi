<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-md-4">
                <img alt="profil" src="" class="profil-img"/>
                <div class="mt-4 row">
                    <form  method="POST" action="{{ route('user.changeState', $user->id) }}">
                        @csrf
                        @method('PUT')
                        @if($user->etat==true)
                        <button type="submit" class="mr-4 btn btn-outline-warning" onclick="return confirm('Voulez-vous bloquer l\'utilisateur ?')">
                            BLOQUER
                        </button>
                        @else
                        <button type="submit" class="mr-4 btn btn-outline-success" onclick="return confirm('Voulez-vous debloquer l\'utilisateur ?')">
                            DEBLOQUER
                        </button>
                        @endif

                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="profil-name">
                    {{ $user->prenom." ".$user->nom }}
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
</x-dashboard-layout>
