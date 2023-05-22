<?php

defined( 'ABSPATH' ) || exit;

class WP_Debug_Scheduled_Actions {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'wp_debug_schedule_actions' ) );
		add_action( 'wp_debug_clean_transients', array( $this, 'wp_debug_clean_transients_action' ) );
	}
	/**
	 * Schedule actions
	 */
	public function wp_debug_schedule_actions() {
		// Add conditional using settings. Active or not active.
		if ( false === as_next_scheduled_action( 'wp_debug_clean_transients' ) ) {
			as_schedule_recurring_action( strtotime( 'now' ), DAY_IN_SECONDS, 'wp_debug_clean_transients' );
		}
	}
	/**
	 * Clean transients
	 */
	public function wp_debug_clean_transients_action() {
		global $wpdb;

		$expired = $wpdb->get_col( "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout%' AND option_value < UNIX_TIMESTAMP()" );
		foreach ( $expired as $transient ) {
			$key = str_replace( '_transient_timeout_', '', $transient );
			delete_transient( $key );
			$this->debug( 'Transient deleted: ' . $key );
		}
	}
}
return new WP_Debug_Scheduled_Actions();
