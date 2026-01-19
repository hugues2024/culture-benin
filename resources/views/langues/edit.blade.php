@extends('layout')

@section('title')
    Modification de langue
@endsection


@section('content')

<div class="container-fluid py-4">

    <div class="row justify-content-center">

        <div class="col-lg-8 col-xl-6">

            <div class="card google-card shadow-sm border-0">

                

                <div class="card-header bg-white py-4 border-bottom position-relative">

                    <div class="header-accent-line-yellow"></div>

                    <div class="d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center">

                            <div class="icon-circle bg-warning-subtle text-warning me-3">

                                <i class="fa-solid fa-pen-nib"></i>

                            </div>

                            <div>

                                <h4 class="card-title mb-0 fw-bold text-dark">Modifier la langue</h4>

                                <p class="text-muted small mb-0">Édition de : <span class="fw-bold text-warning">{{ $langue->nom_langue }}</span></p>

                            </div>

                        </div>

                        <span class="badge bg-light text-muted border rounded-pill">ID: #{{ $langue->id }}</span>

                    </div>

                </div>



                <form action="{{ route('langues.update', $langue->id) }}" method="POST">

                    @csrf

                    @method('PUT')

                    

                    <div class="card-body p-4 p-lg-5">

                        

                        <div class="row g-4">

                            <div class="col-md-4">

                                <label class="form-label fw-bold text-dark">

                                    <i class="fa-solid fa-hashtag me-2 text-warning"></i>Code

                                </label>

                                <input type="text" 

                                       name="code_langue" 

                                       class="form-control custom-input @error('code_langue') is-invalid @enderror" 

                                       value="{{ old('code_langue', $langue->code_langue) }}" 

                                       placeholder="Ex: FR">

                                @error('code_langue')

                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>

                                @enderror

                            </div>



                            <div class="col-md-8">

                                <label class="form-label fw-bold text-dark">

                                    <i class="fa-solid fa-language me-2 text-warning"></i>Nom de la langue

                                </label>

                                <input type="text" 

                                       name="nom_langue" 

                                       class="form-control custom-input @error('nom_langue') is-invalid @enderror" 

                                       value="{{ old('nom_langue', $langue->nom_langue) }}" 

                                       placeholder="Ex: Français">

                                @error('nom_langue')

                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>

                                @enderror

                            </div>



                            <div class="col-12">

                                <label class="form-label fw-bold text-dark">

                                    <i class="fa-solid fa-align-left me-2 text-warning"></i>Description

                                </label>

                                <textarea name="description" 

                                          class="form-control custom-textarea @error('description') is-invalid @enderror" 

                                          rows="4" 

                                          placeholder="Modifier la description...">{{ old('description', $langue->description) }}</textarea>

                                @error('description')

                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>

                                @enderror

                            </div>

                        </div>



                    </div>



                    <div class="card-footer bg-light border-top p-4 d-flex justify-content-end align-items-center gap-3">

                        <a href="{{ route('langues.index') }}" class="btn btn-link text-secondary text-decoration-none fw-bold">

                            Annuler

                        </a>

                        <button type="submit" class="btn btn-warning rounded-pill px-5 fw-bold text-white shadow-sm" style="background-color: #F0C43B; border: none;">

                            <i class="fa-solid fa-rotate me-2"></i>Mettre à jour

                        </button>

                    </div>

                </form>



            </div>

            

            <div class="text-center mt-3">

                <p class="text-muted small">

                    <i class="fa-solid fa-clock-rotate-left me-1"></i> 

                    Dernière modification : {{ $langue->updated_at->diffForHumans() }}

                </p>

            </div>

        </div>

    </div>

</div>

@endsection



@push('styles')

<style>

    .google-card { border-radius: 16px; overflow: hidden; }

    .header-accent-line-yellow {

        position: absolute; top: 0; left: 0; right: 0; height: 4px; background: #F0C43B;

    }



    .icon-circle {

        width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; border-radius: 12px;

    }

    .bg-warning-subtle { background-color: #fff9e6 !important; }



    /* Inputs stylisés */

    .custom-input, .custom-textarea {

        border-radius: 10px !important;

        border: 1px solid #dee2e6;

        padding: 12px 15px;

        transition: all 0.2s ease;

        background-color: #fcfcfc;

    }



    .custom-input:focus, .custom-textarea:focus {

        background-color: #fff;

        border-color: #F0C43B !important;

        box-shadow: 0 0 0 4px rgba(240, 196, 59, 0.1) !important;

        outline: none;

    }



    /* Bouton principal */

    .btn-warning:hover {

        background-color: #dda20a !important;

        transform: translateY(-1px);

        box-shadow: 0 5px 15px rgba(240, 196, 59, 0.3) !important;

    }



    .invalid-feedback {

        font-size: 0.85rem;

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
                background: '#e74a3b',
                color: '#fff'
            });
            @endif
        });
    </script>
@endpush