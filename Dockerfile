# ------------------------------
# Dockerfile Laravel optimisé
# ------------------------------

# Utiliser PHP 8.2 avec Apache
FROM php:8.2-apache

# Installer extensions et outils nécessaires à Laravel + MySQL
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip \
    && a2enmod rewrite

# Configurer Apache pour Laravel
RUN cat <<'EOF' > /etc/apache2/sites-available/000-default.conf
<VirtualHost *:80>
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

# Copier Composer depuis image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier uniquement composer.json et composer.lock d'abord pour utiliser le cache Docker
COPY composer.json composer.lock ./

# Installer les dépendances Laravel
RUN composer install --optimize-autoloader --no-dev --prefer-dist --no-interaction --no-scripts

# Copier le reste du projet
COPY . .

# Donner les droits corrects à storage, bootstrap/cache et public
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Vider les caches Laravel
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan view:clear

# Forcer l'utilisation de HTTPS dans les assets (optionnel)
ENV APP_URL=https://ton-domaine-render.com

# Exposer le port 80
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
