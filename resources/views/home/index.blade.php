@extends('layouts.app1')

@section('title', 'Culture-Bénin')

@section('content')
    <!-- Hero Carousel Section starts -->
    <section class="hero-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="hero-text-content">
                        <h1 class="display-4 fw-bold mb-4">
                            La Culture Béninoise, une <span class="text-benin-green">épopée vivante</span> à portée de clic.
                        </h1>
                        <p class="lead mb-4 text-muted">
                            De l’éclat des Palais Royaux d’Abomey aux rythmes envoûtants du vaudou, explorez les trésors d’une terre d'histoire. Bienvenue sur Culture-Bénin, la fenêtre numérique sur l'âme du Quartier Latin de l'Afrique.
                        </p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="video-pure-container shadow-lg rounded-4 overflow-hidden">
                        <div class="video-overlay"></div>
                        
                        <iframe 
                            src="https://www.youtube.com/embed/Y9KT5jIgfoY?autoplay=1&mute=1&loop=1&playlist=Y9KT5jIgfoY&controls=0&disablekb=1&modestbranding=1&rel=0&iv_load_policy=3&fs=0" 
                            title="Culture Bénin" 
                            frameborder="0" 
                            allow="autoplay"
                            class="video-iframe">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Carousel Section ends -->

    <!-- Regions Section starts -->
<section class="regions-section py-5 bg-light" id="regions">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Les Richesses de nos Régions</h2>
            <p class="text-muted mx-auto" style="max-width: 600px;">
                Explorez le Bénin à travers ses pôles culturels. Chaque territoire raconte une histoire unique à travers ses langues et ses traditions.
            </p>
        </div>

        <div class="row g-4">
    @foreach($regions as $region)
    <div class="col-md-6 col-lg-3">
        <div class="region-card shadow-sm rounded-4 overflow-hidden">
            {{-- Utilisation de asset() pour s'assurer que le chemin de l'image est correct --}}
            <div class="region-img" style="background-image: url('{{ asset($region->img) }}');"></div>
            
            <div class="region-overlay p-4 d-flex flex-column justify-content-end">
                <h3 class="h4 text-white mb-1">{{ $region->nom_region }}</h3>
                
                <div class="region-languages text-white-50 small mb-3">
                    <i class="fas fa-map-marker-alt me-1"></i> {{ $region->localisation }}
                </div>
                
                <div class="region-stats text-white bg-benin-green py-2 px-3 rounded-pill text-center mb-3">
                    {{ number_format($region->population, 0, ',', ' ') }} Hab.
                </div>

                @auth
                    {{-- Vérification : Admin OU Contenu déjà débloqué --}}
                    @if(auth()->user()->isAdmin() || $region->paye)
                        <a href="{{ route('contenu.detail', $region->id) }}" class="btn btn-sm btn-success w-100">
                            <i class="fas fa-book-open me-1"></i> Lire le contenu
                        </a>
                    @else
                        {{-- Bouton de paiement dynamique avec le prix de la BDD --}}
                        <button type="button" 
                                class="btn btn-sm btn-warning btn-pay-content w-100" 
                                data-contenu-id="{{ $region->id }}" 
                                data-contenu-titre="{{ addslashes($region->nom_region) }}"
                                data-prix="{{ $region->prix }}">
                            <i class="fas fa-lock me-1"></i> Débloquer ({{ $region->prix }} F)
                        </button>
                    @endif
                @else
                    {{-- Non connecté --}}
                    <a href="{{ route('login') }}" class="btn btn-sm btn-danger w-100">
                        <i class="fas fa-sign-in-alt me-1"></i> Se connecter pour lire
                    </a>
                @endauth
            </div>
        </div>
    </div>
    @endforeach
</div>
    </div>
</section>
    <!-- Regions Section ends -->

    <!-- Content Section starts -->
