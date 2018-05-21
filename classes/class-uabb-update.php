<?php
/**
 * Update and backward compatibility. 
 *
 * @since 1.3.0
 */

if ( ! class_exists( 'UABB_Plugin_Update' ) ) {

	/**
	 * UABB_Plugin_Update initial setup
	 *
	 * @since 1.3.0
	 */
	class UABB_Plugin_Update {

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;

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
		 *  Constructor
		 */
		public function __construct() {

			// UABB Updates.
			add_action( 'init', __CLASS__ . '::init' );

		}

		/**
		 * Implement UABB update logic.
		 *
		 * @since 1.3.0
		 * @return void
		 */
		static public function init() {

			// Get saved version number.
			$saved_version = get_option( '_uabb_saved_version', '0' );

			if( '0' === $saved_version ) {
				update_option( '_uabb_1_7_2_ver', 'yes' );
			}

			// If matches the current version then skip the next steps.
			if ( version_compare( $saved_version, BB_ULTIMATE_ADDON_LITE_VERSION, '=' ) ) {
				return;
			}


			$old_jrn_details = get_option( '_journey_details', '0' );
			
			if( $old_jrn_details == '0' ) {
				$old_jrn_details = array();
			}

			$new_jrn_details = array( 'previous_version' => $saved_version, 'current_version' => BB_ULTIMATE_ADDON_LITE_VERSION );


			array_push( $old_jrn_details, $new_jrn_details );

			update_option( '_journey_details', $old_jrn_details );
			
			do_action( 'uabb_update_version_before' );
			// Update saved version number.
			update_option( '_uabb_saved_version', BB_ULTIMATE_ADDON_LITE_VERSION );

			// Flush the rewrite rules.
			flush_rewrite_rules();

			do_action( 'uabb_update_version_after' );
		}
	}
}// End if().
UABB_Plugin_Update::get_instance();