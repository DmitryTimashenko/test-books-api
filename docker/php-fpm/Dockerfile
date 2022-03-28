FROM php:8-fpm-alpine

# Install packages
RUN apk add --no-cache curl git build-base zlib-dev oniguruma-dev autoconf bash

# postgress
RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql

# Configure non-root user.
RUN apk --no-cache add shadow && \
    groupmod -o -g 1000 www-data && \
    usermod -o -u 1000 -g www-data www-data

# Source code
RUN chown www-data:www-data /var/www
COPY --chown=www-data:www-data ./ /var/www
WORKDIR /var/www/app

USER www-data

# Installing composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN composer install

CMD php-fpm

EXPOSE 9000
