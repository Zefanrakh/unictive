<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleWebMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (auth()->user() && auth()->user()->role->value === $role) {
            return $next($request);
        }

        return redirect()->route('dashboard')->with('message', [
            'type' => 'error',
            'content' => 'You do not have access to this page.',
        ]);
    }
}
