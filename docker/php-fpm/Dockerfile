# php-fpm 
FROM php:fpm-alpine

EXPOSE 9000
CMD ["php-fpm"]

RUN apk add bash
RUN apk add vim
RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/

ENTRYPOINT php-fpm && php /var/www/vendor/robmorgan/phinx/bin/phinx migrate && php /var/www/vendor/robmorgan/phinx/bin/phinx seed:run
#ENTRYPOINT ["php", "-c", "/var/www/vendor/robmorgan/phinx/bin/phinx", "migrate"]
#ENTRYPOINT ["php", "-c", "/var/www/vendor/robmorgan/phinx/bin/phinx", "seed:run"]



