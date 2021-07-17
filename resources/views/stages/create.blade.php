<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="content-title">{{ __('CREATION D\'OFFRE DE STAGE') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('stage.store') }}" enctype="multipart/form-data">
                @csrf
    
                <!-- Email Address -->
                <div class="row">
                    <div class="col-md-12">
                        <label for="title">Titre</label>
                        <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="TITRE" required autofocus />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label for="structure">Entreprise</label>
                        <select id="structure" class="form-control" name="entreprise_id">
                            <option value="">-- CHOISIR L'ENTREPRISE ICI --</option>
                            @foreach ($entreprises as $entreprise)
                                <option value="{{ $entreprise->id }}">{{ $entreprise->libelle }}</option>
                            @endforeach
                        </select>
                    </div>    
                    <div class="col-md-6">
                        <label for="lieu">Adresse</label>
                        <input id="lieu" class="form-control" type="text" name="lieu" value="{{ old('lieu') }}" placeholder="ADRESSE" />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label for="duree">Durée de stage</label>
                        <input id="duree" class="form-control" type="text" name="duree" value="{{ old('duree') }}" placeholder="DUREE" />
                    </div>
                    <div class="col-md-6">
                        <label for="contrat">Contrat</label>
                        <select class="form-control" id="contart" name="type_contrat">
                            <option value="">-- TYPE DE CONTRAT --</option>
                            <option value="cdd">CDD</option>
                            <option value="cdi">CDI</option>
                            <option value="alternance">Alternance</option>
                        </select>
                    </div>
                </div>


                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label for="echeance">Date d'echéance</label>
                        <input id="echeance" class="form-control" type="date" name="echeance" value="{{ old('echeance') }}" placeholder="" />
                    </div>
                    <div class="col-md-6">
                        <input id="montant" class="form-control" type="text" name="montant" value="{{ old('montant') }}" placeholder="SALAIRE (250.000F - 375.000F)" />
                    </div>
                </div>
    

                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label for="niveau">Niveau</label>
                        <select name="niveau" class="form-control">
                            <option value="">-- SELECTIONNER ICI --</option>
                            @foreach($diplomes as $diplome)
                                <option value="{{ $diplome->id }}">{{ $diplome->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <textarea id="content" class="form-control" name="content" value="" placeholder="DESCRIPTION ...">{{ old('content') }}</textarea>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12">
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
</x-dashboard-layout>
