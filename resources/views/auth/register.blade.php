@extends('layouts.app1')
@section('title', 'Inscription - Culture Bénin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="card shadow-sm custom-card mx-auto">
            <!-- Header avec Logo -->
            <div class="card-header text-white custom-card-header">
                <div class="text-center">
                    <img src="{{ asset('img/logo1.png') }}" alt="Logo Culture Bénin" class="header-logo mb-2">
                    <h4 class="mb-0 fw-bold">Créer un compte</h4>
                    <p class="mb-0 small opacity-90">Rejoignez notre communauté culturelle</p>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="card-body p-4">
                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Veuillez corriger les erreurs suivantes :</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Photo de profil -->
                    <div class="text-center mb-4">
                        <div class="photo-preview-wrapper">
                            <div class="photo-preview" id="photoPreview">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <img id="photoPreviewImage" class="photo-preview-img" style="display: none;">
                        </div>
                        <label for="photo" class="btn btn-sm btn-outline-primary mt-2">
                            <i class="bi bi-cloud-upload"></i> Choisir une photo
                        </label>
                        <input type="file" name="photo" id="photo" accept="image/*" class="d-none">
                        <button type="button" class="btn btn-sm btn-outline-danger mt-2" id="removePhoto" style="display: none;">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                        <div class="form-text small">JPG, PNG, WEBP • Max 2 Mo (optionnel)</div>
                        @error('photo')<div class="text-danger small mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                    <!-- Nom / Prénom -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nom" class="form-label fw-semibold"><i class="bi bi-person"></i> Nom <span class="text-danger">*</span></label>
                            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" placeholder="Votre nom" value="{{ old('nom') }}" required>
                            @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="prenom" class="form-label fw-semibold"><i class="bi bi-person"></i> Prénom <span class="text-danger">*</span></label>
                            <input type="text" name="prenom" id="prenom" class="form-control @error('prenom') is-invalid @enderror" placeholder="Votre prénom" value="{{ old('prenom') }}" required>
                            @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Sexe -->
                    <div class="mt-3">
                        <label class="form-label fw-semibold"><i class="bi bi-gender-ambiguous"></i> Sexe <span class="text-danger">*</span></label>
                        <div class="d-flex gap-3">
                            <div class="form-check form-check-inline flex-fill">
                                <input class="form-check-input" type="radio" name="sexe" id="homme" value="Masculin" {{ old('sexe') == 'Masculin' ? 'checked' : '' }} required>
                                <label class="form-check-label w-100" for="homme">
                                    <i class="bi bi-gender-male"></i> Masculin
                                </label>
                            </div>
                            <div class="form-check form-check-inline flex-fill">
                                <input class="form-check-input" type="radio" name="sexe" id="femme" value="Féminin" {{ old('sexe') == 'Féminin' ? 'checked' : '' }} required>
                                <label class="form-check-label w-100" for="femme">
                                    <i class="bi bi-gender-female"></i> Féminin
                                </label>
                            </div>
                        </div>
                        @error('sexe')<div class="text-danger small mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                    <!-- Date de naissance / Langue -->
                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label for="date_naissance" class="form-label fw-semibold"><i class="bi bi-calendar"></i> Date de naissance <span class="text-danger">*</span></label>
                            <input type="date" name="date_naissance" id="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror" value="{{ old('date_naissance') }}" max="{{ date('Y-m-d', strtotime('-13 years')) }}" required>
                            <div class="form-text small">Vous devez avoir au moins 13 ans</div>
                            @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="langue_id" class="form-label fw-semibold"><i class="bi bi-translate"></i> Langue principale <span class="text-danger">*</span></label>
                            <select name="langue_id" id="langue_id" class="form-select @error('langue_id') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez votre langue --</option>
                                @forelse($langues ??  [] as $langue)
                                    <option value="{{ $langue->id }}" {{ old('langue_id') == $langue->id ?  'selected' : '' }}>
                                        {{ $langue->nom_langue }} ({{ $langue->code_langue }})
                                    </option>
                                @empty
                                    <option value="" disabled>Aucune langue disponible</option>
                                @endforelse
                            </select>
                            @error('langue_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mt-3">
                        <label for="email" class="form-label fw-semibold"><i class="bi bi-envelope"></i> Adresse Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="votre@email.com" value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Mot de passe / Confirmation -->
                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold"><i class="bi bi-lock-fill"></i> Mot de passe <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimum 8 caractères" minlength="8" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            <div class="form-text small">Au moins 8 caractères avec majuscules, minuscules et chiffres</div>
                            @error('password')<div class="text-danger small mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                            <!-- Force du mot de passe -->
                            <div class="password-strength mt-2">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar" id="strengthBar" role="progressbar" style="width: 0%"></div>
                                </div>
                                <small id="strengthText" class="text-muted">Force du mot de passe</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold"><i class="bi bi-lock-fill"></i> Confirmer le mot de passe <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmez votre mot de passe" minlength="8" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                    <i class="bi bi-eye" id="toggleIconConfirm"></i>
                                </button>
                            </div>
                            <div id="passwordMatch" class="small mt-2"></div>
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                            <label class="form-check-label small" for="terms">
                                J'accepte les <a href="#" class="text-decoration-none">conditions d'utilisation</a> et la <a href="#" class="text-decoration-none">politique de confidentialité</a> <span class="text-danger">*</span>
                            </label>
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Se connecter
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Créer mon compte
                        </button>
                    </div>
                </form>

                <!-- Security Notice -->
                <div class="text-center mt-4 pt-3 border-top">
                    <small class="text-muted">
                        <i class="bi bi-shield-check text-success"></i>
                        Vos données sont protégées et ne seront jamais partagées avec des tiers
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        min-height: 100vh;
    }

    .custom-card {
        border-radius: 16px;
        overflow: hidden;
        border: none;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        max-width: 700px;
        margin-top: 2rem;
    }

    . custom-card-header {
        background: linear-gradient(135deg, #008751, #006b40);
        padding: 2rem 1.5rem;
    }

    .header-logo {
        height: 50px;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
    }

    .card-body {
        padding: 2rem ! important;
    }

    /* Photo Preview */
    .photo-preview-wrapper {
        position: relative;
        display: inline-block;
    }

    .photo-preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: #f8f9fa;
        border: 3px dashed #ced4da;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #6c757d;
    }

    .photo-preview-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #008751;
        position: absolute;
        top: 0;
        left: 0;
    }

    /* Form Controls */
    .form-label {
        color: #2c3e50;
        font-size: 0.9rem;
        margin-bottom: 0.375rem;
    }

    . form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #dce4ec;
        padding: 0.625rem 0.875rem;
        transition: all 0.2s;
        font-size: 0.9375rem;
    }

    . form-control:focus, .form-select:focus {
        border-color: #008751;
        box-shadow: 0 0 0 0.2rem rgba(0,135,81,0.15);
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .invalid-feedback, .text-danger {
        font-size: 0.8125rem;
    }

    /* Radio Buttons */
    .form-check-inline {
        border: 2px solid #dce4ec;
        border-radius: 8px;
        padding: 0.625rem 1rem;
        transition: all 0.2s;
    }

    .form-check-input:checked ~ .form-check-label {
        color: #008751;
        font-weight: 600;
    }

    .form-check-inline:has(. form-check-input:checked) {
        border-color: #008751;
        background: rgba(0,135,81,0.05);
    }

    /* Buttons */
    .btn-primary {
        background: linear-gradient(135deg, #008751, #006b40);
        border: none;
        font-weight: 600;
        font-size: 0.9375rem;
        padding: 0.625rem 1.5rem;
        transition: all 0.2s;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,135,81,0.3);
    }

    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
        font-weight: 600;
        padding: 0.625rem 1.5rem;
    }

    .btn-outline-secondary:hover {
        background: #6c757d;
        color: white;
    }

    /* Password Strength */
    .password-strength . progress-bar {
        transition: all 0.3s;
    }

    .password-strength .progress-bar[data-strength="weak"] {
        width: 33%;
        background: #dc3545;
    }

    .password-strength .progress-bar[data-strength="medium"] {
        width: 66%;
        background: #ffc107;
    }

    .password-strength .progress-bar[data-strength="strong"] {
        width: 100%;
        background: #28a745;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .custom-card {
            margin-top: 1rem;
        }

        .card-body {
            padding: 1.5rem ! important;
        }

        . header-logo {
            height: 40px;
        }

        .custom-card-header {
            padding: 1.5rem 1rem;
        }

        .form-check-inline {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Photo Preview
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');
    const photoPreviewImage = document.getElementById('photoPreviewImage');
    const removePhotoBtn = document.getElementById('removePhoto');

    photoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('La taille du fichier ne doit pas dépasser 2 Mo');
                photoInput.value = '';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                photoPreviewImage.src = e.target. result;
                photoPreviewImage.style.display = 'block';
                photoPreview.style.display = 'none';
                removePhotoBtn.style.display = 'inline-block';
            };
            reader.readAsDataURL(file);
        }
    });

    removePhotoBtn.addEventListener('click', function() {
        photoInput.value = '';
        photoPreviewImage.style.display = 'none';
        photoPreview.style.display = 'flex';
        this.style.display = 'none';
    });

    // Toggle Password Visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const password = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        if (password.type === 'password') {
            password.type = 'text';
            icon. classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            password.type = 'password';
            icon. classList.replace('bi-eye-slash', 'bi-eye');
        }
    });

    document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
        const password = document.getElementById('password_confirmation');
        const icon = document.getElementById('toggleIconConfirm');
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            password. type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });

    // Password Strength
    const passwordInput = document.getElementById('password');
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document. getElementById('strengthText');

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;

        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/. test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;

        const labels = ['', 'Faible', 'Moyen', 'Bon', 'Fort'];
        const colors = ['', 'weak', 'medium', 'medium', 'strong'];

        strengthBar.style.width = (strength * 25) + '%';
        strengthBar.setAttribute('data-strength', colors[Math.min(strength, 3)]);
        strengthText.textContent = password.length > 0 ? `Force : ${labels[Math.min(strength, 4)]}` : 'Force du mot de passe';
    });

    // Password Match
    const passwordConfirm = document.getElementById('password_confirmation');
    const passwordMatch = document.getElementById('passwordMatch');

    passwordConfirm.addEventListener('input', function() {
        if (this.value. length === 0) {
            passwordMatch. textContent = '';
            return;
        }

        if (this.value === passwordInput.value) {
            passwordMatch.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i> Les mots de passe correspondent';
        } else {
            passwordMatch. innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i> Les mots de passe ne correspondent pas';
        }
    });
});
</script>
@endpush