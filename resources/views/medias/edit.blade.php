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
                    @method('PUT')

                    <!-- Aperçu actuel -->
                    <div class="mb-4 text-center">
                        <label class="form-label fw-semibold">Média actuel :</label>
                        <div class="border p-3 rounded bg-light">
                            @if (in_array(pathinfo($media->chemin, PATHINFO_EXTENSION), ['mp4', 'webm', 'ogg']))
                                <video controls class="w-100 rounded" style="max-height: 250px;">
                                    <source src="{{ asset('storage/' . $media->chemin) }}"
                                        type="video/{{ pathinfo($media->chemin, PATHINFO_EXTENSION) }}">
                                    Votre navigateur ne supporte pas la lecture de la vidéo.
                                </video>
                            @else
                                <img src="{{ asset('storage/media/' . $media->chemin) }}" alt="Media"
                                    class="img-fluid rounded" style="max-height: 250px;">
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Upload (facultatif) -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Modifier le fichier (optionnel)</label>
                                <input type="file" name="chemin" class="form-control @error('chemin') is-invalid @enderror">
                                @error('chemin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Laisser vide pour conserver le fichier actuel</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Type de média -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Type de média</label>
                                <select name="id_type_media" class="form-select @error('id_type_media') is-invalid @enderror">
                                    <option value="">-- Sélectionner un type --</option>
                                    @foreach ($typesMedia as $t)
                                        <option value="{{ $t->id }}"
                                            {{ $media->id_type_media == $t->id ? 'selected' : '' }}>
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
                        <label class="form-label fw-semibold">Contenu associé</label>
                        <select name="id_contenu" class="form-select @error('id_contenu') is-invalid @enderror">
                            <option value="">-- Sélectionner un contenu --</option>
                            @foreach ($contenus as $c)
                                <option value="{{ $c->id }}" {{ $media->id_contenu == $c->id ? 'selected' : '' }}>
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
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                  rows="3" placeholder="Description du média...">{{ old('description', $media->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Boutons -->
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('medias.index') }}" class="btn btn-secondary me-2">Annuler</a>
                        <button type="submit" class="btn btn-primary btn-submit">Mettre à jour</button>
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
        background: linear-gradient(135deg, #4e73df, #224abe);
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

    /* Buttons */
    .btn-submit {
        background: linear-gradient(135deg, #4e73df, #224abe);
        border: none;
        font-weight: 600;
        transition: 0.2s;
        padding: 10px 24px;
    }
    
    .btn-submit:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #224abe, #4e73df);
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

    /* Aperçu média */
    .bg-light {
        background-color: #f8f9fa !important;
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
                background: '#4e73df',
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
                confirmButtonColor: '#4e73df'
            });
            @endif

        });
    </script>
@endpush