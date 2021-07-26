<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
        

            <div class="col-md-4">
                <div class="auth-title">{{ __('CONNEXION') }}</div>
    
            <x-auth-access-denied class="mb-4" :denied="session('denied')" />
            
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
        
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
                <form method="POST" action="{{ route('login') }}">
                    @csrf
        
                    <!-- Email Address -->
                    <div class="form-group">
                        <input id="login" class="form-control" type="text" name="login" value="{{ old('telephone') ?: old('email') }}" placeholder="EMAIL / TELEPHONE" required autofocus />
                    </div>
        
                    <!-- Password -->
                    <div class="form-group">      
                        <input id="password" class="form-control"
                                        type="password"
                                        name="password"
                                        placeholder="MOT DE PASSE"
                                        required autocomplete="current-password" />
                            @if (Route::has('password.request'))
                                <a class="btn-link float-right" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié ?') }}
                                </a>
                            @endif
                    </div>
        
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</span>
                        </label>
                    </div>
        
                    <div class="mt-4 d-flex justify-content-between">
            
                            <button type="submit" class="btn btn-custom">
                                {{ __('CONNEXION') }}
                            </button>
                            <a class="btn-link mt-auto" href="{{ route('register') }}">
                                {{ __('Inscription') }}
                            </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
