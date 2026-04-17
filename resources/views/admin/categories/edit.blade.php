@extends('layouts.app')
@section('content')
<h2>Edit Category</h2>
<form method="POST" action="{{ route('admin.categories.update', $category) }}" class="bg-panel p-4 rounded">
    @csrf @method('PUT')
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control mb-3" required>
    <button class="btn btn-success">Update</button>
</form>
@endsection
