@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, #c8a97e, #6f4e37);
        color: white;
        padding: 60px 20px;
        border-radius: 20px;
        text-align: center;
        margin-bottom: 40px;
        background-image: url('{{ asset("assets/images/back.jpg") }}');
        background-size: cover;
        background-blend-mode: overlay;
    }

    .dashboard-header h1 {
        font-size: 3rem;
        font-weight: bold;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.4);
    }

    .dashboard-card {
        transition: all 0.3s ease;
        border-radius: 16px;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card-icon {
        font-size: 3rem;
        color: #6f4e37;
    }

    .card-title {
        font-weight: bold;
        color: #3c2f2f;
    }

    .dashboard-container {
        min-height: 80vh;
    }
</style>

<div class="container dashboard-container">
    <div class="dashboard-header">
        <h1>☕ Welcome to TASTORIA Cafeteria</h1>
        <p class="mt-3 fs-5">Manage everything from one clean dashboard</p>
    </div>

    <div class="row text-center g-4">


    <div class="col-md-4">
    <div class="card shadow-sm p-4 dashboard-card">
        <div class="card-icon mb-3">🛍️</div>
        <h5 class="card-title mb-2">Go to Shop</h5>
        <p class="text-muted mb-3">Browse and order products</p>
        <a href="{{ route('shop') }}" class="btn btn-outline-dark">Shop Now</a>
    </div>
</div>

       
        <div class="col-md-4">
    <div class="card shadow-sm p-4 dashboard-card">
        <div class="card-icon mb-3">🛒</div>
        <h5 class="card-title mb-2">Shopping Cart</h5>
        <p class="text-muted mb-3">View your selected items</p>
        <a href="{{ route('cart.view') }}" class="btn btn-outline-dark">Go to Cart</a>
    </div>
</div>


       
        <div class="col-md-4">
    <div class="card shadow-sm p-4 dashboard-card">
        <div class="card-icon mb-3">📋</div>
        <h5 class="card-title mb-2">My Orders</h5>
        <p class="text-muted mb-3">View your previous orders</p>
        <a href="{{ route('myorders.index') }}" class="btn btn-outline-dark">Go to My Orders</a>
    </div>
</div>

    </div>
</div>
@endsection
