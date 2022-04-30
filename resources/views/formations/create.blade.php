<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="content-title">{{ __('CREATION DE FORMATION') }}</div>
        
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('formation.store') }}">
                @csrf

                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="title">Titre</label>
                        <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="TITRE" required autofocus />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="niveau">Niveau</label>
                        <select name="niveau" class="form-control">
                            <option value="">-- SELECTIONNER ICI --</option>
                            @foreach($diplomes as $diplome)
                                <option value="{{ $diplome->id }}">{{ $diplome->libelle }}</option>
                            @endforeach
                        </select>
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
                        <input id="lieu" class="form-control" type="text" name="lieu" value="{{ old('lieu') }}" placeholder="ADRESSE" />
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
                        <label for="duree">Durée</label>
                        <input id="duree" class="form-control" type="text" name="duree" value="{{ old('duree') }}" placeholder="DUREE" />
                    </div>
                </div>

                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="montant">Montant</label>
                        <input id="montant" class="form-control" type="text" name="montant" value="{{ old('montant') }}" placeholder="PRIX" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="prerequis">Prerequis</label>
                        <input id="prerequis" class="form-control" type="text" name="prerequis" value="{{ old('prerequis') }}" placeholder="PREREQUIS" />
                    </div>
                </div>
                
                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="annee_experience">Telephone</label>
                        <input id="telephone" class="form-control" type="text" name="telephone" value="{{ old('telephone') }}" placeholder="" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="email">Email</label>
                        <input id="email" class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="" />
                    </div>
                </div>
                    
                <div class="row">
                    <div class="form-item col-md-12">
                        <label for="content">Description</label>
                        <textarea id="content" class="form-control tiny" name="content" value="" placeholder="DESCRIPTION ...">{{ old('content') }}</textarea>
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
