FROM postgres:11.3
FROM php:8.2.1-fpm

RUN apt-get -y update && apt-get upgrade -y
RUN apt-get install libpq-dev -y
RUN docker-php-ext-install pgsql pdo_pgsql && docker-php-ext-enable pdo_pgsql pgsql

RUN pecl install xdebug-3.2.0 && docker-php-ext-enable xdebug

COPY docker/php/conf.d/* $PHP_INI_DIR/conf.d/

CMD ["php-fpm"]
