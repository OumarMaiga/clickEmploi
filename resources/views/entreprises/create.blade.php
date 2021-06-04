<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="content-title">{{ __('AJOUT D\'UNE ENTREPRISE') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('entreprise.store') }}">
                @csrf
    
                <!-- Email Address -->
                <div class="row">
                    <div class="col-md-6">
                        <input id="libelle" class="form-control" type="text" name="libelle" value="{{ old('libelle') }}" placeholder="NOM DE L'ENTREPRISE" required />
                    </div>
                    <div class="col-md-6">
                        <input id="domaine" class="form-control" type="text" name="domaine" value="{{ old('domaine') }}" placeholder="DOMAINE D'ACTIVITE" />
                    </div>
                </div>
                
                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <input id="telephone" class="form-control" type="text" name="telephone" value="{{ old('telephone') }}" placeholder="TELEPHONE" />
                    </div>
                    <div class="col-md-6">
                        <input id="email" class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="E-MAIL" />
                    </div>
                </div>
                
                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <textarea id="description" class="form-control" type="text" name="description" value="" placeholder="QUI SOMMES NOUS ?">{{ old('description') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="image">Image de l'entreprise</label>
                        <input id="image" class="form-control" type="file" name="image" value="{{ old('image') }}" />
                    </div>
                </div>
                
                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label for="image">Dat de création de l'entreprise</label>
                        <input id="date_creation" class="form-control" type="date" name="date_creation" value="{{ old('date_creation') }}" placeholder="DATE DE CREATION"/>
                    </div>
                    <div class="col-md-6">
                        <textarea id="adresse" class="form-control" type="text" name="adresse" value="" placeholder="Ville, Commune, Quartier" required>{{ old('adresse') }}</textarea>
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
