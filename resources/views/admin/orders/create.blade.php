@extends('layouts.app')
@section('title', 'Create Order')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">🧾 Create Order for User</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf

        {{-- اختيار المستخدم --}}
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select name="user_id" class="form-select" required>
                <option value="">Choose User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        {{-- اختيار المنتجات والكمية --}}
        <h5 class="mt-4 mb-2">Products</h5>

        @foreach($products as $product)
        <div class="card mb-2 p-3 shadow-sm">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <strong>{{ $product->name }}</strong> - {{ number_format($product->price, 2) }} EGP
                </div>
                <div class="col-md-3">
                    <input type="number" name="products[{{ $product->id }}]" min="0" class="form-control" placeholder="Quantity">
                </div>
            </div>
        </div>
        @endforeach

        <button type="submit" class="btn btn-success mt-3">Submit Order</button>
    </form>
</div>
@endsection
