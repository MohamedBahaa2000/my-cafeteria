@extends('layouts.app')

@section('content')
<div class="glass-card">
    <h2 class="mb-4">Add Category</h2>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-coffee"> Save</button>
    </form>
</div>
@endsection