<section class="regions-section py-5 bg-light" id="patrimoine">
    <div class="container">
        
        <div class="text-center mb-5">
            <h2 class="fw-bold display-5">Patrimoine Immatériel et Arts Vivants</h2>
            <div class="row mb-5 align-items-center">
                <div class="col-lg-7">
                    <p class="text-muted mx-auto" style="max-width: 600px;">
                        Une immersion documentée au cœur de la création béninoise, des traditions séculaires aux expressions contemporaines. Accédez à une base de données unique regroupant contes, gastronomie et rituels sacrés.
                    </p>
                </div>
                
                <div class="col-lg-5 text-end d-none d-lg-block">
                    <div class="p-4 bg-light text-center">
                        <span class="d-block display-6 fw-bold text-benin-green">+1500</span>
                        <span class="text-muted text-uppercase small fw-bold">Archives Culturelles</span>
                    </div>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs border-0 mb-5 gap-4" id="heritageTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active fw-bold px-0 pb-3" id="contes-tab" data-bs-toggle="pill" data-bs-target="#contes-content" type="button">Littérature Orale</button> 
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-0 pb-3" id="cuisine-tab" data-bs-toggle="pill" data-bs-target="#cuisine-content" type="button">Gastronomie</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link fw-bold px-0 pb-3" id="rites-tab" data-bs-toggle="pill" data-bs-target="#rites-content" type="button">Histoire & Rites</button>
            </li>
        </ul>

        <div class="tab-content mt-4" id="heritageTabsContent">
            
            <div class="tab-pane fade show active" id="contes-content" role="tabpanel">
                <div class="row g-4">
                    <div class="col-lg-8">
                        @foreach($contenus->where('type_contenu_id', 1)->take(1) as $conte)
                            <div class="card bg-dark text-white border-0 rounded-4 overflow-hidden h-100 shadow-lg main-feature-card">
                            <img src="{{ $conte['image'] }}" class="card-img opacity-50" alt="Tradition Orale">
                            <div class="card-img-overlay d-flex flex-column justify-content-end p-4 p-md-5">
                                <span class="badge bg-benin-green mb-3 py-2 px-3">À LA UNE</span>
                                <h3 class="display-5 fw-bold mb-3">{{ $conte->titre }}</h3>
                                <p class="card-text fs-5 mb-4 opacity-75">{{ Str::limit($conte->texte, 150) }}</p>
                                <div class="d-flex flex-wrap align-items-center gap-3">
                                    <div class="audio-widget bg-blur p-2 rounded-pill d-flex align-items-center px-4">
                                        <button class="play-btn me-3 text-dark"><i class="fas fa-play"></i></button>
                                        <span class="small fw-bold">Écouter en Fon</span>
                                    </div>
                                   @auth
                                            @if(auth()->user()->isAdmin() || $conte->paye)
                                                <a href="{{ route('home.detail', $conte->id) }}" class="btn btn-success"><i class="fas fa-book-open me-1"></i>Lire</a>
                                            @else
                                                <button class="btn btn-warning btn-pay-content" data-contenu-id="{{ $conte->id }}">Payer 100 F</button>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-danger">Se connecter</a>
                                        @endauth
                                </div>
                            </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-4">
                        <div class="list-group list-group-flush border rounded-4 overflow-hidden shadow-sm h-100 bg-white">
                            <div class="list-group-item p-4 hover-bg-light transition">
                                <span class="text-benin-green small fw-bold text-uppercase">Légende</span>
                                <h5 class="fw-bold mt-1">Origine de la Jarre Trouée</h5>
                                <p class="text-muted small mb-0">L'allégorie de l'unité nationale léguée par le Roi Ghézo.</p>
                            </div>
                            <div class="list-group-item p-4 hover-bg-light transition border-top">
                                <span class="text-benin-green small fw-bold text-uppercase">Épopée</span>
                                <h5 class="fw-bold mt-1">L'Exil du Roi Béhanzin</h5>
                                <p class="text-muted small mb-0">Récit tragique de la résistance contre l'occupation coloniale.</p>
                            </div>
                            <div class="list-group-item p-4 hover-bg-light transition border-top">
                                <span class="text-benin-green small fw-bold text-uppercase">Spiritualité</span>
                                <h5 class="fw-bold mt-1">Les Oracles du Fa</h5>
                                <p class="text-muted small mb-0">Comprendre la géomancie divinatoire et ses enseignements.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="cuisine-content" role="tabpanel">
    <div class="row g-4">
        @foreach($contenus->where('type_contenu_id', 2) as $plat)
            <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                <img src="{{ $plat->image }}" class="card-img-top" alt="{{ $plat->titre }}">
                <div class="card-body p-4 text-center">
                    <h5 class="fw-bold mb-2">{{ $plat->titre }}</h5>
                    <p class="text-muted small">{{ $plat->description }}</p>
                    <hr class="my-3 opacity-10">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-light text-dark border">{{ $plat->region->nom_region }}</span>
                         @auth
                                {{-- User connecté --}}
                                    @if(auth()->user()->isAdmin() || $plat->paye)
                                        {{-- Admin OU a payé = Accès direct --}}
                                            <a href="{{ route('home.detail', $plat->id) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-book-open me-1"></i>Lire
                                            </a>
                                    @else
                                        <button type="button" class="btn btn-sm btn-warning btn-pay-content" data-contenu-id="{{ $plat->titre }}" data-contenu-titre="{{ addslashes($plat->titre) }}">
                                            <i class="fas fa-lock me-1"></i> Payer 100 F
                                        </button>
                                    @endif
                                    @else
                                {{-- Non connecté = Bouton Connexion --}}
                                <a href="{{ route('login') }}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-sign-in-alt me-1"></i>
                                        Recette →
                                </a>
                            @endauth
                    </div>
                </div>
            </div>
        </div>    
        @endforeach
        </div>
    </div>

            <div class="tab-pane fade" id="rites-content" role="tabpanel">
                <div class="row g-4">
                    @foreach($contenus->where('type_contenu_id', 3) as $histoire)
                        <div class="col-md-6">
                        <div class="card border-0 rounded-4 overflow-hidden shadow-sm h-100 bg-light">
                             <div class="p-5">
                                <span class="text-benin-green fw-bold text-uppercase ls-1">{{ $histoire->titre }}</span>
                                <h3 class="display-6 fw-bold mt-2">{{ $histoire->nom }}</h3>
                                <p class="text-secondary mt-3 fs-5">{{ $histoire->texte }}</p>
                                @auth
                                {{-- User connecté --}}
                                    @if(auth()->user()->isAdmin() || $histoire->paye)
                                        {{-- Admin OU a payé = Accès direct --}}
                                            <a href="{{ route('home.detail', $histoire->id) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-book-open me-1"></i>Lire
                                            </a>
                                    @else
                                        <button type="button" class="btn btn-sm btn-warning btn-pay-content" data-contenu-id="{{ $histoire->nom }}" data-contenu-titre="{{ addslashes($histoire->nom) }}">
                                            <i class="fas fa-lock me-1"></i> Payer 100 F
                                        </button>
                                    @endif
                                    @else
                                {{-- Non connecté = Bouton Connexion --}}
                                <a href="{{ route('login') }}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-sign-in-alt me-1"></i>
                                        Explorer le monument
                                </a>
                            @endauth
                             </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
    <!-- Content Section ends -->


    <!-- Contribution section  starts-->
    <section class="contribution-call py-5 bg-white border-top" id="contribuer">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="contribution-illustration p-5 bg-light rounded-5 text-center">
                    <i class="fas fa-feather-alt text-benin-green display-1 mb-4"></i>
                    <div class="d-flex justify-content-center gap-3">
                        <div class="avatar-stack shadow-sm bg-white p-2 rounded-pill px-3">
                            <span class="small fw-bold">+250 Contributeurs</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4">Devenez Gardien <br><span class="text-benin-green">du Savoir.</span></h2>
                <p class="lead text-secondary mb-4">
                    Une histoire oubliée à raconter ? Une recette ancestrale à partager ? Ne laissez pas l'héritage de votre village s'éteindre. Documentez-le pour les générations futures.
                </p>
                <div class="d-grid d-md-flex gap-3">
                    <a href="{{ route('login') }}" class="btn btn-benin-green btn-lg rounded-pill px-5 fw-bold shadow-sm">
                        <i class="fas fa-plus-circle me-2"></i> Proposer un contenu
                    </a>
                    <a href="#" class="btn btn-outline-dark btn-lg rounded-pill px-4">
                        En savoir plus
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Contribution section ends-->

    <!-- Knowledge Wall Section starts -->

