FROM php:7.4-fpm

MAINTAINER jibenliu jibenliu@126.com

WORKDIR /var/www/html

COPY igbinary-3.1.2.tgz redis-5.2.2.tgz mongodb-1.7.4.tgz memcache-4.0.5.2.tgz amqp-1.10.2.tgz swoole-4.5.2.tgz xdebug-2.9.5.tgz mcrypt-1.0.3.tgz ./

ENV TZ=Asia/Shanghai

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \
    && sed -i 's/deb.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list \
    && sed -i 's|security.debian.org/debian-security|mirrors.ustc.edu.cn/debian-security|g' /etc/apt/sources.list \
    && apt-get update --fix-missing \
	&& apt-get install -y --no-install-recommends libpng-dev libfreetype6-dev libjpeg62-turbo-dev libxpm-dev libvpx-dev libmcrypt-dev pkg-config gcc g++ make autoconf libc-dev libxml2-dev librabbitmq-dev libssh-dev unzip default-mysql-client zlib1g-dev libicu-dev gnupg software-properties-common libzip-dev libonig-dev software-properties-common imagemagick libmagickcore-dev libmagickwand-dev libwebp-dev libpcre3 libpcre3-dev openssl libssl-dev curl libcurl4-openssl-dev \
    && apt-get clean && apt-get autoclean \
    && docker-php-ext-install -j$(nproc) bcmath iconv gd mysqli intl fileinfo opcache pdo_mysql zip curl opcache xml json mbstring sockets exif gettext pcntl \
    && pecl install igbinary-3.1.2.tgz \
    && pecl install redis-5.2.2.tgz \
    && pecl install xdebug-2.9.5.tgz \
    && pecl install swoole-4.5.2.tgz \
    && pecl install mongodb-1.7.4.tgz \
    && pecl install amqp-1.10.2.tgz \
    && pecl install memcache-4.0.5.2.tgz \
    && pecl install mcrypt-1.0.3.tgz \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-enable redis swoole mongodb memcache mcrypt \
    && docker-php-source delete \
	&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
	&& php composer-setup.php \
	&& php -r "unlink('composer-setup.php');" \
	&& mv composer.phar /usr/local/bin/composer \
	&& composer config -g repo.packagist composer https://packagist.phpcomposer.com \
	&& rm -rf /var/cache/apt/* \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /var/www/html/* \
	&& mkdir /var/lib/sessions \
    && chmod o=rwx -R /var/lib/sessions

CMD ["php-fpm"]
