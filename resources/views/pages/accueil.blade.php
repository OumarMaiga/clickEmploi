<x-app-layout>
    <div class="head">
        <div class="head-word">
            Plus besoin de chercher les offres d'emploi <br>
            Ce sont les offres qui viennent à vous grace a un systeme d'alerte matching
        </div>
        <div class="head-offre">
            <div class="head-offre-title">
                ENVIRON
            </div>
            <div class="head-offre-nunber">
                127 offres / semaine
            </div> 
        </div>
    </div>
    @include('layouts.search_bar')
    <div class="entreprise">
        <h2 class="entreprise-title">Les entreprises qui recrutent le plus</h2>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="entreprise-link">
                    <div class="orange entreprise-item">
                        <span class="entreprise-offre">23 offres</span>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a href="#" class="entreprise-link">
                    <div class="huawei entreprise-item">
                        <span class="entreprise-offre">17 offres</span>
                    </div>
                </a>
                <a href="#" class="entreprise-link">
                    <div class="azalai entreprise-item">
                        <span class="entreprise-offre">12 offres</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="zone">
        <h2 class="zone-title">Les offres d'emploi filtré</h2>
        <div class="row offre-filtre-container">
            <ul class="nav nav-tabs w-100" id="myTab" role="tablist">
                <li class="nav-item col-sm-4 px-0 tab-item" role="presentation">
                    <a class="nav-link active" id="domaine-tab" data-toggle="tab" href="#domaine" role="tab" aria-controls="domaine" aria-selected="true">DOMAINE</a>
                </li>
                <li class="nav-item col-sm-4 px-0 tab-item" role="presentation">
                    <a class="nav-link" id="zone-tab" data-toggle="tab" href="#zone" role="tab" aria-controls="zone" aria-selected="false">ZONE</a>
                </li>
                <li class="nav-item col-sm-4 px-0 tab-item" role="presentation">
                    <a class="nav-link" id="poste-tab" data-toggle="tab" href="#poste" role="tab" aria-controls="poste" aria-selected="false">POSTE</a>
                </li>
            </ul>
            <div class="tab-content w-100" id="myTabContent">
                <div class="tab-pane fade show active" id="domaine" role="tabpanel" aria-labelledby="domaine-tab">
                    <div class="row">
                        @foreach($activites as $activite)
                            <div class="col-md-3">
                                <a href="{{ route('opportunite.domaine', $activite->slug) }}">{{ $activite->libelle }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="zone" role="tabpanel" aria-labelledby="zone-tab">
                    <div class="row">
                        @foreach($adresses as $adresse)
                            <div class="col-md-3">
                                <a href="{{ route('opportunite.adresse', $adresse->lieu) }}">{{ $adresse->lieu }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="poste" role="tabpanel" aria-labelledby="poste-tab">
                    <div class="row">
                        @foreach($postes as $poste)
                            <div class="col-md-3">
                                <a href="{{ route('opportunite.poste', $poste->title) }}">{{ $poste->title }}</a>
                            </div>
                        @endforeach 
                    </div>             
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
