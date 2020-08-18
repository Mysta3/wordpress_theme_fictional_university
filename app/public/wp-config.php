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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '3IdW9hsZOdcqndVICPjxa5ENXO2FWR6pIJxVyNeNJ7tmM8pOq00PRPhnCaczgv/D3LFICY1VZCH/oCfgG1tBgg==');
define('SECURE_AUTH_KEY',  'yZeGT+nxE1P3ipYgLC5aFuoe2iuYsM4i5QlsbRAbZceR/aP/4kHpsugfIrrE28zoxotlOBunvoRTdkmM2cZlVg==');
define('LOGGED_IN_KEY',    'MysmUi7GJ9WIF0QOLATv3N22MHN1hpatXZ5x5OPbAYvcbvqtjErFPSdevSq6UGcX8dPJ2WmcVoqBG76wWfkDuQ==');
define('NONCE_KEY',        'M22K191e+cmBNoD4aXJ5yYMeJ5YUpIZA0Vlqa1uuUUjTJPYLblcfHBl3gt91vyAg7Yo0PWB/5ZtaH8MptrMhkQ==');
define('AUTH_SALT',        'du0EkwXbVsvOzgA+pJyJydk0Vn/m9P5kRvG6Ey2wxMCN1I5lBh5vzyEyFiGqpLAowRGJajR4fYPrCYWjtDMCsA==');
define('SECURE_AUTH_SALT', 'ce1PzZtNHWXj3HzGXNorEegMsDyGu2sP7WzYC3B9MPzkE9AJtg8+VMP+Kc0BusoU4NEqzVvE+w1d28Px2pKDnw==');
define('LOGGED_IN_SALT',   'zLT4Lyxy0yfPUyBSCKIkkSrsZXPu6XfUQlytz8nbb12s9iZgwMkpbLKEK5JJLLyjbm7nQAJ/VFfiRLwJ+YbCEg==');
define('NONCE_SALT',       '1kIY/QOwydUW92BXvaqH5RhKXcntODC4LrBBsvMDBNMNSrbfgZg2gNB+Q5IUDzDe4macq36WIBTHDKOTMiCohA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
