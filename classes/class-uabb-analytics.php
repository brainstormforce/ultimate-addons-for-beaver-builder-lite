<?php
/**
 * UABB Analytics.
 *
 * @package UABB
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'UABB_Analytics' ) ) {

	/**
	 * Class UABB_Analytics
	 *
	 * Handles analytics-related functionality for the Ultimate Addons for Beaver Builder Lite plugin.
	 *
	 * @since 1.6.7
	 */
	class UABB_Analytics {

		/**
		 * UABB Analytics constructor.
		 *
		 * Initializing UABB Analytics.
		 *
		 * @since 1.6.7
		 * @access public
		 */
		public function __construct() {

			// BSF Analytics Tracker.
			if ( ! class_exists( 'BSF_Analytics_Loader' ) ) {
				require_once BB_ULTIMATE_ADDON_DIR . 'admin/bsf-analytics/class-bsf-analytics-loader.php';
			}

			$bsf_analytics = BSF_Analytics_Loader::get_instance();

			$bsf_analytics->set_entity(
				array(
					'uabb' => array(
						'product_name'        => 'Ultimate Addons for Beaver Builder Lite',
						'path'                => BB_ULTIMATE_ADDON_DIR . 'admin/bsf-analytics',
						'author'              => 'Brainstorm Force',
						'time_to_display'     => '+24 hours',
						'deactivation_survey' => array(
							array(
								'id'                => 'deactivation-survey-ultimate-addons-for-beaver-builder-lite',
								'popup_logo'        => BB_ULTIMATE_ADDON_URL . 'assets/images/uabb_notice.svg',
								'plugin_slug'       => 'ultimate-addons-for-beaver-builder-lite',
								'plugin_version'    => BB_ULTIMATE_ADDON_LITE_VERSION,
								'popup_title'       => 'Quick Feedback',
								'support_url'       => 'https://www.ultimatebeaver.com/contact/',
								'popup_description' => 'If you have a moment, please share why you are deactivating Ultimate Addons for Beaver Builder Lite:',
								'show_on_screens'   => array( 'plugins' ),
							),
						),
						'hide_optin_checkbox' => true,
					),
				)
			);

			add_filter( 'bsf_core_stats', array( $this, 'add_uabb_analytics_data' ) );
			$this->add_uabb_analytics_data([]);
		}

		/**
		 * Callback function to add specific analytics data.
		 *
		 * @param array $stats_data Existing stats data.
		 * @return array
		 */
		public function add_uabb_analytics_data( $stats_data ) {

			$stats_data['plugin_data']['uabb'] = array(
				'lite_version'          => BB_ULTIMATE_ADDON_LITE_VERSION,
				'site_language'         => get_locale(),
				'beaverbuilder_version' => defined( 'FL_BUILDER_VERSION' ) ? FL_BUILDER_VERSION : '',
			);

			$fetch_uabb_data = $this->uabb_get_module_usage();

			foreach ( $fetch_uabb_data as $key => $value ) {
				$stats_data['plugin_data']['uabb']['numeric_values'][ $key ] = $value;
			}
			return $stats_data;
		}

		/**
		 * Fetch module usage data.
		 *
		 * @return array
		 */
		private function uabb_get_module_usage() {
			return get_option( 'uabblite_module_usage_data_option', array() );
		}
	}
}

new UABB_Analytics();