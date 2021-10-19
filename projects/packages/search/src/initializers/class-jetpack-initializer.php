<?php
/**
 * Search initializer for the Jetpack plugin.
 *
 * @package    @automattic/jetpack-search
 */

namespace Automattic\Jetpack\Search;

/**
 * Initializer for the main Jetpack plugin.
 * Instantiate this initializer to enable Jetpack Search functionality.
 */
class Jetpack_Initializer extends Initializer {
	/**
	 * Initializes Instant or Classic Search experiences.
	 */
	public static function initialize() {
		// TODO: Port the search widget to package.
		require_once JETPACK__PLUGIN_DIR . 'modules/widgets/search.php';

		if ( Options::is_instant_enabled() ) {
			// TODO: Port this class to the package.
			require_once JETPACK__PLUGIN_DIR . 'modules/search/class-jetpack-search-settings.php';
			new \Jetpack_Search_Settings();

			require_once JETPACK__PLUGIN_DIR . 'modules/search/class-jetpack-search-customberg.php';
			\Automattic\Jetpack\Search\Jetpack_Search_Customberg::instance();

			if ( class_exists( 'WP_Customize_Manager' ) ) {
				// TODO: Port this class to the package.
				require_once JETPACK__PLUGIN_DIR . 'modules/search/class-jetpack-search-customize.php';
				new \Jetpack_Search_Customize();
			}
			Instant_Search::instance();
		} else {
			Classic_Search::instance();
		}
	}
}
