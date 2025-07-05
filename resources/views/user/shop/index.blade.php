@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<style>
    .shop-title {
        color: #4E342E;
        font-weight: bold;
        letter-spacing: 1px;
    }

    .product-card {
        border: none;
        border-radius: 20px;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .product-card img {
        height: 220px;
        object-fit: cover;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .product-card .card-body {
        background-color: #FAF3E0;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    .product-card .btn {
        background-color: #6D4C41;
        color: white;
        border: none;
    }

    .product-card .btn:hover {
        background-color: #5D4037;
    }

    .filter-select {
        border: 2px solid #A1887F;
        border-radius: 12px;
        padding: 10px;
    }

    .alert-success {
        background-color: #81C784;
        color: white;
    }

    .empty-message {
        background-color: #D7CCC8;
        color: #3E2723;
        font-weight: bold;
        border-radius: 10px;
    }

</style>

<div class="container py-4">
    <h2 class="text-center mb-4 shop-title">☕ Welcome to TATORIA CAFE</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
    @endif

    {{-- Category Filter --}}
    <form method="GET" action="{{ route('shop') }}" class="row justify-content-center mb-4">
        <div class="col-md-6">
            <select name="category" class="form-select filter-select" onchange="this.form.submit()">
                <option value="">-- All Categories --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    {{-- Product Cards --}}
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card product-card shadow-sm h-100">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('assets/images/no-image.png') }}" class="card-img-top" alt="{{ $product->name }}">

                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-muted small mb-1">📂 {{ $product->category->name ?? '-' }}</p>
                            <p class="fw-bold fs-5" style="color: #6D4C41;">{{ number_format($product->price, 2) }} EGP</p>
                        </div>

                        <form method="POST" action="{{ route('cart.add', $product->id) }}">
                            @csrf
                            <div class="input-group mt-3">
                                <input type="number" name="quantity" class="form-control" min="1" value="1" required>
                                <button class="btn" type="submit">🛒 Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert text-center empty-message">
                     No products found in this category.
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
