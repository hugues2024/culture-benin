<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Check2FA
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Si TOUS les utilisateurs n'ont pas encore activé 2FA
        if ($user && !$user->google2fa_enabled) {
            // Routes exemptées
            $allowedPaths = [
                '2fa/enable',
                '2fa/verify',
                'logout',
            ];

            foreach ($allowedPaths as $path) {
                if ($request->is($path)) {
                    return $next($request);
                }
            }

            // Forcer la configuration 2FA pour TOUT LE MONDE
            return redirect()->route('2fa.enable')
                ->with('warning', '🔐 Vous devez activer la 2FA pour continuer. C\'est obligatoire pour tous les utilisateurs.');
        }

        return $next($request);
    }
}
