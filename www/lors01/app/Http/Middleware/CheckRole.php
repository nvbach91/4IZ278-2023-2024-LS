<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! $request->user() || $request->user()->role !== $role) {
            abort(403, 'Unauthorized');
        }
        // Check if the request method is allowed
        $allowedMethods = ['GET', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE'];
        if (!in_array($request->method(), $allowedMethods)) {
            abort(405, 'Method Not Allowed');
        }

        return $next($request);
    }
}