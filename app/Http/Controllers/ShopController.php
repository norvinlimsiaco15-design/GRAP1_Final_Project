<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('category')->withAvg('reviews', 'rating')->latest();

        if ($request->filled('category')) {
            $query->where('category_id', $request->integer('category'));
        }

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->string('q') . '%');
        }

        return view('shop.index', [
            'products' => $query->paginate(12)->withQueryString(),
            'categories' => Category::orderBy('name')->get(),
            'selectedCategory' => $request->integer('category'),
            'searchTerm' => (string) $request->string('q'),
        ]);
    }

    public function show(Product $product): View
    {
        $product->load(['category', 'reviews.user']);

        return view('shop.show', compact('product'));
    }
}
