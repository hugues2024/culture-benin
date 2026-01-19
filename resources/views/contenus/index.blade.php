@extends('layout')

@section('title')
    Liste des contenus
@endsection

@section('content')
<div class="container-fluid py-4"> 
    <div class="google-card border-0">
        
        <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
            <h4 class="card-title mb-0 fw-bold text-dark">
                <i class="bi bi-collection-play text-primary me-2"></i>
                Contenus culturels
            </h4>
            
            <a href="{{ route('contenus.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-bold">
                <i class="bi bi-plus-lg me-2"></i> Ajouter un contenu
            </a>
        </div>

        <div class="card-body p-0">
            @if($contenus->count() > 0)
                <div class="table-responsive">
                    <table id="contenusTable" class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted small text-uppercase fw-bold">
                            <tr>
                                <th class="ps-4">Titre</th>
                                <th>Auteur</th>
                                <th>Région</th>
                                <th>Langue</th>
                                <th>Type</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($contenus as $contenu)
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-bold text-dark">{{ $contenu->titre }}</span>
                                </td>
                                <td>
                                    @if($contenu->auteur)
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-xs bg-primary-subtle text-primary rounded-circle me-2 d-flex align-items-center justify-content-center" style="width: 28px; height: 28px;">
                                                <i class="bi bi-person-fill small"></i>
                                            </div>
                                            <span class="text-secondary small">{{ $contenu->auteur->prenom }} {{ $contenu->auteur->nom }}</span>
                                        </div>
                                    @else
                                        <span class="badge bg-light text-muted fw-normal">Non défini</span>
                                    @endif
                                </td>
                                <td>
                                    @if($contenu->region)
                                        <span class="text-muted small">
                                            <i class="bi bi-geo-alt-fill text-danger me-1 small"></i>
                                            {{ $contenu->region->nom_region }}
                                        </span>
                                    @else
                                        <span class="text-muted small">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($contenu->langue)
                                        <span class="badge-custom bg-info-subtle text-info">
                                            <i class="bi bi-translate me-1"></i>
                                            {{ $contenu->langue->nom_langue }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($contenu->type_contenu)
                                        <span class="badge-custom bg-secondary-subtle text-secondary">
                                            {{ $contenu->type_contenu->nom }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('contenus.show', $contenu->id) }}"
                                           class="btn btn-sm btn-outline-info rounded-circle action-btn"
                                           title="Voir les détails">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('contenus.edit', $contenu->id) }}"
                                           class="btn btn-sm btn-outline-warning rounded-circle action-btn"
                                           title="Modifier">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        @can('delete-contenus')
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger rounded-circle action-btn btn-delete"
                                                    title="Supprimer"
                                                    data-id="{{ $contenu->id }}"
                                                    data-name="{{ $contenu->titre }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486748.png" width="100" class="opacity-25 mb-3" alt="Vide">
                    <h5 class="text-muted fw-bold">Votre bibliothèque est vide</h5>
                    <p class="text-muted small">Aucun contenu culturel n'a été répertorié pour le moment.</p>
                    <a href="{{ route('contenus.create') }}" class="btn btn-primary rounded-pill mt-2">
                        <i class="bi bi-plus-circle me-2"></i> Ajouter votre premier contenu
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Carte style Google */
    .google-card {
        border: 1px solid #dadce0;
        border-radius: 12px;
        background: #fff;
        width: 100%;
    }

    /* Table & Lignes */
    .table thead th {
        border-top: none;
        background-color: #f8f9fa;
        padding: 12px 10px;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    .table tbody td {
        padding: 16px 10px;
        border-bottom: 1px solid #f1f3f4;
    }
    .table-hover tbody tr:hover {
        background-color: #fcfdfe !important;
    }

    /* Badges personnalisés */
    .badge-custom {
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }
    .bg-info-subtle { background-color: #e1f5fe !important; color: #0288d1 !important; }
    .bg-primary-subtle { background-color: #e8f0fe !important; color: #1a73e8 !important; }
    .bg-secondary-subtle { background-color: #f1f3f4 !important; color: #5f6368 !important; }

    /* Boutons d'action */
    .action-btn {
        width: 34px;
        height: 34px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .action-btn:hover {
        transform: translateY(-2px);
    }

    /* Bouton Ajouter */
    .btn-primary {
        background-color: #1a73e8;
        border: none;
    }
    .btn-primary:hover {
        background-color: #174ea6;
        box-shadow: 0 4px 8px rgba(26, 115, 232, 0.3);
    }

    /* DataTables Overrides */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 20px;
        padding: 6px 15px;
        border: 1px solid #dadce0;
    }
    .dataTables_wrapper .dataTables_length select {
        border-radius: 8px;
        border: 1px solid #dadce0;
    }
</style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            @if($contenus->count() > 0)
            // Initialisation du datatable
            $('#contenusTable').DataTable({
                language: {
                    processing:     "Traitement en cours...",
                    search:         "Rechercher :",
                    lengthMenu:    "Afficher _MENU_ éléments",
                    info:           "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                    infoEmpty:      "Affichage de 0 à 0 sur 0 éléments",
                    infoFiltered:   "(filtrés de _MAX_ éléments au total)",
                    infoPostFix:    "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords:    "Aucun élément à afficher",
                    emptyTable:     "Aucune donnée disponible dans le tableau",
                    paginate: {
                        first:      "Premier",
                        previous:   "Précédent",
                        next:       "Suivant",
                        last:       "Dernier"
                    },
                    aria: {
                        sortAscending:  ": activer pour trier la colonne par ordre croissant",
                        sortDescending: ": activer pour trier la colonne par ordre décroissant"
                    }
                },
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                responsive: true,
                autoWidth: false,
                columnDefs: [
                    { orderable: false, targets: 5 } // Actions non triables
                ]
            });
            @endif

            // Gestion de la suppression avec SweetAlert
            $('.btn-delete').on('click', function() {
                const contenuId = $(this).data('id');
                const contenuTitre = $(this).data('name');

                Swal.fire({
                    title: 'Supprimer le contenu ?',
                    html: `Êtes-vous sûr de vouloir supprimer <strong>"${contenuTitre}"</strong> ?<br>Cette action est irréversible !`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler',
                    confirmButtonColor: '#e74a3b',
                    cancelButtonColor: '#6c757d',
                    backdrop: true,
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Créer un formulaire de suppression dynamique
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `{{ url('/admin/contenus') }}/${contenuId}`;
                        form.style.display = 'none';

                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';

                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';

                        form.appendChild(csrfToken);
                        form.appendChild(methodField);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });

            // Toast succès
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

            // Toast suppression
            @if(session('deleted'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'warning',
                title: "{{ session('deleted') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#f6c23e',
                color: '#000',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            @endif

            // Toast erreur
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
