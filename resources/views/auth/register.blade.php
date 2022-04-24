<x-app-layout>
    <div class="auth-container bg-container">
        <div class="row">
            <div class="col-md-6 register-left-container">
                <div class="register-left-title">
                    Créez votre profil en quelques clics  et laissez l’emploi venir à vous.
                </div>
                <p>Plus besoin de chercher, Grâce à notre algorithme de matching nous trouvons pour vous les offres qui correspondent à votre profil:
                    
                    <strike></strike>
                </p>
                <ul class="register-list-rule">
                    <li>
                        <i class="far fa-check-circle register-left-icon"></i><span style="margin-left: .5rem;">Inscrivez-vous sur la plateforme</span>
                    </li>
                    <li>
                        <i class="far fa-check-circle register-left-icon"></i><span style="margin-left: .5rem;">Complétez votre profil</span>
                    </li>
                    <li>
                        <i class="far fa-check-circle register-left-icon"></i><span style="margin-left: .5rem;">Uploader votre CV</span>
                    </li>
                    <li>
                        <i class="far fa-check-circle register-left-icon"></i><span style="margin-left: .5rem;">Souscrivez-vous à l'alert SMS </span>
                    </li>
                    <li>
                        <i class="far fa-check-circle register-left-icon"></i><span style="margin-left: .5rem;">Trouver en quelques clics votre emploi de rêve !!!</span>
                    </li>
                    <br>
                     <br>
                    
                </ul>
            </div>
            <div class="col-md-6 register-right-container">
                <div class="auth-title">{{ __('Inscrivez-vous ici !!') }}</div>


                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    @csrf

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" placeholder="PRENOM" required autocomplete="prenom" autofocus>

                            @error('prenom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" placeholder="NOM" required autocomplete="nom">

                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" placeholder="TELEPHONE" required autocomplete="telephone">

                            @error('telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-lg-6">                            
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-MAIL" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="MOT DE PASSE" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                        <div class="form-group col-lg-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="CONFIRMATION MOT DE PASSE" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            <label for="date_naissance">Date de naissance</label>
                            <input id="date_naissance" type="date" class="form-control @error('date_naissance') is-invalid @enderror" name="date_naissance" value="{{ old('date_naissance') }}" placeholder="DATE DE NAISSANCE" required autocomplete="">

                            @error('date_naissance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-lg-6">
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
                    <div class="form-group">
                        <label for="annee_experience">Année d'experience</label>
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

                    <!--<div class="form-group">
                        <div class="col-12">
                            Categorie
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($domaines as $domaine)
                                    <div class="col-lg-4 mt-2">
                                        <div class="domaine-title">
                                            {{ $domaine->libelle }}
                                        </div>
                                        <?php $activites = App\Models\Activite::where('secteur_id', $domaine->id)->get() ?>
                                        @foreach ($activites as $activite)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="{{ $activite->slug }}" name="activite[]" value="{{ $activite->id }}">
                                                <label class="form-check-label" for="{{ $activite->slug }}">{{ $activite->libelle }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>-->
                    
                    <div class="form-group">
                        <div class="col-12">
                            Domaines
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($domaines as $domaine)
                                    <div class="col-md-4 mt-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="{{ $domaine->slug }}" name="secteur[]" value="{{ $domaine->id }}">
                                            <label class="form-check-label" for="{{ $domaine->slug }}">{{ $domaine->libelle }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="form-check form-check-inline"> 
                                <input class="form-check-input" type="checkbox" id="alert-sms" name="alert_sms" checked>
                                <label class="form-check-label" for="alert-sms" style="font-style: italic">Souscrivez à l'alert SMS à (500f/mois)</label>
                            </div>

                            @error('alert-sms')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-custom">
                                {{ __('VALIDER') }}
                            </button>
                            
                            <a class="btn-link" href="{{ route('login') }}" style="margin-left: 2rem;">
                                {{ __('Connexion') }}
                            </a>
                        </div>
                    </div>
                    <div class="cgu">
                        En cliquant sur « Valider » , vous acceptez les CGU ainsi que notre <a href="#" style="color: #0056b3; text-decoration: underline;">politique de confidentialité</a> décrivant la finalité des traitements de vos données personnelles.
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
