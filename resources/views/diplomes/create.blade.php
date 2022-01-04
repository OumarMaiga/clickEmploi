<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="content-title">{{ __('AJOUT DE DIPLOME') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('diplome.store') }}">
                @csrf
    
                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="diplome">Libelle</label>
                        <input id="libelle" class="form-control" type="text" name="libelle" value="{{ old('libelle') }}" placeholder="DIPLOME" required />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="annnee">Année d'etude</label>
                        <select name="annee_etude" class="form-control">
                            <option value="">-- SELECTIONNER ICI --</option>
                            <option value="9">9 ans</option>
                            <option value="12">12 ans</option>
                            <option value="14">Bac + 2 ans</option>
                            <option value="15">Bac + 3 ans</option>
                            <option value="16">Bac + 5 ans</option>
                            <option value="19">Bac + 7 ans</option>
                        </select>
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
