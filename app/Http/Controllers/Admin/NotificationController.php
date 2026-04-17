<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    public function open(string $notificationId): RedirectResponse
    {
        $notification = auth()->user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();

        $orderId = $notification->data['order_id'] ?? null;

        if ($orderId) {
            return redirect()->route('admin.orders.show', $orderId);
        }

        return redirect()->route('admin.dashboard');
    }
}
