FROM php:7.3.10-fpm

LABEL maintainer="yatsubashi"

WORKDIR /var/www/html

# Linux
RUN apt-get update && apt-get install -y \
    curl \
    git \
    libicu-dev \
    libzip-dev \
    unzip \
    wget \
    zip \
    zlib1g-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# PHP
RUN docker-php-ext-install \
    bcmath \
    mbstring \
    mysqli \
    intl \
    pdo_mysql \
    zip

# iconv & GD Extensions (https://hub.docker.com/_/php/)
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
