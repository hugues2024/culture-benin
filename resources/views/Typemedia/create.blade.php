@extends('layout')

@section('title')
    Ajout des Type de media
@endsection

@section('content')
<div class="container-fluid py-4">
    {{-- En-tête de page --}}
    <div class="card google-card shadow-sm border-0">
        <div class="card-header bg-white py-4 border-bottom position-relative">
            <div class="header-accent-line"></div>
            <h3 class="card-title mb-0 fw-bold text-dark me-2 mb-2">
                <i class="fa-solid fa-plus-circle text-primary me-2"></i>
                Ajouter un Type de média
            </h3>
            <p class="text-muted small mb-0 mt-1">Définissez une nouvelle catégorie pour vos fichiers multimédias.</p>
        </div>

        <div class="card-body p-5">
            <form action="{{ route('type_media.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xl-6 col-lg-8">
                        <div class="form-group mb-4">
                            <label for="nom" class="form-label fw-bold text-dark small text-uppercase mb-2">
                                Nom du Type de média <span class="text-danger">*</span>
                            </label>
                            <div class="input-group custom-input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fa-solid fa-tag text-muted"></i>
                                </span>
                                <input type="text"
                                    name="nom"
                                    id="nom"
                                    class="form-control ps-2 py-2 border-start-0 @error('nom') is-invalid @enderror"
                                    placeholder="Ex: Vidéo, Image, Podcast..."
                                    value="{{ old('nom') }}"
                                    autofocus
                                >
                            </div>
                            @error('nom')
                                <div class="text-danger small mt-2">
                                    <i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text text-muted mt-2">
                                Utilisez un nom court et explicite.
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4 opacity-25">

                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted small italic text-lowercase">* Champs obligatoires</span>
                    <div class="d-flex gap-2">
                        <a href="{{ route('type_media.index') }}" class="btn btn-light rounded-pill px-4 fw-semibold border">
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm btn-submit">
                            <i class="fa-solid fa-check-circle me-2"></i> Créer le type
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Carte style Google Workspace */
    .google-card {
        border-radius: 12px;
        background-color: #ffffff;
        border: 1px solid #dee2e6;
    }

    /* Petite barre d'accentuation en haut */
    .header-accent-line {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #1a73e8, #4285f4);
        border-radius: 12px 12px 0 0;
    }

    /* Style des inputs au focus */
    .custom-input-group .form-control:focus {
        border-color: #1a73e8;
        box-shadow: none;
        background-color: #fff;
    }
    
    .custom-input-group .input-group-text {
        border-color: #dee2e6;
        color: #5f6368;
    }

    .form-control {
        border-radius: 8px;
        transition: all 0.2s ease-in-out;
    }

    /* Bouton Primaire Moderne */
    .btn-primary {
        background-color: #1a73e8;
        border-color: #1a73e8;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background-color: #174ea6;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.12);
    }

    /* Style du breadcrumb */
    .breadcrumb-item + .breadcrumb-item::before {
        content: "\f105"; /* chevron-right */
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        font-size: 10px;
        padding-top: 5px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        @if(session('success'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#10b981',
            color: '#fff'
        });
        @endif

        @if(session('error'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#e74a3b',
            color: '#fff'
        });
        @endif

    });
</script>
@endpush
