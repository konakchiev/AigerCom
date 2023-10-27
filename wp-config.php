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
define( 'DB_NAME', 'aigercom' );

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
define( 'AUTH_KEY',         'M<&7,D&*%jAcTZS-QF:z%=V;Otxdw=wFJ]}`k=t|#8n>c`TR/*^p`  u79J4n]fZ' );
define( 'SECURE_AUTH_KEY',  'Q3t8GC16M<}U:8~Z*]?*}Nu;Rb9Sl5k>bKw >n2lhvfV@yEpvsMJ=RoL}~m:9)<[' );
define( 'LOGGED_IN_KEY',    'EDo`%xx)@QJ?x9cwfkkNUcsp>)7Yyk?(t4-GX,oUUGe&,%L{b~kMn;utwe94`]$}' );
define( 'NONCE_KEY',        'i%t=ytbc?DDF?D{Du3CEDfY.TIdvJ04gk]%aW(zuwX_hlal0}4&*+ nozh<hd}d$' );
define( 'AUTH_SALT',        'b5hBE9wWS:/hyNe>R.h^myjsUFu2_5QTN`xRpUHnMIbug@|)?hoK/qidqy92I<:6' );
define( 'SECURE_AUTH_SALT', 'RM8^62|L9ah[g~>=e4(!( J&)e/<j<w>z3#l,5+r;RlU*8+&B0f+Du0B,9W9[-]S' );
define( 'LOGGED_IN_SALT',   'BBy8Qhs{i7~.^DY&66StLhJ9WnM^}&`%S_Tv>p?jcnY]E)23INKWV6&m@mK{zk*`' );
define( 'NONCE_SALT',       '5$CrOmig/pz48yj{zI/]p]VnVN%K]V-jv*{~6zvO&t}UVewI:wzHI}2lN]i[f<}X' );

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
