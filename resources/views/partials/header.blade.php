<nav class="app-header navbar navbar-expand bg-white shadow-sm border-bottom">
    <div class="container-fluid">

        <!-- Menu burger + Logo -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-dark" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list fs-5"></i>
                </a>
            </li>

            <li class="nav-item d-none d-md-block">
                <a href="{{ route('home') }}" class="nav-link text-dark fw-semibold">
                    <i class="bi bi-house-door me-2 text-primary"></i> Tableau de Bord Bénin-culture
                </a>
            </li>
        </ul>

        <!-- Éléments de droite -->
        <ul class="navbar-nav ms-auto align-items-center">

            <!-- Search -->
            <li class="nav-item me-2">
                <div class="navbar-search-wrapper" style="display: none;">
                    <div class="input-group">
                        <input type="text" class="form-control border-primary" placeholder="Rechercher..."
                            style="border-radius: 20px 0 0 20px;">
                        <button class="btn btn-primary" type="button" style="border-radius: 0 20px 20px 0;">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <a class="nav-link text-dark search-toggle" href="#" role="button">
                    <i class="bi bi-search fs-6"></i>
                </a>
            </li>


            <!-- User Menu -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle text-dark d-flex align-items-center"
                    data-bs-toggle="dropdown" style="gap: 8px;">
                    @if (Auth::user()->photo)
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                            class="user-image rounded-circle shadow-sm" alt="{{ Auth::user()->nom }}"
                            style="width: 32px; height: 32px; object-fit: cover;">
                    @else
                        <div class="user-image rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center bg-primary"
                            style="width: 32px; height: 32px;">
                            <i class="bi bi-person-fill text-white small"></i>
                        </div>
                    @endif
                    <span class="d-none d-md-inline fw-semibold">
                        {{ Auth::user()->nom ?? 'Agent Culturel' }}
                    </span>
                    <i class="bi bi-chevron-down small text-muted"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="min-width: 240px;">
                    <li class="user-header bg-gradient-primary text-white text-center py-4 rounded-top">
                        @if (auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                                class="rounded-circle shadow mb-2" alt="Photo de {{ auth()->user()->name }}"
                                style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            @php
                                // Générer une couleur basée sur le nom de l'utilisateur
$colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57', '#ff9ff3'];
$colorIndex = crc32(auth()->user()->nom) % count($colors);
$bgColor = $colors[$colorIndex];

// Récupérer les initiales
$initials = implode(
    '',
    array_map(function ($name) {
        return strtoupper(substr($name, 0, 1));
    }, explode(' ', auth()->user()->nom)),
                                );

                                $initials = substr($initials, 0, 2);
                            @endphp
                            <div class="rounded-circle shadow mb-2 d-inline-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px; background-color: {{ $bgColor }};">
                                <span class="text-white fw-bold fs-4">{{ $initials }}</span>
                            </div>
                        @endif

                        <h6 class="mb-1 fw-semibold">{{ auth()->user()->nom ?? 'Agent Culturel' }}</h6>
                        <p class="small mb-0 opacity-75">{{ auth()->user()->role->nom ?? 'Rôle inconnu' }}</p>
                        <small class="opacity-75">
                            Membre depuis {{ auth()->user()->created_at->format('Y') }}
                        </small>
                    </li>

                    <li class="user-body px-3 py-2">
                        <div class="row text-center">
                            <div class="col-6">
                                <a href="{{ route('profile.edit') }}" class="text-decoration-none">
                                    <div class="text-dark">
                                        <i class="bi bi-person fs-5 d-block"></i>
                                        <small>Profil</small>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="text-decoration-none">
                                    <div class="text-dark">
                                        <i class="bi bi-gear fs-5 d-block"></i>
                                        <small>Paramètres</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>

                    <li class="user-footer border-top px-3 py-2">
                        <div class="d-flex justify-content-between">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-box-arrow-right me-1"></i>Déconnexion
                                </button>
                            </form>
                            <a href="#" class="btn btn-primary btn-sm">
                                <i class="bi bi-shield-lock me-1"></i>Sécurité
                            </a>
                        </div>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
</nav>

<style>
    /* Variables de couleurs pour le header */
    :root {
        --header-bg-white: #ffffff;
        --header-bg-light: #f8f9fa;
        --header-text-black: #000000;
        --header-link-gold: #f7c948;
        --header-link-gold-dark: #d4a72d;
        --header-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
        --header-border-light: #e9ecef;
        --header-hover-light: #f8f9fa;
    }

    .app-header {
        background: linear-gradient(135deg, var(--header-bg-white) 0%, var(--header-bg-light) 100%);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        box-shadow: var(--header-shadow); /* Shadow en bas pour séparer */
        border-bottom: 1px solid var(--header-border-light);
    }

    .navbar-nav .nav-link {
        color: var(--header-text-black) !important;
        transition: all 0.3s ease;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        margin: 0 2px;
    }

    .navbar-nav .nav-link:hover {
        background-color: var(--header-hover-light);
        color: var(--header-link-gold) !important;
        transform: translateY(-1px);
    }

    .navbar-nav .nav-link:active {
        transform: translateY(0);
    }

    .dropdown-menu {
        border: 1px solid var(--header-border-light);
        animation: dropdownFadeIn 0.2s ease;
        background-color: var(--header-bg-white);
    }

    @keyframes dropdownFadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-header {
        border-radius: 8px 8px 0 0 !important;
        padding: 1rem;
        color: var(--header-text-black);
        background-color: var(--header-bg-light);
    }

    .dropdown-item {
        color: var(--header-text-black);
        transition: all 0.2s ease;
        border-radius: 6px;
        margin: 2px 8px;
        width: auto;
    }

    .dropdown-item:hover {
        background-color: var(--header-hover-light);
        color: var(--header-link-gold) !important;
        transform: translateX(5px);
    }

    .user-image {
        border: 2px solid var(--header-border-light);
        transition: all 0.3s ease;
    }

    .user-menu:hover .user-image {
        border-color: var(--header-link-gold);
        transform: scale(1.05);
    }

    .badge {
        font-size: 0.6rem;
        padding: 0.25em 0.4em;
        background-color: var(--header-link-gold);
        color: var(--header-text-black);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--header-link-gold) 0%, var(--header-link-gold-dark) 100%) !important;
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, var(--header-link-gold) 0%, var(--header-link-gold-dark) 100%) !important;
    }

    .navbar-search-wrapper {
        animation: slideInSearch 0.3s ease;
    }

    @keyframes slideInSearch {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .img-size-40 {
        width: 40px;
        height: 40px;
        object-fit: cover;
    }

    .user-header {
        background: linear-gradient(135deg, var(--header-link-gold) 0%, var(--header-link-gold-dark) 100%) !important;
        color: var(--header-text-black) !important;
    }

    .btn-outline-primary {
        border-color: var(--header-link-gold);
        color: var(--header-link-gold);
    }

    .btn-outline-primary:hover {
        background-color: var(--header-link-gold);
        border-color: var(--header-link-gold);
        color: var(--header-text-black) !important;
    }

    /* Style pour le bouton de déconnexion dans le formulaire */
    .user-footer form button {
        transition: all 0.3s ease;
        color: var(--header-text-black);
        border-color: var(--header-link-gold);
    }

    .user-footer form button:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px var(--header-link-gold-shadow);
        background-color: var(--header-link-gold);
        color: var(--header-text-black);
    }
</style>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle search bar
        const searchToggle = document.querySelector('.search-toggle');
        const searchWrapper = document.querySelector('.navbar-search-wrapper');

        if (searchToggle && searchWrapper) {
            searchToggle.addEventListener('click', function(e) {
                e.preventDefault();
                searchWrapper.style.display = searchWrapper.style.display === 'none' ? 'block' : 'none';
            });
        }

        // Close search when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.navbar-search-wrapper') && !e.target.closest('.search-toggle')) {
                if (searchWrapper) {
                    searchWrapper.style.display = 'none';
                }
            }
        });
    });
</script>
