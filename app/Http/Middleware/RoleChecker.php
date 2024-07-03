<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleChecker
{
    public function handle(Request $request, Closure $next, string $roles):Response
    {
        // Check if user is authenticated
        if (!$request->user()) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }

        // Check if user has one of the allowed roles
        if (auth()->user()->role!=$roles) {
            abort(403);
            // return redirect()->route('home')->with('error', 'Unauthorized access');
        }

        return $next($request);
    }
}
