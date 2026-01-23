# Основа контейнера
FROM php:8.2-fpm-alpine

# Системные пакеты (добавлены libjpeg-turbo-dev, freetype для GD)
RUN apk add --no-cache \
    bash git curl zip unzip \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    icu-dev \
    mysql-client

# PHP-расширения (исправлен with-jpeg, убрал xpm, правильный configure)
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp \
    && docker-php-ext-install \
    pdo pdo_mysql mbstring gd intl zip opcache

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Рабочая директория
WORKDIR /var/www/html

# Установка зависимостей (composer перед копированием всего)
COPY composer.json composer.lock* ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

# Копирование всего проекта
COPY . .

# Права на storage/cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Оптимизации Laravel (выполняются только если есть .env)
# В production эти команды должны выполняться после настройки .env
RUN php artisan config:clear || true \
    && php artisan route:clear || true \
    && php artisan view:clear || true

EXPOSE 9000
CMD ["php-fpm"]
