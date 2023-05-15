<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function wpdebug_settings_page() { ?>
	<div class="wrap">
		<h1><?php esc_html_e( 'WP Debug Settings', 'wp-debug' ); ?></h1>
		<?php
		if ( isset( $_GET['tab'] ) ) {
			$active_tab = $_GET['tab'];
		} else {
			$active_tab = 'main_settings';
		}
		?>
		<h2 class="nav-tab-wrapper">
			<a href="admin.php?page=wp_debug&tab=main_settings" class="nav-tab <?php echo 'main_settings' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Main Settings', 'wp-debug' ); ?></a>
			<a href="admin.php?page=wp_debug&&tab=advanced_settings" class="nav-tab <?php echo 'advanced_settings' === $active_tab ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Advanced Settings', 'wp-debug' ); ?></a>
		</h2>
		<form method="post" action="options.php">
			<?php
			if ( 'main_settings' === $active_tab ) {
				settings_fields( 'wpdebug-main-settings-section' );
				do_settings_sections( 'wpdebug-main-settings-options' );
			} else {
				settings_fields( 'wpdebug-advanced-settings-section' );
				do_settings_sections( 'wpdebug-advanced-settings-options' );
			}
				submit_button();
			?>
		</form>
	</div>
	<?php
}

// Include all options
require_once 'setting-options/main-settings.php';
require_once 'setting-options/advanced-settings.php';

add_action( 'admin_enqueue_scripts', 'wpdebug_enqueue_color_picker' );

function wpdebug_enqueue_color_picker( $hook ) {
	if ( 'toplevel_page_wp_debug' === $hook ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wpdebug-color-picker', WPDEBUG_PLUGIN_URL . 'assets/js/color-picker.js', array( 'wp-color-picker' ), false, true );
	}
}
