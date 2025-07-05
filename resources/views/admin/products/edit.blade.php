@extends('layouts.app')

@section('title', 'Edit Product')

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

    .coffee-btn-order {
        background-color: #6D4C41;
        color: white;
        padding: 10px 20px;
        border-radius: 6px;
        border: none;
    }

    .coffee-btn-order:hover {
        background-color: #5D4037;
    }

    .product-img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #ccc;
    }

    .form-label {
        font-weight: 600;
        color: #5D4037;
    }

    .form-check-label {
        color: #4E342E;
    }

    .form-check-input:checked {
        background-color: #6D4C41;
        border-color: #6D4C41;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid #BCAAA4;
    }

    .alert {
        border-radius: 8px;
    }
</style>

<div class="container py-4">
    <div class="text-center mb-4 section-header">
        <h2 class="section-title"> Edit Product</h2>
        <div class="divider mx-auto"></div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger text-start">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm rounded-4 bg-white">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Product Name:</label>
            <input type="text" class="form-control" name="name" id="name" required value="{{ old('name', $product->name) }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price (EGP):</label>
            <input type="number" class="form-control" name="price" id="price" required step="0.01" value="{{ old('price', $product->price) }}">
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category:</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">-- Choose Category --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Product Image:</label><br>
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="product-img mb-3"><br>
            @endif
            <input type="file" class="form-control" name="image" id="image" accept="image/*">
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="is_available" id="is_available" {{ $product->is_available ? 'checked' : '' }}>
            <label class="form-check-label" for="is_available">
                Available for Sale
            </label>
        </div>

        <div class="text-end">
            <button type="submit" class="btn coffee-btn-order me-2"> Update Product</button>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary"> Cancel</a>
        </div>
    </form>
</div>
@endsection
