FROM alpine:latest

WORKDIR /var/www

#
# Dependencies
#
RUN apk --no-cache add \
    libzip-dev zip wget gnupg curl mysql-client \
    php7 php7-cgi php7-curl php7-opcache php7-zip \
    php7-bcmath php7-pcntl php7-redis php7-json \
    php7-phar php7-mbstring php7-openssl php7-xml \
    php7-tokenizer php7-dom php7-xmlwriter php7-posix \
    php7-sockets php7-pdo_mysql php7-ctype php7-iconv php7-pdo_sqlite

#
# Composer
#
RUN  curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/bin/composer

#
# Apisearch installation
#
COPY . /var/www
RUN cd /var/www && \
    composer install -n --prefer-dist --no-suggest && \
    composer dump-autoload -n --optimize

COPY docker/* /
COPY scripts/* /

EXPOSE 8000
CMD ["sh", "/server-entrypoint.sh"]