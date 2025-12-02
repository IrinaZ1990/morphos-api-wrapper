# Используем официальный образ PHP
FROM php:8.2-cli

# Установка зависимостей
RUN apt-get update && apt-get install -y git zip unzip libicu-dev \
    && docker-php-ext-install intl mbstring

# Установка Composer
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# Копирование кода проекта
WORKDIR /app
COPY . .

# Установка библиотеки Morphos
RUN composer install --no-dev --optimize-autoloader

# Экспозиция порта 8080
EXPOSE 8080

# Запуск встроенного сервера
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public/"]
