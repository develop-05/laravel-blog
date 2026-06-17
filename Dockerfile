FROM php:8.3-apache

# Встановлюємо системні залежності та базові розширення PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath xml zip

# Увімкнення Apache mod_rewrite для роботи роутингу
RUN a2enmod rewrite

# Встановлюємо Composer всередину контейнера
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копіюємо проєкт у контейнер
WORKDIR /var/www/html
COPY . .

# Встановлюємо залежності, ігноруючи конфлікти версій
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --no-scripts --ignore-platform-reqs

# Залізобетонні права для Apache на всю папку
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Порт для Render
EXPOSE 10000
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf

CMD ["apache2-foreground"]
