@extends('layouts.app')

@section('title', 'User Management')

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

    .btn-coffee {
        background-color: #6D4C41;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    .btn-coffee:hover {
        background-color: #5D4037;
    }

    .btn-edit {
        background-color: #8D6E63;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
        margin-left: 4px;
    }

    .btn-edit:hover {
        background-color: #795548;
    }

    .coffee-btn-remove {
        background-color: #D84315;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
    }

    .coffee-btn-remove:hover {
        background-color: #BF360C;
    }

    .cart-table thead {
        background-color: #EFEBE9;
        color: #5D4037;
    }

    .cart-table td, .cart-table th {
        vertical-align: middle;
    }

    .alert-success {
        background-color: #A5D6A7;
        border: none;
        color: #1B5E20;
    }

    .alert-danger {
        background-color: #EF9A9A;
        border: none;
        color: #B71C1C;
    }
</style>

<div class="container py-4">
    <div class="text-center mb-4 section-header">
        <h2 class="section-title"> All Users</h2>
        <div class="divider mx-auto"></div>
    </div>

    {{-- الرسائل --}}
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    {{-- زر الإضافة --}}
    <div class="text-end mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-coffee">
             Add New User
        </a>
    </div>

    {{-- الجدول --}}
    <div class="table-responsive">
        <table class="table table-bordered cart-table text-center align-middle shadow-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th> Name</th>
                    <th> Email</th>
                    <th> Orders</th>
                    <th> Joined At</th>
                    <th> Actions</th>
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

                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-edit">Edit</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button class="coffee-btn-remove btn btn-sm">Delete</button>
                        </form>
                        
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
</div>
@endsection
