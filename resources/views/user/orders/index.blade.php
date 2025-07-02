@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-4">
    <h2 class="text-center mb-4">📦 My Orders</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($orders->count())
        <div class="row">
            @foreach($orders as $order)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border">
                        <div class="card-body">
                            <h5 class="card-title">Order #{{ $order->id }}</h5>

                            <p class="mb-1">
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
                            </p>

                            <p class="mb-1">
                                <strong>Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}
                            </p>

                            <p class="mb-1">
                                <strong>Items:</strong> {{ $order->items->count() }}
                            </p>

                            <p class="mb-3">
                                <strong>Total:</strong>
                                {{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 2) }} EGP
                            </p>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('myorders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                    👁️ View Details
                                </a>

                                @if($order->status === 'pending')
                                    <form action="{{ route('myorders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">❌ Cancel</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            You haven't placed any orders yet.
        </div>
    @endif
</div>
@endsection
