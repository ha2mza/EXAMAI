#!/bin/bash
set -e

# Function to start MySQL and wait for it to be ready
start_mysql() {
    service mysql start || true  # Start MySQL service, ignore failures
}

# Check if the database is already initialized
if [ ! -d "/var/lib/mysql/TP3" ]; then
    echo "Initializing database..."
    start_mysql
    mysql -u root < /docker-entrypoint-initdb.d/init.sql
else
    echo "Database already initialized."
    # Start MySQL and PHP-FPM
    start_mysql
fi

exec php -S localhost:8080
