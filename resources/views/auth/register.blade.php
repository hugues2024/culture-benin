@extends('layouts.app1')

@section('title', 'Inscription - Culture Bénin')

@section('content')
<div class="register-full-wrapper d-flex flex-column h-100">
    <div class="container-fluid flex-grow-1 d-flex align-items-center justify-content-center py-3 px-lg-5">
        <div class="card shadow-lg border-0 w-100 rounded-4 overflow-hidden bg-white" style="max-width: 1200px;">
            
            <div class="card-header bg-white border-0 pt-3 pb-0 text-center">
                <img src="{{ asset('img/register-wbg.png') }}" alt="Logo" class="header-logo-compact mb-1">
                <h2 class="fw-bold h5 mb-0 text-dark">Créer un compte</h2>
                <p class="text-muted x-small mb-1">Rejoignez l'aventure Culture-Bénin</p>
            </div>

            <div class="card-body px-4 py-2">
                @if ($errors->any())
                    <div class="alert alert-danger py-2 px-3 mb-3 border-0 rounded-3 x-small">
                        <p class="fw-bold mb-1"><i class="bi bi-exclamation-triangle me-1"></i> Erreurs de validation :</p>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row gx-4">
                        <div class="col-lg-3 col-md-4 mb-3 text-center">
                            <div class="h-100 p-3 bg-light rounded-4 border border-opacity-10">
                                <label class="x-small fw-bold mb-3 d-block text-uppercase text-secondary">Photo de profil</label>
                                <div class="position-relative d-inline-block mb-2">
                                    <div class="photo-preview-small shadow-sm" id="photoPreview">
                                        <i class="bi bi-person-fill fs-1 text-secondary"></i>
                                    </div>
                                    <img id="photoPreviewImage" class="photo-preview-small shadow-sm" style="display: none; object-fit: cover;">
                                    <label for="photo" class="btn btn-benin-green btn-circle-sm position-absolute bottom-0 end-0 shadow">
                                        <i class="bi bi-camera-fill"></i>
                                    </label>
                                </div>
                                <input type="file" name="photo" id="photo" accept="image/*" class="d-none">
                                <p class="x-small text-muted mt-2 mb-0">Tous formats acceptés<br>Max 2 Mo</p>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-8 mb-3 border-end-lg">
                            <div class="px-2">
                                <label class="x-small fw-bold mb-3 d-block text-uppercase text-benin-green">Informations Personnelles</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="x-small fw-bold mb-1">Nom</label>
                                        <input type="text" name="nom" class="form-control form-control-sm border-0 bg-light" placeholder="Nom" value="{{ old('nom') }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="x-small fw-bold mb-1">Prénom</label>
                                        <input type="text" name="prenom" class="form-control form-control-sm border-0 bg-light" placeholder="Prénom" value="{{ old('prenom') }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="x-small fw-bold mb-1">Naissance</label>
                                        <input type="date" name="date_naissance" class="form-control form-control-sm border-0 bg-light" value="{{ old('date_naissance') }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label class="x-small fw-bold mb-1">Sexe</label>
                                        <select name="sexe" class="form-select form-select-sm border-0 bg-light" required>
                                            <option value="masculin" {{ old('sexe') == 'masculin' ? 'selected' : '' }}>Masculin</option>
                                            <option value="feminin" {{ old('sexe') == 'feminin' ? 'selected' : '' }}>Féminin</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="x-small fw-bold mb-1">Langue principale</label>
                                        <select name="langue_id" class="form-select form-select-sm border-0 bg-light" required>
                                            <option value="">Sélectionnez votre langue</option>
                                            @foreach($langues ?? [] as $langue)
                                                <option value="{{ $langue->id }}" {{ old('langue_id') == $langue->id ? 'selected' : '' }}>{{ $langue->nom_langue }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-12 mb-3">
                            <div class="px-2">
                                <label class="x-small fw-bold mb-3 d-block text-uppercase text-benin-green">Identifiants & Sécurité</label>
                                <div class="mb-2">
                                    <label class="x-small fw-bold mb-1">Adresse Email</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text border-0 bg-light text-muted"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" class="form-control border-0 bg-light" placeholder="email@mail.com" value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label class="x-small fw-bold mb-1">Mot de passe</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text border-0 bg-light text-muted"><i class="bi bi-lock"></i></span>
                                        <input type="password" name="password" id="password" class="form-control border-0 bg-light" placeholder="••••••••" required>
                                        <button class="btn btn-light border-0 toggle-password" type="button" data-target="password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="x-small fw-bold mb-1">Confirmation</label>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text border-0 bg-light text-muted"><i class="bi bi-shield-check"></i></span>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-0 bg-light" placeholder="••••••••" required>
                                        <button class="btn btn-light border-0 toggle-password" type="button" data-target="password_confirmation">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input custom-check" type="checkbox" name="terms" id="terms" required>
                                    <label class="form-check-label x-small text-muted" for="terms">
                                        J'accepte les <a href="#" class="text-benin-green fw-bold">conditions d'utilisation</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row align-items-center border-top pt-3 mt-1">
                        <div class="col-md-4 d-none d-md-block">
                             <a href="{{ route('login') }}" class="text-benin-green fw-bold text-decoration-none x-small">
                                <i class="bi bi-arrow-left me-1"></i> Déjà inscrit ? Se connecter
                             </a>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-benin-green w-100 py-2 rounded-pill fw-bold shadow-sm">
                                Créer mon compte
                            </button>
                        </div>
                        <div class="col-md-4 text-end d-none d-md-block">
                             <span class="x-small text-muted"><i class="bi bi-shield-lock-fill me-1 text-success"></i>Données sécurisées</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
:root {
    --benin-green-color: #008751;
    --benin-green-dark-color: #006b40;
    --benin-green-light-color: rgba(0, 135, 81, 0.1);
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
    
/* Suppression du contour bleu - Focus Vert Bénin */
.form-control:focus, .form-select:focus, .custom-check:focus {
    border-color: var(--benin-green-color) !important;
    box-shadow: 0 0 0 0.25rem var(--benin-green-light-color) !important;
    outline: none;
}

.custom-check:checked {
    background-color: var(--benin-green-color) !important;
    border-color: var(--benin-green-color) !important;
}

/* Design Compact */
.header-logo-compact { height: 40px; width: auto; }
.photo-preview-small {
    width: 80px; height: 80px;
    background: #fff; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    border: 2px solid var(--benin-green-color);
}

.btn-circle-sm {
    width: 28px; height: 28px; border-radius: 50%; padding: 0;
    display: flex; align-items: center; justify-content: center;
}

.x-small { font-size: 0.75rem !important; }
.text-benin-green { color: var(--benin-green-color); }
.btn-benin-green { background: var(--benin-green-color); color: white; border: none; }
.btn-benin-green:hover { background: var(--benin-green-dark-color); color: white; }

@media (min-width: 992px) {
    .border-end-lg { border-right: 1px solid #eee !important; }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Photo Preview
    const photoInput = document.getElementById('photo');
    const previewImg = document.getElementById('photoPreviewImage');
    const previewIcon = document.getElementById('photoPreview');

    photoInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
                previewIcon.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });

    // 2. Toggle Password pour les deux champs
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    });
});
</script>
@endpush