@extends('layout')

@section('title')
    Création de Contenu
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
            background: linear-gradient(135deg, #2563eb, #1e40af);
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
            background: linear-gradient(135deg, #2563eb, #1e40af);
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            color: white;
            transition: 0.2s ease-in-out;
        }
        .btn-primary-custom:hover {
            transform: scale(1.05);
            background: #1e40af;
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

    <div class="card custom-card mb-4">

        <!-- HEADER -->
        <div class="custom-card-header">
            <div class="card-title">Formulaire de création de contenu</div>
        </div>

        <!-- FORM -->
        <form action="{{ route('contenus.store') }}" method="POST">
            @csrf

            <div class="card-body">

                <div class="row">
                    <!-- Titre -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Titre</label>
                        <input
                            type="text"
                            class="form-control @error('titre') is-invalid @enderror"
                            name="titre"
                            value="{{ old('titre') }}"
                            placeholder="Titre du contenu"
                            required
                        >
                        @error('titre')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Texte -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Texte</label>
                        <textarea
                            class="form-control @error('texte') is-invalid @enderror"
                            name="texte"
                            rows="3"
                            placeholder="Votre texte..."
                        >{{ old('texte') }}</textarea>
                        @error('texte')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Statut -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Statut</label>
                        <select class="form-select @error('statut') is-invalid @enderror" name="statut" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="actif" {{ old('statut')=='actif' ? 'selected' : '' }}>Actif</option>
                            <option value="inactif" {{ old('statut')=='inactif' ? 'selected' : '' }}>Inactif</option>
                        </select>
                        @error('statut')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Auteur -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Auteur</label>
                        <select class="form-select @error('id_auteur') is-invalid @enderror" name="id_auteur" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('id_auteur')==$user->id ? 'selected' : '' }}>
                                    {{ $user->nom }} {{$user->prenom}}
                                </option>
                            @endforeach
                        </select>
                        @error('id_auteur')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Région -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Région</label>
                        <select class="form-select @error('region_id') is-invalid @enderror" name="region_id" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}" {{ old('region_id')==$region->id ? 'selected' : '' }}>
                                    {{ $region->nom_region }}
                                </option>
                            @endforeach
                        </select>
                        @error('region_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Langue -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Langue</label>
                        <select class="form-select @error('langue_id') is-invalid @enderror" name="langue_id" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($langues as $langue)
                                <option value="{{ $langue->id }}" {{ old('langue_id')==$langue->id ? 'selected' : '' }}>
                                    {{ $langue->nom_langue }}
                                </option>
                            @endforeach
                        </select>
                        @error('langue_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Type de contenu -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Type de contenu</label>
                        <select class="form-select @error('type_contenu_id') is-invalid @enderror" name="type_contenu_id" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}" {{ old('type_contenu_id')==$type->id ? 'selected' : '' }}>
                                    {{ $type->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('type_contenu_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="custom-footer">
                <a href="{{ route('contenus.index') }}" class="btn-cancel-custom">
                    Annuler
                </a>

                <button type="submit" class="btn-primary-custom ms-2">
                    Enregistrer
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