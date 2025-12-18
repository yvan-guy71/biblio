FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Fix Apache MPM configuration (enable only prefork for PHP)
RUN a2dismod mpm_event mpm_worker
RUN a2enmod mpm_prefork

# Copy application code
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80
EXPOSE 80

FROM dunglas/frankenphp

RUN docker-php-ext-install mysqli

