<x-dashboard-layout>
    <div class="dashboard-content">
        <div class="container content">
            <div class="ajout-title">{{ __('MODIFICATION DE L\'ENTREPRISE') }}</div>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form action="{{ route('entreprise.update', $entreprise->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
    
                <!-- Email Address -->
                <div class="row">
                    <div class="col-md-6">
                        <input id="libelle" class="form-control" type="text" name="libelle" value="{{ $entreprise->libelle }}" placeholder="NOM DE L'ENTREPRISE" required />
                    </div>
                    <div class="col-md-6">
                        <input id="domaine" class="form-control" type="text" name="domaine" value="{{ $entreprise->domaine }}" placeholder="DOMAINE D'ACTIVITE" />
                    </div>
                </div>
                
                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <input id="telephone" class="form-control" type="text" name="telephone" value="{{ $entreprise->telephone }}" placeholder="TELEPHONE" />
                    </div>
                    <div class="col-md-6">
                        <input id="email" class="form-control" type="text" name="email" value="{{ $entreprise->email }}" placeholder="E-MAIL" />
                    </div>
                </div>
                
                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <textarea id="description" class="form-control" type="text" name="description" value="{{ $entreprise->description }}" placeholder="QUI SOMMES NOUS ?"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="image">Image de l'entreprise</label>
                        <input id="image" class="form-control" type="file" name="image" value="" />
                    </div>
                </div>
                
                <!-- Email Address -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label for="image">Dat de création de l'entreprise</label>
                        <input id="date_creation" class="form-control" type="date" name="date_creation" value="{{ $entreprise->date_creation }}" placeholder="DATE DE CREATION"/>
                    </div>
                    <div class="col-md-6">
                        <textarea id="adresse" class="form-control" type="text" name="adresse" value="" placeholder="Ville, Commune, Quartier">{{ $entreprise->adresse }}</textarea>
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
