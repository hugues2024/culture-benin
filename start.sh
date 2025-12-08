#!/usr/bin/env bash
echo "Running composer install..."
composer install --no-dev --optimize-autoloader --working-dir=/var/www/html

echo "Caching config..."
php /var/www/html/artisan config:cache

echo "Caching routes..."
php /var/www/html/artisan route:cache

echo "Caching views..."
php /var/www/html/artisan view:cache

echo "Running migrations (optional, peut sauter si DB InfinityFree déjà prête)..."
php /var/www/html/artisan migrate --force || true
