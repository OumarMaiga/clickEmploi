<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="content-title">{{ __('AJOUT D\'ACTIVITE SPECIFIQUE') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
            <form method="POST" action="{{ route('activite.store') }}" enctype="multipart/form-data">
                @csrf
    
                <!-- Email Address -->
                <div class="row">
                    <div class="form-item col-md-6">
                        <label for="libelle">Activité</label>
                        <input id="libelle" class="form-control" type="text" name="libelle" value="{{ old('libelle') }}" placeholder="LIBELLE" />
                    </div>
                    <div class="form-item col-md-6">
                        <label for="secteur_id">Domaine</label>
                        <select name="secteur_id" class="form-control">
                            <option value="">-- SELECTIONNER ICI --</option>
                            @foreach($secteurs as $secteur)
                                <option value="{{ $secteur->id }}">{{ $secteur->libelle }}</option>
                            @endforeach
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
