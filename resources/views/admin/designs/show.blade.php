@extends('layouts.app')
@section('content')
<h2>{{ $design->title }}</h2>
<p>{{ $design->description }}</p>
<a href="{{ route('admin.designs.index') }}" class="btn btn-outline-light">Back</a>
@endsection
