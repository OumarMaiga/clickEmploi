<x-app-layout>
    <div class="entreprise-detail-head" style="background-image: url({{ $image_entreprise != NULL ? $image_entreprise->file_path : "/image/entreprise.jpg" }})">
        <div class="entreprise-detail-libelle">
            {{ $entreprise->libelle }}
        </div>    
    </div>    
    @include('layouts.search_bar')
    <div class="row entreprise-detail-offres-container">
        <div class="col-md-3">
            <div class="a-propos">
                <div class="title">
                    Qui sommes nous ?
                </div>
                <div class="item">
                    Siège: <span class="value">{{ $entreprise->adresse }}</span>
                </div>
                <div class="item">
                    Domaine: <span class="value">{{ $entreprise->domaine }}</span>
                </div>
                <div class="item">
                    Date de création: <span class="value">{{ $entreprise->date_creation }}</span>
                </div>
                <div class="item">
                    E-mail: <span class="value">{{ $entreprise->email }}</span>
                </div>
                <div class="item">
                    Telephone: <span class="value">{{ $entreprise->telephone }}</span>
                </div>
            </div>
            @include('layouts.filter')
        </div>
        <div class="col-md-9">
            <div class="entreprise-detail-offres">
                <h3 class="entreprise-detail-offres-title">{!! "<b>".$nbre_offres. "</b>" !!} offre <?php ($nbre_offres > 1) ? "s " : "" ?> chez {!! "<b>".$entreprise->libelle."</b>" !!}</h3>
                @include('layouts.list_opportunite')
            </div>
            
        </div>
    </div>
</x-app-layout>