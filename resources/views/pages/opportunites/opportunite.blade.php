<x-app-layout>
    <div class="show-container">
        <!--<div class="show-head-container">
            <div class="show-title">
                {{ $opportunite->title }}
            </div>
            <div class="show-subtitle">
                <a href="{{ route('entreprise.detail', $entreprise->slug) }}">{{ $entreprise->libelle }}</a> &nbsp; | &nbsp; <span class="fas fa-map-marker-alt"></span> <a href="{{ route('opportunite.adresse', $opportunite->lieu) }}">{{ $opportunite->lieu }}</a>
            </div>
            <div class="mt-4">
                <a href="#postuler" class="btn btn-custom btn-postule">Je postule</a>
            </div>
        </div>-->
        <div class="row">
            <div class="col-sm-2 px-0">
                @if (Auth::check())
                    @include('layouts.profil')
                @endif
                @include('layouts.filter')
                @include('layouts.pub2')
            </div>
            <div class="col-sm-8">
                <div class="show-middle-container">
                    <div class="show-head-container">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <img src="" alt="Photo de l'entreprise" class="show-head-image">
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="show-title">
                                    {{ $opportunite->title }}
                                </div>
                                <div class="show-head-entreprise">
                                    <a href="{{ route('entreprise.detail', $entreprise->slug) }}">{{ $entreprise->libelle }}</a>
                                </div>
                                <div class="show-head-lieu">
                                    <a href="{{ route('opportunite.adresse', $opportunite->lieu) }}">{{ $opportunite->lieu }}</a>
                                </div>
                                <div class="show-btn-postule">
                                    <a href="#postuler" class="btn btn-outline-custom">Postulez</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="show-resume">
                        <ul class="list">
                            @if ($opportunite->type == "emploi" || $opportunite->type == "stage")
                                <li class="item">
                                    <span class="text">Poste</span>
                                    <span class="value">{{ $opportunite->poste }}</span>
                                </li>
                                <li class="item">
                                    <span class="text">Type de contrat</span>
                                    <span class="value text-uppercase">{{ $opportunite->type_contrat }}</span>
                                </li>
                            @else
                                <li class="item">
                                    <span class="text">Titre</span>
                                    <span class="value">{{ $opportunite->title }}</span>
                                </li>
                            @endif
                            <li class="item">
                                <span class="text"><?= $opportunite->type == "formation" ? "Montant" : "Salaire" ?></span>
                                <span class="value">{{ $opportunite->montant }}</span>
                            </li>
                            <li class="item">
                                <span class="text">Entreprise</span>
                                <span class="value">{{ $entreprise->libelle }}</span>
                            </li>
                            <li class="item">
                                <span class="text">Adresse</span>
                                <span class="value">{{ $opportunite->lieu }}</span>
                            </li>
                            @if ($opportunite->type == "emploi" || $opportunite->type == "stage")
                                <li class="item">
                                    <span class="text">Secteur d'activité</span>
                                    <span class="value">{{ $activites->implode(', ') }}</span>
                                </li>
                            @endif
                            <li class="item">
                                <span class="text">Date de publication</span>
                                <span class="value">{{ custom_date($opportunite->echeance) }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="description description-content">
                        <div class="lil-title">Description</div>
                        <div class="show-description-trait"></div>
                        <p>
                            {{ $opportunite->content }}
                        </p>
                    </div>
                    <div class="show-end">
                        @if ($opportunite->type == "emploi")
                            @if ($annee_experience != "")
                                <div class="item">
                                    <span class="text">
                                        Experience: 
                                    </span>
                                    <span class="value">
                                        {{ $annee_experience }}
                                    </span>
                                </div>
                            @endif
                        @endif
                        @if ($niveau->libelle != null)
                            <div class="item">
                                <span class="text">
                                    Niveau d'étude: 
                                </span>
                                <span class="value">
                                    {{  $niveau->libelle }}
                                </span>
                            </div>
                        @endif
                        @if ($opportunite->type == "formation")
                            @if ($niveau->prerequis != "null")
                                <div class="item">
                                    <span class="text">
                                        Pre-réquis: 
                                    </span>
                                    <span class="value">
                                        {{ $opportunite->prerequis }}
                                    </span>
                                </div>
                            @endif
                        @endif
                        <div class="item">
                            <span class="text">
                                Delais de depôt: 
                            </span>
                            <span class="value">
                                {{ custom_date($opportunite->echeance) }}  {{ ($opportunite->echeance->format('d-m-Y') != date('d-m-Y')) ? $opportunite->echeance->format('H:i') : "" }}</i>
                            </span>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-center" id="postuler">
                        <div class="postuler-container col-lg-8 col-md-10">
                            <h2 class="form-title mb-4">POSTULER</h2>
                            @if (Auth::check())
                                
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
                                            @if (Auth::check())
                                                @if (voir_cv_profil(Auth::user()->id) != false)
                                                    <div class="form-group col-md-6">
                                                        <input id="cv_profil" class="form-control mr-2" type="checkbox" name="cv_profil" value="" placeholder="Pourquoi devrons-nous vous engagé ?" />
                                                        <label for="cv_profil">Utilisé le CV de votre profil</label>
                                                    </div>
                                                @endif 
                                            @endif

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
                            @else
                                <div class="identifier">
                                    <div class="identifier-word">
                                        Veuillez vous identifier pour postuler 
                                    </div>
                                    <div class="identifier-links">

                                        <a href="{{ route('login') }}" class="btn btn-custom mr-4">
                                            {{ __('CONNEXION') }}
                                        </a>
                                        <a class="btn-link mt-auto" href="{{ route('register') }}">
                                            {{ __('Inscription') }}
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="container offre-simulaire">
                        <div class="row justify-content-center">
                            @foreach($opportunite_similaires as $opportunite_similaire)
                                @if ($opportunite->id != $opportunite_similaire->id)
                                    <?php $entreprise = $opportunite_similaire->entreprise()->associate($opportunite_similaire->entreprise_id)->entreprise ?>
                                        <div class=" col-sm-6 col-md-4 offre-card">
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
                                                <a href="{{ route('entreprise.detail', $entreprise->slug) }}" class="offre-simulaire-link">{{ $entreprise->libelle }}</a> &nbsp; | &nbsp; <span class="fas fa-map-marker-alt"></span> <a href="{{ route('opportunite.adresse', $opportunite_similaire->lieu) }}">{{ $opportunite_similaire->lieu }}</a>
                                            </div>
                                        </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-2 px-0">
                @include('layouts.pub1')
                @include('layouts.pub-alert')
            </div>
        </div>
    </div>
    
</x-app-layout>