<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is an admin
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request);
        } else {
            // abort(403, 'Unauthorized action.');
            return redirect()->route('dashboard.login')->with('status', 'You are not authorized to access this page.');
        }
    }
}
