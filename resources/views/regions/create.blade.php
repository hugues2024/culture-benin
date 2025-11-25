@extends('layout')

@section('title')
    Création des Régions
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

        <!-- HEADER avec icône de région -->
        <div class="custom-card-header">
            <div class="card-title">
                <i class="bi bi-geo-alt-fill me-2"></i>Formulaire de création de région
            </div>
        </div>

        <!-- FORM -->
        <form action="{{ route('regions.store') }}" method="POST">
            @csrf

            <div class="card-body">

                <div class="row">
                    <!-- Nom de la région -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Nom de la région</label>
                        <input
                            type="text"
                            class="form-control @error('nom_region') is-invalid @enderror"
                            name="nom_region"
                            value="{{ old('nom_region') }}"
                            placeholder="Nom de la région"
                        >
                        @error('nom_region')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea
                            class="form-control @error('description_region') is-invalid @enderror"
                            name="description_region"
                            rows="3"
                            placeholder="Décrivez la région..."
                        >{{ old('description_region') }}</textarea>
                        @error('description_region')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Population -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Population</label>
                        <input
                            type="number"
                            class="form-control @error('population') is-invalid @enderror"
                            name="population"
                            value="{{ old('population') }}"
                            placeholder="Population"
                        >
                        @error('population')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Superficie -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Superficie (km²)</label>
                        <input
                            type="number"
                            step="0.01"
                            class="form-control @error('superficie') is-invalid @enderror"
                            name="superficie"
                            value="{{ old('superficie') }}"
                            placeholder="Superficie en km²"
                        >
                        @error('superficie')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Localisation -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Localisation</label>
                        <input
                            type="text"
                            class="form-control @error('localisation') is-invalid @enderror"
                            name="localisation"
                            value="{{ old('localisation') }}"
                            placeholder="Ville, département ou zone géographique"
                        >
                        @error('localisation')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="custom-footer">
                <a href="{{ route('regions.index') }}" class="btn-cancel-custom">
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