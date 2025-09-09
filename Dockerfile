# ------------------------------
# Dockerfile Laravel + Vite + PHP 8.4
# ------------------------------

# Étape 1 : Builder les assets frontend avec Node.js
FROM node:20 AS frontend
WORKDIR /app

# Copier uniquement fichiers liés au frontend (cache optimisé)
COPY package*.json vite.config.* ./
RUN npm install

# Copier tout le projet pour accéder aux sources frontend
COPY . .

# Construire les assets Vite (avec logs en cas d’échec)
RUN npm run build || cat /app/npm-debug.log || true

# Étape 2 : Backend Laravel avec PHP 8.4 et Apache
FROM php:8.4-apache

# Installer extensions et dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git unzip curl libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev default-mysql-client \
    libicu-dev zip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip intl \
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Config Apache pour Laravel
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

# Copier Composer depuis l’image officielle
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Répertoire de travail
WORKDIR /var/www/html

# Copier uniquement composer.json + lock d’abord (cache Docker)
COPY composer.json composer.lock ./

# Installer dépendances Laravel sans exécuter les scripts
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copier tout le projet Laravel
COPY . .

# Copier les assets buildés par Vite
COPY --from=frontend /app/public/build ./public/build

# Droits pour Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache public

# Optimiser Laravel
RUN composer dump-autoload --optimize \
    && php artisan config:clear \
    && php artisan cache:clear \
    && php artisan view:clear || true

# Variable d’environnement (ajuste selon ton Render)
ENV APP_URL=https://votre-domaine.onrender.com

# Exposer port Apache
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
