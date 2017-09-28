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
define('DB_NAME', 'icv');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
 define('AUTH_KEY', 'k[I+N*Qa)>B*pWIgGN&Zq</OArTq<*fOIEpv@nJFI;NVLY=B(/XzEXkWKctoukE=k^C??U^pxUX$QKR_uHkZ/m+hPK|ev/hq![>UH/(DctY_/eV]EHRepxScA(TIg{o[');
 define('SECURE_AUTH_KEY', '<vehJeAnKkkabLmm=)A^l$]HYl}==>TQee)vB]PQhIf_OzmUtHjw@NXS_k[Gszmd_r[hKPy/MUiRZwLs>P{glN}Yux^tcsTEzpXRgm[CJy|QkRPDUIjbKi&]*K_ReK(M');
 define('LOGGED_IN_KEY', 'T%va|Tj%XgyPb<oXLWv&rqp(r]>QUdJzp@Q[sazjIM=u@j(Sjqc>EpR&NCoITtc-Zo;sv$fxPp?KhvpbG(lv%dN*XlcANOj!HpC*dLVsnRR]D%=i*s%f;F=gS<(Elva}');
 define('NONCE_KEY', ';vzS=lS^ef!W-{WJE%ojtew($zg<{YmXxFkWNOx}MQd=Orr;CWCp]^aMWoLV|Bpaw?C]wqJCEduJ&-Or*-dMAl<Rs<{=}-[(T!aUsj)Sx}aCD@bH[CGWZvq>/Q$cO+ck');
 define('AUTH_SALT', 'j*HYr|]qhQ{c%u|A@KA]eL*wW]-!P>x-<(yJPm%Fr-aMZMl>ETpk//s|[>)O$D(?j]_ReZRfKfQ/R<|+>TPNebs)*hN[/PjDSVJNlfbj[oT&qo@D-ym!}XC?$AtEl|gD');
 define('SECURE_AUTH_SALT', ';R!u@p-Tu(xo}!QP}cmJa{jtnTLRixvdRS|Zs[L*YNQqIn>MS!wGq;n*zhcp|t/gRykmb<-n^sTLOjTJO[=dBk=wBSc+ew@EC&mZ-d]-PUakgLmUK$<?)eA/feQg]W-Z');
 define('LOGGED_IN_SALT', 'x!paen{fl@_>P-A[EkJZp/nfpqb|ZFXSpn!^@+!!W$j*bo&yKaf{</rRdl%<Sz=%AR|z]@P;/L@W/;|xhfPSUgmJJJiGLL_V=se-ubX}CLut^;qqd+VW)Ry>UHaD+IEQ');
 define('NONCE_SALT', '=SBlLZs/>cId&f-{IwzT>GBkZnaHjmbsh]vYoz;b%$Dgh)H>I&QQqC[fnw>_d!*y;>YL^<|O^FX;A=q|*oNG$N*SQW_gLloPjabYYXhF-J[R;=%g)%MQwSsIzO/drGST');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_epuy_';

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
