@extends('layouts.app')

@section('content')
<h2 class="mb-4">Profile Settings</h2>
<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="bg-panel p-4 rounded mb-4">
    @csrf
    @method('PATCH')
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Avatar</label>
        <input type="file" name="avatar" class="form-control">
    </div>
    @if($user->avatar)
        <img src="{{ asset('storage/'.$user->avatar) }}" alt="avatar" width="90" class="rounded mb-3">
    @endif
    <button class="btn btn-success">Update Profile</button>
</form>

<form method="POST" action="{{ route('profile.destroy') }}" class="bg-panel p-4 rounded">
    @csrf
    @method('DELETE')
    <label class="form-label">Confirm Password to Delete Account</label>
    <input type="password" name="password" class="form-control mb-3" required>
    <button class="btn btn-danger">Delete Account</button>
</form>
@endsection
