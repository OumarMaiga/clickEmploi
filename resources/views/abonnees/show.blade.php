<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="row">
                <div class="col-md-4">
                    <img alt="profil" src="" class="profil-img"/>
                    <div class="mt-4 row">
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
                            <h6 class="subtitle">Date de debut</h6>
                            <p class="">15-05-2021</p>
                        </div>
                        <div class="col text-center">
                            <h6 class="subtitle">Date d'expiration</h6>
                            <p class="">15-06-2021</p>
                        </div>
                        <div class="col text-center">
                            <h6 class="subtitle"></h6>
                            <p class="number"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
