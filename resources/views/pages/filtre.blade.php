<x-app-layout>
    <div class="home-container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.filter')
            </div>
            <div class="col-sm-9">
                <h3 class="entreprise-detail-offres-title">{!! "<b>".$nbre_offres. "</b>" !!} offre <?php ($nbre_offres > 1) ? "s " : "" ?> trouvés </h3>
                @include('layouts.list_opportunite')
            </div>
        </div>
    </div>
</x-app-layout>