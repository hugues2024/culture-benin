@extends('layout')

@section('title')
    Création de Contenu
@endsection

@section('content')
<div class="container-fluid py-4"> <div class="card google-card shadow-sm border-0">
        
        <div class="card-header bg-white py-4 border-bottom position-relative">
            <div class="header-accent-line-create"></div>
            <div class="d-flex align-items-center">
                <div class="icon-circle bg-primary-subtle text-primary me-3">
                    <i class="bi bi-plus-circle-fill"></i>
                </div>
                <div>
                    <h4 class="card-title mb-0 fw-bold text-dark">Nouveau contenu culturel</h4>
                    <p class="text-muted small mb-0">Remplissez les informations ci-dessous pour publier un nouveau contenu.</p>
                </div>
            </div>
        </div>

        <form action="{{ route('contenus.store') }}" method="POST">
            @csrf

            <div class="card-body p-4 p-lg-5">
                <div class="row g-4">
                    
                    <div class="col-xl-8 col-lg-7">
                        <div class="mb-4">
                            <label class="form-label text-uppercase small fw-bold text-muted mb-2">Titre explicite</label>
                            <div class="input-group custom-input-group shadow-sm-hover">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-pencil-fill"></i>
                                </span>
                                <input type="text" 
                                       class="form-control ps-2 py-2 border-start-0 @error('titre') is-invalid @enderror" 
                                       name="titre" 
                                       value="{{ old('titre') }}" 
                                       placeholder="Entrez le titre du contenu..."
                                       required>
                            </div>
                            @error('titre')
                                <div class="text-danger small mt-2 d-flex align-items-center">
                                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-0">
                            <label class="form-label text-uppercase small fw-bold text-muted mb-2">Corps du texte / Récit</label>
                            <textarea class="form-control shadow-sm-hover @error('texte') is-invalid @enderror" 
                                      name="texte" 
                                      rows="12" 
                                      placeholder="Écrivez votre texte ici..."
                            >{{ old('texte') }}</textarea>
                            @error('texte')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-5">
                        <div class="p-4 bg-light rounded-4 border border-secondary border-opacity-10">
                            <h6 class="fw-bold mb-4 text-dark d-flex align-items-center">
                                <i class="bi bi-funnel-fill text-primary me-2"></i>Classification
                            </h6>
                            
                            <div class="mb-3">
                                <label class="form-label small">Statut initial</label>
                                <select class="form-select @error('statut') is-invalid @enderror shadow-sm" name="statut" required>
                                    <option value="" disabled selected>-- Choisir --</option>
                                    <option value="actif" {{ old('statut') == 'actif' ? 'selected' : '' }}>Actif (Visible)</option>
                                    <option value="inactif" {{ old('statut') == 'inactif' ? 'selected' : '' }}>Inactif (Masqué)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small">Attribuer à l'auteur</label>
                                <select class="form-select @error('id_auteur') is-invalid @enderror shadow-sm" name="id_auteur" required>
                                    <option value="" disabled selected>-- Sélectionner l'auteur --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('id_auteur') == $user->id ? 'selected' : '' }}>
                                            {{ $user->nom }} {{ $user->prenom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small">Région concernée</label>
                                <select class="form-select @error('region_id') is-invalid @enderror shadow-sm" name="region_id" required>
                                    <option value="" disabled selected>-- Choisir une région --</option>
                                    @foreach($regions as $region)
                                        <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                                            {{ $region->nom_region }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small">Langue du contenu</label>
                                <select class="form-select @error('langue_id') is-invalid @enderror shadow-sm" name="langue_id" required>
                                    <option value="" disabled selected>-- Choisir une langue --</option>
                                    @foreach($langues as $langue)
                                        <option value="{{ $langue->id }}" {{ old('langue_id') == $langue->id ? 'selected' : '' }}>
                                            {{ $langue->nom_langue }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-0">
                                <label class="form-label small">Catégorie de contenu</label>
                                <select class="form-select @error('type_contenu_id') is-invalid @enderror shadow-sm" name="type_contenu_id" required>
                                    <option value="" disabled selected>-- Choisir un type --</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ old('type_contenu_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->nom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 p-3 bg-primary-subtle rounded-4 text-primary small d-flex align-items-start">
                            <i class="bi bi-info-circle-fill me-2 mt-1"></i>
                            <div>
                                <strong>Astuce :</strong> Assurez-vous que le texte respecte la charte éditoriale avant de passer au statut "Actif".
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light py-4 px-lg-5 d-flex justify-content-between">
                <a href="{{ route('contenus.index') }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold shadow-sm">
                    <i class="bi bi-arrow-left me-2"></i>Annuler
                </a>
                <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm" style="background-color: #F0C43B; border: none; color: white;">
                    <i class="bi bi-check-lg me-2"></i>Enregistrer le contenu
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Card Global */
    .google-card { border-radius: 16px; background: #fff; }
    
    /* Ligne bleue pour la création */
    .header-accent-line-create {
        position: absolute; top: 0; left: 0; right: 0; height: 4px;
        background: linear-gradient(90deg, #0d6efd, #0dcaf0);
        border-radius: 16px 16px 0 0;
    }

    /* Inputs Modernes */
    .form-label { color: #495057; }
    .form-control, .form-select {
        border-radius: 10px !important;
        border: 1px solid #ced4da;
        padding: 10px 15px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1) !important;
    }

    /* Effets visuels */
    .icon-circle {
        width: 45px; height: 45px; display: flex;
        align-items: center; justify-content: center; border-radius: 12px;
    }
    .bg-primary-subtle { background-color: #e7f1ff !important; color: #0d6efd !important; }
    .rounded-4 { border-radius: 16px !important; }
    .shadow-sm-hover:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.05); }

    /* Bouton spécifique Jaune pour l'enregistrement */
    .btn-primary:hover {
        background-color: #dda20a !important;
        transform: translateY(-1px);
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
                color: '#fff',
                iconColor: '#fff'
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
                background: '#ef4444',
                color: '#fff',
                iconColor: '#fff'
            });
            @endif
        });
    </script>
@endpush