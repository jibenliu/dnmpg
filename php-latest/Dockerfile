FROM centos:latest

#ADD http://cn.php.net/distributions/php-7.3.1.tar.gz . 
#ADD https://github.com/Kitware/CMake/releases/download/v3.13.3/cmake-3.13.3.tar.gz . 
#ADD http://iweb.dl.sourceforge.net/project/mcrypt/Libmcrypt/2.5.8/libmcrypt-2.5.8.tar.gz . 
#ADD http://pecl.php.net/get/swoole-4.2.12.tgz . 
#ADD http://pecl.php.net/get/redis-4.2.0.tgz . 
#ADD http://pecl.php.net/get/mongodb-1.5.3.tgz .

COPY php-7.3.1.tar.gz cmake-3.13.3.tar.gz libmcrypt-2.5.8.tar.gz swoole-4.2.12.tgz redis-4.3.0.tgz mongodb-1.5.4.tgz libzip-1.5.1.tar.gz /

RUN yum update -y && yum install -y bzip2-devel openssl-devel gnutls-devel gcc gcc-c++ ncurses-devel bison-devel libaio-devel openldap  openldap-devel autoconf bison libxml2-devel libcurl-devel libevent libevent-devel gd-devel  expat-devel \
    && mkdir -p /usr/local/nginx/html \
    && useradd -r -s /sbin/nologin php-fpm \
    && tar -zxvf cmake-3.13.3.tar.gz \
    && cd cmake-3.13.3 \
    && ./configure && make && make install && make clean \
    && cd / && rm cmake-3.13.3.tar.gz \
    && tar -zxvf libzip-1.5.1.tar.gz \
    && cd libzip-1.5.1 && mkdir build && cd build && cmake .. && make && make install && make clean \
    && cd / && rm libzip-1.5.1.tar.gz \
    && tar xf libmcrypt-2.5.8.tar.gz \
    && cd libmcrypt-2.5.8 && ./configure && make && make install && make clean \
    && cd / && rm libmcrypt-2.5.8.tar.gz \
    && echo -e '/usr/local/lib64 \n /usr/local/lib\n /usr/lib\n /usr/lib64'>>/etc/ld.so.conf && ldconfig -v \
    && tar xf php-7.3.1.tar.gz \
    && cd php-7.3.1 \
    && ./configure  --prefix=/usr/local/php7 \
        --with-config-file-path=/etc/php7 \
        --with-config-file-scan-dir=/etc/php7.d \
        --with-mysqli=mysqlnd  \
        --with-pdo-mysql=mysqlnd \
        --with-mysql-sock=/tmp/mysql.sock \
        --with-iconv-dir \
        --with-freetype-dir \
        --with-jpeg-dir \
        --with-png-dir \
        --with-zlib \
        --with-bz2 \
        --with-libxml-dir \
        --with-curl \
        --with-gd \
        --with-openssl \
        --with-mhash  \
        --with-xmlrpc \
        --with-pdo-mysql \
        --with-onig \
        --with-pear \
        --enable-xml \
        --enable-bcmath \
        --enable-shmop \
        --enable-sysvsem \
        --enable-inline-optimization \
        --enable-mbregex \
        --enable-fpm \
        --enable-mbstring \
        --enable-pcntl \
        --enable-sockets \
        --enable-zip \
        --enable-soap \
        --enable-opcache \
        --enable-pdo \
        --enable-mysqlnd-compression-support \
        --enable-maintainer-zts  \
        --enable-session \
        --with-fpm-user=php-fpm \
        --with-fpm-group=php-fpm  && make -j 2  && make -j 2 install && make clean \
    && export PATH=/usr/local/php7/bin:$PATH && source /etc/profile \
    && mkdir /etc/php7{,.d} \
    && cp php.ini-production  /etc/php7/php.ini \
    && cp sapi/fpm/init.d.php-fpm  /etc/rc.d/init.d/php-fpm && chmod +x /etc/rc.d/init.d/php-fpm && chkconfig --add php-fpm \
    && sed -i '/post_max_size/s/8/16/g;/max_execution_time/s/30/300/g;/max_input_time/s/60/300/g;s#\;date.timezone.*#date.timezone \= Asia/Shanghai#g' /etc/php7/php.ini \
    && export PATH=/usr/local/php7/bin/:$PATH && source /etc/profile \
    && cp /usr/local/php7/etc/php-fpm.conf.default /usr/local/php7/etc/php-fpm.conf \
	&& cd /  && pecl install swoole-4.2.12.tgz && echo "extension=swoole.so" > /etc/php7.d/swoole.ini \
	&& pecl install redis-4.3.0.tgz  && echo "extension=redis.so" > /etc/php7.d/redis.ini \
    && pecl install mongodb-1.5.4.tgz  && echo "extension=mongodb.so" > /etc/php7.d/mongodb.ini \
	&& cd / && rm -f swoole-4.2.12.tgz redis-4.2.0.tgz mongodb-1.5.3.tgz  php-7.3.1.tar.gz \
    && cp /usr/local/php7/etc/php-fpm.d/www.conf.default /usr/local/php7/etc/php-fpm.d/www.conf \
    && sed -i -e 's/listen = 127.0.0.1:9000/listen = 9000/' /usr/local/php7/etc/php-fpm.d/www.conf \
	&& cp /usr/local/php7/bin/php /usr/bin/php \
	&& php -r "copy('https://install.phpcomposer.com/installer', 'composer-setup.php');" \
	&& php composer-setup.php \
	&& mv composer.phar /usr/bin/composer \
	&& php -r "unlink('composer-setup.php');" \
	&& chmod 0777 -R /.composer \
	&& composer config -g repo.packagist composer https://packagist.phpcomposer.com \

EXPOSE 9000

ENTRYPOINT ["/usr/local/php7/sbin/php-fpm", "-F", "-c", "/etc/php7/php.ini"]

WORKDIR /etc/nginx/html