<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (! $request->user() || $request->user()->role !== 'admin') {
            return redirect()->route('home')
                ->with('error', 'Admin access only. Please login with an admin account.');
        }

        return $next($request);
    }
}
