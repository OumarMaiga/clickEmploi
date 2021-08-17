<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="content-title">{{ __('MODIFICATION DE STAGE') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form action="{{ route('stage.update', $stage->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <!-- Email Address -->
                <div class="row">
                    <div class="col-md-12">
                        <input id="title" class="form-control" type="text" name="title" value="{{ $stage->title }}" placeholder="TITRE" required autofocus />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <select id="structure" class="form-control" name="entreprise_id">
                            <option value="">-- CHOISIR L'ENTREPRISE ICI --</option>
                            @foreach ($entreprises as $entreprise)
                                <option <?= ($entreprise->id == $stage->entreprise_id) ? "selected=selected" : "" ?> value="{{ $entreprise->id }}">{{ $entreprise->libelle }}</option>
                            @endforeach
                        </select>
                    </div>    
                    <div class="col-md-6">
                        <input id="lieu" class="form-control" type="text" name="lieu" value="{{ $stage->lieu }}" placeholder="ADRESSE" />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label for="echeance">Date d'echéance</label>
                        <input id="echeance" class="form-control" type="date" name="echeance" value="{{ $stage->echeance }}" placeholder="" />
                    </div>
                    <div class="col-md-6">
                        <input id="montant" class="form-control" type="text" name="montant" value="{{ $stage->montant }}" placeholder="SALAIRE (250.000F - 375.000F)" />
                    </div>
                </div>


                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <select class="form-control" id="exampleFormControlSelect1" name="type_contrat">
                            <option value="">-- TYPE DE CONTRAT --</option>
                            <option <?= ($stage->type_contrat == "cdd") ? "selected=selected" : "" ?> value="cdd">CDD</option>
                            <option <?= ($stage->type_contrat == "cdi") ? "selected=selected" : "" ?> value="cdi">CDI</option>
                            <option <?= ($stage->type_contrat == "alternance") ? "selected=selected" : "" ?> value="alternance">Alternance</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <input id="duree" class="form-control" type="text" name="duree" value="{{ $stage->duree }}" placeholder="DUREE" />
                    </div>
                </div>
    
                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label for="niveau">Niveau</label>
                        <select name="niveau" class="form-control">
                            <option value="">-- SELECTIONNER ICI --</option>
                            @foreach($diplomes as $diplome)
                                <option <?= ($diplome->id == $stage->niveau) ? "selected=selected" : "" ?> value="{{ $diplome->id }}">{{ $diplome->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <textarea id="content" class="form-control" name="content" value="{{ $stage->content }}" placeholder="DESCRIPTION ...">{{ $stage->content }}</textarea>
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
