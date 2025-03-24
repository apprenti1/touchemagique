# Utiliser l'image PHP 8.4 avec Apache
FROM php:8.4-apache

# Installer les extensions nécessaires (ajoute celles dont tu as besoin)
RUN docker-php-ext-install pdo pdo_mysql

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier tous les fichiers du projet dans le conteneur
COPY ./ /var/www/html

# Donner les bons droits aux fichiers pour Apache
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 777 /var/www/html

# Exposer le port 80 (Apache)
EXPOSE 80

# Lancer Apache au démarrage du conteneur
CMD ["apache2-foreground"]
