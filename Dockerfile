FROM php:7.4-apache

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql

# Enable Apache modules
RUN a2enmod rewrite

# Copy the application files
WORKDIR /var/www/html
COPY . .
COPY edit.php .
COPY styleedit.css .
COPY style.css .

# Copy the database configuration
COPY db.php .

# Set the permissions
RUN chown -R www-data:www-data .

# Expose the port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
