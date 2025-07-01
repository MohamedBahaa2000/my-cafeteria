@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center">Add New Product</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" step="0.01" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" accept="image/*" class="form-control">
    </div>

    <div class="mb-3">
        <label>Available</label>
        <select name="is_available" class="form-control">
            <option value="1" selected>Available</option>
            <option value="0">Not Available</option>
        </select>
    </div>

    <button class="btn btn-success">Save</button>
</form>

</div>
@endsection
