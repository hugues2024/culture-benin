<aside id="appSidebar" class="app-sidebar d-flex flex-column">
    <div class="sidebar-wrapper flex-grow-1 overflow-y-auto py-2 px-3">
        <nav>
            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('home') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-primary-light me-3"><i class="bi bi-house-door fs-5 text-primary"></i></div>
                        <span class="fw-medium">Accueil</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('profile.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-success-light me-3"><i class="bi bi-person-badge fs-5 text-success"></i></div>
                        <span class="fw-medium">Informations personnelles</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('users.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-warning-light me-3"><i class="bi bi-people fs-5 text-warning"></i></div>
                        <span class="fw-medium">Utilisateurs</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('type_media.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('type_media.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-danger-light me-3"><i class="bi bi-tags fs-5 text-danger"></i></div>
                        <span class="fw-medium">Types Média</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('type_contenu.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('type_contenu.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-primary-light me-3"><i class="bi bi-folder2-open fs-5 text-primary"></i></div>
                        <span class="fw-medium">Types Contenu</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('medias.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('medias.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-success-light me-3"><i class="bi bi-camera-video fs-5 text-success"></i></div>
                        <span class="fw-medium">Médias</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('contenus.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('contenus.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-warning-light me-3"><i class="bi bi-file-earmark-text fs-5 text-warning"></i></div>
                        <span class="fw-medium">Contenus</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('langues.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('langues.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-danger-light me-3"><i class="bi bi-translate fs-5 text-danger"></i></div>
                        <span class="fw-medium">Langues</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('regions.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('regions.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-primary-light me-3"><i class="bi bi-geo-alt fs-5 text-primary"></i></div>
                        <span class="fw-medium">Régions</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('commentaires.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('commentaires.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-success-light me-3"><i class="bi bi-chat-left-text fs-5 text-success"></i></div>
                        <span class="fw-medium">Commentaires</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('roles.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('roles.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-secondary-light me-3"><i class="bi bi-shield-check fs-5 text-secondary"></i></div>
                        <span class="fw-medium">Rôles</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="sidebar-footer p-4 mt-auto border-0">
        <div class="d-flex flex-wrap gap-2 text-muted" style="font-size: 0.75rem;">
            <a href="#" class="text-reset text-decoration-none">Confidentialité</a>
            <a href="#" class="text-reset text-decoration-none">Conditions</a>
            <a href="#" class="text-reset text-decoration-none">Aide</a>
            <a href="#" class="text-reset text-decoration-none">À propos</a>
        </div>
    </div>
</aside>

<div id="sidebarOverlay" class="sidebar-overlay"></div>

<style>
/* --- BASE SIDEBAR --- */
.app-sidebar {
    position: fixed;
    top: 64px; /* Hauteur de ton header */
    left: 0;
    width: 280px;
    height: calc(100vh - 64px);
    z-index: 1100;
    background-color: #f8f9fa !important;
    border-right: none !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow-x: hidden;
}

/* Styles Google */
.hover-google:hover { background-color: #f1f3f4; }
.active-google {
    background-color: #e8f0fe !important;
    color: #1a73e8 !important;
}
.active-google .icon-circle { background-color: #1a73e8 !important; }
.active-google .icon-circle i { color: #fff !important; }

.icon-circle {
    width: 32px; height: 32px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
}

/* Couleurs Pastels */
.bg-primary-light { background-color: #e8f0fe; }
.bg-success-light { background-color: #e6f4ea; }
.bg-warning-light { background-color: #fef7e0; }
.bg-danger-light   { background-color: #fce8e6; }
.bg-secondary-light { background-color: #f1f3f4; }

/* Scrollbar Google */
.sidebar-wrapper::-webkit-scrollbar { width: 6px; }
.sidebar-wrapper::-webkit-scrollbar-thumb { background: #dadce0; border-radius: 10px; }

/* --- LOGIQUE MOBILE (RESPONSIVE) --- */
@media (max-width: 991.98px) {
    .app-sidebar {
        top: 0;
        height: 100vh;
        left: -280px; /* Masqué par défaut */
    }

    /* Classe d'ouverture */
    .show-sidebar {
        left: 0 !important;
        box-shadow: 10px 0 25px rgba(0,0,0,0.1) !important;
    }

    .sidebar-overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.4);
        backdrop-filter: blur(2px);
        z-index: 1030;
        display: none;
    }

    .sidebar-overlay.active { display: block; }
}

/* Ajustement du contenu principal */
.content-wrapper {
    margin-left: 280px;
    transition: margin-left 0.3s ease;
}

@media (max-width: 991.98px) {
    .content-wrapper { margin-left: 0 !important; }
}
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const menuBtn = document.getElementById('menuBtn'); // L'ID de ton icône carrée dans le header
    const sidebar = document.getElementById('appSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function toggleSidebar() {
        sidebar.classList.toggle('show-sidebar');
        overlay.classList.toggle('active');
        
        // Bloquer le scroll du body quand le menu est ouvert
        if(sidebar.classList.contains('show-sidebar')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    }

    if(menuBtn) {
        menuBtn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleSidebar();
        });
    }

    if(overlay) {
        overlay.addEventListener('click', toggleSidebar);
    }
    
    // Fermer si on clique sur un lien en mobile
    const links = document.querySelectorAll('.nav-link');
    links.forEach(l => {
        l.addEventListener('click', () => {
            if(window.innerWidth < 992) toggleSidebar();
        });
    });
});
</script>