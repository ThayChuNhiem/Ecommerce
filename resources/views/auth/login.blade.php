{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<!-- resources/views/auth/login.blade.php -->
<x-guest-layout>
    <div class="card card-primary">
        <div class="card-header">
            <h4>{{ __('Login') }}</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                        {{ __('Please fill in your email') }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">{{ __('Password') }}</label>
                        <div class="float-right">
                            <a href="{{ route('password.request') }}" class="text-small">
                                {{ __('Forgot Password?') }}
                            </a>
                        </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                        {{ __('Please fill in your password') }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                        <label class="custom-control-label" for="remember-me">{{ __('Remember Me') }}</label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
            <div class="text-center mt-4 mb-3">
                <div class="text-job text-muted">{{ __('Login With Social') }}</div>
            </div>
            <div class="row sm-gutters">
                <div class="col-6">
                    <a class="btn btn-block btn-social btn-facebook">
                        <span class="fab fa-facebook"></span> Facebook
                    </a>
                </div>
                <div class="col-6">
                    <a class="btn btn-block btn-social btn-twitter">
                        <span class="fab fa-twitter"></span> Twitter
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5 text-muted text-center">
        {{ __("Don't have an account?") }} <a href="{{ route('register') }}">{{ __('Create One') }}</a>
    </div>
</x-guest-layout>