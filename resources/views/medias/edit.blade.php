@extends('layout')

@section('title')
    Modification d'un Média
@endsection

@section('content')

    <div class="container-fluid mt-4 w-100">
        <div class="card shadow-sm custom-card">
            <!-- Header -->
            <div class="card-header text-white custom-card-header">
                <h4 class="mb-0">Modifier un Média</h4>
            </div>

            <!-- Form -->
            <div class="card-body p-4">
                <form action="{{ route('medias.update', $media->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Aperçu actuel -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-eye me-2"></i>Média actuel :
                        </label>
                        <div class="media-preview-wrapper">
                            @php
                                $extension = strtolower(pathinfo($media->chemin, PATHINFO_EXTENSION));
                                $isImage = in_array($extension, ['jpg','jpeg','png','gif','webp']);
                                $isVideo = in_array($extension, ['mp4','mov','avi','mkv','webm']);
                                $isAudio = in_array($extension, ['mp3','wav','ogg','m4a','aac','flac']);
                            @endphp

                            @if($isImage)
                                <div class="image-preview">
                                    <img src="{{ asset('storage/' . $media->chemin) }}"
                                         alt="Media"
                                         class="img-fluid rounded">
                                    <div class="media-type-badge badge-image">
                                        <i class="bi bi-image-fill me-1"></i> 📷 Image
                                    </div>
                                </div>
                            @elseif($isVideo)
                                <div class="video-preview">
                                    <video controls class="w-100 rounded">
                                        <source src="{{ asset('storage/' . $media->chemin) }}"
                                                type="video/{{ $extension }}">
                                        Votre navigateur ne supporte pas la lecture de la vidéo.
                                    </video>
                                    <div class="media-type-badge badge-video">
                                        <i class="bi bi-camera-video-fill me-1"></i> 🎥 Vidéo
                                    </div>
                                </div>
                            @elseif($isAudio)
                                <div class="audio-preview">
                                    <div class="audio-icon-wrapper">
                                        <i class="bi bi-music-note-beamed"></i>
                                    </div>
                                    <p class="audio-filename">{{ basename($media->chemin) }}</p>
                                    <audio controls class="w-100 custom-audio">
                                        <source src="{{ asset('storage/' .  $media->chemin) }}"
                                                type="audio/{{ $extension }}">
                                        Votre navigateur ne supporte pas la lecture audio.
                                    </audio>
                                    <div class="media-type-badge badge-audio">
                                        <i class="bi bi-music-note-list me-1"></i> 🎵 Audio
                                    </div>
                                </div>
                            @else
                                <div class="file-preview">
                                    <i class="bi bi-file-earmark-text"></i>
                                    <p>{{ basename($media->chemin) }}</p>
                                    <div class="media-type-badge badge-file">
                                        <i class="bi bi-file-earmark me-1"></i> Fichier
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Upload (facultatif) -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-cloud-upload me-2"></i>Modifier le fichier (optionnel)
                                </label>
                                <input type="file"
                                       name="chemin"
                                       id="newFileInput"
                                       class="form-control @error('chemin') is-invalid @enderror"
                                       accept="image/jpeg,image/jpg,image/png,image/gif,image/webp,video/mp4,video/quicktime,video/x-msvideo,video/x-matroska,audio/mpeg,audio/wav,audio/ogg,audio/x-m4a,audio/aac,audio/flac">
                                @error('chemin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted d-block mt-1">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Laisser vide pour conserver le fichier actuel<br>
                                    <strong>Formats acceptés :</strong> Images, Vidéos, Audio (Max: 100MB)
                                </small>
                            </div>

                            <!-- Prévisualisation du nouveau fichier -->
                            <div id="newFilePreview" class="alert alert-info d-none mb-3">
                                <i class="bi bi-file-earmark-check me-2"></i>
                                <strong>Nouveau fichier :</strong> <span id="newFileName"></span>
                                <span class="badge bg-primary ms-2" id="newFileSize"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Type de média -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-tag me-2"></i>Type de média
                                </label>
                                <select name="id_type_media" class="form-select @error('id_type_media') is-invalid @enderror">
                                    <option value="">-- Sélectionner un type --</option>
                                    @foreach ($typesMedia as $t)
                                        <option value="{{ $t->id }}"
                                            {{ old('id_type_media', $media->id_type_media) == $t->id ? 'selected' : '' }}>
                                            {{ $t->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_type_media')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contenu lié -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-link-45deg me-2"></i>Contenu associé
                        </label>
                        <select name="id_contenu" class="form-select @error('id_contenu') is-invalid @enderror">
                            <option value="">-- Sélectionner un contenu --</option>
                            @foreach ($contenus as $c)
                                <option value="{{ $c->id }}" {{ old('id_contenu', $media->id_contenu) == $c->id ? 'selected' : '' }}>
                                    {{ $c->titre }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_contenu')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-chat-left-text me-2"></i>Description
                        </label>
                        <textarea name="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="3"
                                  placeholder="Description du média... ">{{ old('description', $media->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Boutons -->
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('medias.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-1"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary btn-submit">
                            <i class="bi bi-check-circle me-1"></i> Mettre à jour
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        /* Card modern */
        .custom-card {
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }

        /* HEADER BLEU UNIFORME */
        .custom-card-header {
            background: linear-gradient(135deg, #F0C43B, #F0C43B);
            padding: 20px;
        }

        .custom-card-header h4 {
            margin: 0;
            font-weight: 600;
            color: #fff !important;
        }

        /* Form */
        .form-label {
            color: #4e4e4e;
            font-weight: 600;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #d1d3e2;
            padding: 10px 12px;
            transition: 0.25s;
        }

        .form-control:focus, .form-select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78,115,223,0.25);
        }

        .is-invalid {
            border-color: #e74a3b !important;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #e74a3b;
        }

        /* Media Preview Wrapper */
        .media-preview-wrapper {
            border: 2px dashed #d1d3e2;
            border-radius: 12px;
            padding: 25px;
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            position: relative;
            transition: all 0.3s ease;
        }

        .media-preview-wrapper:hover {
            border-color: #4e73df;
            box-shadow: 0 4px 12px rgba(78, 115, 223, 0.1);
        }

        /* Image Preview */
        .image-preview img {
            max-height: 300px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Video Preview */
        .video-preview video {
            max-height: 300px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Audio Preview */
        .audio-preview {
            text-align: center;
            padding: 30px 20px;
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border-radius: 12px;
        }

        .audio-icon-wrapper {
            font-size: 4rem;
            color: #f59e0b;
            margin-bottom: 15px;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        . audio-filename {
            font-weight: 600;
            color: #78350f;
            margin-bottom: 15px;
            word-break: break-word;
        }

        .custom-audio {
            border-radius: 50px;
            background: #ffffff;
            padding: 5px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        /* File Preview */
        .file-preview {
            text-align: center;
            padding: 40px 20px;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
            border-radius: 12px;
        }

        .file-preview i {
            font-size: 4rem;
            color: #6b7280;
            margin-bottom: 15px;
        }

        .file-preview p {
            font-weight: 600;
            color: #4b5563;
            margin: 0;
            word-break: break-word;
        }

        /* Media Type Badges */
        .media-type-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.85rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            z-index: 10;
        }

        . badge-image {
            background: linear-gradient(135deg, #F0C43B, #F0C43B);
            color: white;
        }

        .badge-video {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        .badge-audio {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
        }

        .badge-file {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            color: white;
        }

        /* Buttons */
        .btn-submit {
            background: linear-gradient(135deg, #F0C43B, #F0C43B);
            border: none;
            font-weight: 600;
            transition: 0.2s;
            padding: 10px 24px;
        }

        .btn-submit:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #F0C43B, #F0C43B);
        }

        . btn-secondary {
            background-color: #6c757d;
            border: none;
            color: #fff;
            padding: 10px 24px;
            font-weight: 500;
            transition: 0. 2s;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: scale(1.05);
        }

        /* Alert Info */
        .alert-info {
            background-color: #e8f4fd;
            border-color: #F0C43B;
            color: #F0C43B;
            border-radius: 8px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Prévisualisation du nouveau fichier
        document.getElementById('newFileInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);

                // Vérifier la taille (100MB max)
                const maxSize = 100 * 1024 * 1024;
                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Fichier trop volumineux',
                        text: 'Le fichier ne doit pas dépasser 100MB',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#4e73df'
                    });
                    this.value = "";
                    return;
                }

                // Afficher les infos
                document.getElementById('newFileName').textContent = file.name;
                document.getElementById('newFileSize').textContent = sizeInMB + ' MB';
                document.getElementById('newFilePreview').classList.remove('d-none');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {

            @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                background: '#10b981',
                color: '#fff',
                iconColor: '#fff',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal. stopTimer)
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
                timer: 3500,
                timerProgressBar: true,
                background: '#ef4444',
                color: '#fff',
                iconColor: '#fff',
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
                confirmButtonColor: '#4e73df'
            });
            @endif

        });
    </script>
@endpush
