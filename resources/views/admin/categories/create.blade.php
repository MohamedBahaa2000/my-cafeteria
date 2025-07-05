@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
<style>
    .glass-card {
        max-width: 500px;
        margin: 40px auto;
        padding: 30px;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        border: 1px solid #ddd;
    }

    .glass-card h2 {
        font-weight: bold;
        color: #4E342E;
        text-align: center;
    }

    .btn-coffee {
        background-color: #6D4C41;
        color: white;
        padding: 10px 30px;
        border: none;
        border-radius: 10px;
        transition: background-color 0.3s ease;
        display: block;
        margin: 0 auto;
    }

    .btn-coffee:hover {
        background-color: #5D4037;
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
</style>

<div class="glass-card">
    <h2 class="mb-4"> Add New Category</h2>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-coffee mt-3">Save</button>
    </form>
</div>
@endsection
