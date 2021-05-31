<x-app-layout>
    <div class="show-container">
        <div class="show-head-container">
            <div class="show-title">
                {{ $opportunite->title }}
            </div>
            <div class="show-subtitle">
                {{ $opportunite->structure }} &nbsp; | &nbsp; <span class="fas fa-map-marker-alt"></span> {{ $opportunite->lieu }}
            </div>
            <div class="mt-4">
                <a href="#postuler" class="btn btn-custom btn-postule">Je postule</a>
            </div>
        </div>

        <div class="container description description-content">
            <div class="lil-title">Description</div>
            <p>
                {{ $opportunite->description }}
            </p>
        </div>
        <div class="container resume">
            <div class="lil-title">Resumé ...</div>
            @if ($opportunite->type == "emploi" || $opportunite->type == "stage")
                <div class="row">
                    <div class="col-md-3 resume-title">
                        POSTE
                    </div>
                    <div class="col-md-9 description">
                        {{ $opportunite->poste }}
                    </div>
                </div>
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
                    {{ $opportunite->structure }}
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
                        {{ $opportunite->annee_experience }}
                    </div>
                </div>
            @endif
            
            <div class="row">
                <div class="col-md-3 resume-title">
                    NIVEAU D'ETUDE
                </div>
                <div class="col-md-9 description">
                    {{ $opportunite->niveau }}
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
            @endif

            <div class="row">
                <div class="col-md-3 resume-title">
                    <i>Publié le 12 Avr 2021</i>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" id="postuler">
                
            <div class="postuler-container col-md-8">
                <h2 class="form-title mb-4">POSTULER</h2>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form action="{{ route('postule.store', $opportunite->slug) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <!-- Email Address -->
                    <div class="row">
                        <div class="form-group col-md-6 ">
                            <label for="nom">Nom</label>
                            <input id="nom" class="form-control" type="text" name="nom" value="{{ old('nom') }}" placeholder="NOM" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="prenom">Prenom</label>
                            <input id="prenom" class="form-control" type="text" name="prenom" value="{{ old('prenom') }}" placeholder="PRENOM" />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Email" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="telephone">Telephone</label>
                            <input id="telephone" class="form-control" type="text" name="telephone" value="{{ old('telephone') }}" placeholder="N° TELEPHONE" />
                        </div>
                    </div>
                    @if ($opportunite != "formation")
                        <!-- Email Address -->
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="cv">Ajouter votre CV</label>
                                <input id="cv" class="form-control" type="file" name="cv" value="" placeholder="Email" />
                            </div>
                        </div>
                    @endif

                    <div class="mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('POSTULER') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-app-layout>