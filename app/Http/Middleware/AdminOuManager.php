<?php
// app/Http/Middleware/AdminOuManager.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOuManager
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Vérifier si l'utilisateur est admin (id_role = 4) ou manager (id_role = 5)
        if ($user->id_role !== 4 && $user->id_role !== 5) {
            abort(403, 'Accès non autorisé.');
        }

        return $next($request);
    }
}
