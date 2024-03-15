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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'datashoptime' );

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
define( 'AUTH_KEY',         '3Di(|oY!HrKUpCTA5>.s56gEIE$,ccVHd@hK}[-%`y5E_y69aD<ySy)[NMWp3#;c' );
define( 'SECURE_AUTH_KEY',  'TSA`U%1gh$My!U*dmp7VOmmfxq3/s$^v^ZjV3EAN&5s{#..}H~m&Fh9G B.84$$H' );
define( 'LOGGED_IN_KEY',    '-c)^&SLWC1es7~U3,~hBm?V|uyjgWbg?MneMWcPx0D^rhr/Z]3qMzbyo>35q5svp' );
define( 'NONCE_KEY',        ',Bds. hXVOPrE{ZObN9[nHXyt=h`y.7-`%LeS)V,P0`z) 4Sk?Mwixk|`$.y=F-P' );
define( 'AUTH_SALT',        'JgtI=Rz^oleM{{L^0PM7oQIm?)/TI+h%7dK5[arSG,Zv7Uxp/qc8B@@1F(gYr>Kw' );
define( 'SECURE_AUTH_SALT', 'yo*oy$s51|Z4e:M>7:-xWjC%>G;#wTc#8[Z-`s &2w_<[dRtOK}Xkvg5}dg=$)Zl' );
define( 'LOGGED_IN_SALT',   'M7:0`Dln;z7HgedPO#^nDEkG@&g9NNpe/[JZzF]ngRg~NDVFLG$t(Nek<n*CB>e9' );
define( 'NONCE_SALT',       'h;ycdf#sl_f/FiJvWfB@zbFNPp)%-;)kML=cehr=03LSzX-Ee|G;rR9XlCc*OI<$' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
