<?php

namespace App\Http\Middleware;

use Closure;

class VerifiedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->verified == 1) {
            return $next($request);
        }
        return abort(404, 'Unauthorized');
    }
}
