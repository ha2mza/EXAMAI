# Use the official PHP 7.4 FPM image based on Debian Buster
FROM php:7.4-buster

# Update and install required dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    default-mysql-server \
    libmcrypt-dev default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && pecl install xdebug-2.9.8 \
    && docker-php-ext-enable xdebug \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Copy MySQL configuration file
COPY mysql-init/my.cnf /etc/mysql/my.cnf
# Copy MySQL configuration file
COPY . /app

# Copy the SQL script into the container
COPY mysql-init/script.sql /docker-entrypoint-initdb.d/init.sql


# Copy the custom entrypoint script
COPY entrypoint.sh /usr/local/bin/

# Make the entrypoint script executable
RUN chmod +x /usr/local/bin/entrypoint.sh

# Ensure MySQL has proper permissions
RUN chown -R mysql:mysql /var/lib/mysql  /docker-entrypoint-initdb.d/init.sql


# Expose MySQL port
EXPOSE 3306

# Expose PHP-FPM port
EXPOSE 9000

# Set the working directory
WORKDIR /app

# Use the custom entrypoint script
ENTRYPOINT ["entrypoint.sh"]
