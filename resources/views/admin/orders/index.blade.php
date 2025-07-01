@extends('layouts.app')

@section('title', 'All Orders')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">All Orders</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

<a href="{{ route('orders.create') }}" class="btn btn-success mb-4">
    ➕ Create Order
</a>


<form method="GET" action="{{ route('orders.index') }}" class="row g-3 mb-4">
    <div class="col-md-4">
        <label for="start_date" class="form-label">From Date</label>
        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="form-control">
    </div>
    <div class="col-md-4">
        <label for="end_date" class="form-label">To Date</label>
        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="form-control">
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">🔍 Filter</button>
    </div>
</form>


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
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        <span class="badge 
                            @if($order->status == 'pending') bg-warning 
                            @elseif($order->status == 'processing') bg-primary 
                            @else bg-success 
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">Details</a>
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
@endsection
