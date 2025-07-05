@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<style>
    .section-header {
        margin-bottom: 2rem;
    }

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
    }

    .order-summary p {
        font-size: 1.1rem;
        margin-bottom: 8px;
    }

    .order-card {
        background: #F5F5F5;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

    .product-img {
        border-radius: 8px;
        height: 70px;
        object-fit: cover;
    }

    .text-coffee {
        color: #6D4C41;
    }

    .btn-coffee {
        background-color: #6D4C41;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    .btn-coffee:hover {
        background-color: #5D4037;
    }

    .coffee-alert-success {
        background-color: #81C784;
        color: white;
        border-radius: 6px;
        padding: 10px;
    }

    .table th {
        background-color: #D7CCC8;
        color: #3E2723;
    }

    .badge {
        font-size: 0.9rem;
        padding: 6px 12px;
        border-radius: 12px;
    }

    .btn-outline-secondary {
        border-radius: 6px;
        padding: 8px 16px;
    }
</style>

<div class="container py-4">
    <div class="text-center mb-4 section-header">
        <h2 class="section-title">☕ Order #{{ $order->id }} Details</h2>
        <div class="divider mx-auto"></div>
    </div>

    <div class="mb-4 order-summary">
        <p><strong>👤 User:</strong> {{ $order->user->name }}</p>
        <p><strong>🏠 Room Number:</strong> {{ $order->user->room_number ?? '-' }}</p>
        <p><strong> Status:</strong>
            <span class="badge 
                @if($order->status == 'pending') bg-warning text-dark 
                @elseif($order->status == 'processing') bg-primary 
                @else bg-success 
                @endif">
                {{ ucfirst($order->status) }}
            </span>
        </p>
        <p><strong>🕒 Ordered At:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
    </div>

    <h4 class="mb-3 text-coffee">🛍️ Order Items</h4>

    <div class="table-responsive order-card mb-4">
        <table class="table table-bordered text-center align-middle">
            <thead>
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

    {{-- Update Status --}}
    <form action="{{ route('orders.status', $order->id) }}" method="POST" class="mb-4 mt-4">
        @csrf
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="status" class="form-label fw-bold">🚦 Update Status:</label>
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
