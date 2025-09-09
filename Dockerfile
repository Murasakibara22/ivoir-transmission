# ------------------------------
# Dockerfile Laravel PHP 8.4 + Apache + Vite
# ------------------------------

# Étape 1 : Builder les assets frontend avec Node
FROM node:18 as frontend
WORKDIR /app

# Installer dépendances JS
COPY package*.json vite.config.* ./
RUN npm install

# Copier sources frontend
COPY resources ./resources
COPY public ./public

# Build Vite -> public/build
RUN npm run build

# Étape 2 : Image PHP 8.4 avec Apache
FROM php:8.4-apache

# Installer dépendances PHP + MySQL
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
    && a2enmod rewrite \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configurer Apache pour pointer vers /public
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

# Répertoire de travail
WORKDIR /var/www/html

# Copier uniquement composer.json et composer.lock (cache Docker)
COPY composer.json composer.lock ./
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction --no-scripts

# Copier tout le projet
COPY . .

# Copier build Vite depuis l’étape frontend
COPY --from=frontend /app/public/build ./public/build

# Donner les bons droits
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache public

# Optimiser Laravel
RUN composer dump-autoload --optimize \
    && php artisan config:clear \
    && php artisan cache:clear \
    && php artisan view:clear || true

# Exposer port
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
