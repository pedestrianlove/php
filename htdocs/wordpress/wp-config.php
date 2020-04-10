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
define( 'DB_NAME', 'b13_25362198_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'b13_25362198' );

/** MySQL database password */
define( 'DB_PASSWORD', 'joyce0920' );

/** MySQL hostname */
define( 'DB_HOST', 'sql205.byethost13.com' );

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
define( 'AUTH_KEY',         '1OTn<0prgU{?a@_q9-v`_nt7&`X?kB+d-xttl`jL&dO*J%2u|{QuI-3n&lE5%#d0' );
define( 'SECURE_AUTH_KEY',  'o)joKO[1`(Tj.0a_r%bW0UhT>H`cpG;&=A:(P~YsC%v./,}ds]+MAMn@wP5WJtI|' );
define( 'LOGGED_IN_KEY',    '-OQ<%=re:FWy9W%O#7K<cq+nP%8EigRBN+ (-H QjwRbRKLP26f#lw*@N`H(h4:-' );
define( 'NONCE_KEY',        '#}AEin=2Cp-I Z;?{sRcLX-N,@k~vp%M9,`>;F}GJ.4jk1`c9IS~kC34JUe6jNil' );
define( 'AUTH_SALT',        'jDKyf<EHqAm`D%[:[u@:sLiG1.<R?HW-jTQ[z[;HwEZ%(,Yhs2lK2,QIH3B6QE}U' );
define( 'SECURE_AUTH_SALT', 'p*A@~*@`af%km+$b^?e5!VY=)y}VW3fV*qP,R)IZ^(*`<{nQsfXwU@=HW~J;3hoi' );
define( 'LOGGED_IN_SALT',   'W 500d0hjh>}p,5Jn]L-6z%vnZ!z?IHhG%=XyXzJ;k R=IWna,)q;Dk`S@)A QJM' );
define( 'NONCE_SALT',       '4*xV0|^1{$14:-<gJdm{Js?.G v_*yTf~~SOro2r9$}-9vN&j%}uRC2jZTmvmDm[' );

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
