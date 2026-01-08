<nav class="navbar navbar-expand-lg navbar-dark sticky-top" role="navigation" aria-label="Navigation principale">
    <div class="container">
        <a class="navbar-brand" href="{{ route('accueil') }}" aria-label="Culture-Bénin | Accueil">
            <!-- Logo CB -->
            <div class="logo-wrapper">
                <img src="{{ asset('img/logo-removebg.png') }}" alt="Logo Culture Bénin" class="navbar-logo">
            </div>
            <div class="brand-text">
                <span class="text-green">C</span><span class="text-yellow">u</span><span class="text-green">l</span><span class="text-red">t</span><span class="text-yellow">u</span><span class="text-green">r</span><span class="text-red">e</span><span class="text-yellow">-</span><span class="text-green">B</span><span class="text-red">é</span><span class="text-yellow">n</span><span class="text-red">i</span><span class="text-yellow">n</span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Basculer la navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('accueil') ? 'active' : '' }}" 
                       href="{{ route('accueil') }}" 
                       aria-current="{{ request()->routeIs('accueil') ? 'page' : 'false' }}">
                       Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contes">Régions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#cuisine">Patrimoine </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#traditions">Contribuer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#regions">Avis</a>
                </li>
            </ul>
            <div class="d-flex align-items-center flex-wrap gap-2">
                @auth
                    <span class="navbar-text me-3 d-none d-sm-block" style="color: black;">
                        <i class="fas fa-user-circle me-1"></i>
                        Bonjour, {{ Auth::user()->nom }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt me-1"></i>
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="btn btn-outline-light">Créer un compte</a>
                    <a href="{{ route('login') }}" class="btn btn-primary">Accéder au compte Bénin</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
<style>
/* Logo CBJ - Taille augmentée */
.navbar-brand {
    display: flex;
    align-items: center;
}

.navbar-brand span {
    text-shadow: 1px 1px 1px rgba(0,0,0,0.1);
}

/* Vert Bénin */
.text-green {
    color: #008751;
}

/* Jaune Or */
.text-yellow {
    color: #FCD116;
}

/* Rouge Éclat */
.text-red {
    color: #E8112D;
}

.logo-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-wrapper img {
    transform: scale(1.5); /* Augmente la taille de 50% */
    transition: transform 0.3s; /* Rend l'agrandissement fluide */
}

/* Texte de marque */
.brand-text {
    display: flex;
    flex-direction: row;
    gap: 0. 15rem;
}

.brand-name {
    font-weight: 700;
    font-size: 1.4rem;
    letter-spacing: 0.3px;
    color: white;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    line-height: 1.2;
}

.brand-tagline {
    font-size: 0.75rem;
    font-weight: 500;
    color: rgba(255, 215, 0, 0.95);
    text-transform: uppercase;
    letter-spacing: 1.2px;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

/* Responsive Desktop Large */
@media (min-width: 1200px) {
    .navbar-logo {
        height: 75px;  /* Encore plus grand sur grands écrans */
    }
    
    .brand-name {
        font-size: 1. 5rem;
    }
    
    .brand-tagline {
        font-size: 0.8rem;
    }
}

/* Responsive Tablet */
@media (max-width: 992px) {
    .navbar-logo {
        height: 65px;
    }
    
    .brand-name {
        font-size: 1.3rem;
    }
    
    .brand-tagline {
        font-size: 0. 7rem;
    }
}

/* Responsive Mobile Large */
@media (max-width: 768px) {
    .navbar-brand {
        gap: 0.85rem;
    }
    
    .navbar-logo {
        height: 58px;
    }
    
    .brand-name {
        font-size: 1.2rem;
    }
    
    .brand-tagline {
        font-size: 0. 65rem;
    }
}

/* Responsive Mobile */
@media (max-width: 576px) {
    .navbar-brand {
        gap: 0. 75rem;
    }
    
    .navbar-logo {
        height: 52px;
    }
    
    .brand-name {
        font-size: 1. 1rem;
    }
    
    .brand-tagline {
        display: none;
    }
}

/* Responsive Mobile Small */
@media (max-width: 400px) {
    .navbar-logo {
        height: 48px;
    }
    
    .brand-name {
        font-size: 1rem;
    }
}
</style>