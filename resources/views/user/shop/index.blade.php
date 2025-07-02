@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">🛒 Shop</h2>

    {{-- رسائل النجاح --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    {{-- فلتر التصنيفات --}}
    <form method="GET" action="{{ route('shop') }}" class="row mb-4">
        <div class="col-md-4 mx-auto">
            <select name="category" class="form-select" onchange="this.form.submit()">
                <option value="">-- All Categories --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    {{-- المنتجات --}}
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('assets/images/no-image.png') }}" class="card-img-top" alt="No image" style="height: 200px; object-fit: cover;">
                    @endif

                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted small">Category: {{ $product->category->name ?? '-' }}</p>
                            <p class="card-text fw-bold">{{ number_format($product->price, 2) }} EGP</p>
                        </div>

                        <form method="POST" action="{{ route('cart.add', $product->id) }}">
                            @csrf
                            <div class="input-group mt-3">
                                <input type="number" name="quantity" class="form-control" min="1" value="1" required>
                                <button class="btn btn-success" type="submit">Add to Cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No products found in this category.
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
