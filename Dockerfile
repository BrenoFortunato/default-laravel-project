FROM nginx:1.18-alpine

LABEL maintainer "Felipe Reis - https://github.com/devfelipereis"

ARG UID=1000
ARG GID=1000
ARG APP_ENV=development
ENV APP_ENV=${APP_ENV}

ADD https://packages.whatwedo.ch/php-alpine.rsa.pub /etc/apk/keys/php-alpine.rsa.pub

RUN apk --update-cache add ca-certificates openssl bash git grep \
    dcron tzdata su-exec shadow supervisor && \
    echo "https://packages.whatwedo.ch/php-alpine/v3.11/php-7.4" >> /etc/apk/repositories

RUN wget -O /sbin/wait-for.sh https://raw.githubusercontent.com/eficode/wait-for/v2.1.0/wait-for && chmod +x /sbin/wait-for.sh

RUN apk add --update-cache \
    php \
    php-dev \
    php-pear \
    php-common \
    php-ctype \
    php-curl \
    php-fpm \
    php-gd \
    php-intl \
    php-json \
    php-mbstring \
    php-openssl \
    php-pdo \
    php-pdo_mysql \
    php-mysqlnd \
    php-xml \
    php-zip \
    php-redis \
    php-memcached \
    php-phar \
    php-pcntl \
    php-dom \
    php-iconv \
    php-xmlreader \
    php-zlib \
    php-exif \
    php-posix && \
    ln -s /usr/bin/php7 /usr/bin/php

RUN if [ "$APP_ENV" = "development" ]; then apk --update-cache add autoconf gcc libc-dev make && \
    pecl channel-update pecl.php.net && pecl install xdebug; else echo "Xdebug installation skipped..."; fi

# Sync user and group with the host
RUN if [ "$APP_ENV" = "development" ]; then usermod -u ${UID} nginx && groupmod -g ${GID} nginx; fi

# Configure time
RUN echo "America/Sao_Paulo" > /etc/timezone && \
    cp /usr/share/zoneinfo/America/Sao_Paulo /etc/localtime && \
    apk del --no-cache tzdata && \
    rm -rf /var/cache/apk/* && \
    rm -rf /tmp/*

# CRON SETUP
COPY .docker/cron/crontab /var/spool/cron/crontabs/root
RUN chmod -R 0644 /var/spool/cron/crontabs

# nginx cache folder
RUN mkdir -p /var/cache/nginx && chown -R nginx:nginx /var/cache/nginx && \
    chmod -R g+rw /var/cache/nginx

# config files
COPY .docker /tmp/docker-configs
RUN if [ "$APP_ENV" = "development" ]; then cp /tmp/docker-configs/conf/xdebug.ini /etc/php7/conf.d/xdebug.ini; else echo "xdebug.ini skipped..."; fi && \
    cp /tmp/docker-configs/conf/php-fpm-pool.conf /etc/php7/php-fpm.d/www.conf && \
    mkdir -p /etc/supervisor && cp /tmp/docker-configs/conf/supervisord.conf /etc/supervisor/supervisord.conf && \
    cp /tmp/docker-configs/conf/nginx.conf /etc/nginx/nginx.conf && \
    cp /tmp/docker-configs/conf/nginx-site.conf /etc/nginx/conf.d/default.conf && \
    cp /tmp/docker-configs/conf/php.ini /etc/php7/conf.d/50-settings.ini && \
    cp /tmp/docker-configs/entrypoint.sh /sbin/entrypoint.sh && \
    rm -rf /tmp/docker-configs

WORKDIR /var/www/html/

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

COPY --chown=nginx:nginx ./ .

RUN if [ "$APP_ENV" != "development" ]; then composer install \
    --no-ansi \
    --no-dev \
    --no-interaction \
    --no-scripts && composer dump-autoload --optimize --classmap-authoritative && \
    chown -R nginx:nginx vendor && \
    find ./ -type d -exec chmod 755 {} \; && \
    find ./ -type f -exec chmod 644 {} \; ; fi

EXPOSE 8000

CMD ["/sbin/entrypoint.sh"]

