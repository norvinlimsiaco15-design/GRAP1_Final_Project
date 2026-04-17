<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('category')->latest()->paginate(12);
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'max:2048'],
            'sizes' => ['nullable', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'min:0'],
            'discount_percent' => ['nullable', 'numeric', 'min:0', 'max:90'],
            'is_new_arrival' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['is_new_arrival'] = (bool) ($validated['is_new_arrival'] ?? false);
        $validated['discount_percent'] = $validated['discount_percent'] ?? 0;

        $product = Product::create($validated);
        AuditLogger::log(
            $request->user(),
            'created product',
            'Product',
            $product->id,
            "Admin {$request->user()->name} created product '{$product->name}' at {$product->price}."
        );

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function show(Product $product): View
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'max:2048'],
            'sizes' => ['nullable', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'min:0'],
            'discount_percent' => ['nullable', 'numeric', 'min:0', 'max:90'],
            'is_new_arrival' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['is_new_arrival'] = (bool) ($validated['is_new_arrival'] ?? false);
        $validated['discount_percent'] = $validated['discount_percent'] ?? 0;

        $beforePrice = (float) $product->price;
        $product->update($validated);
        $afterPrice = (float) $product->price;
        AuditLogger::log(
            $request->user(),
            'updated product',
            'Product',
            $product->id,
            "Admin {$request->user()->name} updated product '{$product->name}' price from {$beforePrice} to {$afterPrice}."
        );

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $admin = request()->user();
        $productName = $product->name;
        $productId = $product->id;
        $product->delete();
        AuditLogger::log(
            $admin,
            'deleted product',
            'Product',
            $productId,
            "Admin {$admin->name} deleted product '{$productName}'."
        );

        return back()->with('success', 'Product deleted.');
    }
}
