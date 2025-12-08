@extends('layout')

@section('title')
    Liste des Régions
@endsection

@section('content')

    <style>
        /* --- Card Modern --- */
        .custom-card {
            border-radius: 12px;
            overflow: hidden;
            border: none !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .custom-card-header {
            background: linear-gradient(135deg, #F0C43B, #F0C43B);
            color: white;
            padding: 18px 20px;
        }

        .custom-card-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 20px;
        }

        /* --- Table --- */
        #regions-table thead {
            background: #f1f2f6;
            font-weight: bold;
        }

        #regions-table tbody tr:hover {
            background: #f8f9fc !important;
            transition: 0.2s;
        }

        /* --- Icon Buttons Modern --- */
        .icon-btn {
            border: none;
            color: white;
            padding: 8px 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s ease-in-out;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 36px;
            height: 36px;
            font-size: 15px;
        }

        .btn-edit {
            background: #f6c23e;
        }

        .btn-edit:hover {
            background: #dda20a;
            transform: scale(1.1);
        }

        .btn-delete {
            background: #e74a3b;
        }

        .btn-delete:hover {
            background: #c0392b;
            transform: scale(1.1);
        }

        .btn-info {
            background: #36b9cc;
        }

        .btn-info:hover {
            background: #2c9faf;
            transform: scale(1.1);
        }

        .no-link-style {
            text-decoration: none;
            color: inherit;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Bouton Ajouter moderne */
        .btn-add-modern {
            background: linear-gradient(135deg, #F0C43B, #F0C43B);
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(78, 115, 223, 0.3);
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-add-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(78, 115, 223, 0.4);
            background: linear-gradient(135deg, #F0C43B, #F0C43B);
            color: white;
        }

        /* Datatable - Alignement horizontal */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            display: inline-block;
            margin-bottom: 15px;
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
        }

        .dataTables_wrapper .dataTables_length {
            float: left;
        }

        .dataTables_wrapper .dataTables_info {
            float: left;
            padding-top: 10px;
        }

        .dataTables_wrapper .dataTables_paginate {
            float: right;
            padding-top: 10px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 6px;
            border: 1px solid #d1d3e2;
            padding: 5px 10px;
            margin-left: 10px;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 6px;
            border: 1px solid #d1d3e2;
            padding: 5px 10px;
            margin: 0 10px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #F0C43B !important;
            color: white !important;
        }

        .dataTables_wrapper:after {
            content: "";
            display: table;
            clear: both;
        }

        /* État vide amélioré */
        .empty-state {
            padding: 3rem 1rem;
            text-align: center;
        }

        .empty-state img {
            opacity: 0.6;
            margin-bottom: 1.5rem;
        }

        .empty-state h5 {
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }

        /* Badges pour les statistiques */
        .stat-badge {
            background: #e8f4fd;
            color: #1976d2;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .stat-badge.population {
            background: #e8f5e8;
            color: #2e7d32;
        }

        .stat-badge.superficie {
            background: #fff3e0;
            color: #ef6c00;
        }

        .localisation-badge {
            background: #f3e5f5;
            color: #7b1fa2;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
    </style>

    <div class="card custom-card mb-4">
        <div class="card-header custom-card-header">
            <h3 class="card-title">Régions du Bénin</h3>
        </div>

        <div class="card-body">
            @if ($regions->count() === 0)
                <div class="empty-state">
                    <img src="https://cdn-icons-png.flaticon.com/512/6356/6356656.png" width="120" alt="Aucune région">
                    <h5>Aucune région trouvée</h5>
                    <p>Commencez par ajouter votre première région.</p>
                    <a href="{{ route('regions.create') }}" class="btn btn-add-modern">
                        <i class="bi bi-plus-circle me-2"></i> Ajouter une région
                    </a>
                </div>
            @else
                <!-- Bouton Ajouter -->
                <div class="mb-4 d-flex justify-content-start">
                    <a href="{{ route('regions.create') }}" class="btn btn-add-modern">
                        <i class="bi bi-plus-circle me-2"></i> Ajouter une région
                    </a>
                </div>

                <div class="table-responsive">
                    <table id="regions-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Population</th>
                                <th>Superficie</th>
                                <th>Localisation</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regions as $region)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ $region->nom_region }}</strong>
                                    </td>
                                    <td>
                                        <span class="stat-badge population">
                                            <i class="bi bi-people-fill"></i>
                                            {{ number_format($region->population) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="stat-badge superficie">
                                            <i class="bi bi-map"></i>
                                            {{ number_format($region->superficie, 2) }} km²
                                        </span>
                                    </td>
                                    <td>
                                        @if ($region->localisation)
                                            <span class="localisation-badge">
                                                <i class="bi bi-geo-alt"></i>
                                                {{ $region->localisation }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <!-- Voir -->
                                        <a href="{{ route('regions.show', $region->id) }}"
                                            class="icon-btn btn-info mx-1 no-link-style" title="Voir les détails">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <!-- Modifier -->
                                        <a href="{{ route('regions.edit', $region->id) }}"
                                            class="icon-btn btn-edit mx-1 no-link-style" title="Modifier">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        @can('delete-regions')
                                            <!-- Supprimer -->
                                            <button type="button" class="icon-btn btn-delete mx-1 btn-delete" title="Supprimer"
                                                data-id="{{ $region->id }}" data-name="{{ $region->nom_region }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

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
