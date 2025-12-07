<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)

    {

        if (!$request->user() || !in_array($request->user()->typeRole->nom, $roles)) {

            abort(403, 'Accès non autoriséEE.');
        }

        return $next($request);
    }
}
