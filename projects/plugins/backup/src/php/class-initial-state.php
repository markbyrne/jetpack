<?php
/**
 * The React initial state.
 *
 * @package automattic/jetpack-backup-plugin
 */

use Automattic\Jetpack\Status;

/**
 * The React initial state.
 */
class Initial_State {
	/**
	 * Get the initial state data.
	 *
	 * @return array
	 */
	private function get_data() {
		return array(
			'API'           => array(
				'WP_API_root'       => esc_url_raw( rest_url() ),
				'WP_API_nonce'      => wp_create_nonce( 'wp_rest' ),
				'registrationNonce' => wp_create_nonce( 'jetpack-registration-nonce' ),
			),
			'jetpackStatus' => array(
				'calypsoSlug' => ( new Status() )->get_site_suffix(),
			),
			'assets'        => array(
				'buildUrl' => plugins_url( 'build/', JETPACK_BACKUP_PLUGIN_ROOT_FILE ),
			),
		);
	}

	/**
	 * Render the initial state into a JavaScript variable.
	 *
	 * @return string
	 */
	public function render() {
		add_action( 'jetpack_use_iframe_authorization_flow', '__return_true' );

		return 'var JPBACKUP_INITIAL_STATE=JSON.parse(decodeURIComponent("' . rawurlencode( wp_json_encode( $this->get_data() ) ) . '"));';
	}

}
