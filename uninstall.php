<?php

//if uninstall not called from WordPress exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) || ! current_user_can( 'activate_plugins' ) ) {
	exit();
}

$options = array(
	'wp-debug-version',
	'hide-wpdebug-notice',
	'wpdebug_activate_page_menubar_field',
);

foreach ( $options as $option ) {
	delete_option( $option );
}
