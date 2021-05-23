<x-dashboard-layout>
    <div class="container content">
            <div class="content-title">{{ __('AJOUT DE PARTENAIRE') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('partenaire.store') }}">
                    @csrf
        
                    <!-- Email Address -->
                    <div class="row">
                        <div class="col-md-6">
                            <input id="nom" class="form-control" type="text" name="nom" value="{{ old('nom') }}" placeholder="NOM" required autofocus />
                        </div>
                        <div class="col-md-6">
                            <input id="prenom" class="form-control" type="text" name="prenom" value="{{ old('prenom') }}" placeholder="PRENOM" required />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <input id="telephone" class="form-control" type="text" name="telephone" value="{{ old('telephone') }}" placeholder="TELEPHONE" required />
                        </div>
                        <div class="col-md-6">
                            <input id="adresse" class="form-control" type="text" name="adresse" value="{{ old('adresse') }}" placeholder="ADRESSE" required />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="EMAIL" required />
                        </div>
                        <div class="col-md-6">
                            <input id="password" class="form-control" type="password" name="password" value="{{ old('password') }}" placeholder="PASSWORD" required />
                        </div>
                    </div>
                    
                    <!-- Email Address -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <input id="password-confirm" class="form-control" type="password" name="password_confirmation" value="{{ old('password') }}" placeholder="PASSWORD" required />
                        </div>
                    </div>
        
                    <div class="mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('AJOUTER') }}
                        </button>
                    </div>
                </form>
    </div>
</x-dashboard-layout>
