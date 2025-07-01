@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Order #{{ $order->id }} Details</h2>

    <div class="mb-4">
        <p><strong>User:</strong> {{ $order->user->name }}</p>
        <p><strong>Status:</strong> <span class="badge 
            @if($order->status == 'pending') bg-warning 
            @elseif($order->status == 'processing') bg-primary 
            @else bg-success 
            @endif">{{ ucfirst($order->status) }}</span>
        </p>
        <p><strong>Ordered at:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
    </div>

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
            @php $grandTotal = 0; @endphp
            @foreach($order->items as $item)
                @php
                    $total = $item->price * $item->quantity;
                    $grandTotal += $total;
                @endphp
                <tr>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($total, 2) }}</td>
                </tr>
            @endforeach
            <tr class="fw-bold">
                <td colspan="3">Grand Total</td>
                <td>{{ number_format($grandTotal, 2) }} EGP</td>
            </tr>
        </tbody>
    </table>

    <form action="{{ route('orders.status', $order->id) }}" method="POST" class="mb-4">
    @csrf
    <div class="row g-3 align-items-center">
        <div class="col-auto">
            <label for="status" class="col-form-label fw-bold">Update Status:</label>
        </div>
        <div class="col-auto">
            <select name="status" id="status" class="form-select">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
@if(session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
@endif


    <a href="{{ route('orders.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
</div>
@endsection
