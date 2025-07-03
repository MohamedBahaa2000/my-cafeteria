@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container py-4 coffee-cart-container">
    <h2 class="coffee-cart-title">🛒 My Cart</h2>

    @if(session('success'))
        <div class="alert coffee-alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert coffee-alert-danger">{{ session('error') }}</div>
    @endif

    @if(count($cartItems) > 0)
        <table class="table coffee-cart-table">
            <thead class="coffee-thead">
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp

                @foreach($cartItems as $item)
                    @php
                        $product = $item['product'];
                        $subtotal = $product->price * $item['quantity'];
                        $total += $subtotal;
                    @endphp

                    <tr class="coffee-tr">
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" width="70" alt="Product Image" class="coffee-product-img">
                            @else
                                <img src="{{ asset('assets/images/no-image.png') }}" width="70" alt="No Image" class="coffee-product-img">
                            @endif
                        </td>

                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td class="coffee-price">{{ number_format($product->price, 2) }} EGP</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td class="coffee-price">{{ number_format($subtotal, 2) }} EGP</td>
                        <td>
                            <form action="{{ route('cart.remove', $product->id) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn coffee-btn-remove">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <tr class="coffee-total-tr">
                    <td colspan="5" class="text-end fw-bold">Total</td>
                    <td colspan="2" class="fw-bold coffee-total-price">{{ number_format($total, 2) }} EGP</td>
                </tr>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <form method="POST" action="{{ route('cart.order') }}">
                @csrf
                <button class="btn coffee-btn-order">Place Order</button>
            </form>
        </div>
    @else
        <div class="alert coffee-alert-info">
            Your cart is empty.
        </div>
    @endif
</div>

@endsection