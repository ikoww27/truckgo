# Base image dengan PHP 8 dan semua dependensi Laravel
FROM php:8.2-fpm

# Instal library tambahan (termasuk libssl.so.10)
RUN apt-get update && apt-get install -y \
    libssl1.0.0 \
    libssl-dev \
    libonig-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring zip

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy file proyek ke dalam container
WORKDIR /var/www/html
COPY . .

# Jalankan Composer untuk instalasi dependensi Laravel
RUN composer install --no-dev --optimize-autoloader

# Konfigurasi permission
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Expose port untuk PHP-FPM
EXPOSE 9000

# Menjalankan PHP-FPM
CMD ["php-fpm"]
