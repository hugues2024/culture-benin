@extends('layout')

@section('title')
    Liste des Types de Contenu
@endsection

@section('content')

    <div class="card google-card shadow-sm border-0 mb-4">
    
    <div class="card-header bg-white py-4 border-bottom position-relative">
        <div class="header-accent-line-yellow"></div>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="icon-circle bg-warning-subtle text-warning me-3">
                    <i class="bi bi-tags-fill"></i>
                </div>
                <div>
                    <h4 class="card-title mb-0 fw-bold text-dark">Types de contenu</h4>
                </div>
            </div>
            
            <a href="{{ route('type_contenu.create') }}" class="btn btn-warning rounded-pill px-4 fw-bold text-white shadow-sm d-none d-sm-block" style="background-color: #F0C43B; border: none;">
                <i class="bi bi-plus-lg me-2"></i>Nouveau Type
            </a>
        </div>
    </div>

    <div class="card-body p-4">
        
        @if($typeContenus->count() === 0)
            <div class="text-center py-5">
                <div class="mb-4">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486748.png" 
                         width="120" 
                         alt="Aucun type" 
                         style="opacity: 0.5; filter: grayscale(1);">
                </div>
                <h5 class="fw-bold text-dark">Aucun type de contenu trouvé</h5>
                <p class="text-muted">Commencez par créer votre première catégorie pour organiser vos récits.</p>
                <a href="{{ route('type_contenu.create') }}" class="btn btn-warning rounded-pill px-4 fw-bold text-white mt-2" style="background-color: #F0C43B; border: none;">
                    <i class="bi bi-plus-lg me-2"></i>Créer un type de contenu
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table id="type-contenu-table" class="table align-middle custom-table">
                    <thead>
                        <tr>
                            <th class="border-0 text-uppercase small fw-bold text-muted ps-4" style="width: 80px;">#</th>
                            <th class="border-0 text-uppercase small fw-bold text-muted">Nom de la catégorie</th>
                            <th class="border-0 text-uppercase small fw-bold text-muted">Date de création</th>
                            <th class="border-0 text-uppercase small fw-bold text-muted text-center" style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($typeContenus as $tc)
                            <tr class="hover-row">
                                <td class="ps-4">
                                    <span class="badge bg-light text-dark rounded-pill shadow-sm border">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $tc->nom }}</div>
                                </td>
                                <td>
                                    <div class="text-muted small">
                                        <i class="bi bi-calendar3 me-2"></i>{{ $tc->created_at->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('type_contenu.edit', $tc->id) }}" 
                                           class="btn btn-sm btn-outline-warning border-0 rounded-circle mx-1 action-btn" 
                                           title="Modifier"
                                           style="color: #F0C43B;">
                                            <i class="bi bi-pencil-square fs-5"></i>
                                        </a>

                                        @can('delete-type-contenu')
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger border-0 rounded-circle mx-1 action-btn btn-delete" 
                                                    title="Supprimer"
                                                    data-id="{{ $tc->id }}"
                                                    data-name="{{ $tc->nom }}">
                                                <i class="bi bi-trash fs-5"></i>
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<style>
    /* Styles spécifiques pour la table */
    .custom-table thead {
        background-color: #f8f9fa;
    }
    
    .custom-table tr {
        transition: all 0.2s ease;
    }

    .hover-row:hover {
    }

    .action-btn {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .bg-warning-subtle {
        background-color: #fff9e6 !important;
    }
</style>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {

        // Active DataTables si il y a des données
        @if($typeContenus->count() > 0)
        $('#type-contenu-table').DataTable({
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
                { orderable: false, targets: 3 } // Actions non triables
            ]
        });
        @endif

        // SweetAlert Suppression
        document.querySelectorAll(".btn-delete").forEach(btn => {
            btn.addEventListener("click", function () {
                const typeId = this.getAttribute('data-id');
                const typeName = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Supprimer le type de contenu ?',
                    html: `Êtes-vous sûr de vouloir supprimer <strong>"${typeName}"</strong> ?<br>Cette action est irréversible !`,
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
                        form.action = `{{ url('/admin/type_contenu') }}/${typeId}`;
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
