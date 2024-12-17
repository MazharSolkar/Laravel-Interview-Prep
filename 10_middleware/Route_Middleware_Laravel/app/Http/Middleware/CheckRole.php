<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if($request->query('role') === 'guest' ) {
            return redirect('/');
        }
        return $next($request);
    }
}
