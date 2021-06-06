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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_faq' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'P}sGdb}-7wTA@3T;$pZM-_ xn$X*>EsJ@2(!s:,O8+1Ufe.4=zx=~7c,@uJ.gk+|' );
define( 'SECURE_AUTH_KEY',  'yGPK.@Z8D^v?P.pm.%,I(xty)3~8N&+lH#PwEh$dnPzzp8V1AbshZOu#t<V?NfC7' );
define( 'LOGGED_IN_KEY',    'YLwad.o#.Mzj3Go=Zl,N6`3Ef,Y[X9{{H$1E^hKFOkH)|(/afr~{9Xl<Lg)]qk(t' );
define( 'NONCE_KEY',        'w*$Akl1,1_2/vjH%gjG)am(K9ij4x%$A@LZXdv^~KXP?w0^V-Fdm^4Ia- 5%LJ4b' );
define( 'AUTH_SALT',        'jNfhcH180`@?|WxgZ{Ic!zlNRU)}WXI{<L,Iy9VRdB0nVPY6gnoDRw;?n1Mfgo=1' );
define( 'SECURE_AUTH_SALT', 'R4(%4ub^] |CdE!6<>#q??%hKXIPOTx+(2odUN2@{]0N7]9${k<1;zOhWaoXp3<!' );
define( 'LOGGED_IN_SALT',   '&2nD4w]NlbgB[LP~>+:Rk}Ro)S0!=uJ:$AO<gOXW,c7)7=49HZ~^N;Fz%DM?|cqX' );
define( 'NONCE_SALT',       'n&dDdEJdWN4s})zeGC3h2[|}xEBCURPPRm0c2`/_ZA${65j5,3F5]H=UgpY@H>vk' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
