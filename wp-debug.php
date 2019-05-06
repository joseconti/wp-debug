<?php
/**
Plugin Name: WordPress debug
Plugin URI: https://www.joseconti.com/
Description: Muestra herramientas para debug.
Version: 0.0.1
Author: José Conti
Author URI: https://www.joseconti.com/
Tested up to: 5.1
Text Domain: wp-debug
Domain Path: /languages/
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
	//	include_once WPDEBUG_PLUGIN_PATH . 'core/loader-core.php';
	//}
}
add_action( 'plugins_loaded', 'wp_debug_init', 11 );

include_once WPDEBUG_PLUGIN_PATH . 'core/menu/menu.php';
include_once WPDEBUG_PLUGIN_PATH . 'core/notice/notices.php';

function wp_debug_add_current_screen_to_admin_bar() {
	global $wp_admin_bar;
	
	$screen = get_current_screen();
	$wp_admin_bar->add_menu( array(
		'id' => 'wp-debug-add-current-screen-to-admin-bar',
		'parent' => 'top-secondary',
		'title' => esc_html__( 'Screen: ', 'wp-debug' ) . $screen->id,
		)
	);
}
add_action( 'admin_bar_menu', 'wp_debug_add_current_screen_to_admin_bar' );
