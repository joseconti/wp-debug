<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function wpdebug_add_notice() {

	$screen        = get_current_screen();
	$notice_status = get_option( 'hide-wpdebug-notice' );

	if ( 'yes' !== $notice_status ) {
		if ( 'plugins' === $screen->id || 'toplevel_page_wp_debug' === $screen->id ) {
			if ( isset( $_REQUEST['wpdebug-hide-notice'] ) && 'hide-notice-wpdebug' === $_REQUEST['wpdebug-hide-notice'] ) {
				$nonce = sanitize_text_field( $_REQUEST['_wpdebug_notice_nonce'] );
				if ( wp_verify_nonce( $nonce, 'wpdebug_hide_notices_nonce' ) ) {
					update_option( 'hide-wpdebug-notice', 'yes' );
				}
			} else {
				?>
				<div id="message" class="updated woocommerce-message woocommerce-wpdebug-messages">
					<a class="woocommerce-message-close notice-dismiss" style="top:0;" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'wpdebug-hide-notice', 'hide-notice-wpdebug' ), 'wpdebug_hide_notices_nonce', '_wpdebug_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'wp-debug' ); ?></a>
					<p>
						<?php esc_html_e( 'WP Debug is now installed. It\'s almost ready.', 'wp-debug' ); ?>
					</p>
					<p>
						<a href="<?php echo esc_html( admin_url( 'admin.php?page=wp_debug' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Go to WP Debug Settings', 'wp-debug' ); ?></a>
					</p>
				</div>
				<?php
			}
		}
	}
}
add_action( 'admin_notices', 'wpdebug_add_notice' );

function wpdebug_notice_style() {

	$screen        = get_current_screen();
	$notice_status = get_option( 'hide-wpdebug-notice' );

	if ( 'yes' !== $notice_status ) {
		if ( 'plugins' === $screen->id || 'toplevel_page_wp_debug' === $screen->id ) {
			wp_register_style( 'wpdebug_notice_css', WPDEBUG_PLUGIN_URL . 'assets/css/wpdebug-notice.css', false, WPDEBUG_VERSION );
			wp_enqueue_style( 'wpdebug_notice_css' );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'wpdebug_notice_style' );
