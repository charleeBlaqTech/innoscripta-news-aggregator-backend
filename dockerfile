# Base PHP image
FROM php:8.3.10

# Install system dependencies
RUN apt-get update -y && apt-get install -y openssl zip unzip git

# Install PHP extensions (pdo_mysql and zip)
RUN docker-php-ext-install pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN php -m | grep mbstring

# Set working directory
WORKDIR /app

# copy application file to container
COPY . /app

RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000


# Expose port & run Laravel dev server
EXPOSE 8000

