ARG PHP_VERSION=8.0

FROM php:${PHP_VERSION}-fpm

RUN apt-get update && apt-get install -y \
    libxml2-dev \
    curl \
    nginx \
    wget \
    git \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libfreetype6-dev \
    libldap2-dev \
    default-mysql-client \
    libsodium-dev \
    openssl \
    default-mysql-client \
    nano

RUN curl -s https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install intl \
    && docker-php-ext-install pcntl

EXPOSE 9000

CMD ["php-fpm"]

WORKDIR /var/lumiotestapp
