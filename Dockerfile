FROM dunglas/frankenphp:latest-php8.3

# Встановлюємо необхідні розширення для Laravel (включаючи БД)
RUN install-php-extensions pcntl pdo_mysql pdo_pgsql zip intl gd opcache

# Копіюємо код проєкту в контейнер
COPY . /app

# Встановлюємо Composer та залежності
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Налаштовуємо права для Laravel
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Відкриваємо порт
EXPOSE 8080
ENV PORT=8080

# Команда для старту сервера
CMD ["frankenphp", "php-server", "--listen", ":8080", "--public-dir", "public"]