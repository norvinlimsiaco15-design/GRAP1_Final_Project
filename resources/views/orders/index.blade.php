@extends('layouts.app')

@section('content')
<h2 class="mb-4">Order History</h2>
@php
    $statusMap = [
        'completed' => '✔ Completed',
        'pending' => '⏳ Pending',
        'approved' => '✔ Approved',
        'shipped' => '📦 Shipped',
        'cancelled' => '✖ Cancelled',
    ];
    $paymentMap = [
        'cod' => 'Cash on Delivery',
        'gcash' => 'GCash',
        'bank_transfer' => 'Bank Transfer',
    ];
    $paymentStatusMap = [
        'unpaid' => 'Unpaid',
        'paid' => 'Paid',
        'failed' => 'Failed',
    ];
@endphp

@forelse($orders as $order)
    <div class="bg-panel rounded p-3 mb-3">
        <div class="d-flex justify-content-between">
            <h5 class="mb-1">Order #{{ $order->id }}</h5>
            <span class="badge bg-secondary">{{ $statusMap[$order->status] ?? ucfirst($order->status) }}</span>
        </div>
        <p class="mb-2 text-secondary">{{ $order->created_at->format('M d, Y h:i A') }}</p>
        <p class="mb-2">Total: <strong>${{ number_format((float) $order->total_price, 2) }}</strong></p>
        <p class="mb-2">Payment: <strong>{{ $paymentMap[$order->payment_method] ?? strtoupper($order->payment_method ?? 'COD') }}</strong></p>
        <p class="mb-2">Payment Status: <strong>{{ $paymentStatusMap[$order->payment_status] ?? ucfirst($order->payment_status ?? 'unpaid') }}</strong></p>
        <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-light btn-sm">View Details</a>
    </div>
@empty
    <p class="text-secondary">No orders found.</p>
@endforelse

{{ $orders->links() }}
@endsection
