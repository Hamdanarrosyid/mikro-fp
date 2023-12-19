# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Copy all files from the local directory into the container
COPY . /var/www/html/

# Enable Apache Rewrite module for clean URLs
RUN a2enmod rewrite

# Install and enable mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Restart Apache to apply changes
RUN service apache2 restart

# Expose port 80 to the outside world
EXPOSE 80
