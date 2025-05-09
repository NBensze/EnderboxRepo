<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //User isnt admin
        if (!Auth::check() || Auth::user()->User_role !== 'admin') 
        {
            return abort(403, 'Unauthorized access. Admins only.');
        }

        return $next($request);
    }
}
