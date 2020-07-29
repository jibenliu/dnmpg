FROM php:7.4.8-fpm-alpine3.12

MAINTAINER jibenliu jibenliu@126.com

WORKDIR /var/www/html

ENV TZ=Asia/Shanghai \
  PECL_EXTENSIONS="apcu ast ds ev hrtime igbinary imagick lzf lua mongodb msgpack oauth pcov psr redis uuid xdebug xlswriter yaf yaml amqp memcache mcrypt"

RUN set -xe \ 
  && sed -i 's/dl-cdn.alpinelinux.org/mirrors.aliyun.com/g' /etc/apk/repositories \
  && apk update && apk upgrade \
  && apk add -U --no-cache --virtual .build-deps $PHPIZE_DEPS autoconf g++ file re2c make zlib-dev libtool pcre-dev bzip2-dev libzip libzip-dev icu icu-dev gettext gettext-dev imagemagick imagemagick-dev openldap openldap-dev openldap-back-mdb libpng-dev gmp-dev yaml yaml-dev postgresql-dev libxml2-dev tidyhtml-dev libmemcached libmemcached-dev libssh2 libssh2-dev libevent libevent-dev libev libev-dev lua-dev openssl libbz2 libxml2-utils libpq tidyhtml imap-dev lua rabbitmq-c rabbitmq-c-dev libmcrypt libmcrypt-dev \
  && apk add bash \
  && docker-php-source extract \
  && pecl channel-update pecl.php.net \
  && pecl install $PECL_EXTENSIONS \
  && cd /usr/src/php/ext/sockets \
  && phpize \
  && ./configure --enable-sockets --with-php-config=/usr/local/bin/php-config \
  && make && make install \
  && cd /tmp \
  && curl -sSLo event-2.5.6.tgz https://pecl.php.net/get/event-2.5.6.tgz \
  && tar -zxvf event-2.5.6.tgz && cd event-2.5.6 \
  && phpize \
  && ./configure --with-php-config=/usr/local/bin/php-config && make -j "$(nproc)" && make install \
  && cd /usr/src/php/ext/ \
  && docker-php-ext-enable $(echo $PECL_EXTENSIONS | sed -E 's/\-[^ ]+//g') \
  && curl -sSLo swoole.tar.gz https://github.com/swoole/swoole-src/archive/v4.4.12.tar.gz \
  && curl -sSLo swoole_async.tar.gz https://github.com/swoole/ext-async/archive/v4.4.12.tar.gz \
  && tar xzf swoole.tar.gz && tar xzf swoole_async.tar.gz \
  && mv swoole-src-4.4.12 swoole && mv ext-async-4.4.12 swoole_async \
  && rm -f swoole.tar.gz swoole_async.tar.gz \
  && curl -sSLo zephir_parser.tar.gz https://github.com/phalcon/php-zephir-parser/archive/v1.3.3.tar.gz \
  && tar xzf zephir_parser.tar.gz \
  && rm -f zephir_parser.tar.gz \
  && mv php-zephir-parser-1.3.3 zephir_parser \
  && docker-php-ext-configure opcache --enable-opcache \
  && docker-php-ext-install bcmath bz2 calendar exif gd gettext gmp imap intl ldap mysqli pcntl pdo_mysql pgsql pdo_pgsql soap swoole swoole_async sysvshm sysvmsg sysvsem tidy zip zephir_parser opcache \
  && pecl clear-cache \
  && docker-php-source delete \
  && curl -sSLo /tmp/xhprof.tar.gz https://github.com/tideways/php-xhprof-extension/archive/v5.0.1.tar.gz \
  && cd /tmp/ && tar xzf xhprof.tar.gz && cd php-xhprof-extension-5.0.1 \
  && phpize && ./configure \
  && make -j "$(nproc)" && make install \
  && docker-php-ext-enable tideways_xhprof \
  && curl -sSL https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
  && apk del .build-deps \
  && rm -rf /var/cache/apk/* /tmp/* /var/tmp/* /usr/share/doc/* /usr/share/man/*

CMD ["php-fpm"]