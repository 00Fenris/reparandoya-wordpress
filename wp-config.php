<?php
/**
 * Configuración de WordPress para CDMon
 * ReparandoYa - Plataforma de Servicios
 */

// ** Configuración de la base de datos de CDMon ** //
define( 'DB_NAME', '278011167wordpress20251105112549' );
define( 'DB_USER', '278011167' );
define( 'DB_PASSWORD', 'pAb5UIS0ypNY4ZA2Cv0qaYcyy7teYrGT' );
define( 'DB_HOST', 'mysql5.cdmon.net' );
define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );

/**#@+
 * Claves de autenticación únicas.
 */
define( 'AUTH_KEY',         'reparandoya_auth_key_2025_secure_12345' );
define( 'SECURE_AUTH_KEY',  'reparandoya_secure_auth_key_2025_cdmon_67890' );
define( 'LOGGED_IN_KEY',    'reparandoya_logged_in_key_2025_platform_abcde' );
define( 'NONCE_KEY',        'reparandoya_nonce_key_2025_services_fghij' );
define( 'AUTH_SALT',        'reparandoya_auth_salt_2025_booking_klmno' );
define( 'SECURE_AUTH_SALT', 'reparandoya_secure_auth_salt_2025_reviews_pqrst' );
define( 'LOGGED_IN_SALT',   'reparandoya_logged_in_salt_2025_professionals_uvwxyz' );
define( 'NONCE_SALT',       'reparandoya_nonce_salt_2025_payments_123456' );

/**#@-*/

/**
 * Prefijo de tablas en la base de datos de WordPress.
 */
$table_prefix = 'wp_reparandoya_';

/**
 * Para desarrolladores: modo de depuración de WordPress.
 */
define( 'WP_DEBUG', false );

/**
 * Configuraciones específicas para CDMon
 */
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'WP_MAX_MEMORY_LIMIT', '512M' );
define( 'WP_POST_REVISIONS', 3 );
define( 'AUTOSAVE_INTERVAL', 300 );
define( 'WP_AUTO_UPDATE_CORE', true );

/**
 * Configuración de URLs para CDMon
 */
define( 'WP_HOME', 'http://www.reparandoya.com' );
define( 'WP_SITEURL', 'http://www.reparandoya.com' );

/* ¡Eso es todo, deja de editar! Feliz blogging. */

/** Ruta absoluta al directorio de WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura las variables de WordPress y archivos incluidos. */
require_once ABSPATH . 'wp-settings.php';