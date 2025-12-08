<aside class="app-sidebar bg-white shadow-lg" data-bs-theme="light">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand border-bottom">
        <!--begin::Brand Link-->
        <a href="{{ route('home') }}" class="brand-link text-decoration-none">
            <!--begin::Brand Image-->
            <img
                src="{{ asset('adminlte/img/benin.png') }}"
                alt="Logo Culture Bénin"
                class="brand-image opacity-100 shadow-sm rounded-circle"
                style="width: 40px; height: 40px; object-fit: cover;"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-bold text-primary fs-6">BÉNIN-CULTURE</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper py-3">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
            >
                <!-- Dashboard -->
                <li class="nav-item mb-1">
                    <a href="{{ route('home') }}" class="nav-link rounded-3 mx-2 {{ request()->routeIs('home') ? 'active bg-primary text-white' : 'text-dark' }}">
                        <i class="nav-icon bi bi-speedometer2 me-3 fs-6"></i>
                        <p class="mb-0 fw-medium">Tableau de Bord</p>
                    </a>
                </li>

                <!-- Users -->
                <li class="nav-item mb-1 {{ request()->routeIs('users.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link rounded-3 mx-2 {{ request()->routeIs('users.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                        <i class="nav-icon bi bi-people-fill me-3 fs-6"></i>
                        <p class="mb-0 fw-medium">
                            Utilisateurs
                            <i class="nav-arrow bi bi-chevron-down ms-auto fs-8"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview bg-light rounded-3 mx-2 mt-1 py-2">
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('users.create') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-plus-circle me-3 fs-7"></i>
                                <p class="mb-0">Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('users.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-list-ul me-3 fs-7"></i>
                                <p class="mb-0">Liste</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Type Media -->
                <li class="nav-item mb-1 {{ request()->routeIs('type_media.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link rounded-3 mx-2 {{ request()->routeIs('type_media.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                        <i class="nav-icon bi bi-collection-fill me-3 fs-6"></i>
                        <p class="mb-0 fw-medium">
                            Types Média
                            <i class="nav-arrow bi bi-chevron-down ms-auto fs-8"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview bg-light rounded-3 mx-2 mt-1 py-2">
                        <li class="nav-item">
                            <a href="{{ route('type_media.create') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('type_media.create') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-plus-circle me-3 fs-7"></i>
                                <p class="mb-0">Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('type_media.index') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('type_media.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-list-ul me-3 fs-7"></i>
                                <p class="mb-0">Liste</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Type Contenu -->
                <li class="nav-item mb-1 {{ request()->routeIs('type_contenu.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link rounded-3 mx-2 {{ request()->routeIs('type_contenu.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                        <i class="nav-icon bi bi-folder-fill me-3 fs-6"></i>
                        <p class="mb-0 fw-medium">
                            Types Contenu
                            <i class="nav-arrow bi bi-chevron-down ms-auto fs-8"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview bg-light rounded-3 mx-2 mt-1 py-2">
                        <li class="nav-item">
                            <a href="{{ route('type_contenu.create') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('type_contenu.create') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-plus-circle me-3 fs-7"></i>
                                <p class="mb-0">Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('type_contenu.index') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('type_contenu.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-list-ul me-3 fs-7"></i>
                                <p class="mb-0">Liste</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Media -->
                <li class="nav-item mb-1 {{ request()->routeIs('medias.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link rounded-3 mx-2 {{ request()->routeIs('medias.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                        <i class="nav-icon bi bi-camera-video-fill me-3 fs-6"></i>
                        <p class="mb-0 fw-medium">
                            Médias
                            <i class="nav-arrow bi bi-chevron-down ms-auto fs-8"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview bg-light rounded-3 mx-2 mt-1 py-2">
                        <li class="nav-item">
                            <a href="{{ route('medias.create') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('medias.create') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-plus-circle me-3 fs-7"></i>
                                <p class="mb-0">Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('medias.index') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('medias.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-list-ul me-3 fs-7"></i>
                                <p class="mb-0">Liste</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Contenu -->
                <li class="nav-item mb-1 {{ request()->routeIs('contenus.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link rounded-3 mx-2 {{ request()->routeIs('contenus.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                        <i class="nav-icon bi bi-file-earmark-text-fill me-3 fs-6"></i>
                        <p class="mb-0 fw-medium">
                            Contenus
                            <i class="nav-arrow bi bi-chevron-down ms-auto fs-8"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview bg-light rounded-3 mx-2 mt-1 py-2">
                        <li class="nav-item">
                            <a href="{{ route('contenus.create') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('contenus.create') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-plus-circle me-3 fs-7"></i>
                                <p class="mb-0">Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('contenus.index') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('contenus.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-list-ul me-3 fs-7"></i>
                                <p class="mb-0">Liste</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Langues -->
                <li class="nav-item mb-1 {{ request()->routeIs('langues.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link rounded-3 mx-2 {{ request()->routeIs('langues.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                        <i class="nav-icon bi bi-translate me-3 fs-6"></i>
                        <p class="mb-0 fw-medium">
                            Langues
                            <i class="nav-arrow bi bi-chevron-down ms-auto fs-8"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview bg-light rounded-3 mx-2 mt-1 py-2">
                        <li class="nav-item">
                            <a href="{{ route('langues.create') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('langues.create') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-plus-circle me-3 fs-7"></i>
                                <p class="mb-0">Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('langues.index') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('langues.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-list-ul me-3 fs-7"></i>
                                <p class="mb-0">Liste</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Région -->
                <li class="nav-item mb-1 {{ request()->routeIs('regions.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link rounded-3 mx-2 {{ request()->routeIs('regions.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                        <i class="nav-icon bi bi-geo-alt-fill me-3 fs-6"></i>
                        <p class="mb-0 fw-medium">
                            Régions
                            <i class="nav-arrow bi bi-chevron-down ms-auto fs-8"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview bg-light rounded-3 mx-2 mt-1 py-2">
                        <li class="nav-item">
                            <a href="{{ route('regions.create') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('regions.create') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-plus-circle me-3 fs-7"></i>
                                <p class="mb-0">Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('regions.index') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('regions.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-list-ul me-3 fs-7"></i>
                                <p class="mb-0">Liste</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Commentaire -->
                <li class="nav-item mb-1 {{ request()->routeIs('commentaires.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link rounded-3 mx-2 {{ request()->routeIs('commentaires.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                        <i class="nav-icon bi bi-chat-left-text-fill me-3 fs-6"></i>
                        <p class="mb-0 fw-medium">
                            Commentaires
                            <i class="nav-arrow bi bi-chevron-down ms-auto fs-8"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview bg-light rounded-3 mx-2 mt-1 py-2">
                        <li class="nav-item">
                            <a href="{{ route('commentaires.create') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('commentaires.create') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-plus-circle me-3 fs-7"></i>
                                <p class="mb-0">Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('commentaires.index') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('commentaires.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-list-ul me-3 fs-7"></i>
                                <p class="mb-0">Liste</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Role -->
                <li class="nav-item mb-1 {{ request()->routeIs('roles.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link rounded-3 mx-2 {{ request()->routeIs('roles.*') ? 'active bg-primary text-white' : 'text-dark' }}">
                        <i class="nav-icon bi bi-shield-fill-check me-3 fs-6"></i>
                        <p class="mb-0 fw-medium">
                            Rôles
                            <i class="nav-arrow bi bi-chevron-down ms-auto fs-8"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview bg-light rounded-3 mx-2 mt-1 py-2">
                        <li class="nav-item">
                            <a href="{{ route('roles.create') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('roles.create') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-plus-circle me-3 fs-7"></i>
                                <p class="mb-0">Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}"
                               class="nav-link rounded-2 {{ request()->routeIs('roles.index') ? 'active bg-primary text-white' : 'text-dark' }}">
                                <i class="nav-icon bi bi-list-ul me-3 fs-7"></i>
                                <p class="mb-0">Liste</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>

<style>
.app-sidebar {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-right: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.sidebar-brand {
    padding: 1.5rem 1rem;
    background: white;
}

.brand-link {
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s ease;
}

.brand-link:hover {
    transform: translateX(5px);
}

.brand-text {
    font-size: 1.1rem;
    letter-spacing: 0.5px;
}

.sidebar-menu .nav-link {
    transition: all 0.3s ease;
    border: none;
    margin: 2px 0;
    padding: 0.75rem 1rem;
}

.sidebar-menu .nav-link:hover {
    background-color: #e3f2fd !important;
    color: #F0C43B !important;
    transform: translateX(5px);
}

.sidebar-menu .nav-link.active {
    background: linear-gradient(135deg, #F0C43B 0%, #F0C43B 100%);
    box-shadow: 0 4px 12px #F0C43B;
    border: none;
}

.nav-treeview {
    background: #f8f9fa !important;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    margin: 4px 0;
}

.nav-treeview .nav-link {
    padding: 0.6rem 1rem;
    margin: 2px 4px;
    font-size: 0.9rem;
}

.nav-treeview .nav-link.active {
    background: linear-gradient(135deg, #F0C43B 0%, #F0C43B 100%);
    box-shadow: 0 2px 8px #F0C43B;
}

.nav-icon {
    transition: all 0.3s ease;
}

.nav-link:hover .nav-icon {
    transform: scale(1.1);
}

.nav-arrow {
    transition: transform 0.3s ease;
}

.menu-open .nav-arrow {
    transform: rotate(180deg);
}

/* Scrollbar personnalisée */
.sidebar-wrapper::-webkit-scrollbar {
    width: 4px;
}

.sidebar-wrapper::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.sidebar-wrapper::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.sidebar-wrapper::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>
