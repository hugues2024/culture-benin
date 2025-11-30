@extends('layouts.app1')

@section('title', $contenu->titre .  ' - Culture Bénin')

@section('content')
    <article class="article-detail">
        <!-- Hero Section -->
        <div class="article-hero">
            <img src="{{ asset('img/gouv.jpeg') }}" alt="Culture Bénin" class="article-hero__image">
            <div class="article-hero__overlay"></div>

            <div class="article-hero__content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-xl-8">
                            <!-- Category Badge -->
                            <div class="article-hero__category">
                                <span class="hero-category-badge">
                                    {{ optional($contenu->type_contenu)->nom ??  'Culture' }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h1 class="article-hero__title">{{ $contenu->titre }}</h1>

                            <!-- Meta -->
                            <div class="article-hero__meta">
                                <span class="hero-meta__item hero-meta__item--langue">
                                    <i class="fas fa-language"></i>
                                    {{ optional($contenu->langue)->nom_langue ?? 'Français' }}
                                </span>
                                <span class="hero-meta__separator">•</span>
                                <span class="hero-meta__item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ optional($contenu->region)->nom_region ?? 'Bénin' }}
                                </span>
                                <span class="hero-meta__separator">•</span>
                                <span class="hero-meta__item">
                                    <i class="far fa-clock"></i>
                                     {{ optional($contenu->created_at)->diffForHumans() ?? '' }}
                                </span>
                                <span class="hero-meta__separator">•</span>
                                <span class="hero-meta__item">
                                    {{ optional($contenu->created_at)->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Article Header - Author Bar -->
        <header class="article-header">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-8">
                        <div class="article-author-bar">
                            <div class="author-bar__avatar">
                                @if(optional($contenu->auteur)->photo)
                                    <img src="{{ asset('storage/' . $contenu->auteur->photo) }}" alt="{{ $contenu->auteur->nom }}">
                                @else
                                    <div class="author-bar__avatar-placeholder">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="author-bar__info">
                                <div class="author-bar__name">
                                    {{ optional($contenu->auteur)->prenom ?? 'Culture' }} {{ optional($contenu->auteur)->nom ?? 'Bénin' }}
                                </div>
                                <div class="author-bar__meta">
                                    Contributeur culturel
                                </div>
                            </div>
                            <div class="author-bar__actions">
                                <button class="btn-action btn-action--share" title="Partager">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                                <button class="btn-action btn-action--bookmark" title="Sauvegarder">
                                    <i class="far fa-bookmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Article Content -->
        <div class="article-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-8">
                        <!-- Featured Image -->
                        @if($contenu->media->first())
                            <figure class="article-featured-image">
                                <div class="article-featured-image__wrapper">
                                    <img src="{{ asset('storage/' . $contenu->media->first()->chemin) }}" alt="{{ $contenu->titre }}">
                                </div>
                                <figcaption class="article-featured-image__caption">
                                    <i class="fas fa-camera me-2"></i>
                                    {{ $contenu->titre }}
                                </figcaption>
                            </figure>
                        @endif

                        <!-- Introduction -->
                        @if($contenu->introduction)
                            <div class="article-intro">
                                <p class="lead">{{ $contenu->introduction }}</p>
                            </div>
                        @endif

                        <!-- Main Content -->
                        <div class="article-body">
                            {!! nl2br(e($contenu->texte)) !!}
                        </div>

                        <!-- Media Gallery -->
                        @if($contenu->media->count() > 1)
                            <section class="article-gallery">
                                <h3 class="section-heading">
                                    <i class="fas fa-images me-2"></i>
                                    Galerie photos
                                </h3>
                                <div class="row g-3">
                                    @foreach($contenu->media->skip(1) as $media)
                                        <div class="col-md-6">
                                            <div class="gallery-item">
                                                <img src="{{ asset('storage/' . $media->chemin) }}" alt="Image {{ $loop->iteration }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        <!-- Tags -->
                        @if($contenu->tags)
                            <section class="article-tags">
                                <h4 class="section-heading">
                                    <i class="fas fa-tags me-2"></i>
                                    Mots-clés
                                </h4>
                                <div class="tags-list">
                                    @foreach(explode(',', $contenu->tags) as $tag)
                                        <span class="tag-item">{{ trim($tag) }}</span>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        <!-- Share Section -->
                        <section class="article-share">
                            <div class="share-container">
                                <h4 class="section-heading">
                                    <i class="fas fa-share-nodes me-2"></i>
                                    Partager cet article
                                </h4>
                                <div class="share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="share-btn share-btn--facebook">
                                        <i class="fab fa-facebook-f"></i>
                                        <span>Facebook</span>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet? url={{ urlencode(Request::url()) }}&text={{ urlencode($contenu->titre) }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="share-btn share-btn--twitter">
                                        <i class="fab fa-twitter"></i>
                                        <span>Twitter</span>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($contenu->titre .  ' - ' . Request::url()) }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="share-btn share-btn--whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                        <span>WhatsApp</span>
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(Request::url()) }}&title={{ urlencode($contenu->titre) }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="share-btn share-btn--linkedin">
                                        <i class="fab fa-linkedin-in"></i>
                                        <span>LinkedIn</span>
                                    </a>
                                </div>
                            </div>
                        </section>

                        <!-- Author Bio -->
                        <section class="author-bio">
                            <div class="author-bio__header">
                                <h4 class="section-heading">
                                    <i class="fas fa-user-edit me-2"></i>
                                    À propos de l'auteur
                                </h4>
                            </div>
                            <div class="author-bio__card">
                                <div class="author-bio__avatar">
                                    @if(optional($contenu->auteur)->photo)
                                        <img src="{{ asset('storage/' . $contenu->auteur->photo) }}" alt="{{ $contenu->auteur->nom }}">
                                    @else
                                        <div class="author-bio__avatar-placeholder">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="author-bio__content">
                                    <h5 class="author-bio__name">
                                        {{ optional($contenu->auteur)->prenom }} {{ optional($contenu->auteur)->nom }}
                                    </h5>
                                    <p class="author-bio__description">
                                        Contributeur passionné de culture béninoise, partageant ses connaissances pour préserver notre patrimoine culturel et transmettre nos traditions aux générations futures.
                                    </p>
                                </div>
                            </div>
                        </section>

                        <!-- Comments Section -->
                        <section class="article-comments">
                            <div class="comments-header">
                                <h4 class="section-heading">
                                    <i class="fas fa-comments me-2"></i>
                                    Commentaires (3)
                                </h4>
                            </div>

                            <!-- Add Comment Form (User Connected) -->
                            @auth
                                <div class="comment-form-wrapper">
                                    <form class="comment-form">
                                        <div class="comment-form__avatar">
                                            @if(auth()->user()->photo)
                                                <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="{{ auth()->user()->nom }}">
                                            @else
                                                <div class="comment-form__avatar-placeholder">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="comment-form__input-wrapper">
                                            <textarea
                                                class="comment-form__input"
                                                rows="3"
                                                placeholder="Ajouter un commentaire..."
                                                required
                                            ></textarea>
                                            <div class="comment-form__actions">
                                                <button type="button" class="btn btn-outline-secondary btn-sm">
                                                    Annuler
                                                </button>
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fas fa-paper-plane me-2"></i>
                                                    Publier
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="comment-login-prompt">
                                    <i class="fas fa-lock me-2"></i>
                                    <span>Vous devez être <a href="{{ route('login') }}">connecté</a> pour commenter</span>
                                </div>
                            @endauth

                            <!-- Comments List (Mock Data) -->
                            <div class="comments-list">
                                <!-- Comment 1 -->
                                <div class="comment-item">
                                    <div class="comment-item__avatar">
                                        <img src="https://ui-avatars.com/api/? name=Marie+Kossou&background=008751&color=fff" alt="Marie Kossou">
                                    </div>
                                    <div class="comment-item__content">
                                        <div class="comment-item__header">
                                            <span class="comment-item__author">Marie Kossou</span>
                                            <span class="comment-item__date">
                                                <i class="far fa-clock me-1"></i>
                                                Il y a 2 heures
                                            </span>
                                        </div>
                                        <p class="comment-item__text">
                                            Très bel article sur notre culture !  C'est important de préserver ces traditions pour les générations futures.  Merci pour ce partage enrichissant.
                                        </p>
                                        <div class="comment-item__actions">
                                            <button class="comment-action-btn">
                                                <i class="far fa-thumbs-up me-1"></i>
                                                Aimer (12)
                                            </button>
                                            <button class="comment-action-btn">
                                                <i class="fas fa-reply me-1"></i>
                                                Répondre
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Comment 2 -->
                                <div class="comment-item">
                                    <div class="comment-item__avatar">
                                        <img src="https://ui-avatars.com/api/?name=Jean+Dossou&background=FCD116&color=000" alt="Jean Dossou">
                                    </div>
                                    <div class="comment-item__content">
                                        <div class="comment-item__header">
                                            <span class="comment-item__author">Jean Dossou</span>
                                            <span class="comment-item__date">
                                                <i class="far fa-clock me-1"></i>
                                                Il y a 5 heures
                                            </span>
                                        </div>
                                        <p class="comment-item__text">
                                            Excellent travail de documentation !  J'ai appris beaucoup de choses sur notre patrimoine culturel.
                                        </p>
                                        <div class="comment-item__actions">
                                            <button class="comment-action-btn">
                                                <i class="far fa-thumbs-up me-1"></i>
                                                Aimer (8)
                                            </button>
                                            <button class="comment-action-btn">
                                                <i class="fas fa-reply me-1"></i>
                                                Répondre
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Comment 3 -->
                                <div class="comment-item">
                                    <div class="comment-item__avatar">
                                        <img src="https://ui-avatars.com/api/?name=Awa+Soglo&background=E8112D&color=fff" alt="Awa Soglo">
                                    </div>
                                    <div class="comment-item__content">
                                        <div class="comment-item__header">
                                            <span class="comment-item__author">Awa Soglo</span>
                                            <span class="comment-item__date">
                                                <i class="far fa-clock me-1"></i>
                                                Hier
                                            </span>
                                        </div>
                                        <p class="comment-item__text">
                                            Merci pour cet article !  Cela me rappelle les récits de mes grands-parents.  Continuez ce beau travail de préservation.
                                        </p>
                                        <div class="comment-item__actions">
                                            <button class="comment-action-btn">
                                                <i class="far fa-thumbs-up me-1"></i>
                                                Aimer (15)
                                            </button>
                                            <button class="comment-action-btn">
                                                <i class="fas fa-reply me-1"></i>
                                                Répondre
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="article-footer">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-8">
                        <div class="back-to-list">
                            <a href="{{ route('contenus.all') }}" class="btn btn-back">
                                <i class="fas fa-arrow-left me-2"></i>
                                Retour à la liste des contenus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection

@push('styles')
    <style>
        /* ========================================
           VARIABLES
        ======================================== */
        :root {
            --benin-green: #008751;
            --benin-green-dark: #006b40;
            --benin-yellow: #FCD116;
            --benin-yellow-dark: #e6b800;

            --color-text: #1a202c;
            --color-text-light: #64748b;
            --color-border: #e2e8f0;
            --color-bg: #ffffff;
            --color-bg-light: #f8fafc;

            --font-serif: 'Merriweather', 'Georgia', serif;
            --font-sans: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Inter', sans-serif;

            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.07);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
            --shadow-xl: 0 20px 25px rgba(0,0,0,0.1);

            --radius-md: 0.75rem;
            --radius-lg: 1rem;

            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        . article-detail {
            background: var(--color-bg);
        }

        /* ========================================
           HERO SECTION
        ======================================== */
        .article-hero {
            position: relative;
            height: 420px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--benin-green), var(--benin-green-dark));
        }

        .article-hero__image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.25;
            z-index: 1;
        }

        .article-hero__overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.8));
            z-index: 2;
        }

        .article-hero__content {
            position: relative;
            z-index: 100;
            height: 100%;
            display: flex;
            align-items: center;
            padding: 2rem 0;
        }

        .article-hero__category {
            margin-bottom: 1.5rem;
        }

        .hero-category-badge {
            display: inline-block;
            background: var(--benin-green);
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 50px;
            font-size: 0.8125rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.4);
        }

        .article-hero__title {
            font-family: var(--font-serif);
            font-size: clamp(1.875rem, 4. 5vw, 2.75rem);
            font-weight: 800;
            line-height: 1.2;
            color: #ffffff;
            margin-bottom: 1.5rem;
            text-shadow: 0 3px 12px rgba(0,0,0,0.5);
        }

        .article-hero__meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 1rem;
            font-size: 0.9375rem;
        }

        .hero-meta__item {
            color: #ffffff;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-shadow: 0 2px 6px rgba(0,0,0,0.4);
        }

        /* ✅ Badge Langue - Marge confortable + texte centré */
        .hero-meta__item--langue {
            background: var(--benin-yellow) !important;
            color: #000000 !important;
            padding: 0.625rem 1.5rem;
            border-radius: 50px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            text-shadow: none ! important;
            box-shadow: 0 4px 15px rgba(252, 209, 22, 0.6);
            border: 2px solid var(--benin-yellow-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: fit-content;
            white-space: nowrap;
        }

        . hero-meta__item--langue i {
            color: #000000 !important;
            font-size: 1rem;
        }

        .hero-meta__separator {
            color: rgba(255,255,255,0.6);
            font-weight: bold;
        }

        /* ========================================
           ARTICLE HEADER - Style Medium Pro
        ======================================== */
        .article-header {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem 0;
            border-bottom: 1px solid var(--color-border);
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(10px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: box-shadow 0.3s ease;
        }

        .article-header. scrolled {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .article-author-bar {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            max-width: 100%;
        }

        /* Avatar - Style Medium */
        .author-bar__avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid var(--color-border);
            flex-shrink: 0;
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .author-bar__avatar:hover {
            border-color: var(--benin-green);
            transform: scale(1.05);
        }

        .author-bar__avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .author-bar__avatar-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--benin-green), var(--benin-green-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        /* Author Info - Typography Medium */
        .author-bar__info {
            flex: 1;
            min-width: 0;
        }

        .author-bar__name {
            font-weight: 600;
            font-size: 1.0625rem;
            color: var(--color-text);
            margin-bottom: 0.25rem;
            line-height: 1.3;
            letter-spacing: -0.01em;
        }

        .author-bar__meta {
            font-size: 0.875rem;
            color: var(--color-text-light);
            font-weight: 400;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .author-bar__meta::before {
            content: '';
            width: 4px;
            height: 4px;
            background: var(--benin-green);
            border-radius: 50%;
        }

        /* Actions - Style Medium épuré */
        .author-bar__actions {
            display: flex;
            gap: 0.5rem;
            flex-shrink: 0;
        }

        .btn-action {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid var(--color-border);
            background: var(--color-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-text-light);
            cursor: pointer;
            transition: var(--transition);
            font-size: 1rem;
            position: relative;
            overflow: hidden;
        }

        .btn-action::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: currentColor;
            opacity: 0.1;
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease;
        }

        .btn-action:hover::before {
            width: 100%;
            height: 100%;
        }

        .btn-action:hover {
            border-color: currentColor;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        . btn-action:active {
            transform: translateY(0);
        }

        /* Share Button - Blue */
        .btn-action--share {
            color: #1877f2;
        }

        .btn-action--share:hover {
            background: #1877f2;
            color: white;
            border-color: #1877f2;
        }

        /* Bookmark Button - Yellow */
        .btn-action--bookmark {
            color: var(--benin-yellow-dark);
        }

        .btn-action--bookmark:hover {
            background: var(--benin-yellow);
            color: #000;
            border-color: var(--benin-yellow-dark);
        }

        . btn-action--bookmark . fas {
            color: var(--benin-green);
        }

        /* Tooltip au hover */
        .btn-action[title]:hover::after {
            content: attr(title);
            position: absolute;
            bottom: -35px;
            left: 50%;
            transform: translateX(-50%);
            padding: 0.375rem 0.75rem;
            background: rgba(0, 0, 0, 0.9);
            color: white;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 6px;
            white-space: nowrap;
            pointer-events: none;
            z-index: 100;
        }

        /* ========================================
           ARTICLE CONTENT
        ======================================== */
        .article-content {
            padding: 3rem 0;
        }

        . article-featured-image {
            margin: 0 0 3rem 0;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-xl);
        }

        .article-featured-image__wrapper {
            position: relative;
            overflow: hidden;
        }

        .article-featured-image__wrapper img {
            width: 100%;
            height: auto;
            display: block;
        }

        . article-featured-image__caption {
            padding: 1rem 1.5rem;
            background: var(--color-bg-light);
            font-size: 0.875rem;
            color: var(--color-text-light);
            font-style: italic;
            border-top: 2px solid var(--color-border);
            display: flex;
            align-items: center;
        }

        .article-featured-image__caption i {
            color: var(--benin-green);
        }

        .article-intro {
            margin-bottom: 3rem;
        }

        .article-intro . lead {
            font-size: 1.25rem;
            line-height: 1.7;
            color: var(--color-text-light);
            font-family: var(--font-serif);
            padding-left: 1.5rem;
            border-left: 4px solid var(--benin-yellow);
        }

        .article-body {
            font-family: var(--font-serif);
            font-size: 1.125rem;
            line-height: 1.8;
            color: var(--color-text);
            margin-bottom: 3rem;
        }

        .article-body p {
            margin-bottom: 1.5rem;
        }

        .article-body h2,
        .article-body h3 {
            font-family: var(--font-sans);
            font-weight: 700;
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
            color: var(--color-text);
        }

        .article-body h2 {
            font-size: 1.875rem;
            border-bottom: 3px solid var(--benin-green);
            padding-bottom: 0.5rem;
        }

        .article-body h3 {
            font-size: 1.5rem;
        }

        .section-heading {
            font-family: var(--font-sans);
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .section-heading i {
            color: var(--benin-green);
        }

        .article-gallery {
            margin: 4rem 0;
            padding: 2.5rem;
            background: var(--color-bg-light);
            border-radius: var(--radius-lg);
        }

        .gallery-item {
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .gallery-item:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }

        . article-tags {
            margin: 4rem 0;
            padding: 2.5rem;
            background: var(--color-bg-light);
            border-radius: var(--radius-lg);
        }

        .tags-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .tag-item {
            display: inline-block;
            padding: 0.5rem 1. 125rem;
            background: white;
            border: 2px solid var(--color-border);
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--color-text);
            transition: var(--transition);
            cursor: pointer;
        }

        . tag-item:hover {
            border-color: var(--benin-green);
            color: var(--benin-green);
            background: rgba(0, 135, 81, 0.05);
        }

        .article-share {
            margin: 4rem 0;
        }

        .share-container {
            padding: 2.5rem;
            background: var(--color-bg-light);
            border-radius: var(--radius-lg);
        }

        .share-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
        }

        .share-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 0.875rem 1.5rem;
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 0.9375rem;
            text-decoration: none;
            color: white;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
        }

        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .share-btn--facebook { background: #1877f2; }
        .share-btn--twitter { background: #1da1f2; }
        .share-btn--whatsapp { background: #25d366; }
        .share-btn--linkedin { background: #0a66c2; }

        .author-bio {
            margin: 4rem 0;
        }

        .author-bio__header {
            margin-bottom: 1.5rem;
        }

        . author-bio__card {
            display: flex;
            gap: 2rem;
            padding: 2.5rem;
            background: var(--color-bg-light);
            border-radius: var(--radius-lg);
            border: 2px solid var(--color-border);
        }

        .author-bio__avatar {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid var(--benin-green);
            flex-shrink: 0;
            box-shadow: var(--shadow-md);
        }

        .author-bio__avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .author-bio__avatar-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--benin-green), var(--benin-green-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
        }

        .author-bio__content {
            flex: 1;
        }

        .author-bio__name {
            font-size: 1.375rem;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 0.75rem;
        }

        .author-bio__description {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--color-text-light);
            margin: 0;
        }

        /* ========================================
           COMMENTS SECTION
        ======================================== */
        .article-comments {
            margin: 4rem 0;
        }

        .comments-header {
            margin-bottom: 2rem;
        }

        .comment-form-wrapper {
            margin-bottom: 3rem;
            padding: 2rem;
            background: var(--color-bg-light);
            border-radius: var(--radius-lg);
            border: 2px solid var(--color-border);
        }

        .comment-form {
            display: flex;
            gap: 1.25rem;
        }

        .comment-form__avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid var(--benin-green);
            flex-shrink: 0;
        }

        .comment-form__avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .comment-form__avatar-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--benin-green), var(--benin-green-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.125rem;
        }

        .comment-form__input-wrapper {
            flex: 1;
        }

        .comment-form__input {
            width: 100%;
            padding: 0.875rem 1.125rem;
            border: 2px solid var(--color-border);
            border-radius: var(--radius-md);
            font-size: 0.9375rem;
            font-family: var(--font-sans);
            line-height: 1.6;
            resize: vertical;
            transition: var(--transition);
        }

        .comment-form__input:focus {
            outline: none;
            border-color: var(--benin-green);
            box-shadow: 0 0 0 4px rgba(0, 135, 81, 0.1);
        }

        .comment-form__actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .comment-login-prompt {
            padding: 2rem;
            background: var(--color-bg-light);
            border-radius: var(--radius-lg);
            border: 2px dashed var(--color-border);
            text-align: center;
            font-size: 1rem;
            color: var(--color-text-light);
            margin-bottom: 3rem;
        }

        .comment-login-prompt a {
            color: var(--benin-green);
            font-weight: 700;
            text-decoration: none;
        }

        .comment-login-prompt a:hover {
            text-decoration: underline;
        }

        .comments-list {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .comment-item {
            display: flex;
            gap: 1.25rem;
            padding: 1.5rem;
            background: white;
            border-radius: var(--radius-lg);
            border: 1px solid var(--color-border);
            transition: var(--transition);
        }

        .comment-item:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--benin-green);
        }

        .comment-item__avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid var(--color-border);
            flex-shrink: 0;
        }

        .comment-item__avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .comment-item__content {
            flex: 1;
        }

        .comment-item__header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .comment-item__author {
            font-weight: 700;
            font-size: 1rem;
            color: var(--color-text);
        }

        . comment-item__date {
            font-size: 0.8125rem;
            color: var(--color-text-light);
            display: flex;
            align-items: center;
        }

        .comment-item__text {
            font-size: 0.9375rem;
            line-height: 1.7;
            color: var(--color-text);
            margin-bottom: 1rem;
        }

        .comment-item__actions {
            display: flex;
            gap: 1.5rem;
        }

        .comment-action-btn {
            background: none;
            border: none;
            color: var(--color-text-light);
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            padding: 0;
            display: flex;
            align-items: center;
        }

        .comment-action-btn:hover {
            color: var(--benin-green);
        }

        /* ========================================
           FOOTER
        ======================================== */
        .article-footer {
            padding: 3rem 0;
            background: var(--color-bg-light);
            border-top: 1px solid var(--color-border);
        }

        . back-to-list {
            text-align: center;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0. 75rem;
            padding: 0.875rem 2rem;
            background: white;
            color: var(--benin-green);
            border: 2px solid var(--benin-green);
            border-radius: var(--radius-md);
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-back:hover {
            background: var(--benin-green);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* ========================================
           RESPONSIVE
        ======================================== */
        @media (max-width: 768px) {
            .article-hero {
                height: 380px;
            }

            .article-hero__title {
                font-size: 1.625rem;
            }

            . article-hero__meta {
                font-size: 0.8125rem;
                gap: 0.75rem;
            }

            . article-header {
                padding: 1.5rem 0;
                position: relative;
                top: auto;
            }

            .article-author-bar {
                gap: 1rem;
            }

            .author-bar__avatar {
                width: 44px;
                height: 44px;
            }

            . author-bar__name {
                font-size: 0.9375rem;
            }

            .author-bar__meta {
                font-size: 0.8125rem;
            }

            .btn-action {
                width: 36px;
                height: 36px;
                font-size: 0.9375rem;
            }

            .comment-form,
            .comment-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .comment-form__avatar,
            .comment-item__avatar {
                align-self: center;
            }

            .author-bio__card {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 1.5rem;
            }

            .share-buttons {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .author-bar__actions {
                flex-direction: column;
                gap: 0.375rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Bookmark toggle
            document.querySelectorAll('.btn-action--bookmark').forEach(btn => {
                btn.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    icon.classList.toggle('far');
                    icon.classList.toggle('fas');
                });
            });

            // Sticky header scroll effect
            const header = document.querySelector('.article-header');
            if (header) {
                window. addEventListener('scroll', function() {
                    if (window.scrollY > 100) {
                        header.classList. add('scrolled');
                    } else {
                        header.classList.remove('scrolled');
                    }
                });
            }
        });
    </script>
@endpush
