<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="content-title">{{ __('MODIFICATION DE PARTENAIRE') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            {!! Form::model($partenaire, ['route' => ['partenaire.update', $partenaire->id], 'method' => 'put']) !!}
    
                <!-- Email Address -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="nom">Nom</label>
                        <input id="nom" class="form-control" type="text" name="nom" value="{{ $partenaire->nom }}" placeholder="NOM" required autofocus />
                    </div>
                    <div class="col-md-6">
                        <label for="prenom">Prenom</label>
                        <input id="prenom" class="form-control" type="text" name="prenom" value="{{ $partenaire->prenom }}" placeholder="PRENOM" required />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row">
                    <div class="col-md-6 form-item">
                        <label for="telephone">Telephone</label>
                        <input id="telephone" class="form-control" type="text" name="telephone" value="{{ $partenaire->telephone }}" placeholder="TELEPHONE" required />
                    </div>
                    <div class="col-md-6">
                        <label for="lieu">Adresse</label>
                        <input id="adresse" class="form-control" type="text" name="adresse" value="{{ $partenaire->adresse }}" placeholder="ADRESSE" required />
                    </div>
                </div>

                <!-- Email Address -->
                <div class="row">
                    <div class="col-md-6 form-item">
                        <label for="email">E-mail</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ $partenaire->email }}" placeholder="EMAIL" required />
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
