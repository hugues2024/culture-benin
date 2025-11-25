<footer role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5>Culture Bénin</h5>
                <p>Plateforme numérique pour la promotion de la culture et des langues du Bénin.</p>
                <div class="social-icons" role="navigation" aria-label="Réseaux sociaux">
                    <a href="#facebook" aria-label="Visitez notre page Facebook">
                        <i class="fab fa-facebook" aria-hidden="true"></i>
                    </a>
                    <a href="#twitter" aria-label="Suivez-nous sur Twitter">
                        <i class="fab fa-twitter" aria-hidden="true"></i>
                    </a>
                    <a href="#instagram" aria-label="Suivez-nous sur Instagram">
                        <i class="fab fa-instagram" aria-hidden="true"></i>
                    </a>
                    <a href="#youtube" aria-label="Abonnez-vous à notre chaîne YouTube">
                        <i class="fab fa-youtube" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-2 mb-4">
                <h5>Navigation</h5>
                <nav class="footer-links" aria-label="Navigation du pied de page">
                    <a href="{{ route('home') }}">Accueil</a>
                    <a href="#contes">Contes & Histoires</a>
                    <a href="#cuisine">Cuisine</a>
                    <a href="#traditions">Traditions</a>
                    <a href="#regions">Régions</a>
                </nav>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Langues</h5>
                <nav class="footer-links" aria-label="Langues disponibles">
                    <a href="#fr">Français</a>
                    <a href="#fon">Fon</a>
                    <a href="#yo">Yoruba</a>
                    <a href="#den">Dendi</a>
                    <a href="#gou">Goun</a>
                </nav>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Newsletter</h5>
                <p>Abonnez-vous pour recevoir les nouveaux contenus.</p>
                <form class="newsletter-form" aria-label="Formulaire d'inscription à la newsletter">
                    <div class="input-group mb-3">
                        <label for="emailNewsletter" class="visually-hidden">Adresse email</label>
                        <input type="email" 
                               id="emailNewsletter"
                               class="form-control" 
                               placeholder="Votre email"
                               required
                               aria-required="true">
                        <button class="btn" type="submit">S'abonner</button>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <p>&copy; {{ date('Y') }} Culture Bénin. Tous droits réservés.</p>
        </div>
    </div>
</footer>