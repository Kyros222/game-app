# Основа основа контейнера
FROM php:8.2-fpm-alpine

#Системные пакеты
RUN apk add --no-cache \
    bash git curl zip unzip \
    libpng-dev libjpeg-turbo-dev libwebp-dev libxpm-dev \
    libzip-dev oniguruma-dev icu-dev \
    mysql-client

#PHP‑расширения Это надстройки над самим PHP, дополнительные модули, которые добавляют новые возможности: работа с БД, картинками, кешированием, архивами и т.п.
RUN docker-php-ext-configure gd \
    --with-jbeg --with-webp --with-xpm \
    && docker-php-ext-install \
    pdo pdo_mysql mbstring gd intl zip opcache

#Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

#Рабочая Директория
WORKDIR /var/www/html

#Установка зависимостей проекта
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

#КОПИРОВАНИЕ ВСЕГО ПРОЕКТА
COPY . .

#ПРАВА НА storage И cache ужно, чтобы Laravel не орал "Permission denied"
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

#Оптимизации Laravel для продакшена
# Собирает все конфиги в один кеш‑файл, чтобы не читать кучу файлов при каждом запросе.
RUN php artisan config:cache || true \
    && php artisan route:cache || true \
    && php artisan view:cache || true
#ПРИМЕЧАНИЕ: || true — если команда упала (например, нет .env или ещё чего‑то), сборка образа не завалится, команда просто проигнорируется.

#Открытыый порт
EXPOSE 9000

#Команда по-умолчанию
CMD [ "php-fpm" ]
# когда контейнер стартует — запускай процесс php-fpm
