FROM php:7.0-cli
ENV MY_VERSION 1.0
COPY . /var/www/html
WORKDIR /var/www/html
VOLUME /var/www/html
EXPOSE 2020
CMD ["php", "./server.php"]