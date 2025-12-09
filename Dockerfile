# Image PHP avec toutes les extensions utiles pour Laravel + MySQL
FROM php:8.2-fpm

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

# 5) Installer les dépendances Laravel (créera vendor/autoload.php) Laravel : migrations + cache + seeders
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
RUN php artisan migrate:fresh --force || true
RUN php artisan migrate --force || true
RUN php artisan db:seed --force
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# 6) Donner les droits à storage et bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 7) Exposer le port utilisé par Render
EXPOSE 8000

# 8) Commande de démarrage Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
