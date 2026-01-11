@extends('layouts.app1')

@section('title', 'Connexion - Culture Bénin')

@section('content')
<div class="login-wrapper d-flex flex-column justify-content-center py-3">
    <div class="container">
        <div class="card shadow-sm border-0 mx-auto login-card rounded-4">
            <div class="card-header bg-white border-0 pt-4 pb-0 text-center">
                <img src="{{ asset('img/login-wbg.png') }}" alt="Logo" class="header-logo-mini mb-2">
                <h2 class="fw-bold h5 mb-1">Connexion</h2>
                <p class="text-muted x-small mb-0">Espace Culture-Bénin</p>
            </div>

            <div class="card-body px-4 py-3">
                @if (session('status') || $errors->any())
                    <div class="alert {{ session('status') ? 'alert-success' : 'alert-danger' }} py-2 px-3 mb-3 border-0 rounded-3 x-small">
                        {{ session('status') ?? 'Identifiants incorrects.' }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-2">
                        <label for="email" class="form-label x-small fw-bold mb-1 text-secondary">Email</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                            <input type="email" name="email" id="email" class="form-control form-control-sm border-start-0 bg-light" placeholder="votre@email.com" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label x-small fw-bold mb-1 text-secondary">Mot de passe</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                            <input type="password" name="password" id="password" class="form-control form-control-sm border-start-0 bg-light" placeholder="••••••••" required>
                            <button class="btn btn-outline-light border border-start-0 bg-light text-muted" type="button" id="togglePassword">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                        <label class="form-check-label x-small text-muted" for="remember_me">Se souvenir de moi</label>
                    </div>

                    <button type="submit" class="btn btn-benin-green w-100 py-2 rounded-3 fw-bold mb-3 shadow-sm">
                        Se connecter
                    </button>

                    @if (Route::has('register'))
                        <div class="text-center pt-2 border-top">
                            <p class="x-small text-muted mb-0">
                                Nouveau ici ? <a href="{{ route('register') }}" class="text-benin-green fw-bold text-decoration-none">Créer un compte</a>
                            </p>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>

:root {
        --black: #000000;
        --dark-gray: #1a1a1a;
        --overlay-black-50: rgba(0, 0, 0, 0.5);
        --overlay-black-60: rgba(0, 0, 0, 0.6);
        --overlay-orange-70-1: rgba(255, 107, 0, 0.7);
        --overlay-orange-70-2: rgba(204, 85, 0, 0.7);
        --white-transparent-20: rgba(255, 255, 255, 0.2);
        --white-transparent-30: rgba(255, 255, 255, 0.3);
        --white-transparent-15: rgba(255, 255, 255, 0.15);
        --black-shadow-50: rgba(0, 0, 0, 0.5);
        --black-shadow-20: rgba(0, 0, 0, 0.2);
        --black-shadow-30: rgba(0, 0, 0, 0.3);
        --green-80: #F0C43B;
        --green-100: #F0C43B;
        --green-solid: #F0C43B;
        /* Colors - Culture-Bénin Theme */
        --benin-white-color: #F9FBF9 /*Pour les boutons principaux, la barre de navigation.*/;
        --benin-dark-color: #2D2D2D /*Un gris très foncé (mieux que le noir pur) pour la lecture.*/;
        --benin-green-color: #008751 /*Pour les boutons principaux, la barre de navigation.*/;
        --benin-green-dark-color: #006b40 /*Pour les survols de boutons, les accents.*/;
        --benin-green-light-color: #cbf8e9ff /*Pour les survols des boutons, les accents.*/;
        --benin-yellow-color: #FCD116 /*Pour les icônes, les mises en évidence, les étoiles.*/;
        --benin-red-color: #E8112D /*Pour les alertes, les cœurs (favoris), les prix.*/;
        --google-gray: #5f6368;
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    /* Couleur de sélection pour Chrome, Firefox, Safari et Edge */
    ::selection {
        background-color: rgba(0, 135, 81, 0.25); /* Vert bénin avec 25% d'opacité */
        color: #008751; /* Le texte lui-même devient vert foncé */
    }

    /* Pour Firefox (version spécifique) */
    ::-moz-selection {
        background-color: rgba(0, 135, 81, 0.25);
        color: #008751;
    }
/* Container de centrage pour éviter le scroll */
.login-card {
    max-width: 360px; /* Plus étroit pour le style Google */
    border: 1px solid #efefef !important;
}

.header-logo-mini {
    height: 45px; /* Logo réduit */
    width: auto;
}

/* Typographie réduite */
.x-small {
    font-size: 0.75rem !important;
}

/* Inputs condensés */
.form-control-sm, .input-group-text {
    border-color: var(--benin-dark-color);
    font-size: 0.85rem;
}

.form-control-sm:focus {
    border-color: var(--benin-green-color);
    box-shadow: none;
}

/* Bouton vert béninois */
.btn-benin-green {
    background-color: var(--benin-green-color);
    color: white;
    border: none;
    font-size: 0.9rem;
}

.btn-benin-green:hover {
    background-color: var(--benin-green-color);
    color: white;
}

/* Couleurs du texte */
.text-benin-green {
    color: var(--benin-green-color) !important;
}

#togglePassword {
    z-index: 5;
    border-color: var(--benin-dark-color) !important;
}
#togglePassword:focus {
    box-shadow: none;
}
</style>
@endpush
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password'); // Corrigé ici
        const icon = document.getElementById('toggleIcon');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', function () {
                // Basculer le type d'input
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Basculer l'icône Bootstrap
                if (type === 'text') {
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        }
    });
</script>
@endpush