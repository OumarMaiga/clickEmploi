@foreach ($opportunites as $opportunite)
    <?php $entreprise = $opportunite->entreprise()->associate($opportunite->entreprise_id)->entreprise; ?>
        <div class="offre-item row mx-0">
        <div class="col-lg-2 col-md-3 px-0 add-padding">
            <img src="{{ photo_entreprise($opportunite->entreprise_id) }}" alt="Image" class="image-offre">
        </div>
        <div class="col-lg-10 col-md-9">
            <h3 class="offre-title">{{ $opportunite->title }}</h3>
            <div class="offre-subtitle">
                <a href="{{ route('entreprise.detail', $entreprise->slug) }}">{{ $entreprise->libelle }}</a>  | <span class="fas fa-map-marker-alt"></span> <a href="{{ route('opportunite.adresse', $opportunite->lieu) }}">{{ $opportunite->lieu }}</a>
            </div>
            <div class="row offre-footer d-flex align-items-end">
                    <div class="col-lg-8 col-md-9">
                        Publié <i class="offre-date">{{ custom_date($opportunite->created_at) }}</i>&nbsp;&nbsp;|&nbsp;&nbsp;Délais <i class="offre-date">{{ custom_date($opportunite->echeance) }}  {{ ($opportunite->echeance->format('d-m-Y') != date('d-m-Y')) ? $opportunite->echeance->format('H:i') : "" }}</i>
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
@endforeach
