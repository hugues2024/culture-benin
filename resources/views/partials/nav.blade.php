<nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-white shadow-sm" role="navigation" aria-label="Navigation principale">

    <div class="container">

        <button class="navbar-toggler border-0 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-controls="mobileSidebar">

            <i class="fas fa-bars text-dark fs-3"></i>

        </button>



        <a class="navbar-brand me-lg-auto" href="{{ route('accueil') }}" aria-label="Culture-Bénin | Accueil">

            <div class="logo-wrapper">

                <img src="{{ asset('img/logo-removebg.png') }}" alt="Logo Culture Bénin" class="navbar-logo">

            </div>

            <div class="brand-text d-none d-sm-flex">

                <span class="text-green">C</span><span class="text-yellow">u</span><span class="text-green">l</span><span class="text-red">t</span><span class="text-yellow">u</span><span class="text-green">r</span><span class="text-red">e</span><span class="text-yellow">-</span><span class="text-green">B</span><span class="text-red">é</span><span class="text-yellow">n</span><span class="text-red">i</span><span class="text-yellow">n</span>

            </div>

        </a>



        <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('accueil') ? 'active-link' : '' }}"
                       href="{{ route('accueil') }}"
                       aria-current="{{ request()->routeIs('accueil') ? 'page' : 'false' }}">
                       Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#regions">Régions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#patrimoine">Patrimoine</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contribuer">Contribuer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#avis">Avis</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">

                @auth

                    <div class="dropdown">

                        <button class="btn btn-outline-success rounded-pill dropdown-toggle" type="button" data-bs-toggle="dropdown">

                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->prenom }}

                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                            <li>

                                <form method="POST" action="{{ route('logout') }}">

                                    @csrf

                                    <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Déconnexion</button>

                                </form>

                            </li>

                        </ul>

                    </div>

                @else

                    <a href="{{ route('register') }}" class="btn btn-outline-light">Créer un compte</a>

                    <a href="{{ route('login') }}" class="btn btn-primary">Accéder au compte Bénin</a>
                @endauth

            </div>

        </div>

    </div>

</nav>



<div class="offcanvas offcanvas-start border-0 shadow" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel" style="width: 280px;">
    <div class="offcanvas-header border-bottom py-4">
        <h5 class="offcanvas-title d-flex align-items-center" id="mobileSidebarLabel">
            <img src="{{ asset('img/logo-removebg.png') }}" height="40" alt="Logo" class="me-2">
            <span class="fw-bold">Menu</span>
        </h5>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0">
        <div class="list-group list-group-flush pt-2">
            <a href="{{ route('accueil') }}" class="list-group-item list-group-item-action border-0 py-3 px-4 {{ request()->routeIs('accueil') ? 'sidebar-active' : '' }}">
                <i class="fas fa-home me-3"></i> Accueil
            </a>
            <a href="#regions" class="list-group-item list-group-item-action border-0 py-3 px-4">
                <i class="fas fa-map-marked-alt me-3"></i> Régions
            </a>
            <a href="#patrimoine" class="list-group-item list-group-item-action border-0 py-3 px-4">
                <i class="fas fa-history me-3"></i> Patrimoine
            </a>
            <a href="#contribuer" class="list-group-item list-group-item-action border-0 py-3 px-4">
                <i class="fas fa-star me-3"></i> Contribuer
            </a>
            <a href="#avis" class="list-group-item list-group-item-action border-0 py-3 px-4 border-bottom">
                <i class="fas fa-heart me-3"></i> Avis
            </a>
        </div>



        <div class="p-4 mt-auto">

            @guest
                <a href="{{ route('register') }}" class="btn btn-outline-success w-100 rounded-pill mb-2">Créer un compte</a>

                <a href="{{ route('login') }}" class="btn  btn-success  w-100 rounded-pill mb-2">Accéder au compte Bénin</a>

               

            @else

                <div class="d-flex align-items-center mb-3 p-2 bg-light rounded-3">

                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">

                        {{ substr(Auth::user()->prenom, 0, 1) }}

                    </div>

                    <span class="fw-bold">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</span>

                </div>

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit" class="btn btn-danger w-100 rounded-pill">Déconnexion</button>

                </form>

            @endguest

        </div>

    </div>

</div>  <style>

/* --- Couleurs & Variables --- */

:root {

    --benin-green: #008751;

    --benin-yellow: #FCD116;

    --benin-red: #E8112D;

    --google-blue-light: #e8f0fe;

    --google-blue: #1967d2;

}



.text-green { color: var(--benin-green); }

.text-yellow { color: var(--benin-yellow); }

.text-red { color: var(--benin-red); }

.btn-benin-green { background-color: var(--benin-green); color: white; border: none; }

.btn-benin-green:hover { background-color: #006b40; color: white; }



/* --- Navbar Modifications --- */

.navbar { background-color: #ffffff !important; transition: all 0.3s; }



.navbar-logo {

    height: 55px;

    object-fit: contain;

    transform: scale(1.2);

}



.brand-text {

    font-weight: 800;

    font-size: 1.3rem;

    margin-left: 10px;

}



.nav-link {

    font-weight: 500;

    padding: 0.5rem 1.2rem !important;

    transition: color 0.2s;

}



.active-link {

    color: var(--benin-green) !important;

    font-weight: 700;

}



/* --- Sidebar (Style Google) --- */

.sidebar-active {

    background-color: var(--google-blue-light) !important;

    color: var(--google-blue) !important;

    border-radius: 0 50px 50px 0 !important;

    margin-right: 12px;

    font-weight: 600;

}



.list-group-item-action {

    transition: all 0.2s;

    font-size: 0.95rem;

}



.list-group-item-action:hover:not(.sidebar-active) {

    background-color: #f8f9fa !important;

    border-radius: 0 50px 50px 0 !important;

    margin-right: 12px;

}



/* Fix pour l'icône hamburger à gauche sur mobile */

@media (max-width: 991.98px) {

    .navbar .container {

        display: flex;

        justify-content: space-between; /* Hamburger à gauche, Logo à droite */

    }

    .navbar-brand {

        margin-right: 0;

        position: absolute;

        left: 50%;

        transform: translateX(-50%);

    }

}

</style>   