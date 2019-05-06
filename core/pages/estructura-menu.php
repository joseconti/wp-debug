<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function wpdebug_screen_menu_submenus_array() {
	echo '<h1>' . esc_html__( 'Menu Structure', 'wp-debug' ) . '</h1>';
	echo '<pre>' . print_r( $GLOBALS['menu'], true) . '</pre>';
	echo '<pre>' . print_r( $GLOBALS['submenu'], true) . '</pre>';
}
