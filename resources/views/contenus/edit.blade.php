@extends('layout')

@section('title')
    Page de modification d'un contenu
@endsection

@section('content')

    <style>
        /* ----- Card modern ----- */
        .custom-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            overflow: hidden;
        }

        .custom-card-header {
            background: linear-gradient(135deg, #F0C43B, #F0C43B);
            color: white;
            padding: 20px 20px;
        }

        .custom-card-header .card-title {
            font-size: 19px;
            font-weight: 600;
            margin: 0;
        }

        .form-label {
            font-weight: 600;
            color: #4e4e4e;
            margin-bottom: 6px;
        }

        .form-control, .form-select {
            border-radius: 8px !important;
            border: 1px solid #d1d3e2;
            padding: 10px 12px;
            transition: 0.25s ease-in-out;
        }

        .form-control:focus, .form-select:focus {
            border-color: #F0C43B !important;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #F0C43B, #F0C43B);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            color: white;
            transition: 0.2s ease-in-out;
        }
        .btn-primary-custom:hover {
            transform: scale(1.05);
            background: #F0C43B;
        }

        .btn-cancel-custom {
            background: #6c757d;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            color: white;
            transition: 0.2s ease-in-out;
        }
        .btn-cancel-custom:hover {
            transform: scale(1.05);
            background: #5a6268;
            color: white;
        }

        .custom-footer {
            padding: 15px 20px;
            background: #f7f7f7;
            border-top: 1px solid #e2e2e2;
        }
    </style>

    <div class="card google-card shadow-sm border-0 mb-4">

    <div class="card-header bg-white py-4 border-bottom position-relative">
        <div class="header-accent-line-yellow"></div>
        <div class="d-flex align-items-center">
            <div class="icon-circle bg-warning-subtle text-warning me-3">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div>
                <h4 class="card-title mb-0 fw-bold text-dark">Modifier le contenu</h4>
                <p class="text-muted small mb-0">ID Contenu : #{{ $contenu->id }}</p>
            </div>
        </div>
    </div>

    <form action="{{ route('contenus.update', $contenu->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body p-4 p-lg-5">
            <div class="row g-4">
                
                <div class="col-12">
                    <label class="form-label text-uppercase small fw-bold text-muted mb-2">Titre du contenu</label>
                    <div class="input-group custom-input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-type"></i></span>
                        <input 
                            type="text" 
                            class="form-control border-start-0 ps-1 @error('titre') is-invalid @enderror" 
                            name="titre" 
                            value="{{ old('titre', $contenu->titre) }}" 
                            placeholder="Titre du contenu" 
                            required
                        >
                    </div>
                    @error('titre')
                        <div class="text-danger small mt-2 d-flex align-items-center">
                            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label text-uppercase small fw-bold text-muted mb-2">Texte / Description</label>
                    <textarea 
                        class="form-control shadow-sm-hover @error('texte') is-invalid @enderror" 
                        name="texte" 
                        rows="6" 
                        placeholder="Rédigez votre texte ici..."
                    >{{ old('texte', $contenu->texte) }}</textarea>
                    @error('texte')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label text-uppercase small fw-bold text-muted mb-2">Statut de publication</label>
                    <select class="form-select shadow-sm @error('statut') is-invalid @enderror" name="statut" required>
                        <option value="">-- Sélectionner --</option>
                        <option value="actif" {{ old('statut', $contenu->statut)=='actif' ? 'selected' : '' }}>Actif</option>
                        <option value="inactif" {{ old('statut', $contenu->statut)=='inactif' ? 'selected' : '' }}>Inactif</option>
                    </select>
                    @error('statut')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label text-uppercase small fw-bold text-muted mb-2">Auteur référent</label>
                    <select class="form-select shadow-sm @error('id_auteur') is-invalid @enderror" name="id_auteur" required>
                        <option value="">-- Sélectionner --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('id_auteur', $contenu->id_auteur)==$user->id ? 'selected' : '' }}>
                                {{ $user->nom }} {{ $user->prenom }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_auteur')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label text-uppercase small fw-bold text-muted mb-2">Région géographique</label>
                    <select class="form-select shadow-sm @error('region_id') is-invalid @enderror" name="region_id" required>
                        <option value="">-- Sélectionner --</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}" {{ old('region_id', $contenu->region_id)==$region->id ? 'selected' : '' }}>
                                {{ $region->nom_region }}
                            </option>
                        @endforeach
                    </select>
                    @error('region_id')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label text-uppercase small fw-bold text-muted mb-2">Langue</label>
                    <select class="form-select shadow-sm @error('langue_id') is-invalid @enderror" name="langue_id" required>
                        <option value="">-- Sélectionner --</option>
                        @foreach($langues as $langue)
                            <option value="{{ $langue->id }}" {{ old('langue_id', $contenu->langue_id)==$langue->id ? 'selected' : '' }}>
                                {{ $langue->nom_langue }}
                            </option>
                        @endforeach
                    </select>
                    @error('langue_id')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label text-uppercase small fw-bold text-muted mb-2">Type de contenu</label>
                    <select class="form-select shadow-sm @error('type_contenu_id') is-invalid @enderror" name="type_contenu_id" required>
                        <option value="">-- Sélectionner --</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ old('type_contenu_id', $contenu->type_contenu_id)==$type->id ? 'selected' : '' }}>
                                {{ $type->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('type_contenu_id')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card-footer bg-light py-4 px-lg-5 d-flex justify-content-end align-items-center">
            <a href="{{ route('contenus.index') }}" class="btn btn-link text-secondary text-decoration-none me-4 fw-bold">
                Annuler
            </a>
            <button type="submit" class="btn btn-warning rounded-pill px-5 fw-bold text-white shadow-sm" style="background-color: #F0C43B; border: none;">
                <i class="bi bi-arrow-repeat me-2"></i>Mettre à jour
            </button>
        </div>
    </form>
</div>

@endsection

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