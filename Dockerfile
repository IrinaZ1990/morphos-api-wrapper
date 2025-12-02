# Используем официальный образ PHP с уже включёнными расширениями
FROM php:8.2-cli

# Устанавливаем зависимости ОС, включая oniguruma
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        git \
        zip \
        unzip \
        libicu-dev \
        libonig-dev && \
    docker-php-ext-install intl mbstring

# Установка Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Копируем проект
WORKDIR /app
COPY . .

# Устанавливаем PHP-зависимости
RUN composer install --no-dev --optimize-autoloader

# Экспозиция порта
EXPOSE 8080

# Запуск встроенного сервера
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public/"]
