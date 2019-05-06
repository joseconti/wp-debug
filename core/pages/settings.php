<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function wpdebug_settings_page() {
	echo '<h1>' . esc_html__( 'settings', 'wp-debug' ) . '</h1>';
}
