FROM richarvey/nginx-php-fpm:1.7.2

# Copier tout le projet dans le conteneur
COPY . /var/www/html

# Dossier public comme racine web
ENV WEBROOT=/var/www/html/public
ENV SKIP_COMPOSER=1
ENV RUN_SCRIPTS=1
ENV PHP_ERRORS_STDERR=1
ENV COMPOSER_ALLOW_SUPERUSER=1

# Script de déploiement Laravel automatique
COPY scripts/00-laravel-deploy.sh /var/www/html/start.sh
RUN chmod +x /var/www/html/start.sh

CMD ["/start.sh"]
