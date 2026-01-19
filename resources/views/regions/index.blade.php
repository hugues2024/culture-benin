@extends('layout')

@section('title')
    Liste des Régions
@endsection

@section('content')

    <div class="container-fluid py-4">

    <div class="card google-card shadow-sm border-0">

        

        <div class="card-header bg-white py-4 border-bottom position-relative">

            <div class="header-accent-line-yellow"></div>

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">

                <div class="d-flex align-items-center">

                    <div class="icon-circle bg-warning-subtle text-warning me-3">

                        <i class="bi bi-map-fill"></i>

                    </div>

                    <div>

                        <h4 class="card-title mb-0 fw-bold text-dark">Régions du Bénin</h4>

                    </div>

                </div>

                

                @if ($regions->count() > 0)

                <a href="{{ route('regions.create') }}" class="btn btn-warning rounded-pill px-4 fw-bold text-white shadow-sm">

                    <i class="bi bi-plus-lg me-2"></i>Nouvelle Région

                </a>

                @endif

            </div>

        </div>



        <div class="card-body p-0">

            @if ($regions->count() === 0)

                <div class="empty-state-container py-5 text-center">

                    <div class="empty-state-icon mb-4">

                        <img src="https://cdn-icons-png.flaticon.com/512/6356/6356656.png" width="150" class="img-fluid opacity-75" alt="Aucune région">

                    </div>

                    <h3 class="fw-bold text-dark">Aucune région enregistrée</h3>

                    <p class="text-muted mb-4 mx-auto" style="max-width: 400px;">

                        Votre base de données territoriale est vide. Commencez par ajouter les départements ou régions du Bénin.

                    </p>

                    <a href="{{ route('regions.create') }}" class="btn btn-warning rounded-pill px-5 fw-bold text-white shadow-sm py-2">

                        <i class="bi bi-plus-circle me-2"></i> Ajouter ma première région

                    </a>

                </div>

            @else

                <div class="table-responsive">

                    <table id="regions-table" class="table table-hover align-middle mb-0">

                        <thead class="bg-light">

                            <tr>

                                <th class="ps-4 py-3 text-uppercase small fw-bolder text-muted">#</th>

                                <th class="py-3 text-uppercase small fw-bolder text-muted">Nom</th>

                                <th class="py-3 text-uppercase small fw-bolder text-muted">Démographie</th>

                                <th class="py-3 text-uppercase small fw-bolder text-muted">Territoire</th>

                                <th class="py-3 text-uppercase small fw-bolder text-muted">Localisation</th>

                                <th class="py-3 text-uppercase small fw-bolder text-muted text-center">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($regions as $region)

                                <tr>

                                    <td class="ps-4 text-muted fw-bold">{{ $loop->iteration }}</td>

                                    <td>

                                        <div class="fw-bold text-dark fs-6">{{ $region->nom_region }}</div>

                                    </td>

                                    <td>

                                        <div class="d-flex flex-column">

                                            <span class="fw-bold text-dark">{{ number_format($region->population) }}</span>

                                            <span class="text-muted tiny-text text-uppercase fw-bold">Habitants</span>

                                        </div>

                                    </td>

                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div class="superficie-chip">

                                                <i class="bi bi-bounding-box-circles me-1 text-warning"></i>

                                                {{ number_format($region->superficie, 2) }} <small>km²</small>

                                            </div>

                                        </div>

                                    </td>

                                    <td>

                                        @if ($region->localisation)

                                            <span class="badge bg-light text-primary border rounded-pill px-3">

                                                <i class="bi bi-geo-alt-fill me-1"></i> {{ $region->localisation }}

                                            </span>

                                        @else

                                            <span class="text-muted small italic">Non définie</span>

                                        @endif

                                    </td>

                                    <td class="text-center pe-4">

                                        <div class="d-flex justify-content-center gap-2">

                                            <a href="{{ route('regions.show', $region->id) }}" 

                                               class="btn-action btn-show" title="Détails">

                                                <i class="bi bi-eye"></i>

                                            </a>

                                            <a href="{{ route('regions.edit', $region->id) }}" 

                                               class="btn-action btn-edit" title="Modifier">

                                                <i class="bi bi-pencil"></i>

                                            </a>

                                            @can('delete-regions')

                                            <button type="button" class="btn-action btn-delete btn-delete-trigger" 

                                                    data-id="{{ $region->id }}" data-name="{{ $region->nom_region }}">

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

            @endif

        </div>

    </div>

