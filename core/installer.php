<?php
/**
 * WP Debug Installer
 *
 * @package WP DEBUG
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * WP Debug Create Tables Hook
 */
function wp_debug_create_tables_hook() {
	global $wpdb;

	$charset_collate           = '';
	$wp_debug_db_version_saved = '';
	$wp_debug_db_version_saved = get_option( 'wp_debug_db_version' );

	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wp_debug_svpr" );

	if ( $wp_debug_db_version_saved && '1.0.3' !== $wp_debug_db_version_saved && ( '1.0.3' === WP_DEBUG_DB_VERSION ) ) {

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		$charset_collate = $wpdb->get_charset_collate();

		$table_name = $wpdb->prefix . 'wp_debug_custom_rates';
		$sql        = 'CREATE TABLE ' . $table_name . " (
			ID bigint(20) unsigned NOT NULL auto_increment,
			type varchar(50) NOT NULL default 'price',
			country varchar(50) NOT NULL default '',
			state varchar(200) NOT NULL default '',
			postcode varchar(7) NOT NULL default '00000',
			minprice decimal(20,2) unsigned NOT NULL default '0.00',
			maxprice decimal(20,2) unsigned NOT NULL default '0.00',
			minweight decimal(20,2) unsigned NOT NULL default '0.00',
			maxweight decimal(20,2) unsigned NOT NULL default '0.00',
			rate varchar(200) NOT NULL default '',
			rateprice decimal(20,2) unsigned NOT NULL default '0.00',
			PRIMARY KEY (ID)
		) $charset_collate;";
				dbDelta( $sql );
				update_option( 'wp_debug_db_version', WP_DEBUG_DB_VERSION );
	}

	if ( ! $wp_debug_db_version_saved ) {

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		$table_name = $wpdb->prefix . 'wp_debug_custom_rates';

		$sql = 'CREATE TABLE ' . $table_name . " (
			ID bigint(20) unsigned NOT NULL auto_increment,
			type varchar(50) NOT NULL default 'price',
			country varchar(50) NOT NULL default '',
			state varchar(200) NOT NULL default '',
			postcode varchar(7) NOT NULL default '00000',
			minprice decimal(20,2) unsigned NOT NULL default '0.00',
			maxprice decimal(20,2) unsigned NOT NULL default '0.00',
			minweight decimal(20,2) unsigned NOT NULL default '0.00',
			maxweight decimal(20,2) unsigned NOT NULL default '0.00',
			rate varchar(200) NOT NULL default '',
			rateprice decimal(20,2) unsigned NOT NULL default '0.00',
			PRIMARY KEY (ID)
		) $charset_collate;";

		dbDelta( $sql );

		update_option( 'wp_debug_db_version', WP_DEBUG_DB_VERSION );
	}
}

/**
 * WP Debug Add Date to Table Hook.
 */
function wp_debug_add_data_to_tables_hook() {
	global $wpdb;

	$wp_debug_table_version_saved = '';
	$wp_debug_table_version_saved = get_option( 'wp_debug_table_version' );

	if ( ! $wp_debug_table_version_saved || '' === $wp_debug_table_version_saved ) {

		$table_name = $wpdb->prefix . 'wp_debug_custom_rates';

		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'ES',
				'state'     => '*',
				'postcode'  => '*',
				'minprice'  => '0',
				'maxprice'  => '60',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '10',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'ES',
				'state'     => '*',
				'postcode'  => '*',
				'minprice'  => '60',
				'maxprice'  => '9999999',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '0',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'PT',
				'state'     => '*',
				'postcode'  => '*',
				'minprice'  => '0',
				'maxprice'  => '60',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '10',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'PT',
				'state'     => '*',
				'postcode'  => '*',
				'minprice'  => '60',
				'maxprice'  => '9999999',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '0',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'AD',
				'state'     => '*',
				'postcode'  => '*',
				'minprice'  => '0',
				'maxprice'  => '60',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '10',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'AD',
				'state'     => '*',
				'postcode'  => '*',
				'minprice'  => '60',
				'maxprice'  => '9999999',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '0',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'ES',
				'state'     => 'PM',
				'postcode'  => '*',
				'minprice'  => '0',
				'maxprice'  => '100',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '15',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'ES',
				'state'     => 'PM',
				'postcode'  => '*',
				'minprice'  => '100',
				'maxprice'  => '9999999',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '0',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'ES',
				'state'     => 'GC',
				'postcode'  => '*',
				'minprice'  => '0',
				'maxprice'  => '200',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '35',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'ES',
				'state'     => 'GC',
				'postcode'  => '*',
				'minprice'  => '200',
				'maxprice'  => '9999999',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '0',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'ES',
				'state'     => 'CE',
				'postcode'  => '*',
				'minprice'  => '0',
				'maxprice'  => '300',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '40',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'ES',
				'state'     => 'CE',
				'postcode'  => '*',
				'minprice'  => '300',
				'maxprice'  => '9999999',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '0',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'ES',
				'state'     => 'ML',
				'postcode'  => '*',
				'minprice'  => '0',
				'maxprice'  => '300',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '40',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => 'ES',
				'state'     => 'ML',
				'postcode'  => '*',
				'minprice'  => '300',
				'maxprice'  => '9999999',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'B2C Estándar',
				'rateprice' => '0',
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'type'      => 'price',
				'country'   => '*',
				'state'     => '*',
				'postcode'  => '*',
				'minprice'  => '0',
				'maxprice'  => '9999999',
				'minweight' => '0',
				'maxweight' => '1000',
				'rate'      => 'Classic Internacional Terrestre',
				'rateprice' => '15',
			)
		);

		update_option( 'wp_debug_table_version', wp_debug_TABLE_VERSION );
	}
}

