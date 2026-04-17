@extends('layouts.app')
@section('content')
<div class="mb-3">
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-light">← Back</a>
</div>
<div class="bg-panel p-4 rounded">
    <div class="row">
        <div class="col-md-5 mb-3">
            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://picsum.photos/600/600?random=admin-product'.$product->id }}" alt="{{ $product->name }}" class="rounded-3 w-100" style="object-fit: cover;">
        </div>
        <div class="col-md-7">
            <h2 class="mb-2">{{ $product->name }}</h2>
            <p class="text-secondary mb-3">{{ $product->category?->name }}</p>
            <h4 class="mb-3">${{ number_format((float)$product->price, 2) }}</h4>
            <div class="mb-3">
                <p><strong>Stock:</strong> {{ $product->stock }}</p>
                <p><strong>Sizes:</strong> {{ $product->sizes ?? 'N/A' }}</p>
                <p><strong>Discount:</strong> {{ $product->discount_percent }}%</p>
                <p><strong>New Arrival:</strong> {{ $product->is_new_arrival ? 'Yes' : 'No' }}</p>
            </div>
            <p class="text-secondary">{{ $product->description }}</p>
            <div class="mt-4">
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Edit Product</a>
                <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="d-inline">@csrf @method('DELETE')
                    <button class="btn btn-danger">Delete Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
