@extends('layout')

@section('title')
    Page de modification d'un commentaire de {{ $commentaire->user->nom }} {{ $commentaire->user->prenom }}
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

        <!-- HEADER avec icône de commentaire -->
        <div class="custom-card-header">
            <div class="card-title">
                <i class="bi bi-chat-left-dots-fill me-2"></i>Formulaire de modification de commentaire
            </div>
        </div>

        <!-- FORM -->
        <form action="{{ route('commentaires.update', $commentaire->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">

                <div class="row">
                    <!-- Commentaire -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Commentaire</label>
                        <textarea 
                            name="commentaire" 
                            class="form-control @error('commentaire') is-invalid @enderror"
                            rows="3" 
                            placeholder="Modifier le commentaire..."
                        >{{ old('commentaire', $commentaire->commentaire) }}</textarea>
                        @error('commentaire')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Note -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Note</label>
                        <select name="note" class="form-select @error('note') is-invalid @enderror" required>
                            <option value="">-- Sélectionner --</option>
                            @for($i=1; $i<=5; $i++)
                                <option value="{{ $i }}" {{ old('note', $commentaire->note)==$i ? 'selected' : '' }}>
                                    {{ $i }} ★
                                </option>
                            @endfor
                        </select>
                        @error('note')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Utilisateur -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Utilisateur</label>
                        <select name="id_user" class="form-select @error('id_user') is-invalid @enderror" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('id_user', $commentaire->id_user)==$user->id ? 'selected' : '' }}>
                                    {{ $user->nom }} {{ $user->prenom }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_user')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Contenu -->
                    <div class="col-12 mb-3">
                        <label class="form-label">Contenu associé</label>
                        <select name="id_contenu" class="form-select @error('id_contenu') is-invalid @enderror" required>
                            @foreach($contenus as $contenu)
                                <option value="{{ $contenu->id }}"
                                    {{ old('id_contenu', $commentaire->id_contenu)==$contenu->id ? 'selected' : '' }}>
                                    {{ $contenu->titre }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_contenu')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="custom-footer">
                <a href="{{ route('commentaires.index') }}" class="btn-cancel-custom">
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