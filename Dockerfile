FROM php:8.1-apache

# PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

COPY . .

# docker run -d -p 3306:3306 --name database -e MYSQL_ROOT_PASSWORD=root mysql:8.0.29-oracle
