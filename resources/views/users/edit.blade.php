@extends('layout')

@section('title')
    Modification d'un Utilisateur
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
            border-color: #2563eb !important;
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

        .photo-wrapper {
            border-radius: 50%;
            overflow: hidden;
            width: 150px;
            height: 150px;
            margin: 0 auto;
            border: 4px solid #e2e8f0;
        }
    </style>

    <div class="card custom-card mb-4">

        <!-- HEADER avec icône utilisateur -->
        <div class="custom-card-header">
            <div class="card-title">
                <i class="bi bi-person-fill me-2"></i>Formulaire de modification d'utilisateur
            </div>
        </div>

        <!-- FORM -->
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="row">
                    <!-- Photo -->
                    <div class="col-md-4 text-center mb-4">
                        @if($user->photo)
                            <div class="photo-wrapper shadow-sm">
                                <img src="{{ asset('storage/' . $user->photo) }}"
                                     alt="Photo de {{ $user->nom }}"
                                     class="img-fluid w-100 h-100 object-fit-cover">
                            </div>
                        @else
                            <div class="photo-wrapper bg-light d-flex align-items-center justify-content-center">
                                <i class="bi bi-person-circle" style="font-size: 4rem; color: #94a3b8;"></i>
                            </div>
                        @endif
                        
                        <label class="form-label mt-3">Changer la photo</label>
                        <input 
                            type="file" 
                            name="photo" 
                            class="form-control @error('photo') is-invalid @enderror"
                        >
                        @error('photo')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Infos utilisateur -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom</label>
                                <input 
                                    type="text" 
                                    name="nom" 
                                    class="form-control @error('nom') is-invalid @enderror"
                                    value="{{ old('nom', $user->nom) }}"
                                >
                                @error('nom')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prénom</label>
                                <input 
                                    type="text" 
                                    name="prenom" 
                                    class="form-control @error('prenom') is-invalid @enderror"
                                    value="{{ old('prenom', $user->prenom) }}"
                                >
                                @error('prenom')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input 
                                type="email" 
                                name="email" 
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}"
                            >
                            @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date de naissance</label>
                                <input 
                                    type="date" 
                                    name="date_naissance"
                                    class="form-control @error('date_naissance') is-invalid @enderror"
                                    value="{{ old('date_naissance', optional($user->date_naissance)->format('Y-m-d')) }}"
                                >
                                @error('date_naissance')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sexe</label>
                                <select name="sexe" class="form-select @error('sexe') is-invalid @enderror">
                                    <option value="">-- Sélectionner le sexe --</option>
                                    <option value="masculin" {{ old('sexe', $user->sexe) == 'masculin' ? 'selected' : '' }}>Masculin</option>
                                    <option value="feminin" {{ old('sexe', $user->sexe) == 'feminin' ? 'selected' : '' }}>Féminin</option>
                                </select>
                                @error('sexe')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rôle</label>
                                <select name="id_role" class="form-select @error('id_role') is-invalid @enderror">
                                    <option value="">-- Sélectionner un rôle --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ old('id_role', $user->id_role) == $role->id ? 'selected' : '' }}>
                                            {{ $role->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_role')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Langue</label>
                                <select name="id_langue" class="form-select @error('id_langue') is-invalid @enderror">
                                    <option value="">-- Sélectionner une langue --</option>
                                    @foreach($langues as $langue)
                                        <option value="{{ $langue->id }}" {{ old('id_langue', $user->id_langue) == $langue->id ? 'selected' : '' }}>
                                            {{ $langue->nom_langue }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_langue')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Statut</label>
                                <select name="statut" class="form-select @error('statut') is-invalid @enderror">
                                    @foreach(\App\Enums\StatutUser::cases() as $statut)
                                        <option value="{{ $statut->value }}"
                                            {{ old('statut', $user->statut) == $statut->value ? 'selected' : '' }}>
                                            {{ ucfirst($statut->value) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('statut')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nouveau mot de passe (optionnel)</label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    placeholder="••••••••"
                                >
                                @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="custom-footer">
                <a href="{{ route('users.index') }}" class="btn-cancel-custom">
                    Annuler
                </a>

                <button type="submit" class="btn-primary-custom ms-2">
                    Mettre à jour
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