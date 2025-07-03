@extends('layouts.app')

@section('title', 'All Orders')

@section('content')
<div class="container py-4">

    <div class="text-center mb-4 section-header">
        <h2 class="section-title"> All Orders</h2>
        <div class="divider mx-auto"></div>
    </div>

    @if(session('success'))
        <div class="alert coffee-alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('orders.create') }}" class="btn btn-coffee">
             Create Order
        </a>
    </div>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('orders.index') }}" class="row g-3 mb-4 filter-card">
        <div class="col-md-4">
            <label for="start_date" class="form-label fw-semibold">From Date</label>
            <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label fw-semibold">To Date</label>
            <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-control">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-dark w-100">🔍 Filter</button>
        </div>
    </form>

    <div class="table-responsive order-card">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Ordered At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>
                            @if($order->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($order->status === 'processing')
                                <span class="badge bg-info text-dark">Processing</span>
                            @elseif($order->status === 'delivered')
                                <span class="badge bg-success">Delivered</span>
                            @else
                                <span class="badge bg-secondary">Unknown</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-info me-1">Details</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
