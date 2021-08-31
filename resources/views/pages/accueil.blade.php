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
        <div class="head-btn-content">
            @if (Auth::check())
                <a href="{{ route('profil', Auth::user()->email) }}" class="btn btn-custom head-btn">Voir mon profil</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-custom head-btn">Inscrivez-vous !!!</a>
            @endif
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
    <div class="avantage">
        <h1 class="avantage-title">
            Les avantages du matching Click emploi
        </h1>
        <div class="trait-container">
            <div class="trait"></div>
        </div>
        <div class="avantage-content">
            <div class="avantage-item">
                <i class="fas fa-search avantage-icon"></i>&nbsp;
                <span class="avantage-item-title" style="margin-top: 0.2rem;">Une recherche d’emploi simplifiée</span>
                <p class="avantage-item-text">Plus besoin de faire des recherches complexes, ce sont les offres qui viennent à vous ! Il vous suffit de créer votre profil en moins de 5 minutes.</p>
            </div>
        </div>
        <div class="avantage-content">
            <div class="avantage-item">
                <i class="fas fa-sliders-h avantage-icon"></i>&nbsp;
                <span class="avantage-item-title" style="margin-top: 0.5rem;">Des offres adaptées</span>
            </div>
            <p class="avantage-item-text">Le matching permet de vous présenter uniquement les offres qui ont une forte correspondance avec votre profil. </p>
        </div>
        <div class="avantage-content">
            <div class="avantage-item">
                <i class="fas fa-bolt avantage-icon"></i>&nbsp;
                <span class="avantage-item-title">Des offres présentées dès leur publication</span>
                <p class="avantage-item-text">Tous les jours l’algorithme de matching analyse toutes les nouvelles offres d’emploi publiées sur Meteojob et vous envoie celles qui vous correspondent par e-mail. Facile non ?</p>
            </div>
        </div>
    </div>
    <div class="comment">
        <h1 class="comment-title">
            Le matching dans l’emploi, comment ça marche ?
        </h1>
        <div class="trait-container">
            <div class="trait"></div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="d-flex justify-content-center">
                    <img src="/image/comment-1.png" alt="image-circle" class="comment-image"/>
                </div>
                <p class="comment-text">
                    Votre <b>profil</b> et vos souhaits professionnels sont comparés à toutes les nouvelles <b>offres d'emploi</b> de Click emploi
                </p>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-center">
                    <img src="/image/comment-2.png" alt="image-circle" class="comment-image"/>
                </div>
                <p class="comment-text">
                    Les offres sont triées par pertinence, de <b>0 à 5 étoiles</b>, en fonction de leur correspondance avec votre profil
                </p>
            </div>
            <div class="col-md-4">
                <div class="d-flex justify-content-center">
                    <img src="/image/comment-3.png" alt="image-circle" class="comment-image"/>
                </div>
                <p class="comment-text">
                    Les offres sont affichées sur votre page <b>Mes offres</b> d’emploi et envoyées par e-mail
                </p>
            </div>
        </div>
    </div>
    <div class="zone">
        <h2 class="zone-title">Les offres d'emploi filtré</h2>
        <div class="offre-filtre-container">
            <ul class="nav nav-tabs w-100" id="myTab" role="tablist">
                <li class="nav-item col-4 px-0 tab-item" role="presentation">
                    <a class="nav-link active" id="domaine-tab" data-toggle="tab" href="#domaine" role="tab" aria-controls="domaine" aria-selected="true">DOMAINE</a>
                </li>
                <li class="nav-item col-4 px-0 tab-item" role="presentation">
                    <a class="nav-link" id="zone-tab" data-toggle="tab" href="#zone" role="tab" aria-controls="zone" aria-selected="false">ZONE</a>
                </li>
                <li class="nav-item col-4 px-0 tab-item" role="presentation">
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
