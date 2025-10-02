FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libonig-dev \
    && docker-php-ext-install mbstring

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php

WORKDIR /var/www/html

COPY composer.json ./

RUN composer install --dev --no-interaction

COPY . .

COPY _docker/app/php.ini /usr/local/etc/php/php.ini

RUN composer dump-autoload --optimize