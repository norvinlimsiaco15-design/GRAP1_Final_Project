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
<a href="{{ route('orders.index') }}" class="text-decoration-none accent">&larr; Back to orders</a>
<h2 class="my-3">Order #{{ $order->id }}</h2>

<div class="bg-panel rounded p-3 mb-3">
    <p class="mb-1"><strong>Status:</strong> {{ $statusMap[$order->status] ?? ucfirst($order->status) }}</p>
    <p class="mb-1"><strong>Payment Method:</strong> {{ $paymentMap[$order->payment_method] ?? strtoupper($order->payment_method ?? 'COD') }}</p>
    <p class="mb-1"><strong>Payment Status:</strong> {{ $paymentStatusMap[$order->payment_status] ?? ucfirst($order->payment_status ?? 'unpaid') }}</p>
    <p class="mb-1"><strong>Address:</strong> {{ $order->address }}</p>
    <p class="mb-1"><strong>Phone:</strong> {{ $order->phone }}</p>
    @if($order->approved_at)<p class="mb-1"><strong>Approved At:</strong> {{ $order->approved_at->format('M d, Y h:i A') }}</p>@endif
    @if($order->shipped_at)<p class="mb-1"><strong>Shipped At:</strong> {{ $order->shipped_at->format('M d, Y h:i A') }}</p>@endif
    @if($order->completed_at)<p class="mb-1"><strong>Completed At:</strong> {{ $order->completed_at->format('M d, Y h:i A') }}</p>@endif
</div>

<div class="bg-panel rounded p-3">
    @foreach($order->items as $item)
        <div class="d-flex justify-content-between border-bottom py-2">
            <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
            <span>${{ number_format((float) ($item->price * $item->quantity), 2) }}</span>
        </div>
    @endforeach
    <div class="d-flex justify-content-between pt-3 fw-bold">
        <span>Total</span>
        <span>${{ number_format((float) $order->total_price, 2) }}</span>
    </div>
</div>
@endsection
