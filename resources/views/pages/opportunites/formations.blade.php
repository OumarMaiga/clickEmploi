<x-app-layout>
    <div class="home-container">
        <div class="row">
            <div class="col-sm-3">
                @include('layouts.filter')
            </div>
            <div class="col-sm-9 list">
                @if(Auth::check())
                    <div class="offre-block-number">
                        <div class="offre-block-number-up">
                            <span class="fas fa-suitcase offre-block-number-icon"></span><span class="offre-block-number-word"> {{ $offre_par_domaine->count() }} Offre<?= ($offre_par_domaine->count() > 1) ? "s " : "" ?></span> 
                        </div>
                        <div class="offre-block-number-down">
                            correspond à votre profil
                        </div>
                    </div>
                @endif
                @include('layouts.list_opportunite')
            </div>
        </div>
    </div>
</x-app-layout>
