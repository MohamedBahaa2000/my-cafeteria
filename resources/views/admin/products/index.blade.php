@extends('layouts.app')

@section('title', 'Product Management')

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

    .product-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .product-price {
        font-weight: bold;
        color: #6D4C41;
    }

    .coffee-btn-remove {
        background-color: #D32F2F;
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
    }

    .coffee-btn-remove:hover {
        background-color: #B71C1C;
    }

    .btn-coffee {
        background-color: #6D4C41;
        color: white;
        padding: 8px 20px;
        border-radius: 6px;
        transition: 0.3s ease;
    }

    .btn-coffee:hover {
        background-color: #5D4037;
    }

    .coffee-filter-select {
        border: 1px solid #A1887F;
        border-radius: 6px;
        background-color: #FAFAFA;
    }

    .product-table thead {
        background-color: #D7CCC8;
        color: #4E342E;
    }
</style>

<div class="container py-4">
    <div class="text-center mb-4 section-header">
        <h2 class="section-title"> All Products</h2>
        <div class="divider mx-auto"></div>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="row align-items-center mb-4">
        <div class="col-md-4">
            <form method="GET" action="{{ route('products.index') }}">
                <select name="category" class="form-select coffee-filter-select" onchange="this.form.submit()">
                    <option value=""> All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="col-md-8 text-end">
            <a href="{{ route('products.create') }}" class="btn btn-coffee"> Add New Product</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle product-table shadow-sm">
            <thead>
                <tr>
                    <th> Name</th>
                    <th> Category</th>
                    <th> Price</th>
                    <th> Image</th>
                    <th> Status</th>
                    <th> Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td><span class="product-price">{{ number_format($product->price, 2) }} EGP</span></td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="product-img">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>
                            @if($product->is_available)
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-danger">Unavailable</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning me-1"> Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm coffee-btn-remove"> Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-muted">No products available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
