FROM php:7.3-fpm
MAINTAINER isuben "isuben@foxmail.com"

# 设置时区
ENV TZ=Asia/Shanghai
# 设置composer目录
ENV COMPOSER_HOME /root/composer

# 更新安装依赖包和PHP核心拓展
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \
	&& mkdir -p /usr/local/etc/php/conf.d \
	&& apt-get update \
	&& apt-get install -y libzip-dev autoconf zip curl libfreetype6-dev libjpeg62-turbo-dev libpng-dev libssl-dev wget libxml2-dev libldap-2.4-2 ldap-utils libldap2-dev \
	&& apt-get autoremove \
	&& apt-get autoclean \
	&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-pdo-mysql=mysqlnd --with-pdo-mysql=mysqlnd --with-mysqli=mysqlnd --with-mysql=mysqlnd \
	&& docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql shmop pcntl zip soap bcmath calendar dba ldap sockets gettext opcache \
	&& rm -r /var/lib/apt/lists/* \
	&& wget http://pecl.php.net/get/swoole-4.2.12.tgz  && pecl install swoole-4.2.12.tgz && echo "extension=swoole.so" > /usr/local/etc/php/conf.d/swoole.ini \
	&& wget http://pecl.php.net/get/redis-4.2.0.tgz && pecl install redis-4.2.0.tgz  && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini \
	&& wget http://pecl.php.net/get/mongodb-1.5.3.tgz && pecl install mongodb-1.5.3.tgz  && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini \
	&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


ENV PATH $COMPOSER_HOME/vendor/bin:$PATH
WORKDIR /var/www/html