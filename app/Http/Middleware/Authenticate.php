<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
    protected function authenticate($request, array $guards)
{
    if (empty($guards)) {
        $guards = ['admin', 'user', 'web'];
    }

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            Auth::shouldUse($guard);
            return;
        }
    }

    $this->unauthenticated($request, $guards);
}
}
