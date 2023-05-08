#!/bin/sh
set -e

docker-php-ext-install \
    bcmath \
    dba \
    gd \
    intl \
    pdo \
    pdo_pgsql \
    pgsql \
    soap \
    xml \
    xsl \
    zip
docker-php-ext-enable \
    dba \
    gd \
    intl \
    pdo \
    pdo_pgsql \
    pgsql \
    soap \
    xml \
    xsl \
    zip

pecl install xdebug

docker-php-ext-enable xdebug
