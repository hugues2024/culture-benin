@extends('layouts.app1')

@section('title', 'Vérification Email - Culture Bénin')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="card shadow-sm custom-card mx-auto">
            <!-- Header avec Logo -->
            <div class="card-header text-white custom-card-header bg-success">
                <div class="text-center" style="backgrounf-color: #F0C43B;">
                    <img src="{{ asset('img/logo1.png') }}" alt="Logo Culture Bénin" class="header-logo mb-2">
                    <h4 class="mb-0 fw-bold">Vérifiez votre email</h4>
                    <p class="mb-0 small opacity-90">Dernière étape</p>
                </div>
            </div>

            <!-- Contenu -->
            <div class="card-body p-4">
                <!-- Icon Email -->
                <div class="text-center mb-3">
                    <i class="bi bi-envelope-check email-icon"></i>
                </div>

                <!-- Message de statut -->
                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Email envoyé !  </strong> Vérifiez votre boîte mail. 
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Message principal -->
                <div class="text-center mb-3">
                    <h6 class="mb-2" style="color: #F0C43B;">
                        <i class="bi bi-check-circle-fill text-success"></i> Inscription réussie ! 
                    </h6>
                    <p class="text-muted small mb-0">
                        Un email de vérification a été envoyé à <strong>{{ auth()->user()->email }}</strong>
                    </p>
                </div>

                <!-- Warning Box -->
                <div class="alert alert-warning py-2 px-3 mb-3">
                    <small>
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        <strong>Pas reçu ?  </strong> Vérifiez vos spams. 
                    </small>
                </div>

                <!-- Formulaire renvoyer -->
                <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-arrow-repeat"></i> Renvoyer l'email
                    </button>
                </form>

                <!-- Instructions -->
                <div class="p-3 bg-light rounded mb-3">
                    <h6 class="mb-2 small">
                        <i class="bi bi-lightbulb text-warning"></i> Comment vérifier ? 
                    </h6>
                    <ol class="small mb-0 ps-3">
                        <li>Ouvrez votre boîte mail</li>
                        <li>Cherchez l'email de Culture Bénin</li>
                        <li>Cliquez sur "Vérifier mon email"</li>
                    </ol>
                </div>

                <!-- Déconnexion -->
                <div class="text-center pt-2 border-top">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link btn-sm text-decoration-none">
                            <i class="bi bi-box-arrow-right"></i> Se déconnecter
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Security Notice -->
        <div class="text-center mt-3">
            <small class="text-muted">
                <i class="bi bi-shield-check text-success"></i>
                Vos données sont sécurisées
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
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        max-width: 480px;
        margin-top: 2rem;
        background: white;
    }

    . custom-card-header {
        background: linear-gradient(135deg, #F0C43B, #F0C43B);
        padding: 1rem 0.875rem;
    }

    .header-logo {
        height: 40px;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        margin-bottom: 0.375rem ! important;
    }

    .custom-card-header h4 {
        font-size: 1rem !important;
        margin-bottom: 0.125rem !important;
    }

    .custom-card-header p {
        font-size: 0.75rem !important;
    }

    .card-body {
        padding: 1.5rem ! important;
        background: #ffffff;
    }

    /* Email Icon */
    .email-icon {
        font-size: 3. 5rem;
        color: #F0C43B;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* Buttons */
    .btn-primary {
        background: linear-gradient(135deg, #F0C43B, #F0C43B);
        border: none;
        font-weight: 700;
        font-size: 0.875rem;
        padding: 0.625rem 1.25rem;
        transition: all 0.2s;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,135,81,0.3);
    }

    .btn-link {
        color: #F0C43B !important;
        font-weight: 600;
        font-size: 0.8125rem;
    }

    .btn-link:hover {
        color: #F0C43B !important;
    }

    /* Alerts */
    .alert-success {
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        border-left: 3px solid #F0C43B;
        color: #F0C43B;
        font-size: 0.8125rem;
        padding: 0.625rem 0.875rem;
    }

    .alert-warning {
        background: linear-gradient(135deg, #fff9e6, #fffbf0);
        border-left: 3px solid #ffc107;
        color: #856404;
        font-size: 0.8125rem;
    }

    /* Instructions */
    .bg-light {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef) ! important;
        border: 1px solid #dee2e6;
    }

    . bg-light ol {
        margin-bottom: 0;
        padding-left: 1.25rem;
    }

    .bg-light li {
        margin-bottom: 0. 25rem;
        color: #495057;
    }

    /* Border */
    .border-top {
        border-color: #a5d6a7 !important;
    }

    /* Responsive */
    @media (max-width: 576px) {
        .custom-card {
            margin-top: 1rem;
        }

        .card-body {
            padding: 1.25rem !important;
        }

        .email-icon {
            font-size: 3rem;
        }

        .header-logo {
            height: 35px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('. alert-dismissible');
        alerts.forEach(alert => {
            setTimeout(() => {
                const closeBtn = alert.querySelector('.btn-close');
                if (closeBtn) closeBtn.click();
            }, 5000);
        });
    });
</script>
@endpush