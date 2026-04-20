<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   // app/Http/Middleware/EnsureUserIsAdmin.php

public function handle($request, Closure $next, ...$roles)
{
    $user = auth()->user();

    // Vérifier si connecté
    if (!$user) {
        return redirect()->route('login');
    }

    // Vérifier le rôle
    if (!in_array($user->role->nom, $roles)) {
        abort(403, 'Accès refusé ' . $user->role->nom . ' - Rôles autorisés : ' . implode(', ', $roles));
    }

    return $next($request);
}
}
