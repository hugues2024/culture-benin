@extends('layout')

@section('title')
    Ajout des Utilisateurs
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8"> {{-- Largeur optimisée pour la lecture --}}
            
            {{-- En-tête --}}
            <div class="text-center mb-4">
                <div class="google-icon-circle mx-auto mb-3">
                    <i class="bi bi-person-plus text-primary"></i>
                </div>
                <h1 class="h3 fw-normal text-dark">Ajouter un Utilisateur</h1>
                <p class="text-muted">Créez un nouveau profil pour accéder à la plateforme</p>
            </div>

            <div class="card google-card shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <h6 class="text-primary text-uppercase small fw-bold mb-4">Informations Personnelles</h6>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" placeholder="Nom" value="{{ old('nom') }}">
                                    <label for="nom">Nom</label>
                                    @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" name="prenom" id="prenom" class="form-control @error('prenom') is-invalid @enderror" placeholder="Prénom" value="{{ old('prenom') }}">
                                    <label for="prenom">Prénom</label>
                                    @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="exemple@email.com" value="{{ old('email') }}">
                                    <label for="email">Adresse Email</label>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label x-small fw-bold text-muted ps-2">DATE DE NAISSANCE</label>
                                <input type="date" name="date_naissance" id="date_naissance" class="form-control custom-input @error('date_naissance') is-invalid @enderror" value="{{ old('date_naissance') }}">
                                @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label x-small fw-bold text-muted ps-2">SEXE</label>
                                <select name="sexe" id="sexe" class="form-select custom-input @error('sexe') is-invalid @enderror">
                                    <option value="">Sélectionner...</option>
                                    <option value="masculin" {{ old('sexe') == 'masculin' ? 'selected' : '' }}>Masculin</option>
                                    <option value="feminin" {{ old('sexe') == 'feminin' ? 'selected' : '' }}>Féminin</option>
                                </select>
                                @error('sexe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <hr class="my-4 text-muted opacity-25">
                            <h6 class="text-primary text-uppercase small fw-bold mb-2">Paramètres du Compte</h6>

                            <div class="col-12">
                                <div class="upload-zone p-4 text-center border rounded-3">
                                    <label for="photo" class="form-label d-block cursor-pointer">
                                        <i class="bi bi-cloud-arrow-up fs-2 text-muted"></i>
                                        <span class="d-block text-muted small mt-2">Cliquez pour ajouter une photo de profil</span>
                                        <input type="file" name="photo" id="photo" class="d-none @error('photo') is-invalid @enderror">
                                    </label>
                                    @error('photo')<div class="text-danger small mt-2">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label x-small fw-bold text-muted ps-2">RÔLE</label>
                                <select name="id_role" id="id_role" class="form-select custom-input @error('id_role') is-invalid @enderror">
                                    <option value="">Attribuer un rôle</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('id_role') == $role->id ? 'selected' : '' }}>{{ $role->nom }}</option>
                                    @endforeach
                                </select>
                                @error('id_role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label x-small fw-bold text-muted ps-2">LANGUE</label>
                                <select name="id_langue" id="id_langue" class="form-select custom-input @error('id_langue') is-invalid @enderror">
                                    <option value="">Sélectionner la langue</option>
                                    @foreach($langues as $langue)
                                        <option value="{{ $langue->id }}" {{ old('id_langue') == $langue->id ? 'selected' : '' }}>{{ $langue->nom_langue }}</option>
                                    @endforeach
                                </select>
                                @error('id_langue')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label x-small fw-bold text-muted ps-2">STATUT INITIAL</label>
                                <select name="statut" id="statut" class="form-select custom-input @error('statut') is-invalid @enderror">
                                    @foreach(\App\Enums\StatutUser::cases() as $statut)
                                        <option value="{{ $statut->value }}" {{ old('statut', \App\Enums\StatutUser::ACTIVE->value) == $statut->value ? 'selected' : '' }}>
                                            {{ ucfirst($statut->value) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('statut')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label x-small fw-bold text-muted ps-2">MOT DE PASSE</label>
                                <input type="password" name="password" id="password" class="form-control custom-input @error('password') is-invalid @enderror" placeholder="••••••••">
                                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-5 pt-3 border-top">
                            <a href="{{ route('users.index') }}" class="btn btn-light rounded-pill px-4 text-muted">Annuler</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                                <i class="bi bi-check-lg me-2"></i>Enregistrer l'utilisateur
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Global Background */
    body { background-color: #f8f9fa; }
    .x-small { font-size: 0.7rem; letter-spacing: 0.5px; }

    /* Icon Circle */
    .google-icon-circle {
        width: 64px; height: 64px; background: #e8f0fe;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem;
    }

    /* Card Google Style */
    .google-card {
        border: 1px solid #dadce0; border-radius: 12px;
        background: #fff;
    }

    /* Floating Labels Styling */
    .form-floating > .form-control:focus, .form-floating > .form-control:not(:placeholder-shown) {
        padding-top: 1.625rem; padding-bottom: 0.625rem;
    }
    .form-control, .form-select {
        border: 1px solid #dadce0; border-radius: 8px;
        padding: 0.75rem 1rem; color: #3c4043;
    }
    .form-control:focus, .form-select:focus {
        border-color: #1a73e8; box-shadow: 0 0 0 1px #1a73e8; outline: none;
    }

    /* Custom Inputs (non-floating) */
    .custom-input {
        background-color: #f1f3f4; border: 1px solid transparent;
        height: 50px;
    }
    .custom-input:focus { background-color: #fff; }

    /* Zone d'upload */
    .upload-zone {
        border: 2px dashed #dadce0 !important;
        transition: 0.3s; background: #fafafa;
    }
    .upload-zone:hover { border-color: #1a73e8 !important; background: #f8f9ff; }
    .cursor-pointer { cursor: pointer; }

    /* Boutons */
    .btn-primary { background-color: #1a73e8; border: none; }
    .btn-primary:hover { background-color: #174ea6; }
    .btn-light { border: 1px solid #dadce0; background: #fff; }

    /* Validation Errors */
    .is-invalid { border-color: #d93025 !important; }
    .invalid-feedback { font-weight: 500; color: #d93025; }
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
                background: '#3498db',
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
                background: '#e74c3c',
                color: '#fff'
            });
            @endif
        });
    </script>
@endpush
