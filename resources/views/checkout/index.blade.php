@extends('layouts.app')

@section('content')
<h2 class="section-title">Checkout</h2>

<div class="row g-4">
    <div class="col-md-7">
        <form method="POST" action="{{ route('checkout.store') }}" class="bg-panel p-4">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Address</label>
                <input type="text" name="address" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Payment Method</label>
                <select name="payment_method" class="form-select" required>
                    <option value="cod" @selected(old('payment_method') === 'cod')>Cash on Delivery (COD)</option>
                    <option value="gcash" @selected(old('payment_method') === 'gcash')>GCash</option>
                    <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>Bank Transfer</option>
                </select>
            </div>
            <button class="btn btn-success px-4">Place Order</button>
        </form>
    </div>
    <div class="col-md-5">
        <div class="bg-panel p-4">
            <h5 class="mb-3">Order Summary</h5>
            @php $total = 0; @endphp
            @foreach($cart as $item)
                @php $line = $item['price'] * $item['quantity']; $total += $line; @endphp
                <div class="d-flex justify-content-between small mb-2 text-secondary">
                    <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                    <span>${{ number_format($line, 2) }}</span>
                </div>
            @endforeach
            <hr class="border-secondary">
            <div class="d-flex justify-content-between fw-bold">
                <span>Total</span>
                <span class="accent">${{ number_format($total, 2) }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
