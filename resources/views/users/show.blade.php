@extends('layout')

@section('title')
    Informations de l'utilisateur
@endsection

@section('content')
    <div class="card custom-card mb-4">
        <!-- Header -->
        <div class="custom-card-header">
            <div class="card-title">
                <i class="bi bi-person-lines-fill me-2"></i>
                Information sur {{ $user->nom }} {{ $user->prenom }}
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            <div class="row g-4">
                <!-- Photo utilisateur + Info rapide -->
                <div class="col-lg-3">
                    <div class="user-profile-card">
                        @if($user->photo)
                            <div class="photo-wrapper shadow-lg mx-auto">
                                <img src="{{ asset('storage/' . $user->photo) }}"
                                     alt="Photo de {{ $user->nom }}"
                                     class="img-fluid w-100 h-100 object-fit-cover">
                            </div>
                        @else
                            <div class="photo-wrapper bg-gradient-light d-flex align-items-center justify-content-center mx-auto shadow-lg">
                                <i class="bi bi-person-circle" style="font-size: 5rem; color: #94a3b8;"></i>
                            </div>
                        @endif
                        
                        <div class="text-center mt-3">
                            <h5 class="mb-1 fw-bold">{{ $user->prenom }} {{ $user->nom }}</h5>
                            <p class="text-muted small mb-2">
                                <i class="bi bi-envelope me-1"></i>{{ Str::limit($user->email, 25) }}
                            </p>
                            @if($user->statut === 'actif')
                                <span class="badge-status badge-status-active">
                                    <i class="bi bi-check-circle-fill"></i> Compte actif
                                </span>
                            @else
                                <span class="badge-status badge-status-inactive">
                                    <i class="bi bi-x-circle-fill"></i> Compte inactif
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Informations détaillées -->
                <div class="col-lg-9">
                    <!-- Section Informations personnelles -->
                    <div class="info-section mb-4">
                        <h6 class="section-title">
                            <i class="bi bi-person-badge me-2"></i>Informations personnelles
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Nom complet</span>
                                        <span class="info-value-large">{{ $user->nom }} {{ $user->prenom }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-envelope-fill"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Email</span>
                                        <span class="info-value-large">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-calendar-fill"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Date de naissance</span>
                                        <span class="info-value-large">{{ optional($user->date_naissance)->format('d/m/Y') ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-gender-ambiguous"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Sexe</span>
                                        <span class="info-value-large">{{ ucfirst($user->sexe ?? '-') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Compte -->
                    <div class="info-section">
                        <h6 class="section-title">
                            <i class="bi bi-gear-fill me-2"></i>Paramètres du compte
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-shield-fill-check"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Rôle</span>
                                        <span class="badge-role mt-1">{{ $user->role->nom ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-translate"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Langue</span>
                                        <span class="info-value-large">{{ $user->langue->nom_langue ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-toggle-on"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Statut</span>
                                        @if($user->statut === 'actif')
                                            <span class="badge-status badge-status-active mt-1">
                                                <i class="bi bi-check-circle-fill"></i> Actif
                                            </span>
                                        @else
                                            <span class="badge-status badge-status-inactive mt-1">
                                                <i class="bi bi-x-circle-fill"></i> Inactif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="custom-footer">
            <a href="{{ route('users.index') }}" class="btn-cancel-custom">
                <i class="bi bi-arrow-left-circle"></i> Retour
            </a>

            <a href="{{ route('users.edit', $user->id) }}" class="btn-primary-custom">
                <i class="bi bi-pencil-square"></i> Éditer
            </a>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* Card modern */
    .custom-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        overflow: hidden;
        width: 100%;
        max-width: 100%;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #F0C43B, #F0C43B);
        color: white;
        padding: 20px 20px;
    }

    .custom-card-header . card-title {
        font-size: 19px;
        font-weight: 600;
        margin: 0;
    }

    /* User Profile Card */
    .user-profile-card {
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        padding: 30px 20px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    /* Photo */
    .photo-wrapper {
        border-radius: 50%;
        overflow: hidden;
        width: 180px;
        height: 180px;
        border: 5px solid #ffffff;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15);
        transition: all 0.3s ease;
    }

    .photo-wrapper:hover {
        transform: scale(1.08) rotate(3deg);
        box-shadow: 0 12px 28px rgba(37, 99, 235, 0.25);
    }

    . bg-gradient-light {
        background: linear-gradient(135deg, #e0e7ff, #dbeafe);
    }

    /* Section Title */
    .section-title {
        color: #F0C43B;
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
    }

    /* Info Item Modern */
    .  info-item-modern {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 16px;
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
        height: 100%;
    }

    . info-item-modern:hover {
        border-color: #F0C43B;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0. 1);
        transform: translateY(-2px);
    }

    .  info-icon {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #F0C43B;
        font-size: 1.2rem;
    }

    .info-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    . info-label-small {
        font-size: 0.75rem;
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    . info-value-large {
        font-size: 1rem;
        color: #1f2937;
        font-weight: 600;
        word-break: break-word;
    }

    /* Badges */
    .badge-role {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0. 85rem;
        font-weight: 700;
        display: inline-block;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0. 8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .badge-status-active {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .badge-status-inactive {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }

    /* Buttons */
    .btn-primary-custom {
        background: linear-gradient(135deg, #F0C43B, #F0C43B);
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 700;
        color: white;
        transition: all 0.2s ease-in-out;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .btn-primary-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        color: white;
    }

    .btn-cancel-custom {
        background: #6c757d;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 700;
        color: white;
        transition: all 0.2s ease-in-out;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-cancel-custom:hover {
        transform: translateY(-2px);
        background: #5a6268;
        color: white;
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }

    /* Footer */
    .custom-footer {
        padding: 20px 25px;
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        border-top: 2px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .user-profile-card {
            margin-bottom: 1. 5rem;
        }

        .photo-wrapper {
            width: 150px;
            height: 150px;
        }
    }

    @media (max-width: 768px) {
        .info-item-modern {
            flex-direction: row;
        }

        .custom-footer {
            flex-direction: column;
            gap: 12px;
        }

        .btn-primary-custom,
        .btn-cancel-custom {
            width: 100%;
            justify-content: center;
        }

        .photo-wrapper {
            width: 130px;
            height: 130px;
        }
    }
</style>
@endpush
