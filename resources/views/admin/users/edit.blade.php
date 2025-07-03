@extends('layouts.app')
@section('title', 'Edit User')

@section('content')
<div class="container py-4">
    <div class="text-center mb-4 section-header">
        <h2 class="section-title"> Edit User</h2>
        <div class="divider mx-auto"></div>
    </div>

    @if ($errors->any())
        <div class="alert coffee-alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.update', $user->id) }}" class="card p-4 shadow-sm rounded-4 bg-white">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="room_number" class="form-label">Room Number</label>
            <input type="text" name="room_number" class="form-control" id="room_number"
                   value="{{ old('room_number', $user->room_number) }}" required>
            @error('room_number')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">New Password (optional)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Is Admin?</label>
            <select name="is_admin" class="form-select">
                <option value="0" {{ $user->is_admin ? '' : 'selected' }}>No</option>
                <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <div class="text-end">
            <button class="btn btn-coffee">Update</button>
        </div>
    </form>
</div>
@endsection
