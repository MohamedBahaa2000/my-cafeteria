@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<div class="container py-4">
    <div class="text-center mb-4 section-header">
        <h2 class="section-title">All Users</h2>
        <div class="divider mx-auto"></div>
    </div>

    @if(session('success'))
        <div class="alert alert-success coffee-alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger coffee-alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <div class="text-end mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-coffee">
            Add New User
        </a>
    </div>

    <table class="table cart-table text-center align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Orders</th>
                <th>Joined At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->orders_count }}</td>
                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                <td>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this user?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm coffee-btn-remove">Delete</button>
                    </form>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-edit">Edit</a>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-muted">No users found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
