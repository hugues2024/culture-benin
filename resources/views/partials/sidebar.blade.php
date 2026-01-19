<aside class="app-sidebar d-flex flex-column">

    <div class="sidebar-wrapper flex-grow-1 overflow-y-auto py-2 px-3">
        <nav>
            <ul class="nav flex-column gap-1">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('home') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-google-blue me-3"><i class="bi bi-house-door fs-5 text-primary"></i></div>
                        <span class="fw-medium">Accueil</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('profile.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-google-green me-3"><i class="bi bi-person-badge fs-5 text-success"></i></div>
                        <span class="fw-medium">Informations personnelles</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('users.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-google-yellow me-3"><i class="bi bi-people fs-5 text-warning"></i></div>
                        <span class="fw-medium">Utilisateurs</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('type_media.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('type_media.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-google-red me-3"><i class="bi bi-tags fs-5 text-danger"></i></div>
                        <span class="fw-medium">Types Média</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('type_contenu.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('type_contenu.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-google-blue me-3"><i class="bi bi-folder2-open fs-5 text-primary"></i></div>
                        <span class="fw-medium">Types Contenu</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('medias.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('medias.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-google-green me-3"><i class="bi bi-camera-video fs-5 text-success"></i></div>
                        <span class="fw-medium">Médias</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('contenus.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('contenus.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-google-yellow me-3"><i class="bi bi-file-earmark-text fs-5 text-warning"></i></div>
                        <span class="fw-medium">Contenus</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('langues.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('langues.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-google-red me-3"><i class="bi bi-translate fs-5 text-danger"></i></div>
                        <span class="fw-medium">Langues</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('regions.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('regions.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-google-blue me-3"><i class="bi bi-geo-alt fs-5 text-primary"></i></div>
                        <span class="fw-medium">Régions</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('commentaires.index') }}" class="nav-link py-2 px-4 rounded-pill d-flex align-items-center {{ request()->routeIs('commentaires.*') ? 'active-google' : 'text-dark hover-google' }}">
                        <div class="icon-circle bg-google-green me-3"><i class="bi bi-chat-left-text fs-5 text-success"></i></div>
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

    <div class="sidebar-footer p-4 mt-auto">
        <div class="d-flex flex-wrap gap-2 text-muted" style="font-size: 0.75rem;">
            <a href="#" class="text-reset text-decoration-none hover-underline">Confidentialité</a>
            <a href="#" class="text-reset text-decoration-none hover-underline">Conditions</a>
            <a href="#" class="text-reset text-decoration-none hover-underline">Aide</a>
            <a href="#" class="text-reset text-decoration-none hover-underline">À propos</a>
        </div>
    </div>
</aside>

        <style>

/* Suppression des bordures de la sidebar */

.app-sidebar {
    border-right: none !important; /* Enlève la ligne de séparation */
    box-shadow: none !important;  /* Enlève l'ombre si elle existe */
    position: fixed;
    top: 64px; /* Sous le header */
    left: 0;
    width: 280px;
    height: calc(100vh - 64px);
    z-index: 1000;
    background-color: #f8f9fa !important; /* Fond gris clair */
    /* La Sidebar : occupe toute la hauteur sous le header, défilement interne seulement */

    width: 280px;
    height: calc(100vh - 64px); /* Hauteur totale moins le header */
    position: fixed;
    top: 64px;
    left: 0;
    overflow-y: auto; /* Permet à la sidebar de défiler si le contenu est long */
    overflow-x: hidden;
    background-color: #f8f9fa !important;
    border-right: none !important;
}

/* Style des liens sans bordure au survol */
.nav-link {
    border: none !important;
}

/* Le contenu principal s'adapte à la sidebar */
main {
    border: none !important;
}

/* Ajustement pour le texte de pied de page dans la sidebar */
.sidebar-footer {
    border-top: none !important; /* Suppression de la ligne en haut du footer sidebar */
    padding-top: 20px;
}


/* Scrollbar discrète style Google (Optionnel) */
.app-sidebar::-webkit-scrollbar, 
main::-webkit-scrollbar {
    width: 8px;
}

.app-sidebar::-webkit-scrollbar-thumb, 
main::-webkit-scrollbar-thumb {
    background: #e0e0e0;
    border-radius: 10px;
}


/* Tailles de texte spécifiques */

.x-small { font-size: 0.75rem; line-height: 1.4; }



/* Effets de survol et état actif style Google */

.hover-google:hover {

    background-color: #f1f3f4;

}



.active-google {

    background-color: #e8f0fe !important;

    color: #1a73e8 !important;

}



.active-google .icon-circle {

    background-color: #1a73e8 !important;

}



.active-google .icon-circle i {

    color: #fff !important;

}



/* Cercles d'icônes avec couleurs pastels */

.icon-circle {

    width: 32px;

    height: 32px;

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    transition: all 0.2s;

}



.bg-primary-light { background-color: #e8f0fe; }

.bg-success-light { background-color: #e6f4ea; }

.bg-info-light    { background-color: #e4f7fb; }

.bg-warning-light { background-color: #fef7e0; }

.bg-danger-light  { background-color: #fce8e6; }

.bg-secondary-light { background-color: #f1f3f4; }



/* Ajustement du layout principal */

.content-wrapper {

    margin-left: 280px; /* Doit correspondre à la largeur de la sidebar */

    padding: 2rem;

    transition: all 0.3s;

}

</style>

<scrpit>



</scrpit>