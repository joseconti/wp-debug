<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once WPDEBUG_PLUGIN_PATH . 'core/pages/estructura-menu.php';
require_once WPDEBUG_PLUGIN_PATH . 'core/pages/settings.php';
require_once WPDEBUG_PLUGIN_PATH . 'core/pages/about.php';

function wpdebug_menu() {
	global $wpdebugestructure, $wpdebugsettings, $wpdebugabout, $wpdebugcpt, $wpdebugcptadd, $wpdebugcpttaxo;

	$page_title = esc_html__( 'WP Debug', 'wp-debug' );
	$menu_title = 'WP Debug';
	$capability = 'manage_options';
	$menu_slug  = 'wp_debug';
	$function   = 'wpdebug_settings_page';
	$icon_url   = null;
	$position   = null;

	add_menu_page( $page_title, $menu_title, 'manage_options', $menu_slug, $function, $icon_url, $position );

	$wpdebugsettings   = add_submenu_page( $menu_slug, esc_html__( 'Settings', 'wp-debug' ), esc_html__( 'Settings', 'wp-debug' ), $capability, $menu_slug );
	$wpdebugestructure = add_submenu_page( $menu_slug, esc_html__( 'List Menu', 'wp-debug' ), esc_html__( 'List Menu', 'wp-debug' ), $capability, 'wpdebug_screen_menu_submenus_array', 'wpdebug_screen_menu_submenus_array' );
	$wpdebugabout      = add_submenu_page( $menu_slug, esc_html__( 'About', 'wp-debug' ), esc_html__( 'About', 'wp-debug' ), $capability, 'wpdebug_about_page', 'wpdebug_about_page' );
	$wpdebugcpt        = add_submenu_page( $menu_slug, esc_html__( 'Mi CPT', 'wp-debug' ), esc_html__( 'Mi CPT',   'wp-debug' ), $capability, 'edit.php?post_type=mi_post_type');
	$wpdebugcptadd     = add_submenu_page( $menu_slug, esc_html__( 'Add CPT', 'wp-debug' ), esc_html__( 'Add CPT',   'wp-debug' ), $capability, 'post-new.php?post_type=mi_post_type');
	$wpdebugcpttaxo    = add_submenu_page( $menu_slug, esc_html__( 'Mi Taxonomía', 'wp-debug' ), esc_html__( 'Mi Taxonomía',   'wp-debug' ), $capability, 'edit-tags.php?taxonomy=mi_taxonomia');
}
add_action( 'admin_menu', 'wpdebug_menu' );


function wpdebug_remove_menu_items() {
	global $submenu;

	if ( isset( $submenu['wp_debug'] ) ) {
		unset( $submenu['wp_debug'][2] );
	}
}
add_action( 'admin_head', 'wpdebug_remove_menu_items' );
