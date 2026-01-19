@extends('layout')

@section('title')
    Détail d'un Média
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="card google-card shadow-sm border-0">
        
        <div class="card-header bg-white py-4 border-bottom position-relative">
            <div class="header-accent-line-yellow"></div>
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-warning-subtle text-warning me-3">
                        <i class="bi bi-image-fill"></i>
                    </div>
                    <div>
                        <h4 class="card-title mb-0 fw-bold text-dark">Détails du média</h4>
                        <p class="text-muted small mb-0">Consultation des ressources liées au contenu</p>
                    </div>
                </div>
                <span class="badge bg-light text-dark border rounded-pill px-3 py-2 shadow-sm">
                    ID: #{{ $media->id }}
                </span>
            </div>
        </div>

        <div class="card-body p-4 p-lg-5">
            <div class="row g-5">
                <div class="col-lg-5">
                    <div class="preview-container p-3 rounded-4 bg-light border shadow-sm">
                        <h6 class="text-uppercase small fw-bold text-muted mb-3 d-flex align-items-center">
                            <i class="bi bi-camera-reels me-2 text-warning"></i> Aperçu du fichier
                        </h6>

                        @php
                            $extension = strtolower(pathinfo($media->chemin, PATHINFO_EXTENSION));
                            $isImage = in_array($extension, ['jpg','jpeg','png','gif','webp']);
                            $isVideo = in_array($extension, ['mp4','mov','avi','mkv','webm']);
                            $isAudio = in_array($extension, ['mp3','wav','ogg','m4a','aac','flac']);
                        @endphp

                        <div class="media-display-box rounded-3 overflow-hidden bg-white d-flex align-items-center justify-content-center shadow-inner" style="min-height: 300px; border: 1px dashed #dee2e6;">
                            @if($isImage)
                                <img src="{{ asset('img/'.$media->chemin) }}" class="img-fluid media-zoom" alt="Media preview">
                            @elseif($isVideo)
                                <video controls class="w-100" style="max-height: 400px;">
                                    <source src="{{ asset('img/'.$media->chemin) }}" type="video/{{ $extension }}">
                                    Votre navigateur ne supporte pas la vidéo.
                                </video>
                            @elseif($isAudio)
                                <div class="text-center w-100 px-3">
                                    <div class="audio-icon-animation mb-3">
                                        <i class="bi bi-music-note-beamed fs-1 text-warning"></i>
                                    </div>
                                    <audio controls class="w-100 custom-audio-player">
                                        <source src="{{ asset('img/'.$media->chemin) }}" type="audio/{{ $extension }}">
                                    </audio>
                                    <p class="small text-muted mt-3 mb-0">{{ basename($media->chemin) }}</p>
                                </div>
                            @else
                                <div class="text-center">
                                    <i class="bi bi-file-earmark-text text-muted display-1"></i>
                                    <p class="mt-2 fw-bold text-secondary">{{ strtoupper($extension) }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-4">
                            <div class="meta-tag">
                                <i class="bi bi-hdd-fill me-1"></i>
                                @if(file_exists(storage_path('app/public/'.$media->chemin)))
                                    {{ number_format(filesize(storage_path('app/public/'.$media->chemin)) / 1048576, 2) }} MB
                                @else N/A @endif
                            </div>
                            <div class="meta-tag">
                                <i class="bi bi-file-earmark-code me-1"></i> {{ strtoupper($extension) }}
                            </div>
                            <div class="meta-tag">
                                <i class="bi bi-calendar3 me-1"></i> {{ $media->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="info-group mb-5">
                        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center">
                            <span class="bg-warning text-white rounded-circle me-2 d-inline-flex align-items-center justify-content-center" style="width:24px; height:24px; font-size: 14px;">1</span>
                            Informations Générales
                        </h5>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="detail-card">
                                    <label>Contenu lié</label>
                                    <p class="h5 fw-bold text-primary mb-0">{{ $media->contenu->titre ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-card">
                                    <label>Type de Média</label>
                                    <span class="badge-type-custom">{{ $media->type_media->nom ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-card">
                                    <label>Nom du fichier</label>
                                    <p class="mb-0 text-truncate text-muted small fw-bold">{{ basename($media->chemin) }}</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="detail-card">
                                    <label>Description</label>
                                    <p class="mb-0 text-dark">{{ $media->description ?? 'Aucune description fournie.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-group">
                        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center">
                            <span class="bg-warning text-white rounded-circle me-2 d-inline-flex align-items-center justify-content-center" style="width:24px; height:24px; font-size: 14px;">2</span>
                            Historique et Système
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="detail-card">
                                    <label>Ajouté le</label>
                                    <p class="mb-0 fw-bold"><i class="bi bi-calendar-check me-2 text-muted"></i>{{ $media->created_at->format('d/m/Y à H:i') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-card">
                                    <label>Dernière modification</label>
                                    <p class="mb-0 fw-bold"><i class="bi bi-arrow-repeat me-2 text-muted"></i>{{ $media->updated_at->format('d/m/Y à H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light py-4 px-4 border-top">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('medias.index') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold shadow-sm">
                    <i class="bi bi-arrow-left me-2"></i>Retour à la liste
                </a>
                <div class="d-flex gap-2">
                    <a href="{{ route('medias.edit', $media->id) }}" class="btn btn-warning rounded-pill px-4 fw-bold text-white shadow-sm" style="background-color: #F0C43B; border: none;">
                        <i class="bi bi-pencil-square me-2"></i>Modifier
                    </a>
                    
                    <form action="{{ route('medias.destroy', $media->id) }}" method="POST" class="d-inline ms-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm onclick="return confirm('Supprimer définitivement ce média ?')">
                            <i class="bi bi-trash me-2"></i>Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    .google-card { border-radius: 20px; overflow: hidden; }
    .header-accent-line-yellow {
        position: absolute; top: 0; left: 0; right: 0; height: 5px; background: #F0C43B;
    }

    /* Styles de l'aperçu */
    .preview-container { background: #fdfdfd; }
    .media-display-box { background: #ffffff; }
    .media-zoom { transition: transform 0.5s ease; cursor: zoom-in; }
    .media-zoom:hover { transform: scale(1.05); }

    /* Badges et Tags */
    .meta-tag {
        background: #f1f3f4;
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        color: #5f6368;
    }

    /* Cards d'information */
    .detail-card {
        background: #ffffff;
        padding: 15px 20px;
        border-radius: 12px;
        border: 1px solid #edf2f7;
        transition: all 0.3s ease;
        height: 100%;
    }
    .detail-card:hover { border-color: #F0C43B; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .detail-card label {
        display: block;
        text-uppercase;
        font-size: 10px;
        font-weight: 800;
        color: #a0aec0;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .badge-type-custom {
        display: inline-block;
        background: #fff9e6;
        color: #F0C43B;
        padding: 4px 15px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 13px;
    }

    .bg-warning-subtle { background-color: #fff9e6 !important; }

    /* Audio custom feel */
    .audio-icon-animation i {
        animation: pulse-audio 2s infinite;
    }
    @keyframes pulse-audio {
        0% { transform: scale(1); opacity: 0.5; }
        50% { transform: scale(1.1); opacity: 1; }
        100% { transform: scale(1); opacity: 0.5; }
    }
</style>
@endpush

@push('scripts')
    <script>
        // Confirmation suppression
        $('. deleteMediaForm').on('submit', function(e) {
            e.preventDefault();
            let form = this;
            Swal.fire({
                title: 'Êtes-vous sûr ? ',
                text: "Le média sera définitivement supprimé.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result. isConfirmed) form.submit();
            });
        });
    </script>
@endpush
