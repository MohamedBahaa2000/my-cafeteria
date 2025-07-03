@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-4">

    <div class="text-center mb-4 section-header">
        <h2 class="section-title">☕ Order #{{ $order->id }} Details</h2>
        <div class="divider mx-auto"></div>
    </div>

    <div class="mb-4">
        <p><strong>User:</strong> {{ $order->user->name }}</p>
        <p><strong>Room Number:</strong> {{ $order->user->room_number ?? '-' }}</p>
        <p><strong>Status:</strong> 
            <span class="badge 
                @if($order->status == 'pending') bg-warning 
                @elseif($order->status == 'processing') bg-primary 
                @else bg-success 
                @endif">
                {{ ucfirst($order->status) }}
            </span>
        </p>
        <p><strong>Ordered At:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
    </div>

    <h4 class="mb-3 text-coffee">🛍️ Order Items</h4>

    <div class="table-responsive order-card">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'Product Deleted' }}</td>
                        <td>
                            @if($item->product && $item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" width="70" alt="Product Image" class="product-img">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $item->product->category->name ?? '-' }}</td>
                        <td>{{ number_format($item->price, 2) }} EGP</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price * $item->quantity, 2) }} EGP</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <form action="{{ route('orders.status', $order->id) }}" method="POST" class="mb-4 mt-4">
        @csrf
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="status" class="form-label fw-bold">Update Status:</label>
            </div>
            <div class="col-md-3">
                <select name="status" id="status" class="form-select">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-coffee">Update</button>
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert coffee-alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="mt-3">
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">← Back to Orders</a>
    </div>
</div>
@endsection
