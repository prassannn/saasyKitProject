#!/bin/bash

# PHP 8.2 Setup Script for Ubuntu 20.04
# Run this script on your server if the automatic provisioning fails

set -e

echo "Setting up PHP 8.2 on Ubuntu 20.04..."

# Update package lists
export DEBIAN_FRONTEND=noninteractive
apt-get update

# Install required packages
apt-get install -y software-properties-common

# Add Ondřej Surý PPA for PHP
add-apt-repository ppa:ondrej/php -y

# Update package lists again
apt-get update

# Install PHP 8.2 and required extensions
apt-get install -y \
    php8.2-bcmath \
    php8.2-cli \
    php8.2-curl \
    php8.2-dev \
    php8.2-fpm \
    php8.2-gd \
    php8.2-imap \
    php8.2-intl \
    php8.2-mbstring \
    php8.2-mysql \
    php8.2-pgsql \
    php8.2-readline \
    php8.2-soap \
    php8.2-sqlite3 \
    php8.2-xml \
    php8.2-zip \
    php8.2-opcache

# Configure PHP-FPM
systemctl enable php8.2-fpm
systemctl start php8.2-fpm

# Set PHP 8.2 as default
update-alternatives --set php /usr/bin/php8.2

echo "PHP 8.2 setup completed successfully!"
echo "PHP version: $(php -v | head -n 1)"
