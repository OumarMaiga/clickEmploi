<x-app-layout>
    <div class="head">
        <div class="head-word">
            Plus besoin de chercher les offres d'emploi <br>
            Ce sont les offres qui viennent en vous grace a un systeme d'alerte matching
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
        <h2 class="zone-title">Les opportunités par zone</h2>
        <div class="row">
            @foreach($adresses as $adresse)
                <div class="col-md-4">
                    <a href="{{ route('opportunite.adresse', $adresse->lieu) }}">{{ $adresse->lieu }}</a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
