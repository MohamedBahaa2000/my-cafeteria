@extends('layouts.app')
@section('title', 'Add User')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">➕ Add New User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.store') }}" class="card p-4 shadow-sm rounded-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Is Admin?</label>
            <select name="is_admin" class="form-select">
                <option value="0" selected>No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
