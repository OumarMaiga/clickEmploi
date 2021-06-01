<x-dashboard-layout>
    <div class="show-container">
        <div class="show-head-container">
            <div class="show-title">
                {{ $opportunite->title }}
            </div>
            <div class="show-subtitle">
                {{ $opportunite->structure }} &nbsp; | &nbsp; <span class="fas fa-map-marker-alt"></span> {{ $opportunite->lieu }}
            </div>
            <div class="mt-4">
                <a href="#postuler" class="btn btn-custom btn-postule">Je postule</a>
            </div>
        </div>

        <div class="container description description-content">
            <div class="lil-title">Description</div>
            <p>
                {{ $opportunite->content }}
            </p>
        </div>
        <div class="container resume">
            <div class="lil-title">Resumé ...</div>
            @if ($opportunite->type == "emploi" || $opportunite->type == "stage")
                <div class="row">
                    <div class="col-md-3 resume-title">
                        POSTE
                    </div>
                    <div class="col-md-9 description">
                        {{ $opportunite->poste }}
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-3 resume-title">
                        TYPE DE CONTRAT
                    </div>
                    <div class="col-md-9 description text-uppercase">
                        {{ $opportunite->type_contrat }}
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-3 resume-title">
                        TITRE
                    </div>
                    <div class="col-md-9 description">
                        {{ $opportunite->title }}
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-3 resume-title">
                    ENTREPRISE
                </div>
                <div class="col-md-9 description">
                    {{ $entreprise->libelle }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 resume-title">
                    LOCALITE
                </div>
                <div class="col-md-9 description">
                    {{ $opportunite->lieu}}
                </div>
            </div>
            @if ($opportunite->type == "emploi")
                <div class="row">
                    <div class="col-md-3 resume-title">
                        EXPERIENCE
                    </div>
                    <div class="col-md-9 description">
                        {{ $opportunite->annee_experience }}
                    </div>
                </div>
            @endif
            
            <div class="row">
                <div class="col-md-3 resume-title">
                    NIVEAU D'ETUDE
                </div>
                <div class="col-md-9 description">
                    {{ $opportunite->niveau }}
                </div>
            </div>

            @if ($opportunite->type == "formation")
                <div class="row">
                    <div class="col-md-3 resume-title">
                        PREREQUIS
                    </div>
                    <div class="col-md-9 description">
                        {{ $opportunite->prerequis }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 resume-title">
                        Prix
                    </div>
                    <div class="col-md-9 description">
                        {{ $opportunite->montant }}
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-3 resume-title">
                        SALAIRE
                    </div>
                    <div class="col-md-9 description">
                        {{ $opportunite->montant }}
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-3 resume-title">
                    <i>Publié le 12 Avr 2021</i>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>