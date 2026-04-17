@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Audit Logs</h2>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Back to Dashboard</a>
</div>

<form class="row g-2 mb-3" role="search" aria-label="Search audit logs">
    <div class="col-md-6">
        <label for="auditSearch" class="form-label">Search logs</label>
        <input id="auditSearch" type="text" name="q" value="{{ $searchTerm }}" class="form-control" placeholder="Search action, target, description...">
    </div>
    <div class="col-md-2 align-self-end">
        <button class="btn btn-success w-100" aria-label="Filter audit logs">Filter Logs</button>
    </div>
</form>

<div class="table-responsive bg-panel rounded p-2">
    <table class="table table-striped align-middle mb-0">
        <thead>
            <tr>
                <th>Admin</th>
                <th>Action</th>
                <th>Target</th>
                <th>Description</th>
                <th>Date & Time</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{ $log->user?->name ?? 'N/A' }}</td>
                    <td><span class="badge text-bg-secondary">{{ $log->action }}</span></td>
                    <td>{{ $log->target_type }} #{{ $log->target_id }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->created_at?->format('M d, Y h:i A') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No audit logs yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">{{ $logs->links() }}</div>
@endsection
