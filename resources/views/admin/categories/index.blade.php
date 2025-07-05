@extends('layouts.app')

@section('title', 'Manage Categories')

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
        border-radius: 6px;
    }

    .btn-coffee:hover {
        background-color: #5D4037;
    }

    .btn-edit {
        background-color: #8D6E63;
        color: white;
        border: none;
        border-radius: 6px;
    }

    .btn-edit:hover {
        background-color: #795548;
    }

    .btn-delete {
        background-color: #D32F2F;
        color: white;
        border: none;
        border-radius: 6px;
    }

    .btn-delete:hover {
        background-color: #B71C1C;
    }

    .table thead {
        background-color: #EFEBE9;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .alert-success {
        background-color: #C8E6C9;
        color: #2E7D32;
        border: none;
        border-radius: 8px;
    }
</style>

<div class="container py-4">
    <div class="text-center mb-4">
        <h2 class="section-title"> Manage Categories</h2>
        <div class="divider"></div>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="text-end mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-coffee"> Add Category</a>
    </div>

    <div class="table-responsive shadow-sm rounded-3">
        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-edit me-1"> Edit</a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-delete"> Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-muted">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
</div>
@endsection
