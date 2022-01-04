    <div class="dashboard-content-detail-offre">
        <div class="show-head-container">
            <div class="show-title">
                {{ $opportunite->title }}
            </div>
            <div class="show-subtitle">
                <a href="{{ route('entreprise.detail', $entreprise->slug) }}">{{ $entreprise->libelle }}</a> &nbsp; | &nbsp; <span class="fas fa-map-marker-alt"></span> <a href="{{ route('opportunite.adresse', $opportunite->lieu) }}">{{ $opportunite->lieu }}</a>
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
                        {{ $annee_experience }}
                    </div>
                </div>
            @endif
            
            <div class="row">
                <div class="col-md-3 resume-title">
                    NIVEAU D'ETUDE
                </div>
                <div class="col-md-9 description">
                    {{ ($niveau != null) ? $niveau->libelle : "" }}
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
                <div class="row">
                    <div class="col-md-3 resume-title">
                        Secteur d'activité:
                    </div>
                    <div class="col-md-9 description">
                        {{ $activites->implode(', ') }}
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 resume-title">
                    <i>Publié {{ custom_date($opportunite->created_at) }}</i>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 resume-title">
                    <i>Delais de depôt {{ custom_date($opportunite->echeance) }}  {{ ($opportunite->echeance->format('d-m-Y') != date('d-m-Y')) ? $opportunite->echeance->format('H:i') : "" }}</i>
                </div>
            </div>
        </div>
        <div class="container list-container">
            <div class="lil-title">LES POSTULANTS</div>
            <table class="table table-hover table-responsive-md">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Prenom et Nom</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telephone</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n = 0 ?>
                    @foreach ($postulants as $postulant)
                    <?php $n = $n + 1 ?>
                        <tr>
                            <th scope="row">{{ $n }}</th>
                            <td>{{ $postulant->prenom." ".$postulant->nom }} </td>
                            <td>{{ $postulant->email }}</td>
                            <td>{{ $postulant->telephone }}</td>
                            <td class="justify-content-between icon-content">
                                @if (voir_cv_postulant($postulant->id) == false)
                                    CV non uploader
                                @else
                                    <a target="_blank" href="{{ voir_cv_postulant($postulant->id) }}" class="col icon-action">
                                        <button class="btn btn-custom">Voir CV</button>
                                    </a> 
                                @endif                               
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>