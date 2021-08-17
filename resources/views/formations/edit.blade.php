<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="content-title">{{ __('MODIFICATION DE FORMATION') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form action="{{ route('formation.update', $formation->id) }}" method="post">
                @csrf
                @method('put')
                <!-- Email Address -->
                <div class="row">
                    <div class="col-md-6">
                        <input id="title" class="form-control" type="text" name="title" value="{{ $formation->title }}" placeholder="TITRE" required autofocus />
                    </div>
                    <div class="col-md-6">
                        <label for="niveau">Niveau</label>
                        <select name="niveau" class="form-control">
                            <option value="">-- SELECTIONNER ICI --</option>
                            @foreach($diplomes as $diplome)
                                <option <?= ($diplome->id == $formation->niveau) ? "selected=selected" : "" ?> value="{{ $diplome->id }}">{{ $diplome->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <select id="structure" class="form-control" name="entreprise_id">
                            <option value="">-- CHOISIR L'ENTREPRISE ICI --</option>
                            @foreach ($entreprises as $entreprise)
                                <option <?= ($entreprise->id == $formation->entreprise_id) ? "selected=selected" : "" ?> value="{{ $entreprise->id }}">{{ $entreprise->libelle }}</option>
                            @endforeach
                        </select>
                    </div>    
                    <div class="col-md-6">
                        <input id="lieu" class="form-control" type="text" name="lieu" value="{{ $formation->lieu }}" placeholder="ADRESSE" />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label for="echeance">Date d'echéance</label>
                        <input id="echeance" class="form-control" type="date" name="echeance" value="{{ $formation->echeance }}" placeholder="" />
                    </div>
                    <div class="col-md-6">
                        <input id="duree" class="form-control" type="text" name="duree" value="{{ $formation->duree }}" placeholder="DUREE" />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <input id="montant" class="form-control" type="text" name="montant" value="{{ $formation->montant }}" placeholder="PRIX" />
                    </div>
                    <div class="col-md-6">
                        <input id="prerequis" class="form-control" type="text" name="prerequis" value="{{ $formation->prerequis }}" placeholder="PREREQUIS" />
                    </div>
                </div>
    
                <div class="row mt-4">
                    <div class="col-md-12">
                        <textarea id="content" class="form-control" name="content" value="" placeholder="DESCRIPTION ...">{{ $formation->content }}</textarea>
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