<section class="knowledge-wall py-5 bg-light" id="avis">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-5">
            <div>
                <h2 class="fw-bold display-6">Le Mur des Savoirs</h2>
                <p class="text-muted">Les derniers échanges de notre communauté de passionnés.</p>
            </div>
            <a href="#" class="btn btn-link text-benin-green fw-bold text-decoration-none p-0">Voir tous les avis →</a>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-benin-green rounded-circle text-white d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px;">KM</div>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 fw-bold">Koffi Mensah</h6>
                                <div class="text-warning small">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="card-text text-secondary italic">"J'ai enfin retrouvé la variante exacte de la recette de l'Amiwo que ma grand-mère cuisinait à Savalou. Merci pour ce travail de documentation !"</p>
                        <div class="border-top pt-3 mt-3">
                            <span class="small text-muted">Sur : <a href="#" class="text-dark fw-bold text-decoration-none">L'Amiwo au Poulet</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-2 border-start border-benin-green border-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-dark rounded-circle text-white d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px;">AS</div>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 fw-bold">Aminata S.</h6>
                                <div class="text-warning small">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="card-text text-secondary">"Les illustrations sur la légende de Bio Guéra sont magnifiques. Ce site est une mine d'or pour les enseignants."</p>
                        <div class="border-top pt-3 mt-3">
                            <span class="small text-muted">Sur : <a href="#" class="text-dark fw-bold text-decoration-none">Épopée de Bio Guéra</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow-sm h-100 p-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="bg-light rounded-circle text-dark d-flex align-items-center justify-content-center fw-bold border" style="width: 45px; height: 45px;">JP</div>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 fw-bold">Jean-Pierre G.</h6>
                                <div class="text-warning small">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="card-text text-secondary italic">"Incroyable de pouvoir écouter les contes en langue Fon directement dans le navigateur. Une vraie innovation !"</p>
                        <div class="border-top pt-3 mt-3">
                            <span class="small text-muted">Sur : <a href="#" class="text-dark fw-bold text-decoration-none">Contes de l'Araignée</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Knowledge Wall Section starts -->
