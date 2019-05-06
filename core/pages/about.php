<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function wpdebug_about_page() {
	?>
	<div class="wrap about-wrap">
		<h1><?php printf( __( 'Welcome to WP Debug %s', 'wp-debug' ), esc_html( WPDEBUG_VERSION ) ); ?></h1>
		<div class="about-text"><?php printf( __( 'Thank you for install WP Debug %s!', 'wp-debug'  ), esc_html( WPDEBUG_VERSION ) ); ?></div>
		<div class="wpdebug-badge"><?php printf( __( 'Version %s', 'wp-debug' ), esc_html( WPDEBUG_VERSION ) ); ?></div>
		<h2 class="nav-tab-wrapper">
			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'wpdebug_about_page' ), 'admin.php' ) ) ); ?>" class="nav-tab nav-tab-active"><?php esc_html_e( 'WP Debug', 'wp-debug' ); ?></a>
		</h2>
		<p class="about-description"><?php esc_html_e( 'WP Debug is cool', 'wp-debug' ); ?></p>
		<p><?php esc_html_e( 'Did you know that to develop for WordPress you need to know things you can\'t see with the naked eye?', 'wp-debug' ); ?></p>
		<p><?php esc_html_e( 'WP Debug helps you see what you can\'t normally see, and what is essential to develop.', 'wp-debug' ); ?></p>
		<div class="return-to-dashboard">
			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'wp_debug' ), 'admin.php' ) ) ); ?>"><?php esc_html_e( 'Go to WP Debug Settings', 'wp-debug' ); ?></a>
		</div>
	</div>
	<?php
}
