@extends('layouts.app')
@section('content')
<h2 class="mb-3">Manage Orders</h2>
@php
    $statusMap = [
        'completed' => '✔ Completed',
        'pending' => '⏳ Pending',
        'approved' => '✔ Approved',
        'shipped' => '📦 Shipped',
        'cancelled' => '✖ Cancelled',
    ];
    $paymentStatusMap = [
        'unpaid' => 'Unpaid',
        'paid' => 'Paid',
        'failed' => 'Failed',
    ];
@endphp
<div class="table-responsive bg-panel rounded p-2">
<table class="table table-striped mb-0">
    <thead><tr><th>ID</th><th>Customer</th><th>Total</th><th>Payment</th><th>Payment Status</th><th>Status</th><th></th></tr></thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>#{{ $order->id }}</td>
            <td>{{ $order->user?->name }}</td>
            <td>${{ number_format((float)$order->total_price, 2) }}</td>
            <td>{{ $order->payment_method === 'bank_transfer' ? 'Bank Transfer' : strtoupper($order->payment_method ?? 'COD') }}</td>
            <td>{{ $paymentStatusMap[$order->payment_status] ?? ucfirst($order->payment_status ?? 'unpaid') }}</td>
            <td>{{ $statusMap[$order->status] ?? ucfirst($order->status) }}</td>
            <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-light">View</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
{{ $orders->links() }}
@endsection
