<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the current route name
        $currentRouteName = $request->route()->getName();

        // Get the role of the authenticated user
        $role = Auth::user()->role;

        // Redirect based on the role if not already on the intended route
        if ($role === 'student' && $currentRouteName !== 'student.dashboard') {
            return redirect()->route('student.dashboard');
        }

        if ($role === 'lecturer' && $currentRouteName !== 'lecturer.dashboard') {
            return redirect()->route('lecturer.dashboard');
        }

        if ($role === 'parent' && $currentRouteName !== 'parent.dashboard') {
            return redirect()->route('parent.dashboard');
        }

        if ($role === 'admin' && $currentRouteName !== 'admin.dashboard') {
            return redirect()->route('admin.dashboard');
        }

        // If already on the intended route, proceed with the request
        return $next($request);
    }
}
