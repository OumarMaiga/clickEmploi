<div class="list">
    @foreach ($opportunites as $opportunite)
        <?php $entreprise = $opportunite->entreprise()->associate($opportunite->entreprise_id)->entreprise; ?>
            <div class="offre-item row">
            <div class="col-2 px-0">
                <img src="{{ photo_entreprise($opportunite->entreprise_id) }}" alt="Image" class="image-offre">
            </div>
            <div class="col-10">
                <h3 class="offre-title">{{ $opportunite->title }}</h3>
                <div class="offre-subtitle">
                    <a href="{{ route('entreprise.detail', $entreprise->slug) }}">{{ $entreprise->libelle }}</a>  | <span class="fas fa-map-marker-alt"></span> {{ $opportunite->lieu }}
                </div>
                <div class="row offre-footer">
                    <span class="mt-auto">Publié <i class="offre-date">{{ custom_date($opportunite->created_at) }}</i></span>&nbsp;&nbsp;<span class="mt-auto">|</span>&nbsp;&nbsp;<span class="mt-auto">Délais <i class="offre-date">{{ custom_date($opportunite->echeance) }}  {{ ($opportunite->echeance->format('d-m-Y') != date('d-m-Y')) ? $opportunite->echeance->format('H:i') : "" }}</i></span>
                    @switch($opportunite->type)
                        @case('emploi')
                            <a href="{{ route('emploi.detail', $opportunite->slug) }}" class="btn btn-outline-custom ml-auto mt-auto">DETAIL</a>
                            @break
                        @case('stage')
                            <a href="{{ route('stage.detail', $opportunite->slug) }}" class="btn btn-outline-custom ml-auto mt-auto">DETAIL</a>
                            @break
                        @case('formation')
                            <a href="{{ route('formation.detail', $opportunite->slug) }}" class="btn btn-outline-custom ml-auto mt-auto">DETAIL</a>
                            @break
                        @default
                        
                    @endswitch
                    
                </div>
            </div>
        </div>
    @endforeach
</div>