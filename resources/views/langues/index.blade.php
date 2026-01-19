@extends('layout')

@section('title')
    Liste des langues
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="card google-card shadow-sm border-0">
        
        <div class="card-header bg-white py-4 border-bottom position-relative">
            <div class="header-accent-line-yellow"></div>
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-warning-subtle text-warning me-3">
                        <i class="fa-solid fa-language"></i>
                    </div>
                    <div>
                        <h4 class="card-title mb-0 fw-bold text-dark">Gestion des Langues</h4>
                    </div>
                </div>
                <a href="{{ route('langues.create') }}" class="btn btn-warning rounded-pill px-4 fw-bold text-white shadow-sm">
                    <i class="fa-solid fa-plus me-2"></i>Ajouter une langue
                </a>
            </div>
        </div>

        <div class="card-body p-0"> <div class="table-responsive">
                <table id="languesTable" class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase small fw-bolder text-muted" style="width: 150px;">Code</th>
                            <th class="py-3 text-uppercase small fw-bolder text-muted">Nom de la langue</th>
                            <th class="py-3 text-uppercase small fw-bolder text-muted text-center" style="width: 200px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($langues as $langue)
                        <tr>
                            <td class="ps-4">
                                <span class="badge bg-light text-primary border px-3 py-2 rounded-pill fw-bold">
                                    {{ strtoupper($langue->code_langue) }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-semibold text-dark">{{ $langue->nom_langue }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('langues.show', $langue->id) }}" 
                                       class="btn-action btn-show" title="Voir">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    
                                    <a href="{{ route('langues.edit', $langue->id) }}" 
                                       class="btn-action btn-edit" title="Modifier">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    @can('delete-langues')
                                    <button type="button" class="btn-action btn-delete" 
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $langue->id }}" title="Supprimer">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="deleteModal{{ $langue->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg">
                                    <div class="modal-body p-4 text-center">
                                        <div class="text-danger mb-3">
                                            <i class="fa-solid fa-circle-exclamation display-4"></i>
                                        </div>
                                        <h5 class="fw-bold">Supprimer la langue ?</h5>
                                        <p class="text-muted">Êtes-vous sûr de vouloir supprimer <strong>{{ $langue->nom_langue }}</strong> ? Cette action est irréversible.</p>
                                        <div class="d-flex justify-content-center gap-2 mt-4">
                                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>
                                            <form action="{{ route('langues.destroy', $langue->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger rounded-pill px-4">Confirmer la suppression</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted italic">
                                <i class="fa-solid fa-folder-open display-6 d-block mb-3 opacity-25"></i>
                                Aucune langue enregistrée pour le moment.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .google-card { border-radius: 15px; overflow: hidden; background: #fff; }
    .header-accent-line-yellow {
        position: absolute; top: 0; left: 0; right: 0; height: 4px; background: #F0C43B;
    }

    /* Icones d'en-tête */
    .icon-circle {
        width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 12px;
    }
    .bg-warning-subtle { background-color: #fff9e6 !important; }

    /* Table Styles */
    .table thead th { border: none; font-size: 11px; letter-spacing: 0.5px; }
    .table tbody tr { transition: all 0.2s; border-bottom: 1px solid #f1f3f4; }
    .table tbody tr:hover { background-color: #f8f9fa; }
    .table td { padding: 1rem 0.5rem; border: none; }

    /* Boutons d'action stylisés */
    .btn-action {
        width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;
        border-radius: 10px; border: none; transition: all 0.2s; text-decoration: none;
    }
    
    .btn-show { background: #e3f2fd; color: #1976d2; }
    .btn-show:hover { background: #1976d2; color: #fff; transform: translateY(-2px); }

    .btn-edit { background: #fff3e0; color: #f57c00; }
    .btn-edit:hover { background: #f57c00; color: #fff; transform: translateY(-2px); }

    .btn-delete { background: #ffebee; color: #d32f2f; }
    .btn-delete:hover { background: #d32f2f; color: #fff; transform: translateY(-2px); }

    /* Modals */
    .modal-content { border-radius: 20px; }
</style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#languesTable').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success', // tu peux garder l'icône “success” ou mettre “info”
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#f6c23e', // jaune
                color: '#000', // texte noir pour contraste
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
