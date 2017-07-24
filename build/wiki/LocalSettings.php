<?php
# This file was automatically generated by the MediaWiki 1.28.0
# installer. If you make manual changes, please keep track in case you
# need to recreate them later.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

function getenvOrFail($name) {
  $wgDBpassword = getenv($name);
  if(!$wgDBpassword) {
    throw new \Exception("Missing env var ".$name);
  }
  return $wgDBpassword;
}

$callingurl = NULL;
if(array_key_exists('REQUEST_URI', $_SERVER)) {
  $callingurl = strtolower( $_SERVER['REQUEST_URI'] ); // get the calling url
} else {
  // for maintenance commands, e.g. maintenance/importDump.php, assuming database prefix is "wiki_"
  // extract the wiki name and simulate a "calling url"
  $callingurl = implode(' ',$argv);
  $callingurl = preg_replace("/.*(--wiki)\s+wiki_(\w*).*/","$2",$callingurl);
  $callingurl = "/".$callingurl."/";
  # var_dump('calling url', $callingurl, strpos( $callingurl, '/ffa_pb_pmo/' ));
}

if ( strpos( $callingurl, '/ffa_re_pnp/' )  === 0 ) {
        require_once 'LocalSettings_ffa_re_pnp.php';
} elseif ( strpos( $callingurl, '/ffa_pb_pnp/' ) === 0 ) {
        require_once 'LocalSettings_ffa_pb_pnp.php';
} elseif ( strpos( $callingurl, '/ffa_pb_kyc/' ) === 0 ) {
        require_once 'LocalSettings_ffa_pb_kyc.php';
} elseif ( strpos( $callingurl, '/ffa_pb_pmo/' ) === 0 ) {
        require_once 'LocalSettings_ffa_pb_pmo.php';
#} else {
# Do not do this, otherwise the mediawiki skins will fail to be loaded
#        header( 'HTTP/1.1 404 Not Found' );
#        echo "This wiki (\"" . htmlspecialchars( $callingurl ) . "\") is not available. Check configuration.";
#        exit( 0 );
}


# Set the upload directory
# https://www.mediawiki.org/wiki/Manual:$wgUploadDirectory
$wgUploadDirectory="{$IP}/images".$wgScriptPath;
$wgUploadPath="{$wgScriptPath}/images".$wgScriptPath;

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

## The protocol and server name to use in fully-qualified URLs
# $wgServer = "http://pmo.ffaprivatebank.com:8123";
$wgServer = sprintf("http://%s:%s", getenvOrFail("NGINX_HOST"), getenvOrFail("NGINX_PORT"));
# https://lists.gt.net/wiki/mediawiki/405733
#$wgServer = "http://$_SERVER[REMOTE_ADDR]"; 
#$wgServer = "http://$_SERVER[HTTP_HOST]"; 


## UPO means: this is also a user preference option

$wgEnableEmail = true;
$wgEnableUserEmail = false; # UPO

$wgEmergencyContact = "s.akiki@ffaprivatebank.com";
$wgPasswordSender = "s.akiki@ffaprivatebank.com";

$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO
$wgEmailAuthentication = true;


## Database settings
$wgDBtype = "mysql";
$wgDBserver = "db";
$wgDBuser = "root";
$wgDBpassword = getenvOrFail("MYSQL_ROOT_PASSWORD");

# MySQL specific settings
$wgDBprefix = "";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = false;

## Shared memory settings
$wgMainCacheType = CACHE_ACCEL;
$wgMemCachedServers = [];

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
#$wgUseImageMagick = true;
#$wgImageMagickConvertCommand = "/usr/bin/convert";

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

# https://www.mediawiki.org/wiki/Manual:$wgSecretKey
$wgSecretKey = getenvOrFail("MW_SECRET");

# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "62faad8016b732dc";

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

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
$wgDefaultSkin = "vector";

# Enabled skins.
# The following skins were automatically enabled:
wfLoadSkin( 'CologneBlue' );
wfLoadSkin( 'Modern' );
wfLoadSkin( 'MonoBook' );
wfLoadSkin( 'Vector' );


# Enabled extensions. Most of the extensions are enabled by adding
# wfLoadExtensions('ExtensionName');
# to LocalSettings.php. Check specific extension documentation for more details.
# The following extensions were automatically enabled:
wfLoadExtension( 'WikiEditor' );
# https://www.mediawiki.org/wiki/Extension:WikiEditor
$wgDefaultUserOptions['usebetatoolbar'] = 1;
$wgDefaultUserOptions['usebetatoolbar-cgd'] = 1;
$wgDefaultUserOptions['wikieditor-preview'] = 1;
$wgDefaultUserOptions['wikieditor-publish'] = 1;

# End of automatically generated settings.
# Add more configuration options below.
require_once "$IP/extensions/SwiftMailer/SwiftMailer.php";
$wgShowExceptionDetails = true; 
$wgSMTP = array(
 'host'     => getenvOrFail("SMTP_HOST"), // could also be an IP address. Where the SMTP server is located
 'IDHost'   => "ffaprivatebank.com",      // Generally this will be the domain name of your website (aka mywiki.org)
 'port'     => getenvOrFail("SMTP_PORT"),                 // Port to use when connecting to the SMTP server
 'auth'     => true,               // Should we use SMTP authentication (true or false)
 'username' => getenvOrFail("SMTP_USERNAME"),     // Username to use for SMTP authentication (if being used)
 'password' => getenvOrFail("SMTP_PASSWORD")       // Password to use for SMTP authentication (if being used)
);

$wgShowDBErrorBacktrace = true;
