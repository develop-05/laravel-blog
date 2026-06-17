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

# Увімкнення Apache mod_rewrite для роботи роутингу Laravel
RUN a2enmod rewrite

# Зміна кореневої папки Apache на public-директорію Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/sites-available/*.conf

# Встановлюємо Composer всередину контейнера
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Копіюємо проєкт у контейнер
WORKDIR /var/www/html
COPY . .

# Встановлюємо залежності, ігноруючи будь-які конфлікти версій та платформ
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --no-scripts --ignore-platform-reqs

# Виставляємо правильні права для Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Render автоматично дає порт 10000 для Apache в безкоштовному тарифі
EXPOSE 10000
RUN sed -i 's/Listen 80/Listen 10000/' /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf

CMD ["apache2-foreground"]
