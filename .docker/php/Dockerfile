FROM php:8.1.3-fpm-alpine

RUN apk --update --no-cache add git
RUN apk --update --no-cache add icu-libs
RUN apk --update --no-cache add icu-dev
RUN apk --update --no-cache add libzip
RUN apk --update --no-cache add libzip-dev

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql
RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-install opcache
RUN set -ex && apk --no-cache add libxml2-dev
RUN docker-php-ext-install soap

RUN docker-php-ext-configure zip --with-zip \
    && docker-php-ext-install -j$(nproc) zip \
    && true

COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install bash, it's more familiar
RUN apk --update --no-cache add bash

WORKDIR /var/www
CMD ["php-fpm"]
EXPOSE 9000
