# ==============================================================================
# Dockerfile - Luxury Watch RESTful API (Laravel 12 + PHP 8.3)
# ==============================================================================
FROM php:8.3-cli-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies & PHP extensions
RUN apk add --no-cache \
    curl \
    git \
    libzip-dev \
    zip \
    unzip \
    sqlite-dev \
    mysql-client \
    oniguruma-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring zip gd opcache bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application source code
COPY . .

# Install dependencies (production mode)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set proper permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port (Cloud providers like Railway/Render set $PORT)
EXPOSE 8000

# Copy and setup entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
