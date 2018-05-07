FROM mediawiki

VOLUME ./images /var/www/html/images

COPY ./extensions /var/www/html/extensions
COPY ./LocalSettings.php /var/www/html/LocalSettings.php
