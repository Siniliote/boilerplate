
ARG PHP_VERSION=8.1-rc
ARG NGINX_VERSION=1.21.3

### NGINX
FROM nginx:${NGINX_VERSION}-alpine AS symfony_nginx

### PHP
FROM php:${PHP_VERSION}-fpm-alpine AS symfony_php

RUN apk add --no-cache \
	git \
	icu-libs \
	zlib \
	bash \
	jq

ENV APCU_VERSION 5.1.21
RUN set -eux \
	&& apk add --no-cache --virtual .build-deps \
	$PHPIZE_DEPS \
	icu-dev \
	libzip-dev \
	zlib-dev \
    postgresql-dev \
	&& docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_pgsql \
    pgsql \
	intl \
	zip \
	&& pecl install \
	apcu-${APCU_VERSION} \
	&& docker-php-ext-enable --ini-name 20-apcu.ini apcu \
	&& docker-php-ext-enable --ini-name 05-opcache.ini opcache \
	&& runDeps="$( \
	scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
	| tr ',' '\n' \
	| sort -u \
	| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
	)" \
	&& apk add --no-cache --virtual .api-phpexts-rundeps $runDeps \
	&& apk del .build-deps

###> Xdebug ###
ARG XDEBUG_VERSION=3.1.1
RUN set -eux; \
	apk add --no-cache --virtual .build-deps $PHPIZE_DEPS; \
	pecl install xdebug-$XDEBUG_VERSION; \
	docker-php-ext-enable xdebug; \
	apk del .build-deps
###< Xdebug ###

RUN ln -s $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini
COPY docker/app/conf.d/symfony.ini $PHP_INI_DIR/conf.d/symfony.ini
COPY docker/app/conf.d/xdebug.ini $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN wget https://get.symfony.com/cli/installer -O - | bash && \
	mv /root/.symfony/bin/symfony /usr/local/bin/symfony

WORKDIR /srv/app
EXPOSE 9000

CMD ["php-fpm"]
