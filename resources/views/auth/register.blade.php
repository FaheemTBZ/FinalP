@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Material form register -->
            <form method="POST" action="{{ route('register') }}" id="registerForm" class="bg-white p-5 is-rounded shadow">
                @csrf

                <p class="h4 text-center py-4">Registeration Below.</p>

                <!-- Material input text -->
                <div class="md-form">
                    <i class="fa fa-user prefix grey-text"></i>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                    <label for="name" data-error="wrong" data-success="right">Type your Name</label>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Material input email -->
                <div class="md-form">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" />
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
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" />
                    <label for="password" data-error="wrong" data-success="right">Type your Password</label>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Material input confirm password -->
                <div class="md-form">
                    <i class="fa fa-exclamation-triangle prefix grey-text"></i>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" />
                    <label for="password-confirm" data-error="wrong" data-success="right">Confirm your Password</label>
                </div>

                <div class="text-center py-2">
                    <button class="btn btn-block btn-cyan rounded-lg" type="submit">Register</button>
                </div>
            </form>
            <!-- Material form register -->

        </div>
    </div>
</div>

@endsection