# php-fpm 
FROM php:fpm-alpine

EXPOSE 9000
RUN apk add bash
RUN apk add vim
RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/public/

ENTRYPOINT ["php", "var/www/vendor/robmorgan/phinx/bin/phinx", "migrate"]
ENTRYPOINT ["php", "var/www/vendor/robmorgan/phinx/bin/phinx", "seed_run"]

CMD ["php-fpm"]


