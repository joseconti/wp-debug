<?php
/**
 * Plugin Name: WordPress debug
 * Plugin URI: https://www.joseconti.com/
 * Description: Muestra herramientas para debug.
 * Version: 0.0.1
 * Author: José Conti
 * Author URI: https://www.joseconti.com/
 * Tested up to: 5.1
 * WC requires at least: 3.0
 * WC tested up to: 3.6
 * Woo: XXXXXXXXXXXXXXXXXXXXXXXXX
 * Text Domain: wp-debug
 * Domain Path: /languages/
 * Network: true
 * Requires PHP: 5.6.0
 * Copyright: (C) 2019 José Conti
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

define( 'WPDEBUG_VERSION', '0.0.1' );
define( 'WPDEBUG_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPDEBUG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_DEBUG_DB_VERSION', '1.0.0' );
/**
 * Plugns loaded.
 */
function wp_debug_init() {
	load_plugin_textdomain( 'wp-debug', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	// if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
	// include_once WPDEBUG_PLUGIN_PATH . 'core/load-woocommerce-functions.php';
	// }
}
add_action( 'plugins_loaded', 'wp_debug_init', 11 );

require_once WPDEBUG_PLUGIN_PATH . 'classes/class-wp-debug-global.php';
// require_once WPDEBUG_PLUGIN_PATH . 'classes/class-wp-debug-users.php';
require_once WPDEBUG_PLUGIN_PATH . 'core/menu/menu.php';
require_once WPDEBUG_PLUGIN_PATH . 'core/menu/multisite.php';
require_once WPDEBUG_PLUGIN_PATH . 'core/notice/notices.php';
require_once WPDEBUG_PLUGIN_PATH . 'core/cpt/cpt.php';


/**
 * Global function.
 *
 * @return Wp_Debug_Global
 */
function wpdebug() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	return new Wp_Debug_Global();
}

/**
 * Add data to tables.
 */
require_once WPDEBUG_PLUGIN_PATH . 'core/installer.php';
// register_activation_hook( __FILE__, 'wp_debug_create_tables_hook' );
// register_activation_hook( __FILE__, 'wp_debug_add_data_to_tables_hook' );
// register_activation_hook( __FILE__, 'wp_debug_create_upload_folder_hook' );
// register_activation_hook( __FILE__, 'wp_debug_add_avanced_settings_preset' );

/**
 * Add current screen to admin bar.
 */
function wp_debug_add_current_screen_to_admin_bar() {
	global $wp_admin_bar;

	if ( is_admin() ) {
		$screen    = get_current_screen();
		$activated = wpdebug()->get_option( 'wpdebug_activate_page_menubar_field' );

		if ( $activated && '1' === $activated ) {
			$wp_admin_bar->add_menu(
				array(
					'id'     => 'wp-debug-add-current-screen-to-admin-bar',
					'parent' => 'top-secondary',
					'title'  => esc_html__( 'Screen: ', 'wp-debug' ) . $screen->id,
				)
			);
		}
	}
}
add_action( 'admin_bar_menu', 'wp_debug_add_current_screen_to_admin_bar' );

/**
 * Get parent page.
 */
function wp_debug_get_parent_page() {
	$wp_debug_parent = basename( $_SERVER['SCRIPT_NAME'] );
	return $wp_debug_parent;
}
/**
 * Welcome splash.
 */
function wp_debug_welcome_splash() {
	$wp_debug_parent = wp_debug_get_parent_page();

	if ( get_option( 'wp-debug-version' ) === WPDEBUG_VERSION ) {
		return;
	} elseif ( 'update.php' === $wp_debug_parent || 'update-core.php' === $wp_debug_parent || 'plugins.php' === $wp_debug_parent ) {
		return;
	} else {
		update_option( 'wp-debug-version', WPDEBUG_VERSION );
		$wp_debug_redirect = esc_url( admin_url( add_query_arg( array( 'page' => 'wpdebug_about_page' ), 'admin.php' ) ) );
		wp_safe_redirect( $wp_debug_redirect );
		exit;
	}
}
add_action( 'admin_init', 'wp_debug_welcome_splash', 1 );

