@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="section-header mb-5 text-center">
                <h2 class="section-title position-relative"><i class="fas fa-file-invoice me-2"></i> Order #{{ $order->id }} Details</h2>
                <div class="divider mx-auto"></div>
            </div>

            <div class="order-summary mb-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-coffee text-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y \a\t H:i') }}</p>
                                <p><strong>Status:</strong>
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
                            </div>
                            <div class="col-md-6 text-md-end">
                                <p><strong>Total Items:</strong> {{ $order->items->count() }}</p>
                                <p><strong>Order Total:</strong> {{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 2) }} EGP</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="mb-4"><i class="fas fa-box-open me-2"></i> Order Items</h4>

            <div class="order-items">
                @foreach($order->items as $item)
                    @php
                        $product = $item->product;
                    @endphp
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="row g-0">
                            <div class="col-md-3">
                                @if($product && $product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/images/no-image.png') }}" alt="No Image" class="img-fluid rounded-start" style="height: 100%; object-fit: cover;">
                                @endif
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="card-title">{{ $product->name ?? 'Deleted Product' }}</h5>
                                            <p class="card-text text-muted small">
                                                <i class="fas fa-tag me-1"></i> {{ $product->category->name ?? '-' }}
                                            </p>
                                        </div>
                                        <div class="col-md-6 text-md-end">
                                            <p class="card-text">
                                                <span class="text-muted">Price:</span> {{ number_format($item->price, 2) }} EGP
                                            </p>
                                            <p class="card-text">
                                                <span class="text-muted">Quantity:</span> {{ $item->quantity }}
                                            </p>
                                            <p class="card-text fw-bold">
                                                <span class="text-muted">Subtotal:</span> {{ number_format($item->price * $item->quantity, 2) }} EGP
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="order-total text-end mt-4">
                <h4 class="fw-bold">
                    <span class="text-muted me-2">Total:</span>
                    {{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 2) }} EGP
                </h4>
            </div>

            @if($order->status === 'pending')
                <div class="text-center mt-5">
                    <form action="{{ route('myorders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger px-4">
                            <i class="fas fa-times-circle me-1"></i> Cancel This Order
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection