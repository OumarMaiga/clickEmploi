<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="auth-title">{{ __('INSCRIPTION') }}</div>

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" placeholder="PRENOM" required autocomplete="prenom" autofocus>

                            @error('prenom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" placeholder="NOM" required autocomplete="nom">

                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="date_naissance">Date de naissance</label>
                            <input id="date_naissance" type="date" class="form-control @error('date_naissance') is-invalid @enderror" name="date_naissance" value="{{ old('date_naissance') }}" placeholder="DATE DE NAISSANCE" required autocomplete="">

                            @error('date_naissance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label for="diplome">Dernier diplôme</label>
                            <select name="dernier_diplome" class="form-control">
                                <option value="">-- SELECTIONNER ICI --</option>
                                @foreach($diplomes as $diplome)
                                    <option value="{{ $diplome->id }}">{{ $diplome->libelle }}</option>
                                @endforeach
                            </select>

                            @error('date_naissance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="diplome">Année d'experience</label>
                            <select name="annee_experience" class="form-control">
                                <option value="0">-- SELECTIONNER ICI --</option>
                                <option value="0.5">6 mois</option>
                                <option value="1">1 an</option>
                                <option value="2">2 ans</option>
                                <option value="3">3 ans</option>
                                <option value="4">4 ans</option>
                                <option value="5">5 ans</option>
                            </select>
                            @error('annee_experience')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" placeholder="TELEPHONE" required autocomplete="telephone">

                            @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-MAIL" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="MOT DE PASSE" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="CONFIRMATION MOT DE PASSE" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-row">
                        <label for="diplome">Secteur d'activité</label>
                        <div class="form-group col-md-12">
                            @foreach ($domaines as $domaine)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="{{ $domaine->slug }}" name="secteur[]" value="{{ $domaine->id }}">
                                    <label class="form-check-label" for="{{ $domaine->slug }}">{{ $domaine->libelle }}</label>
                                </div>
                            @endforeach                            

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 d-flex justify-content-between">
                            <button type="submit" class="btn btn-custom">
                                {{ __('INSCRIPTION') }}
                            </button>
                            
                            <a class="btn-link mt-auto" href="{{ route('login') }}">
                                {{ __('Connexion') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
