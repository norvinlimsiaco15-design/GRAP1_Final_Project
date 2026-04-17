@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h2 class="section-title mb-1">Design Showcase</h2>
            <p class="text-secondary mb-0">Explore custom clothing concepts from NV CREATIVE.</p>
        </div>
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.designs.index') }}" class="btn btn-outline-light">Manage Designs</a>
            @endif
        @endauth
    </div>

    <div class="row g-4">
        @forelse($designs as $design)
            <div class="col-md-4">
                <div class="card bg-panel text-light h-100 product-card overflow-hidden">
                    <img class="card-img-top product-image" src="{{ $design->image ? asset('storage/'.$design->image) : 'https://picsum.photos/700/500?random=design'.$design->id }}" alt="{{ $design->title }}">
                    @if($loop->first)
                        <span class="position-absolute top-0 start-0 m-3 badge-chip">Featured Design</span>
                    @endif
                    <div class="card-body">
                        <h5>{{ $design->title }}</h5>
                        <p class="text-secondary mb-0">{{ \Illuminate\Support\Str::limit($design->description ?: 'No description yet.', 110) }}</p>
                    </div>
                    <div class="product-overlay">
                        <button type="button" class="btn btn-outline-light w-100" aria-label="Like {{ $design->title }}">❤️ Favorite</button>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-secondary">No showcase designs yet.</p>
        @endforelse
    </div>

    <div class="mt-4">{{ $designs->links() }}</div>
@endsection
