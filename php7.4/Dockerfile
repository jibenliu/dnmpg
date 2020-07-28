FROM php:7.4.8-fpm-alpine3.12

MAINTAINER jibenliu jibenliu@126.com

WORKDIR /var/www/html

ENV TZ=Asia/Shanghai \
  XHPROF_VERSION=5.0.1\
  ZEPHIR_VERSION=1.3.3 \
  SWOOLE_VERSION=4.4.12 \
  PECL_EXTENSIONS="apcu ast ds ev hrtime igbinary imagick lzf lua mongodb msgpack oauth pcov psr redis ssh2-1.2 uuid xdebug xlswriter yaf yaml amqp memcached mcrypt" \
  PECL_BUNDLE="memcached event" \
  PHP_EXTENSIONS="bcmath bz2 calendar exif gd gettext gmp imap intl ldap mysqli pcntl pdo_mysql pgsql pdo_pgsql soap sockets swoole swoole_async sysvshm sysvmsg sysvsem tidy zip zephir_parser "

RUN set -xe \ 
  && sed -i 's/dl-cdn.alpinelinux.org/mirrors.aliyun.com/g' /etc/apk/repositories \
  && apk update && apk upgrade \
  && apk add -U --no-cache --virtual .build-deps $PHPIZE_DEPS autoconf g++ file re2c make zlib-dev libtool pcre-dev bzip2-dev libzip libzip-dev icu icu-dev gettext gettext-dev imagemagick imagemagick-dev openldap openldap-dev openldap-back-mdb libpng-dev gmp-dev yaml yaml-dev postgresql-dev libxml2-dev tidyhtml-dev libmemcached libmemcached-dev libssh2 libssh2-dev libevent libevent-dev libev libev-dev lua-dev openssl libbz2 libxml2-utils libpq tidyhtml imap-dev lua rabbitmq-c rabbitmq-c-dev libmcrypt libmcrypt-dev \
  && apk add bash \
  && docker-php-source extract \
  && pecl channel-update pecl.php.net \
  && pecl install $PECL_EXTENSIONS \
  && cd /usr/src/php/ext/ \
  && for BUNDLE_EXT in $PECL_BUNDLE; do pecl bundle $BUNDLE_EXT; done \
  && docker-php-ext-enable $(echo $PECL_EXTENSIONS | sed -E 's/\-[^ ]+//g') opcache \
  && curl -sSLo swoole.tar.gz https://github.com/swoole/swoole-src/archive/v$SWOOLE_VERSION.tar.gz \
  && curl -sSLo swoole_async.tar.gz https://github.com/swoole/ext-async/archive/v$SWOOLE_VERSION.tar.gz \
  && tar xzf swoole.tar.gz && tar xzf swoole_async.tar.gz \
  && mv swoole-src-$SWOOLE_VERSION swoole && mv ext-async-$SWOOLE_VERSION swoole_async \
  && rm -f swoole.tar.gz swoole_async.tar.gz \
  && curl -sSLo zephir_parser.tar.gz https://github.com/phalcon/php-zephir-parser/archive/v$ZEPHIR_VERSION.tar.gz \
  && tar xzf zephir_parser.tar.gz \
  && rm -f zephir_parser.tar.gz \
  && mv php-zephir-parser-$ZEPHIR_VERSION zephir_parser \
  && docker-php-ext-install -j "$(nproc)" $PHP_EXTENSIONS $PECL_BUNDLE \
  && pecl clear-cache \
  && docker-php-source delete \
  && curl -sSLo /tmp/xhprof.tar.gz https://github.com/tideways/php-xhprof-extension/archive/v$XHPROF_VERSION.tar.gz \
  && cd /tmp/ && tar xzf xhprof.tar.gz && cd php-xhprof-extension-$XHPROF_VERSION \
  && phpize && ./configure \
  && make -j "$(nproc)" && make install \
  && docker-php-ext-enable tideways_xhprof \
  && curl -sSL https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
  && apk del .build-deps \
  && rm -rf /var/cache/apk/* /tmp/* /var/tmp/* /usr/share/doc/* /usr/share/man/*

CMD ["php-fpm"]