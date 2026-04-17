<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuditLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $oldRole = $user->role;
        $validated = $request->validate(['role' => ['required', 'in:admin,user']]);
        $user->update(['role' => $validated['role']]);
        AuditLogger::log(
            $request->user(),
            'updated user role',
            'User',
            $user->id,
            "Admin {$request->user()->name} changed user '{$user->name}' role from {$oldRole} to {$user->role}."
        );

        return back()->with('success', 'Role updated.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $admin = request()->user();
        $deletedUser = $user->name;
        $deletedUserId = $user->id;
        $user->delete();
        AuditLogger::log(
            $admin,
            'deleted user',
            'User',
            $deletedUserId,
            "Admin {$admin->name} deleted user '{$deletedUser}' (ID: {$deletedUserId})."
        );
        return back()->with('success', 'User deleted.');
    }
}