/**
 * WP Debug Create Random String.
 */
function wp_debug_create_random_string() {

	$characters           = 'abcdefghijklmnopqrstuvwxyz0123456789';
	$string               = '';
	$max                  = strlen( $characters ) - 1;
	$random_string_length = 10;
	for ( $i = 0; $i < $random_string_length; $i++ ) {
		$string .= $characters[ wp_rand( 0, $max ) ];
	}
	return $string;
}

/**
 * WP Debug Create upload flder Hook.
 */
function wp_debug_create_upload_folder_hook() {

	$wp_debug_upload_dir    = get_option( 'wp_debug_uploads_dir' );
	$wp_debug_download_file = get_site_option( 'wp_debug_download_file_path' );

	if ( $wp_debug_download_file ) {
		wp_delete_file( $wp_debug_download_file );
		delete_site_option( 'wp_debug_download_file_path' );
	}

	if ( $wp_debug_upload_dir && file_exists( $wp_debug_upload_dir ) ) {
		return;
	} else {
		$upload_dir                   = wp_upload_dir();
		$random_string                = wp_debug_create_random_string();
		$wp_debug_uploads_name_prefix = 'wp_debug_uploads_';
		$wp_debug_uploads_name        = $wp_debug_uploads_name_prefix . $random_string;
		$wp_debug_upload_dir          = $upload_dir['basedir'] . '/' . $wp_debug_uploads_name;
		$wp_debug_upload_dir_labels   = $upload_dir['basedir'] . '/' . $wp_debug_uploads_name . '/labels';
		$wp_debug_upload_dir_manifest = $upload_dir['basedir'] . '/' . $wp_debug_uploads_name . '/manifests';
		$wp_debug_upload_url          = $upload_dir['baseurl'] . '/' . $wp_debug_uploads_name;
		$wp_debug_upload_url_labels   = $upload_dir['baseurl'] . '/' . $wp_debug_uploads_name . '/labels';
		$wp_debug_upload_url_manifest = $upload_dir['baseurl'] . '/' . $wp_debug_uploads_name . '/manifests';

		if ( ! file_exists( $wp_debug_upload_dir ) ) {
			wp_mkdir_p( $wp_debug_upload_dir );
			wp_mkdir_p( $wp_debug_upload_dir_labels );
			wp_mkdir_p( $wp_debug_upload_dir_manifest );
			update_option( 'wp_debug_uploads_dir', $wp_debug_upload_dir );
			update_option( 'wp_debug_uploads_url', $wp_debug_upload_url );
			update_option( 'wp_debug_uploads_dir_labels', $wp_debug_upload_dir_labels );
			update_option( 'wp_debug_uploads_dir_manifest', $wp_debug_upload_dir_manifest );
			update_option( 'wp_debug_uploads_url_labels', $wp_debug_upload_url_labels );
			update_option( 'wp_debug_uploads_url_manifest', $wp_debug_upload_url_manifest );
		}
	}
}

/**
 * WP Debug add avanced settings preset.
 */
function wp_debug_add_avanced_settings_preset() {

	$wp_debug_add = get_option( 'wp_debug_add_advanced_settings_field_pre' );

	if ( '1' === $wp_debug_add ) {
		update_option( 'wp_debug_add_advanced_settings_field_pre', '2' );
	}
	if ( ! $wp_debug_add ) {
		update_option( 'wp_debug_after_get_label_field', 'shipping' );
		update_option( 'wp_debug_preaviso_notificar_field', null );
		update_option( 'wp_debug_reparto_notificar_field', null );
		update_option( 'wp_debug_tipo_notificacion_field', 'EMAIL' );
		update_option( 'wp_debug_tipo_etiqueta_field', 'PDF' );
		update_option( 'wp_debug_aduana_origen_field', 'D' );
		update_option( 'wp_debug_aduana_destino_field', 'D' );
		update_option( 'wp_debug_tipo_mercancia_field', 'C' );
		update_option( 'wp_debug_id_mercancia_field', '400' );
		update_option( 'wp_debug_descripcion_field', 'MANUFACTURAS DIVERSAS' );
		update_option( 'wp_debug_add_advanced_settings_field_pre', '1' );
	}
}

