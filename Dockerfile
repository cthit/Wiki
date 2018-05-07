FROM mediawiki

VOLUME ./images /var/www/html/images
VOLUME ./extensions /var/www/html/extensions

#COPY ./LocalSettings.php /var/www/html/LocalSettings.php
