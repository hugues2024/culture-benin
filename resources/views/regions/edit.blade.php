@extends('layout')

@section('title')
    Modification d'une Région
@endsection

@section('content')

<div class="container-fluid py-5">

    <div class="row justify-content-center">

        <div class="col-lg-11 col-xl-10"> <div class="card google-card">

                <div class="header-accent-line-edit"></div>



                <div class="card-header-custom">

                    <div class="d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">

                            <div class="icon-box-edit me-3 shadow-sm">

                                <i class="bi bi-pencil-square"></i>

                            </div>

                            <div>

                                <h3 class="mb-0 fw-bold" style="color: #202124;">Modifier la Région</h3>

                                <p class="text-muted mb-0 small">Mise à jour des informations de : <span class="text-warning fw-bold">{{ $region->nom_region }}</span></p>

                            </div>

                        </div>

                        <span class="badge bg-light text-muted border rounded-pill px-3 py-2">ID: #{{ $region->id }}</span>

                    </div>

                </div>



                <form action="{{ route('regions.update', $region->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    @method('PUT')



                    <div class="card-body p-4 p-lg-5">

                        <div class="row g-4">
                            <div class="col-md-12">
                <label class="form-label">Image de la région (Laissez vide pour conserver l'actuelle)</label>
                <div class="d-flex align-items-center gap-3 mb-2">
                    @if($region->img)
                        <img src="{{ asset($region->img) }}" alt="Current" class="rounded shadow-sm" style="width: 80px; height: 50px; object-fit: cover;">
                        <span class="text-muted small">Image actuelle</span>
                    @endif
                </div>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-image"></i></span>
                    <input type="file" name="img" class="form-control custom-input border-start-0 @error('img') is-invalid @enderror" accept="image/*">
                </div>
                @error('img') <div class="text-danger small mt-1 fw-bold">{{ $message }}</div> @enderror
            </div>

                            <div class="col-md-8">

                                <label class="form-label">Nom de la région</label>

                                <input type="text"

                                       name="nom_region"

                                       class="form-control custom-input @error('nom_region') is-invalid @enderror"

                                       value="{{ old('nom_region', $region->nom_region) }}"

                                       placeholder="Ex: Littoral" required>

                                @error('nom_region')

                                    <div class="invalid-feedback fw-bold">{{ $message }}</div>

                                @enderror

                            </div>



                            <div class="col-md-4">

                                <label class="form-label">Localisation</label>

                                <input type="text"

                                       name="localisation"

                                       class="form-control custom-input @error('localisation') is-invalid @enderror"

                                       value="{{ old('localisation', $region->localisation) }}"

                                       placeholder="Zone géographique">

                                @error('localisation')

                                    <div class="invalid-feedback fw-bold">{{ $message }}</div>

                                @enderror

                            </div>



                            <div class="col-md-6">

                                <label class="form-label">Population (Habitants)</label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-people"></i></span>

                                    <input type="number"

                                           name="population"

                                           class="form-control custom-input border-start-0 @error('population') is-invalid @enderror"

                                           value="{{ old('population', $region->population) }}" required>

                                </div>

                                @error('population')

                                    <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>

                                @enderror

                            </div>



                            <div class="col-md-6">

                                <label class="form-label">Superficie (km²)</label>

                                <div class="input-group">

                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-aspect-ratio"></i></span>

                                    <input type="number"

                                           step="0.01"

                                           name="superficie"

                                           class="form-control custom-input border-start-0 @error('superficie') is-invalid @enderror"

                                           value="{{ old('superficie', $region->superficie) }}" required>

                                </div>

                                @error('superficie')

                                    <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>

                                @enderror

                            </div>



                            <div class="col-12">

                                <label class="form-label">Description de la région</label>

                                <textarea name="description_region"

                                          class="form-control custom-input @error('description_region') is-invalid @enderror"

                                          rows="5"

                                          placeholder="Détails sur la région...">{{ old('description_region', $region->description_region) }}</textarea>

                                @error('description_region')

                                    <div class="invalid-feedback fw-bold">{{ $message }}</div>

                                @enderror

                            </div>

                        </div>

                    </div>



                    <div class="card-footer bg-light p-4 border-0 d-flex justify-content-end align-items-center">

                        <a href="{{ route('regions.index') }}" class="btn-google-back me-3">

                            <i class="bi bi-x-circle me-1"></i> Annuler les modifications

                        </a>

                        <button type="submit" class="btn btn-google-update shadow-sm">

                            <i class="bi bi-arrow-repeat me-2"></i>Mettre à jour la région

                        </button>

                    </div>

                </form>

            </div>



            <p class="text-center text-muted mt-4 small italic">

                <i class="bi bi-info-circle me-1"></i> Dernière mise à jour système : {{ $region->updated_at->format('d/m/Y à H:i') }}

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



    .header-accent-line-edit {

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



    .icon-box-edit {

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

        transition: all 0.2s ease;

        background-color: #fcfcfc;

    }



    .custom-input:focus {

        background-color: #fff;

        border-color: #F0C43B !important;

        box-shadow: 0 0 0 4px rgba(240, 196, 59, 0.1) !important;

        outline: none;

    }



    /* ----- Buttons ----- */

    .btn-google-update {

        background-color: #F0C43B;

        color: white;

        border: none;

        padding: 12px 32px;

        border-radius: 24px;

        font-weight: 600;

        transition: all 0.3s ease;

        box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3);

    }



    .btn-google-update:hover {

        background-color: #dda20a;

        transform: translateY(-1px);

        color: white;

    }



    .btn-google-back {

        color: #5f6368;

        font-weight: 600;

        text-decoration: none;

        padding: 12px 24px;

        border-radius: 24px;

    }



    .btn-google-back:hover {

        background-color: #f1f3f4;

        color: #202124;

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
