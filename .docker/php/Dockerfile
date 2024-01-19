FROM php:8.1.3-fpm-alpine

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
CMD ["php-fpm"]
EXPOSE 9000
