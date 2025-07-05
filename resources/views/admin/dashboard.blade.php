@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, rgba(111, 78, 55, 0.8), rgba(200, 169, 126, 0.8)),
                    url('{{ asset("assets/images/coffee-bg.jpg") }}') center/cover no-repeat;
        color: #fff;
        padding: 60px 20px;
        border-radius: 20px;
        text-align: center;
        margin-bottom: 50px;
        position: relative;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .dashboard-header h2 {
        font-size: 2.8rem;
        font-weight: bold;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
    }

    .dashboard-header p {
        font-size: 1.2rem;
        margin-top: 10px;
        color: #f0e6dd;
    }

    .stat-card {
        border-radius: 18px;
        transition: all 0.3s ease;
        color: #fff;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .stat-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 12px 25px rgba(0,0,0,0.2);
    }

    .stat-icon {
        font-size: 2.2rem;
        margin-bottom: 10px;
        opacity: 0.9;
    }

    .stat-title {
        font-size: 1rem;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: bold;
        margin-top: 5px;
    }

    .text-decoration-none:hover {
        text-decoration: none !important;
    }
</style>

<div class="container py-4">
    <div class="dashboard-header">
        <h2>📊 Admin Dashboard</h2>
        <p>Track sales, orders, and activities all in one place</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4 col-lg-3">
            <a href="{{ route('orders.index') }}" class="text-decoration-none">
                <div class="card stat-card bg-primary text-center">
                    <div class="card-body">
                        <div class="stat-icon">🧾</div>
                        <div class="stat-title">Total Orders</div>
                        <div class="stat-value">{{ $totalOrders }}</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-lg-3">
            <a href="{{ route('orders.index', ['status' => 'pending']) }}" class="text-decoration-none">
                <div class="card stat-card bg-warning text-dark text-center">
                    <div class="card-body">
                        <div class="stat-icon">⏳</div>
                        <div class="stat-title">Pending</div>
                        <div class="stat-value">{{ $pendingOrders }}</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-lg-3">
            <a href="{{ route('orders.index', ['status' => 'processing']) }}" class="text-decoration-none">
                <div class="card stat-card bg-secondary text-center">
                    <div class="card-body">
                        <div class="stat-icon">🔄</div>
                        <div class="stat-title">Processing</div>
                        <div class="stat-value">{{ $processingOrders }}</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-lg-3">
            <a href="{{ route('orders.index', ['status' => 'delivered']) }}" class="text-decoration-none">
                <div class="card stat-card bg-success text-center">
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
                <div class="card stat-card bg-dark text-center">
                    <div class="card-body">
                        <div class="stat-icon">💰</div>
                        <div class="stat-title">Total Sales</div>
                        <div class="stat-value">{{ number_format($sales, 2) }} EGP</div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
