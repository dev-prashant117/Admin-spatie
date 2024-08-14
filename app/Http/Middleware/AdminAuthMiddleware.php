<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
     
        if (Auth::check() && Auth::user()->hasAnyRole($roles)) {

            return $next($request);
        }
        Auth::logout();
        return redirect()->back()->withErrors([
            'email' => 'You do not have access to the admin area!',
        ]);
     

    }
}
