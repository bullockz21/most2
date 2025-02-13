# Используем официальный PHP-образ с поддержкой FPM
FROM php:8.2-fpm

# Устанавливаем зависимости и очищаем кеш
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Устанавливаем Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Указываем рабочую директорию
WORKDIR /var/www

# Оптимизация кеша Docker: копируем только файлы composer перед установкой
COPY library-api/composer.json library-api/composer.lock ./

# Устанавливаем переменную окружения для Composer
ENV COMPOSER_ALLOW_SUPERUSER=1

# Устанавливаем зависимости Laravel (без dev-зависимостей)
RUN composer install --no-dev --optimize-autoloader

# Теперь копируем остальной код
COPY . .

# Устанавливаем правильные права и разрешения
RUN chown -R www-data
