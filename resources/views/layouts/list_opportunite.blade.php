@foreach ($opportunites as $opportunite)
    <?php
        if($offre_par_profil->isEmpty() || !$offre_par_profil->contains('id', $opportunite->id)) {
            $entreprise = $opportunite->entreprise()->associate($opportunite->entreprise_id)->entreprise;
            
            if (Auth::check()) {
                $pts = 0;
                //Les données de l'offre pour les points
                $domaine_par_offre = $opportunite->activites()->distinct()->pluck('secteur_id')->toArray();
                $activite_par_offre = $opportunite->activites()->pluck('id')->toArray();
                $annee_experience_offre = $opportunite->annee_experience;
                $diplome_offre = $opportunite->diplome()->associate($opportunite->niveau)->diplome;
                if ($diplome_offre) {
                    $annee_etude_offre = $diplome_offre->annee_etude;
                }else{
                    $annee_etude_offre = 0;
                }

                //Les données de l'utilisateur user pour les points
                $domaine_par_profil = Auth::user()->activites()->distinct()->pluck('secteur_id')->toArray();
                $activite_par_profil = Auth::user()->activites()->pluck('id')->toArray();
                $annee_experience_profil = Auth::user()->annee_experience;
                $diplome_profil = Auth::user()->diplome()->associate(Auth::user()->dernier_diplome)->diplome;
                if ($diplome_profil) {
                    $annee_etude_profil = $diplome_profil->annee_etude;
                }else{
                    $annee_etude_profil = 0;
                }
                
                //Attribution des points
                if ($annee_etude_profil >= $annee_etude_offre) {
                    $pts = $pts + 2;
                }
                if ($annee_experience_profil >= $annee_experience_offre) {
                    $pts = $pts + 1;
                }
                $activite_intersect = array_intersect($activite_par_offre, $activite_par_profil);
                if(!empty($activite_intersect)){
                    $pts = $pts + 3;
                }
                $domaine_intersect = array_intersect($domaine_par_offre, $domaine_par_profil);
                if(!empty($domaine_intersect)){
                    $pts = $pts + 1;
                } else {
                    $pts = 0;
                }
            }
    ?>
        <div class="offre-item row mx-0">
            <div class="col-lg-3 col-md-4 px-0">
                <img src="{{ photo_entreprise($opportunite->entreprise_id) }}" alt="Image" class="image-offre">
            </div>
            <div class="col-lg-9 col-md-8">
                <h3 class="offre-title">
                    <span>{{ $opportunite->title }}</span>
                    <?php if (Auth::check()) { ?>
                        <span class="star">
                            <span class="fas fa-star icon-star <?= ($pts > 0) ? "color-star" : "" ?>"></span>
                            <span class="fas fa-star icon-star <?= ($pts > 2) ? "color-star" : "" ?>"></span>
                            <span class="fas fa-star icon-star <?= ($pts > 3) ? "color-star" : "" ?>"></span>
                            <span class="fas fa-star icon-star <?= ($pts > 4) ? "color-star" : "" ?>"></span>
                            <span class="fas fa-star icon-star <?= ($pts > 6) ? "color-star" : "" ?>"></span>
                        </span>
                    <?php } ?>
                </h3>
                <div class="offre-subtitle">
                    <a href="{{ route('entreprise.detail', $entreprise->slug) }}">{{ $entreprise->libelle }}</a>  | <span class="fas fa-map-marker-alt"></span> <a href="{{ route('opportunite.adresse', $opportunite->lieu) }}">{{ $opportunite->lieu }}</a>
                </div>
                <div class="offre-description">
                    {!! substr($opportunite->content, 0, 140) !!}...
                </div>
                <div class="row offre-footer d-flex align-items-end">
                        <div class="col-lg-8 col-md-9">
                            Publiée <i class="offre-date">{{ custom_date($opportunite->created_at) }}</i>&nbsp;&nbsp;|&nbsp;&nbsp;Délais <i class="offre-date">{{ custom_date($opportunite->echeance) }}  {{ ($opportunite->echeance->format('d-m-Y') != date('d-m-Y')) ? $opportunite->echeance->format('H:i') : "" }}</i>
                        </div>
                        
                        <div class="col-lg-4 col-md-3 px-0 add-padding">
                            @switch($opportunite->type)
                                @case('emploi')
                                    <a href="{{ route('emploi.detail', $opportunite->slug) }}" class="btn btn-outline-custom float-right btn-list-detail">DETAIL</a>
                                    @break
                                @case('stage')
                                    <a href="{{ route('stage.detail', $opportunite->slug) }}" class="btn btn-outline-custom float-right btn-list-detail">DETAIL</a>
                                    @break
                                @case('formation')
                                    <a href="{{ route('formation.detail', $opportunite->slug) }}" class="btn btn-outline-custom float-right btn-list-detail">DETAIL</a>
                                    @break
                                @default
                            @endswitch
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
@endforeach
