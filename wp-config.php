<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */
 
// Include local configuration
if (file_exists(dirname(__FILE__) . '/local-config.php')) {
	include(dirname(__FILE__) . '/local-config.php');
}

// Global DB config
if (!defined('DB_NAME')) {
	define('DB_NAME', 'poxy');
}
if (!defined('DB_USER')) {
	define('DB_USER', 'root');
}
if (!defined('DB_PASSWORD')) {
	define('DB_PASSWORD', 'root');
}
if (!defined('DB_HOST')) {
	define('DB_HOST', 'localhost');
}

/** Database Charset to use in creating database tables. */
if (!defined('DB_CHARSET')) {
	define('DB_CHARSET', 'utf8');
}

/** The Database Collate type. Don't change this if in doubt. */
if (!defined('DB_COLLATE')) {
	define('DB_COLLATE', '');
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Z({c%`;5Hq .aE(sFnJr*D.t!>cy!@QV%_<1#|lE(k|Q+*/s!s+WRbkdq`%EMI%J');
define('SECURE_AUTH_KEY',  'Ts:PQF{:p-N0$*kPGF3]7DG<|43U>]M<>*Oi$(LhlG(0KJk! N+x<b/U.WT5S;&@');
define('LOGGED_IN_KEY',    '5U.;>Yq|>Z}}e2!Q9j2LPbn+)l&2bd2|3|=jx&y7=Xv`n=M{**13tfvu,}:6%F0X');
define('NONCE_KEY',        'lSy.t6(OD{$d`m&^5JT2S[In9^Z exwU&+5Nvk^GESu}?1Fv+Z_R326 c05`rT2E');
define('AUTH_SALT',        'Vo8,v;86r1Lx*G =-p/-IF5Q`D540xm_Zb{&pL)wv#P-}U><=qnq+A_[;pH8d}}p');
define('SECURE_AUTH_SALT', '4T!ca^djVA?WdOr-CW$7>q+o`mOm%6?g+|mR|YuQ8Pl6&A[-a=-M-aI>N6q5[qj:');
define('LOGGED_IN_SALT',   ']QvlCfI=iBq.R}#Y2EBK2umbfgO[dNvQn9!:jEn-+;O{v(`?< A%|+ze?McwI##Z');
define('NONCE_SALT',       '7W4bH4`H)&W:kn$?[|w:A+`b3QOh&4)-X{]&F|xaXbNj-I_4[N63D/rEbS$w->x$');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');


/**
 * Set custom paths
 *
 * These are required because wordpress is installed in a subdirectory.
 */
if (!defined('WP_SITEURL')) {
	define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/cms');
}
if (!defined('WP_HOME')) {
	define('WP_HOME',    'http://' . $_SERVER['SERVER_NAME'] . '');
}
if (!defined('WP_CONTENT_DIR')) {
	define('WP_CONTENT_DIR', dirname(__FILE__) . '/content');
}
if (!defined('WP_CONTENT_URL')) {
	define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/content');
}


/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
if (!defined('WP_DEBUG')) {
	define('WP_DEBUG', false);
}

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
