# Image runtime : PHP 8.3 + Apache (docroot = racine du repo, front-controller index.php)
FROM php:8.3-apache

# Extension mysqli (utilisée par le modèle) + module de réécriture d'URL
RUN docker-php-ext-install mysqli && a2enmod rewrite

# php.ini de production (output_buffering=4096 : indispensable, certains fichiers PHP émettent
# des sauts de ligne après ?> avant les header() de redirection) + limites d'upload
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && printf 'upload_max_filesize = 25M\npost_max_size = 25M\n' > /usr/local/etc/php/conf.d/uploads.ini

# Configuration Apache :
#  - réécriture vers index.php (équivalent de .htaccess.example, sans dépendre d'un .htaccess)
#  - moteur PHP désactivé dans public/ (dossiers d'upload : aucun script ne doit pouvoir s'y exécuter)
RUN { \
      echo '<Directory /var/www/html>'; \
      echo '    Options -Indexes +FollowSymLinks'; \
      echo '    AllowOverride All'; \
      echo '    Require all granted'; \
      echo '    RewriteEngine On'; \
      echo '    RewriteBase /'; \
      echo '    RewriteCond %{REQUEST_FILENAME} !-f'; \
      echo '    RewriteCond %{REQUEST_FILENAME} !-d'; \
      echo '    RewriteRule ^ index.php [L]'; \
      echo '</Directory>'; \
      echo '<Directory /var/www/html/public>'; \
      echo '    php_admin_flag engine off'; \
      echo '    RemoveHandler .php .phtml .phar'; \
      echo '    <FilesMatch "\.(php|phtml|phar)$">'; \
      echo '        Require all denied'; \
      echo '    </FilesMatch>'; \
      echo '</Directory>'; \
    } > /etc/apache2/conf-available/asrii.conf \
    && a2enconf asrii

WORKDIR /var/www/html
COPY . /var/www/html/

# Dossiers d'upload inscriptibles par Apache
RUN mkdir -p public/supports_de_cours public/emplois_du_temps \
    && chown -R www-data:www-data public/supports_de_cours public/emplois_du_temps

EXPOSE 80
