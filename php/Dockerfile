FROM centos

MAINTAINER helony  

#Install necessary tools
RUN yum install -y bzip2-devel \
		openssl-devel \
	 	gnutls-devel \
	 	gcc \
		gcc-c++ \
		ncurses-devel \
		bison-devel \
		libaio-devel \
		openldap \
		openldap-devel \
		autoconf \
		bison \
		libxml2-devel \
		curl-devel \
		libcurl-devel \
		libjpeg-devel \
		libpng-devel \
		libxslt-devel \
		libevent \
		libevent-devel \
		freetype-devel \
		gd-devel \
		expat-devel \
		wget \
		openssl \
		openssl-devel \
		make \
		automake \
	&& wget https://github.com/Kitware/CMake/releases/download/v3.13.3/cmake-3.13.3.tar.gz \
	&& tar -zxvf cmake-3.13.3.tar.gz \
	&& cd cmake-3.13.3 \
	&& ./configure && make && make install \
	&& cd .. && rm cmake-3.13.3.tar.gz \
	&& wget https://libzip.org/download/libzip-1.5.1.tar.gz \
	&& tar -zxvf libzip-1.5.1.tar.gz \
	&& cd libzip-1.5.1 \
	&& mkdir build && cd build && cmake .. && make && make install \
	&& cd ../.. && rm libzip-1.5.1.tar.gz \
	&& wget http://iweb.dl.sourceforge.net/project/mcrypt/Libmcrypt/2.5.8/libmcrypt-2.5.8.tar.gz \
	&& tar xf libmcrypt-2.5.8.tar.gz \
    && cd libmcrypt-2.5.8 \
	&& ./configure && make && make install \
	&& cd .. && rm libmcrypt-2.5.8.tar.gz \
	&& echo -e '/usr/local/lib64 \n /usr/local/lib\n /usr/lib\n /usr/lib64'>>/etc/ld.so.conf && ldconfig -v \
	&& mkdir -p /usr/local/nginx/html \
	&& cd /usr/local/nginx/html \
	&& wget http://php.net/distributions/php-7.3.1.tar.gz \
	&& tar xf php-7.3.1.tar.gz \
	&& useradd -r -s /sbin/nologin php-fpm \
    && cd php-7.3.1 \
    && ./configure  --prefix=/usr/local/php \
        --with-config-file-path=/etc/local/etc/php \
        --with-config-file-scan-dir=/usr/local/etc/php/conf.d \
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
        --with-gettext \
        --with-gd \
        --with-openssl \
        --with-pcre-regex \
        --with-mhash  \
        --with-xmlrpc \
        --with-pdo-mysql \
        --with-libmbfl \
        --with-onig \
        --with-pear \
        --with-xmlrpc \
        --with-xsl \
        --enable-fpm \
        --enable-xml \
        --enable-libxml \
        --enable-bcmath \
        --enable-shmop \
        --enable-sysvsem \
        --enable-inline-optimization \
        --enable-mbregex \
        --enable-fpm \
        --enable-mbstring \
        --enable-pcntl \
        --enable-pthread \
        --enable-sockets \
        --enable-zip \
        --enable-soap \
        --enable-opcache \
        --enable-pdo \
        --enable-mysqlnd-compression-support \
        --enable-maintainer-zts  \
        --enable-session \
        --with-fpm-user=php-fpm \
        --with-fpm-group=php-fpm && make -j 2  && make -j 2 install \
    && export PATH=/usr/local/php/bin/:$PATH && source /etc/profile \
    && wget http://pecl.php.net/get/swoole-4.2.12.tgz  && pecl install swoole-4.2.12.tgz && echo "extension=swoole.so" > /usr/local/etc/php/conf.d/swoole.ini \
	&& wget http://pecl.php.net/get/redis-4.2.0.tgz && pecl install redis-4.2.0.tgz  && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini \
	&& wget http://pecl.php.net/get/mongodb-1.5.3.tgz && pecl install mongodb-1.5.3.tgz  && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini \
	&& rm -f swoole-4.2.12 \
	&& rm -f redis-4.2.0.tgz \
	&& rm -f mongodb-1.5.3.tgz \
	&& mkdir /etc/php \
	&& cp php.ini-production  /etc/php/php.ini \
	&& cp sapi/fpm/init.d.php-fpm  /etc/rc.d/init.d/php-fpm && chmod +x /etc/rc.d/init.d/php-fpm && chkconfig --add php-fpm \
	&& sed -i '/post_max_size/s/8/16/g;/max_execution_time/s/30/300/g;/max_input_time/s/60/300/g;s#\;date.timezone.*#date.timezone \= Asia/Shanghai#g' /etc/php/php.ini \
	&& cp /usr/local/php/etc/php-fpm.conf.default /usr/local/php/etc/php-fpm.conf \
	&& cp /usr/local/php/etc/php-fpm.d/www.conf.default /usr/local/php/etc/php-fpm.d/www.conf \
	&& sed -i -e 's/listen = 127.0.0.1:9000/listen = 9000/' /usr/local/php/etc/php-fpm.d/www.conf

#EXPOSE
EXPOSE 9000
#Start php-fpm
ENTRYPOINT ["/usr/local/php7/sbin/php-fpm", "-F", "-c", "/etc/php/php.ini"]
WORKDIR /var/www/html