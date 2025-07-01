@extends('layouts.app')

@section('title', 'My Cart')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">My Cart</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    @if(count($cart) > 0)
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Price (EGP)</th>
                    <th>Quantity</th>
                    <th>Total (EGP)</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    @php
                        $lineTotal = $item['price'] * $item['quantity'];
                        $total += $lineTotal;
                    @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ number_format($item['price'], 2) }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($lineTotal, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="fw-bold">
                    <td colspan="3">Total</td>
                    <td>{{ number_format($total, 2) }} EGP</td>
                </tr>
            </tbody>
        </table>

        <form action="{{ route('cart.order') }}" method="POST" class="text-end">
            @csrf
            <button type="submit" class="btn btn-success">Place Order</button>
            <a href="{{ route('shop') }}" class="btn btn-secondary">Continue Shopping</a>
        </form>
    @else
        <div class="alert alert-info text-center">
            Your cart is empty.
        </div>
        <div class="text-center">
            <a href="{{ route('shop') }}" class="btn btn-primary">Back to Shop</a>
        </div>
    @endif
</div>
@endsection
