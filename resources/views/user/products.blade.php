@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Available Products</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($products as $product)
        <div class="col">
    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
        @else
            <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top">
        @endif

        <div class="card-body d-flex flex-column">
            <h5 class="card-title fw-bold">{{ $product->name }}</h5>
            <p class="card-text text-muted mb-2">{{ number_format($product->price, 2) }} EGP</p>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                @csrf
                <div class="input-group">
                    <input type="number" name="quantity" min="1" value="1" class="form-control">
                    <button class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                No products available at the moment.
            </div>
        </div>
        @endforelse
    </div>

    <div class="text-end mt-4">
        <a href="{{ route('cart.view') }}" class="btn btn-success">🛒 View Cart</a>
    </div>
</div>
@endsection
