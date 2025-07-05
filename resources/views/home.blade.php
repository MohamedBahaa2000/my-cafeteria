@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="container text-center py-5">
    <div class="glass-card p-5">
        <h1 class="display-4 mb-4">☕ Welcome to TASTORIA Cafe</h1>
        <p class="lead mb-4">Order your favorite drinks, manage users, and enjoy a smooth experience!</p>
        <a href="{{ route('login') }}" class="btn btn-coffee me-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-outline-coffee">Register</a>
    </div>
</div>
@endsection
