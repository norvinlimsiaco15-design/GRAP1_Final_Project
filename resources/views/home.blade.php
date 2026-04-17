@extends('layouts.app')

@section('content')
    <section class="hero mb-5">
        <div class="hero-content">
            <p class="category-pill d-inline-block mb-3">Modern Streetwear Collection</p>
            <h1 class="hero-title">NV CREATIVE</h1>
            <p class="hero-subtitle">Wear Your Vision</p>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('shop.index') }}" class="btn btn-success px-4">Shop Now</a>
                <a href="{{ route('designs.index') }}" class="btn btn-outline-light px-4">Explore Designs</a>
            </div>
        </div>
    </section>

    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 section-title">Featured Products</h3>
            <a href="{{ route('shop.index') }}" class="text-decoration-none accent">View all</a>
        </div>
        <div class="row g-4 product-grid">
            @forelse($featuredProducts as $product)
                <div class="col-md-3">
                    <div class="card text-light h-100 product-card w-100">
                        <img class="card-img-top product-image" src="{{ $product->image ? asset('storage/'.$product->image) : 'https://picsum.photos/500/500?random='.$product->id }}" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <p class="text-secondary small mb-1">{{ $product->category?->name ?? 'Uncategorized' }}</p>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="price-text mb-0 mt-auto">${{ number_format((float) $product->final_price, 2) }}</p>
                        </div>
                        <div class="product-overlay">
                            <a href="{{ route('shop.show', $product) }}" class="btn btn-success w-100">View Product</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-secondary">No products yet. Seed your database to display items.</p>
            @endforelse
        </div>
    </section>

    <section>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="mb-0 section-title">Design Showcase</h3>
            <a href="{{ route('designs.index') }}" class="text-decoration-none accent">View gallery</a>
        </div>
        <div class="row g-4">
            @forelse($designs as $design)
                <div class="col-md-4">
                    <div class="card text-light h-100 product-card">
                        <img class="card-img-top product-image" src="{{ $design->image ? asset('storage/'.$design->image) : 'https://picsum.photos/700/500?random=design'.$design->id }}" alt="{{ $design->title }}">
                        <div class="card-body">
                            <h5>{{ $design->title }}</h5>
                            <p class="text-secondary mb-0">{{ $design->description }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-secondary">No designs yet.</p>
            @endforelse
        </div>
    </section>
@endsection
