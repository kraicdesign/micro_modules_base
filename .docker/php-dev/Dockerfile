ARG PHP_VER=8.3

FROM php:${PHP_VER}-cli-alpine

RUN apk update
RUN apk add --no-cache bash
RUN apk add --no-cache build-base
RUN apk add --no-cache autoconf
RUN apk add --no-cache automake

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_MEMORY_LIMIT -1

# prepare
RUN apk add --update linux-headers

# php extensions
# intl
RUN apk add --no-cache icu-dev
RUN docker-php-ext-install intl
RUN docker-php-ext-enable intl

# sockets
RUN apk add --virtual build-dependencies --no-cache
RUN docker-php-ext-install sockets

# bcmath
RUN docker-php-ext-install bcmath
RUN docker-php-ext-enable bcmath

# xdebug
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

RUN mkdir /.composer_cache
ENV COMPOSER_CACHE_DIR /.composer_cache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
