<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Services\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('user')->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load('user', 'items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $oldStatus = $order->status;
        $oldPaymentStatus = $order->payment_status;
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,shipped,completed,cancelled'],
            'payment_status' => ['required', 'in:unpaid,paid,failed'],
        ]);
        $newStatus = $validated['status'];
        $newPaymentStatus = $validated['payment_status'];

        $allowedTransitions = [
            'pending' => ['approved', 'cancelled'],
            'approved' => ['shipped', 'cancelled'],
            'shipped' => ['completed', 'cancelled'],
            'completed' => [],
            'cancelled' => [],
        ];

        if ($newStatus !== $oldStatus && ! in_array($newStatus, $allowedTransitions[$oldStatus] ?? [], true)) {
            return back()->with('error', "Invalid status transition from {$oldStatus} to {$newStatus}.");
        }

        try {
            DB::transaction(function () use ($order, $oldStatus, $newStatus, $newPaymentStatus): void {
                if ($newStatus === 'approved' && $oldStatus !== 'approved') {
                    $order->load('items.product');
                    foreach ($order->items as $item) {
                        if (! $item->product || $item->product->stock < $item->quantity) {
                            throw new \RuntimeException("Not enough stock for {$item->product?->name}.");
                        }
                    }

                    foreach ($order->items as $item) {
                        $item->product->decrement('stock', $item->quantity);
                    }
                }

                $order->status = $newStatus;
                $order->payment_status = $newPaymentStatus;
                if ($newStatus === 'approved') {
                    $order->approved_at = now();
                } elseif ($newStatus === 'shipped') {
                    $order->shipped_at = now();
                } elseif ($newStatus === 'completed') {
                    $order->completed_at = now();
                }
                $order->save();
            });
        } catch (\RuntimeException $exception) {
            return back()->with('error', $exception->getMessage());
        }

        AuditLogger::log(
            $request->user(),
            'updated order and payment status',
            'Order',
            $order->id,
            "Admin {$request->user()->name} changed order #{$order->id} status from {$oldStatus} to {$newStatus} and payment status from {$oldPaymentStatus} to {$newPaymentStatus}."
        );

        return back()->with('success', 'Order and payment status updated.');
    }
}
