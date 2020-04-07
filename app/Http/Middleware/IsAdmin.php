<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->is_admin) {
            return abort(403);
        }

        return $next($request);
    }
}
