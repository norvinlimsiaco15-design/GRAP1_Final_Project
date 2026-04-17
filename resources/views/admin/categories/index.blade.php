@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Manage Categories</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Add Category</a>
</div>
<div class="bg-panel rounded p-3">
@foreach($categories as $category)
    <div class="d-flex justify-content-between border-bottom py-2">
        <span>{{ $category->name }}</span>
        <span>
            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-light">Edit</a>
            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="d-inline">@csrf @method('DELETE')
                <button class="btn btn-sm btn-danger">Delete</button>
            </form>
        </span>
    </div>
@endforeach
</div>
{{ $categories->links() }}
@endsection
