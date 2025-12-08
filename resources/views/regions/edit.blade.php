@extends('layout')

@section('title')
    Modification d'une Région
@endsection

@section('content')

    <div class="container-fluid mt-4 w-100">
        <div class="card shadow-sm custom-card">
            <!-- Header -->
            <div class="card-header text-white custom-card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit me-2"></i> Modifier la Région : {{ $region->nom_region }}
                </h4>
            </div>

            <!-- Form -->
            <div class="card-body p-4">
                <form action="{{ route('regions.update', $region->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nom région -->
                    <div class="mb-3">
                        <label for="nom_region" class="form-label fw-semibold">
                            <i class="fas fa-map-marked-alt me-1"></i> Nom de la région
                        </label>
                        <input type="text" 
                               name="nom_region" 
                               id="nom_region"
                               class="form-control @error('nom_region') is-invalid @enderror"
                               value="{{ old('nom_region', $region->nom_region) }}" 
                               placeholder="Ex: Région Sud" 
                               required>
                        @error('nom_region')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description_region" class="form-label fw-semibold">
                            <i class="fas fa-align-left me-1"></i> Description
                        </label>
                        <textarea name="description_region" 
                                  id="description_region"
                                  rows="3"
                                  class="form-control @error('description_region') is-invalid @enderror"
                                  placeholder="Description de la région..."
                        >{{ old('description_region', $region->description_region) }}</textarea>
                        @error('description_region')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Population -->
                    <div class="mb-3">
                        <label for="population" class="form-label fw-semibold">
                            <i class="fas fa-users me-1"></i> Population
                        </label>
                        <input type="number" 
                               name="population" 
                               id="population"
                               min="0"
                               class="form-control @error('population') is-invalid @enderror"
                               value="{{ old('population', $region->population) }}" 
                               required>
                        @error('population')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Superficie -->
                    <div class="mb-3">
                        <label for="superficie" class="form-label fw-semibold">
                            <i class="fas fa-ruler-combined me-1"></i> Superficie (km²)
                        </label>
                        <input type="number" 
                               step="0.01" 
                               name="superficie" 
                               id="superficie"
                               min="0"
                               class="form-control @error('superficie') is-invalid @enderror"
                               value="{{ old('superficie', $region->superficie) }}" 
                               required>
                        @error('superficie')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Localisation -->
                    <div class="mb-3">
                        <label for="localisation" class="form-label fw-semibold">
                            <i class="fas fa-location-arrow me-1"></i> Localisation
                        </label>
                        <input type="text" 
                               name="localisation" 
                               id="localisation"
                               class="form-control @error('localisation') is-invalid @enderror"
                               placeholder="Ville, département ou zone géographique"
                               value="{{ old('localisation', $region->localisation) }}">
                        @error('localisation')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('regions.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-arrow-left me-1"></i> Annuler
                        </a>
                        <button type="submit" class="btn btn-primary btn-submit">
                            <i class="fas fa-save me-1"></i> Mettre à jour
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
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
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
    
    .form-control {
        border-radius: 8px;
        border: 1px solid #d1d3e2;
        padding: 10px 12px;
        transition: 0.25s;
    }
    
    .form-control:focus {
        border-color: #F0C43B;
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
                background: '#F0C43B',
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
                confirmButtonColor: '#F0C43B'
            });
            @endif

        });
    </script>
@endpush