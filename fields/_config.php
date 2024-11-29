<?php // @codingStandardsIgnoreLine.
/**
 *  Custom Fields Config File
 *
 *  @package UABB_Custom_Field_Scripts
 */

require_once 'uabb-gradient/uabb-gradient.php';

if ( ! class_exists( 'UABB_Custom_Field_Scripts' ) ) {
	/**
	 * Class to enqueue field scripts
	 *
	 * @package  UABB_Custom_Field_Scripts
	 */
	class UABB_Custom_Field_Scripts {
		/**
		 * Constructor that initializes custom field scripts
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', [ $this, 'custom_field_scripts' ] );
		}

		/**
		 * Function that enqueue styles and scripts
		 *
		 * @since 1.0
		 * @return void
		 */
		public function custom_field_scripts(): void {
			if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {

				/* uabb-gradient field */
				wp_enqueue_style( 'uabb-gradient', BB_ULTIMATE_ADDON_URL . 'fields/uabb-gradient/css/uabb-gradient.css', [], '' );
				wp_enqueue_script( 'uabb-gradient', BB_ULTIMATE_ADDON_URL . 'fields/uabb-gradient/js/uabb-gradient.js', [], '', true );
			}
		}
	}

	$UABB_Custom_Field_Scripts = new UABB_Custom_Field_Scripts(); // @codingStandardsIgnoreLine.
}
