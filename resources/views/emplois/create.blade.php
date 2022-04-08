<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="content-title">{{ __('CREATION D\'EMPLOI') }}</div>
        
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('emploi.store') }}">
                @csrf
    
                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-12">
                        <label for="title">Titre</label>
                        <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="TITRE" required autofocus />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="structure">Entreprise</label>
                        <select id="structure" class="form-control" name="entreprise_id">
                            <option value="">-- CHOISIR L'ENTREPRISE ICI --</option>
                            @foreach ($entreprises as $entreprise)
                                <option value="{{ $entreprise->id }}">{{ $entreprise->libelle }}</option>
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-item col-md-6">
                        <label for="lieu">Adresse</label>
                        <input id="lieu" class="form-control" type="text" name="lieu" value="{{ old('lieu') }}" placeholder="ADRESSE">
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="duree">Durée de contrat</label>
                        <input id="duree" class="form-control" type="text" name="duree" value="{{ old('duree') }}" placeholder="DUREE" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="title">Contrat</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="type_contrat">
                            <option value="">-- TYPE DE CONTRAT --</option>
                            <option value="cdd">CDD</option>
                            <option value="cdi">CDI</option>
                            <option value="alternance">Alternance</option>
                        </select>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="echeance">Date d'echéance</label>
                        <div class="row">
                            <div class="col-6">
                                <input id="date_echeance" class="form-control" type="date" value="{{ old('date_echeance') }}" name="date_echeance" placeholder="" />
                            </div>
                            <div class="col-6">
                                <input id="time_echeance" type="time" class="form-control" name="time_echeance" value="00:00">
                            </div>
                        </div>
                    </div>
                    <div class="form-item col-md-6">
                        <label for="montant">Salaire</label>
                        <input id="montant" class="form-control" type="text" name="montant" value="{{ old('montant') }}" placeholder="SALAIRE (250.000F - 375.000F)" />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="annee_experience">Année d'experience</label>
                        <select name="annee_experience" class="form-control" value="{{ old('annee_experience') }}">
                            <option value="">-- SELECTIONNER ICI --</option>
                            <option value="0.5">6 mois</option>
                            <option value="1">1 an</option>
                            <option value="2">2 ans</option>
                            <option value="3">3 ans</option>
                            <option value="4">4 ans</option>
                            <option value="5">5 ans</option>
                        </select>
                    </div>
                    <div class="form-item col-md-6">
                        <label for="niveau">Diplome</label>
                        <select name="niveau" class="form-control">
                            <option value="">-- SELECTIONNER ICI --</option>
                            @foreach($diplomes as $diplome)
                                <option value="{{ $diplome->id }}">{{ $diplome->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-item col-md-12">
                        <label for="content">Description</label>
                        <textarea id="content" class="form-control tiny" name="content" value="" placeholder="DESCRIPTION ...">{{ old('content') }}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-item col-12">
                        Categorie
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($domaines as $domaine)
                                <div class="col-md-4 mt-2">
                                    <div class="domaine-title">
                                        {{ $domaine->libelle }}
                                    </div>
                                    <?php $activites = App\Models\Activite::where('secteur_id', $domaine->id)->get() ?>
                                    @foreach ($activites as $activite)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="{{ $activite->slug }}" name="activite[]" value="{{ $activite->id }}">
                                            <label class="form-check-label" for="{{ $activite->slug }}">{{ $activite->libelle }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-custom">
                        {{ __('AJOUTER') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script>

        tinymce.init({
            selector: '.tiny',
        });

    </script>
</x-dashboard-layout>
