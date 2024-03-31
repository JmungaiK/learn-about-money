<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Normal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        switch ($userRole) {
            case 3:
                return $next($request);
                break;
            case 2:
                return redirect()->route('mod');
                break;
            case 1:
                return redirect()->route('admin');
                break;
        }

        /*

        if ($userRole == 3) {
            return $next($request);
        }

        if ($userRole == 2) {
            return redirect()->route('mod');
        }

        if ($userRole == 1) {
            return redirect()->route('admin');
        }
        */
    }
}
