FROM  php:5.6-fpm

MAINTAINER jibenliu jibenliu@126.com

WORKDIR /var/www/html 
COPY redis-4.3.0.tgz mongodb-1.5.4.tgz memcache-2.2.4.tgz amqp-1.10.2.tgz ./

# 设置时区
ENV TZ=Asia/Shanghai

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \
	&& sed -i 's/deb.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list \
	&& sed -i 's|security.debian.org/debian-security|mirrors.ustc.edu.cn/debian-security|g' /etc/apt/sources.list \
	&& apt-get update --fix-missing \
	&& apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev libxpm-dev libvpx-dev libmcrypt-dev libcurl4-gnutls-dev pkg-config gcc g++ make autoconf libc-dev libxml2-dev librabbitmq-dev libssh-dev unzip default-mysql-client zlib1g-dev libicu-dev gnupg software-properties-common libzip-dev libonig-dev software-properties-common imagemagick libmagickcore-dev libmagickwand-dev libwebp-dev \
	&& docker-php-ext-install -j$(nproc) bcmath gd mysqli intl opcache pdo_mysql zip curl opcache xml json mbstring sockets exif \
	&& pecl install redis-4.3.0.tgz \
	&& pecl install mongodb-1.5.4.tgz \
	&& pecl install memcache-2.2.4.tgz \
	&& pecl install amqp-1.10.2.tgz \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-enable redis mongodb amqp memcache \
	&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
	&& php composer-setup.php \
	&& php -r "unlink('composer-setup.php');" \
	&& mv composer.phar /usr/local/bin/composer \
	&& composer config -g repo.packagist composer https://packagist.phpcomposer.com \
	&& rm -rf /var/cache/apt/* \
    && rm -rf /var/lib/apt/lists/* \
    && rm -rf /var/www/html/* \
	&& rm -rf ./* \
	&& mkdir /var/lib/sessions \
    && chmod o=rwx -R /var/lib/sessions

CMD ["php-fpm"]
