@extends('layouts.app')

@section('content')
<h2 class="section-title">Your Cart</h2>

@php $total = 0; @endphp
@if(count($cart))
    <div class="table-responsive bg-panel p-3 p-md-4">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col" class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    @php $lineTotal = $item['price'] * $item['quantity']; $total += $lineTotal; @endphp
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $item['image'] ? asset('storage/'.$item['image']) : 'https://picsum.photos/90/90?random=cart'.$item['id'] }}" alt="{{ $item['name'] }}" class="rounded-3" style="width: 70px; height: 70px; object-fit: cover;">
                                <div>
                                    <p class="mb-0 fw-semibold">{{ $item['name'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td>${{ number_format($item['price'], 2) }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.update', $item['id']) }}" class="d-flex gap-2 align-items-center">
                                @csrf @method('PATCH')
                                <input type="number" name="quantity" min="1" value="{{ $item['quantity'] }}" class="form-control qty-input">
                                <button class="btn btn-outline-light btn-sm">Update</button>
                            </form>
                        </td>
                        <td>${{ number_format($lineTotal, 2) }}</td>
                        <td class="text-end">
                            <form method="POST" action="{{ route('cart.remove', $item['id']) }}">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="bg-panel p-3 p-md-4 mt-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h4 class="mb-0">Total: <span class="accent">${{ number_format($total, 2) }}</span></h4>
        <a href="{{ route('checkout.index') }}" class="btn btn-success px-4">Proceed to Checkout</a>
    </div>
@else
    <div class="bg-panel p-4">
        <p class="text-secondary mb-0">Your cart is empty.</p>
    </div>
@endif
@endsection
