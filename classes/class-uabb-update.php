<?php
/**
 * Update and backward compatibility.
 *
 * @since 1.2.4
 * @package Update and Backward
 */

if ( ! class_exists( 'UABB_lite_Plugin_Update' ) ) {

	/**
	 * UABB_Plugin_Update initial setup
	 *
	 * @since 1.2.4
	 */
	class UABB_lite_Plugin_Update { // @codingStandardsIgnoreLine.

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var Class $instance instance.
		 */
		private static $instance;

		/**
		 *  Constructor
		 */
		public function __construct() {

			// UABB Updates.
			add_action( 'init', self::class . '::init' );
		}

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Implement UABB update logic.
		 *
		 * @since 1.2.4
		 * @return void
		 */
		public static function init(): void {

			// Get saved version number.
			$saved_version = get_option( '_uabb_lite_saved_version', '0' );

			$version = '1.2.4';
			if ( (int) $version < (int) BB_ULTIMATE_ADDON_LITE_VERSION ) {
				update_option( '_uabb_lite_1_2_4_ver', 'yes' );
			}

			// If matches the current version then skip the next steps.
			if ( version_compare( $saved_version, BB_ULTIMATE_ADDON_LITE_VERSION, '=' ) ) {
				return;
			}

			$old_jrn_details = get_option( '_uabb_lite_journey_details', '0' );

			if ( $old_jrn_details === '0' ) {
				$old_jrn_details = [];
			}

			$new_jrn_details = [
				'previous_version' => $saved_version,
				'current_version'  => BB_ULTIMATE_ADDON_LITE_VERSION,
			];

			array_push( $old_jrn_details, $new_jrn_details );

			update_option( '_uabb_lite_journey_details', $old_jrn_details );

			do_action( 'uabb_update_version_before' );
			// Update saved version number.
			update_option( '_uabb_lite_saved_version', BB_ULTIMATE_ADDON_LITE_VERSION );

			// Flush the rewrite rules.
			flush_rewrite_rules();

			do_action( 'uabb_update_version_after' );
		}
	}
}// End if().
UABB_lite_Plugin_Update::get_instance();
