@extends('layouts.app')
@section('title', 'Edit Category')

@section('content')
<style>
    .glass-card {
        max-width: 500px;
        margin: 40px auto;
        padding: 30px;
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        border: 1px solid #ddd;
    }

    .glass-card h2 {
        font-weight: bold;
        color: #4E342E;
        text-align: center;
    }

    label.form-label {
        font-weight: 600;
        color: #5D4037;
    }

    input.form-control {
        border-radius: 10px;
        border: 1px solid #BCAAA4;
        box-shadow: none;
    }

    input.form-control:focus {
        border-color: #8D6E63;
        box-shadow: 0 0 0 0.15rem rgba(141, 110, 99, 0.25);
    }

    .btn-coffee {
        background-color: #6D4C41;
        color: white;
        padding: 10px 30px;
        border: none;
        border-radius: 10px;
        transition: background-color 0.3s ease;
    }

    .btn-coffee:hover {
        background-color: #5D4037;
    }

    .btn-secondary {
        border-radius: 10px;
    }
</style>

<div class="glass-card">
    <h2 class="mb-4"> Edit Category</h2>

    <form method="POST" action="{{ route('categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-coffee">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
