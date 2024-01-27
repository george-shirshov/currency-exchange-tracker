FROM php:8.2-apache

# настройка модулей apache
RUN a2enmod rewrite

# установка рабочей директории
WORKDIR /var/www/html

# установка composer
COPY --from=composer:2.6.6 /usr/bin/composer /usr/bin/composer

# установка/обновление пакетов
RUN apt-get update && apt-get install -y git libzip-dev libpq-dev unzip

# установка и настройка Xdebug
RUN pecl install xdebug-3.3.1 && docker-php-ext-enable xdebug
COPY xdebug.ini "${PHP_INI_DIR}/conf.d"

# Установка расширений
RUN docker-php-ext-install pdo_pgsql zip
