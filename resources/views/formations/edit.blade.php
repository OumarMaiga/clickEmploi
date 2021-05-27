<x-dashboard-layout>
    <div class="container content">
            <div class="ajout-title">{{ __('MODIFICATION DE L\'EMPLOI') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                {!! Form::model($formation, ['route' => ['formation.update', $formation->id], 'method' => 'put']) !!}
        
                    <!-- Email Address -->
                    <div class="row">
                        <div class="col-md-6">
                            <input id="title" class="form-control" type="text" name="title" value="{{ $formation->title }}" placeholder="TITRE" required autofocus />
                        </div>
                        <div class="col-md-6">
                            <input id="niveau" class="form-control" type="text" name="niveau" value="{{ $formation->niveau }}" placeholder="NIVEAU D'ETUDE REQUIS" />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <input id="structure" class="form-control" type="text" name="structure" value="{{ $formation->structure }}" placeholder="ENTREPRISE" />
                        </div>
                        <div class="col-md-6">
                            <input id="lieu" class="form-control" type="text" name="lieu" value="{{ $formation->lieu }}" placeholder="ADRESSE" />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <input id="duree" class="form-control" type="text" name="duree" value="{{ $formation->duree }}" placeholder="DUREE" />
                        </div>
                        <div class="col-md-6">
                            <input id="prerequis" class="form-control" type="text" name="prerequis" value="{{ $formation->prerequis }}" placeholder="PREREQUIS" />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <input id="montant" class="form-control" type="text" name="montant" value="{{ $formation->montant }}" placeholder="PRIX" />
                        </div>
                        <div class="col-md-6">
                            <textarea id="content" class="form-control" name="content" value="" placeholder="DESCRIPTION ...">{{ $formation->content }}</textarea>
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="row mt-4">
                    </div>
        
        
                    <div class="mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('MODIFIER') }}
                        </button>
                    </div>
                </form>
    </div>
</x-dashboard-layout>
