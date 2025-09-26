# Use PHP + Apache official image
FROM php:8.2-apache

# Enable MySQL extension in PHP
RUN docker-php-ext-install mysqli

# Copy all your project files into the server folder
COPY . /var/www/html/

# Apache will listen on port 80
EXPOSE 80