@endsection

@push('styles')
<style>
    /* Variables de couleurs */
    :root {
        --black: #000000;
        --dark-gray: #1a1a1a;
        --overlay-black-50: rgba(0, 0, 0, 0.5);
        --overlay-black-60: rgba(0, 0, 0, 0.6);
        --overlay-orange-70-1: rgba(255, 107, 0, 0.7);
        --overlay-orange-70-2: rgba(204, 85, 0, 0.7);
        --white-transparent-20: rgba(255, 255, 255, 0.2);
        --white-transparent-30: rgba(255, 255, 255, 0.3);
        --white-transparent-15: rgba(255, 255, 255, 0.15);
        --black-shadow-50: rgba(0, 0, 0, 0.5);
        --black-shadow-20: rgba(0, 0, 0, 0.2);
        --black-shadow-30: rgba(0, 0, 0, 0.3);
        --green-80: #F0C43B;
        --green-100: #F0C43B;
        --green-solid: #F0C43B;
        /* Colors - Culture-Bénin Theme */
        --benin-white-color: #F9FBF9 /*Pour les boutons principaux, la barre de navigation.*/;
        --benin-dark-color: #2D2D2D /*Un gris très foncé (mieux que le noir pur) pour la lecture.*/;
        --benin-green-color: #008751 /*Pour les boutons principaux, la barre de navigation.*/;
        --benin-green-dark-color: #006b40 /*Pour les survols de boutons, les accents.*/;
        --benin-green-light-color: #cbf8e9ff /*Pour les survols des boutons, les accents.*/;
        --benin-yellow-color: #FCD116 /*Pour les icônes, les mises en évidence, les étoiles.*/;
        --benin-red-color: #E8112D /*Pour les alertes, les cœurs (favoris), les prix.*/;
        --google-gray: #5f6368;
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }


    /* Couleur de sélection pour Chrome, Firefox, Safari et Edge */
    ::selection {
        background-color: rgba(0, 135, 81, 0.25); /* Vert bénin avec 25% d'opacité */
        color: #008751; /* Le texte lui-même devient vert foncé */
    }

    /* Pour Firefox (version spécifique) */
    ::-moz-selection {
        background-color: rgba(0, 135, 81, 0.25);
        color: #008751;
    }
        
