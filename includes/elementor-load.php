<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function wp_debug_register_widget( $widgets_manager ) {

	require_once WPDEBUG_PLUGIN_PATH . 'includes/elementor.php';

	$widgets_manager->register( new \Redsys_Image_Credit_Card() );

}
add_action( 'elementor/widgets/register', 'wp_debug_register_widget' );