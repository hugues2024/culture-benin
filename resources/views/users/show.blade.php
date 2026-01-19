@extends('layout')

@section('title')
    Informations de l'utilisateur
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="mb-4">
                <a href="{{ route('users.index') }}" class="text-decoration-none text-muted small fw-bold">
                    <i class="bi bi-chevron-left"></i> RETOUR À LA LISTE
                </a>
            </div>

            <div class="card google-card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="row g-0">
                        
                        <div class="col-lg-4 bg-light border-end p-5 text-center">
                            <div class="profile-avatar-container mb-4">
                                @if($user->photo)
                                    <img src="{{ asset('storage/' . $user->photo) }}" 
                                         class="profile-image-lg shadow" 
                                         alt="Photo de {{ $user->nom }}">
                                @else
                                    <div class="profile-image-lg bg-white d-flex align-items-center justify-content-center shadow-sm mx-auto">
                                        <i class="bi bi-person text-primary" style="font-size: 4rem;"></i>
                                    </div>
                                @endif
                                
                                @if($user->statut === 'actif')
                                    <span class="status-indicator-online" title="Compte Actif"></span>
                                @endif
                            </div>

                            <h4 class="fw-bold text-dark mb-1">{{ $user->prenom }} {{ $user->nom }}</h4>
                            <p class="text-muted mb-3">{{ $user->role->nom ?? 'Sans rôle' }}</p>
                            
                            <div class="d-grid gap-2">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary rounded-pill shadow-sm">
                                    <i class="bi bi-pencil-square me-2"></i>Modifier le profil
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-8 p-5">
                            <h5 class="text-primary text-uppercase small fw-bold mb-4 pb-2 border-bottom">
                                <i class="bi bi-info-circle me-2"></i>Informations détaillées
                            </h5>

                            <div class="row mb-5 g-4">
                                <div class="col-md-6">
                                    <label class="text-muted x-small fw-bold text-uppercase d-block mb-1">Adresse Email</label>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-envelope text-primary me-2"></i>
                                        <span class="text-dark">{{ $user->email }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="text-muted x-small fw-bold text-uppercase d-block mb-1">Genre</label>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-gender-ambiguous text-primary me-2"></i>
                                        <span class="text-dark">{{ ucfirst($user->sexe ?? 'Non défini') }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="text-muted x-small fw-bold text-uppercase d-block mb-1">Date de naissance</label>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-balloon text-primary me-2"></i>
                                        <span class="text-dark">{{ optional($user->date_naissance)->format('d F Y') ?? 'Non renseignée' }}</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="text-muted x-small fw-bold text-uppercase d-block mb-1">Langue préférée</label>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-translate text-primary me-2"></i>
                                        <span class="text-dark">{{ $user->langue->nom_langue ?? 'Par défaut' }}</span>
                                    </div>
                                </div>
                            </div>

                            <h5 class="text-primary text-uppercase small fw-bold mb-4 pb-2 border-bottom">
                                <i class="bi bi-shield-lock me-2"></i>Sécurité & Statut
                            </h5>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-light-subtle">
                                        <label class="text-muted x-small fw-bold text-uppercase d-block mb-2">Statut du compte</label>
                                        @if($user->statut === 'actif')
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                                                <i class="bi bi-check-circle-fill me-1"></i> Utilisateur Actif
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill">
                                                <i class="bi bi-dash-circle-fill me-1"></i> Compte Inactif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-3 bg-light-subtle">
                                        <label class="text-muted x-small fw-bold text-uppercase d-block mb-2">Dernière mise à jour</label>
                                        <span class="text-dark small">
                                            <i class="bi bi-clock-history me-1 text-muted"></i> 
                                            {{ $user->updated_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Base */
    body { background-color: #f8f9fa; font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
    .x-small { font-size: 0.7rem; letter-spacing: 0.8px; }

    /* Card Google Style */
    .google-card {
        border-radius: 20px;
        overflow: hidden;
        background: #ffffff;
    }

    /* Avatar Design */
    .profile-avatar-container {
        position: relative;
        display: inline-block;
    }
    .profile-image-lg {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #fff;
    }
    .status-indicator-online {
        position: absolute;
        bottom: 10px;
        right: 15px;
        width: 20px;
        height: 20px;
        background-color: #00c853;
        border: 3px solid #fff;
        border-radius: 50%;
    }

    /* Typography & Colors */
    .text-primary { color: #1a73e8 !important; }
    .bg-light { background-color: #f8f9fb !important; }
    .bg-light-subtle { background-color: #fafbfc !important; }

    /* Buttons */
    .btn-primary {
        background-color: #1a73e8;
        border: none;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #174ea6;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(26, 115, 232, 0.3);
    }

    /* Layout responsive */
    @media (max-width: 991.98px) {
        .border-end { border-end: none !important; border-bottom: 1px solid #dee2e6 !important; }
    }
</style>
@endpush
