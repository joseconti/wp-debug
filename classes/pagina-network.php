<?php
/**
 * WordPress Multisite Settings.
 *
 * @author Mario Yepes <marioy47@gmail.com>
 * @package Wordpress_Multisite_Settings
 */

namespace Multisite_Settings;

/**
 * Creates a new settings page on "Network Admin > Settings >Custom Settings".
 *
 * This class can't be instanciated. instead you need to call the static function `get_instance`
 */
class Settings_Page {


	/**
	 * This will be used for the SubMenu URL in the settings page and to verify which variables to save.
	 *
	 * @var string
	 */
	protected $settings_slug = 'custom-network-settings';


	/**
	 * Singleton.
	 */
	private function __construct() {

	}

	/**
	 * Static Factory method.
	 *
	 * You can GET an instance of this class by calling `$a = Settings_Page::get_instance();`
	 *
	 * @return self
	 */
	public static function get_instance(): self {
		static $obj;
		return isset( $obj ) ? $obj : $obj = new self();
	}

	/**
	 * Executes the add_action() WordPress methods.
	 *
	 * @return void
	 */
	public function add_hooks() {
		// Register page on menu.
		add_action( 'network_admin_menu', array( $this, 'menu_and_fields' ) );

		// Function to execute when saving data.
		add_action( 'network_admin_edit_' . $this->settings_slug . '-update', array( $this, 'update' ) );
	}

	/**
	 * Creates the sub-menu page and register the multisite settings.
	 *
	 * @return void
	 */
	public function menu_and_fields() {

		// Create the submenu and register the page creation function.
		add_submenu_page(
			'settings.php',
			__( 'Multisite Settings Page', 'multisite-settings' ),
			__( 'Custom Settings', 'multisite-settings' ),
			'manage_network_options',
			$this->settings_slug . '-page',
			array( $this, 'create_page' )
		);

		// Register a new section on the page.
		add_settings_section(
			'default-section',
			__( 'This the first and only section', 'multisite-settings' ),
			array( $this, 'section_first' ),
			$this->settings_slug . '-page'
		);

		// Register a new variable and register the function that updates it.
		register_setting( $this->settings_slug . '-page', 'first_input_var' );
		add_settings_field(
			'first_input_var',
			__( 'This is the first input', 'multisite-settings' ),
			array( $this, 'field_first_input' ), // callback.
			$this->settings_slug . '-page', // page.
			'default-section' // section.
		);
	}

	/**
	 * This creates the settings page itself.
	 *
	 * @return void
	 *
	 * @phpcs:disable WordPress.Security.NonceVerification.Recommended
	 */
	public function create_page() {
		?>
		<?php if ( isset( $_GET['updated'] ) ) : ?>
			<div id="message" class="updated notice is-dismissible">
				<p><?php esc_html_e( 'Options Saved', 'wp-debug' ); ?></p>
			</div>
		<?php endif; ?>

		<div class="wrap">
			<h1><?php echo esc_attr( get_admin_page_title() ); ?></h1>
			<form action="edit.php?action=<?php echo esc_attr( $this->settings_slug ); ?>-update" method="POST">

				<?php
						settings_fields( $this->settings_slug . '-page' );
						do_settings_sections( $this->settings_slug . '-page' );
						submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Multisite options require its own update function. Here we make the actual update.
	 *
	 * @return void
	 */
	public function update() {
		\check_admin_referer( $this->settings_slug . '-page-options' );
		global $new_whitelist_options;

		$options = $new_whitelist_options[ $this->settings_slug . '-page' ];

		foreach ( $options as $option ) {
			if ( isset( $_POST[ $option ] ) ) {
				update_site_option( $option, sanitize_text_field( wp_unslash( $_POST[ $option ] ) ) );
			} else {
				delete_site_option( $option );
			}
		}

		wp_safe_redirect(
			add_query_arg(
				array(
					'page'    => $this->settings_slug . '-page',
					'updated' => 'true',
				),
				network_admin_url( 'settings.php' )
			)
		);
		exit;
	}

	/**
	 * Html after the new section title.
	 *
	 * @return void
	 */
	public function section_first() {
		esc_html_e( 'Intro text to the first section.', 'wp-debug' );
	}

	/**
	 * Creates and input field.
	 *
	 * @return void
	 */
	public function field_first_input() {
		$val = get_site_option( 'first_input_var', '' );
		echo '<input type="text" name="first_input_var" value="' . esc_attr( $val ) . '" />';
	}

}