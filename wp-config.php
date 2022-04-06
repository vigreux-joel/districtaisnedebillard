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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'distrifwp' );

/** MySQL database username */
define( 'DB_USER', 'distrifwp' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ZKKYTPx4UnTv' );

/** MySQL hostname */
define( 'DB_HOST', 'distrifwp.mysql.db' );

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
define( 'AUTH_KEY',         '&s/(j(ZA;@vV=`#s6z8)HOk:a(Cg-O=(j!K?kUL#4of*GYri=5,PW?s,nMcMF3YH' );
define( 'SECURE_AUTH_KEY',  's*/AlLMW0?MMm3n?SUP!kan9n</}`hJ7/UA{/RR[g&?j{%!Ma/+c<8/ D`]w3dv8' );
define( 'LOGGED_IN_KEY',    '5hxZP*v3L 4@hk[vA=4(AYJk-%}0OqGLqi=$X0rgkmjQzg1p*A_HDv~FPE0t&d!N' );
define( 'NONCE_KEY',        '>B4.F*{XBh-V#6|fI-cs)bw{|Z5K/rX0G6O`6?pKr(,gMQW$<m{G^f_-+7qD<lK,' );
define( 'AUTH_SALT',        '=VaeAtlLH6kJ5DOrw-oS:MB9k72:6XK2S*qve>{;gD$)A[%4s,FVMN8i9C*Fs6>n' );
define( 'SECURE_AUTH_SALT', ']y8+msS]IoL&AJSy1`Wm}YJQ5s5:EQk&_#B%Dl^~|w~g][&crja(F?.H{!k9U0w|' );
define( 'LOGGED_IN_SALT',   'S%qwiNO<I/#1VM9!:n0Vu3Yc2By-4l$Fds+WX!9dHyD=4IRoO{b8G;DrkXS`,3}^' );
define( 'NONCE_SALT',       '*;t;duq<IvPq}`=GT>Pfj|eM_~;lvc7ahf+szUQza:#4590r`hmH#F[95?5+RSa@' );

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
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
