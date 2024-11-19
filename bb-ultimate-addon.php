<?php
/**
 * Plugin Name: Ultimate Addons for Beaver Builder - Lite
 * Plugin URI: http://www.ultimatebeaver.com/
 * Description: Ultimate Addons is a free extension for Beaver Builder that adds 10 modules, and works on top of any Beaver Builder Package. (Free, Standard, Pro & Agency) You can use it with on any WordPress theme.
 * Version: 1.5.13
 * Author: Brainstorm Force
 * Author URI: http://www.brainstormforce.com
 * Text Domain: uabb
 *
 * @package Ultimate Addons For Beaver Builder
 */

/**
 * Custom modules
 */
if ( ! class_exists( 'BB_Ultimate_Addon' ) ) {

	define( 'BB_ULTIMATE_ADDON_DIR', plugin_dir_path( __FILE__ ) );
	define( 'BB_ULTIMATE_ADDON_URL', plugins_url( '/', __FILE__ ) );
	define( 'BB_ULTIMATE_ADDON_LITE_VERSION', '1.5.13' );
	define( 'BSF_REMOVE_UABB_FROM_REGISTRATION_LISTING', true );
	define( 'BB_ULTIMATE_ADDON_FILE', trailingslashit( dirname( __FILE__ ) ) . 'bb-ultimate-addon.php' );// @codingStandardsIgnoreLine.
	define( 'BB_ULTIMATE_ADDON_LITE', true );
	define( 'BB_ULTIMATE_ADDON_UPGRADE_URL', 'https://www.ultimatebeaver.com/pricing/?utm_source=uabb-dashboard&utm_campaign=uabblite_upgrade&utm_medium=upgrade-button' );
	define( 'BB_ULTIMATE_ADDON_FB_URL', 'https://www.brainstormforce.com/go/uabb-facebook-group/?utm_source=uabb-dashboard&utm_campaign=Lite&utm_medium=FB' );
	define( 'BB_ULTIMATE_ADDON_TWITTER_URL', 'https://twitter.com/WeBrainstorm' );

	/**
	 * This class initializes BB Ultiamte Addons
	 *
	 * @class BB_Ultimate_Addon
	 */
	class BB_Ultimate_Addon {

		/**
		 * Constructor function that initializes required actions and hooks
		 *
		 * @since 1.0
		 */
		public function __construct() {

			register_activation_hook( __FILE__, array( $this, 'activation_reset' ) );

			// UABB Initialize.
			require_once 'classes/class-uabb-init.php';
		}

		/**
		 * Function which resets the plugin activation if necessary memmory not found
		 *
		 * @Since 1.0
		 */
		public function activation_reset() {

			$no_memory = $this->check_memory_limit();

			if ( true === $no_memory && ! defined( 'WP_CLI' ) ) {

				$msg = sprintf( __( 'Unfortunately, plugin could not be activated as the memory allocated by your host has almost exhausted. UABB plugin recommends that your site should have 15M PHP memory remaining. <br/><br/>Please check <a target="_blank" href="https://www.ultimatebeaver.com/docs/increase-memory-limit-site/">this</a> article for solution or contact <a target="_blank" href="http://store.brainstormforce.com/support">support</a>.<br/><br/><a class="button button-primary" href="%s">Return to Plugins Page</a>', 'uabb' ), network_admin_url( 'plugins.php' ) ); // @codingStandardsIgnoreLine.

				deactivate_plugins( plugin_basename( __FILE__ ) );
				wp_die( esc_html( $msg ) );
			}

			delete_option( 'uabb_hide_branding' );

			// Force check graupi bundled products.
			update_site_option( 'bsf_force_check_extensions', true );
			update_option( 'uabb_lite_redirect', true );
		}

		/**
		 * Memory Limit function that checks for memory limit for the UABB plugin
		 *
		 * @Since 1.0
		 */
		public function check_memory_limit() {

			$memory_limit  = ini_get( 'memory_limit' );       // Total Memory.
			$peak_memory   = memory_get_peak_usage( true );   // Available Memory.
			$uabb_required = 14999999;                      // Required Memory for UABB.

			if ( '-1' !== $memory_limit ) {
				if ( preg_match( '/^(\d+)(.)$/', $memory_limit, $matches ) ) {

					switch ( $matches[2] ) {
						case 'K':
						case 'k':
							$memory_limit = $matches[1] * 1024;
							break;
						case 'M':
						case 'm':
							$memory_limit = $matches[1] * 1024 * 1024;
							break;
						case 'G':
						case 'g':
							$memory_limit = $matches[1] * 1024 * 1024 * 1024;
							break;
					}
				}

				if ( $memory_limit - $peak_memory <= $uabb_required ) {
					return true;
				} else {
					return false;
				}
			}
		}
	}

	new BB_Ultimate_Addon();
} else {
	if ( ! function_exists( 'uabb_lite_admin_notices' ) ) {
		/**
		 * Display an admin notice when two versions of Ultimate Addon for Beaver Builder are active.
		 */
		function uabb_lite_admin_notices() {
			$deactivate_url = admin_url( 'plugins.php' );
			if ( is_plugin_active_for_network( 'ultimate-addons-for-beaver-builder-lite/bb-ultimate-addon.php' ) ) {
				$deactivate_url = network_admin_url( 'plugins.php' );
			}
			$slug           = 'bb-ultimate-addon';
			$deactivate_url = add_query_arg(
				array(
					'action'        => 'deactivate',
					'plugin'        => rawurlencode( 'ultimate-addons-for-beaver-builder-lite/' . $slug . '.php' ),
					'plugin_status' => 'all',
					'paged'         => '1',
					'_wpnonce'      => wp_create_nonce( 'deactivate-plugin_ultimate-addons-for-beaver-builder-lite/' . $slug . '.php' ),
				),
				$deactivate_url
			);
			echo '<div class="notice notice-error"><p>';
			echo wp_kses(
				sprintf(
					// Translators: %s is the URL to deactivate one of the Ultimate Addon for Beaver Builder versions.
					__( "You currently have two versions of <strong>Ultimate Addon for Beaver Builder</strong> active on this site. Please <a href='%s'>deactivate one</a> before continuing.", 'uabb' ),
					$deactivate_url
				),
				array(
					'strong' => array(),
					'a'      => array(
						'href' => array(),
					),
				)
			);
			echo '</p></div>';
		}
		// Display admin notice for activating beaver builder.
		add_action( 'admin_notices', 'uabb_lite_admin_notices' );
		add_action( 'network_admin_notices', 'uabb_lite_admin_notices' );
	}
}
