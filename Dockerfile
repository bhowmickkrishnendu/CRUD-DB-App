FROM php:7.4-apache

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

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

# DB Table Create
#COPY schema.sql /docker-entrypoint-initdb.d/

# Set the permissions
RUN chown -R www-data:www-data .

# Expose the port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
