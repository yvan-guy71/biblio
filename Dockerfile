# Utiliser une image officielle Apache + PHP
FROM php:8.2-apache

# Activer uniquement le MPM prefork (compatible avec mod_php)
RUN a2dismod mpm_event mpm_worker \
    && a2enmod mpm_prefork

# Activer les modules Apache utiles
RUN a2enmod rewrite \
    && a2enmod headers

# Installer extensions PHP nécessaires (exemple : mysqli, pdo_mysql)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copier ton code dans le conteneur
COPY . /var/www/html/

# Définir les permissions pour Apache
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/

# Exposer le port 80
EXPOSE 80

# Lancer Apache en mode foreground
CMD ["apache2-foreground"]