/**
 * Add styles.
 *
 * @param string $hook Page.
 */
function wp_debug_about_styles_css( $hook ) {
	global $wpdebugabout;

	if ( $wpdebugabout !== $hook ) {
		return;
	} else {
		wp_register_style( 'wpdebugAboutCSS', WPDEBUG_PLUGIN_URL . 'assets/css/wpdebug-about.css', array(), esc_html( WPDEBUG_VERSION ) );
		wp_enqueue_style( 'wpdebugAboutCSS' );
	}
}
add_action( 'admin_enqueue_scripts', 'wp_debug_about_styles_css' );

/**
 * Add scripts.
 */
function wp_debug_add_text_storefront_post_content_before() {
	_e( 'Esto está sobre la entrada', 'wp-debug' );
}
add_action( 'storefront_post_content_before', 'wp_debug_add_text_storefront_post_content_before' );

/**
 * Add scripts.
 */
function wp_debug_anadir_golger_analytics() {
	echo '<!-- Esto lo añade mi plugin -->';
	?>
	<script>
	</script>
	<?php
	echo '<!-- Fin de lo añade mi plugin -->';
}
add_action( 'wp_footer', 'wp_debug_anadir_golger_analytics' );

/**
 * Modify login title.
 *
 * @param string $login_title Login title.
 * @param string $title       Title.
 */
function wp_debug_modify_login_title( $login_title, $title ) {

	$login_title = 'Nuevo título de página de login';
	return $login_title;
}
add_filter( 'login_title', 'wp_debug_modify_login_title', 10, 2 );

/**
 * Modify login header url.
 *
 * @param string $url Url.
 */
function wp_debug_update_url( $url ) {
	$url = 'https://cursojc.com/';
	return $url;
}
add_filter( 'login_headerurl', 'wp_debug_update_url' );

// Ejemplo printf + wp_kses + esc_url.

/*
$guias  = 'https://redsys.joseconti.com/guias/';
$faq    = 'https://redsys.joseconti.com/redsys-for-woocommerce/';
$ticket = 'https://woocommerce.com/my-account/tickets/';
printf(
	wp_kses(
		'<div class="redsysnotice">
				<span class="dashicons dashicons-welcome-learn-more redsysnotice-dash"></span>
				<span class="redsysnotice__content">' .
				// translators: Links to Jose Conti Redsys website Guides, Faq and Suport tickets.
				__( 'For Redsys Help: Check the website <a href="%1$s" target="_blank" rel="noopener">Guides</a> for setup <a href="%2$s" target="_blank" rel="noopener">FAQ page</a> for working problems, or open a <a href="%3$s" target="_blank" rel="noopener"> Ticket</a> for support', 'wp-debug' ) . '<span></div>',
		array(
			'a'    => array(
				'href'   => array(),
				'target' => array(),
				'rel'    => array(),
			),
			'div'  => array(
				'class' => array(),
			),
			'span' => array(
				'class' => array(),
			),
		)
	),
	esc_url( $guias ),
	esc_url( $faq ),
	esc_url( $ticket )
);

*/

add_action( 'init', 'wp_debug_add_custom_role', 11 );
function wp_debug_add_custom_role() {
	add_role(
		'cpt_perfil',
		__( 'Perfil CPT' ),
		array(
			'edit_cpt'         => true,
			'read_cpt'         => true,
			'delete_cpt'       => true,
			'edit_cpt'         => true,
			'edit_others_cpt'  => true,
			'publish_cpt'      => true,
			'read_private_cpt' => true,
			'upload_files'     => true,
		)
	);
	// remove_role( 'cpt_perfil' );
}
