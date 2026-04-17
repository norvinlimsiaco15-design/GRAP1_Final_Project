@extends('layouts.app')

@section('content')
    <h2 class="section-title">Shop Streetwear</h2>

    <form class="row g-3 mb-4 bg-panel p-3 p-md-4">
        <div class="col-md-5">
            <input type="text" name="q" value="{{ $searchTerm }}" class="form-control" placeholder="Search products...">
        </div>
        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">All categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected($selectedCategory === $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-success w-100">Filter</button>
        </div>
    </form>

    <div class="row g-4 product-grid">
        @forelse($products as $product)
            <div class="col-md-3">
                <div class="card h-100 product-card w-100">
                    <a href="{{ route('shop.show', $product) }}" class="text-decoration-none text-light">
                        <img class="card-img-top product-image" src="{{ $product->image ? asset('storage/'.$product->image) : 'https://picsum.photos/500/500?random='.$product->id }}" alt="{{ $product->name }}">
                    </a>
                    <div class="card-body d-flex flex-column">
                        @if($product->is_new_arrival)
                            <span class="badge-chip mb-2 d-inline-block">New Arrival</span>
                        @endif
                        <h5>{{ $product->name }}</h5>
                        <p class="text-secondary small">{{ $product->category?->name ?? 'Uncategorized' }}</p>
                        <p class="price-text mb-0">${{ number_format((float) $product->final_price, 2) }}</p>
                        @if($product->discount_percent > 0)
                            <small class="text-warning">{{ $product->discount_percent }}% OFF</small>
                        @endif
                    </div>
                    <div class="product-overlay">
                        @auth
                            <form method="POST" action="{{ route('cart.add', $product) }}">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button class="btn btn-success w-100" aria-label="Add {{ $product->name }} to cart">Add to Cart</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-success w-100">Add to Cart</a>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <p class="text-secondary">No products found.</p>
        @endforelse
    </div>

    <div class="mt-4">{{ $products->links() }}</div>
@endsection
