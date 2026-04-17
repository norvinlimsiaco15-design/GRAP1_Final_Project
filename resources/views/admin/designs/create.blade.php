@extends('layouts.app')
@section('content')
<h2>Add Design</h2>
<form method="POST" action="{{ route('admin.designs.store') }}" enctype="multipart/form-data" class="bg-panel p-4 rounded">
    @csrf
    @include('admin.designs.partials.form', ['design' => null])
    <button class="btn btn-success">Save</button>
</form>
@endsection
