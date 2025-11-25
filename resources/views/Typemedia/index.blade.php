@extends('layout')

@section('title')
    Liste des types de médias
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
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: white;
            padding: 18px 20px;
        }

        .custom-card-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 20px;
        }

        /* --- Table --- */
        #media-types-table thead {
            background: #f1f2f6;
            font-weight: bold;
        }

        #media-types-table tbody tr:hover {
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

        .no-link-style {
            text-decoration: none;
            color: inherit;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-info {
            background: #36b9cc;
            color: white;
        }

        .btn-info:hover {
            background: #2c9faf;
            transform: scale(1.1);
        }

        /* Bouton Ajouter moderne */
        .btn-add-modern {
            background: linear-gradient(135deg, #4e73df, #224abe);
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(78, 115, 223, 0.3);
        }

        .btn-add-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(78, 115, 223, 0.4);
            background: linear-gradient(135deg, #224abe, #4e73df);
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
            background: #4e73df !important;
            color: white !important;
        }

        .dataTables_wrapper:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Modal amélioré */
        .modal-content {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-radius: 12px 12px 0 0;
            padding: 15px 20px;
        }

        .modal-footer {
            border-radius: 0 0 12px 12px;
            padding: 15px 20px;
        }
    </style>

    <div class="card custom-card mb-4">
        <div class="card-header custom-card-header">
            <h3 class="card-title">Types de médias disponibles</h3>
        </div>

        <div class="card-body">
            <!-- Bouton Ajouter -->
            <div class="mb-4 d-flex justify-content-start">
                <a href="{{ route('type_media.create') }}" class="btn btn-add-modern d-flex align-items-center">
                    <i class="fa-solid fa-plus me-2"></i> Ajouter un type de média
                </a>
            </div>

            @if($mediaTypes->count())
                <table id="media-types-table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($mediaTypes as $mediaType)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mediaType->nom }}</td>
                            <td class="text-center">
                                <a href="{{ route('type_media.edit', $mediaType->id) }}"
                                   class="icon-btn btn-edit mx-1 no-link-style"
                                   title="Modifier">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                             @can('delete-type-media')
                                <!-- Bouton Supprimer avec icône -->
                                <button type="button" class="icon-btn btn-delete mx-1" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $mediaType->id }}"
                                        title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                             @endcan
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{ $mediaType->id }}" tabindex="-1"
                             aria-labelledby="deleteModalLabel{{ $mediaType->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $mediaType->id }}">Confirmation</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes-vous sûr de vouloir supprimer le type de média :
                                        <strong>"{{ $mediaType->nom }}"</strong> ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler
                                        </button>
                                        <form action="{{ route('type_media.destroy', $mediaType->id) }}" method="POST"
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-folder-x text-muted" style="font-size: 3rem;"></i>
                    <h5 class="text-muted mt-3">Aucun type de média trouvé</h5>
                    <p class="text-muted">Commencez par ajouter votre premier type de média.</p>
                    <a href="{{ route('type_media.create') }}" class="btn btn-primary mt-2">
                        <i class="fa-solid fa-plus me-1"></i> Ajouter un type
                    </a>
                </div>
            @endif
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            @if($mediaTypes->count())
            $('#media-types-table').DataTable({
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
                    { orderable: false, targets: 2 } // Actions non triables
                ]
            });
            @endif
        });
    </script>

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
                background: '#1cc88a',
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
        });
    </script>
@endpush