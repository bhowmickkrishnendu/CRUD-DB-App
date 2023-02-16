# Stage 1: Build the application
FROM php:7.4-apache AS app-build

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy the application files
WORKDIR /app
COPY . .

# Stage 2: Build the database
FROM mysql:8.0 AS db-build

# Set the database root password
ARG MYSQL_ROOT_PASSWORD
ENV MYSQL_ROOT_PASSWORD=$MYSQL_ROOT_PASSWORD

# Create the database and user
ARG MYSQL_DATABASE
ARG MYSQL_USER
ARG MYSQL_PASSWORD
ENV MYSQL_DATABASE=$MYSQL_DATABASE
ENV MYSQL_USER=$MYSQL_USER
ENV MYSQL_PASSWORD=$MYSQL_PASSWORD
COPY schema.sql /docker-entrypoint-initdb.d/

# Stage 3: Build the final image
FROM php:7.4-apache

# Enable Apache modules
RUN a2enmod rewrite

# Copy the application files
WORKDIR /var/www/html
COPY --from=app-build /app .
COPY edit.php .
COPY styleedit.css .
COPY style.css .

# Copy the database files
COPY --from=db-build /usr/local/mysql /usr/local/

# Set the database configuration
COPY db.php .
RUN sed -i "s/MYSQL_DATABASE/${MYSQL_DATABASE}/g" db.php && \
    sed -i "s/MYSQL_USER/${MYSQL_USER}/g" db.php && \
    sed -i "s/MYSQL_PASSWORD/${MYSQL_PASSWORD}/g" db.php && \
    sed -i "s/MYSQL_ROOT_HOST/${MYSQL_ROOT_HOST}/g" db.php

# Set the footer
COPY footer.php .
RUN sed -i "s/COPYRIGHT_YEAR/$(date +%Y)/g" footer.php

# Set the permissions
RUN chown -R www-data:www-data .

# Expose the port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
