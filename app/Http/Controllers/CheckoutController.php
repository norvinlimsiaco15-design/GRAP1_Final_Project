<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewOrderPlacedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'payment_method' => ['required', 'in:cod,gcash,bank_transfer'],
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        $productIds = collect($cart)->pluck('id')->all();
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        foreach ($cart as $item) {
            $product = $products->get($item['id']);

            if (! $product || $product->stock < $item['quantity']) {
                return redirect()->route('cart.index')
                    ->with('error', "Insufficient stock for {$item['name']}. Please update your cart.");
            }
        }

        $order = DB::transaction(function () use ($cart, $validated): Order {
            $total = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $total,
                'status' => 'pending',
                'address' => $validated['address'],
                'phone' => $validated['phone'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'unpaid',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            return $order;
        });

        $order->load('user');
        User::where('role', 'admin')->get()->each(
            fn (User $admin) => $admin->notify(new NewOrderPlacedNotification($order))
        );

        session()->forget('cart');

        return redirect()->route('orders.index')->with('success', 'Order placed successfully and is waiting for admin approval.');
    }
}
