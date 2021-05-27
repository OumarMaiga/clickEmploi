<x-dashboard-layout>
    <div class="container content">
            <div class="content-title">{{ __('CREATION DE FORATION') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('formation.store') }}">
                    @csrf
        
                    <!-- Email Address -->
                    <div class="row">
                        <div class="col-md-6">
                            <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="TITRE" required autofocus />
                        </div>
                        <div class="col-md-6">
                            <input id="niveau" class="form-control" type="text" name="niveau" value="{{ old('niveau') }}" placeholder="NIVEAU D'ETUDE REQUIS" />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <input id="structure" class="form-control" type="text" name="structure" value="{{ old('structure') }}" placeholder="ENTREPRISE" />
                        </div>
                        <div class="col-md-6">
                            <input id="lieu" class="form-control" type="text" name="lieu" value="{{ old('lieu') }}" placeholder="ADRESSE" />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <input id="duree" class="form-control" type="text" name="duree" value="{{ old('duree') }}" placeholder="DUREE" />
                        </div>
                        <div class="col-md-6">
                            <input id="prerequis" class="form-control" type="text" name="prerequis" value="{{ old('prerequis') }}" placeholder="PREREQUIS" />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <input id="montant" class="form-control" type="text" name="montant" value="{{ old('montant') }}" placeholder="PRIX" />
                        </div>
                        <div class="col-md-6">
                            <textarea id="content" class="form-control" name="content" value="{{ old('content') }}" placeholder="DESCRIPTION ..."></textarea>
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
