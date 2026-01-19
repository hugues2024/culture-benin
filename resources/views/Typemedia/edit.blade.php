@extends('layout')

@section('title')
    Modification de Type de media
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="card google-card shadow-sm border-0">
        <div class="card-header bg-white py-4 border-bottom position-relative">
            <div class="header-accent-line-edit"></div>
            <h3 class="card-title mb-0 fw-bold text-dark me-2 mb-2">
                <i class="fa-solid fa-pen-to-square text-warning me-2"></i>
                Modifier le type de média
            </h3>
            <p class="text-muted small mb-0 mt-1">Mise à jour des informations pour : <strong>{{ $typeMedia->nom }}</strong></p>
        </div>

        <div class="card-body p-5">
            <form action="{{ route('type_media.update', $typeMedia->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xl-6 col-lg-8">
                        <div class="form-group mb-4">
                            <label for="nom" class="form-label fw-bold text-dark small text-uppercase mb-2">
                                Nom du type média <span class="text-danger">*</span>
                            </label>
                            
                            <div class="input-group custom-input-group shadow-sm-hover">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fa-solid fa-tag text-muted"></i>
                                </span>
                                <input type="text"
                                       name="nom"
                                       id="nom"
                                       class="form-control ps-2 py-2 border-start-0 @error('nom') is-invalid @enderror"
                                       placeholder="Ex: Vidéo, Image, Audio..."
                                       value="{{ old('nom', $typeMedia->nom) }}"
                                       autofocus
                                >
                            </div>
                            
                            @error('nom')
                            <div class="text-danger small mt-2 d-flex align-items-center">
                                <i class="fa-solid fa-circle-exclamation me-1"></i> {{ $message }}
                            </div>
                            @enderror
                            
                            <div class="form-text text-muted mt-2">
                                <i class="fa-solid fa-circle-info me-1"></i>
                                Modifier le nom impactera tous les médias liés à ce type.
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-4 opacity-25">

                <div class="d-flex align-items-center justify-content-between">
                    <div class="text-muted small italic">
                         Dernière modification : {{ $typeMedia->updated_at ? $typeMedia->updated_at->format('d/m/Y H:i') : 'Inconnue' }}
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('type_media.index') }}" class="btn btn-light rounded-pill px-4 fw-semibold border">
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm btn-submit">
                            <i class="fa-solid fa-rotate me-2"></i> Mettre à jour
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
    /* Carte style moderne */
    .google-card {
        border-radius: 12px;
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        width: 100%;
    }

    /* Barre d'accentuation orange pour le mode édition */
    .header-accent-line-edit {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #f39c12, #f1c40f);
        border-radius: 12px 12px 0 0;
    }

    /* Input et Groupes */
    .custom-input-group .form-control {
        border-radius: 0 8px 8px 0;
        border-color: #dee2e6;
    }
    
    .custom-input-group .input-group-text {
        border-radius: 8px 0 0 8px;
        border-color: #dee2e6;
    }

    .form-control:focus {
        border-color: #f39c12 !important; /* Couleur d'accentuation au focus */
        box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.1) !important;
    }

    /* Boutons */
    .btn-primary {
        background-color: #1a73e8;
        border: none;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        background-color: #174ea6;
        box-shadow: 0 4px 12px rgba(26, 115, 232, 0.2);
    }

    .btn-light:hover {
        background-color: #f8f9fa;
        border-color: #bdc3c7;
    }

    /* Animation au survol du groupe d'input */
    .shadow-sm-hover:hover {
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: box-shadow 0.2s ease;
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
                background: '#F0C43B',
                color: '#fff',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
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
                color: '#fff',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            @endif

            @if($errors->any())
            let errorMessages = '<ul class="text-start mb-0">';
            @foreach($errors->all() as $error)
                errorMessages += '<li>{{ $error }}</li>';
            @endforeach
                errorMessages += '</ul>';

            Swal.fire({
                icon: 'error',
                title: 'Erreur de validation',
                html: errorMessages,
                confirmButtonText: 'OK',
                confirmButtonColor: '#F0C43B'
            });
            @endif

        });
    </script>
@endpush