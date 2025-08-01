<?php

define('FS_METHOD', "direct");

/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link https://fr.wordpress.org/support/article/editing-wp-config-php/ Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// Configuration pour l'environnement de développement local
define('WP_HOME','https://localhost:8443');
define('WP_SITEURL','https://localhost:8443');

// Forcer HTTPS
define('FORCE_SSL_ADMIN', true);
$_SERVER['HTTPS'] = 'on';
$_SERVER['SERVER_PORT'] = 443;

// Configuration SSL pour le développement local
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

// Configuration spéciale pour les requêtes internes (API REST, cron)
if (defined('WP_CLI') || (isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'WordPress') !== false)) {
    define('WP_HOME','https://wordpress:443');
    define('WP_SITEURL','https://wordpress:443');
}

// Forcer WordPress à utiliser les URLs locales
define('WP_CONTENT_URL', 'https://localhost:8443/wp-content');

/* C'est tout, ne touchez pas à ce qui suit ! Bonne publication. */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'cliniquecepi_main' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'sql-dev' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'NDK5r+6RIpRtSX=^=8[0oULFK' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'mysql:3306' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '45+<RFxVvtHHK].33c86DM`r|+ON<HN+90G$+kJ)xCX.pnB5|u9{JCy-qK|&meaE' );
define( 'SECURE_AUTH_KEY',  'hldX^ji}*r,i,sA5a/O3 g*MZL)k3KVr^:&duhvbjQ1AS|_:&0gWi7F,)^)]0|f?' );
define( 'LOGGED_IN_KEY',    '/eOsI DEj/=vQW^tmv|cQm)4X5u2g^Ky#{{u43}[kVa/VF2g42HoFW0?;LvjrGk=' );
define( 'NONCE_KEY',        ' 2y[|BzJ%kO7fSDPO^vBW-h<PB(VWa|z[U;1XY?GXfG;N>r&(|}@%,tH|Y-7t7({' );
define( 'AUTH_SALT',        '*xk^wAuR-_kkx!U~CM9G~z^J)Z_Lqq0jE{m[{PnJ-&2>0yx5`I/=7GKP^Es_w-w|' );
define( 'SECURE_AUTH_SALT', 'v&Dw[zEXX:-4uglWsCSU$5@nl_!M<|!VKACs NYyY58Iu^Um7L=)ghSIs?Vhj7(r' );
define( 'LOGGED_IN_SALT',   'P!q0D=BJSb=wV;`7l;o~=!Yl)m[o1^)VO[hYnK.?D/jI3lO9Q`YF7CxB+_<r2JUJ' );
define( 'NONCE_SALT',       ';GUw=OE+l-WWzSIEj8!CNr$f/^1nubYn9[IfJU}#8[M4#jAzw-!&S`-=z+sH}e.`' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs et développeuses : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs et développeuses d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur la documentation.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
