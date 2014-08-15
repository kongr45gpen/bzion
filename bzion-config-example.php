<?php

/*
 * MySQL settings
 */
DEFINE("MYSQL_HOST", "localhost"); // Database host
DEFINE("MYSQL_DB_NAME", "bzion"); // Database name
DEFINE("MYSQL_USER", "bzion_admin"); // Database username
DEFINE("MYSQL_PASSWORD", "password"); // Database password
DEFINE("MYSQL_DEBUG", TRUE);  // Whether or not to log MySQL errors on a file

/*
 * Site settings
 */
DEFINE("SITE_TITLE", "BZiON: A League Management System");

/*
 * League specific settings
 */
DEFINE("DURATION", serialize(array(
    "30" => 1,
    "20" => (2/3) // 20 minute match is 2/3rds of a normal match's ELO
)));

/*
 * File, directory and URL settings
 */
DEFINE("DOC_ROOT", dirname(__FILE__)); // The BZiON document root
DEFINE("ERROR_LOG", DOC_ROOT . "/bzion_errors.log"); // The location where errors will be written

/*
 * Notification service settings
 */
DEFINE("ENABLE_PUSHER", false); // true to enable the pusher service for real-time notifications
DEFINE("PUSHER_APP_ID", "0");
DEFINE("PUSHER_KEY", "123456789");
DEFINE("PUSHER_SECRET", "123456789");

DEFINE("ENABLE_WEBSOCKET", false); // true to enable PHP's socket for real-time notifications
DEFINE("WEBSOCKET_PULL_PORT", 8591); // If these ports are reserved in your machine, set them
DEFINE("WEBSOCKET_PUSH_PORT", 8592); // to a free value

/*
 * API settings
 */
DEFINE("ALLOWED_IPS", "127.0.0.1, 127.0.0.2"); // A comma separated list of IP addresses which are
                                               // allowed to report matches

/*
 * Miscellaneous settings
 */
DEFINE("LIST_SERVER", "http://my.bzflag.org/db/?action=LIST&version=BZFS0221"); // BZFlag List Server
DEFINE("UPDATE_INTERVAL", 5); // Server polling interval in minutes
DEFINE("DEVELOPMENT", FALSE); // Whether to enable some functions which make debugging easier
                              // WARNING: Setting this to TRUE might introduce significant security risks
                              // and should NOT be used in a production environment
