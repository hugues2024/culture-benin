@extends('layout')

@section('title')
    Détail du contenu
@endsection

@section('content')
    <div class="card custom-card mb-4">
        <!-- Header -->
        <div class="custom-card-header">
            <div class="card-title">
                <i class="bi bi-journal-text me-2"></i>
                Détails du contenu
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            <div class="row g-4">
                <!-- Colonne gauche - Informations principales -->
                <div class="col-lg-8">
                    <!-- Titre principal -->
                    <div class="content-title-section mb-4">
                        <div class="title-icon">
                            <i class="bi bi-card-text"></i>
                        </div>
                        <div>
                            <span class="title-label">Titre du contenu</span>
                            <h2 class="content-main-title">{{ $contenu->titre }}</h2>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="info-section mb-4">
                        <h6 class="section-title">
                            <i class="bi bi-pencil-square me-2"></i>Description
                        </h6>
                        <div class="content-description">
                            <p class="mb-0">{{ $contenu->texte }}</p>
                        </div>
                    </div>

                    <!-- Métadonnées - SANS HEURE -->
                    <div class="info-section">
                        <h6 class="section-title">
                            <i class="bi bi-info-circle-fill me-2"></i>Informations complémentaires
                        </h6>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-calendar-event-fill"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Date de création</span>
                                        <span class="info-value-large">{{ $contenu->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-clock-history"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Dernière modification</span>
                                        <span class="info-value-large">{{ $contenu->updated_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite - Badges et métadonnées -->
                <div class="col-lg-4">
                    <div class="metadata-card">
                        <h6 class="metadata-title">
                            <i class="bi bi-tags-fill me-2"></i>Informations clés
                        </h6>

                        <!-- Auteur -->
                        <div class="metadata-item-box">
                            <div class="metadata-icon bg-info-light">
                                <i class="bi bi-person-fill text-info"></i>
                            </div>
                            <div class="metadata-content">
                                <span class="metadata-label">Auteur</span>
                                <span class="metadata-value">{{ $contenu->auteur->nom ??  'N/A' }} {{ $contenu->auteur->prenom ??  '' }}</span>
                            </div>
                        </div>

                        <!-- Région -->
                        <div class="metadata-item-box">
                            <div class="metadata-icon bg-secondary-light">
                                <i class="bi bi-geo-alt-fill text-secondary"></i>
                            </div>
                            <div class="metadata-content">
                                <span class="metadata-label">Région</span>
                                <span class="metadata-value">{{ $contenu->region->nom_region ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <!-- Langue -->
                        <div class="metadata-item-box">
                            <div class="metadata-icon bg-purple-light">
                                <i class="bi bi-translate text-purple"></i>
                            </div>
                            <div class="metadata-content">
                                <span class="metadata-label">Langue</span>
                                <span class="metadata-value">{{ $contenu->langue->nom_langue ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <!-- Type de contenu -->
                        <div class="metadata-item-box">
                            <div class="metadata-icon bg-warning-light">
                                <i class="bi bi-folder-fill text-warning"></i>
                            </div>
                            <div class="metadata-content">
                                <span class="metadata-label">Type de contenu</span>
                                <span class="metadata-value">{{ $contenu->type_contenu->nom ??  'N/A' }}</span>
                            </div>
                        </div>

                        <!-- Statut -->
                        <div class="metadata-item-box">
                            <div class="metadata-icon {{ $contenu->statut === 'publié' ? 'bg-success-light' : 'bg-danger-light' }}">
                                <i class="bi bi-toggle-on {{ $contenu->statut === 'publié' ? 'text-success' : 'text-danger' }}"></i>
                            </div>
                            <div class="metadata-content">
                                <span class="metadata-label">Statut</span>
                                @if($contenu->statut === 'publié')
                                    <span class="badge-status badge-status-published">
                                        <i class="bi bi-check-circle-fill"></i> Publié
                                    </span>
                                @elseif($contenu->statut === 'brouillon')
                                    <span class="badge-status badge-status-draft">
                                        <i class="bi bi-pencil-fill"></i> Brouillon
                                    </span>
                                @else
                                    <span class="badge-status badge-status-archived">
                                        <i class="bi bi-archive-fill"></i> {{ ucfirst($contenu->statut) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer avec actions -->
        <div class="custom-footer">
            <a href="{{ route('contenus.index') }}" class="btn-cancel-custom">
                <i class="bi bi-arrow-left-circle"></i> Retour à la liste
            </a>

            <div class="d-flex gap-2">
                <a href="{{ route('contenus.edit', $contenu->id) }}" class="btn-warning-custom">
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
       CONTENT TITLE SECTION
    ======================================== */
    .content-title-section {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        padding: 25px;
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        border-radius: 12px;
        border-left: 5px solid #F0C43B;
    }

    .title-icon {
        flex-shrink: 0;
        width: 60px;
        height: 60px;
        border-radius: 12px;
        background: linear-gradient(135deg, #F0C43B, #F0C43B);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }

    .title-label {
        display: block;
        font-size: 0.75rem;
        color: #F0C43B;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    . content-main-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #1e3a8a;
        margin: 0;
        line-height: 1.3;
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
       INFO ITEM MODERN - VERSION ALIGNÉE
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

    .info-item-modern::before {
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

    /* Icône bleue */
    .info-icon {
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
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        transition: all 0.3s ease;
    }

    .info-item-modern:hover .info-icon {
        transform: rotate(5deg) scale(1.05);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
    }

    . info-content {
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
       METADATA CARD
    ======================================== */
    . metadata-card {
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        position: sticky;
        top: 20px;
    }

    .metadata-title {
        color: #F0C43B;
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 1. 5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
    }

    .metadata-item-box {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px;
        background: white;
        border-radius: 10px;
        margin-bottom: 12px;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .metadata-item-box:hover {
        border-color: #F0C43B;
        transform: translateX(5px);
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.1);
    }

    .metadata-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .bg-info-light { background: #dbeafe; }
    .bg-secondary-light { background: #e5e7eb; }
    . bg-purple-light { background: #ede9fe; }
    .bg-warning-light { background: #fef3c7; }
    .bg-success-light { background: #d1fae5; }
    .bg-danger-light { background: #fee2e2; }

    . text-purple { color: #7c3aed; }

    .metadata-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    . metadata-label {
        font-size: 0.7rem;
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .metadata-value {
        font-size: 0.95rem;
        color: #1f2937;
        font-weight: 700;
    }

    /* ========================================
       BADGE STATUS
    ======================================== */
    .badge-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0. 8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .badge-status-published {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .badge-status-draft {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }

    .badge-status-archived {
        background: linear-gradient(135deg, #6b7280, #4b5563);
        color: white;
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
        .metadata-card {
            position: relative;
            top: 0;
            margin-bottom: 1. 5rem;
        }

        .content-title-section {
            flex-direction: column;
            text-align: center;
        }

        .title-icon {
            margin: 0 auto;
        }

        .content-main-title {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .custom-footer {
            flex-direction: column;
            gap: 12px;
        }

        .custom-footer > * {
            width: 100%;
        }

        .btn-cancel-custom,
        . btn-warning-custom {
            width: 100%;
            justify-content: center;
        }

        .content-main-title {
            font-size: 1.25rem;
        }
    }
</style>
@endpush
