FROM  php:5.6-fpm

WORKDIR /var/www/html 
COPY redis-4.3.0.tgz mongodb-1.5.4.tgz memcache-2.2.4.tgz ./

RUN apt-get update \
	&& apt-get install -y \
	&& libfreetype6-dev \
	&& libjpeg62-turbo-dev \
	&& libpng12*-dev \
	&& apt-get update -y \
	&& docker-php-ext-install pdo_mysql \
	&& pecl install redis-4.3.0.tgz \
	&& pecl install mongodb-1.5.4.tgz \
	&& pecl install memcache-2.2.4.tgz \
	&& pecl install amqp \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
	&& docker-php-ext-install gd \
	&& docker-php-ext-enable redis xdebug swoole mongodb amqp memcache mcrypt imagick \
	&&  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
	&& php composer-setup.php \
	&& php -r "unlink('composer-setup.php');" \
	&& mv composer.phar /usr/local/bin/composer \
	&& composer config -g repo.packagist composer https://packagist.phpcomposer.com \
	&& rm -rf /var/cache/apt/* \
    && rm -rf /var/lib/apt/lists/* \
	&& rm -rf ./* \
	&& mkdir /var/lib/sessions \
    && chmod o=rwx -R /var/lib/sessions

CMD ["php-fpm"]
