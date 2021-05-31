<x-app-layout>
    <div class="home-container">
        <div class="row">
            <div class="col-sm-3">
                <div class="filtre-container">
                <h3 class="filtre-title">FILTRE</h3>
                <div class="filtre-content">
                    <h5 class="filtre-subtitle">POSTE</h5>
                    <div class="filtre-list">
                        <div class="filtre-item-list">
                            <div class="form-check filtre-item">
                                <input class="form-check-input" type="checkbox" value="" id="assistant-comptable-fournisseurs-h/f">
                                <label class="form-check-label" for="assistant-comptable-fournisseurs-h/f">
                                    Assistant Comptable Fournisseurs H/F
                                </label>
                            </div>
                            <div class="form-check filtre-item">
                                <input class="form-check-input" type="checkbox" value="" id="chef-de-projet-infomatique">
                                <label class="form-check-label" for="chef-de-projet-infomatique">
                                    Chef de projet informatique
                                </label>
                            </div>
                            <div class="form-check filtre-item">
                                <input class="form-check-input" type="checkbox" value="" id="agent-commercial">
                                <label class="form-check-label" for="agent-commercial">
                                    Agent Commercial
                                </label>
                            </div>
                            <div class="form-check filtre-item">
                                <input class="form-check-input" type="checkbox" value="" id="consultant-directeur">
                                <label class="form-check-label" for="consultant-directeur">
                                    Consultant directeur
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="filtre-subtitle">TYPE CONTRAT</h5>
                    <div class="filtre-list">
                        <div class="filtre-item-list">
                            <div class="form-check filtre-item">
                                <input class="form-check-input" type="checkbox" value="" id="cdi">
                                <label class="form-check-label" for="cdi">
                                    CDI
                                </label>
                            </div>
                            <div class="form-check filtre-item">
                                <input class="form-check-input" type="checkbox" value="" id="cdd">
                                <label class="form-check-label" for="cdd">
                                    CDD
                                </label>
                            </div>
                            <div class="form-check filtre-item">
                                <input class="form-check-input" type="checkbox" value="" id="alternance">
                                <label class="form-check-label" for="alternance">
                                    Alternance
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="filtre-subtitle">DATE</h5>
                    <div class="filtre-list">
                        <div class="filtre-item-list">
                            <div class="form-check filtre-item">
                                <input class="form-check-input" type="radio" name="date" value="24h" id="24h">
                                <label class="form-check-label" for="24h">
                                    Dernière 24h 
                                </label>
                            </div>
                            <div class="form-check filtre-item">
                                <input class="form-check-input" type="radio" name="date" value="7j" id="7j">
                                <label class="form-check-label" for="7j">
                                    7 derniers jour
                                </label>
                            </div>
                            <div class="form-check filtre-item">
                                <input class="form-check-input" type="radio" name="date" value="1m" id="1m">
                                <label class="form-check-label" for="1m">
                                    1 mois
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-sm-9">
                @foreach ($opportunites as $opportunite)
                    <div class="offre-item row">
                    <div class="col-2 px-0">
                        <img src="" alt="Image" class="image-offre">
                    </div>
                    <div class="col-10">
                        <h3 class="offre-title">{{ $opportunite->title }}</h3>
                        <div class="offre-subtitle">
                            {{ $opportunite->structure }} | <span class="fas fa-map-marker-alt"></span> {{ $opportunite->lieu }}
                        </div>
                        <div class="row offre-footer">
                            <i class="mt-auto">{{ $opportunite->created_at }}</i>
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
        </div>
    </div>
</x-app-layout>
