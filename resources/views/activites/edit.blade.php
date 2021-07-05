<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="ajout-title">{{ __('MODIFICATION D\'ACTIVITE SPECIFIQUE') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form action="{{ route('activite.update', $activite->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                
                <!-- Email Address -->
                <div class="row">
                    <div class="col-md-6">
                        <input id="libelle" class="form-control" type="text" name="libelle" value="{{ $activite->libelle }}" placeholder="ACTIVITE" />
                    </div>
                    <div class="col-md-6">
                        <label for="secteur_id">Domaine</label>
                        <select name="secteur_id" class="form-control">
                            <option value="">-- SELECTIONNER ICI --</option>
                            @foreach($secteurs as $secteur)
                                <option <?= ($secteur->id == $activite->secteur_id) ? "selected=selected" : "" ?> value="{{ $secteur->id }}">{{ $secteur->libelle }}</option>
                            @endforeach
                        </select>
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
