@extends('layouts.app')

@section('title', 'Create Order')

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

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #D7CCC8;
        border-radius: 12px;
        overflow: hidden;
    }

    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .card-title {
        color: #5D4037;
        font-weight: bold;
    }

    .btn-submit-order {
        background-color: #6D4C41;
        color: white;
        padding: 10px 30px;
        font-size: 1.1rem;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-submit-order:hover {
        background-color: #5D4037;
    }

    .form-select,
    .form-control {
        border-color: #A1887F;
    }

    label.form-label {
        font-weight: bold;
        color: #4E342E;
    }
</style>

<div class="container py-4">
    <div class="text-center mb-4">
        <h2 class="section-title"> Create Order for User</h2>
        <div class="divider"></div>
    </div>

    {{-- رسائل الخطأ --}}
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- اختيار المستخدم --}}
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf

        <div class="mb-4">
            <label class="form-label"> User</label>
            <select name="user_id" class="form-select" required>
                <option value="">Choose User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <h5 class="mb-3" style="color: #6D4C41;">🛒 Choose Products</h5>

        {{-- المنتجات --}}
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="{{ asset('assets/images/no-image.png') }}" class="card-img-top" alt="No image" style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body d-flex flex-column justify-content-between" style="background-color: #FAF9F8;">
                            <div>
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="text-muted mb-1">📂 {{ $product->category->name ?? '-' }}</p>
                                <p class="fw-bold" style="color: #8D6E63;">💰 {{ number_format($product->price, 2) }} EGP</p>
                            </div>

                            <input type="hidden" name="products[{{ $loop->index }}][id]" value="{{ $product->id }}">
                            <input type="number" name="products[{{ $loop->index }}][quantity]" class="form-control mt-2" min="0" placeholder="Quantity">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-submit-order">
                 Submit Order
            </button>
        </div>
    </form>
</div>
@endsection
