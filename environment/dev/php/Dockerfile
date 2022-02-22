ARG PHP_VERSION=8.1.3

FROM php:${PHP_VERSION}-fpm

ARG COMPOSER_VERSION=2.2.5

ENV COMPOSER_MEMORY_LIMIT=-1

ARG INSTALL_XDEBUG=false


RUN apt-get update -y && apt-get upgrade -y \
     git bzip2 libpng-dev libicu-dev \
     vim libjpeg62-turbo-dev libfreetype6-dev libonig-dev \
     libpq-dev libxpm-dev libvpx-dev libbz2-dev zlib1g-dev libzip-dev gnumeric \
    && curl -sS https://getcomposer.org/installer | php -- --version="${COMPOSER_VERSION}" --install-dir=/usr/local/bin --filename=composer \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install intl bcmath mbstring bz2 gd zip pgsql pdo_pgsql opcache \
    && docker-php-ext-enable intl

RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    pecl install xdebug \
    && docker-php-ext-enable xdebug \
;fi

WORKDIR /var/www

RUN chown -R www-data:www-data /var/www && chmod 755 /var/www

EXPOSE 8000