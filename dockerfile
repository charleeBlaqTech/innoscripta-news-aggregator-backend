# Base PHP image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip zip nano \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev libzip-dev \
    libcurl4-openssl-dev libssl-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy the entire application source
COPY . .


# Set permissions
RUN mkdir -p bootstrap/cache storage/logs storage/framework && \
    chmod -R 775 bootstrap/cache storage

# Run composer install after source code is present (artisan file included)
RUN composer install --no-interaction --prefer-dist --optimize-autoloader


# Expose port & run Laravel dev server
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
