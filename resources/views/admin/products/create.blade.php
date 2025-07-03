@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="container py-4">
    <div class="text-center mb-4 section-header">
        <h2 class="section-title"> Add New Product</h2>
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

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price (EGP)</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <div class="d-flex gap-2">
                <select name="category_id" id="category_id" class="form-select" required>
                    <option value="">-- Choose Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <a href="{{ route('categories.create') }}" class="btn btn-outline-secondary">+ Category</a>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" accept="image/*" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Availability</label>
            <select name="is_available" class="form-select">
                <option value="1" selected>Available</option>
                <option value="0">Not Available</option>
            </select>
        </div>

        <div class="text-end">
            <button class="btn coffee-btn-order">Save</button>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
