<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="ajout-title">{{ __('MODIFICATION DE PARTENAIRE') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            {!! Form::model($diplome, ['route' => ['diplome.update', $diplome->id], 'method' => 'put']) !!}
    
                
                <!-- Email Address -->
                <div class="row">
                    <div class="col-md-6">
                        <input id="libelle" class="form-control" type="text" name="libelle" value="{{ $diplome->libelle }}" placeholder="DIPLOME" required />
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
