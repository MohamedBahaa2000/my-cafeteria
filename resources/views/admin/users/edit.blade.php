@extends('layouts.app')
@section('title', 'Edit User')

@section('content')
<style>
    .section-title {
        font-size: 2rem;
        font-weight: bold;
        color: #4E342E;
    }

    .divider {
        width: 80px;
        height: 4px;
        background-color: #A1887F;
        border-radius: 6px;
        margin: 0 auto 20px;
    }

    .form-label {
        color: #5D4037;
        font-weight: 600;
    }

    .form-control, .form-select {
        border: 1px solid #BCAAA4;
        border-radius: 6px;
        transition: 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #8D6E63;
        box-shadow: 0 0 0 0.2rem rgba(141, 110, 99, 0.25);
    }

    .btn-coffee {
        background-color: #6D4C41;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    .btn-coffee:hover {
        background-color: #5D4037;
    }

    .card {
        background-color: #FBE9E7;
        border: none;
    }

    .coffee-alert-danger {
        background-color: #EF9A9A;
        color: #B71C1C;
        border-radius: 8px;
        padding: 12px;
    }
</style>

<div class="container py-4">
    <div class="text-center mb-4 section-header">
        <h2 class="section-title"> Edit User</h2>
        <div class="divider mx-auto"></div>
    </div>

    @if ($errors->any())
        <div class="alert coffee-alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.update', $user->id) }}" class="card p-4 shadow-sm rounded-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label"> Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label"> Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="room_number" class="form-label"> Room Number</label>
            <input type="text" name="room_number" class="form-control" id="room_number"
                   value="{{ old('room_number', $user->room_number) }}" required>
            @error('room_number')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label"> New Password <small class="text-muted">(optional)</small></label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label"> Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        

        <div class="text-end">
            <button class="btn btn-coffee"> Update</button>
        </div>
    </form>
</div>
@endsection
