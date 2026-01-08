@extends('layouts.app1')

@section('title', 'Vérification Email - Culture Bénin')

@section('content')
<div class="register-full-wrapper d-flex flex-column h-100 py-5">
    <div class="container-fluid flex-grow-1 d-flex align-items-center justify-content-center px-lg-5">
        <div class="card shadow-lg border-0 w-100 rounded-4 overflow-hidden bg-white" style="max-width: 500px;">
            
            <div class="card-header border-0 pt-4 pb-0 text-center bg-white">
                <img src="{{ asset('img/send-emailwbg.png') }}" alt="Logo Culture Bénin" class="header-logo-compact mb-2">
                <h2 class="fw-bold h5 mb-0 text-dark">Vérifiez votre email</h2>
                <p class="text-muted x-small mb-0">Dernière étape pour rejoindre l'aventure</p>
            </div>

            <div class="card-body px-4 py-4">
                <div class="text-center mb-4">
                    <div class="email-icon-wrapper mx-auto shadow-sm">
                        <i class="bi bi-envelope-open-heart"></i>
                    </div>
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-benin-green alert-dismissible fade show py-2 px-3 mb-4 border-0 rounded-3 x-small">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Lien envoyé !</strong> Vérifiez votre boîte de réception.
                        <button type="button" class="btn-close small" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="text-center mb-4">
                    <h6 class="fw-bold text-benin-green mb-2">
                        <i class="bi bi-person-check-fill me-1"></i> Inscription presque terminée !
                    </h6>
                    <p class="text-muted small">
                        Un lien de validation vient d'être envoyé à :<br>
                        <span class="fw-bold text-dark">{{ auth()->user()->email }}</span>
                    </p>
                </div>

                <div class="info-box p-3 rounded-4 mb-4">
                    <h6 class="x-small fw-bold text-uppercase tracking-wider mb-2 text-dark">
                        <i class="bi bi-lightbulb-fill text-benin-yellow me-1"></i> Comment faire ?
                    </h6>
                    <ul class="x-small text-muted mb-0 ps-3">
                        <li class="mb-1">Ouvrez l'email envoyé par <strong>Culture Bénin</strong>.</li>
                        <li class="mb-1">Cliquez sur le bouton <strong>"Vérifier mon adresse email"</strong>.</li>
                        <li>Si vous ne le voyez pas, vérifiez vos <strong>spams</strong>.</li>
                    </ul>
                </div>

                <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                    @csrf
                    <button type="submit" class="btn btn-benin-green w-100 py-2 rounded-pill fw-bold shadow-sm transition-smooth">
                        <i class="bi bi-send-fill me-2"></i> Renvoyer le lien de vérification
                    </button>
                </form>

                <div class="text-center pt-3 border-top mt-4">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn text-decoration-none x-small text-muted fw-bold p-0 btn-benin-red">
                            <i class="bi bi-box-arrow-left me-1"></i> Se déconnecter pour changer de compte
                        </button>
                    </form>
                </div>
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

.register-full-wrapper {
    background-color: #f8f9fa;
    min-height: 80vh;
}

.header-logo-compact {
    height: 45px;
    width: auto;
}

/* Style de l'icône email */
.email-icon-wrapper {
    width: 80px;
    height: 80px;
    background: var(--benin-white-color);
    border: 2px solid var(--benin-green-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: var(--benin-green-color);
    animation: floating 3s ease-in-out infinite;
}

@keyframes floating {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}

/* Box d'instructions */
.info-box {
    background-color: rgba(252, 209, 22, 0.05);
    border: 1px dashed var(--benin-yellow-color);
}

/* Alertes personnalisées */
.alert-benin-green {
    background-color: #e6f3ed;
    color: var(--benin-green-dark-color);
}

/* Boutons et Textes */
.btn-benin-green {
    background-color: var(--benin-green-color);
    color: white;
    border: none;
}

.btn-benin-green:hover {
    background-color: var(--benin-green-dark-color);
    color: white;
    transform: translateY(-2px);
}

.btn-benin-red {
    background-color: var(--benin-red-color);
    color: white;
    border: none;
}

.btn-benin-red:hover {
    background-color: var(--benin-red-color);
    color: white;
    transform: translateY(-2px);
}
.text-benin-green { color: var(--benin-green-color); }
.text-benin-yellow { color: var(--benin-yellow-color); }
.x-small { font-size: 0.75rem !important; }

.transition-smooth { transition: var(--transition-smooth); }

.tracking-wider {
    letter-spacing: 0.05em;
}
</style>
@endpush