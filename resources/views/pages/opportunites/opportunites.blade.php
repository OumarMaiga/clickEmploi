<x-app-layout>
    <div class="home-container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.filter')
            </div>
            <div class="col-sm-9 list">
                <h3 class="entreprise-detail-offres-title">{!! "<b>".$nbre_offres. "</b>" !!} offre<?= ($nbre_offres > 1) ? "s " : "" ?> trouvés <?= isset($adresse) ? "à ".$adresse : "" ?></h3>
                @include('layouts.list_opportunite')
            </div>
        </div>
    </div>
</x-app-layout>