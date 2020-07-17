<?php

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

if($_ENV["FIRST_TIME"] === "true"){
    #shell_exec("php maintenance/update.php");
}

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = $_ENV['WIKI_NAME'];
$wgMetaNamespace = $_ENV['WIKI_NAME'];

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "";

## The protocol and server name to use in fully-qualified URLs
$wgServer = $_ENV['ROOT_URL'];

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

## The URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo = "$wgResourceBasePath/resources/assets/wiki.png";

## UPO means: this is also a user preference option

$wgEnableEmail = true;
$wgEnableUserEmail = true; # UPO

$wgEmergencyContact = "apache@localhost";
$wgPasswordSender = "apache@localhost";

$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO
$wgEmailAuthentication = true;

## Database settings
$wgDBtype = "mysql";
$wgDBserver = $_ENV['DB_SERVER'];
$wgDBname = $_ENV['DB_NAME'];
$wgDBuser = $_ENV['DB_USER'];
$wgDBpassword = $_ENV['DB_PASSWORD'];

# MySQL specific settings
$wgDBprefix = "";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=utf8";

# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = false;

## Shared memory settings
$wgMainCacheType = CACHE_ACCEL;
$wgMemCachedServers = [];

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = false;

# Periodically send a pingback to https://www.mediawiki.org/ with basic data
# about this MediaWiki instance. The Wikimedia Foundation shares this data
# with MediaWiki developers to help guide future development efforts.
$wgPingback = false;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "C.UTF-8";

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/data/Names.php
$wgLanguageCode = "en";

$wgSecretKey = $_ENV['SECRET_KEY'];

# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "02c4944a23969342";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "";
$wgRightsText = "";
$wgRightsIcon = "";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

# The following permissions were set based on your choice in the installer
$wgGroupPermissions['*']['createaccount'] = false;
$wgGroupPermissions['*']['edit'] = false;
$wgGroupPermissions['*']['read'] = false;
$wgGroupPermissions['*']['autocreateaccount'] = true;

#Whitelist OAuth2 client
$wgWhitelistRead = array( 'Special:OAuth2Client' );

#Removes the primary auth, so that the only way to login is through oauth2
$wgAuthManagerAutoConfig['primaryauth'] = [ ];

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
$wgDefaultSkin = "vector";

# Enabled skins.
# The following skins were automatically enabled:
wfLoadSkin( 'CologneBlue' );
wfLoadSkin( 'Modern' );
wfLoadSkin( 'MonoBook' );
wfLoadSkin( 'Vector' );

wfLoadExtension( 'MW-OAuth2Client' );
#wfLoadExtension( 'SyntaxHighlight_GeSHi' );
#wfLoadExtension( 'Poem' );
#wfLoadExtension( 'ImageMap' );

#oauth2
$wgOAuth2Client['client']['id']     = $_ENV['CLIENT_ID']; // The client ID assigned to you by the provider
$wgOAuth2Client['client']['secret'] = $_ENV['CLIENT_SECRET']; // The client secret assigned to you by the provider

$wgOAuth2Client['configuration']['authorize_endpoint']     = 'https://beta-account.chalmers.it/oauth/authorize'; // Authorization URL
$wgOAuth2Client['configuration']['access_token_endpoint']  = 'https://beta-account.chalmers.it/oauth/token'; // Token URL
$wgOAuth2Client['configuration']['api_endpoint']           = 'https://beta-account.chalmers.it/me.json'; // URL to fetch user JSON
$wgOAuth2Client['configuration']['redirect_uri']           = $_ENV['ROOT_URL'] . '/index.php/Special:OAuth2Client/callback'; // URL for OAuth2 server to redirect to

$wgOAuth2Client['configuration']['username'] = 'uid'; // JSON path to username
$wgOAuth2Client['configuration']['email'] = 'mail'; // JSON path to email
$wgOAuth2Client['configuration']['groups'] = 'groups'; // JSON path to groups
$wgOAuth2Client['configuration']['nick'] = 'nickname'; // JSON path to nick

$wgOAuth2Client['configuration']['allowed_groups'] = [$_ENV['ALLOWED_GROUP']];

$wgOAuth2Client['configuration']['scopes'] = ''; //Permissions

$wgOAuth2Client['configuration']['service_login_link_text'] = 'Sign in with your IT-account'; // the text of the login link
$wgOAuth2Client['configuration']['query_parameter_token'] = 'auth_token'; // query parameter to use
$wgOAuth2Client['configuration']['http_bearer_token'] = 'Bearer'; // Token to use in HTTP Authentication

$wgFileExtensions = array(
       'png', 'jpg', 'tiff', 'bmp', 'jpeg', 'gif', 'pdf', 'ppt', 'tar.gz', 'tar', 'doc','docx', 'xls', 'xlsx'
);

$wgShowExceptionDetails = true;
$wgShowDBErrorBacktrace = true;
$wgShowSQLErrors = true;
