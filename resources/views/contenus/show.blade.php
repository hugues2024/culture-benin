@extends('layout')

@section('title')
    Détail du contenu
@endsection

@section('content')
<div class="container-fluid py-4"> <nav aria-label="breadcrumb" class="mb-4">

    <div class="card google-card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3 border-bottom position-relative">
            <div class="header-accent-line"></div>
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0 fw-bold text-dark">
                    <i class="bi bi-journal-text text-primary me-2"></i>
                    Détails du contenu
                </h4>
                <span class="text-muted small">ID: #{{ $contenu->id }}</span>
            </div>
        </div>

        <div class="card-body p-4 p-lg-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="mb-5">
                        <label class="text-uppercase small fw-bold text-muted letter-spacing-1 mb-2 d-block">Titre du contenu</label>
                        <h1 class="display-6 fw-bold text-dark mb-0">{{ $contenu->titre }}</h1>
                    </div>

                    <div class="info-block mb-5">
                        <h5 class="fw-bold border-start border-4 border-primary ps-3 mb-4 text-dark">
                            <i class="bi bi-pencil-square me-2"></i>Description / Texte
                        </h5>
                        <div class="bg-light p-4 rounded-4 shadow-sm border">
                            <p class="lead text-secondary mb-0" style="white-space: pre-line; line-height: 1.8;">
                                {{ $contenu->texte }}
                            </p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center bg-white border rounded-4 p-3 shadow-sm h-100">
                                <div class="icon-circle bg-primary-subtle text-primary me-3">
                                    <i class="bi bi-calendar-event-fill"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Date de création</small>
                                    <span class="fw-bold">{{ $contenu->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center bg-white border rounded-4 p-3 shadow-sm h-100">
                                <div class="icon-circle bg-warning-subtle text-warning me-3">
                                    <i class="bi bi-clock-history"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Dernière modification</small>
                                    <span class="fw-bold">{{ $contenu->updated_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border shadow-sm rounded-4 sticky-top" style="top: 20px;">
                        <div class="card-header bg-light fw-bold text-dark py-3 border-bottom rounded-top-4">
                            <i class="bi bi-tags-fill me-2"></i>Informations clés
                        </div>
                        <div class="card-body p-4">
                            
                            <div class="metadata-row d-flex align-items-center mb-4">
                                <div class="icon-square bg-info-subtle text-info me-3">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Auteur</small>
                                    <span class="fw-bold text-dark">{{ $contenu->auteur->nom ?? 'N/A' }} {{ $contenu->auteur->prenom ?? '' }}</span>
                                </div>
                            </div>

                            <div class="metadata-row d-flex align-items-center mb-4">
                                <div class="icon-square bg-danger-subtle text-danger me-3">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Région</small>
                                    <span class="fw-bold text-dark">{{ $contenu->region->nom_region ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <div class="metadata-row d-flex align-items-center mb-4">
                                <div class="icon-square bg-primary-subtle text-primary me-3">
                                    <i class="bi bi-translate"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Langue</small>
                                    <span class="fw-bold text-dark">{{ $contenu->langue->nom_langue ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <div class="metadata-row d-flex align-items-center mb-4">
                                <div class="icon-square bg-secondary-subtle text-secondary me-3">
                                    <i class="bi bi-folder-fill"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Type de contenu</small>
                                    <span class="fw-bold text-dark">{{ $contenu->type_contenu->nom ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="text-center">
                                <p class="small text-muted mb-2">Statut actuel</p>
                                @if($contenu->statut === 'publié')
                                    <div class="badge-status bg-success-subtle text-success py-2 px-4 rounded-pill d-inline-block fw-bold border border-success border-opacity-25">
                                        <i class="bi bi-check-circle-fill me-2"></i>Publié
                                    </div>
                                @elseif($contenu->statut === 'brouillon')
                                    <div class="badge-status bg-secondary-subtle text-secondary py-2 px-4 rounded-pill d-inline-block fw-bold border border-secondary border-opacity-25">
                                        <i class="bi bi-pencil-fill me-2"></i>Brouillon
                                    </div>
                                @else
                                    <div class="badge-status bg-danger-subtle text-danger py-2 px-4 rounded-pill d-inline-block fw-bold">
                                        <i class="bi bi-archive-fill me-2"></i>Archivé
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light border-top py-4 px-lg-5 d-flex flex-wrap gap-3 justify-content-between align-items-center">
            <a href="{{ route('contenus.index') }}" class="btn btn-outline-dark rounded-pill px-4">
                <i class="bi bi-arrow-left-circle me-2"></i>Retour à la liste
            </a>

            <div class="d-flex gap-2">
                <a href="{{ route('contenus.edit', $contenu->id) }}" class="btn btn-warning rounded-pill px-4 fw-bold shadow-sm">
                    <i class="bi bi-pencil-square me-2"></i>Modifier le contenu
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Carte Google Style */
    .google-card { border-radius: 16px; background: #fff; }
    .header-accent-line {
        position: absolute; top: 0; left: 0; right: 0; height: 4px;
        background: linear-gradient(90deg, #1a73e8, #4285f4);
        border-radius: 16px 16px 0 0;
    }

    /* Icônes de statistiques */
    .icon-circle {
        width: 48px; height: 48px; display: flex;
        align-items: center; justify-content: center; border-radius: 50%;
        font-size: 1.25rem;
    }
    .icon-square {
        width: 42px; height: 42px; display: flex;
        align-items: center; justify-content: center; border-radius: 10px;
        font-size: 1.1rem;
    }

    /* Couleurs Subtiles */
    .bg-primary-subtle { background-color: #e8f0fe !important; color: #1a73e8 !important; }
    .bg-warning-subtle { background-color: #fef7e0 !important; color: #f29900 !important; }
    .bg-info-subtle { background-color: #e4f7fb !important; color: #007b83 !important; }
    .bg-danger-subtle { background-color: #fce8e6 !important; color: #d93025 !important; }
    .bg-secondary-subtle { background-color: #f1f3f4 !important; color: #5f6368 !important; }
    .bg-success-subtle { background-color: #e6f4ea !important; color: #1e8e3e !important; }

    /* Texte et badges */
    .letter-spacing-1 { letter-spacing: 1px; }
    .rounded-4 { border-radius: 12px !important; }
    .sticky-top { z-index: 10; }

    /* Boutons */
    .btn-warning { background-color: #f4b400; border-color: #f4b400; color: #fff; }
    .btn-warning:hover { background-color: #e3a600; color: #fff; }
</style>
@endpush
