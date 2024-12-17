<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthChecker
{

    public function handle(Request $request, Closure $next): Response
    {
        if(!$request->has('auth') || $request->query('auth') === 'false') {
            return response(redirect('/'));
        }
        return $next($request);
    }
}
