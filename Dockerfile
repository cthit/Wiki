FROM mediawiki

COPY ./check_if_install.sh /var/www/html/check_if_install.sh
COPY ./LocalSettings.php /var/www/html/LocalSettings.php

#MW-OAuth2Client. Follows installation instructions from here: https://www.mediawiki.org/wiki/Extension:OAuth2_Client

WORKDIR /var/www/html/extensions
RUN ["git", "clone", "https://github.com/Portals/MW-OAuth2Client.git"]

WORKDIR /var/www/html/extensions/MW-OAuth2Client
RUN ["git", "submodule", "update", "--init"]

WORKDIR /var/www/html/extensions/MW-OAuth2Client/vendors/oauth2-client
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
CMD ["sh", "check_if_install.sh"]