<x-dashboard-layout>
    <div class="container content">
            <div class="content-title">{{ __('CREATION D\'OFFRE DE STAGE') }}</div>
    
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('stage.store') }}">
                    @csrf
        
                    <!-- Email Address -->
                    <div class="row">
                        <div class="col-md-6">
                            <input id="title" class="form-control" type="text" name="title" value="{{ old('title') }}" placeholder="TITRE" required autofocus />
                        </div>
                        <div class="col-md-6">
                            <input id="poste" class="form-control" type="text" name="poste" value="{{ old('poste') }}" placeholder="POSTE" />
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
                            <select class="form-control" id="exampleFormControlSelect1" name="type_contrat">
                                <option value="">-- TYPE DE CONTRAT --</option>
                                <option value="cdd">CDD</option>
                                <option value="cdi">CDI</option>
                                <option value="alternance">Alternance</option>
                            </select>
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <input id="montant" class="form-control" type="text" name="montant" value="{{ old('montant') }}" placeholder="SALAIRE (250.000F - 375.000F)" />
                        </div>
                        <div class="col-md-6">
                            <input id="niveau" class="form-control" type="text" name="niveau" value="{{ old('niveau') }}" placeholder="NIVEAU D'ETUDE REQUIS" />
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="row mt-4">
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
