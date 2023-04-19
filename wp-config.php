<?php
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
define( 'DB_NAME', 'limme' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'G(ngv]v[6E3<rA(I$@:@/K,MMs1.uQm16IO(i&72wZ{H!&iZ-c|U~;b)EF-,|mjc' );
define( 'SECURE_AUTH_KEY',  't|G$!9ZY_e)Mv0}lRf?B~|y[-+C/SJLN1nUYHoj=~vycf67AM/aQt>u#a)# jhjD' );
define( 'LOGGED_IN_KEY',    'GxY oIo-y8rTn[OVDVl^PhK_JRYVzQmv-.P.1E4wenRu|ZjmYZd{^Al8NuZ8tD3A' );
define( 'NONCE_KEY',        '`eZYl@K-wu-jLUDlrv(L@3-uG%c8%=k`O:?}qMEWAwzP$xI!(7umo~r>.;L:TK</' );
define( 'AUTH_SALT',        'GE99X}OP7gn6I@D9n6yp]@QmP{s^|~DoVL!YU,<EhGt)Gub7Y{D3OJUMka }x4B(' );
define( 'SECURE_AUTH_SALT', '(G(X(01/Mpl)P.2]8/L2.b<.6ZrUP0C,W8-0|s]JJSIRLu8tkR^hy.1Ypd5raI}z' );
define( 'LOGGED_IN_SALT',   '2!,uF@W+RAa%n_|fACfU=SFz~w+5duyM+Xi_tE<nNo;Y^/&>3DjHz57fB=L]Xqez' );
define( 'NONCE_SALT',       'LwGwVqWsEh9=A9{B8Bx;>rrjO%Y7oCmj{}sQ &%hOoeP} v3FzU=d_h^7Z`TKy``' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
