@extends('layout')

@section('title')
    Modification d'un Média
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <div class="card google-card shadow-sm border-0">
                
                <div class="card-header bg-white py-4 border-bottom position-relative">
                    <div class="header-accent-line-yellow"></div>
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-warning-subtle text-warning me-3">
                            <i class="bi bi-pencil-square"></i>
                        </div>
                        <div>
                            <h4 class="card-title mb-0 fw-bold text-dark">Modifier le Média</h4>
                            <p class="text-muted small mb-0">ID : #{{ $media->id }} — Mettez à jour les fichiers ou les informations associées.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-lg-5">
                    <form action="{{ route('medias.update', $media->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-5 p-4 rounded-4 bg-light border border-dashed text-center">
                            <label class="form-label text-uppercase small fw-bold text-muted mb-3 d-block">
                                <i class="bi bi-eye me-2"></i>Aperçu du média actuel
                            </label>
                            
                            <div class="media-preview-container mx-auto shadow-sm rounded-3 overflow-hidden bg-white" style="max-width: 400px; min-height: 200px;">
                                @php
                                    $extension = strtolower(pathinfo($media->chemin, PATHINFO_EXTENSION));
                                    $isImage = in_array($extension, ['jpg','jpeg','png','gif','webp']);
                                    $isVideo = in_array($extension, ['mp4','mov','avi','mkv','webm']);
                                    $isAudio = in_array($extension, ['mp3','wav','ogg','m4a','aac','flac']);
                                @endphp

                                @if($isImage)
                                    <img src="{{ asset('img/' . $media->chemin) }}" class="img-fluid" alt="Current Media">
                                @elseif($isVideo)
                                    <video controls class="w-100"><source src="{{ asset('img/' . $media->chemin) }}" type="video/{{ $extension }}"></video>
                                @elseif($isAudio)
                                    <div class="py-5"><i class="bi bi-music-note-beamed display-4 text-warning"></i><audio controls class="w-100 px-3 mt-3"><source src="{{ asset('img/' . $media->chemin) }}"></audio></div>
                                @else
                                    <div class="py-5"><i class="bi bi-file-earmark-text display-4 text-muted"></i><p class="mt-2">{{ basename($media->chemin) }}</p></div>
                                @endif
                            </div>
                            <div class="mt-2 small text-muted">Fichier actuel : <span class="fw-bold">{{ basename($media->chemin) }}</span></div>
                        </div>

                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i class="bi bi-cloud-upload me-2 text-warning"></i>Remplacer le fichier</label>
                                <input type="file" name="chemin" id="newFileInput" class="form-control custom-file-input @error('chemin') is-invalid @enderror" 
                                       accept="image/*,video/*,audio/*">
                                @error('chemin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div id="fileHelp" class="form-text small mt-2">
                                    Laissez vide pour conserver le fichier actuel. <br>
                                    <strong>Max : 100MB</strong> (Images, Vidéos, Audio).
                                </div>

                                <div id="newFilePreview" class="mt-3 p-3 rounded bg-warning-subtle border border-warning border-opacity-25 d-none">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-file-earmark-check-fill text-warning fs-4 me-3"></i>
                                        <div>
                                            <div class="fw-bold small text-dark">Nouveau fichier sélectionné :</div>
                                            <div id="newFileName" class="small text-muted text-truncate" style="max-width: 200px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i class="bi bi-tag me-2 text-warning"></i>Type de média</label>
                                <select name="id_type_media" class="form-select custom-select @error('id_type_media') is-invalid @enderror">
                                    <option value="">-- Choisir un type --</option>
                                    @foreach ($typesMedia as $t)
                                        <option value="{{ $t->id }}" {{ old('id_type_media', $media->id_type_media) == $t->id ? 'selected' : '' }}>
                                            {{ $t->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_type_media') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold text-dark"><i class="bi bi-link-45deg me-2 text-warning"></i>Contenu associé</label>
                                <select name="id_contenu" class="form-select custom-select @error('id_contenu') is-invalid @enderror">
                                    <option value="">-- Sélectionner le contenu parent --</option>
                                    @foreach ($contenus as $c)
                                        <option value="{{ $c->id }}" {{ old('id_contenu', $media->id_contenu) == $c->id ? 'selected' : '' }}>
                                            {{ $c->titre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_contenu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold text-dark"><i class="bi bi-chat-left-text me-2 text-warning"></i>Description</label>
                                <textarea name="description" class="form-control custom-textarea @error('description') is-invalid @enderror" 
                                          rows="4" placeholder="Décrivez l'utilité de ce média...">{{ old('description', $media->description) }}</textarea>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end align-items-center mt-5 pt-4 border-top">
                            <a href="{{ route('medias.index') }}" class="btn btn-link text-secondary text-decoration-none me-4 fw-bold">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-warning rounded-pill px-5 fw-bold text-white shadow-sm" style="background-color: #F0C43B; border: none;">
                                <i class="bi bi-arrow-repeat me-2"></i>Mettre à jour le média
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    .google-card { border-radius: 16px; }
    .header-accent-line-yellow {
        position: absolute; top: 0; left: 0; right: 0; height: 4px; background: #F0C43B;
    }

    .icon-circle {
        width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; border-radius: 12px;
    }

    /* Form Inputs */
    .custom-file-input, .custom-select, .custom-textarea {
        border-radius: 10px !important;
        border: 1px solid #dee2e6;
        padding: 10px 15px;
        transition: all 0.2s ease;
    }

    .custom-file-input:focus, .custom-select:focus, .custom-textarea:focus {
        border-color: #F0C43B !important;
        box-shadow: 0 0 0 4px rgba(240, 196, 59, 0.1) !important;
    }

    .bg-warning-subtle { background-color: #fff9e6 !important; }
    
    .media-preview-container img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    /* Animation du bouton */
    .btn-warning:hover {
        background-color: #dda20a !important;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(240, 196, 59, 0.3) !important;
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


<script>
    document.getElementById('newFileInput').onchange = function () {
        const preview = document.getElementById('newFilePreview');
        const fileName = document.getElementById('newFileName');
        
        if (this.files && this.files[0]) {
            preview.classList.remove('d-none');
            fileName.textContent = this.files[0].name;
        } else {
            preview.classList.add('d-none');
        }
    };
</script>
@endpush
