@extends('layout')

@section('title')
    Modification d'un Utilisateur
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            
            {{-- En-tête --}}
            <div class="text-center mb-4">
                <div class="google-icon-circle mx-auto mb-3">
                    <i class="bi bi-pencil-square text-primary"></i>
                </div>
                <h1 class="h3 fw-normal text-dark">Modifier l'Utilisateur</h1>
                <p class="text-muted small">Mise à jour du profil de <strong>{{ $user->prenom }} {{ $user->nom }}</strong></p>
            </div>

            <div class="card google-card shadow-sm">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body p-4 p-md-5">
                        <div class="row">
                            <div class="col-md-4 text-center border-end-md mb-4 mb-md-0">
                                <div class="edit-photo-container mb-3">
                                    @if($user->photo)
                                        <img src="{{ asset('storage/' . $user->photo) }}" alt="Profil" class="profile-preview shadow-sm">
                                    @else
                                        <div class="profile-preview bg-light d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person text-secondary" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    
                                    <label for="photo" class="btn-change-photo shadow-sm">
                                        <i class="bi bi-camera-fill"></i>
                                        <input type="file" name="photo" id="photo" class="d-none @error('photo') is-invalid @enderror">
                                    </label>
                                </div>
                                <p class="x-small text-muted fw-bold text-uppercase">Photo de profil</p>
                                @error('photo')<div class="text-danger x-small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-8 ps-md-4">
                                <h6 class="text-primary text-uppercase small fw-bold mb-4">Informations de base</h6>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="nom" id="nom" class="form-control @error('nom') is-invalid @enderror" placeholder="Nom" value="{{ old('nom', $user->nom) }}">
                                            <label for="nom">Nom</label>
                                            @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" name="prenom" id="prenom" class="form-control @error('prenom') is-invalid @enderror" placeholder="Prénom" value="{{ old('prenom', $user->prenom) }}">
                                            <label for="prenom">Prénom</label>
                                            @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email', $user->email) }}">
                                            <label for="email">Adresse Email</label>
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label x-small fw-bold text-muted ps-2">DATE DE NAISSANCE</label>
                                        <input type="date" name="date_naissance" class="form-control custom-input @error('date_naissance') is-invalid @enderror" value="{{ old('date_naissance', optional($user->date_naissance)->format('Y-m-d')) }}">
                                        @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label x-small fw-bold text-muted ps-2">SEXE</label>
                                        <select name="sexe" class="form-select custom-input @error('sexe') is-invalid @enderror">
                                            <option value="masculin" {{ old('sexe', $user->sexe) == 'masculin' ? 'selected' : '' }}>Masculin</option>
                                            <option value="feminin" {{ old('sexe', $user->sexe) == 'feminin' ? 'selected' : '' }}>Féminin</option>
                                        </select>
                                    </div>
                                </div>

                                <hr class="my-4 opacity-25">
                                <h6 class="text-primary text-uppercase small fw-bold mb-4">Accès & Préférences</h6>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label x-small fw-bold text-muted ps-2">RÔLE</label>
                                        <select name="id_role" class="form-select custom-input @error('id_role') is-invalid @enderror">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ old('id_role', $user->id_role) == $role->id ? 'selected' : '' }}>{{ $role->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label x-small fw-bold text-muted ps-2">LANGUE</label>
                                        <select name="id_langue" class="form-select custom-input @error('id_langue') is-invalid @enderror">
                                            @foreach($langues as $langue)
                                                <option value="{{ $langue->id }}" {{ old('id_langue', $user->id_langue) == $langue->id ? 'selected' : '' }}>{{ $langue->nom_langue }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label x-small fw-bold text-muted ps-2">STATUT</label>
                                        <select name="statut" class="form-select custom-input @error('statut') is-invalid @enderror">
                                            @foreach(\App\Enums\StatutUser::cases() as $statut)
                                                <option value="{{ $statut->value }}" {{ old('statut', $user->statut) == $statut->value ? 'selected' : '' }}>{{ ucfirst($statut->value) }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label x-small fw-bold text-muted ps-2">SÉCURITÉ</label>
                                        <input type="password" name="password" class="form-control custom-input @error('password') is-invalid @enderror" placeholder="Nouveau MDP (Optionnel)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Pied de formulaire --}}
                    <div class="card-footer bg-light p-4 border-top d-flex justify-content-center gap-3">
                        <a href="{{ route('users.index') }}" class="btn btn-light rounded-pill px-4 text-muted border">Annuler</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold shadow-sm">
                            Mettre à jour le profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    body { background-color: #f8f9fa; }
    .x-small { font-size: 0.7rem; letter-spacing: 0.5px; }

    /* Icon Circle */
    .google-icon-circle {
        width: 60px; height: 60px; background: #e8f0fe;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
    }

    /* Card Google Style */
    .google-card {
        border: 1px solid #dadce0; border-radius: 12px;
        background: #fff; overflow: hidden;
    }

    /* Profile Preview System */
    .edit-photo-container {
        position: relative;
        display: inline-block;
    }
    .profile-preview {
        width: 120px; height: 120px;
        border-radius: 50%; object-fit: cover;
        border: 4px solid #fff; outline: 1px solid #dadce0;
    }
    .btn-change-photo {
        position: absolute; bottom: 5px; right: 5px;
        background: #fff; border-radius: 50%; width: 35px; height: 35px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: #1a73e8; border: 1px solid #dadce0;
        transition: 0.2s;
    }
    .btn-change-photo:hover { background: #f1f3f4; transform: scale(1.1); }

    /* Inputs */
    .form-floating > .form-control:focus, .form-floating > .form-control:not(:placeholder-shown) {
        padding-top: 1.625rem; padding-bottom: 0.625rem;
    }
    .form-control, .form-select {
        border: 1px solid #dadce0; border-radius: 8px; color: #3c4043;
    }
    .form-control:focus, .form-select:focus {
        border-color: #1a73e8; box-shadow: 0 0 0 1px #1a73e8;
    }
    .custom-input { background-color: #f1f3f4; border: 1px solid transparent; height: 48px; }
    .custom-input:focus { background-color: #fff; }

    /* Buttons */
    .btn-primary { background-color: #1a73e8; border: none; }
    .btn-primary:hover { background-color: #174ea6; }

    /* Responsive adjustments */
    @media (min-width: 768px) {
        .border-end-md { border-right: 1px solid #dadce0 !important; }
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
                background: '#2563eb',
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