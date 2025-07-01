@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Order #{{ $order->id }} Details</h2>

    <p><strong>Status:</strong> 
        <span class="badge 
            @if($order->status == 'pending') bg-warning 
            @elseif($order->status == 'processing') bg-primary 
            @else bg-success 
            @endif">
            {{ ucfirst($order->status) }}
        </span>
    </p>

    <table class="table table-bordered text-center align-middle mt-3">
        <thead class="table-light">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($order->items as $item)
                @php 
                    $lineTotal = $item->price * $item->quantity;
                    $total += $lineTotal;
                @endphp
                <tr>
                    <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($lineTotal, 2) }}</td>
                </tr>
                @if($item->product && $item->product->image)
    <img src="{{ asset('storage/' . $item->product->image) }}" alt="">
@else
    <span class="text-muted">No image</span>
@endif

            @endforeach
            <tr class="fw-bold">
                <td colspan="3">Total</td>
                <td>{{ number_format($total, 2) }} EGP</td>
            </tr>
        </tbody>
    </table>

    @if($order->status === 'pending')
    <form action="{{ route('myorders.cancel', $order->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Cancel Order</button>
</form>

<!-- @if ($order->status === 'pending')
    <div class="mt-3">
        <a href="{{ route('shop') }}" class="btn btn-primary">
            ➕ Add More Products
        </a>
    </div>
@endif -->


@endif


    <a href="{{ route('myorders.index') }}" class="btn btn-secondary mt-3">← Back to Orders</a>
</div>
@endsection
