@extends('layout')

@section('title')
    Modification de rôle
@endsection

@section('content')

    <div class="container-fluid mt-4 w-100">
        <div class="card shadow-sm custom-card">
            <!-- Header -->
            <div class="card-header text-white custom-card-header">
                <h4 class="mb-0">
                    <i class="fas fa-user-edit me-2"></i> Modifier le rôle : {{ $role->nom }}
                </h4>
            </div>

            <!-- Form -->
            <div class="card-body p-4">
                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nom" class="form-label fw-semibold">
                            <i class="fas fa-tag me-1"></i> Nom du rôle
                        </label>
                        <input type="text"
                               name="nom"
                               id="nom"
                               class="form-control @error('nom') is-invalid @enderror"
                               value="{{ old('nom', $role->nom) }}"
                               placeholder="Ex: Administrateur">
                        @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                   
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary me-2">
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
        background: linear-gradient(135deg, #4e73df, #224abe);
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
        border-color: #4e73df;
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
        background: linear-gradient(135deg, #4e73df, #224abe);
        border: none;
        font-weight: 600;
        transition: 0.2s;
        padding: 10px 24px;
    }
    
    .btn-submit:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #224abe, #4e73df);
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
                background: '#4e73df',
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
                confirmButtonColor: '#4e73df'
            });
            @endif

        });
    </script>
@endpush