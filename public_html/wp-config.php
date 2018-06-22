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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hydraequ_wp' );

/** MySQL database username */
define( 'DB_USER', 'hydraequ_wp' );

/** MySQL database password */
define( 'DB_PASSWORD', 'tEf7MyXIWIrs' );

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
define('AUTH_KEY',         '78(<LpK-&L=G]y{c8X7|B_CpYz+ KS?gp@d~_P1c3,5bC76bQti=a+fZ=9e5xB3,');
define('SECURE_AUTH_KEY',  'b|k0=4L}-l])zA<w/_g|cm1^dQ2. ^Vq^ 7?Eg0+ADoqutbO|!E@13$2*Fs|-Z]Y');
define('LOGGED_IN_KEY',    '70&Tk.K;xE|S6w,<[?P)J|;CXg$^$?KJY|-!]|2wah@,vyRI>2dMQ6 AH2.qHD]e');
define('NONCE_KEY',        'sxz#loV6$Ok|>H3V+N^F->A`#/tab!Wp(J)%FA){CF7MFw`qLJHKtBcp2OxKV@SJ');
define('AUTH_SALT',        'z:0yV_G]Tus6RdTWHWQ9F)`6BjIES~/h&PUUD^IwAdt@JJG#1a|PxS:>IR-%SF}#');
define('SECURE_AUTH_SALT', '*|:aRo*8I|6HeY(XuH[wm)2V4q3Nb+.v7pcKoRc^D.9-BTKa|b2sX5TyY 8yg?k;');
define('LOGGED_IN_SALT',   'F+qG ,2^<@~xYeM+51ZC+6t!+K5:I~r:huE-U&y|>4ee[871KaicuTys&2.W.TW(');
define('NONCE_SALT',       'Xe!5-+)k_juN*<<<L#QDkC%nYW)}&rpGi-7Y_NPs:s]_IbmhEJqaR]+*Fk)q0Ko9');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

define( 'WP_MEMORY_LIMIT', '256M' );




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
