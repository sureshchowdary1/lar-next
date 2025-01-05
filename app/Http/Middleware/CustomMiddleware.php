<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Example: Deny access if a specific header is missing
        if (!$request->hasHeader('X-Custom-Header')) {
            return response('Unauthorized', 401);
        }

        // Allow request to continue
        return $next($request);
    }
}
