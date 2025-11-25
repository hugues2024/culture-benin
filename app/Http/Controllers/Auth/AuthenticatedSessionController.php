<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // Si l'utilisateur (n'importe qui) a activé 2FA
        if ($user->google2fa_enabled) {
            // Déconnecter temporairement
            Auth::logout();

            // Stocker l'ID en session pour le challenge 2FA
            $request->session()->put('2fa:user:id', $user->id);

            // Rediriger vers le challenge 2FA
            return redirect()->route('2fa.challenge')
                ->with('info', '🔐 Entrez votre code de vérification');
        }

        // Redirection normale selon le rôle
        return $this->redirectAuthenticatedUser();
    }

    /**
     * Redirige l'utilisateur selon son rôle
     */
    private function redirectAuthenticatedUser(): RedirectResponse
    {
        $user = Auth::user();

        if ($user->isAdminOrManager()) {
            return redirect()->route('home');
        }

        return redirect()->route('accueil');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
