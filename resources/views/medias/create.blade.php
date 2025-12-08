@extends('layout')

@section('title', 'Création de Media pour les contenus')

@section('content')

    <div class="container-fluid mt-4 w-100">
        <div class="card shadow-sm custom-card">
            <!-- Header -->
            <div class="card-header text-white custom-card-header">
                <h4 class="mb-0">Ajouter un Média</h4>
            </div>

            <!-- Form -->
            <div class="card-body p-4">
                <form id="mediaForm" action="{{ route('medias.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Contenu associé --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Contenu associé</label>
                        <select name="id_contenu" class="form-select @error('id_contenu') is-invalid @enderror"
                                required>
                            <option value="">-- Sélectionnez --</option>
                            @foreach($contenus as $contenu)
                                <option
                                    value="{{ $contenu->id }}" {{ old('id_contenu') == $contenu->id ? 'selected' : '' }}>
                                    {{ $contenu->titre }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_contenu')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Type de média --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Type de média</label>
                        <select name="id_type_media" class="form-select @error('id_type_media') is-invalid @enderror"
                                required>
                            <option value="">-- Sélectionnez --</option>
                            @foreach($types as $type)
                                <option
                                    value="{{ $type->id }}" {{ old('id_type_media') == $type->id ? 'selected' : '' }}>
                                    {{ $type->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_type_media')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                  rows="3" placeholder="Description du média...">{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Drag and Drop Zone --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Fichier média</label>
                        <div id="dropZone"
                             class="border border-2 border-dashed p-5 text-center rounded @error('chemin') border-danger @enderror"
                             style="cursor: pointer; background: #f8f9fa; transition: all 0.3s; border-color: #d1d3e2;">
                            <i class="bi bi-cloud-arrow-up-fill fs-1 text-primary"></i>
                            <p class="mt-2 mb-1">Glissez un fichier ici ou cliquez pour sélectionner</p>
                            <small class="text-muted">
                                <strong>Formats acceptés :</strong><br>
                                📷 Images : JPG, PNG, GIF, WEBP<br>
                                🎥 Vidéos : MP4, MOV, AVI, MKV<br>
                                🎵 Audio : MP3, WAV, OGG, M4A, AAC, FLAC<br>
                                <span class="badge bg-info mt-1">Max: 100MB</span>
                            </small>
                        </div>
                        @error('chemin')
                        <div class="text-danger mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input file caché --}}
                    <input type="file"
                           name="chemin"
                           id="fileInput"
                           class="d-none"
                           accept="image/jpeg,image/jpg,image/png,image/gif,image/webp,video/mp4,video/quicktime,video/x-msvideo,video/x-matroska,audio/mpeg,audio/wav,audio/ogg,audio/x-m4a,audio/aac,audio/flac">
                    {{-- Aperçu du fichier sélectionné --}}
                    <div id="filePreview" class="alert alert-info d-none mb-3">
                        <i class="bi bi-file-earmark-check me-2"></i>
                        <strong>Fichier sélectionné :</strong> <span id="fileName"></span>
                        <span class="badge bg-primary ms-2" id="fileSize"></span>
                    </div>

                    {{-- ProgressBar --}}
                    <div class="progress mb-3 d-none" id="progressContainer" style="height: 8px; border-radius: 4px;">
                        <div id="progressBar"
                             class="progress-bar progress-bar-striped progress-bar-animated"
                             role="progressbar"
                             style="width: 0%; border-radius: 4px;"></div>
                    </div>

                    {{-- Boutons --}}
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('medias.index') }}" class="btn btn-secondary">
                            Annuler
                        </a>
                        <button type="button" id="resetBtn" class="btn btn-outline-secondary d-none">
                            Réinitialiser
                        </button>
                        <button type="submit" id="submitBtn" class="btn btn-primary btn-submit" disabled>
                            Créer le média
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
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
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
            border-color: #F0C43B;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
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

        /* Zone de drag & drop */
        .border-dashed {
            border-style: dashed !important;
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

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            color: #fff;
            padding: 10px 24px;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: scale(1.05);
        }

        .btn-outline-secondary {
            border: 1px solid #6c757d;
            color: #6c757d;
            padding: 10px 24px;
            font-weight: 500;
            transition: 0.2s;
        }

        .btn-outline-secondary:hover {
            background-color: #6c757d;
            color: #fff;
            transform: scale(1.05);
        }

        /* Alert personnalisée */
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
        // Éléments DOM
        const dropZone = document.getElementById("dropZone");
        const fileInput = document.getElementById("fileInput");
        const progressBar = document.getElementById("progressBar");
        const progressContainer = document.getElementById("progressContainer");
        const submitBtn = document.getElementById("submitBtn");
        const resetBtn = document.getElementById("resetBtn");
        const mediaForm = document.getElementById("mediaForm");
        const filePreview = document.getElementById("filePreview");
        const fileName = document.getElementById("fileName");
        const fileSize = document.getElementById("fileSize");

        let isUploadReady = false;

        // Clic sur la zone
        dropZone.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            fileInput.click();
        });

        // Drag over
        dropZone. addEventListener("dragover", (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone. classList.add("bg-light");
            dropZone.style. borderColor = "#4e73df";
            dropZone.style.transform = "scale(1. 02)";
        });

        // Drag leave
        dropZone.addEventListener("dragleave", (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.classList.remove("bg-light");
            dropZone.style.borderColor = "#d1d3e2";
            dropZone.style.transform = "scale(1)";
        });

        // DROP du fichier
        dropZone.addEventListener("drop", (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropZone.classList.remove("bg-light");
            dropZone.style.borderColor = "#d1d3e2";
            dropZone.style. transform = "scale(1)";

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const dt = new DataTransfer();
                dt.items.add(files[0]);
                fileInput.files = dt. files;

                const changeEvent = new Event('change', {bubbles: true});
                fileInput. dispatchEvent(changeEvent);
            }
        });

        // Changement de fichier
        fileInput.addEventListener("change", (e) => {
            if (e.target.files && e. target.files.length > 0) {
                const file = e.target.files[0];

                // Vérifier la taille (100MB max)
                const maxSize = 100 * 1024 * 1024; // 100MB
                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Fichier trop volumineux',
                        text: 'Le fichier ne doit pas dépasser 100MB',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#4e73df'
                    });
                    fileInput.value = "";
                    return;
                }

                // Vérifier le type de fichier
                const validTypes = [
                    // Images
                    'image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp',
                    // Vidéos
                    'video/mp4', 'video/quicktime', 'video/x-msvideo', 'video/x-matroska',
                    // Audio
                    'audio/mpeg', 'audio/wav', 'audio/ogg', 'audio/x-m4a', 'audio/aac', 'audio/flac'
                ];

                if (!validTypes.includes(file.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format non accepté',
                        html: `
                            <p class="mb-2">Ce type de fichier n'est pas accepté. </p>
                            <p class="small text-muted mb-0">
                                <strong>Formats acceptés :</strong><br>
                                📷 Images : JPG, PNG, GIF, WEBP<br>
                                🎥 Vidéos : MP4, MOV, AVI, MKV<br>
                                🎵 Audio : MP3, WAV, OGG, M4A, AAC, FLAC
                            </p>
                        `,
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#4e73df'
                    });
                    fileInput.value = "";
                    return;
                }

                // Afficher les infos et lancer la progression
                displayFileInfo(file);
                simulateProgress();
            }
        });

        // Afficher les infos du fichier avec icône selon le type
        function displayFileInfo(file) {
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
            const fileType = file.type;

            // Déterminer l'icône et la couleur selon le type
            let icon = 'bi-file-earmark-check';
            let iconColor = 'text-success';
            let typeLabel = 'Fichier';

            if (fileType.startsWith('image/')) {
                icon = 'bi-file-earmark-image-fill';
                iconColor = 'text-primary';
                typeLabel = '📷 Image';
            } else if (fileType.startsWith('video/')) {
                icon = 'bi-file-earmark-play-fill';
                iconColor = 'text-danger';
                typeLabel = '🎥 Vidéo';
            } else if (fileType.startsWith('audio/')) {
                icon = 'bi-file-earmark-music-fill';
                iconColor = 'text-warning';
                typeLabel = '🎵 Audio';
            }

            fileName.textContent = file.name;
            fileSize.textContent = sizeInMB + ' MB';
            filePreview.classList.remove("d-none");

            dropZone.innerHTML = `
                <i class="bi ${icon} fs-1 ${iconColor}"></i>
                <p class="mt-2 mb-1"><strong>${file.name}</strong></p>
                <span class="badge bg-secondary mb-2">${typeLabel}</span>
                <p class="text-muted small mb-0">${sizeInMB} MB</p>
                <p class="text-primary small mb-0"><i class="bi bi-cursor me-1"></i>Cliquez pour changer</p>
            `;

            resetBtn.classList.remove("d-none");
        }

        // Simulation de la progression
        function simulateProgress() {
            isUploadReady = false;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Préparation...';
            progressContainer.classList.remove("d-none");
            progressBar.style. width = "0%";
            progressBar.classList.remove("bg-success");
            progressBar. classList.add("bg-info");

            let percent = 0;
            const interval = setInterval(() => {
                percent += Math. floor(Math.random() * 8) + 5;
                if (percent > 100) percent = 100;

                progressBar.style.width = percent + "%";

                if (percent >= 100) {
                    clearInterval(interval);
                    progressBar.classList.remove("bg-info");
                    progressBar.classList.add("bg-success");

                    setTimeout(() => {
                        isUploadReady = true;
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = 'Créer le média';
                    }, 500);
                }
            }, 180);
        }

        // Réinitialiser le formulaire
        resetBtn.addEventListener("click", () => {
            fileInput.value = "";
            dropZone.innerHTML = `
                <i class="bi bi-cloud-arrow-up-fill fs-1 text-primary"></i>
                <p class="mt-2 mb-1">Glissez un fichier ici ou cliquez pour sélectionner</p>
                <small class="text-muted">
                    <strong>Formats acceptés :</strong><br>
                    📷 Images : JPG, PNG, GIF, WEBP<br>
                    🎥 Vidéos : MP4, MOV, AVI, MKV<br>
                    🎵 Audio : MP3, WAV, OGG, M4A, AAC, FLAC<br>
                    <span class="badge bg-info mt-1">Max: 100MB</span>
                </small>
            `;
            filePreview.classList.add("d-none");
            progressContainer. classList.add("d-none");
            progressBar.style.width = "0%";
            resetBtn.classList.add("d-none");
            submitBtn.disabled = true;
            submitBtn. innerHTML = 'Créer le média';
            isUploadReady = false;
        });

        // Validation avant soumission
        mediaForm.addEventListener("submit", function (e) {
            if (!fileInput.files || fileInput.files.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Fichier manquant',
                    text: 'Veuillez sélectionner un fichier avant de soumettre',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#4e73df'
                });
                return false;
            }

            submitBtn.disabled = true;
            submitBtn. innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Envoi en cours...';
            return true;
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
                background: '#10b981',  // 🟢 Vert moderne
                color: '#fff',
                iconColor: '#fff',
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
                timer: 3500,
                timerProgressBar: true,
                background: '#ef4444',  // 🔴 Rouge moderne
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
