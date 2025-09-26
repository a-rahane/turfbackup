# Use PHP + Apache official image
FROM php:8.2-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Copy all your project files into the server folder
COPY . /var/www/html/

# Apache will listen on port 80
EXPOSE 80
