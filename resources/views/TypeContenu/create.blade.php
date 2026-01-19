@extends('layout')

@section('title')
    Ajout d'un Type de Contenu
@endsection

@section('content')

<div class="container-fluid py-4">

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6">

            <div class="card google-card shadow-sm border-0">

                

                <div class="card-header bg-white py-4 border-bottom position-relative">

                    <div class="header-accent-line-yellow"></div>

                    <div class="d-flex align-items-center">

                        <div class="icon-circle bg-warning-subtle text-warning me-3">

                            <i class="bi bi-tag-fill"></i>

                        </div>

                        <div>

                            <h4 class="card-title mb-0 fw-bold text-dark">Ajouter un Type</h4>
                        </div>

                    </div>

                </div>



                <div class="card-body p-4 p-lg-5">

                    <form action="{{ route('type_contenu.store') }}" method="POST">

                        @csrf



                        <div class="mb-4">

                            <label for="nom" class="form-label text-uppercase small fw-bold text-muted mb-2">

                                Nom du Type de Contenu

                            </label>

                            <div class="input-group custom-input-group shadow-sm-hover">

                                <span class="input-group-text bg-light border-end-0">

                                    <i class="bi bi-type"></i>

                                </span>

                                <input type="text"

                                    name="nom"

                                    id="nom"

                                    class="form-control border-start-0 ps-2 py-2 @error('nom') is-invalid @enderror"

                                    placeholder="Ex: Article, Vidéo, Podcast..."

                                    value="{{ old('nom') }}"

                                    required

                                >

                            </div>

                            @error('nom')

                                <div class="invalid-feedback d-block mt-2">

                                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}

                                </div>

                            @enderror

                        </div>



                        <div class="d-flex justify-content-end align-items-center mt-5 pt-3 border-top">

                            <a href="{{ route('type_contenu.index') }}" class="btn btn-link text-secondary text-decoration-none me-4 fw-bold">

                                Annuler

                            </a>

                            <button type="submit" class="btn btn-warning rounded-pill px-5 fw-bold text-white shadow-sm" style="background-color: #F0C43B; border: none;">

                                <i class="bi bi-check-lg me-2"></i>Créer le type

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection



@push('style')

<style>

    /* Card Global Style */

    .google-card {

        border-radius: 16px;

        overflow: hidden;

    }



    /* Ligne d'accentuation supérieure */

    .header-accent-line-yellow {

        position: absolute;

        top: 0;

        left: 0;

        right: 0;

        height: 4px;

        background: #F0C43B;

    }



    /* Icône ronde décorative */

    .icon-circle {

        width: 48px;

        height: 48px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 12px;

    }



    .bg-warning-subtle {

        background-color: #fff9e6 !important;

        color: #F0C43B !important;

    }



    /* Inputs modernes */

    .form-control {

        border-radius: 10px !important;

        border: 1px solid #dee2e6;

        transition: all 0.2s ease-in-out;

    }



    .form-control:focus {

        border-color: #F0C43B !important;

        box-shadow: 0 0 0 4px rgba(240, 196, 59, 0.15) !important;

    }



    .custom-input-group .input-group-text {

        border-radius: 10px 0 0 10px !important;

        color: #adb5bd;

    }



    /* Animation au survol */

    .shadow-sm-hover:hover {

        box-shadow: 0 5px 15px rgba(0,0,0,0.05) !important;

    }



    /* Boutons */

    .btn-warning:hover {

        background-color: #dda20a !important;

        transform: translateY(-1px);

        box-shadow: 0 4px 12px rgba(240, 196, 59, 0.3) !important;

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
            background: '#10b981',
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

    });
</script>
@endpush