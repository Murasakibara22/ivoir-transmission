# ------------------------------
# Dockerfile Laravel 10 + PHP 8.2 + MySQL
# ------------------------------

FROM php:8.2-apache

# Installer dépendances système
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    curl \
    nano \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql mbstring bcmath zip exif pcntl \
    && a2enmod rewrite

# Copier Composer depuis l'image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier uniquement composer.json et composer.lock pour profiter du cache Docker
COPY composer.json composer.lock ./

# Installer les dépendances Laravel (avec scripts, sinon artisan fail)
RUN composer install --optimize-autoloader --no-dev --prefer-dist --no-interaction

# Copier le reste du projet
COPY . .

# Permissions correctes pour storage et bootstrap/cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Vider les caches Laravel
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan view:clear

# Exposer le port 80
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