/* Hero Section Styles
    .hero-slide {
        height: 100vh;
        min-height: 600px;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        color: white;
    }

    .hero-badge {
        background-color: #FCD116; 
        color: #000;
        padding: 5px 15px;
        border-radius: 50px;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.9rem;
        margin-bottom: 20px;
        display: inline-block;
    }

    .hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .hero-description {
        font-size: 1.25rem;
        max-width: 800px;
        margin: 0 auto 30px;
        opacity: 0.9;
    }

    .btn-benin-green {
        background-color: #008751; 
        color: white;
        padding: 15px 35px;
        border-radius: 50px;
        border: none;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-benin-green:hover {
        background-color: #006b40;
        color: white;
        transform: translateY(-3px);
    }

    .hero-stats {
        display: flex;
        justify-content: center;
        border-top: 1px solid rgba(255,255,255,0.2);
        padding-top: 20px;
    }
    */

    

    /* Hero Carousel Styles - AVEC PRELOAD ET TRANSITION FLUIDE */
    /*.hero-carousel-section {
        position: relative;
        height: 75vh;
        min-height: 500px;
        overflow: hidden;
        background: var(--black); /* Fallback pendant le chargement *
    }*/

    /*#heroCarousel {
        height: 100%;
    }*/

   /* .carousel-inner,
    .carousel-item {
        height: 100%;
    }*/

    /*.hero-slide {
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        position: relative;
        /* IMPORTANT: Assure que l'image est chargée avant l'affichage *
        background-color: var(--dark-gray);
    } */

    /* Pseudo-élément pour l'overlay - évite l'interférence */
   /* .hero-slide::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: inherit; /* Hérite du background *
        z-index: 0;
    }*/

    /*.hero-slide::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1;
    }*/

    /* Overlays spécifiques pour chaque slide */
    /*.hero-slide.slide-1::after {
        background: linear-gradient(var(--overlay-black-50), var(--overlay-black-50));
    }*/

   /* .hero-slide.slide-3::after {
        background: linear-gradient(var(--overlay-orange-70-1), var(--overlay-orange-70-2));
    }*/

   /* .hero-slide.slide-4::after {
        background: linear-gradient(var(--overlay-black-60), var(--overlay-black-60));
    }*/

   /* .hero-content {
        text-align: center;
        color: white;
        animation: fadeInUp 1s ease-out;
        max-width: 800px;
        margin: 0 auto;
        padding: 1.5rem;
        position: relative;
        z-index: 2; /* Au-dessus de l'overlay *
    }*/

   /* @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }*/

   /* .hero-badge {
        display: inline-block;
        padding: 0.625rem 1.25rem;
        background: var(--white-transparent-20);
        backdrop-filter: blur(10px);
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 1.25rem;
        border: 1px solid var(--white-transparent-30);
    }*/

   /* .hero-title {
        font-size: 2.75rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1.25rem;
        text-shadow: 0 4px 20px var(--black-shadow-50);
    }*/

   /* .hero-description {
        font-size: 1.125rem;
        line-height: 1.6;
        margin-bottom: 2rem;
        opacity: 0.95;
        text-shadow: 0 2px 10px var(--black-shadow-50);
    }*/

   /* .hero-actions {
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }*/

   /* .hero-actions .btn {
        padding: 0.875rem 1.75rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px var(--black-shadow-20);
    }*/

   /* .hero-actions .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 25px var(--black-shadow-30);
    }*/

   /* .hero-stats {
        display: flex;
        justify-content: center;
        gap: 2.5rem;
        flex-wrap: wrap;
    }*/

    /*Hero section starts*/
    /* Couleurs nationales */
.text-benin-green { color: var(--benin-green-color); }
.btn-benin-green {
    background-color: var(--benin-green-color);
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-benin-green:hover {
    background-color: #006b40;
    color: white;
    transform: translateY(-2px);
}

/* Style de la section */
.hero-section {
    background-color: var(--benin-white-color) !important;
    min-height: 80vh;
    display: flex;
    align-items: center;
    margin-top: 30px;
    margin-bottom: 40px;
}

.hero-text-content h1 {
    line-height: 1.2;
    color: #202124; /* Gris très foncé Google */
}

/* Conteneur Vidéo */
.video-container {
    position: relative;
    padding-bottom: 56.25%; /* Ratio 16:9 */
    height: 0;
}

.video-container iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
}

.video-pure-container {
    position: relative;
    padding-bottom: 56.25%; /* Ratio 16:9 */
    height: 0;
    pointer-events: none; /* Désactive tous les clics sur la vidéo */
    user-select: none;
}

