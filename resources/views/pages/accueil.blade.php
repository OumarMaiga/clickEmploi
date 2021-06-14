<x-app-layout>
    <div class="head">
        <div class="head-word">
            Trouver votre emploi préféré<br>
            dans nos différents offres
        </div>
        <div class="head-offre">
            <div class="head-offre-title">
                ENVIRON
            </div>
            <div class="head-offre-nunber">
                75 offres / semaine
            </div> 
        </div>
    </div>
    @include('layouts.search_bar');
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
        <h2 class="zone-title">Les offres d'emploi par zone</h2>
        <div class="row">
            <div class="col-md-4">
                Yirimadjo
            </div>
            <div class="col-md-4">
                Kalaban-coura
            </div>
            <div class="col-md-4">
                Sokorodji
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Magnabougou
            </div>
            <div class="col-md-4">
                Sotuba
            </div>
            <div class="col-md-4">
                Hamdallaye ACI 2000
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                Balabougou  
            </div>
            <div class="col-md-4">
                Niamana
            </div>
            <div class="col-md-4">
                Banconi
            </div>
        </div>
    </div>
</x-app-layout>
