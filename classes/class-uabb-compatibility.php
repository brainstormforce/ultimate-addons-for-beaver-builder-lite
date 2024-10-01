<?php
/**
 * Backward compatibility.
 *
 * @since 1.3.0
 * @package BB Version Check
 */

if ( ! class_exists( 'UABB_Lite_Compatibility' ) ) {

	if ( ! defined( 'FL_BUILDER_VERSION' ) ) {
		define( 'FL_BUILDER_VERSION', '' );
	}

	/**
	 * UABB_Plugin_Backward initial setup
	 *
	 * @since 1.3.0
	 */
	class UABB_Lite_Compatibility {

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;

		/**
		 * Holds BB current version.
		 *
		 * @since 1.3.0
		 * @var $version_bb_check
		 */
		public static $version_bb_check;

		/**
		 * Holds uabb migration status.
		 *
		 * @since 1.3.0
		 * @var $uabb_migration
		 */
		public static $uabb_migration;

		/**
		 * Holds BB new page status.
		 *
		 * @since 1.3.0
		 * @var $stable_version_new_page
		 */
		public static $stable_version_new_page;

		/**
		 * Initiator
		 *
		 * @return self
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Check the BB's New version.
		 *
		 * @since 1.3.0
		 * @return bool self::$version_bb_check
		 */
		public static function check_bb_version() {

			if ( null === self::$version_bb_check ) {

				$bb_builder_version = substr_replace( FL_BUILDER_VERSION, '', strpos( FL_BUILDER_VERSION, '-' ) );

				if ( '' !== $bb_builder_version ) {
					self::$version_bb_check = version_compare( $bb_builder_version, '2.2', '>=' );
				} else {
					self::$version_bb_check = version_compare( FL_BUILDER_VERSION, '2.2', '>=' );
				}
			}

			return self::$version_bb_check;
		}

		/**
		 * Check if the page is created before UABB version 1.6.9 and is successfully migrated in between version 1.7.0 - version 1.13.2
		 *
		 * @since 1.3.0
		 * @return string self::$uabb_migration
		 */
		public static function check_old_page_migration() {

			if ( null === self::$uabb_migration ) {

				$post_id = get_the_ID();

				self::$uabb_migration = get_post_meta( $post_id, '_uabb_lite_converted', true );
			}

			return self::$uabb_migration;
		}

		/**
		 * Check if the page is created in between UABB version 1.7.0 - version 1.13.2
		 *
		 * @since 1.3.0
		 * @return string self::$stable_version_new_page
		 */
		public static function check_stable_version_new_page() {

			if ( null === self::$stable_version_new_page ) {

				$post_id = get_the_ID();

				self::$stable_version_new_page = get_post_meta( $post_id, '_uabb_lite_version', true );

				if ( '' !== self::$stable_version_new_page ) {
					self::$stable_version_new_page = 'yes';
					return self::$stable_version_new_page;
				}
			}

			return self::$stable_version_new_page;
		}
	}
}

UABB_Lite_Compatibility::get_instance();
