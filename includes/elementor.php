<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Redsys_Image_Credit_Card extends \Elementor\Widget_Base {

	public function get_name() {
		return 'redsyscardimage';
	}

	public function get_title() {
		return esc_html__( 'Redsys Card Image', 'wp-debug' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	public function get_categories() {
		return array( 'general' );
	}

	public function get_keywords() {
		return array( 'redsyscardimage', 'url', 'link' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'wp-debug' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'url',
			array(
				'label'       => esc_html__( 'URL to embed', 'wp-debug' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'input_type'  => 'url',
				'placeholder' => esc_html__( 'https://your-link.com', 'wp-debug' ),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings_for_display();
		$html     = wp_oembed_get( $settings['url'] );

		echo '<div class="redsyscardimage-elementor-widget">';
		echo '<img src="' . esc_url( WPDEBUG_PLUGIN_URL ) . 'assets/img/Visa-MasterCard.png" alt="' . esc_html__( 'Accepted Credit Cards', 'woocommerce-redsys' ) . '" height="58" width="150">';
		echo '</div>';

	}

}
