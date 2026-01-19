@extends('layout')

@section('title')
    Liste des types de médias
@endsection

@section('content')
<div class="container-fluid px-4 py-4">
    
    {{-- En-tête de page --}}
    <div class="d-flex align-items-center container-fluid px-4 py-4">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">Configuration des Médias</h1>
            <p class="text-muted small">Gérez les différents formats de fichiers autorisés dans le système</p>
        </div>
        <a href="{{ route('type_media.create') }}" class="btn btn-google-primary shadow-sm">
            <i class="fa-solid fa-plus me-2"></i> Ajouter un type
        </a>
    </div>

    <div class="card container-fluid px-4 py-4 row">
        <div class="card-body p-0"> {{-- p-0 pour que le tableau touche les bords si besoin --}}
            
            @if($mediaTypes->count())
                <div class="table-responsive">
                    <table id="media-types-table" class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 text-uppercase x-small fw-bold text-muted" style="width: 80px;">#</th>
                                <th class="py-3 text-uppercase x-small fw-bold text-muted">Nom du Type</th>
                                <th class="pe-4 py-3 text-uppercase x-small fw-bold text-muted text-center" style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mediaTypes as $mediaType)
                                <tr>
                                    <td class="ps-4 fw-medium text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="media-icon-circle me-3">
                                                <i class="fa-solid fa-file-code"></i>
                                            </div>
                                            <span class="fw-bold text-dark">{{ $mediaType->nom }}</span>
                                        </div>
                                    </td>
                                    <td class="pe-4 text-center">
                                        <div class="btn-group shadow-sm rounded-pill bg-white border p-1">
                                            <a href="{{ route('type_media.edit', $mediaType->id) }}"
                                               class="btn btn-action-icon text-primary"
                                               title="Modifier">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            
                                            @can('delete-type-media')
                                                <button type="button" 
                                                        class="btn btn-action-icon text-danger" 
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal{{ $mediaType->id }}"
                                                        title="Supprimer">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal de suppression (Look Minimaliste) --}}
                                <div class="modal fade" id="deleteModal{{ $mediaType->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content border-0 shadow-lg">
                                            <div class="modal-body p-4 text-center">
                                                <div class="text-danger mb-3">
                                                    <i class="fa-solid fa-circle-exclamation fa-3x"></i>
                                                </div>
                                                <h5 class="fw-bold">Supprimer ?</h5>
                                                <p class="text-muted small">Voulez-vous vraiment supprimer le type <strong>"{{ $mediaType->nom }}"</strong> ? Cette action est irréversible.</p>
                                                
                                                <div class="d-flex justify-content-center gap-2 mt-4">
                                                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('type_media.destroy', $mediaType->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger rounded-pill px-3">Confirmer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                {{-- État Vide --}}
                <div class="text-center py-5">
                    <img src="https://illustrations.popsy.co/amber/no-messages.svg" alt="Empty" style="width: 200px;" class="mb-3 opacity-75">
                    <h5 class="text-dark fw-bold">Aucun type de média</h5>
                    <p class="text-muted px-4">Votre bibliothèque de types est vide pour le moment.</p>
                    <a href="{{ route('type_media.create') }}" class="btn btn-google-primary rounded-pill px-4">
                        <i class="fa-solid fa-plus me-1"></i> Créer le premier
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Global & Typography */ 
    body { background-color: #f8f9fa; }
    .x-small { font-size: 0.75rem; letter-spacing: 0.05rem; }

    /* Table Styles */
    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dadce0;
        letter-spacing: 0.5px;
    }
    .table tbody tr {
        transition: background-color 0.2s ease;
    }
    .table tbody tr:hover {
        background-color: #f1f3f4;
    }
    .table td {
        padding-top: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f1f3f4;
    }

    /* Icon Circle */
    .media-icon-circle {
        width: 38px;
        height: 38px;
        background: #e8f0fe;
        color: #1a73e8;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    /* Action Buttons */
    .btn-action-icon {
        border: none;
        background: transparent;
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s;
    }
    .btn-action-icon:hover {
        background-color: #f1f3f4;
        transform: scale(1.1);
    }

    /* Google Primary Button */
    .btn-google-primary {
        background-color: #1a73e8;
        color: white;
        border-radius: 24px;
        padding: 8px 20px;
        font-weight: 500;
        border: none;
        transition: all 0.3s;
    }
    .btn-google-primary:hover {
        background-color: #174ea6;
        color: white;
        box-shadow: 0 4px 8px rgba(26, 115, 232, 0.2);
    }

    /* Modal Tweaks */
    .modal-content {
        border-radius: 20px;
    }
</style>
@endpush

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
                background: '#10b981',
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