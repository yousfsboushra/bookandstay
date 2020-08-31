FROM php:7.4-apache

RUN apt-get update && apt-get upgrade -y && apt-get install -y git

COPY  ./src /var/www/html
COPY  ./input /var/www/html/input

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
RUN composer install