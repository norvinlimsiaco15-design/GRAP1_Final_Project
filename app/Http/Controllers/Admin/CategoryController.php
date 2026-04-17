<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::latest()->paginate(15),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(['name' => ['required', 'string', 'max:100', 'unique:categories,name']]);
        $category = Category::create($validated);
        AuditLogger::log(
            $request->user(),
            'created category',
            'Category',
            $category->id,
            "Admin {$request->user()->name} created category '{$category->name}'."
        );

        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $oldName = $category->name;
        $validated = $request->validate(['name' => ['required', 'string', 'max:100', 'unique:categories,name,' . $category->id]]);
        $category->update($validated);
        AuditLogger::log(
            $request->user(),
            'updated category',
            'Category',
            $category->id,
            "Admin {$request->user()->name} updated category '{$oldName}' to '{$category->name}'."
        );

        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $admin = request()->user();
        $categoryName = $category->name;
        $categoryId = $category->id;
        $category->delete();
        AuditLogger::log(
            $admin,
            'deleted category',
            'Category',
            $categoryId,
            "Admin {$admin->name} deleted category '{$categoryName}'."
        );

        return back()->with('success', 'Category deleted.');
    }
}
