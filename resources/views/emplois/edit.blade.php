<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="content-title">{{ __('MODIFICATION DE L\'EMPLOI') }}</div>
        
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form action="{{ route('emploi.update', $emploi->id) }}" method="post">
                @csrf
                @method('put')
                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-12">
                        <label for="title">Titre</label>
                        <input id="title" class="form-control" type="text" name="title" value="{{ $emploi->title }}" placeholder="TITRE" required autofocus />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="structure">Entreprise</label>
                        <select id="structure" class="form-control" name="entreprise_id">
                            <option value="">-- CHOISIR L'ENTREPRISE ICI --</option>
                            @foreach ($entreprises as $entreprise)
                                <option <?= ($entreprise->id == $emploi->entreprise_id) ? "selected=selected" : "" ?> value="{{ $entreprise->id }}">{{ $entreprise->libelle }}</option>
                            @endforeach
                        </select>
                    </div>    
                    <div class="form-item col-md-6">
                        <label for="lieu">Adresse</label>
                        <input id="lieu" class="form-control" type="text" name="lieu" value="{{ $emploi->lieu }}" placeholder="ADRESSE"/>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="duree">Durée de contrat</label>
                        <input id="duree" class="form-control" type="text" name="duree" value="{{ $emploi->duree }}" placeholder="DUREE" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="title">Contrat</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="type_contrat">
                            <option value="">-- TYPE DE CONTRAT --</option>
                            <option <?= ($emploi->type_contrat == "cdd") ? "selected=selected" : "" ?> value="cdd">CDD</option>
                            <option <?= ($emploi->type_contrat == "cdi") ? "selected=selected" : "" ?> value="cdi">CDI</option>
                            <option <?= ($emploi->type_contrat == "alternance") ? "selected=selected" : "" ?> value="alternance">Alternance</option>
                        </select>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="echeance">Date d'echéance</label>
                        <div class="row">
                            <div class="col-6">
                                <input id="date_echeance" class="form-control" type="date" value="{{ $emploi->echeance->format('Y-m-d') }}" name="date_echeance" placeholder="" />
                            </div>
                            <div class="col-6">
                                <input id="time_echeance" type="time" class="form-control" name="time_echeance" value="{{ $emploi->echeance->format('H:i') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-item col-md-6">
                        <label for="montant">Salaire</label>
                        <input id="montant" class="form-control" type="text" name="montant" value="{{ $emploi->montant }}" placeholder="SALAIRE (250.000F - 375.000F)" />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="annee_experience">Année d'experience</label>
                        <select name="annee_experience" class="form-control">
                            <option value="">-- SELECTIONNER ICI --</option>
                            <option <?= ($emploi->annee_experience == "0.5") ? "selected=selected" : "" ?> value="0.5">6 mois</option>
                            <option <?= ($emploi->annee_experience == "1") ? "selected=selected" : "" ?> value="1">1 ans</option>
                            <option <?= ($emploi->annee_experience == "2") ? "selected=selected" : "" ?> value="2">2 an</option>
                            <option <?= ($emploi->annee_experience == "3") ? "selected=selected" : "" ?> value="3">3 ans</option>
                            <option <?= ($emploi->annee_experience == "4") ? "selected=selected" : "" ?> value="4">4 ans</option>
                            <option <?= ($emploi->annee_experience == "5") ? "selected=selected" : "" ?> value="5">5 ans</option>
                        </select>
                    </div>
                    <div class="form-item col-md-6">
                        <label for="niveau">Diplome</label>
                        <select name="niveau" class="form-control">
                            <option value="">-- SELECTIONNER ICI --</option>
                            @foreach($diplomes as $diplome)
                                <option <?= ($diplome->id == $emploi->niveau) ? "selected=selected" : "" ?> value="{{ $diplome->id }}">{{ $diplome->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
    
                <div class="row">    
                    <div class="form-item col-md-12">
                        <label for="content">Description</label>
                        <textarea id="content" class="form-control" name="content" value="" placeholder="DESCRIPTION ...">{{ $emploi->content }}</textarea>
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
                                            <input class="form-check-input" type="checkbox" id="{{ $activite->slug }}" name="activite[]" value="{{ $activite->id }}" <?= ($activite_checked->contains('slug', $activite->slug)) ? "checked" : "" ?>>
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
                        {{ __('MODIFIER') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-dashboard-layout>