.video-iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* On l'agrandit légèrement pour masquer les bords de l'interface YouTube */
    transform: scale(1.5); 
}

/* Overlay de sécurité pour bloquer les clics même si pointer-events échoue */
.video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
    background: transparent;
}

/* Bouton Outline arrondi */
.btn-outline-dark {
    border-radius: 50px;
    font-weight: 500;
}
.video-pure-container {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; /* Ratio 16:9 */
    height: 0;
    overflow: hidden; /* Important : coupe ce qui dépasse du zoom */
    border: none;     /* Supprime toute bordure CSS résiduelle */
}

.video-iframe {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    /* On centre et on zoome (1.15) pour éliminer les bords noirs */
    transform: translate(-50%, -50%) scale(1.15); 
    border: 0;
}

.video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10;
    background: transparent;
}

/* Responsive ajustements */
@media (max-width: 991px) {
    .hero-text-content {
        text-align: center;
    }
    
    .hero-section {
        min-height: auto;
        margin-top: 125px !important;
        margin-bottom: 100px !important;
    }

    .d-flex {
        justify-content: center;
    }
}
/* Hero Section ends */

/* Regions Section starts */
/* Couleur d'accentuation */
.bg-benin-green { background-color: #008751; }

.region-card {
    position: relative;
    height: 400px;
    cursor: pointer;
    background-color: #000;
}

.region-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.region-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* Gradient pour la lisibilité du texte */
    background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 60%, transparent 100%);
    z-index: 2;
}

/* Animations au survol */
.region-card:hover .region-img {
    transform: scale(1.1);
    opacity: 0.7;
}

.region-card:hover .region-stats {
    opacity: 1 !important;
    transform: translateY(0) !important;
}

.transition-all {
    transition: all 0.4s ease-in-out;
}

.translate-middle-y {
    transform: translateY(20px);
}

/* Typographie */
.region-card h3 {
    font-weight: 700;
    letter-spacing: -0.5px;
}

.region-languages {
    font-weight: 300;
    letter-spacing: 0.5px;
}
/* Regions Section ends */

/* Content Section starts */

/* --- Section & Typographie --- */
.regions-section {
    font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    overflow: hidden;
}

.text-benin-green { color: var(--benin-green-color) !important; }
.bg-benin-green { background-color: var(--benin-green-color) !important; color: white; }
.ls-1 { letter-spacing: 1px; }


/* --- Navigation Tabs Style "Google Arts" --- */
.nav-tabs .nav-link {
    color: var(--google-gray);
    border: none;
    border-bottom: 3px solid transparent;
    background: transparent;
    transition: var(--transition-smooth);
    font-size: 1.1rem;
    position: relative;
}

.nav-tabs .nav-link:hover {
    color: var(--benin-green-color);
    border-bottom: 3px solid #e0e0e0;
}

.nav-tabs .nav-link.active {
    color: var(--benin-green-color) !important;
    border-bottom: 3px solid var(--benin-green-color) !important;
    background: transparent !important;
}

/* --- Cartes et Design --- */
.card {
    transition: var(--transition-smooth);
    border: none;
}

.main-feature-card {
    height: 450px !important;
    min-height: 405px !important;
}

.main-feature-card .card-img {
    object-fit: cover;
    height: 100%;
    transition: transform 0.6s ease;
}

.main-feature-card:hover .card-img {
    transform: scale(1.05);
}

/* Effet de flou pour le widget audio */
.bg-blur {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

/* Bouton Play */
.play-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    transition: var(--transition-smooth);
}

.play-btn:hover {
    background: var(--benin-green-color);
    color: white !important;
    transform: scale(1.1);
}

/* --- List Group (Contes) --- */
.list-group-item {
    border-left: none;
    border-right: none;
    transition: var(--transition-smooth);
}

.transition { transition: var(--transition-smooth); }

.hover-bg-light:hover {
    background-color: #f8f9fa !important;
    padding-left: 2rem !important; /* Petit effet de décalage au survol */
}

/* --- Gastronomie (Cards) --- */
#cuisine-content .card-img-top {
    height: 220px;
    object-fit: cover;
}

#cuisine-content .card:hover {
    transform: translateY(-10px);
    box-shadow: var(--card-shadow);
}

