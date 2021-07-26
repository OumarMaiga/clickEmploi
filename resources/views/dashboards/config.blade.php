<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="row">
            <div class="col-sm-4">
                <div class="config-card">
                    <div class="config-title">DIPLOME</div>
                    <hr/>
                    <div class="config-content">
                        <span class="config-number">{{ $nbre_diplome }}</span>
                        <a class="config-link" href="{{ route('diplome.index') }}"><span class="config-plus">+</span></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="config-card">
                    <div class="config-title">DOMAINE</div>
                    <hr/>
                    <div class="config-content">
                        <span class="config-number">{{ $nbre_secteur }}</span>
                        <a class="config-link" href="{{ route('secteur.index') }}"><span class="config-plus">+</span></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="config-card">
                    <div class="config-title">ACTIVITE</div>
                    <hr/>
                    <div class="config-content">
                        <span class="config-number">{{ $nbre_activite }}</span>
                        <a class="config-link" href="{{ route('activite.index') }}"><span class="config-plus">+</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>