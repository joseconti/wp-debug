<?php

function wp_debug_shortcode_redsys_card_image() {
	return '<img src="' . esc_url( WPDEBUG_PLUGIN_URL ) . 'assets/img/Visa-MasterCard.png" alt="' . esc_html__( 'Accepted Credit Cards', 'woocommerce-redsys' ) . '" height="58" width="150">';
}
add_shortcode( 'redsyscardimage', 'wp_debug_shortcode_redsys_card_image' );
