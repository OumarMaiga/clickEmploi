<x-app-layout>
    <div class="container auth-container">
        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-4">
                <div class="auth-title">{{ __('CHANGER DE MOT DE PASSE') }}</div>
    


                <form method="POST" action="{{ route('password.update') }}" class="auth-form">
                    @csrf

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="form-group">
                        <input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" placeholder="EMAIL" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="form-group mt-4">
                        <input id="password" class="form-control" type="password" name="password" placeholder="MOT DE PASSE" required />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group mt-4">
                        <input id="password_confirmation" class="form-control"
                                            type="password"
                                            name="password_confirmation"
                                            placeholder="MOT DE PASSE CONFIRMER" required />
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('CHANGER') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
