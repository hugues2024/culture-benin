@extends('layout')

@section('title')
    Liste des Utilisateurs
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm custom-card">
            <div class="card-header custom-card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="bi bi-people-fill me-2"></i>Liste des Utilisateurs</h4>
            </div>

            <div class="card-body p-4">
                @if ($users->count() === 0)
                    <div class="text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486748.png" width="120"
                            class="mb-3 opacity-75">
                        <h5 class="text-muted mb-3">Aucun utilisateur trouvé</h5>
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Ajouter le premier utilisateur
                        </a>
                    </div>
                @else
                    <!-- En-tête avec bouton et statistiques -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Ajouter un utilisateur
                        </a>
                        <span class="text-muted">
                            <strong>{{ $users->count() }}</strong> utilisateur(s) au total
                        </span>
                    </div>

                    <!-- Tableau -->
                    <div class="table-responsive">
                        <table id="users-table" class="table table-striped table-hover custom-table">
                            <thead class="custom-table-header">
                                <tr>
                                    <th width="50">#</th>
                                    <th>Nom complet</th>
                                    <th>Email</th>
                                    <th>Date de naissance</th>
                                    <th>Sexe</th>
                                    <th>Rôle</th>
                                    <th>Langue</th>
                                    <th>Statut</th>
                                    <th width="120" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="fw-semibold">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($user->photo)
                                                    <img src="{{ asset('storage/' . $user->photo) }}"
                                                        alt="{{ $user->prenom }}" class="rounded-circle me-2" width="32"
                                                        height="32" style="object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2"
                                                        style="width: 32px; height: 32px;">
                                                        <i class="bi bi-person text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-semibold">{{ $user->prenom }} {{ $user->nom }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ optional($user->date_naissance)->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark">
                                                {{ ucfirst($user->sexe ?? '-') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info text-white">
                                                {{ $user->role->nom ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                {{ $user->langue->nom_langue ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($user->statut === 'actif')
                                                <span class="badge custom-badge-active">Actif</span>
                                            @else
                                                <span class="badge custom-badge-inactive">Inactif</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <!-- Voir -->
                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class="btn btn-sm btn-info btn-action" title="Voir détails">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <!-- Éditer -->
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-sm btn-warning btn-action" title="Modifier">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                             @can('delete-users')
                                                <!-- Supprimer -->
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger btn-action btn-delete"
                                                        title="Supprimer">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
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
@endsection

@push('styles')
    <style>
        .custom-card {
            border-radius: 12px;
            overflow: hidden;
            border: none;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .custom-card-header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            padding: 18px 25px;
            color: white;
        }

        .custom-card-header h4 {
            margin: 0;
            font-weight: 600;
            font-size: 1.3rem;
        }

        .custom-table-header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }

        .custom-table-header th {
            border: none;
            padding: 15px 12px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
            transform: translateY(-1px);
        }

        .btn-action {
            border-radius: 6px;
            padding: 6px 8px;
            transition: all 0.2s ease;
        }

        .btn-action:hover {
            transform: scale(1.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            border: none;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-primary:hover {
            transform: scale(1.03);
            background: linear-gradient(135deg, #2980b9, #2573a7);
        }

        .custom-badge-active {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
        }

        .custom-badge-inactive {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
        }

        .custom-badge-pending {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
        }

        .card-body {
            padding: 25px !important;
        }

        .container {
            max-width: 100%;
            padding: 0 20px;
        }

        .table td {
            vertical-align: middle;
            padding: 12px;
        }

        .badge {
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* Styles corrigés pour DataTables */
        .dataTables_wrapper {
            margin-top: 20px;
        }

        .dataTables_filter {
            text-align: right !important;
            margin-bottom: 15px;
        }

        .dataTables_filter input {
            display: inline-block !important;
            width: auto !important;
            margin-left: 10px;
        }

        .dataTables_length {
            text-align: left !important;
            margin-bottom: 15px;
        }

        /* 👉 Ajoute ceci juste après */
        .dataTables_length select {
            width: 100px !important;
            /* élargit */
            min-width: 100px !important;
        }

        .dataTables_length select {
            display: inline-block !important;
            width: auto !important;
            margin: 0 10px;
        }

        .dataTables_info {
            padding-top: 15px !important;
            text-align: left;
        }

        .dataTables_paginate {
            padding-top: 15px !important;
            text-align: right !important;
        }

        .dataTables_length select {
            width: 80px !important;
            /* élargit le select */
            min-width: 80px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 6px !important;
            margin: 0 2px;
            padding: 6px 12px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #3498db, #2980b9) !important;
            border: none !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #3498db !important;
            color: white !important;
            border: none !important;
        }


        /* Responsive */
        @media (max-width: 768px) {

            .dataTables_length,
            .dataTables_filter {
                text-align: center !important;
                margin-bottom: 10px;
            }

            .dataTables_info,
            .dataTables_paginate {
                text-align: center !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if ($users->count() > 0)
                $('#users-table').DataTable({
                    language: {
                        "processing": "Traitement en cours...",
                        "search": "Rechercher :",
                        "lengthMenu": "Afficher _MENU_ éléments",
                        "info": "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
                        "infoEmpty": "Affichage de 0 à 0 sur 0 éléments",
                        "infoFiltered": "(filtrés de _MAX_ éléments au total)",
                        "infoPostFix": "",
                        "loadingRecords": "Chargement en cours...",
                        "zeroRecords": "Aucun élément à afficher",
                        "emptyTable": "Aucune donnée disponible dans le tableau",
                        "paginate": {
                            "first": "Premier",
                            "previous": "Précédent",
                            "next": "Suivant",
                            "last": "Dernier"
                        },
                        "aria": {
                            "sortAscending": ": activer pour trier la colonne par ordre croissant",
                            "sortDescending": ": activer pour trier la colonne par ordre décroissant"
                        }
                    },
                    pageLength: 10,
                    responsive: true,
                    order: [
                        [1, 'asc']
                    ],
                    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                    initComplete: function() {
                        // Styles Bootstrap pour les contrôles DataTables
                        $('.dataTables_filter input').addClass('form-control form-control-sm').attr(
                            'placeholder', 'Rechercher...');
                        $('.dataTables_length select').addClass('form-select form-select-sm');
                    },
                    drawCallback: function() {
                        // Réappliquer les styles après chaque redessinage
                        $('.dataTables_filter input').addClass('form-control form-control-sm').attr(
                            'placeholder', 'Rechercher...');
                        $('.dataTables_length select').addClass('form-select form-select-sm');
                    }
                });
            @endif

            // SweetAlert Suppression
            document.querySelectorAll(".btn-delete").forEach(btn => {
                btn.addEventListener("click", function() {
                    let form = this.closest("form");
                    Swal.fire({
                        title: 'Confirmer la suppression',
                        text: "Cette action est irréversible !",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Oui, supprimer',
                        cancelButtonText: 'Annuler',
                        confirmButtonColor: '#e74c3c',
                        cancelButtonColor: '#3498db',
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
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
                    background: '#3498db',
                    color: '#fff',
                    iconColor: '#fff'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#e74c3c',
                    color: '#fff',
                    iconColor: '#fff'
                });
            @endif
        });
    </script>
@endpush
