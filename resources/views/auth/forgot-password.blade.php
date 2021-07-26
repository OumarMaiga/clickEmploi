<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4">

                <div class="auth-title">{{ __('MOT DE PASSE OUBLIE') }}</div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="EMAIL" required autofocus />
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-custom">
                            {{ __('VERIFICATION') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
