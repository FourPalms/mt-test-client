# Use the official PHP image with Apache
FROM php:8.1-cli

# Set the working directory
WORKDIR /app

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set environment variable to allow Composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy the application files
COPY . .

# Install PHP dependencies
RUN composer update
RUN composer install

# Set the entrypoint to the PHP script
ENTRYPOINT ["php", "run.php"]
