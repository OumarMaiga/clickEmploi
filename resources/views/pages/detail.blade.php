<x-app-layout>
    <div class="show-container">
        <div class="show-head-container">
            <div class="show-title">
                {{ $opportunite->title }}
            </div>
            <div class="show-subtitle">
                <a href="{{ route('entreprise.detail', $entreprise->slug) }}">{{ $entreprise->libelle }}</a> &nbsp; | &nbsp; <span class="fas fa-map-marker-alt"></span> {{ $opportunite->lieu }}
            </div>
            <div class="mt-4">
                <a href="#postuler" class="btn btn-custom btn-postule">Je postule</a>
            </div>
        </div>

        <div class="container description description-content">
            <div class="lil-title">Description</div>
            <p>
                {{ $opportunite->content }}
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
                    {{ $entreprise->libelle }}
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
                    <i>Publié {{ custom_date($opportunite->created_at) }}</i>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 resume-title">
                    <i>Delais de depôt {{ custom_date($opportunite->echeance) }}  {{ ($opportunite->echeance->format('d-m-Y') != date('d-m-Y')) ? $opportunite->echeance->format('H:i') : "" }}</i>
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
                            <input id="nom" class="form-control" type="text" name="nom" value="{{ (Auth::check()) ? Auth::user()->nom : old('nom') }}" placeholder="NOM" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="prenom">Prenom</label>
                            <input id="prenom" class="form-control" type="text" name="prenom" value="{{ (Auth::check()) ? Auth::user()->prenom : old('prenom') }}" placeholder="PRENOM" />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ (Auth::check()) ? Auth::user()->email : old('email') }}" placeholder="Email" />
                        </div>

                        <div class="form-group col-md-6">
                            <label for="telephone">Telephone</label>
                            <input id="telephone" class="form-control" type="text" name="telephone" value="{{ (Auth::check()) ? Auth::user()->telephone : old('telephone') }}" placeholder="N° TELEPHONE" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="motivation">Lettre de motivation</label>
                            <textarea id="motivation" class="form-control" type="text" name="motivation" value="" placeholder="Pourquoi devrons-nous vous engagé ?" >{{ old('motivation') }}</textarea>
                        </div>
                    </div>
                    @if ($opportunite->type != "formation")
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input id="cv_profil" class="form-control mr-2" type="checkbox" name="cv_profil" value="" placeholder="Pourquoi devrons-nous vous engagé ?" />
                                <label for="cv_profil">Utilisé le CV de votre profil</label>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cv">Ajouter votre CV</label>
                                <input id="cv" class="form-control" type="file" name="cv" value="" placeholder="" />
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
        
        <div class="container offre-simulaire">
            <div class="row justify-content-center">
                @foreach($opportunite_similaires as $opportunite_similaire)
                    @if ($opportunite->id != $opportunite_similaire->id)
                        <?php $entreprise = $opportunite_similaire->entreprise()->associate($opportunite_similaire->entreprise_id)->entreprise ?>
                            <div class="col-md-3 offre-card">
                                <div class="offre-simulaire-title">
                                    @switch($opportunite_similaire->type)
                                        @case('emploi')
                                            <a href="{{ route('emploi.detail', $opportunite_similaire->slug) }}">{{ $opportunite_similaire->title }}</a>
                                            @break
                                        @case('stage')
                                            <a href="{{ route('stage.detail', $opportunite_similaire->slug) }}">{{ $opportunite_similaire->title }}</a>
                                            @break
                                        @case('formation')
                                            <a href="{{ route('formation.detail', $opportunite_similaire->slug) }}">{{ $opportunite_similaire->title }}</a>
                                            @break
                                        @default
                                        
                                    @endswitch
                                </div>
                                <div class="offre-simulaire-footer">
                                    <a href="{{ route('entreprise.detail', $entreprise->slug) }}" class="offre-simulaire-link">{{ $entreprise->libelle }}</a> &nbsp; | &nbsp; <span class="fas fa-map-marker-alt"></span> {{ $opportunite_similaire->lieu }}
                                </div>
                            </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    
</x-app-layout>