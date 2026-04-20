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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'fjdf-rebuild-2026_org' );

/** Database username */
define( 'DB_USER', 'media-admin' );

/** Database password */
define( 'DB_PASSWORD', 'Tr1-I7ad#1n' );

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
define( 'AUTH_KEY',          'r=o-[%Rt7hD%hO?%[;z2]amd_}FaUKr_5zOhbNg[sNq4r9@:iI,1Fu3/lTp^)}>l' );
define( 'SECURE_AUTH_KEY',   'lC}6_bx$d_x{U(lPrJA%]/U/#W*Z&x^a%L3G&_Z(rUzIK DFDK1r/JYB)EAZdUA7' );
define( 'LOGGED_IN_KEY',     'mq>[}&kxa6~o<`Hxa)F7Z4w6W&>YidTgxw#Lx{=?:C%i3;Lm_aCM,FqMVtmhi0&e' );
define( 'NONCE_KEY',         'JK]BTw4tE[zE1kN+rVu=;kVl $nenMh?,1rHuKo?6Gd!R$vt=oh$g>5Ev`}lBg:R' );
define( 'AUTH_SALT',         '9fv9/4F4|w;;g<S#Sh~la3&O-6}(7O{=G!f+R+X!+D@`-YL h]0yKPGpyJkcS3&C' );
define( 'SECURE_AUTH_SALT',  '_,jfap(DKGeqoRf7iR,(w^&?>g-C:;E]ure*~|YjzOh/{eCEV*j^]qrHHoQQu3IT' );
define( 'LOGGED_IN_SALT',    '+i<gLW.m27I). D`pn aCHH6~,7i_[(SrnW%44=)LUN`^1pYH/kv(#y#`;L^*qx~' );
define( 'NONCE_SALT',        'R{g 7LmLE<R V}W#Mr$j@paS`Uj@Xx.LgE,EAs/n4QAyl]f~|+]2eaXnL-v9*]NI' );
define( 'WP_CACHE_KEY_SALT', '+. ; rM-y<?b:e_^U,<j*1{i3KV~010*$-zYuAv)bwU, ztw#VqSV0#%gBe<e~Gd' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'fjdf_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* HTTPS hinter Valet/Proxy */
$_SERVER['HTTPS'] = 'on';
define( 'FORCE_SSL_ADMIN', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/** Sets up SMTP settings. */
// define('MEDIALAB_SMTP_ENABLED',   true);
// define('MEDIALAB_SMTP_HOST',      'smtp.example.com');
// define('MEDIALAB_SMTP_PORT',      587);
// define('MEDIALAB_SMTP_USER',      'user@example.com');
// define('MEDIALAB_SMTP_PASS',      'geheimes-passwort');
// define('MEDIALAB_SMTP_ENC',       'tls');
// define('MEDIALAB_SMTP_FROM',      'noreply@fjdf.at');
// define('MEDIALAB_SMTP_FROM_NAME', 'FJDF');