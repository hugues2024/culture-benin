@extends('layouts.app1')

@section('title', 'Connexion - Culture Bénin')

@section('content')
    <div class="auth-page">
        <!-- Hero Section -->
        <section class="auth-hero">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 text-center">
                        <h1 class="auth-hero__title">Connectez-vous</h1>
                        <p class="auth-hero__subtitle">Accédez à votre espace personnel pour contribuer à la culture
                            béninoise</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Formulaire de connexion -->
        <section class="auth-form-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="auth-card">
                            <div class="auth-card__body">
                                <!-- Session Status -->
                                @if (session('status'))
                                    <div class="alert alert--success" role="alert">
                                        <div class="alert__content">
                                            <i class="fas fa-check-circle alert__icon" aria-hidden="true"></i>
                                            <span>{{ session('status') }}</span>
                                        </div>
                                        <button type="button" class="alert__close" data-bs-dismiss="alert"
                                            aria-label="Fermer l'alerte">
                                            <i class="fas fa-times" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}" class="auth-form" novalidate>
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="form-group">
                                        <label for="email" class="form-label">
                                            Adresse Email
                                            <span class="form-label__required" aria-label="requis">*</span>
                                        </label>
                                        <div class="input-group {{ $errors->has('email') ? 'input-group--error' : '' }}">
                                            <span class="input-group__icon" aria-hidden="true">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                                required autofocus autocomplete="email" class="input-group__field"
                                                placeholder="votre@email.com" aria-required="true"
                                                aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                                                aria-describedby="{{ $errors->has('email') ? 'email-error' : '' }}">
                                        </div>
                                        @error('email')
                                            <div class="form-error" id="email-error" role="alert">
                                                <i class="fas fa-exclamation-circle form-error__icon" aria-hidden="true"></i>
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <label for="password" class="form-label">
                                            Mot de passe
                                            <span class="form-label__required" aria-label="requis">*</span>
                                        </label>
                                        <div class="input-group {{ $errors->has('password') ? 'input-group--error' : '' }}">
                                            <span class="input-group__icon" aria-hidden="true">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input id="password" type="password" name="password" required
                                                autocomplete="current-password" class="input-group__field"
                                                placeholder="Votre mot de passe" aria-required="true"
                                                aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                                                aria-describedby="{{ $errors->has('password') ? 'password-error' : '' }}">
                                            <button type="button" class="input-group__toggle-password"
                                                aria-label="Afficher le mot de passe" data-toggle-password>
                                                <i class="fas fa-eye" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="form-error" id="password-error" role="alert">
                                                <i class="fas fa-exclamation-circle form-error__icon" aria-hidden="true"></i>
                                                <span>{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Remember Me & Forgot Password -->
                                    <div class="form-options">
                                        <div class="form-checkbox">
                                            <input id="remember_me" type="checkbox" class="form-checkbox__input"
                                                name="remember">
                                            <label for="remember_me" class="form-checkbox__label">
                                                Se souvenir de moi
                                            </label>
                                        </div>

                                        @if (Route::has('password.request'))
                                            <a class="form-link" href="{{ route('password.request') }}">
                                                Mot de passe oublié ?
                                            </a>
                                        @endif
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-submit">
                                        <button type="submit" class="btn btn--primary btn--large btn--full">
                                            <i class="fas fa-sign-in-alt btn__icon" aria-hidden="true"></i>
                                            <span>Se connecter</span>
                                        </button>
                                    </div>

                                    <!-- Register Link -->
                                    @if (Route::has('register'))
                                        <div class="form-footer">
                                            <p class="form-footer__text">
                                                Pas encore de compte ?
                                                <a href="{{ route('register') }}" class="form-footer__link">
                                                    Créer un compte
                                                </a>
                                            </p>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>

                        <!-- Features rapides -->
                        <div class="auth-features">
                            <h2 class="auth-features__title">Pourquoi créer un compte ?</h2>
                            <div class="auth-features__grid">
                                <div class="feature-item">
                                    <i class="fas fa-plus-circle feature-item__icon" aria-hidden="true"></i>
                                    <span class="feature-item__text">Contribuer</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-heart feature-item__icon" aria-hidden="true"></i>
                                    <span class="feature-item__text">Favoris</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-comments feature-item__icon" aria-hidden="true"></i>
                                    <span class="feature-item__text">Commenter</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        /* ========================================
       CSS VARIABLES
    ======================================== */
        :root {
            /* Colors */
            --benin-green: #008751;
            --benin-green-dark: #006b40;
            --benin-green-light: #00a862;
            --benin-yellow: #FCD116;

            /* Neutrals */
            --color-white: #ffffff;
            --color-gray-50: #f8f9fa;
            --color-gray-100: #e9ecef;
            --color-gray-200: #dee2e6;
            --color-gray-300: #ced4da;
            --color-gray-600: #6c757d;
            --color-gray-700: #495057;
            --color-gray-900: #212529;

            /* Semantic */
            --color-error: #dc3545;
            --color-success: #28a745;

            /* Spacing */
            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-2xl: 3rem;
            --spacing-3xl: 4rem;

            /* Border Radius */
            --radius-sm: 0.5rem;
            --radius-md: 0.75rem;
            --radius-lg: 1rem;
            --radius-xl: 1.25rem;

            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);

            /* Transitions */
            --transition-fast: 150ms ease-in-out;
            --transition-base: 250ms ease-in-out;
            --transition-slow: 350ms ease-in-out;

            /* Typography */
            --font-weight-normal: 400;
            --font-weight-medium: 500;
            --font-weight-semibold: 600;
            --font-weight-bold: 700;
        }

        /* ========================================
       AUTH PAGE LAYOUT
    ======================================== */
        .auth-page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background-color: var(--color-gray-50);
        }

        /* ========================================
       HERO SECTION
    ======================================== */
        .auth-hero {
            background: linear-gradient(135deg, rgba(0, 135, 81, 0.95), rgba(0, 107, 64, 0.95)),
                url('{{ asset('img/Bio.jpg') }}') center/cover no-repeat;
            padding: clamp(4rem, 10vh, 6.25rem) 0 clamp(3rem, 8vh, 5rem);
            position: relative;
            flex-shrink: 0;
        }

        .auth-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at top right, transparent 0%, rgba(0, 0, 0, 0.15) 100%);
        }

        .auth-hero .container {
            position: relative;
            z-index: 1;
        }

        .auth-hero__title {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: var(--font-weight-bold);
            color: var(--color-white);
            margin-bottom: var(--spacing-md);
            line-height: 1.2;
        }

        .auth-hero__subtitle {
            font-size: clamp(1rem, 2vw, 1.25rem);
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 0;
            line-height: 1.6;
        }

        /* ========================================
       FORM SECTION
    ======================================== */
        .auth-form-section {
            padding: var(--spacing-2xl) 0 var(--spacing-3xl);
            flex: 1;
        }

        /* ========================================
       AUTH CARD
    ======================================== */
        .auth-card {
            background: var(--color-white);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-xl);
            margin-top: -5rem;
            position: relative;
            z-index: 10;
            overflow: hidden;
            border: 1px solid var(--color-gray-100);
        }

        .auth-card__body {
            padding: clamp(2rem, 5vw, 3rem);
        }

        /* ========================================
       ALERTS
    ======================================== */
        .alert {
            border-radius: var(--radius-md);
            border: none;
            padding: var(--spacing-md) var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .alert--success {
            background-color: rgba(40, 167, 69, 0.1);
            border-left: 4px solid var(--color-success);
        }

        .alert__content {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            color: var(--color-success);
            font-weight: var(--font-weight-medium);
        }

        .alert__icon {
            font-size: 1.25rem;
        }

        .alert__close {
            background: none;
            border: none;
            color: var(--color-success);
            font-size: 1.25rem;
            cursor: pointer;
            padding: var(--spacing-xs);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-sm);
            transition: all var(--transition-fast);
        }

        .alert__close:hover {
            background-color: rgba(40, 167, 69, 0.15);
        }

        /* ========================================
       FORM STYLES
    ======================================== */
        .auth-form {
            width: 100%;
        }

        .form-group {
            margin-bottom: var(--spacing-lg);
        }

        .form-label {
            display: block;
            font-weight: var(--font-weight-semibold);
            color: var(--color-gray-900);
            margin-bottom: var(--spacing-sm);
            font-size: 0.9375rem;
        }

        .form-label__required {
            color: var(--color-error);
            margin-left: var(--spacing-xs);
        }

        /* ========================================
       INPUT GROUPS
    ======================================== */
        .input-group {
            position: relative;
            display: flex;
            align-items: stretch;
            width: 100%;
            border: 2px solid var(--color-gray-200);
            border-radius: var(--radius-md);
            transition: all var(--transition-base);
            background-color: var(--color-white);
        }

        .input-group:focus-within {
            border-color: var(--benin-green);
            box-shadow: 0 0 0 4px rgba(0, 135, 81, 0.1);
        }

        .input-group--error {
            border-color: var(--color-error);
        }

        .input-group--error:focus-within {
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1);
        }

        .input-group__icon {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 var(--spacing-md);
            background-color: var(--color-gray-50);
            color: var(--color-gray-600);
            border-right: 1px solid var(--color-gray-200);
            transition: all var(--transition-fast);
            min-width: 3rem;
        }

        .input-group:focus-within .input-group__icon {
            color: var(--benin-green);
            background-color: rgba(0, 135, 81, 0.05);
        }

        .input-group__field {
            flex: 1;
            border: none;
            padding: 0.875rem var(--spacing-md);
            font-size: 1rem;
            color: var(--color-gray-900);
            background: transparent;
            outline: none;
            min-height: 3rem;
        }

        .input-group__field::placeholder {
            color: var(--color-gray-600);
            opacity: 0.7;
        }

        .input-group__toggle-password {
            background: none;
            border: none;
            color: var(--color-gray-600);
            cursor: pointer;
            padding: 0 var(--spacing-md);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-fast);
            min-width: 3rem;
        }

        .input-group__toggle-password:hover {
            color: var(--benin-green);
        }

        .input-group__toggle-password:focus {
            outline: 2px solid var(--benin-green);
            outline-offset: -2px;
        }

        /* ========================================
       FORM ERROR
    ======================================== */
        .form-error {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            color: var(--color-error);
            font-size: 0.875rem;
            margin-top: var(--spacing-sm);
            font-weight: var(--font-weight-medium);
        }

        .form-error__icon {
            flex-shrink: 0;
        }

        /* ========================================
       FORM OPTIONS
    ======================================== */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--spacing-xl);
            gap: var(--spacing-md);
            flex-wrap: wrap;
        }

        /* ========================================
       FORM CHECKBOX
    ======================================== */
        .form-checkbox {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
        }

        .form-checkbox__input {
            width: 1.125rem;
            height: 1.125rem;
            border: 2px solid var(--color-gray-300);
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all var(--transition-fast);
            accent-color: var(--benin-green);
        }

        .form-checkbox__input:checked {
            background-color: var(--benin-green);
            border-color: var(--benin-green);
        }

        .form-checkbox__input:focus {
            outline: 2px solid var(--benin-green);
            outline-offset: 2px;
        }

        .form-checkbox__label {
            color: var(--color-gray-700);
            font-size: 0.9375rem;
            cursor: pointer;
            user-select: none;
            margin-bottom: 0;
        }

        /* ========================================
       FORM LINK
    ======================================== */
        .form-link {
            color: var(--benin-green);
            text-decoration: none;
            font-weight: var(--font-weight-semibold);
            font-size: 0.9375rem;
            transition: all var(--transition-fast);
            position: relative;
        }

        .form-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--benin-green);
            transition: width var(--transition-base);
        }

        .form-link:hover {
            color: var(--benin-green-dark);
        }

        .form-link:hover::after {
            width: 100%;
        }

        .form-link:focus {
            outline: 2px solid var(--benin-green);
            outline-offset: 2px;
            border-radius: var(--radius-sm);
        }

        /* ========================================
       BUTTONS
    ======================================== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: var(--spacing-sm);
            font-weight: var(--font-weight-semibold);
            text-decoration: none;
            border: none;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all var(--transition-base);
            font-size: 1rem;
            line-height: 1.5;
            white-space: nowrap;
            user-select: none;
        }

        .btn:focus {
            outline: 2px solid var(--benin-green);
            outline-offset: 2px;
        }

        .btn--primary {
            background: linear-gradient(135deg, var(--benin-green), var(--benin-green-dark));
            color: var(--color-white);
            box-shadow: var(--shadow-md);
        }

        .btn--primary:hover {
            background: linear-gradient(135deg, var(--benin-green-dark), var(--benin-green));
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 135, 81, 0.3);
        }

        .btn--primary:active {
            transform: translateY(0);
            box-shadow: var(--shadow-sm);
        }

        .btn--large {
            padding: 1rem var(--spacing-xl);
            font-size: 1.125rem;
        }

        .btn--full {
            width: 100%;
        }

        .btn__icon {
            font-size: 1.125rem;
        }

        /* ========================================
       FORM SUBMIT
    ======================================== */
        .form-submit {
            margin-bottom: var(--spacing-lg);
        }

        /* ========================================
       FORM FOOTER
    ======================================== */
        .form-footer {
            text-align: center;
            padding-top: var(--spacing-lg);
            border-top: 1px solid var(--color-gray-200);
        }

        .form-footer__text {
            color: var(--color-gray-600);
            margin-bottom: 0;
            font-size: 0.9375rem;
        }

        .form-footer__link {
            color: var(--benin-green);
            text-decoration: none;
            font-weight: var(--font-weight-semibold);
            transition: all var(--transition-fast);
        }

        .form-footer__link:hover {
            color: var(--benin-green-dark);
            text-decoration: underline;
        }

        /* ========================================
       AUTH FEATURES
    ======================================== */
        .auth-features {
            margin-top: var(--spacing-3xl);
            text-align: center;
        }

        .auth-features__title {
            font-size: 1.25rem;
            font-weight: var(--font-weight-semibold);
            color: var(--benin-green);
            margin-bottom: var(--spacing-lg);
        }

        .auth-features__grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: var(--spacing-lg);
        }

        .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--spacing-sm);
            padding: var(--spacing-md);
            border-radius: var(--radius-md);
            transition: all var(--transition-base);
        }

        .feature-item:hover {
            background-color: var(--color-gray-50);
            transform: translateY(-4px);
        }

        .feature-item__icon {
            font-size: 1.5rem;
            color: var(--benin-green);
        }

        .feature-item__text {
            font-size: 0.875rem;
            color: var(--color-gray-700);
            font-weight: var(--font-weight-medium);
        }

        /* ========================================
       RESPONSIVE DESIGN
    ======================================== */
        @media (max-width: 768px) {
            .auth-hero {
                padding: 4rem 0 3rem;
            }

            .auth-card {
                margin-top: -3rem;
                border-radius: var(--radius-lg);
            }

            .auth-card__body {
                padding: 1.5rem;
            }

            .form-options {
                flex-direction: column;
                align-items: flex-start;
            }

            .auth-features__grid {
                grid-template-columns: 1fr;
                gap: var(--spacing-md);
            }
        }

        /* ========================================
       ACCESSIBILITY
    ======================================== */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Amélioration du contraste pour les modes haute accessibilité */
        @media (prefers-contrast: high) {
            .input-group {
                border-width: 3px;
            }

            .btn--primary {
                background: var(--benin-green);
            }
        }
    </style>

    <script>
        // Toggle Password Visibility
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('[data-toggle-password]');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                        this.setAttribute('aria-label', 'Masquer le mot de passe');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                        this.setAttribute('aria-label', 'Afficher le mot de passe');
                    }
                });
            });

            // Auto-dismiss alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const closeButton = alert.querySelector('.alert__close');
                    if (closeButton) {
                        closeButton.click();
                    }
                }, 5000);
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ========================================
            // SWEETALERT2 TOAST CONFIGURATION
            // ========================================
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                customClass: {
                    popup: 'custom-toast',
                    title: 'custom-toast-title',
                    timerProgressBar: 'custom-toast-progressbar'
                }
            });

            // ========================================
            // CHECK FOR BACKEND MESSAGES
            // ========================================

            // Message de succès
            @if (session('success'))
                Toast.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: "{{ session('success') }}",
                    background: '#d4edda',
                    iconColor: '#155724',
                    color: '#155724'
                });
            @endif

            // Message d'erreur
            @if (session('error'))
                Toast.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: "{{ session('error') }}",
                    background: '#f8d7da',
                    iconColor: '#721c24',
                    color: '#721c24'
                });
            @endif

            // Message de statut (email vérifié, etc.)
            @if (session('success'))
                Toast.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: "{{ session('success') }}",
                    background: '#d4edda',
                    iconColor: '#155724',
                    color: '#155724'
                });
            @endif

            // Message d'avertissement
            @if (session('warning'))
                Toast.fire({
                    icon: 'warning',
                    title: 'Attention',
                    text: "{{ session('warning') }}",
                    background: '#fff3cd',
                    iconColor: '#856404',
                    color: '#856404'
                });
            @endif

            // Erreurs de validation
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur de validation',
                    html: '<ul style="text-align: left; padding-left: 20px;">' +
                        @foreach ($errors->all() as $error)
                            '<li>{{ $error }}</li>' +
                        @endforeach
                    '</ul>',
                    confirmButtonText: 'Compris',
                    confirmButtonColor: '#008751',
                    customClass: {
                        popup: 'custom-swal',
                        confirmButton: 'custom-swal-button'
                    }
                });
            @endif

            // ========================================
            // TOGGLE PASSWORD VISIBILITY
            // ========================================
            const toggleButtons = document.querySelectorAll('[data-toggle-password]');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                        this.setAttribute('aria-label', 'Masquer le mot de passe');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                        this.setAttribute('aria-label', 'Afficher le mot de passe');
                    }
                });
            });
        });
    </script>

    <style>
        /* ========================================
       SWEETALERT2 CUSTOM STYLES
    ======================================== */
        .custom-toast {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif !important;
            border-radius: 0.75rem !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15) !important;
            padding: 1rem 1.5rem !important;
        }

        .custom-toast-title {
            font-size: 0.9375rem !important;
            font-weight: 600 !important;
            margin: 0 !important;
        }

        .custom-toast-progressbar {
            background: rgba(0, 0, 0, 0.2) !important;
        }

        .custom-swal {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif !important;
            border-radius: 1rem !important;
        }

        .custom-swal-button {
            border-radius: 0.5rem !important;
            padding: 0.75rem 2rem !important;
            font-weight: 600 !important;
        }

        /* Animation pour les toasts */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .swal2-toast.swal2-show {
            animation: slideInRight 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
    </style>
@endsection
