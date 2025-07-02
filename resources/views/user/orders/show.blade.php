@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">🧾 Order #{{ $order->id }} Details</h2>

    <div class="mb-4">
        <strong>Status:</strong>
        @if($order->status === 'pending')
            <span class="badge bg-warning text-dark">Pending</span>
        @elseif($order->status === 'processing')
            <span class="badge bg-info text-dark">Processing</span>
        @elseif($order->status === 'delivered')
            <span class="badge bg-success">Delivered</span>
        @else
            <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
        @endif
    </div>

    <h5 class="mb-3">🛍️ Products in this Order</h5>

    <div class="row">
        @foreach($order->items as $item)
            @php
                $product = $item->product;
            @endphp
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if($product && $product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                            @else
                                <img src="{{ asset('assets/images/no-image.png') }}" alt="No Image" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name ?? 'Deleted Product' }}</h5>
                                <p class="card-text text-muted small">Category: {{ $product->category->name ?? '-' }}</p>
                                <p class="card-text">Price: {{ number_format($item->price, 2) }} EGP</p>
                                <p class="card-text">Quantity: {{ $item->quantity }}</p>
                                <p class="card-text fw-bold">Subtotal: {{ number_format($item->price * $item->quantity, 2) }} EGP</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <hr>
    <div class="text-end fw-bold fs-5">
        Total: {{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 2) }} EGP
    </div>
     @if($order->status === 'pending')
    <form action="{{ route('myorders.cancel', $order->id) }}" method="POST" class="mt-4 text-center" onsubmit="return confirm('Are you sure you want to cancel this order?');">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger px-4"> Cancel This Order</button>
    </form>
@endif

    
</div>
@endsection
