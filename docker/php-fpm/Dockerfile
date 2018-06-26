FROM php:7.2.6-fpm

RUN apt update
RUN apt install -y --no-install-recommends \
    git \
    unzip \
    curl \
    libsodium-dev \
    zlib1g-dev

RUN pecl install xdebug-2.6.0

RUN docker-php-ext-install sodium \
    zip \
    ctype \
    iconv \
    pdo_mysql

RUN docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY docker/php-fpm/xdebug.ini /usr/local/etc/php/conf.d
