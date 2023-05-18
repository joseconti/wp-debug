<?php

class Wp_Debug_Users {

	public function __construct() {
		add_action( 'show_user_profile', array( $this, 'extra_profile_fields' ), 10 );
		add_action( 'edit_user_profile', array( $this, 'extra_profile_fields' ), 10 );
		add_action( 'personal_options_update', array( $this, 'save_extra_profile_fields' ) );
		add_action( 'edit_user_profile_update', array( $this, 'save_extra_profile_fields' ) );
	}
	public function extra_profile_fields( $user ) { ?>
   
		<h3><?php esc_html_e( 'Extra User Details', 'wp-debug' ); ?></h3>
		<table class="form-table">
			<tr>
				<th><label for="gmail"><?php esc_html_e( 'Gmail', 'wp-debug' ); ?></label></th>
				<td>
				<input type="text" name="gmail" id="gmail" value="<?php echo esc_attr( get_the_author_meta( 'gmail', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'Enter your Gmail.', 'wp-debug' ); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="twitter"><?php esc_html_e( 'Twitter', 'wp-debug' ); ?></label></th>
				<td>
				<input type="text" name="twitter" id="Twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'Enter a Twitter Account.', 'wp-debug' ); ?></span>
				</td>
			</tr>
			<tr>
				<th><label for="tiktok"><?php esc_html_e( 'TikTok', 'wp-debug' ); ?></label></th>
				<td>
				<input type="text" name="tiktok" id="tiktok" value="<?php echo esc_attr( get_the_author_meta( 'tiktok', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php esc_html_e( 'Enter your TikTok Account.', 'wp-debug' ); ?></span>
				</td>
			</tr>
				<?php wp_nonce_field( 'wp_debug_check_nonce', 'wp_debug_nonce_user_fields' ); ?>
		</table>
			<?php
	}
	public function save_extra_profile_fields( $user_id ) {

		if ( ! current_user_can( 'edit_user', $user_id ) ) {
			return false;
		}
		if ( ! isset( $_POST['wp_debug_nonce_user_fields'] )
		|| ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wp_debug_nonce_user_fields'] ) ), 'wp_debug_check_nonce' )
		) {
			exit;
		}

		if ( ! empty( $_POST['gmail'] ) ) {
			update_user_meta( $user_id, 'gmail', sanitize_email( wp_unslash( $_POST['gmail'] ) ) );
		} else {
			delete_user_meta( $user_id, 'gmail' );
		}
		if ( ! empty( $_POST['twitter'] ) ) {
			update_user_meta( $user_id, 'twitter', sanitize_text_field( wp_unslash( $_POST['twitter'] ) ) );
		} else {
			delete_user_meta( $user_id, 'twitter' );
		}
		if ( ! empty( $_POST['tiktok'] ) ) {
			update_user_meta( $user_id, 'tiktok', sanitize_text_field( wp_unslash( $_POST['tiktok'] ) ) );
		} else {
			delete_user_meta( $user_id, 'tiktok' );
		}
	}

}
if ( is_network_admin() ) {
	return;
}
return new Wp_Debug_Users();
