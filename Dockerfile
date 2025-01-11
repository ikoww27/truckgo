# Gunakan image resmi PHP
FROM php:8.2-apache

# Instal dependensi yang diperlukan
RUN apt-get update && apt-get install -y \
    libssl1.1 libssl-dev curl unzip libpng-dev \
    && docker-php-ext-install pdo pdo_mysql

# Instal Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copy aplikasi Laravel ke container
WORKDIR /var/www/html
COPY . .

# Konfigurasi Laravel
RUN composer install --optimize-autoloader --no-dev \
    && php artisan key:generate \
    && php artisan config:cache \
    && php artisan route:cache

# Ubah hak akses direktori storage
RUN chmod -R 777 storage bootstrap/cache

# Expose port 80
EXPOSE 80
CMD ["apache2-foreground"]
