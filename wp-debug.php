<?php
/**
Plugin Name: WordPress debug
Plugin URI: https://www.joseconti.com/
Description: Muestra herramientas para debug.
Version: 0.0.1
Author: José Conti
Author URI: https://www.joseconti.com/
Tested up to: 5.1
WC requires at least: 3.0
WC tested up to: 3.6
Woo: XXXXXXXXXXXXXXXXXXXXXXXXX
Text Domain: wp-debug
Domain Path: /languages/
Network: true
Requires PHP: 5.6.0
Copyright: (C) 2019 José Conti
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

define( 'WPDEBUG_VERSION', '0.0.1' );
define( 'WPDEBUG_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPDEBUG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

function wp_debug_init() {
	load_plugin_textdomain( 'wp-debug', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	//if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
	//	include_once WPDEBUG_PLUGIN_PATH . 'core/load-woocommerce-functions.php';
	//}
}
add_action( 'plugins_loaded', 'wp_debug_init', 11 );

require_once WPDEBUG_PLUGIN_PATH . 'core/menu/menu.php';
require_once WPDEBUG_PLUGIN_PATH . 'core/notice/notices.php';
require_once WPDEBUG_PLUGIN_PATH . 'core/cpt/cpt.php';

function wp_debug_add_current_screen_to_admin_bar() {
	global $wp_admin_bar;

	if ( is_admin() ) {
		$screen    = get_current_screen();
		$activated = get_option( 'wpdebug_activate_page_menubar_field' );

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

// SEUR Get Parent Page.
function wp_debug_get_parent_page() {
	$wp_debug_parent = basename( $_SERVER['SCRIPT_NAME'] );
	return $wp_debug_parent;
}

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
