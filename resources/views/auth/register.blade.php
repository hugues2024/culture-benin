@extends('layouts.app1')
@section('title', 'Inscription - Culture Bénin')
@section('content')
    <div class="container mt-4 mb-4">
        <div class="card shadow-sm custom-card mx-auto">
            <!-- Header avec Logo -->
            <div class="card-header text-white custom-card-header">
                <div class="text-center">
                    <img src="{{ asset('img/logo1.png') }}" alt="Logo Culture Bénin" class="header-logo mb-2">
                    <h5 class="mb-0 fw-bold">Créer un compte</h5>
                    <p class="mb-0 small opacity-90">Rejoignez notre communauté culturelle</p>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="card-body p-3 p-md-4">
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
                    <div class="text-center mb-3">
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
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label for="nom" class="form-label fw-semibold small"><i class="bi bi-person"></i> Nom <span class="text-danger">*</span></label>
                            <input type="text" name="nom" id="nom" class="form-control form-control-sm @error('nom') is-invalid @enderror" placeholder="Votre nom" value="{{ old('nom') }}" required>
                            @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="prenom" class="form-label fw-semibold small"><i class="bi bi-person"></i> Prénom <span class="text-danger">*</span></label>
                            <input type="text" name="prenom" id="prenom" class="form-control form-control-sm @error('prenom') is-invalid @enderror" placeholder="Votre prénom" value="{{ old('prenom') }}" required>
                            @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Sexe -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small"><i class="bi bi-gender-ambiguous"></i> Sexe <span class="text-danger">*</span></label>
                        <div class="d-flex gap-2">
                            <div class="form-check form-check-inline flex-fill">
                                <input class="form-check-input" type="radio" name="sexe" id="homme" value="masculin" {{ old('sexe') == 'masculin' ? 'checked' : '' }} required>
                                <label class="form-check-label w-100 small" for="homme">
                                    <i class="bi bi-gender-male"></i> Masculin
                                </label>
                            </div>
                            <div class="form-check form-check-inline flex-fill">
                                <input class="form-check-input" type="radio" name="sexe" id="femme" value="feminin" {{ old('sexe') == 'feminin' ? 'checked' : '' }} required>
                                <label class="form-check-label w-100 small" for="femme">
                                    <i class="bi bi-gender-female"></i> Féminin
                                </label>
                            </div>
                        </div>
                        @error('sexe')<div class="text-danger small mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                    <!-- Date de naissance / Langue -->
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label for="date_naissance" class="form-label fw-semibold small"><i class="bi bi-calendar"></i> Date de naissance <span class="text-danger">*</span></label>
                            <input type="date" name="date_naissance" id="date_naissance" class="form-control form-control-sm @error('date_naissance') is-invalid @enderror" value="{{ old('date_naissance') }}" max="{{ date('Y-m-d', strtotime('-13 years')) }}" required>
                            <div class="form-text small">Au moins 13 ans</div>
                            @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="langue_id" class="form-label fw-semibold small"><i class="bi bi-translate"></i> Langue principale <span class="text-danger">*</span></label>
                            <select name="langue_id" id="langue_id" class="form-select form-select-sm @error('langue_id') is-invalid @enderror" required>
                                <option value="">-- Sélectionnez --</option>
                                @forelse($langues ??  [] as $langue)
                                    <option value="{{ $langue->id }}" {{ old('langue_id') == $langue->id ? 'selected' : '' }}>
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
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold small"><i class="bi bi-envelope"></i> Adresse Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="votre@email.com" value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Mot de passe / Confirmation -->
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label fw-semibold small"><i class="bi bi-lock-fill"></i> Mot de passe <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Min.  8 caractères" minlength="8" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            <div class="form-text small">Maj., min.  et chiffres</div>
                            @error('password')<div class="text-danger small mt-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                            <!-- Force du mot de passe -->
                            <div class="password-strength mt-2">
                                <div class="progress" style="height: 3px;">
                                    <div class="progress-bar" id="strengthBar" role="progressbar" style="width: 0%"></div>
                                </div>
                                <small id="strengthText" class="text-muted">Force</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-semibold small"><i class="bi bi-lock-fill"></i> Confirmer <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirmez" minlength="8" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                    <i class="bi bi-eye" id="toggleIconConfirm"></i>
                                </button>
                            </div>
                            <div id="passwordMatch" class="small mt-2"></div>
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                            <label class="form-check-label small" for="terms">
                                J'accepte les <a href="#" class="text-decoration-none">conditions d'utilisation</a> et la <a href="#" class="text-decoration-none">politique de confidentialité</a> <span class="text-danger">*</span>
                            </label>
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mt-3 pt-3 border-top">
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left"></i> Se connecter
                        </a>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-check-circle"></i> Créer mon compte
                        </button>
                    </div>
                </form>

                <!-- Security Notice -->
                <div class="text-center mt-3 pt-3 border-top">
                    <small class="text-muted">
                        <i class="bi bi-shield-check text-success"></i>
                        Vos données sont protégées
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        body {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            min-height: 100vh;
        }

        .custom-card {
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
            max-width: 650px;
            margin-top: 1rem;
            background: white;
        }

        .custom-card-header {
            background: linear-gradient(135deg, #008751, #006b40);
            padding: 1. 25rem 1rem;
        }

        .header-logo {
            height: 40px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        }

        .card-body {
            background: #ffffff;
        }

        /* Photo Preview - Plus compact */
        .photo-preview-wrapper {
            position: relative;
            display: inline-block;
        }

        .photo-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            border: 2px dashed #008751;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2. 5rem;
            color: #008751;
        }

        .photo-preview-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #008751;
            position: absolute;
            top: 0;
            left: 0;
        }

        /* Form Controls - Plus compacts */
        .form-label {
            color: #1b5e20;
            font-size: 0.8125rem;
            margin-bottom: 0.25rem;
            font-weight: 600;
        }

        .form-control, .form-select {
            border-radius: 6px;
            border: 1. 5px solid #a5d6a7;
            padding: 0.375rem 0.625rem;
            transition: all 0.2s;
            font-size: 0.875rem;
            background: #f1f8f4;
        }

        .form-control-sm, .form-select-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.8125rem;
        }

        .form-control:focus, . form-select:focus {
            border-color: #008751;
            box-shadow: 0 0 0 0.2rem rgba(0,135,81,0.15);
            background: white;
        }

        .is-invalid {
            border-color: #d32f2f !important;
            background: #ffebee !important;
        }

        .invalid-feedback, .text-danger {
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* Radio Buttons - Plus compacts */
        .form-check-inline {
            border: 1.5px solid #a5d6a7;
            border-radius: 6px;
            padding: 0.375rem 0.75rem;
            transition: all 0.2s;
            background: #f1f8f4;
        }

        .form-check-input {
            border-color: #008751;
        }

        . form-check-input:checked {
            background-color: #008751;
            border-color: #008751;
        }

        .form-check-input:checked ~ .form-check-label {
            color: #006b40;
            font-weight: 700;
        }

        . form-check-inline:has(. form-check-input:checked) {
            border-color: #008751;
            background: linear-gradient(135deg, rgba(0,135,81,0.1), rgba(0,135,81,0.05));
            box-shadow: 0 2px 6px rgba(0,135,81,0.12);
        }

        /* Buttons - Plus compacts */
        . btn-primary {
            background: linear-gradient(135deg, #008751, #006b40);
            border: none;
            font-weight: 700;
            font-size: 0.875rem;
            padding: 0. 5rem 1. 25rem;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(0,135,81,0.25);
        }

        .btn-sm {
            padding: 0. 375rem 1rem;
            font-size: 0.8125rem;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,135,81,0.35);
            background: linear-gradient(135deg, #006b40, #004d2e);
        }

        .btn-outline-primary, .btn-outline-danger {
            font-weight: 600;
            font-size: 0.8125rem;
            padding: 0.375rem 0.875rem;
        }

        .btn-outline-secondary {
            border-color: #008751;
            color: #008751;
            font-weight: 600;
            background: rgba(0,135,81,0.05);
        }

        .btn-outline-secondary:hover {
            background: #008751;
            color: white;
            border-color: #008751;
        }

        /* Alerts - Plus compacts */
        . alert-danger {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            border-left: 3px solid #d32f2f;
            color: #b71c1c;
            padding: 0.75rem 1rem;
            font-size: 0.8125rem;
        }

        .alert ul {
            margin-bottom: 0;
            padding-left: 1.25rem;
        }

        /* Password Strength - Plus compact */
        .password-strength . progress {
            background: #e8f5e9;
            height: 3px;
        }

        .password-strength . progress-bar {
            transition: all 0.3s;
        }

        . password-strength . progress-bar[data-strength="weak"] {
            width: 33%;
            background: linear-gradient(90deg, #ff5252, #f44336);
        }

        .password-strength .progress-bar[data-strength="medium"] {
            width: 66%;
            background: linear-gradient(90deg, #ffb74d, #ffa726);
        }

        .password-strength .progress-bar[data-strength="strong"] {
            width: 100%;
            background: linear-gradient(90deg, #66bb6a, #43a047);
        }

        /* Form Text - Plus compact */
        .form-text {
            color: #2e7d32;
            font-weight: 500;
            font-size: 0.7rem;
            margin-top: 0.125rem;
        }

        . text-muted {
            color: #1b5e20 !important;
            font-size: 0.75rem;
        }

        /* Borders */
        .border-top {
            border-color: #a5d6a7 !important;
        }

        /* Input Group - Plus compact */
        . input-group-sm . btn-outline-secondary {
            border: 1.5px solid #a5d6a7;
            border-left: 1.5px solid #a5d6a7 !important;
            color: #008751 !important;
            background: #ffffff !important;
            font-weight: 700;
            padding: 0.25rem 0.5rem;
            transition: all 0.2s;
        }

        .input-group . btn-outline-secondary:hover {
            background: #008751 !important;
            color: white !important;
            border-color: #008751 !important;
        }

        . input-group . btn-outline-secondary i {
            color: #008751 !important;
            font-size: 1rem ! important;
        }

        . input-group .btn-outline-secondary:hover i {
            color: white !important;
        }

        /* Checkbox - Plus compact */
        .form-check-input {
            border: 1.5px solid #008751;
            width: 1rem;
            height: 1rem;
        }

        .form-check-input:checked {
            background-color: #008751;
            border-color: #008751;
        }

        /* Links */
        a. text-decoration-none {
            color: #008751;
            font-weight: 600;
        }

        a. text-decoration-none:hover {
            color: #006b40;
            text-decoration: underline ! important;
        }

        /* Security Notice */
        .text-success {
            color: #2e7d32 !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .custom-card {
                margin: 0.5rem;
                max-width: 100%;
            }

            .card-body {
                padding: 1rem ! important;
            }

            . header-logo {
                height: 35px;
            }

            . custom-card-header {
                padding: 1rem 0.75rem;
            }

            . custom-card-header h5 {
                font-size: 1rem;
            }

            .form-check-inline {
                width: 100%;
                text-align: center;
                margin-bottom: 0.5rem;
            }

            .photo-preview, .photo-preview-img {
                width: 70px;
                height: 70px;
            }

            . photo-preview {
                font-size: 2rem;
            }

            .btn-sm {
                padding: 0. 375rem 0.875rem;
                font-size: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .custom-card {
                border-radius: 8px;
                margin: 0.25rem;
            }

            . card-body {
                padding: 0.75rem !important;
            }

            .row. g-2 {
                gap: 0.5rem !important;
            }

            .mb-3 {
                margin-bottom: 0.75rem ! important;
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
                        photoPreview. style.display = 'none';
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
                    icon.classList.replace('bi-eye-slash', 'bi-eye');
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
            const strengthText = document.getElementById('strengthText');

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
                strengthText.textContent = password. length > 0 ? `${labels[Math.min(strength, 4)]}` : 'Force';
            });

            // Password Match
            const passwordConfirm = document.getElementById('password_confirmation');
            const passwordMatch = document.getElementById('passwordMatch');

            passwordConfirm.addEventListener('input', function() {
                if (this.value. length === 0) {
                    passwordMatch. textContent = '';
                    return;
                }

                if (this. value === passwordInput.value) {
                    passwordMatch.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i> Correspond';
                } else {
                    passwordMatch. innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i> Ne correspond pas';
                }
            });
        });
    </script>
@endpush
