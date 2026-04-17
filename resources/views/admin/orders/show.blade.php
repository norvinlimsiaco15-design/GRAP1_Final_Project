@extends('layouts.app')
@section('content')
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
<h2>Order #{{ $order->id }}</h2>
<p class="text-secondary">{{ $order->user?->name }} - {{ $order->user?->email }}</p>
<p><strong>Current Status:</strong> {{ $statusMap[$order->status] ?? ucfirst($order->status) }}</p>
<p><strong>Payment Method:</strong> {{ $paymentMap[$order->payment_method] ?? strtoupper($order->payment_method ?? 'COD') }}</p>
<p><strong>Payment Status:</strong> {{ $paymentStatusMap[$order->payment_status] ?? ucfirst($order->payment_status ?? 'unpaid') }}</p>
@if($order->approved_at)<p class="mb-1"><strong>Approved At:</strong> {{ $order->approved_at->format('M d, Y h:i A') }}</p>@endif
@if($order->shipped_at)<p class="mb-1"><strong>Shipped At:</strong> {{ $order->shipped_at->format('M d, Y h:i A') }}</p>@endif
@if($order->completed_at)<p class="mb-1"><strong>Completed At:</strong> {{ $order->completed_at->format('M d, Y h:i A') }}</p>@endif

<form method="POST" action="{{ route('admin.orders.status', $order) }}" class="mb-4 d-flex gap-2 flex-wrap">
    @csrf @method('PATCH')
    <select name="status" class="form-select" style="max-width:220px;">
        <option value="pending" @selected($order->status === 'pending')>⏳ Pending</option>
        <option value="approved" @selected($order->status === 'approved')>✔ Approve Order</option>
        <option value="shipped" @selected($order->status === 'shipped')>📦 Mark as Shipped</option>
        <option value="completed" @selected($order->status === 'completed')>✔ Mark as Completed</option>
        <option value="cancelled" @selected($order->status === 'cancelled')>✖ Cancel Order</option>
    </select>
    <select name="payment_status" class="form-select" style="max-width:220px;">
        <option value="unpaid" @selected($order->payment_status === 'unpaid')>Unpaid</option>
        <option value="paid" @selected($order->payment_status === 'paid')>Paid</option>
        <option value="failed" @selected($order->payment_status === 'failed')>Failed</option>
    </select>
    <button class="btn btn-success">Update Order</button>
</form>

<div class="bg-panel rounded p-3">
@foreach($order->items as $item)
    <div class="d-flex justify-content-between border-bottom py-2">
        <span>{{ $item->product?->name }} x {{ $item->quantity }}</span>
        <span>${{ number_format((float) ($item->price * $item->quantity), 2) }}</span>
    </div>
@endforeach
</div>
@endsection
