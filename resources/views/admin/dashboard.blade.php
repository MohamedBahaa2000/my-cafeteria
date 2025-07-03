@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, #c8a97e, #6f4e37);
        color: white;
        padding: 50px 20px;
        border-radius: 20px;
        text-align: center;
        margin-bottom: 40px;
        background-image: url('{{ asset("assets/images/coffee-bg.jpg") }}');
        background-size: cover;
        background-blend-mode: overlay;
    }

    .dashboard-header h2 {
        font-size: 2.5rem;
        font-weight: bold;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.4);
    }

    .stat-card {
        border-radius: 20px;
        transition: 0.3s ease-in-out;
        color: white;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .stat-icon {
        font-size: 1.8rem;
        opacity: 0.9;
    }

    .stat-title {
        font-size: 1rem;
        margin-bottom: 0.2rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: bold;
    }

    .text-decoration-none:hover {
        text-decoration: none !important;
    }
</style>

<div class="container py-4">
    <div class="dashboard-header">
        <h2>📊 Admin Dashboard Overview</h2>
        <p class="mt-2 fs-5">Track sales, orders, and statuses in one glance</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4 col-lg-3">
            <a href="{{ route('orders.index') }}" class="text-decoration-none">
                <div class="card stat-card bg-primary shadow-sm text-center">
                    <div class="card-body">
                        <div class="stat-icon">🧾</div>
                        <div class="stat-title">Total Orders</div>
                        <div class="stat-value">{{ $totalOrders }}</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-lg-3">
            <a href="{{ route('orders.index') }}?status=pending" class="text-decoration-none">
                <div class="card stat-card bg-warning text-dark shadow-sm text-center">
                    <div class="card-body">
                        <div class="stat-icon">⏳</div>
                        <div class="stat-title">Pending</div>
                        <div class="stat-value">{{ $pendingOrders }}</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-lg-3">
            <a href="{{ route('orders.index') }}?status=processing" class="text-decoration-none">
                <div class="card stat-card bg-secondary shadow-sm text-center">
                    <div class="card-body">
                        <div class="stat-icon">🔄</div>
                        <div class="stat-title">Processing</div>
                        <div class="stat-value">{{ $processingOrders }}</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-lg-3">
            <a href="{{ route('orders.index') }}?status=delivered" class="text-decoration-none">
                <div class="card stat-card bg-success shadow-sm text-center">
                    <div class="card-body">
                        <div class="stat-icon">✅</div>
                        <div class="stat-title">Delivered</div>
                        <div class="stat-value">{{ $deliveredOrders }}</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-4">
            <a href="{{ route('orders.index') }}" class="text-decoration-none">
                <div class="card stat-card bg-dark shadow-sm text-center">
                    <div class="card-body">
                        <div class="stat-icon">💰</div>
                        <div class="stat-title">Total Sales (EGP)</div>
                        <div class="stat-value">{{ number_format($sales, 2) }}</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
