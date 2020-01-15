FROM php:7.4-fpm

MAINTAINER jibenliu jibenliu@126.com

ENV TZ Asia/Shanghai
RUN date -R

WORKDIR /var/www/html
RUN apt-get update --fix-missing && apt-get install -y  libpng-dev libjpeg-dev libfreetype6-dev  libxpm-dev libvpx-dev  libmcrypt-dev libcurl4-gnutls-dev pkg-config gcc g++ make autoconf libc-dev libxml2-dev librabbitmq-dev libssh-dev unzip default-mysql-client zlib1g-dev libicu-dev gnupg software-properties-common libzip-dev libonig-dev software-properties-common imagemagick libmagickcore-dev libmagickwand-dev \
    && docker-php-ext-install bcmath gd mysqli intl opcache pdo_mysql gd zip curl opcache xml json mbstring sockets exif mbstring\
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include --with-jpeg-dir=/usr/include/jpeg


RUN pecl channel-update pecl.php.net \
    && pecl install igbinary \
    && pecl install redis \
    && pecl install xdebug \
    && pecl install swoole \
    && pecl install mongodb \
    && pecl install amqp \
    && pecl install memcache \
    && pecl install imagick \
    && pecl install mcrypt \
    && docker-php-ext-enable redis xdebug swoole mongodb amqp memcache mcrypt imagick

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
