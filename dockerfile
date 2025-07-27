FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    nano \
    libzip-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    default-mysql-client \
&& docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy everything into container
COPY . .

# Install PHP dependencies without dev tools
RUN composer install --no-dev --optimize-autoloader

# Cache config for faster boot
RUN php artisan config:cache

# Expose port
EXPOSE 8000

# Run Laravel app
CMD php artisan serve --host=0.0.0.0 --port=8000
