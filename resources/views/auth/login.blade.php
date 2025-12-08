@extends('layouts.app1')

@section('title', 'Connexion - Culture Bénin')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="card shadow-sm custom-card mx-auto">
            <!-- Header avec Logo -->
            <div class="card-header text-white custom-card-header">
                <div class="text-center">
                    <img src="{{ asset('img/logo1.png') }}" alt="Logo Culture Bénin" class="header-logo mb-2">
                    <h4 class="mb-0 fw-bold">Connectez-vous</h4>
                    <p class="mb-0 small opacity-90">Accédez à votre espace personnel</p>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="card-body p-4">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>{{ session('status') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Erreur :</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            <i class="bi bi-envelope"></i> Adresse Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" placeholder="votre@email.com"
                            value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            <i class="bi bi-lock-fill"></i> Mot de passe <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Votre mot de passe" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="text-danger small mt-1">
                                <i class="bi bi-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                            <label class="form-check-label small" for="remember_me">
                                Se souvenir de moi
                            </label>
                        </div>
                        @if (Route::has('password. request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none small">
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-green w-100 mb-3">
                        <i class="bi bi-box-arrow-in-right"></i> Se connecter
                    </button>

                    <!-- Register Link -->
                    @if (Route::has('register'))
                        <div class="text-center pt-3 border-top">
                            <small class="text-muted">
                                Pas encore de compte ?
                                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">
                                    Créer un compte
                                </a>
                            </small>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Security Notice -->
        <div class="text-center mt-4">
            <small class="text-muted">
                <i class="bi bi-shield-check text-success"></i>
                Vos données sont protégées et sécurisées
            </small>
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
            border-radius: 16px;
            overflow: hidden;
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            max-width: 420px;
            margin: 2rem auto 0;
            background: white;
        }

        .custom-card-header {
            background: linear-gradient(135deg, #ceb772ff, #ceb772ff);
            padding: 1.25rem 1rem;
        }

        .header-logo {
            height: 45px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
            margin-bottom: 0.5rem ! important;
        }

        .custom-card-header h4 {
            font-size: 1. 125rem !important;
            margin-bottom: 0.25rem !important;
        }

        .custom-card-header p {
            font-size: 0.8125rem !important;
        }

        .card-body {
            padding: 2rem ! important;
            background: #ffffff;
        }

        /* Form Controls */
        .form-label {
            color: #ceb772ff;
            font-size: 0.9rem;
            margin-bottom: 0.375rem;
            font-weight: 600;
        }

        .form-control,
        . form-select {
            border-radius: 8px;
            border: 2px solid #ceb772ff;
            padding: 0.625rem 0.875rem;
            transition: all 0.2s;
            font-size: 0.9375rem;
            background: #f1f8f4;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #ceb772ff;
            box-shadow: 0 0 0 0.25rem rgba(0, 135, 81, 0.2);
            background: white;
        }

        .is-invalid {
            border-color: #d32f2f ! important;
            background: #ffebee !important;
        }

        .invalid-feedback,
        . text-danger {
            font-size: 0.8125rem;
            font-weight: 500;
        }

        /* Checkbox */
        .form-check-input {
            border: 2px solid #ceb772ffceb772ffceb772ffceb772ffceb772ffceb772ff;
        }

        .form-check-input:checked {
            background-color: #ceb772ffceb772ffceb772ffceb772ffceb772ffceb772ff;
            border-color: #ceb772ffceb772ffceb772ffceb772ffceb772ffceb772ff;
        }

        /* Buttons */
        .btn-green {
            background: linear-gradient(135deg, #ceb772ffceb772ffceb772ffceb772ffceb772ff, #ceb772ffceb772ffceb772ffceb772ffceb772ff);
            border: none;
            font-weight: 700;
            font-size: 0.9375rem;
            padding: 0.75rem 1.75rem;
            transition: all 0.2s;
            box-shadow: 0 3px 10px #ceb772ff
        }

        .btn-green:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px ceb772ff;
            background: linear-gradient(135deg, #ceb772ff, #ceb772ff);
        }

        /* Input Group - Icône visible */
        .input-group . btn-outline-secondary {
            border: 2px solid #a5d6a7;
            border-left: 2px solid #a5d6a7 !important;
            color: #ceb772ffceb772ffceb772ffceb772ff !important;
            background: #ffffff ! important;
            font-weight: 700;
            padding: 0.625rem 0.875rem;
            transition: all 0.2s;
        }

        . input-group .btn-outline-secondary:hover {
            background: #ceb772ffceb772ffceb772ff !important;
            color: white !important;
            border-color: #ceb772ffceb772ffceb772ff !important;
        }

        . input-group .btn-outline-secondary i {
            color: #ceb772ffceb772ff !important;
            font-size: 1.25rem !important;
        }

        .input-group .btn-outline-secondary:hover i {
            color: white !important;
        }

        /* Alerts */
        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border-left: 4px solid #ceb772ff;
            color: #155724;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            border-left: 4px solid #d32f2f;
            color: #b71c1c;
        }

        /* Links */
        a. text-decoration-none {
            color: #ceb772ff;
            font-weight: 600;
        }

        a.text-decoration-none:hover {
            color: #ceb772ff;
            text-decoration: underline ! important;
        }

        /* Borders */
        .border-top {
            border-color: #a5d6a7 !important;
        }

        /* Security Notice */
        .text-success {
            color: #ceb772ff !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .custom-card {
                margin-top: 1rem;
            }

            . card-body {
                padding: 1.5rem !important;
            }

            .header-logo {
                height: 40px;
            }

            . custom-card-header {
                padding: 1.5rem 1rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle Password Visibility
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    if (password.type === 'password') {
                        password.type = 'text';
                        toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
                    } else {
                        password.type = 'password';
                        toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
                    }
                });
            }

            // Auto-dismiss alerts
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const closeButton = alert.querySelector('.btn-close');
                    if (closeButton) {
                        closeButton.click();
                    }
                }, 5000);
            });
        });
    </script>
@endpush