/* --- Responsivité --- */

/* Mobile (Smartphones) */
@media (max-width: 767.98px) {
    .display-5 { font-size: 2rem; }
    .display-6 { font-size: 1.8rem; }
    
    /* Tabs défilables horizontalement sur mobile */
    .nav-tabs {
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 5px;
    }
    
    .nav-tabs .nav-link {
        white-space: nowrap;
        padding: 0 15px 10px 15px !important;
    }
    
    .main-feature-card {
        min-height: 350px;
    }

    .p-5 { padding: 2rem !important; }
}

/* Tablettes */
@media (min-width: 768px) and (max-width: 991.98px) {
    #cuisine-content .col-md-4 {
        width: 50%; /* 2 cartes par ligne sur tablette */
    }
}

/* Animations d'entrée (Optionnel) */
.tab-pane.fade {
    transition: opacity 0.4s linear;
}

.tab-pane.active {
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
/* Content Section ends */



    .stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .stat-item strong {
        font-size: 2.25rem;
        font-weight: 800;
        display: block;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-item span {
        font-size: 0.875rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .hero-languages {
        display: flex;
        justify-content: center;
        gap: 0.875rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }

    .language-tag {
        padding: 0.5rem 1.125rem;
        background: var(--white-transparent-15);
        backdrop-filter: blur(10px);
        border-radius: 25px;
        font-size: 0.875rem;
        font-weight: 600;
        border: 1px solid var(--white-transparent-30);
    }

    .hero-regions {
        display: flex;
        justify-content: center;
        gap: 0.875rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }

    .region-chip {
        padding: 0.625rem 1.25rem;
        background: var(--white-transparent-20);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        font-size: 0.9375rem;
        font-weight: 600;
        border: 1px solid var(--white-transparent-30);
    }

    /* Carousel Controls */
    .carousel-indicators {
        bottom: 20px;
        z-index: 15;
    }

    .carousel-indicators button {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        border: 2px solid white;
        transition: all 0.3s ease;
    }

    .carousel-indicators button.active {
        width: 35px;
        border-radius: 10px;
        background-color: white;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 45px;
        height: 45px;
        background-color: var(--green-80);
        border-radius: 50%;
        backdrop-filter: blur(10px);
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 70px;
        z-index: 3; /* Au-dessus du contenu */
    }

    .carousel-control-prev:hover .carousel-control-prev-icon,
    .carousel-control-next:hover .carousel-control-next-icon {
        background-color: var(--green-100);
        transform: scale(1.1);
    }

    /* Scroll Indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateX(-50%) translateY(0);
        }
        40% {
            transform: translateX(-50%) translateY(-10px);
        }
        60% {
            transform: translateX(-50%) translateY(-5px);
        }
    }

    .scroll-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        background: var(--white-transparent-20);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        color: white;
        font-size: 1.375rem;
        border: 2px solid rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
    }

    .scroll-link:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(5px);
    }

    /* Carousel Fade Effect - AMÉLORÉ */
    .carousel-fade .carousel-item {
        opacity: 0;
        transition: opacity 1s ease-in-out;
        display: block; /* Important pour le preload */
    }

    .carousel-fade .carousel-item.active {
        opacity: 1;
    }

    /* Preload des images - empêche le flash */
    .carousel-item:not(.active) {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* Content Cards Carousel */
    .content-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .content-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .card-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 200px;
    }

    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .content-card:hover .card-img-wrapper img {
        transform: scale(1.1);
    }

    .badge-category {
        position: absolute;
        top: 12px;
        right: 12px;
        background: var(--green-80);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    #recentContentCarousel .carousel-indicators button {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: var(--green-solid);
        opacity: 0.5;
    }

    #recentContentCarousel .carousel-indicators button.active {
        opacity: 1;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .hero-carousel-section {
            height: 65vh;
        }

        .hero-title {
            font-size: 2.25rem;
        }

        .hero-description {
            font-size: 1rem;
        }

        .hero-actions .btn {
            padding: 0.75rem 1.5rem;
            font-size: 0.9375rem;
        }

        .stat-item strong {
            font-size: 1.875rem;
        }

        .hero-section {
    margin-top: 30px;
    margin-bottom: 40px;
}
    }

    @media (max-width: 768px) {
        .hero-carousel-section {
            height: 60vh;
            min-height: 450px;
        }

        .hero-section {
            margin-top: 30px;
            margin-bottom: 40px;
        }

        .hero-title {
            font-size: 1.875rem;
        }
        .hero-description {
            font-size: 0.9375rem;
        }


        .stat-item strong {
            font-size: 1.625rem;
        }

        .hero-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .hero-actions .btn {
            width: 100%;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
        }

        #recentContentCarousel .carousel-item .row {
            flex-direction: column;
        }

        #recentContentCarousel .carousel-item .col-md-4 {
            display: none;
        }

        #recentContentCarousel .carousel-item .col-md-4:first-child {
            display: block;
        }
    }

    @media (max-width: 6) {
         .hero-section {
            margin-top: 30px;
            margin-bottom: 40px;
        }
    }
