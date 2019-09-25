@extends('layouts.app')

@section('content')
<div class="container-fluid login-container">
    <div class="row justify-content-center">
        <div class="col-md-4 login-card-container">

            <!-- Material form register -->
            <form method="POST" action="{{ route('login') }}" id="loginForm" class="bg-white is-rounded shadow p-5">
                @csrf

                <p class="h4 text-center py-4">Login Below.</p>

                <!-- Material input email -->
                <div class="md-form">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label for="email" data-error="wrong" data-success="right">Type your Email</label>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Material input password -->
                <div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <label for="password" data-error="wrong" data-success="right">Type your Password</label>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="md-form text-center">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>

            </form>
            <!-- Material form Login -->

        </div>
    </div>
</div>
@endsection