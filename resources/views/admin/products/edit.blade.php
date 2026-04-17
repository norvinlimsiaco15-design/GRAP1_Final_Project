@extends('layouts.app')

@section('content')
<h2 class="mb-3">Edit Product</h2>
@if(($categories ?? collect())->isEmpty())
    <div class="alert alert-warning">
        No categories available. Create one first.
        <a href="{{ route('admin.categories.create') }}" class="alert-link">Create Category</a>
    </div>
@endif
<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="bg-panel p-4 rounded">
    @csrf @method('PUT')
    @include('admin.products.partials.form', ['product' => $product])
    <button class="btn btn-success">Update Product</button>
</form>
@endsection
