@extends('layout')

@section('title')
    Culture-Bénin | Tableau de bord
@endsection

@section('content')
    <div class="container-fluid py-4" style="margin: 0 auto;">
        <div class="text-center mb-5">
            <div class="position-relative d-inline-block mb-3">
                <div class="rounded-circle bg-danger d-flex align-items-center justify-content-center shadow-sm" 
                    style="width: 90px; height: 90px; font-size: 40px; color: white;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <button class="btn btn-sm btn-light position-absolute bottom-0 end-0 rounded-circle border shadow-sm p-1">
                    <i class="bi bi-camera"></i>
                </button>
            </div>
            <h2 class="fw-normal mb-1">Bienvenue, {{ Auth::user()->name }}</h2>
            <p class="text-muted">Gérez vos informations et la plateforme Culture-Bénin</p>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="input-group input-group-lg border rounded-pill px-3 bg-white shadow-sm search-container">
                    <span class="input-group-text bg-transparent border-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Rechercher dans le compte Culture-Bénin" style="font-size: 1rem;">
                </div>
                <div class="d-flex justify-content-center gap-2 mt-3 flex-wrap">
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Mon profil</a>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Utilisateurs</a>
                    <a href="{{ route('contenus.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">Contenus</a>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card h-100 border rounded-4 hover-shadow transition">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="rounded-circle bg-google-blue d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="bi bi-journal-bookmark text-primary fs-4"></i>
                            </div>
                            <span class="fs-2 fw-bold text-dark">{{ $totalContenus }}</span>
                        </div>
                        <h6 class="card-title fw-bold">Contenus culturels</h6>
                        <p class="card-text text-muted small">Gestion des articles et publications du patrimoine.</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4 px-4 text-end">
                        <a href="{{ route('contenus.index') }}" class="text-primary text-decoration-none fw-medium">Gérer <i class="bi bi-arrow-right small"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 border rounded-4 hover-shadow transition">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="rounded-circle bg-google-green d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="bi bi-translate text-success fs-4"></i>
                            </div>
                            <span class="fs-2 fw-bold text-dark">{{ $totalLangues }}</span>
                        </div>
                        <h6 class="card-title fw-bold">Langues</h6>
                        <p class="card-text text-muted small">Diversité linguistique du Bénin répertoriée.</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4 px-4 text-end">
                        <a href="{{ route('langues.index') }}" class="text-success text-decoration-none fw-medium">Voir plus <i class="bi bi-arrow-right small"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 border rounded-4 hover-shadow transition">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="rounded-circle bg-google-yellow d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="bi bi-chat-left-text text-warning fs-4"></i>
                            </div>
                            <span class="fs-2 fw-bold text-dark">{{ $totalCommentaires }}</span>
                        </div>
                        <h6 class="card-title fw-bold">Commentaires</h6>
                        <p class="card-text text-muted small">Interactions et retours des utilisateurs.</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4 px-4 text-end">
                        <a href="{{ route('commentaires.index') }}" class="text-warning text-decoration-none fw-medium">Modérer <i class="bi bi-arrow-right small"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card h-100 border rounded-4 hover-shadow transition">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="rounded-circle bg-google-red d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="bi bi-people text-danger fs-4"></i>
                            </div>
                            <span class="fs-2 fw-bold text-dark">{{ $totalUsers }}</span>
                        </div>
                        <h6 class="card-title fw-bold">Utilisateurs</h6>
                        <p class="card-text text-muted small">Membres et administrateurs du système.</p>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4 px-4 text-end">
                        <a href="{{ route('users.index') }}" class="text-danger text-decoration-none fw-medium">Détails <i class="bi bi-arrow-right small"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border rounded-4 p-3 shadow-sm">
                    <h6 class="fw-bold mb-4 p-2">Contenus par langue</h6>
                    <div style="height: 300px;">
                        <canvas id="contenusLangueChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border rounded-4 p-3 shadow-sm">
                    <h6 class="fw-bold mb-4 p-2">Commentaires par contenu</h6>
                    <div style="height: 300px;">
                        <canvas id="commentairesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <style>
        /* Animation au survol des cartes */
        .transition {
            transition: all 0.2s ease-in-out;
        }
        .hover-shadow:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        /* Barrettes de couleur Google pour les icônes (réutilisation de tes classes) */
        .bg-google-blue   { background-color: #e8f0fe; }
        .bg-google-green  { background-color: #e6f4ea; }
        .bg-google-yellow { background-color: #fef7e0; }
        .bg-google-red    { background-color: #fce8e6; }

        /* Focus sur la recherche style Google */
        .search-container:focus-within {
            box-shadow: 0 1px 6px rgba(32,33,36,0.28) !important;
            background-color: #fff;
        }

        /* Arrondis plus doux comme Google Account */
        .rounded-4 {
            border-radius: 1rem !important;
        }
    </style>
@endsection

@push('scripts')
    <script>
        // Données envoyées depuis le controller
        const languesLabels = @json($contenusParLangue->keys());
        const languesValues = @json($contenusParLangue->values());

        const commentairesLabels = @json($commentairesParContenu->keys());
        const commentairesValues = @json($commentairesParContenu->values());

        // Diagramme en bâtons : contenus par langue
        new Chart(document.getElementById('contenusLangueChart'), {
            type: 'bar',
            data: {
                labels: languesLabels,
                datasets: [{
                    label: 'Nombre de contenus',
                    data: languesValues,
                    backgroundColor: '#4e73df'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Contenus par langue'
                    }
                }
            }
        });

        // Diagramme semi-circulaire : commentaires par contenu
        new Chart(document.getElementById('commentairesChart'), {
            type: 'doughnut',
            data: {
                labels: commentairesLabels,
                datasets: [{
                    data: commentairesValues,
                    backgroundColor: ['#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Commentaires par contenu'
                    }
                }
            }
        });
    </script>
@endpush
