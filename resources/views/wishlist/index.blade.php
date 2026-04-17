@extends('layouts.app')

@section('content')
<h2 class="mb-4">Your Wishlist</h2>

<div class="row g-4">
    @forelse($items as $item)
        <div class="col-md-3">
            <div class="card bg-panel text-light h-100 product-card">
                <img class="card-img-top product-image" src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://picsum.photos/500/500?random='.$item->product->id }}" alt="{{ $item->product->name }}">
                <div class="card-body">
                    <h5>{{ $item->product->name }}</h5>
                    <p class="mb-2">${{ number_format((float) $item->product->final_price, 2) }}</p>
                    <form method="POST" action="{{ route('wishlist.toggle', $item->product) }}">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">Remove</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-secondary">No wishlist items yet.</p>
    @endforelse
</div>

{{ $items->links() }}
@endsection
