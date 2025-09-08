# ------------------------------
# Dockerfile Laravel complet pour PHP 8.3 + MySQL
# ------------------------------

# Utiliser PHP 8.3 avec Apache
FROM php:8.4-apache

# Installer extensions PHP nécessaires + outils pour Laravel
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
    default-mysql-client \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && a2enmod rewrite

# Configurer Apache pour Laravel (DocumentRoot = public)
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

# Copier uniquement les fichiers de dépendances d'abord pour profiter du cache Docker
COPY composer.json composer.lock ./

# Installer les dépendances Laravel
RUN composer install --optimize-autoloader --no-dev --prefer-dist --no-interaction

# Copier le reste du projet
COPY . .

# Donner les droits corrects à storage, bootstrap/cache et public
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Vider les caches Laravel
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan view:clear

# Définir l'URL de l'application (optionnel)
ENV APP_URL=https://votre-domaine.onrender.com

# Exposer le port 80
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
