<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $name): Response
    {
        $roles = [
            'umum' => 1,
            'petani' => 2
        ];

        if (auth()->user()->role != $roles[$name]) {
            abort(404);
        }

        return $next($request);
    }
}
