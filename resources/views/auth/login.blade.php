@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5" style="min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4 p-4 border-0" style="background-color: #fdfaf6;">
                <h2 class="text-center mb-4 fw-bold" style="color: #5a3e36;"> Login to Your Account</h2>

                @if (session('status'))
                    <div class="alert alert-success text-center">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="form-control rounded-3 shadow-sm">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input id="password" type="password" name="password" required
                            class="form-control rounded-3 shadow-sm">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                        <label class="form-check-label" for="remember_me">Remember me</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        @if (Route::has('password.request'))
                            <a class="text-decoration-none text-muted small" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif

                        <button type="submit" class="btn btn-primary px-4 rounded-3" style="background-color: #7c4f3a; border: none;">
                            Login
                        </button>
                    </div>
                </form>

                <hr class="my-4">
                <div class="text-center">
                    <span class="text-muted">Don't have an account?</span>
                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: #7c4f3a;">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
