# Utiliser l'image PHP 8.4 avec Apache
FROM php:8.4-apache

# Installer les extensions nécessaires (ajoute celles dont tu as besoin)
RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get update && apt-get install -y libzip-dev unzip && docker-php-ext-install zip
RUN apt-get update && apt-get install -y git
RUN git config --global --add safe.directory /var/www/html

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier tous les fichiers du projet dans le conteneur
COPY ./ /var/www/html

# Install project dependencies
RUN composer install --no-interaction --no-plugins --no-scripts

# Donner les bons droits aux fichiers pour Apache
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80 (Apache)
EXPOSE 80

# Lancer Apache au démarrage du conteneur
CMD ["apache2-foreground"]
