<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleChecker
{
    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->has('role') || $request->role != "admin") {
            return response("<h1>You are not admin</h1>");
        }
        return $next($request);
    }
}
