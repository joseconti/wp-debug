<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function wpdebug_activate_page_menubar_field() { ?>

	<input type="checkbox" title="<?php esc_html_e( 'Activate Page Menu bar', 'wp-debug' ); ?>" name="wpdebug_activate_page_menubar_field" value="1" <?php checked( 1, get_option( 'wpdebug_activate_page_menubar_field' ), true ); ?>/>
	<?php
}

function display_wpdebug_main_settings_panel_fields() {
	add_settings_section(
		'wpdebug-main-settings-section',
		null,
		null,
		'wpdebug-main-settings-options'
	);
	add_settings_field(
		'wpdebug_activate_page_menubar_field',
		esc_html__( 'Show Screen in Menubar', 'wp-debug' ),
		'wpdebug_activate_page_menubar_field',
		'wpdebug-main-settings-options',
		'wpdebug-main-settings-section'
	);
	// register all setings.
	register_setting( 'wpdebug-main-settings-section', 'wpdebug_activate_page_menubar_field' );
}
add_action( 'admin_init', 'display_wpdebug_main_settings_panel_fields' );
