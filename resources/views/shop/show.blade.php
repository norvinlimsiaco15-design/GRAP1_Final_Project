@extends('layouts.app')

@section('content')
    <a href="{{ route('shop.index') }}" class="text-decoration-none accent">&larr; Back to shop</a>
    <div class="row mt-3 g-4">
        <div class="col-md-6">
            <div class="bg-panel p-2 p-md-3">
                <img class="img-fluid rounded-3 w-100" style="max-height:620px; object-fit:cover;" src="{{ $product->image ? asset('storage/'.$product->image) : 'https://picsum.photos/1000/900?random='.$product->id }}" alt="{{ $product->name }}">
                <div class="d-flex gap-2 mt-2">
                    <img class="rounded-2 border border-secondary-subtle" style="width:86px;height:86px;object-fit:cover;" src="{{ $product->image ? asset('storage/'.$product->image) : 'https://picsum.photos/120/120?random=a'.$product->id }}" alt="{{ $product->name }} thumbnail one">
                    <img class="rounded-2 border border-secondary-subtle" style="width:86px;height:86px;object-fit:cover;" src="{{ $product->image ? asset('storage/'.$product->image) : 'https://picsum.photos/120/120?random=b'.$product->id }}" alt="{{ $product->name }} thumbnail two">
                    <img class="rounded-2 border border-secondary-subtle" style="width:86px;height:86px;object-fit:cover;" src="{{ $product->image ? asset('storage/'.$product->image) : 'https://picsum.photos/120/120?random=c'.$product->id }}" alt="{{ $product->name }} thumbnail three">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @if($product->is_new_arrival)
                <span class="badge-chip mb-2 d-inline-block">New Arrival</span>
            @endif
            <h2 class="section-title mb-1">{{ $product->name }}</h2>
            <p class="text-secondary">{{ $product->category?->name ?? 'Uncategorized' }}</p>
            <h4 class="accent mb-3">${{ number_format((float) $product->final_price, 2) }}</h4>
            @if($product->discount_percent > 0)
                <p class="text-warning">{{ $product->discount_percent }}% discount applied</p>
            @endif
            <p>{{ $product->description ?: 'No description available yet.' }}</p>
            <p class="text-secondary">Sizes: {{ $product->sizes ?: 'One size' }}</p>
            @auth
                <form method="POST" action="{{ route('cart.add', $product) }}" class="bg-panel p-3 mt-3">
                    @csrf
                    <div class="mb-3">
                        <p class="mb-2 fw-semibold">Select Size</p>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-outline-light btn-sm">S</button>
                            <button type="button" class="btn btn-outline-light btn-sm">M</button>
                            <button type="button" class="btn btn-outline-light btn-sm">L</button>
                            <button type="button" class="btn btn-outline-light btn-sm">XL</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="mb-2 fw-semibold">Color</p>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-outline-light btn-sm">Black</button>
                            <button type="button" class="btn btn-outline-light btn-sm">White</button>
                            <button type="button" class="btn btn-outline-light btn-sm">Gold</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label fw-semibold">Quantity</label>
                        <input id="quantity" type="number" name="quantity" min="1" value="1" class="form-control qty-input">
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-success px-4" aria-label="Add {{ $product->name }} to cart">Add to Cart</button>
                        <a href="{{ route('checkout.index') }}" class="btn btn-outline-light px-4" aria-label="Buy {{ $product->name }} now">Buy Now</a>
                    </div>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-success" aria-label="Login to add product to cart">Login to Add to Cart</a>
            @endauth
            @auth
                <form method="POST" action="{{ route('wishlist.toggle', $product) }}" class="mt-2">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Toggle Wishlist</button>
                </form>
            @endauth
        </div>
    </div>

    <section class="mt-5">
        <ul class="nav nav-tabs border-secondary mb-3" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active text-light bg-transparent" id="description-tab" data-bs-toggle="tab" data-bs-target="#description-pane" type="button" role="tab" aria-controls="description-pane" aria-selected="true">Description</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-light bg-transparent" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-pane" type="button" role="tab" aria-controls="reviews-pane" aria-selected="false">Reviews</button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="description-pane" role="tabpanel" aria-labelledby="description-tab" tabindex="0">
                <div class="bg-panel p-3 p-md-4">
                    <h5 class="mb-2">Product Details</h5>
                    <p class="mb-0">{{ $product->description ?: 'No description available yet.' }}</p>
                </div>
            </div>
            <div class="tab-pane fade" id="reviews-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
                <h4 class="mt-1">Reviews</h4>
        @auth
            <form method="POST" action="{{ route('reviews.store', $product) }}" class="bg-panel p-3 rounded mb-3">
                @csrf
                <div class="mb-2">
                    <label class="form-label">Rating (1-5)</label>
                    <input type="number" name="rating" min="1" max="5" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label class="form-label">Comment</label>
                    <textarea name="comment" class="form-control" rows="3"></textarea>
                </div>
                <button class="btn btn-success btn-sm">Submit Review</button>
            </form>
        @endauth

        @forelse($product->reviews as $review)
            <div class="bg-panel rounded p-3 mb-2">
                <strong>{{ $review->user->name }}</strong> - <span class="text-warning">{{ $review->rating }}/5</span>
                <p class="mb-0 text-secondary">{{ $review->comment }}</p>
            </div>
        @empty
            <p class="text-secondary">No reviews yet.</p>
        @endforelse
            </div>
        </div>
    </section>
@endsection
