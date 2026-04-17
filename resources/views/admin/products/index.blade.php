@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Manage Products</h2>
    <a class="btn btn-success" href="{{ route('admin.products.create') }}">Add Product</a>
</div>
<div class="row g-3">
@foreach($products as $product)
    <div class="col-md-4">
        <div class="bg-panel p-3 rounded h-100">
            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://picsum.photos/600/400?random=admin-product'.$product->id }}" alt="{{ $product->name }}" class="rounded-3 mb-3 w-100" style="height: 220px; object-fit: cover;">
            <h5>{{ $product->name }}</h5>
            <p class="text-secondary small">{{ $product->category?->name }}</p>
            <p class="mb-2"><strong>${{ number_format((float)$product->price, 2) }}</strong> | Stock: {{ $product->stock }}</p>
            <p class="text-secondary small">{{ Str::limit($product->description, 60) }}</p>
            <div class="mt-3">
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-light">Edit</a>
                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="d-inline">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endforeach
</div>
{{ $products->links() }}
@endsection
