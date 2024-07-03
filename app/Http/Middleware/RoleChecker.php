<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleChecker
{
    public function handle(Request $request, Closure $next):Response
    {
        // Check if user is authenticated
        if (!$request->user()) {
            return redirect()->route('login')->with('error', 'You need to login first');
        }

        // Check if user has one of the allowed roles
        // if (auth()->user()->role!=$roles) {
        //     return redirect()->route('home')->with('error', 'Unauthorized access');
        // }


        if ($request->user() && $request->user()->role != 'owner' && $request->user()->role != 'employee') {
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }
        
        return $next($request);
    }
}
