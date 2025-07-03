@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container py-5" style="min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg rounded-4 p-4 border-0" style="background-color: #fdfaf6;">
                <h2 class="text-center mb-4 fw-bold" style="color: #5a3e36;"> Create a New Account</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                            class="form-control rounded-3 shadow-sm" required autofocus autocomplete="name">
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                            class="form-control rounded-3 shadow-sm" required autocomplete="email">
                    </div>

                    <!-- Room Number -->
                    <div class="mb-3">
                        <label for="room_number" class="form-label fw-semibold">Room Number</label>
                        <input id="room_number" type="text" name="room_number" value="{{ old('room_number') }}"
                            class="form-control rounded-3 shadow-sm" required autocomplete="room">
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input id="password" type="password" name="password"
                            class="form-control rounded-3 shadow-sm" required autocomplete="new-password">
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="form-control rounded-3 shadow-sm" required autocomplete="new-password">
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('login') }}" class="text-decoration-none text-muted">Already have an account?</a>
                        <button type="submit" class="btn btn-primary px-4 rounded-3"
                            style="background-color: #7c4f3a; border: none;">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
