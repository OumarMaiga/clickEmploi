<x-app-layout>
    <div class="container auth-container">
        <div class="row">
            <div class="col-md-6 register-left-container">
                <div class="register-left-title">
                    Recevez les offres qui corresponde à votre profil
                </div>
                <p style="margin: 3rem 0 1rem 0;">
                    Nous vous proposons tous les offres et surtout celles correspondants à votre profil:
                </p>
                <ul class="register-list-rule">
                    <li>
                        <i class="far fa-check-circle register-left-icon"></i><span style="margin-left: .5rem;">Identifiez-vous sur la plateforme</span>
                    </li>
                    <li>
                        <i class="far fa-check-circle register-left-icon"></i><span style="margin-left: .5rem;">Complétez votre profil</span>
                    </li>
                    <li>
                        <i class="far fa-check-circle register-left-icon"></i><span style="margin-left: .5rem;">Uploader votre CV</span>
                    </li>
                    <li>
                        <i class="far fa-check-circle register-left-icon"></i><span style="margin-left: .5rem;">Souscrivez-vous à l'alert SMS (facultative)</span>
                    </li>
                    <li>
                        <i class="far fa-check-circle register-left-icon"></i><span style="margin-left: .5rem;">Recevez les offres en matching avec votre profil</span>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 register-right-container">
                <div class="auth-title">{{ __('INSCRIPTION') }}</div>


                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    @csrf

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <div class="form-group">
                        <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" placeholder="TELEPHONE" required autocomplete="telephone">

                        @error('telephone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">                            
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-MAIL" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="MOT DE PASSE" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="CONFIRMATION MOT DE PASSE" required autocomplete="new-password">
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-custom">
                                {{ __('INSCRIPTION') }}
                            </button>
                            
                            <a class="btn-link" href="{{ route('login') }}" style="margin-left: 2rem;">
                                {{ __('Connexion') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
