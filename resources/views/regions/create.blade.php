@extends('layout')

@section('title')
    Création des Régions
@endsection

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10"> <div class="card google-card">
                <div class="header-accent-line"></div>
                <div class="card-header-custom">
                    <div class="d-flex align-items-center">
                        <div class="icon-box-header me-3 shadow-sm">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 fw-bold" style="color: #202124;">Nouvelle Région</h3>
                            <p class="text-muted mb-0 small text-uppercase fw-bold letter-spacing-1">Configuration territoriale du Bénin</p>
                        </div>
                    </div>
                </div>

<form action="{{ route('regions.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body p-4 p-lg-5">
        <div class="row g-4">
            <div class="col-md-12">
                <label class="form-label">Image de la région</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 custom-input"><i class="bi bi-image text-muted"></i></span>
                    <input type="file" class="form-control custom-input border-start-0 @error('img') is-invalid @enderror" name="img" accept="image/*">
                </div>
                @error('img') <div class="text-danger small mt-1 fw-bold">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Nom de la région</label>
                <input type="text" class="form-control custom-input @error('nom_region') is-invalid @enderror" name="nom_region" value="{{ old('nom_region') }}" placeholder="Ex: Littoral...">
                @error('nom_region') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Population</label>
                <input type="number" class="form-control custom-input @error('population') is-invalid @enderror" name="population" value="{{ old('population') }}">
                @error('population') <div class="text-danger small mt-1 fw-bold">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Superficie (km²)</label>
                <input type="number" step="0.01" class="form-control custom-input @error('superficie') is-invalid @enderror" name="superficie" value="{{ old('superficie') }}">
                @error('superficie') <div class="text-danger small mt-1 fw-bold">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Localisation géographique</label>
                <input type="text" class="form-control custom-input @error('localisation') is-invalid @enderror" name="localisation" value="{{ old('localisation') }}">
            </div>

            <div class="col-12">
                <label class="form-label">Description détaillée</label>
                <textarea class="form-control custom-input @error('description_region') is-invalid @enderror" name="description_region" rows="5">{{ old('description_region') }}</textarea>
            </div>
        </div>
    </div>

    <div class="card-footer bg-white p-4 border-0 d-flex justify-content-end align-items-center">
        <a href="{{ route('regions.index') }}" class="btn-google-cancel me-3">Annuler</a>
        <button type="submit" class="btn btn-google-save">
            <i class="bi bi-check2-circle me-2"></i>Enregistrer la région
        </button>
    </div>
</form>

            </div>



            <p class="text-center text-muted mt-4 small">

                Toutes les données saisies sont soumises à la validation administrative.

            </p>

        </div>

    </div>

</div>

@endsection



@push('styles')

<style>

    /* ----- Google Card Modern Style ----- */

    .google-card {

        border-radius: 16px;

        border: none;

        background: #ffffff;

        box-shadow: 0 1px 3px rgba(60,64,67,0.3), 0 4px 8px 3px rgba(60,64,67,0.15);

        overflow: hidden;

    }



    .header-accent-line {

        position: absolute;

        top: 0;

        left: 0;

        right: 0;

        height: 6px;

        background: #F0C43B; /* Jaune Google */

    }



    .card-header-custom {

        padding: 32px 40px 10px 40px;

        background: white;

        border: none;

    }



    .icon-box-header {

        width: 48px;

        height: 48px;

        background-color: #fff9e6;

        color: #F0C43B;

        border-radius: 12px;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 1.5rem;

    }



    /* ----- Inputs Style ----- */

    .form-label {

        font-size: 0.9rem;

        font-weight: 600;

        color: #3c4043;

        margin-bottom: 8px;

    }



    .custom-input {

        border-radius: 8px !important;

        border: 1px solid #dadce0;

        padding: 12px 16px;

        font-size: 1rem;

        color: #202124;

        transition: all 0.2s ease;

        background-color: #f8f9fa;

    }



    .custom-input:focus {

        background-color: #fff;

        border-color: #F0C43B !important;

        box-shadow: 0 0 0 4px rgba(240, 196, 59, 0.1) !important;

        outline: none;

    }



    /* ----- Buttons ----- */

    .btn-google-save {

        background-color: #F0C43B;

        color: white;

        border: none;

        padding: 12px 32px;

        border-radius: 24px;

        font-weight: 600;

        letter-spacing: 0.25px;

        transition: all 0.3s ease;

        box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3), 0 1px 3px 1px rgba(60,64,67,0.15);

    }



    .btn-google-save:hover {

        background-color: #dda20a;

        box-shadow: 0 4px 8px 3px rgba(60,64,67,0.15);

        transform: translateY(-1px);

        color: white;

    }



    .btn-google-cancel {

        color: #5f6368;

        font-weight: 600;

        text-decoration: none;

        padding: 12px 24px;

        border-radius: 24px;

        transition: background 0.2s;

    }



    .btn-google-cancel:hover {

        background-color: #f1f3f4;

        color: #202124;

    }



    .invalid-feedback { font-weight: 500; }

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
