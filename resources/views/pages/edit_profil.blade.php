<x-app-layout>
    <div class="main-content">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form action="{{ route('update_profil', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-4">
                    <img alt="profil" src="{{ $photo }}" class="profil-img"/>
                    <input type="file" placeholder="Selection une photo de profil" name="photo" class="form-control">
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="form-group col-md-6 ">
                            <label for="nom">Nom</label>
                            <input id="nom" class="form-control" type="text" name="nom" value="{{ $user->nom }}" placeholder="NOM" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="prenom">Prenom</label>
                            <input id="prenom" class="form-control" type="text" name="prenom" value="{{ $user->prenom }}" placeholder="PRENOM" />
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="form-group col-md-6 ">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" type="email" name="email" value="{{ $user->email }}" placeholder="EMAIL" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telephone">Telephone</label>
                            <input id="telephone" class="form-control" type="text" name="telephone" value="{{ $user->telephone }}" placeholder="TELEPHONE" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="diplome">Dernier diplôme</label>
                            <select name="dernier_diplome" class="form-control">
                                <option value="">-- SELECTIONNER ICI --</option>
                                @foreach($diplomes as $diplome)
                                    <option value="{{ $diplome->id }}" <?= ($user->dernier_diplome == $diplome->id) ? "selected=true" : "" ?>>{{ $diplome->libelle }}</option>
                                @endforeach
                            </select>

                            @error('dernier_diplome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="diplome">Année d'experience</label>
                            <select name="annee_experience" class="form-control">
                                <option value="0">-- SELECTIONNER ICI --</option>
                                <option value="0.5" <?= ($user->annee_experience == 0.5) ? "selected=true" : "" ?>>6 mois</option>
                                <option value="1" <?= ($user->annee_experience == 1) ? "selected=true" : "" ?>>1 an</option>
                                <option value="2" <?= ($user->annee_experience == 2) ? "selected=true" : "" ?>>2 ans</option>
                                <option value="3" <?= ($user->annee_experience == 3) ? "selected=true" : "" ?>>3 ans</option>
                                <option value="4" <?= ($user->annee_experience == 4) ? "selected=true" : "" ?>>4 ans</option>
                                <option value="5" <?= ($user->annee_experience == 5) ? "selected=true" : "" ?>>5 ans</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="adresse">Adresse</label>
                            <textarea id="adresse" class="form-control" type="text" name="adresse" placeholder="ADRESSE">{{ $user->adresse }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Domaine</label>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Ajouter votre CV</label>
                            <input type="file" placeholder="Selection votre cv" name="cv" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col-12">
                            Domaines
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($domaines as $domaine)
                                    <div class="col-md-3 mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="{{ $domaine->slug }}" name="secteur[]" value="{{ $domaine->id }}"  <?= ($secteur_checked->contains('slug', $domaine->slug)) ? "checked" : "" ?>>
                                            <label class="form-check-label" for="{{ $domaine->slug }}">{{ $domaine->libelle }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-outline-custom">
                            MODIFIER
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
