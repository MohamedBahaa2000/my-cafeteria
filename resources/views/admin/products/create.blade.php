@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Add New Product</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Product Name:</label>
            <input type="text" class="form-control" name="name" id="name" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price (EGP):</label>
            <input type="number" class="form-control" name="price" id="price" required step="0.01" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Product Image (optional):</label>
            <input type="file" class="form-control" name="image" id="image" accept="image/*">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_available" id="is_available" {{ old('is_available') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_available">
                Available for sale
            </label>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Add Product</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
