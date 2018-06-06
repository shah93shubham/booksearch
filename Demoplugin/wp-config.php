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
define('DB_NAME', 'plugindemo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'R*Yl5*M|)hXe5Bk$`]|T<p*StlH{Qj~e+3Qa7*hc*Y_BhN~b Ifhx4&{4[=8~r7V');
define('SECURE_AUTH_KEY',  'yCfDM7/@ `r>ba8!ZX2&pXRKvF&Yd%f&:zX/gm;L Dnwt,uW}6kN#{UJM*?sDUpy');
define('LOGGED_IN_KEY',    'kE#@ln-z}-Ma3pJ[-Ay+{sdjnND9N=fuE!aeP%5e/X(a`p6>p%}-Fl%[1eLA}XAl');
define('NONCE_KEY',        'I9)ac#yXQ%Czfe*F>TJ{jWI1*[d<U;XtOIM-DM#&Ie%[+5dv{u!!,^$cw=[#w:<z');
define('AUTH_SALT',        '%){y$HbD-x_QGqzqRpeYEKYFjtwZS[PE4O2$S.^OGr.}#q{T/-w.a@Nag$C0b(kq');
define('SECURE_AUTH_SALT', 'Gee#ypr*0,)yG^F5r%*`S8}bb1.fP8|<gZ=AE@9#?d:qlG/{+y[TomdC880cQech');
define('LOGGED_IN_SALT',   ';/:^h,GU28XuV_23whf]GM9G<@d%Xcl+.m:DS[Z:h`EN%~elKn5v@IZ+Jdr]o9r3');
define('NONCE_SALT',       'mf:t|i`I1<.k[> g0eVxN3&Z{7rS/f2u>sG[m!$8sD-e3dd4CC33(W(fKdr4Q`]?');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
