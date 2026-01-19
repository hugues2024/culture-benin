@extends('layout')

@section('title')
    Liste des Médias
@endsection

@section('content')

<div class="container-fluid py-4">

    <div class="card google-card shadow-sm border-0 mb-4">

        

        <div class="card-header bg-white py-4 border-bottom position-relative">

            <div class="header-accent-line-yellow"></div>

            <div class="d-flex align-items-center justify-content-between">

                <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <div class="icon-circle bg-warning-subtle text-warning me-3">
                    <i class="bi bi-tags-fill"></i>
                </div>
                <div>
                    <h4 class="card-title mb-0 fw-bold text-dark">Gestion des Médias</h4>
                </div>
            </div>

            <a href="{{ route('medias.create') }}" class="btn btn-warning rounded-pill px-4 fw-bold text-white shadow-sm d-none d-sm-block" style="background-color: #F0C43B; border: none;">
                <i class="bi bi-plus-lg me-2"></i>Nouveau Média
            </a>
        </div>

                </div>

        </div>



        <div class="card-body p-0"> <div class="table-responsive">

                <table id="mediasTable" class="table align-middle custom-table mb-0">

                    <thead>

                        <tr>

                            <th class="ps-4 text-uppercase small fw-bold text-muted border-0">#</th>

                            <th class="text-uppercase small fw-bold text-muted border-0">Contenu associé</th>

                            <th class="text-uppercase small fw-bold text-muted border-0">Type de Média</th>

                            <th class="text-center text-uppercase small fw-bold text-muted border-0 pe-4">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($medias as $media)

                            <tr class="hover-row">

                                <td class="ps-4">

                                    <span class="badge bg-light text-dark border rounded-pill shadow-xs">

                                        {{ $loop->iteration }}

                                    </span>

                                </td>

                                <td>

                                    <div class="fw-bold text-dark">{{ $media->contenu->titre ?? 'N/A' }}</div>

                                </td>

                                <td>

                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3">

                                        {{ $media->type_media->nom ?? 'N/A' }}

                                    </span>

                                </td>

                                <td class="text-center pe-4">

                                    <div class="d-flex justify-content-center">

                                        <a href="{{ route('medias.show', $media->id) }}" 

                                           class="btn btn-sm btn-outline-info border-0 rounded-circle mx-1 action-btn" 

                                           title="Voir les détails">

                                            <i class="bi bi-eye fs-5"></i>

                                        </a>



                                        <a href="{{ route('medias.edit', $media->id) }}" 

                                           class="btn btn-sm btn-outline-warning border-0 rounded-circle mx-1 action-btn" 

                                           title="Modifier" >

                                            <i class="bi bi-pencil-square fs-5"></i>

                                        </a>



                                        @can('delete-medias')

                                            <button type="button" 

                                                    class="btn btn-sm btn-outline-danger border-0 rounded-circle mx-1 action-btn" 

                                                    data-bs-toggle="modal"

                                                    data-bs-target="#deleteModal{{ $media->id }}"

                                                    title="Supprimer">

                                                <i class="bi bi-trash fs-5"></i>

                                            </button>

                                        @endcan

                                    </div>

                                </td>

                            </tr>



                            <div class="modal fade" id="deleteModal{{ $media->id }}" tabindex="-1" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content border-0 shadow-lg">

                                        <div class="modal-header bg-danger text-white border-0">

                                            <h5 class="modal-title fw-bold"><i class="bi bi-exclamation-triangle me-2"></i>Confirmation</h5>

                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>

                                        </div>

                                        <div class="modal-body py-4 text-center">

                                            <p class="mb-0">Êtes-vous sûr de vouloir supprimer le média associé à :</p>

                                            <h5 class="fw-bold mt-2 text-danger">"{{ $media->contenu->titre ?? 'N/A' }}"</h5>

                                            <small class="text-muted">Cette action est irréversible.</small>

                                        </div>

                                        <div class="modal-footer bg-light border-0 justify-content-center">

                                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Annuler</button>

                                            <form action="{{ route('medias.destroy', $media->id) }}" method="POST">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger rounded-pill px-4">Supprimer définitivement</button>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>



                        @empty

                            <tr>

                                <td colspan="4" class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>

                                        Aucun média trouvé dans la base de données.

                                    </div>

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



@push('style')

<style>

    /* Global Card Style */

    .google-card { border-radius: 16px; overflow: hidden; background: #fff; }

    

    .header-accent-line-yellow {

        position: absolute; top: 0; left: 0; right: 0; height: 4px;

        background: #F0C43B;

    }



    .icon-circle {

        width: 48px; height: 48px; display: flex;

        align-items: center; justify-content: center; border-radius: 12px;

    }



    /* Table Styles */

    .custom-table thead { background-color: #f8f9fa; }

    .custom-table th { padding: 1.25rem 1rem !important; }

    .custom-table td { padding: 1rem !important; }



    .hover-row:hover { background-color: #fffdf5 !important; }



    /* Buttons & Actions */

    .action-btn {

        width: 38px; height: 38px; display: flex;

        align-items: center; justify-content: center; transition: all 0.2s;

    }

    .action-btn:hover { background-color: #f8f9fa; transform: translateY(-2px); }



    /* Badges */

    .bg-warning-subtle { background-color: #fff9e6 !important; color: #F0C43B !important; }

    .bg-primary-subtle { background-color: #eef2ff !important; color: #4f46e5 !important; }

    

    .shadow-xs { box-shadow: 0 1px 2px rgba(0,0,0,0.05); }



    /* Modals */

    .modal-content { border-radius: 18px; }

    .modal-header { border-radius: 18px 18px 0 0; }

</style>

@endpush

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#mediasTable').DataTable({
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
                background: '#f6c23e',
                color: '#000',
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