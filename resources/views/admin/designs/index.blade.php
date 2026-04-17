@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2 class="section-title mb-0">Manage Designs</h2>
    <a href="{{ route('admin.designs.create') }}" class="btn btn-success">Add Design</a>
</div>
<div class="row g-3">
@foreach($designs as $design)
    <div class="col-md-4">
        <div class="bg-panel p-3 rounded h-100">
            <img src="{{ $design->image ? asset('storage/'.$design->image) : 'https://picsum.photos/600/400?random=admin-design'.$design->id }}" alt="{{ $design->title }}" class="rounded-3 mb-3 w-100" style="height: 220px; object-fit: cover;">
            <h5>{{ $design->title }}</h5>
            <p class="text-secondary">{{ $design->description }}</p>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.designs.edit', $design) }}" class="btn btn-sm btn-outline-light">Edit</a>
                    <form method="POST" action="{{ route('admin.designs.destroy', $design) }}" class="d-inline">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                @endif
            @endauth
        </div>
    </div>
@endforeach
</div>
{{ $designs->links() }}
@endsection
