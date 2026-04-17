<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response|RedirectResponse
    {
        if (! $request->user() || $request->user()->role !== $role) {
            return redirect()->route('home')
                ->with('error', 'Admin access only. Please login with an admin account.');
        }

        return $next($request);
    }
}
