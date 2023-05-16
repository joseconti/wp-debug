<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function wp_debug_google_maps_api_field() {
	?>
	<input title="<?php esc_html_e( 'Google Maps API Key', 'wp-debug' ); ?>" type="text" name="wp_debug_google_maps_api_field" value="<?php echo esc_html( wpdebug()->get_option( 'wp_debug_google_maps_api_field' ) ); ?>" size="40" />
	<?php
}

function wp_debug_select() {
	$option = wpdebug()->get_option( 'wp_debug_select' );
	?>
	<select id="wp_debug_select" name="wp_debug_select">
		<option value="red" 
		<?php
		if ( 'red' === $option ) {
			echo ' selected';}
		?>
		><?php esc_html_e( 'Red', 'wp-debug' ); ?></option>
		<option value="green" 
		<?php
		if ( 'green' === $option ) {
			echo ' selected';}
		?>
		><?php esc_html_e( 'Green', 'wp-debug' ); ?></option>
	</select>
	<?php
}

function wp_debug_color_picker() {
	$option = wpdebug()->get_option( 'wp_debug_color_picker' );
	?>
	<input title="<?php esc_html_e( 'Color Picker', 'wp-debug' ); ?>" type="text" name="wp_debug_color_picker" value="<?php echo esc_html( wpdebug()->get_option( 'wp_debug_color_picker' ) ); ?>" class="wp-debug-color-picker" />
	<?php
}

function display_wpdebug_advanced_settings_panel_fields() {
	add_settings_section(
		'wpdebug-advanced-settings-section',
		null,
		null,
		'wpdebug-advanced-settings-options'
	);
	$opciones = array(
		array(
			'id'       => 'wp_debug_google_maps_api_field',
			'titulo'   => __( 'Show Screen in Menubar', 'wp-debug' ),
			'callback' => 'wp_debug_google_maps_api_field',
		),
		array(
			'id'       => 'wp_debug_select',
			'titulo'   => __( 'Color', 'wp-debug' ),
			'callback' => 'wp_debug_select',
		),
		array(
			'id'       => 'wp_debug_color_picker',
			'titulo'   => __( 'Color Picker', 'wp-debug' ),
			'callback' => 'wp_debug_color_picker',
		),
	);
	foreach ( $opciones as $opcion ) {
		add_settings_field(
			$opcion['id'],
			$opcion['titulo'],
			$opcion['callback'],
			'wpdebug-advanced-settings-options',
			'wpdebug-advanced-settings-section'
		);
	}
	// register all setings.
	foreach ( $opciones as $opcion ) {
		register_setting( 'wpdebug-advanced-settings-section', $opcion['id'] );
	}
}
add_action( 'admin_init', 'display_wpdebug_advanced_settings_panel_fields' );
