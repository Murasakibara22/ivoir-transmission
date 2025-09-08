# ------------------------------
# Dockerfile Laravel 10 + PHP 8.2
# ------------------------------

FROM php:8.2-apache

# Installer les dépendances système et extensions PHP nécessaires pour Laravel
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev zip libicu-dev libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql mbstring bcmath zip exif pcntl intl opcache \
    && a2enmod rewrite

# Copier Composer depuis image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier uniquement composer.json et composer.lock pour profiter du cache Docker
COPY composer.json composer.lock ./

# Installer les dépendances Laravel
RUN composer install --prefer-dist --optimize-autoloader --no-dev --no-interaction

# Copier le reste du projet
COPY . .

# Donner les permissions correctes à storage, bootstrap/cache et public
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Vider les caches Laravel
RUN php artisan config:clear && php artisan cache:clear && php artisan view:clear

# Exposer le port 80
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
