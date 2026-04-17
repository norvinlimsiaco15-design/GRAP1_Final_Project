@extends('layouts.app')
@section('content')
<h2 class="mb-3">Manage Users</h2>
<div class="table-responsive bg-panel rounded p-2">
<table class="table table-striped mb-0">
    <thead><tr><th>Name</th><th>Email</th><th>Role</th><th></th></tr></thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <form method="POST" action="{{ route('admin.users.role', $user) }}" class="d-flex gap-2">
                    @csrf @method('PATCH')
                    <select name="role" class="form-select form-select-sm">
                        <option value="user" @selected($user->role === 'user')>user</option>
                        <option value="admin" @selected($user->role === 'admin')>admin</option>
                    </select>
                    <button class="btn btn-sm btn-outline-light">Save</button>
                </form>
            </td>
            <td class="text-end">
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
{{ $users->links() }}
@endsection
