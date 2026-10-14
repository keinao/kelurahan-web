# ==========================================
# Stage 1: Build Frontend Assets (Vite)
# ==========================================
FROM node:20-alpine AS node-build
WORKDIR /app
COPY package*.json ./
RUN npm ci || npm install
COPY . .
RUN npm run build

# ==========================================
# Stage 2: Production PHP 8.3 Apache
# ==========================================
FROM php:8.3-apache

# Install dependencies sistem & PHP extensions
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \
    libsqlite3-dev \
    sqlite3 \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd zip intl pdo pdo_sqlite pdo_mysql bcmath opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Enable Apache rewrite module
RUN a2enmod rewrite

# Setup direktori kerja
WORKDIR /var/www/html

# Copy composer files dan download dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction

# Copy seluruh source code
COPY . .

# Copy build Vite dari stage 1
COPY --from=node-build /app/public/build /var/www/html/public/build

# Generate classmap autoload Composer
RUN composer dump-autoload --optimize --no-dev --no-interaction

# Konfigurasi Apache VirtualHost & dynamic port
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf
RUN echo "Listen \${PORT}" > /etc/apache2/ports.conf

# Setup script entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Atur permission
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8080

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
