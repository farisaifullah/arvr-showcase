FROM dunglas/frankenphp

WORKDIR /app

# Copy semua file Laravel ke dalam container
COPY . .

# Install dependency sistem
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libicu-dev \
    libonig-dev \
    mariadb-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install zip gd intl pdo pdo_mysql

RUN docker-php-ext-install pcntl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY docker/php.ini /usr/local/etc/php/conf.d/uploads.ini

# Install Laravel dependencies sekaligus Octane
RUN composer require laravel/octane --no-interaction --no-progress \
    && composer install \
    && php artisan octane:install --server=frankenphp

# Generate app key
RUN php artisan key:generate

# Install Caddy
COPY Caddyfile /etc/caddy/Caddyfile

# Copy entrypoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Permission
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && chmod -R 775 /app

# Make sure .htaccess is readable
RUN chown www-data:www-data /app/public/.htaccess

EXPOSE 90

ENTRYPOINT ["/entrypoint.sh"]
