FROM php:8.2-fpm

# 1) Dépendances système + SUPPRIME DUPLICATA mbstring/pdo
RUN apt-get update && apt-get install -y \
    git curl unzip libzip-dev libonig-dev libxml2-dev libssl-dev libpng-dev \
    && docker-php-ext-install pdo_mysql zip exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2) Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer

# 3) Dossier
WORKDIR /var/www/html
COPY . .

# 4) Composer SANS --no-dev (pour seeders)
RUN composer install --optimize-autoloader --no-interaction

# 5) Laravel (DB APRÈS .env Render)
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# 6) EXPOSE PORT Render
EXPOSE $PORT
ENV PORT=8000

# 7) CMD Render (pas artisan serve)
CMD ["sh", "-c", "php-fpm"]
