<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

class Wp_Debug_Global {

	public function __construct() {
		// Empty constructor.
	}
	public function get_option( $option ) {

		$main_site = 1;
		if ( defined( 'WP_DEBUG_GLOBAL_OPTIONS' ) && WP_DEBUG_GLOBAL_OPTIONS ) {
			if ( defined( WP_DEBUG_MAIN_SITE ) ) {
				$main_site = WP_DEBUG_MAIN_SITE;
			}
			switch_to_blog( $main_site );
			$option = get_option( $option );
			restore_blog();
			return $option;
		}
		return get_option( $option );
	}
}
