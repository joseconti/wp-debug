<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function wp_debug_load_visual_composer() {
	// Title
	vc_map(
		array(
			'name'        => __( 'Redsys Credit Card Image' ),
			'base'        => 'redsyscardimage',
			'description' => 'Show the credit card image',
			'icon'        => WPDEBUG_PLUGIN_URL . 'assets/img/Visa-MasterCard.png',
			'category'    => __( 'Gateways' ),
			'params'      => array(),
		)
	);
}
add_action( 'vc_before_init', 'wp_debug_load_visual_composer' );
