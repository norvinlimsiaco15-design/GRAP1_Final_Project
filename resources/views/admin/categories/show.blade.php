@extends('layouts.app')
@section('content')
<h2>{{ $category->name }}</h2>
<a href="{{ route('admin.categories.index') }}" class="btn btn-outline-light">Back</a>
@endsection