</div>



<style>

    /* Carte Google Style */

    .google-card { border-radius: 15px; overflow: hidden; background: #fff; }

    .header-accent-line-yellow {

        position: absolute; top: 0; left: 0; right: 0; height: 4px; background: #F0C43B;

    }



    /* Icônes */

    .icon-circle {

        width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; border-radius: 12px;

        font-size: 1.25rem;

    }

    .bg-warning-subtle { background-color: #fff9e6 !important; }



    /* Table & Chips */

    .table thead th { border: none; font-size: 11px; letter-spacing: 0.5px; }

    .table tbody tr { border-bottom: 1px solid #f1f3f4; transition: background 0.2s; }

    .table tbody tr:hover { background-color: #fffdf5; }

    

    .superficie-chip {

        background: #f8f9fa;

        padding: 4px 12px;

        border-radius: 8px;

        font-weight: 600;

        color: #444;

        border: 1px solid #eee;

    }



    .tiny-text { font-size: 0.65rem; letter-spacing: 0.5px; }



    /* Boutons d'action */

    .btn-action {

        width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;

        border-radius: 8px; border: none; transition: all 0.2s; text-decoration: none;

    }

    .btn-show { background: #e3f2fd; color: #1976d2; }

    .btn-show:hover { background: #1976d2; color: #fff; }



    .btn-edit { background: #fff3e0; color: #f57c00; }

    .btn-edit:hover { background: #f57c00; color: #fff; }



    .btn-delete { background: #ffebee; color: #d32f2f; }

    .btn-delete:hover { background: #d32f2f; color: #fff; }



    /* Empty State */

    .empty-state-container { padding: 4rem 1rem; }

    .empty-state-icon img { transition: transform 0.3s ease; }

    .empty-state-container:hover .empty-state-icon img { transform: scale(1.05) rotate(5deg); }

</style>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            @if ($regions->count() > 0)
                // Initialisation du datatable avec configuration française
                $('#regions-table').DataTable({
                    language: {
                        processing: "Traitement en cours...",
                        search: "Rechercher :",
                        lengthMenu: "Afficher _MENU_ éléments",
                        info: "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                        infoEmpty: "Affichage de 0 à 0 sur 0 éléments",
                        infoFiltered: "(filtrés de _MAX_ éléments au total)",
                        infoPostFix: "",
                        loadingRecords: "Chargement en cours...",
                        zeroRecords: "Aucun élément à afficher",
                        emptyTable: "Aucune donnée disponible dans le tableau",
                        paginate: {
                            first: "Premier",
                            previous: "Précédent",
                            next: "Suivant",
                            last: "Dernier"
                        },
                        aria: {
                            sortAscending: ": activer pour trier la colonne par ordre croissant",
                            sortDescending: ": activer pour trier la colonne par ordre décroissant"
                        }
                    },
                    pageLength: 10,
                    lengthMenu: [5, 10, 25, 50],
                    responsive: true,
                    autoWidth: false,
                    columnDefs: [{
                            orderable: false,
                            targets: 5
                        } // Colonne Actions non triable
                    ]
                });
            @endif

            // SweetAlert - Confirmation suppression
            $('.btn-delete').on('click', function() {
                const regionId = $(this).data('id');
                const regionName = $(this).data('name');

                Swal.fire({
                    title: 'Supprimer la région ?',
                    html: `Êtes-vous sûr de vouloir supprimer <strong>"${regionName}"</strong> ?<br>Cette action est irréversible !`,
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
                        form.action = `{{ url('regions') }}/${regionId}`;
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
            @if (session('success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#1cc88a',
                    color: '#fff',
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
            @endif

            // Toast suppression
            @if (session('deleted'))
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
            @if (session('error'))
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
