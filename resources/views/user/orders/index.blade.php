@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">My Orders</h2>

    <table class="table table-bordered text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
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
                    <a href="{{ route('myorders.show', $order->id) }}" class="btn btn-sm btn-info">Details</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="4">No orders found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
