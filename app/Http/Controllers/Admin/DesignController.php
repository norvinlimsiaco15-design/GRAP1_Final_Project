<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Design;
use App\Services\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DesignController extends Controller
{
    public function index(): View
    {
        return view('admin.designs.index', [
            'designs' => Design::latest()->paginate(12),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.designs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('designs', 'public');
        }

        $design = Design::create($validated);
        AuditLogger::log(
            $request->user(),
            'created design',
            'Design',
            $design->id,
            "Admin added a new design: {$design->title}."
        );
        return redirect()->route('admin.designs.index')->with('success', 'Design created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Design $design): View
    {
        return view('admin.designs.show', compact('design'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Design $design): View
    {
        return view('admin.designs.edit', compact('design'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Design $design): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('designs', 'public');
        }

        $oldTitle = $design->title;
        $design->update($validated);
        AuditLogger::log(
            $request->user(),
            'updated design',
            'Design',
            $design->id,
            "Admin updated design {$oldTitle} to {$design->title}."
        );
        return redirect()->route('admin.designs.index')->with('success', 'Design updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Design $design): RedirectResponse
    {
        $admin = request()->user();
        $designTitle = $design->title;
        $designId = $design->id;
        $design->delete();
        AuditLogger::log(
            $admin,
            'deleted design',
            'Design',
            $designId,
            "Admin deleted design {$designTitle}."
        );
        return back()->with('success', 'Design deleted.');
    }
}
