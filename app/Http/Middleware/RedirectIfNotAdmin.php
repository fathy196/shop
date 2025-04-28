<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If the user is not authenticated
        if (!Auth::check()) {
            // If the request is inside dashboard section
            if ($request->is('dashboard') || $request->is('dashboard/*')) {
                return redirect()->route('dashboard.login');
            }

            // Otherwise fallback to normal login
            return redirect()->route('login');
        }

        return $next($request);
    }
}
