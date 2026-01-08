<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description"
    content="Culture-Bénin est une plateforme dédiée à la promotion et à la valorisation de la richesse culturelle du Bénin à travers des contenus variés dans différentes langues.">
<title>@yield('title', 'Culture-Bénin')</title>

<!-- Preconnect for performance -->
<link rel="preconnect" href="https://cdn.jsdelivr.net">
<link rel="preconnect" href="https://cdnjs.cloudflare.com">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Favicons -->
<link rel="icon" type="image/png" href="{{asset('img/favicon/favicon-96x96.png')}}" sizes="96x96/>"/>
<link rel="icon" type="image/svg+xml" href="{{asset('img/favicon/favicon.svg')}}" />
<link rel="shortcut icon" href="{{asset('img/favicon/favicon.ico')}}" />
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('/apple-touch-icon.png')}}" />
<link rel="manifest" href="{{asset('/site.webmanifest')}}" />

<style>
    /* ========================================
       CSS VARIABLES - Design System
    ======================================== */
    :root {
        /* Colors - Bénin Theme */
        --benin-green: #F9FBF9;
        --benin-green-dark: #F9FBF9;
        --benin-green-light: #F9FBF9;
        --benin-yellow: #2D2D2D;
        --benin-yellow-dark: #2D2D2D;
        /* Colors - Culture-Bénin Theme */
        --benin-white-color: #F9FBF9 /*Pour les boutons principaux, la barre de navigation.*/;
        --benin-dark-color: #2D2D2D /*Un gris très foncé (mieux que le noir pur) pour la lecture.*/;
        --benin-green-color: #008751 /*Pour les boutons principaux, la barre de navigation.*/;
        --benin-green-dark-color: #006b40 /*Pour les survols de boutons, les accents.*/;
        --benin-green-light-color: #cbf8e9ff /*Pour les survols des boutons, les accents.*/;
        --benin-yellow-color: #FCD116 /*Pour les icônes, les mises en évidence, les étoiles.*/;
        --benin-red-color: #E8112D /*Pour les alertes, les cœurs (favoris), les prix.*/;


        /* Neutral Colors */
        --color-white: #ffffff;
        --color-black: #000000;
        --color-gray-50: #f8f9fa;
        --color-gray-100: #e9ecef;
        --color-gray-200: #dee2e6;
        --color-gray-300: #ced4da;
        --color-gray-600: #6c757d;
        --color-gray-700: #495057;
        --color-gray-900: #212529;

        /* Semantic Colors */
        --color-primary: var(--benin-green);
        --color-primary-hover: var(--benin-green-dark);
        --color-secondary: var(--benin-yellow);
        --color-accent: var(--benin-red);
        --color-text: var(--color-gray-900);
        --color-text-light: var(--color-gray-600);
        --color-bg: var(--color-white);
        --color-bg-light: var(--color-gray-50);

        /* Typography */
        --font-family-base: 'Segoe UI', system-ui, -apple-system, 'Helvetica Neue', Arial, sans-serif;
        --font-size-base: 1rem;
        --font-size-sm: 0.875rem;
        --font-size-lg: 1.125rem;
        --font-size-xl: 1.25rem;
        --line-height-base: 1.6;
        --font-weight-normal: 400;
        --font-weight-medium: 500;
        --font-weight-semibold: 600;
        --font-weight-bold: 700;

        /* Spacing */
        --spacing-xs: 0.25rem;
        --spacing-sm: 0.5rem;
        --spacing-md: 0.5rem;
        --spacing-lg: 1.5rem;
        --spacing-xl: 2rem;
        --spacing-2xl: 3rem;
        --spacing-3xl: 4rem;

        /* Borders */
        --border-radius-sm: 0.375rem;
        --border-radius-md: 0.5rem;
        --border-radius-lg: 0.75rem;
        --border-radius-xl: 1rem;
        --border-radius-pill: 50rem;

        /* Shadows */
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);

        /* Transitions */
        --transition-fast: 150ms ease-in-out;
        --transition-base: 250ms ease-in-out;
        --transition-slow: 350ms ease-in-out;
    }

    /* ========================================
       BASE STYLES
    ======================================== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: var(--font-family-base);
        font-size: var(--font-size-base);
        line-height: var(--line-height-base);
        color: var(--color-text);
        background-color: var(--benin-white-color);
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* ========================================
       COMPONENT STYLES (à déplacer dans des fichiers CSS séparés plus tard)
    ======================================== */
    .navbar {
        background-color: var(--color-primary);
        box-shadow: var(--shadow-md);
        padding: var(--spacing-md) 0 !important;
        transition: all var(--transition-base);
    }

    .navbar .container {
        padding: 0 !important;
    }

    .navbar-brand {
        color: var(--color-white) !important;
        font-size: var(--font-size-xl);
        display: flex;
        align-items: center;
        gap: var(--spacing-sm);
        font-weight: bold;
        font-size: 1.5rem; 
        text-decoration: none;
    }

    .nav-link {
        color: var( --benin-dark-color) !important;
        font-weight: bold;
        font-size: 1.1rem; 
        padding: var(--spacing-sm) var(--spacing-md) !important;
    }

    .btn-primary {
        background-color: var(--color-secondary);
        border-color: var(--color-secondary);
        color: var(--color-text);
        font-weight: var(--font-weight-semibold);
    }

    .btn-primary:hover {
        background-color: var(--benin-yellow-dark);
        border-color: var(--benin-yellow-dark);
        color: var(--color-text);
    }

    .hero-section {
        background-color: var(--benin-white-color);
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain; /* L'image s'affiche entièrement sans être coupée */
        
        /* Optionnel : pour rendre l'image plus nette sur les écrans haute résolution */
        image-rendering: -webkit-optimize-contrast; 
        height: 500px; /* Assure-toi que ton conteneur a une hauteur définie ! */
        color: var(--color-white);
        padding: var(--spacing-3xl) 0;
        text-align: center;
    }

    .section-title {
        position: relative;
        margin-bottom: var(--spacing-2xl);
        color: var(--color-primary);
        padding-bottom: var(--spacing-md);
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background-color: var(--color-secondary);
    }

    /* Feature Cards */
    .feature-card {
        border: none;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-md);
        transition: all var(--transition-base);
        height: 100%;
        overflow: hidden;
        text-align: center;
        padding: var(--spacing-xl);
        background-color: var(--color-white);
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
    }

    .feature-icon {
        font-size: 3rem;
        color: var(--color-primary);
        margin-bottom: var(--spacing-lg);
        display: inline-block;
        transition: all var(--transition-base);
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1);
        color: var(--benin-green-light);
    }

    /* Culture Cards */
    .culture-card {
        background-color: var(--color-white);
    }

    .culture-card img {
        height: 220px;
        object-fit: cover;
        width: 100%;
        transition: transform var(--transition-slow);
    }

    .culture-card:hover img {
        transform: scale(1.05);
    }

    .culture-card .card-body {
        padding: var(--spacing-lg);
    }

    .culture-card .badge {
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-semibold);
        padding: var(--spacing-xs) var(--spacing-md);
        border-radius: var(--border-radius-sm);
    }

    .culture-card .card-title {
        font-size: var(--font-size-xl);
        margin: var(--spacing-md) 0;
        color: var(--color-text);
    }

    .culture-card .card-text {
        color: var(--color-text-light);
        margin-bottom: var(--spacing-md);
        line-height: 1.6;
    }

    /* Language Badges */
    .language-badge {
        background-color: var(--color-accent);
        color: var(--color-white);
        padding: var(--spacing-xs) var(--spacing-md);
        border-radius: var(--border-radius-pill);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-medium);
        margin-right: var(--spacing-xs);
        margin-bottom: var(--spacing-xs);
        display: inline-block;
        transition: all var(--transition-fast);
    }

    .language-badge:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    /* Region Cards */
    .region-card {
        background-color: var(--color-bg-light);
        border-radius: var(--border-radius-lg);
        padding: var(--spacing-xl);
        text-align: center;
        transition: all var(--transition-base);
        height: 100%;
        border: 2px solid transparent;
    }

    .region-card:hover {
        background-color: var(--color-primary);
        color: var(--color-white);
        border-color: var(--color-primary);
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }

    .region-card h5 {
        font-size: var(--font-size-xl);
        margin-bottom: var(--spacing-md);
        transition: color var(--transition-fast);
    }

    .region-card:hover h5 {
        color: var(--color-secondary);
    }

    .region-card p {
        margin-bottom: var(--spacing-md);
        font-size: var(--font-size-sm);
    }

    .region-card .badge {
        transition: all var(--transition-fast);
    }

    .region-card:hover .badge {
        background-color: var(--color-white) !important;
        color: var(--color-primary);
    }

    /* Stats Section */
    .stats-section {
        background: linear-gradient(135deg, var(--color-primary), var(--benin-green-dark));
        color: var(--color-white);
        padding: var(--spacing-3xl) 0;
        position: relative;
        overflow: hidden;
    }

    .stats-section::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .stats-section .container {
        position: relative;
        z-index: 1;
    }

    .stat-number {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: var(--font-weight-bold);
        color: var(--color-secondary);
        margin-bottom: var(--spacing-sm);
        display: block;
    }

    /* Footer Styles */
    footer {
        background-color: var(--color-primary);
        color: var(--color-white);
        padding: var(--spacing-3xl) 0 var(--spacing-lg);
    }

    footer h5 {
        font-size: var(--font-size-lg);
        margin-bottom: var(--spacing-lg);
        font-weight: var(--font-weight-bold);
        color: var(--color-secondary);
    }

    footer p {
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: var(--spacing-md);
    }

    .footer-links a {
        color: var(--color-white);
        text-decoration: none;
        display: block;
        margin-bottom: var(--spacing-sm);
        transition: all var(--transition-fast);
        font-weight: var(--font-weight-medium);
    }

    .footer-links a:hover {
        color: var(--color-secondary);
        padding-left: var(--spacing-sm);
    }

    .social-icons a {
        color: var(--color-white);
        font-size: 1.5rem;
        margin-right: var(--spacing-md);
        transition: all var(--transition-fast);
        display: inline-block;
    }

    .social-icons a:hover {
        color: var(--color-secondary);
        transform: translateY(-3px);
    }

    /* Newsletter Form */
    .newsletter-form .input-group {
        border-radius: var(--border-radius-md);
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }

    .newsletter-form .form-control {
        border: none;
        padding: var(--spacing-md);
        font-size: var(--font-size-base);
    }

    .newsletter-form .form-control:focus {
        outline: none;
        box-shadow: none;
    }

    .newsletter-form .btn {
        background-color: var(--color-secondary);
        color: var(--color-text);
        border: none;
        padding: var(--spacing-md) var(--spacing-xl);
        font-weight: var(--font-weight-semibold);
    }

    .newsletter-form .btn:hover {
        background-color: var(--benin-yellow-dark);
    }

    /* Utility Classes */
    .bg-light {
        background-color: var(--color-bg-light) !important;
    }

    .visually-hidden {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border-width: 0;
    }

    /* ========================================
       NAVBAR PROTECTION - Styles prioritaires
    ======================================== */
    .navbar .btn {
        border-radius: var(--border-radius-md) !important;
        padding: var(--spacing-sm) var(--spacing-lg) !important;
        font-weight: var(--font-weight-semibold) !important;
        text-decoration: none !important;
        display: inline-block !important;
        text-align: center !important;
        cursor: pointer !important;
        transition: all var(--transition-fast) !important;
    }

    .navbar .btn-primary {
        border-color: var(--benin-green-color) !important;
        color: var(--benin-white-color) !important;
        background-color: var(--benin-green-color); /* Fond Vert */
        border-radius: 50px !important; /* Pour l'effet très arrondi de l'image */
        text-decoration: none;
        font-weight: 500 !important;
        font-family: 'Segoe UI', sans-serif;
        font-size: 16px;
        transition: background-color 0.3s !important;
    }

    .navbar .btn-primary:hover {
        border-color: var(--benin-green-dark-color) !important;
        background-color: var(--benin-green-dark-color) !important; /* Un vert un peu plus sombre au survol */
    }

    .navbar .btn-outline-light {
        background-color: transparent !important;
        border-color: rgba(255, 255, 255, 0.5) !important;
        color: var(--benin-green-color) ;
        text-decoration: none;
        font-weight: 500;
        font-family: 'Segoe UI', sans-serif;
        font-size: 16px;
    }

    .navbar .btn-outline-light:hover {
        background-color: var(--benin-green-light-color) !important;
        color: var(--benin-green-color) !important;
        border-radius: 50px !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .navbar-collapse {
            background-color: var(--color-primary);
            padding: var(--spacing-md);
            margin-top: var(--spacing-md);
            border-radius: var(--border-radius-md);
        }

        .hero-section {
            padding: var(--spacing-2xl) 0;
        }

        section {
            padding: var(--spacing-2xl) 0;
        }
    }

    /* Ajoutez ici le reste de votre CSS... */
</style>

@stack('styles')
