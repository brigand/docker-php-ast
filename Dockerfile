FROM alpine
MAINTAINER Frankie Bagnardi <f.bagnardi@gmail.com>

RUN mkdir /var/ws
WORKDIR /var/ws

RUN apk update && \
    apk add -t build-deps php-cli php-phar php-openssl ca-certificates && \
    apk add php-common php-iconv php-json php-gd pcre php-ctype && \
    wget -O - http://getcomposer.org/installer | php && \
    php composer.phar require nikic/php-parser && \
    apk del --purge build-deps && rm composer.phar composer.lock composer.json && \
    rm -rf vendor/nikic/php-parser/doc vendor/nikic/php-parser/test

COPY stdin_to_ast_json.php ./
CMD ["php", "stdin_to_ast_json.php"]

