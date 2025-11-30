<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Langue;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $langues = Langue::all();
        return view('auth.register', compact('langues'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // ✅ Validation complète avec tous les champs
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255', 'min:2', 'regex:/^[a-zA-ZÀ-ÿ\s\-]+$/u'],
            'prenom' => ['required', 'string', 'max:255', 'min:2', 'regex:/^[a-zA-ZÀ-ÿ\s\-]+$/u'],
            'sexe' => ['required', 'string', 'in:masculin,feminin'],
            'date_naissance' => [
                'required',
                'date',
                'before:today',
                function ($attribute, $value, $fail) {
                    $age = date_diff(date_create($value), date_create('today'))->y;
                    if ($age < 13) {
                        $fail('Vous devez avoir au moins 13 ans pour vous inscrire.');
                    }
                }
            ],
            'langue_id' => ['required', 'integer', 'exists:langues,id'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email:rfc,dns',
                'max:255',
                'unique:' . User::class,
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
            'photo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048', // 2MB
                function ($attribute, $value, $fail) {
                    // Validation des dimensions
                    $image = getimagesize($value->getPathname());
                    $width = $image[0];
                    $height = $image[1];

                    if ($width > 2000 || $height > 2000) {
                        $fail('Les dimensions de l\'image ne peuvent pas dépasser 2000x2000 pixels.');
                    }

                    // Ratio d'aspect approximatif (carré pour une photo de profil)
                    $ratio = $width / $height;
                    if ($ratio < 0.7 || $ratio > 1.3) {
                        $fail('L\'image doit avoir un format carré ou proche du carré.');
                    }
                }
            ],
            'terms' => ['required', 'accepted'],
        ], [
            // ✅ Messages personnalisés en français
            'nom.required' => 'Le nom est obligatoire.',
            'nom.min' => 'Le nom doit contenir au moins 2 caractères.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'nom.regex' => 'Le nom ne peut contenir que des lettres, espaces et tirets.',

            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.min' => 'Le prénom doit contenir au moins 2 caractères.',
            'prenom.max' => 'Le prénom ne peut pas dépasser 255 caractères.',
            'prenom.regex' => 'Le prénom ne peut contenir que des lettres, espaces et tirets.',

            'sexe.required' => 'Veuillez sélectionner votre sexe.',
            'sexe.in' => 'Le sexe sélectionné est invalide.',

            'date_naissance.required' => 'La date de naissance est obligatoire.',
            'date_naissance.date' => 'La date de naissance doit être une date valide.',
            'date_naissance.before' => 'La date de naissance doit être antérieure à aujourd\'hui.',

            'langue_id.required' => 'Veuillez sélectionner votre langue principale.',
            'langue_id.exists' => 'La langue sélectionnée est invalide.',

            'role_id.required' => 'Veuillez sélectionner un type de compte.',
            'role_id.in' => 'Le type de compte sélectionné est invalide.',

            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être valide.',
            'email.lowercase' => 'L\'adresse email doit être en minuscules.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'email.max' => 'L\'adresse email ne peut pas dépasser 255 caractères.',
            'email.regex' => 'Le format de l\'adresse email est invalide.',

            'password.required' => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.regex' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre.',

            'photo.image' => 'Le fichier doit être une image.',
            'photo.mimes' => 'L\'image doit être au format JPEG, PNG, JPG ou WEBP.',
            'photo.max' => 'L\'image ne peut pas dépasser 2 Mo.',

            'terms.required' => 'Vous devez accepter les conditions d\'utilisation.',
            'terms.accepted' => 'Vous devez accepter les conditions d\'utilisation.',
        ]);

        try {
            // ✅ Gestion de l'upload de la photo
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('profiles', 'public');

                // Vérification supplémentaire de la taille
                if ($request->file('photo')->getSize() > 2 * 1024 * 1024) {
                    Storage::disk('public')->delete($photoPath);
                    return back()->withErrors([
                        'photo' => 'L\'image ne peut pas dépasser 2 Mo.'
                    ])->withInput();
                }
            }

            // ✅ Déterminer le statut en fonction du rôle


            // ✅ Création de l'utilisateur avec toutes les données
            $user = User::create([
                'nom' => ucfirst(strtolower(trim($validated['nom']))),
                'prenom' => ucfirst(strtolower(trim($validated['prenom']))),
                'sexe' => $validated['sexe'],
                'date_naissance' => $validated['date_naissance'],
             // ✅ role_id devient id_role dans la DB
                'id_langue' => $validated['langue_id'], // ✅ langue_id devient id_langue dans la DB
                'email' => strtolower(trim($validated['email'])),
                'password' => Hash::make($validated['password']),
                'photo' => $photoPath,
                'email_verified_at' => null, // ✅ Forcer la vérification d'email
            ]);

            // ✅ Déclencher l'événement d'inscription (envoie l'email de vérification)
            event(new Registered($user));

            // ✅ Connecter l'utilisateur
            Auth::login($user);

            // ✅ Rediriger vers la page de vérification (BLOQUANTE)
            return redirect()->route('verification.notice');
        } catch (\Exception $e) {
            // ✅ En cas d'erreur, supprimer la photo uploadée
            if (isset($photoPath) && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }

            // ✅ Log de l'erreur
            Log::error('Erreur lors de l\'inscription: ' . $e->getMessage(), [
                'email' => $request->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return back()->withErrors([
                'email' => 'Une erreur est survenue: ' . $e->getMessage()
            ])->withInput();
        }
    }
}
