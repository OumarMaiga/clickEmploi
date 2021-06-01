<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="content-title">{{ __('AJOUT DE SECTEUR D\'ACTIVITE') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('secteur.store') }}">
                @csrf
    
                <!-- Email Address -->
                <div class="row">
                    <div class="col-md-6">
                        <input id="categorie" class="form-control" type="text" name="categorie" value="{{ old('categorie') }}" placeholder="DOMAINE D'ACTIVITE" required />
                    </div>
                    <div class="col-md-6">
                        <input id="libelle" class="form-control" type="text" name="libelle" value="{{ old('libelle') }}" placeholder="ACTIVITE SPECIFIQUE" />
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
