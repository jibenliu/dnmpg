FROM php:5.6-cli-alpine

MAINTAINER jibenliu jibenliu@126.com

WORKDIR /var/www/html

ENV TZ=Asia/Shanghai

RUN set -xe \ 
  && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone \
  && sed -i 's/dl-cdn.alpinelinux.org/mirrors.aliyun.com/g' /etc/apk/repositories \
  && apk update && apk upgrade \
  && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS libtool icu-dev curl-dev freetype-dev imagemagick-dev pcre-dev postgresql-dev libjpeg-turbo-dev libpng-dev libxml2-dev openldap-dev libmcrypt-dev rabbitmq-c rabbitmq-c-dev wget autoconf dpkg-dev dpkg file g++ gcc libc-dev make pkgconf re2c libtool openssl \
  && apk add bash \
  && docker-php-ext-configure gd --with-gd --with-freetype-dir=/usr/include/ --with-png-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-mysqli \
  && docker-php-ext-configure bcmath \
  && docker-php-ext-configure ldap --with-ldap \
  && docker-php-ext-install soap zip curl bcmath exif gd iconv intl mbstring opcache pdo_mysql mysql mysqli pgsql pdo_pgsql ldap mcrypt \
  && pecl channel-update pecl.php.net \
  && printf "\n" | pecl install -o -f imagick redis-4.3.0 mongo memcache-2.2.7 amqp igbinary-2.0.8 \
  && docker-php-ext-enable redis imagick memcache redis mongo igbinary mysqli mcrypt \
  && docker-php-source delete \
  && runDeps="$( \
    scanelf --needed --nobanner --format '%n#p' --recursive /usr/local \
      | tr ',' '\n' \
      | sort -u \
      | awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
  )" \
  && apk add --no-cache --virtual .php-rundeps $runDeps imagemagick \
  && rm -rf /tmp/pear /var/cache/apk/* \
  && apk del .build-deps 

CMD ["php -a"]