</style>

@endpush
@push('scripts')
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @auth
            // Gérer tous les boutons de paiement
            document.querySelectorAll('.btn-pay-content').forEach(button => {
                button.addEventListener('click', function () {
                    const contenuId = this.dataset.contenuId;
                    const contenuTitre = this.dataset.contenuTitre;

                    // ✅ Initialiser le widget selon la doc (Étape 4)
                    const widget = FedaPay.init({
                        public_key: '{{ config("services.fedapay.public_key") }}',
                        transaction: {
                            amount: 100, // ✅ Prix en FCFA
                            description: `Accès: ${contenuTitre}`
                        },
                        customer: {
                            email: '{{ auth()->user()->email }}',
                            firstname: '{{ auth()->user()->nom }}',
                            lastname: '{{ auth()->user()->prenom }}'
                        },
                        // ✅ Événements de callback
                        onComplete(resp) {
                            console.log('✅ Paiement complété', resp);

                            if (resp.reason === 'CHECKOUT COMPLETE') {
                                // ✅ Soumettre au backend
                                const form = document.createElement('form');
                                form.method = 'POST';
                                form.action = '{{route('paiement.callback')}}';

                                // CSRF
                                const csrf = document.createElement('input');
                                csrf. type = 'hidden';
                                csrf.name = '_token';
                                csrf.value = '{{ csrf_token() }}';
                                form.appendChild(csrf);

                                // Transaction ID
                                const transactionInput = document.createElement('input');
                                transactionInput.type = 'hidden';
                                transactionInput.name = 'id';
                                transactionInput. value = resp.transaction.id;
                                form.appendChild(transactionInput);

                                // Contenu ID
                                const contenuInput = document.createElement('input');
                                contenuInput. type = 'hidden';
                                contenuInput.name = 'contenu_id';
                                contenuInput.value = contenuId;
                                form. appendChild(contenuInput);

                                document.body.appendChild(form);
                                form.submit();
                            }
                        },
                        onCanceled(resp) {
                            console. log('❌ Paiement annulé', resp);
                            alert('Paiement annulé');
                        },
                        onError(error) {
                            console.error('❌ Erreur', error);
                            alert('Erreur lors du paiement.  Réessayez.');
                        }
                    });

                    // ✅ Ouvrir le popup
                    widget.open();
                });
            });
            @endauth

            // Carousel
            const recentCarouselEl = document.getElementById('recentContentCarousel');
            if (recentCarouselEl) {
                const slidesCount = recentCarouselEl.querySelectorAll('.carousel-item').length;

                if (slidesCount <= 1) {
                    recentCarouselEl.removeAttribute('data-bs-ride');
                    const indicators = recentCarouselEl.querySelector('.carousel-indicators');
                    if (indicators) indicators.style.display = 'none';
                    const prev = recentCarouselEl. querySelector('.carousel-control-prev');
                    const next = recentCarouselEl.querySelector('.carousel-control-next');
                    if (prev) prev.style. display = 'none';
                    if (next) next.style.display = 'none';
                } else {
                    const recentCarousel = new bootstrap. Carousel(recentCarouselEl, {
                        interval: 5000,
                        ride: 'carousel',
                        pause: 'hover',
                        wrap: false,
                        touch: true
                    });

                    recentCarouselEl.addEventListener('mouseenter', () => recentCarousel.pause());
                    recentCarouselEl.addEventListener('mouseleave', () => recentCarousel.cycle());
                }
            }
        });
    </script>
@endpush

