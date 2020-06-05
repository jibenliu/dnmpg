FROM php:7.4-fpm

MAINTAINER jibenliu jibenliu@126.com

WORKDIR /var/www/html

ENV TZ=Asia/Shanghai

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \
    && sed -i 's/deb.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list \
    && sed -i 's|security.debian.org/debian-security|mirrors.ustc.edu.cn/debian-security|g' /etc/apt/sources.list \
    && apt-get update --fix-missing \
	&& apt-get install -y --fix-missing --no-install-recommends libpng-dev libfreetype6-dev libjpeg62-turbo-dev libxpm-dev libvpx-dev libmcrypt-dev pkg-config gcc g++ make autoconf libc-dev libxml2-dev librabbitmq-dev libssh-dev unzip default-mysql-client zlib1g-dev libicu-dev gnupg software-properties-common libzip-dev libonig-dev software-properties-common imagemagick libmagickcore-dev libmagickwand-dev libwebp-dev libpcre3 libpcre3-dev openssl libssl-dev curl libcurl4-openssl-dev \
    && apt-get clean && apt-get autoclean \
    && docker-php-ext-install -j$(nproc) bcmath iconv gd mysqli intl fileinfo opcache pdo_mysql zip curl opcache xml json mbstring sockets exif gettext pcntl \
    && pecl install igbinary \
    && pecl install redis \
    && pecl install xdebug \
    && pecl install swoole \
    && pecl install mongodb \
    && pecl install amqp \
    && pecl install memcache \
    && pecl install mcrypt \
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
