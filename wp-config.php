<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'wordpress_zaidart');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'zaidiart_user');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'zaidiart');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N'y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'AU7lw=Us%Y7-c< 8U7n(6>A/9Qu@jULH&9Xe6o#9zf)*G=Oztcj:K|C$NV$ Z-*Q');
define('SECURE_AUTH_KEY',  '<:eu#91N5u|([B`cMBv}s3$ZZS[;`*e0CJmx`ZtT<g5xbCtOlV;;{UroR z4lIs7');
define('LOGGED_IN_KEY',    '[L6q8 *h6<EWO1%B5AkFOi/9`Q!Z5SOZaGAWyKzK%]b{nOYcd`xPqH*k~3^_fhv8');
define('NONCE_KEY',        'W#WcU#H[5Kt>==+:n@B)TGM3#*WNW68j/H:u^ZlU/33# PW+7Ar#XuYICtU/_HL(');
define('AUTH_SALT',        'jZc 3k++Wb8j%FNb(>+?pqG6G|L[&PLzvm%sr_!A9/|?)#GDeMiQ<ihO2!P4Vgb/');
define('SECURE_AUTH_SALT', 'kb9iYA@RFWE<B6)=1#j=wc7 oX#sOjVQ]):&+}Ceo7w;-YEYYrd(xti OaLaA@cr');
define('LOGGED_IN_SALT',   '=,LWpajtBzd1Zb-7(-1|zu/7WO5IxLjabjC%t)F6q&JMljw]3~W,+-~^|8ibuS#A');
define('NONCE_SALT',       'F>}WEA/c7jynf `<I[R){Rj`Y))U),,(~eTHfAEY?kMd[AQak@B[V;[#PYnkF$VU');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d'information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress 
 */
define('WP_DEBUG', false);

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');