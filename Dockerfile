ARG PHP_VERSION=8.2
FROM php:${PHP_VERSION}-cli

LABEL maintainer="Tomáš Lembacher <tomas.lembacher@seznam.cz>"

RUN apt-get update

RUN apt-get install -y \
		git \
		libzip-dev \
		zlib1g-dev \
        zip \
        mc

RUN pecl install xdebug-3.2.1 \
	&& echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
	&& echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini

# Copy PHP config
COPY docker/etc/php $PHP_INI_DIR/conf.d

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . /var/www/html
RUN composer install
