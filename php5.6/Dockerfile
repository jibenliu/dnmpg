FROM php:5.6-fpm

MAINTAINER jibenliu jibenliu@126.com

ENV TZ Asia/Shanghai
RUN date -R

WORKDIR /working
RUN apt-get update --fix-missing && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev  \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include --with-jpeg-dir=/usr/include/jpeg \
    && docker-php-ext-install gd mysqli opcache pdo_mysql gd zip memcached

ENV PHPREDIS_VERSION 4.0.1
ENV PHPXDEBUG_VERSION 2.6.0
ENV PHPSWOOLE_VERSION 4.2.13
ENV PHPMONGODB_VERSION 1.5.3
ENV PHPRABBITMQ_VERSION 1.8.0
ENV PHPMEMCACHE_VERSION 1.0.18
RUN pecl install redis-$PHPREDIS_VERSION \
    && pecl install xdebug-$PHPXDEBUG_VERSION \
    && pecl install swoole-$PHPSWOOLE_VERSION \
    && pecl install mongodb-$PHPMONGODB_VERSION \
    && pecl install amqp-$PHPRABBITMQ_VERSION \
    && pecl install memcache-$PHPMEMCACHE_VERSION \
    && docker-php-ext-enable redis xdebug swoole mongodb amqp memcached

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
     && php composer-setup.php \
     && php -r "unlink('composer-setup.php');" \
     && mv composer.phar /usr/local/bin/composer \
     && composer config -g repo.packagist composer https://packagist.phpcomposer.com

RUN rm -rf /var/cache/apt/* \
    && rm -rf /var/lib/apt/lists/*

RUN mkdir /var/lib/sessions \
    && chmod o=rwx -R /var/lib/sessions

CMD ["php-fpm"]