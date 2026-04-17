@extends('layouts.app')

@section('content')
<h2 class="mb-3">Add Product</h2>
@if(($categories ?? collect())->isEmpty())
    <div class="alert alert-warning">
        Add at least one category first before creating a product.
        <a href="{{ route('admin.categories.create') }}" class="alert-link">Create Category</a>
    </div>
@endif
<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="bg-panel p-4 rounded">
    @csrf
    @include('admin.products.partials.form', ['product' => null])
    <button class="btn btn-success">Save Product</button>
</form>
@endsection
