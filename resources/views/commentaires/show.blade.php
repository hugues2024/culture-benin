@extends('layout')

@section('title')
    Détail d'un commentaire
@endsection

@section('content')
    <div class="card custom-card mb-4">
        <!-- Header -->
        <div class="custom-card-header">
            <div class="card-title">
                <i class="bi bi-chat-left-text me-2"></i>
                Détails du commentaire
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            <div class="row g-4">
                <!-- Colonne gauche - Utilisateur et Note -->
                <div class="col-lg-4">
                    <!-- User Card -->
                    <div class="user-comment-card">
                        <div class="user-avatar">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <h5 class="user-name">{{ $commentaire->user->prenom }} {{ $commentaire->user->nom }}</h5>
                        <span class="user-role">Auteur du commentaire</span>

                        <!-- Note -->
                        <div class="rating-section mt-4">
                            <span class="rating-label">Évaluation</span>
                            <div class="stars-display">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $commentaire->note)
                                        <i class="bi bi-star-fill star-filled"></i>
                                    @else
                                        <i class="bi bi-star star-empty"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="rating-value">{{ $commentaire->note }}/5</span>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite - Contenu et infos -->
                <div class="col-lg-8">
                    <!-- Section Commentaire -->
                    <div class="info-section mb-4">
                        <h6 class="section-title">
                            <i class="bi bi-chat-dots-fill me-2"></i>Commentaire
                        </h6>
                        <div class="comment-content">
                            <p class="mb-0">{{ $commentaire->commentaire ?? 'Aucun texte fourni.' }}</p>
                        </div>
                    </div>

                    <!-- Section Contenu associé -->
                    <div class="info-section mb-4">
                        <h6 class="section-title">
                            <i class="bi bi-folder2-open me-2"></i>Contenu associé
                        </h6>
                        <div class="info-item-modern">
                            <div class="info-icon">
                                <i class="bi bi-file-text-fill"></i>
                            </div>
                            <div class="info-content">
                                <span class="info-label-small">Titre du contenu</span>
                                <span class="info-value-large">{{ $commentaire->contenu->titre }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Section Dates -->
                    <div class="info-section">
                        <h6 class="section-title">
                            <i class="bi bi-clock-history me-2"></i>Informations temporelles
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-calendar-plus-fill"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Date de création</span>
                                        <span class="info-value-large">{{ $commentaire->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item-modern">
                                    <div class="info-icon">
                                        <i class="bi bi-calendar-check-fill"></i>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label-small">Dernière modification</span>
                                        <span class="info-value-large">{{ $commentaire->updated_at->format('d/m/Y') }}</span>
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
            <a href="{{ route('commentaires.index') }}" class="btn-cancel-custom">
                <i class="bi bi-arrow-left-circle"></i> Retour à la liste
            </a>

            <div class="d-flex gap-2">
                <a href="{{ route('commentaires.edit', $commentaire->id) }}" class="btn-warning-custom">
                    <i class="bi bi-pencil-square"></i> Modifier
                </a>

                <form action="{{ route('commentaires.destroy', $commentaire->id) }}" 
                      method="POST" 
                      class="delete-form d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger-custom">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                </form>
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
        background: linear-gradient(135deg, #2563eb, #1e40af);
        color: white;
        padding: 20px;
    }

    .custom-card-header .card-title {
        font-size: 19px;
        font-weight: 600;
        margin: 0;
    }

    /* ========================================
       USER COMMENT CARD
    ======================================== */
    .user-comment-card {
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        padding: 30px 20px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        text-align: center;
        position: sticky;
        top: 20px;
    }

    .user-avatar {
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
        border-radius: 50%;
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15);
    }

    .user-avatar i {
        font-size: 5rem;
        color: #2563eb;
    }

    .user-name {
        color: #1e3a8a;
        font-weight: 800;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .user-role {
        display: inline-block;
        padding: 4px 12px;
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        color: #1e40af;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Rating Section */
    .rating-section {
        padding: 20px;
        background: white;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
    }

    .rating-label {
        display: block;
        font-size: 0.7rem;
        color: #6b7280;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1. 2px;
        margin-bottom: 10px;
    }

    .stars-display {
        display: flex;
        justify-content: center;
        gap: 4px;
        margin-bottom: 10px;
    }

    .star-filled {
        color: #fbbf24;
        font-size: 1.5rem;
    }

    .star-empty {
        color: #d1d5db;
        font-size: 1.5rem;
    }

    .rating-value {
        display: block;
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e40af;
    }

    /* ========================================
       SECTION TITLE
    ======================================== */
    .section-title {
        color: #1e40af;
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
    }

    /* ========================================
       COMMENT CONTENT
    ======================================== */
    .comment-content {
        padding: 20px;
        background: linear-gradient(135deg, #f8f9fa, #ffffff);
        border-radius: 10px;
        border-left: 4px solid #2563eb;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    .comment-content p {
        font-size: 1rem;
        line-height: 1.7;
        color: #4b5563;
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
        background: linear-gradient(180deg, #2563eb, #1e40af);
        transform: scaleY(0);
        transition: transform 0.3s ease;
        transform-origin: top;
    }

    .info-item-modern:hover::before {
        transform: scaleY(1);
    }

    .info-item-modern:hover {
        border-color: #2563eb;
        background: linear-gradient(135deg, #ffffff, #dbeafe);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15);
        transform: translateY(-4px) translateX(4px);
    }

    . info-icon {
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2563eb, #1e40af);
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
        letter-spacing: 1.2px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .info-label-small::before {
        content: '';
        width: 20px;
        height: 2px;
        background: linear-gradient(90deg, #2563eb, transparent);
        display: inline-block;
    }

    .info-value-large {
        font-size: 1.1rem;
        color: #1f2937;
        font-weight: 700;
        line-height: 1.2;
        transition: all 0.3s ease;
    }

    . info-item-modern:hover . info-value-large {
        color: #1e40af;
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

    .btn-cancel-custom:hover {
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

    .btn-danger-custom {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 700;
        color: white;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0. 3);
    }

    . btn-danger-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
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
        .user-comment-card {
            position: relative;
            top: 0;
            margin-bottom: 1. 5rem;
        }
    }

    @media (max-width: 768px) {
        . custom-footer {
            flex-direction: column;
            gap: 12px;
        }

        .custom-footer > * {
            width: 100%;
        }

        .btn-cancel-custom,
        .btn-warning-custom,
        .btn-danger-custom {
            width: 100%;
            justify-content: center;
        }

        .user-avatar {
            width: 100px;
            height: 100px;
        }

        .user-avatar i {
            font-size: 4rem;
        }

        .user-name {
            font-size: 1.1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Confirmation suppression
    document.querySelector('.delete-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        let form = this;
        
        if(typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Êtes-vous sûr ? ',
                text: "Le commentaire sera définitivement supprimé.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result. isConfirmed) form.submit();
            });
        } else {
            if(confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')) {
                form.submit();
            }
        }
    });
</script>
@endpush
