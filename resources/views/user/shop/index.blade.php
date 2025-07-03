@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4" style="color: #5D4037;">🛒 Shop</h2>

    {{-- رسائل النجاح --}}
    @if(session('success'))
        <div class="alert alert-success text-center" style="background-color: #4CAF50; color: white;">{{ session('success') }}</div>
    @endif

    {{-- فلتر التصنيفات --}}
    <form method="GET" action="{{ route('shop') }}" class="row mb-4">
        <div class="col-md-4 mx-auto">
            <select name="category" class="form-select" onchange="this.form.submit()" style="border-color: #8D6E63;">
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
                <div class="card h-100 shadow-sm" style="border-color: #D7CCC8;">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover; border-bottom: 1px solid #D7CCC8;">
                    @else
                        <img src="{{ asset('assets/images/no-image.png') }}" class="card-img-top" alt="No image" style="height: 200px; object-fit: cover; border-bottom: 1px solid #D7CCC8;">
                    @endif

                    <div class="card-body d-flex flex-column justify-content-between" style="background-color: #EFEBE9;">
                        <div>
                            <h5 class="card-title" style="color: #5D4037;">{{ $product->name }}</h5>
                            <p class="card-text text-muted small">Category: {{ $product->category->name ?? '-' }}</p>
                            <p class="card-text fw-bold" style="color: #8D6E63;">{{ number_format($product->price, 2) }} EGP</p>
                        </div>

                        <form method="POST" action="{{ route('cart.add', $product->id) }}">
                            @csrf
                            <div class="input-group mt-3">
                                <input type="number" name="quantity" class="form-control" min="1" value="1" required style="border-color: #8D6E63;">
                                <button class="btn" type="submit" style="background-color: #8D6E63; color: white;">Add to Cart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center" style="background-color: #BCAAA4; color: white;">
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