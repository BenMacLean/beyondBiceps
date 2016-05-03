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
define('DB_NAME', 'beyondbi_wp577');

/** MySQL database username */
define('DB_USER', 'beyondbi_wp577');

/** MySQL database password */
define('DB_PASSWORD', '9PmS7(7n]Z');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'dnjqvbn0rpmeywu1noqrj7izrds9dckz5l38w8txjwfm73dobss4ebtny72oazll');
define('SECURE_AUTH_KEY',  'dlqrjt82pkdubgoscbavdxhow10aq8fkgx5839wlrfc7oq4yznajgiraiioja6om');
define('LOGGED_IN_KEY',    'mxibm4rjhmkwjkknbkjzp6yntycwn6yvhvueeuo9fxfegccw9dhspqm5n0uxoscw');
define('NONCE_KEY',        'a4ryxs1jodkllohav99bi0ylhhg34zcwrqespn923i8omtirkaipfnwcqz2ab376');
define('AUTH_SALT',        'erg2faperon6r2xjuozed6yqonjtqzglndlocr4367mur3wmshsxdf4ieihk69iq');
define('SECURE_AUTH_SALT', '32etziafy4tjdk9prlyn1iiianfjf0szqo4lbeb2le9whdzuxdla9mkohvxzqelm');
define('LOGGED_IN_SALT',   'wkh9mzstdt3yqndtdh9qitknbjxcnwtf7ytljzshw8xwyc7wpcchg0hto14gr6gf');
define('NONCE_SALT',       'soyrvqfilplcmm0ehpmbgpmr2oyobo1dvawvjafdq00mfsuid62zpb4wtvpbhscw');

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
define( 'WP_MEMORY_LIMIT', '128M' );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

# Disables all core updates. Added by SiteGround Autoupdate:
define( 'WP_AUTO_UPDATE_CORE', false );
