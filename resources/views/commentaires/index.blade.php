@extends('layout')

@section('title')
    Liste des Commentaires
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
        #commentairesTable thead {
            background: #f1f2f6;
            font-weight: bold;
        }

        #commentairesTable tbody tr:hover {
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

        /* Badges et styles pour commentaires */
        .user-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .content-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #e8f4fd;
            color: #1976d2;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
        }

        .comment-text {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .stars-rating {
            display: inline-flex;
            gap: 2px;
        }

        .date-badge {
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
            <h3 class="card-title">Commentaires des utilisateurs</h3>
        </div>

        <div class="card-body">
            @if($commentaires->count() > 0)
                <table id="commentairesTable" class="table table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Utilisateur</th>
                            <th>Contenu</th>
                            <th>Commentaire</th>
                            <th>Note</th>
                            <th>Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($commentaires as $commentaire)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="user-badge">
                                    <i class="bi bi-person-circle text-primary"></i>
                                    {{ $commentaire->user->nom ?? 'Utilisateur inconnu' }}
                                </span>
                            </td>

                            <td>
                                <span class="content-badge">
                                    <i class="bi bi-file-text-fill"></i>
                                    {{ Str::limit($commentaire->contenu->titre ?? 'N/A', 25) }}
                                </span>
                            </td>

                            <td>
                                <span class="comment-text" title="{{ $commentaire->commentaire }}">
                                    {{ Str::limit($commentaire->commentaire, 40) }}
                                </span>
                            </td>

                            <td>
                                <div class="stars-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $commentaire->note ? '-fill text-warning' : '' }} fs-6"></i>
                                    @endfor
                                    <small class="text-muted ms-1">({{ $commentaire->note }}/5)</small>
                                </div>
                            </td>

                            <td>
                                <span class="date-badge">
                                    <i class="bi bi-calendar3"></i>
                                    {{ $commentaire->created_at->format('d/m/Y') }}
                                </span>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('commentaires.show', $commentaire->id) }}"
                                   class="icon-btn btn-info mx-1 no-link-style"
                                   title="Voir les détails">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('commentaires.edit', $commentaire->id) }}"
                                   class="icon-btn btn-edit mx-1 no-link-style"
                                   title="Modifier">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                              @can('delete-commentaires')
                                <!-- Bouton Supprimer avec icône -->
                                <button type="button" 
                                        class="icon-btn btn-delete mx-1 btn-delete"
                                        title="Supprimer"
                                        data-id="{{ $commentaire->id }}"
                                        data-author="{{ $commentaire->user->nom ?? 'Utilisateur inconnu' }}"
                                        data-content="{{ Str::limit($commentaire->commentaire, 30) }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                              @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486748.png" width="120" alt="Aucun commentaire">
                    <h5>Aucun commentaire trouvé</h5>
                    <p>Les commentaires des utilisateurs apparaîtront ici.</p>
                </div>
            @endif
        </div>
    </div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    @if($commentaires->count() > 0)
    // Initialisation datatable avec configuration française complète
    $('#commentairesTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        autoWidth: false,
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
        columnDefs: [
            { orderable: false, targets: 6 } // Colonne Actions non triable
        ]
    });
    @endif

    // Confirmation suppression
    $('.btn-delete').on('click', function() {
        const commentId = $(this).data('id');
        const author = $(this).data('author');
        const content = $(this).data('content');
        
        Swal.fire({
            title: 'Supprimer le commentaire ?',
            html: `Êtes-vous sûr de vouloir supprimer le commentaire de <strong>${author}</strong> ?<br>
                  <em>"${content}"</em><br><br>
                  Cette action est irréversible !`,
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
                form.action = `{{ url('commentaires') }}/${commentId}`;
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
        background: '#1cc88a',
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