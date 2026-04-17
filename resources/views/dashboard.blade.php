@extends('layouts.app')

@section('content')
<div class="hero p-5">
    <h2 class="mb-2">Welcome back, {{ auth()->user()->name }}</h2>
    <p class="text-secondary mb-0">Your NV CREATIVE account dashboard is active.</p>
</div>
@endsection
