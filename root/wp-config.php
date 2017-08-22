<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'vlearn');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'usbw');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'qY.B](gVt<zWj]ZzM?~LVD&6i38i,/kZ3)}e)h;/7>Y9Y}rvlNn:Fpiz&&(ST4Bf');
define('SECURE_AUTH_KEY',  '<i~Vn9eJFC!gPc)+< _fcR8&!}T;b#f*,SG+pdAlw.7|?b{5D!GH?o3Hx}P9^2U4');
define('LOGGED_IN_KEY',    'W3;Ae:S3,b_1ONpf:2xzITzA7bDV&hC$eVtS0ZkG1y+j~Cq.sE]`|c*$@{[;L !R');
define('NONCE_KEY',        '5;rmRCb |teU?;dA9uJ=i;@/Lfaqd3p~L#0zwvv&Z/]L)Z-UT}KyxX]?(Y!Ch=kV');
define('AUTH_SALT',        'f^(:$ ew>EOAaq6zCod5)3k#$]XWjL7Dy<+X|cUNb8%XH:th|V4{HbC&vXWir/5Z');
define('SECURE_AUTH_SALT', '(-S<*)7:yNZoENAnR5,djWv@<~U<n71hp~$-.Of%y.nZyOll30)F2-%sZ]kQD:}U');
define('LOGGED_IN_SALT',   'jK-g+mSHhIY].n~LCTR:Oh*/H,V#bKK%{mJZ32;u/g# At2B9Ice~o*o@np-s F2');
define('NONCE_SALT',       'pp|w/MP9TvC:j]83hIQ**kOsA$K=rf,:3-{7df*do?7vGSqV@gw<&}tvR1Dy >zz');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
