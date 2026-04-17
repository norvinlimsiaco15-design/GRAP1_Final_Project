@extends('layouts.app')
@section('content')
<h2>Edit Design</h2>
<form method="POST" action="{{ route('admin.designs.update', $design) }}" enctype="multipart/form-data" class="bg-panel p-4 rounded">
    @csrf @method('PUT')
    @include('admin.designs.partials.form', ['design' => $design])
    <button class="btn btn-success">Update</button>
</form>
@endsection
