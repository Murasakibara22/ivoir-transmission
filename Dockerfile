# ------------------------------
# Dockerfile Laravel PHP 8.2 + Apache
# ------------------------------

# Image officielle PHP 8.2 avec Apache
FROM php:8.2-apache

# Installer extensions nécessaires à Laravel + MySQL + outils
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
    libpq-dev \
    libzip-dev \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip \
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

# Copier le projet Laravel dans le container
WORKDIR /var/www/html
COPY . .

# Installer les dépendances Laravel
RUN composer install --optimize-autoloader --no-dev

# Donner les droits corrects à storage, bootstrap/cache et public
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public

# Vider les caches Laravel
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan view:clear

# Configurer l'URL de l'application (à adapter selon Render)
ENV APP_URL=https://ton-app.onrender.com

# Exposer le port 80
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
