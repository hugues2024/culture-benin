# Image PHP avec toutes les extensions utiles pour Laravel + MySQL
FROM php:8.2-fpm

# Configuration de la variable d'environnement PORT par défaut pour Render
ENV PORT=10000

# 1) Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libssl-dev \
    && docker-php-ext-install pdo_mysql zip

# 2) Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# 3) Dossier de travail
WORKDIR /var/www/html

# 4) Copier les fichiers du projet dans le conteneur
COPY . .

# 5) Installer les dépendances Laravel (mode production)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# --- Exécution des commandes Artisan pour la base de données et le cache (Pendant le build) ---
# NOTE: Ces commandes nécessitent que vos variables d'environnement de DB soient disponibles pendant le build sur Render
RUN php artisan migrate:fresh --force || true
RUN php artisan migrate --force || true
RUN php artisan db:seed --force

# IMPORTANT: NE PAS mettre en cache la configuration si vous utilisez des variables d'env dynamiques sur Render
# Nous pouvons cacher les routes et les vues, par contre.
RUN php artisan route:cache
RUN php artisan view:cache
# -----------------------------------------------------------------------------------------

# 6) Donner les droits à storage et bootstrap/cache (www-data est l'utilisateur par défaut de php-fpm)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 7) Exposer le port utilisé par Render (Render s'attend à 10000)
EXPOSE 10000

# 8) Commande de démarrage Laravel pour la production sur Render
# Utilise la variable d'environnement $PORT de Render
CMD php artisan serve --host=0.0.0.0 --port=$PORT

