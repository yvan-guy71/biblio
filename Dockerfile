FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Force remove conflicting MPM modules and enable prefork
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load && \
    a2enmod mpm_prefork

# Copy application code
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80
EXPOSE 80
