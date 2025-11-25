<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Auth;

class Google2FAController extends Controller
{
    /**
     * Afficher la page de configuration 2FA
     */
    public function enable()
    {
        $user = auth()->user();
        $google2fa = new Google2FA();

        $secret = $google2fa->generateSecretKey();
        $user->google2fa_secret = $secret;
        $user->save();

        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );

        return view('auth.2fa-setup', compact('qrCodeUrl', 'secret'));
    }

    /**
     * Vérifier le code lors de l'activation
     */
    public function verify(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey(auth()->user()->google2fa_secret, $request->code);

        if ($valid) {
            auth()->user()->update(['google2fa_enabled' => true]);

            $route = auth()->user()->isAdminOrManager() ? 'home' : 'accueil';
            return redirect()->route($route)->with('success', '✅ 2FA activée avec succès ! 🇧🇯');
        }

        return back()->withErrors(['code' => 'Code invalide. Réessayez.']);
    }

    /**
     * Afficher le formulaire de challenge lors de la connexion
     */
    public function showChallenge()
    {
        if (!session('2fa:user:id')) {
            return redirect()->route('login');
        }

        return view('auth.2fa-challenge');
    }

    /**
     * Vérifier le code lors de la connexion
     */
    public function verifyLogin(Request $request)
    {
        $request->validate(['code' => 'required|digits:6']);

        if (!session('2fa:user:id')) {
            return redirect()->route('login');
        }

        $user = \App\Models\User::find(session('2fa:user:id'));

        if (!$user) {
            return redirect()->route('login');
        }

        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($user->google2fa_secret, $request->code);

        if ($valid) {
            // Connexion réussie
            session()->forget('2fa:user:id');
            Auth::login($user);

            $route = $user->isAdminOrManager() ? 'home' : 'accueil';
            return redirect()->route($route)->with('success', '✅ Connexion réussie ! 🇧🇯');
        }

        return back()->withErrors(['code' => 'Code invalide. Réessayez.']);
    }
}
