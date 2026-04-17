<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WishlistController extends Controller
{
    public function index(): View
    {
        $items = Wishlist::with('product.category')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(12);

        return view('wishlist.index', compact('items'));
    }

    public function toggle(Product $product): RedirectResponse
    {
        $item = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $item->delete();
            return back()->with('success', 'Removed from wishlist.');
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Added to wishlist.');
    }
}
