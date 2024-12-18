@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-center login-container">
        <div class="card login-card shadow-lg">
            <div class="card-header text-center">
                <h3>{{ __('Register') }}</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Username -->
                    <div class="mb-4">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}" required autocomplete="username"
                            placeholder="{{ __('Username') }}" />

                        @error('username')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-4">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="{{ __('Email Address') }}" />

                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}" />

                        @error('password')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}" />
                    </div>

                    <!-- Register Button -->
                    <div class="d-flex flex-column align-items-center gap-3">
                        <button type="submit" class="btn btn-primary w-100 btn-lg">
                            {{ __('Register') }}
                        </button>
                        <div class="mt-1">
                            <span>Aleady have account?
                                <a href="{{ route('login') }}" class="btn btn-link p-0">
                                    {{ __('Login') }}
                                </a>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
