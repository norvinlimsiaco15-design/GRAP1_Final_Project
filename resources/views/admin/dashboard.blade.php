@extends('layouts.app')

@section('content')
<div class="admin-shell">
    <aside class="bg-panel p-3 admin-sidebar">
        <h5 class="mb-3">Admin Panel</h5>
        <nav class="nav flex-column gap-1">
            <a class="nav-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="nav-link" href="{{ route('admin.products.index') }}">Products</a>
            <a class="nav-link" href="{{ route('admin.orders.index') }}">Orders</a>
            <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
            <a class="nav-link" href="{{ route('admin.categories.index') }}">Categories</a>
            <a class="nav-link" href="{{ route('admin.audit-logs.index') }}">Audit Logs</a>
        </nav>
    </aside>
    <section>
        <h2 class="section-title">Admin Dashboard</h2>
        <div class="row g-3">
            <div class="col-md-3"><div class="bg-panel p-3"><small class="text-secondary">Total Sales</small><h3 class="mb-0 accent">${{ number_format($totalSales, 2) }}</h3></div></div>
            <div class="col-md-3"><div class="bg-panel p-3"><small class="text-secondary">Orders</small><h3 class="mb-0">{{ $totalOrders }}</h3></div></div>
            <div class="col-md-3"><div class="bg-panel p-3"><small class="text-secondary">Users</small><h3 class="mb-0">{{ $totalUsers }}</h3></div></div>
            <div class="col-md-3"><div class="bg-panel p-3"><small class="text-secondary">Products</small><h3 class="mb-0">{{ $totalProducts }}</h3></div></div>
        </div>
        <div class="bg-panel p-3 p-md-4 mt-4">
            <h4 class="mb-3">Management Shortcuts</h4>
            <div class="d-flex flex-wrap gap-2">
                <a class="btn btn-success" href="{{ route('admin.products.index') }}">Manage Products</a>
                <a class="btn btn-outline-light" href="{{ route('admin.products.create') }}">Add Product</a>
                <a class="btn btn-outline-light" href="{{ route('admin.categories.index') }}">Manage Categories</a>
                <a class="btn btn-outline-light" href="{{ route('admin.orders.index') }}">Manage Orders</a>
                <a class="btn btn-outline-light" href="{{ route('admin.users.index') }}">Manage Users</a>
                <a class="btn btn-outline-light" href="{{ route('admin.designs.index') }}">Manage Designs</a>
                <a class="btn btn-outline-secondary" href="{{ route('admin.audit-logs.index') }}">View Audit Logs</a>
            </div>
        </div>
        <div class="bg-panel p-3 p-md-4 mt-4">
            <h4 class="mb-3">Recent Management Table</h4>
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Module</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Products</td>
                            <td><span class="badge-chip">Active</span></td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-light" href="{{ route('admin.products.index') }}">View</a>
                                <a class="btn btn-sm btn-outline-light" href="{{ route('admin.products.index') }}">Edit</a>
                                <a class="btn btn-sm btn-outline-light" href="{{ route('admin.products.index') }}">Delete</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Orders</td>
                            <td><span class="badge-chip">Active</span></td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-light" href="{{ route('admin.orders.index') }}">View</a>
                                <a class="btn btn-sm btn-outline-light" href="{{ route('admin.orders.index') }}">Edit</a>
                                <a class="btn btn-sm btn-outline-light" href="{{ route('admin.orders.index') }}">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
