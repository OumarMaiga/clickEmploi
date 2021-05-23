<x-dashboard-layout>
    <div class="container content">
            <div class="ajout-title">{{ __('MODIFICATION DE SECTEUR D\'ACTIVITE') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                {!! Form::model($secteur, ['route' => ['secteur.update', $secteur->id], 'method' => 'put']) !!}
        
                    
                    <!-- Email Address -->
                    <div class="row">
                        <div class="col-md-6">
                            <input id="categorie" class="form-control" type="text" name="categorie" value="{{ $secteur->categorie }}" placeholder="DOMAINE D'ACTIVITE" required />
                        </div>
                        <div class="col-md-6">
                            <input id="libelle" class="form-control" type="text" name="libelle" value="{{ $secteur->libelle }}" placeholder="ACTIVITE SPECIFIQUE" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('MODIFIER') }}
                        </button>
                    </div>
                </form>
    </div>
</x-dashboard-layout>
