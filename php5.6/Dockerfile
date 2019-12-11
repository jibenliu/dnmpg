FROM  php:5.6-fpm

COPY redis-4.3.0.tgz mongodb-1.5.4.tgz memcache-2.2.4.tgz /

RUN apt-get update && apt-get install -y \
 libfreetype6-dev \
 libjpeg62-turbo-dev \
 libpng12*-dev \
 && apt-get update -y \
 && docker-php-ext-install pdo_mysql \
 && pecl install redis-4.3.0.tgz \
 && pecl install mongodb-1.5.4.tgz \
 && pecl install memcache-2.2.4.tgz \
 && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
 && docker-php-ext-install gd \