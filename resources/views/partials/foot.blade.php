<footer class="google-footer py-1 border-top bg-white">
    <div class="container">
        <div class="row align-items-center mb-1">
            <div class="col-md-6 d-flex align-items-center justify-content-center justify-content-md-start">
                <div class="brand-text fs-4 me-1">
                    <span class="text-green">C</span><span class="text-yellow">u</span><span class="text-green">l</span><span class="text-red">t</span><span class="text-yellow">u</span><span class="text-green">r</span><span class="text-red">e</span><span class="text-yellow">-</span><span class="text-green">B</span><span class="text-red">é</span><span class="text-yellow">n</span><span class="text-red">i</span><span class="text-yellow">n</span>
                </div>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <div class="footer-help d-flex justify-content-center justify-content-md-end align-items-center gap-4">
                    <a href="#" class="text-muted text-decoration-none small"><i class="far fa-question-circle me-1"></i> Aide</a>
                    <a href="#" class="text-muted text-decoration-none small">Envoyer des commentaires</a>
                </div>
            </div>
        </div>

        <hr class="opacity-10 mb-4">

        <div class="row align-items-center">
            <div class="col-lg-8 text-center text-lg-start mb-3 mb-lg-0">
                <div class="d-flex flex-wrap justify-content-center justify-content-lg-start gap-4">
                    <a href="{{ route('accueil') }}" class="footer-link">Accueil</a>
                    <a href="#contes" class="footer-link">Régions</a>
                    <a href="#cuisine" class="footer-link">Patrimoine</a>
                    <a href="#cuisine" class="footer-link">Contribuer</a>
                    <a href="#traditions" class="footer-link">Confidentialité</a>
                    <a href="#" class="footer-link">Conditions</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="d-flex justify-content-center justify-content-lg-end align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-light border text-dark rounded-pill dropdown-toggle px-3" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-globe me-2 text-muted"></i> Français (Bénin)
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                            <li><a class="dropdown-item" href="#">Fon</a></li>
                            <li><a class="dropdown-item" href="#">Yoruba</a></li>
                            <li><a class="dropdown-item" href="#">Dendi</a></li>
                            <li><a class="dropdown-item" href="#">English</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-12 text-center">
                <p class="text-muted x-small">© 2026 Culture-Bénin - Un projet de préservation du patrimoine immatériel.</p>
            </div>
        </div>
    </div>
</footer>

<style>

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
    /* --- Style du Footer --- */
.google-footer {
    font-size: 0.9rem !important;
    color: #5f6368;
}

.google-footer .footer-link {
    color: var(--benin-dark-color);
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
}

.google-footer .footer-link:hover {
    color: var(--benin-dark-color);
}

.google-footer hr {
    background-color: #e0e0e0;
}

/* Texte spécifique pour le logo dans le footer */
.google-footer .brand-text {
    font-weight: 600;
    letter-spacing: -1px;
}

/* Sélecteur de langue style Google */
.google-footer .btn-outline-light {
    border-color: #dadce0 !important;
    font-size: 0.85rem;
    font-weight: 500;
}

.google-footer .btn-outline-light:hover {
    background-color: #f8f9fa;
}

.x-small {
    font-size: 0.75rem;
}
</style>