@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="section-header mb-5 text-center">
                <h2 class="section-title position-relative"><i class="fas fa-clipboard-list me-2"></i> My Orders</h2>
                <div class="divider mx-auto"></div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center mb-4">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($orders->count())
                <div class="orders-list">
                    @foreach($orders as $order)
                        <div class="order-card mb-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-coffee text-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Order #{{ $order->id }}</h5>
                                        <span class="order-date">{{ $order->created_at->format('M d, Y \a\t H:i') }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="order-meta mb-3">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p class="mb-2"><strong>Status:</strong></p>
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
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Items:</strong> {{ $order->items->count() }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="mb-1"><strong>Total:</strong> {{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 2) }} EGP</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('myorders.show', $order->id) }}" class="btn btn-coffee btn-sm">
                                            <i class="fas fa-eye me-1"></i> View Details
                                        </a>
                                        @if($order->status === 'pending')
                                            <form action="{{ route('myorders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-times me-1"></i> Cancel
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="empty-state text-center py-5">
                    <div class="empty-state-icon">
                        <i class="fas fa-clipboard fa-3x text-muted"></i>
                    </div>
                    <h3 class="mt-3">No Orders Yet</h3>
                    <p class="text-muted">You haven't placed any orders yet.</p>
                    <a href="{{ route('shop') }}" class="btn btn-coffee mt-3">
                        <i class="fas fa-store me-1"></i> Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection