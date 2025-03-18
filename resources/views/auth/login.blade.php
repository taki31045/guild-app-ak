@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url("{{ asset('images/Ancient-Roman-Colosseum2.jpg') }}");
        background-position: center;
    }
    img {
        height: 500px;
        margin-top: 50px;
        box-shadow: 0px 4px 25px rgba(0, 0, 0, 0.8); /* Darker shadow */
    }
    .container{
        background-color: rgba(255, 255, 255, 0.6);
    }
</style>
<div class="container mt-5 rounded-5" style="height: 600px; width: 1000px;">
    <div class="row">
        <div class="col-6">
            <img src="{{ asset('images/2c0bedefad1bf39d2f262d96d87070e4.jpg')}}" class="deep-shadow rounded ms-3" alt="image-login">
        </div>
        <div class="col-6">
            <div class="card ms-4 mt-5 bg-transparent" style="max-width: 500px; margin: auto; border: none;">
                <div class="card-header text-center bg-transparent">
                    <h4 class="text-black">{{ __('Login') }}</h4>
                </div>

                <div class="card-body mt-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email input -->
                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember me checkbox -->
                        <div class="mb-4 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                        </div>

                        <!-- Buttons -->
                        <div class="">
                            <button type="submit" class="btn btn-secondary w-100">
                                {{ __('Login') }}
                            </button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
