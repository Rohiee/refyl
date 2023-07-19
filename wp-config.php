<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'shinotec_wp323' );

/** Database username */
define( 'DB_USER', 'shinotec_wp323' );

/** Database password */
define( 'DB_PASSWORD', 'U-p3j(17FS' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'ttcunjcaawzsj4mksrxodoibvptn5evfz5iaii1vwe1naiizhgz5etsdf6kwjsxo' );
define( 'SECURE_AUTH_KEY',  'ymhszhtyfggat5319d9p1qdmyaew13frp6cpyzniazywpyzngjzrffanagkiuclq' );
define( 'LOGGED_IN_KEY',    '7h4tbjwtig7odgv7zofubznzx10svh6ceevzqj5ogkr0t5ofa9yikf62j6zfeqfe' );
define( 'NONCE_KEY',        '6p4w48cjbr79kkvaunsa9baqka4gcbr4srfxwhcvuvjljt6ijlz8bu1aswwnyxcg' );
define( 'AUTH_SALT',        'wkdcyphssyrsnyxba59d25iqfaw3ntvuqejtdrd1gyxw4w8nsurakufqijvx9s2e' );
define( 'SECURE_AUTH_SALT', 'qfju1dw1gphuz2i2gk2cy1odobqc6gbspedhlsi2mynnmbtr2coghm6rn6xiiaqc' );
define( 'LOGGED_IN_SALT',   'ljjsikdkmaactddrvfbmcig4kvxjhdvytktmrkezx5cpca6uaaljn3b4g2oiiddg' );
define( 'NONCE_SALT',       '5be7zpbzqya7dfx2ijbkb2u5aifxokark8h5iwxkrtjj9rtmcwrvghc2hstd6eb0' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpjr_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
