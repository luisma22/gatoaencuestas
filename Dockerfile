FROM php:8.1-fpm

# Dependencias del sistema
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libpq-dev \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    nodejs \
    npm \
    && docker-php-ext-install \
        pdo_pgsql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar proyecto
COPY . .

# Dependencias PHP
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction

# Dependencias frontend y build
RUN npm install
RUN npm run production

# Permisos Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Configuración nginx
COPY docker/nginx.conf /etc/nginx/sites-available/default

EXPOSE 10000

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]