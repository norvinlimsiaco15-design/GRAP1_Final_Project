@extends('layouts.app')
@section('content')
<h2>Add Category</h2>
<form method="POST" action="{{ route('admin.categories.store') }}" class="bg-panel p-4 rounded">
    @csrf
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control mb-3" required>
    <button class="btn btn-success">Save</button>
</form>
@endsection
