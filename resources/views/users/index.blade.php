@extends('layout')

@section('title')
    Liste des Utilisateurs
@endsection

@section('content')
<div class="container-fluid px-0 py-3" style="background-color: #f8f9fa; min-height: 100vh;">
    {{-- Header avec Statistiques et Action --}}
    <div class="d-flex justify-content-between align-items-center mb-4 px-4">
        <div>
            <h1 class="h4 fw-bold text-dark mb-0">Gestion des utilisateurs</h1>
            <p class="text-muted small mb-0">{{ $users->count() }} comptes enregistrés sur la plateforme</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm d-flex align-items-center">
            <i class="bi bi-plus-lg me-2"></i> Ajouter un utilisateur
        </a>
    </div>

    {{-- Conteneur Principal 100% Largeur --}}
    <div class="bg-white border-top border-bottom shadow-sm">
        @if ($users->count() === 0)
            <div class="text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486748.png" width="80" class="mb-3 opacity-50">
                <h5 class="text-muted">Aucun utilisateur trouvé</h5>
            </div>
        @else
            <div class="table-responsive" style="overflow-x: hidden;"> {{-- Suppression du scroll horizontal --}}
                <table id="users-table" class="table align-middle mb-0 custom-google-table">
                    <thead>
                        <tr>
                            <th class="ps-4">#</th>
                            <th>UTILISATEUR</th>
                            <th>EMAIL</th>
                            <th>DATE NAISSANCE</th>
                            <th>RÔLE & LANGUE</th>
                            <th>STATUT</th>
                            <th class="text-center pe-4">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="ps-4 text-muted small">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if ($user->photo)
                                        <img src="{{ asset('storage/' . $user->photo) }}" class="rounded-circle border me-3" width="40" height="40" style="object-fit: cover;">
                                    @else
                                        <div class="google-avatar-circle me-3" data-name="{{ $user->prenom }}">
                                            {{ substr($user->prenom, 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-bold text-dark">{{ $user->prenom }} {{ $user->nom }}</div>
                                        <span class="text-muted x-small text-uppercase">{{ $user->sexe ?? 'N/D' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="small fw-medium">{{ $user->email }}</td>
                            <td class="small text-muted">
                                <i class="bi bi-calendar3 me-1"></i> {{ optional($user->date_naissance)->format('d M Y') }}
                            </td>
                            <td>
                                <span class="badge badge-soft-blue mb-1">{{ $user->role->nom ?? '-' }}</span><br>
                                <span class="text-muted x-small"><i class="bi bi-translate"></i> {{ $user->langue->nom_langue ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="status-pill {{ $user->statut === 'actif' ? 'active' : 'inactive' }}">
                                    {{ ucfirst($user->statut) }}
                                </span>
                            </td>
                            <td class="pe-4">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('users.show', $user->id) }}" class="action-icon text-primary" title="Voir">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="action-icon text-warning" title="Modifier">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    @can('delete-users')
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="button" class="action-icon text-danger btn-delete border-0 bg-transparent">
                                            <i class="bi bi-trash3-fill"></i>
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
@endsection

@push('styles')
<style>
    /* Table Layout 100% sans Scroll */
.custom-google-table {
    width: 100% !important;
    border-collapse: collapse;
    table-layout: fixed; /* Force le respect des largeurs sans dépasser l'écran */
}

.custom-google-table thead th {
    background-color: #ffffff;
    color: #5f6368;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.8px;
    padding: 16px 8px;
    border-bottom: 1px solid #ebebeb;
}

.custom-google-table tbody tr {
    transition: background 0.15s;
    border-bottom: 1px solid #f1f3f4;
}

.custom-google-table tbody tr:hover {
    background-color: #f8f9fa;
    box-shadow: inset 1px 0 0 #4285f4;
}

/* Avatars Style Google */
.google-avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #4285f4;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 500;
    font-size: 1.1rem;
}

/* Badges & Status */
.badge-soft-blue {
    background-color: #e8f0fe;
    color: #1967d2;
    font-weight: 500;
    border-radius: 4px;
    padding: 4px 8px;
}

.status-pill {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}
.status-pill.active { background-color: #e6f4ea; color: #137333; }
.status-pill.inactive { background-color: #fce8e6; color: #c5221f; }

/* Icônes d'action épurées */
.action-icon {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background 0.2s;
    text-decoration: none;
}
.action-icon:hover { background-color: rgba(60,64,67,0.1); }

.x-small { font-size: 0.7rem; }
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
                    background: '#10b981', // Vert vif
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
