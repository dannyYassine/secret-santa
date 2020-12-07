FROM php:7.4-fpm-alpine

WORKDIR /var/www/html

RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
    && docker-php-ext-install pdo pdo_mysql \
    && pecl install xdebug \
    && apk del pcre-dev ${PHPIZE_DEPS}
