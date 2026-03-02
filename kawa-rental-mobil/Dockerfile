FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev zip

# Install GD extension
RUN docker-php-ext-install gd pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --optimize-autoloader --no-dev

EXPOSE 8080

CMD php artisan migrate --force || true && php -S 0.0.0.0:8080 -t public
