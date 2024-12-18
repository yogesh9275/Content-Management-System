@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center login-container">
        <div class="card login-card shadow-lg">
            <div class="card-header text-center">
                <h3>{{ __('Login') }}</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}" required autocomplete="username" autofocus
                            placeholder="{{ __('Username') }}" />

                        @error('username')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>


                    <!-- Password -->
                    <div class="mb-4">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}" />

                        @error('password')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-4 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>

                    <!-- Submit and Forgot Password Links -->
                    <div class="d-flex flex-column align-items-center gap-3">
                        <button type="submit" class="btn btn-primary w-100 btn-lg">
                            {{ __('Login') }}
                        </button>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link p-0" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                        <div class="mt-1 text-center">
                            <span>Don't have a Account?
                            <a href="{{ route('register') }}" class="btn btn-link p-0">
                                {{ __('Create an Account') }}
                            </a>
                            </span>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
