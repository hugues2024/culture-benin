@extends('layout')

@section('title')
    Information sur une région
@endsection

@section('content')
    <div class="card custom-card mb-4">
        <!-- Header -->
        <div class="custom-card-header">
            <div class="card-title">
                <i class="bi bi-geo-alt-fill me-2"></i>
                Détails de la région
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            <div class="row g-4">
                <!-- Colonne gauche - Image et titre -->
                <div class="col-lg-4">
                    <div class="region-profile-card">
                        <div class="region-image-wrapper">
                            <img src="https://cdn-icons-png. flaticon.com/512/854/854878.png"
                                 alt="{{ $region->nom_region }}"
                                 class="region-image">
                        </div>
                        <h4 class="region-name mt-3">{{ $region->nom_region }}</h4>
                        <div class="region-stats mt-3">
                            <div class="stat-item">
                                <i class="bi bi-people-fill"></i>
                                <div>
                                    <span class="stat-value">{{ number_format($region->population) }}</span>
                                    <span class="stat-label">Habitants</span>
                                </div>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-bounding-box-circles"></i>
                                <div>
                                    <span class="stat-value">{{ number_format($region->superficie, 2) }}</span>
                                    <span class="stat-label">km²</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite - Informations détaillées -->
                <div class="col-lg-8">
                    <!-- Section Informations générales -->
                    <div class="info-section mb-4">
                        <h6 class="section-title">
                            <i class="bi bi-info-circle-fill me-2"></i>Informations générales
                        </h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-tag-fill"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Nom de la région</span>
                                        <span class="info-value-large">{{ $region->nom_region }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Localisation</span>
                                        <span class="info-value-large">{{ $region->localisation ??   'Non spécifiée' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section Description -->
                    <div class="info-section mb-4">
                        <h6 class="section-title">
                            <i class="bi bi-text-left me-2"></i>Description
                        </h6>
                        <div class="content-description">
                            <p class="mb-0">{{ $region->description_region ?? 'Aucune description disponible pour cette région.' }}</p>
                        </div>
                    </div>

                    <!-- Section Statistiques -->
                    <div class="info-section">
                        <h6 class="section-title">
                            <i class="bi bi-graph-up me-2"></i>Statistiques
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-people-fill"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Population</span>
                                        <span class="info-value-large">{{ number_format($region->population) }} habitants</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-bounding-box-circles"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Superficie</span>
                                        <span class="info-value-large">{{ number_format($region->superficie, 2) }} km²</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer avec actions -->
        <div class="custom-footer">
            <a href="{{ route('regions.index') }}" class="btn-cancel-custom">
                <i class="bi bi-arrow-left-circle"></i> Retour à la liste
            </a>

            <div class="d-flex gap-2">
                <a href="{{ route('regions.edit', $region->id) }}" class="btn-warning-custom">
                    <i class="bi bi-pencil-square"></i> Modifier
                </a>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* ========================================
       CARD MODERN
    ======================================== */
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
        padding: 20px;
    }

    .custom-card-header .card-title {
        font-size: 19px;
        font-weight: 600;
        margin: 0;
    }

    /* ========================================
       REGION PROFILE CARD
    ======================================== */
    .region-profile-card {
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        padding: 30px 20px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        text-align: center;
    }

    .region-image-wrapper {
        width: 150px;
        height: 150px;
        margin: 0 auto;
        border-radius: 50%;
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15);
        transition: all 0.3s ease;
    }

    .region-image-wrapper:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 28px rgba(37, 99, 235, 0.25);
    }

    .region-image {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }

    .region-name {
        color: #1e3a8a;
        font-weight: 800;
        font-size: 1.5rem;
        margin-bottom: 0;
    }

    /* Stats Cards */
    .region-stats {
        display: flex;
        gap: 12px;
        justify-content: center;
    }

    .stat-item {
        background: white;
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 1;
        transition: all 0.2s ease;
    }

    .stat-item:hover {
        border-color: #F0C43B;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0. 1);
        transform: translateY(-2px);
    }

    .stat-item i {
        font-size: 1.8rem;
        color: #F0C43B;
    }

    .stat-item div {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .stat-value {
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.7rem;
        color: #6b7280;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    /* ========================================
       SECTION TITLE
    ======================================== */
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

    /* ========================================
       INFO ITEM MODERN
    ======================================== */
    .info-item-modern {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 20px;
        background: linear-gradient(135deg, #ffffff, #f8fafc);
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    . info-item-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #F0C43B, #F0C43B);
        transform: scaleY(0);
        transition: transform 0.3s ease;
        transform-origin: top;
    }

    .info-item-modern:hover::before {
        transform: scaleY(1);
    }

    .info-item-modern:hover {
        border-color: #F0C43B;
        background: linear-gradient(135deg, #ffffff, #dbeafe);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15);
        transform: translateY(-4px) translateX(4px);
    }

    . info-icon {
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: linear-gradient(135deg, #F0C43B, #F0C43B);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.4rem;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0. 3);
        transition: all 0.3s ease;
    }

    .info-item-modern:hover .info-icon {
        transform: rotate(5deg) scale(1.05);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
    }

    .info-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
        justify-content: center;
    }

    .info-label-small {
        font-size: 0.7rem;
        color: #6b7280;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1. 2px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .info-label-small::before {
        content: '';
        width: 20px;
        height: 2px;
        background: linear-gradient(90deg, #F0C43B, transparent);
        display: inline-block;
    }

    .info-value-large {
        font-size: 1.1rem;
        color: #1f2937;
        font-weight: 700;
        line-height: 1.2;
        transition: all 0.3s ease;
    }

    .info-item-modern:hover .info-value-large {
        color: #F0C43B;
    }

    /* ========================================
       CONTENT DESCRIPTION
    ======================================== */
    .content-description {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 10px;
        border-left: 3px solid #F0C43B;
    }

    .content-description p {
        font-size: 1rem;
        line-height: 1.7;
        color: #4b5563;
    }

    /* ========================================
       BUTTONS
    ======================================== */
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

    . btn-cancel-custom:hover {
        transform: translateY(-2px);
        background: #5a6268;
        color: white;
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
    }

    .btn-warning-custom {
        background: linear-gradient(135deg, #f59e0b, #d97706);
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
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .btn-warning-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
        color: white;
    }

    /* ========================================
       FOOTER
    ======================================== */
    .custom-footer {
        padding: 20px 25px;
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        border-top: 2px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* ========================================
       RESPONSIVE
    ======================================== */
    @media (max-width: 992px) {
        .region-profile-card {
            margin-bottom: 1. 5rem;
        }

        .region-stats {
            flex-direction: column;
        }
    }

    @media (max-width: 768px) {
        .custom-footer {
            flex-direction: column;
            gap: 12px;
        }

        . custom-footer > * {
            width: 100%;
        }

        .btn-cancel-custom,
        .btn-warning-custom {
            width: 100%;
            justify-content: center;
        }

        .region-image-wrapper {
            width: 120px;
            height: 120px;
        }

        . region-image {
            width: 80px;
            height: 80px;
        }

        .region-name {
            font-size: 1.25rem;
        }
    }
</style>
@endpush
