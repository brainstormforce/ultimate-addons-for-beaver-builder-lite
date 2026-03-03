<?php
/**
 * UABB Abilities API Bootstrap.
 *
 * Registers all UABB abilities with the WordPress Abilities API (WP 6.9+).
 *
 * @since 1.6.8
 * @package UABB
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Bootstrap class for UABB Abilities API integration.
 *
 * @since 1.6.8
 */
class UABB_Abilities {

	/**
	 * The ability category slug.
	 *
	 * @since 1.6.8
	 * @var string
	 */
	const CATEGORY = 'uabb';

	/**
	 * Initialize abilities registration.
	 *
	 * @since 1.6.8
	 */
	public static function init() {
		add_action( 'wp_abilities_api_categories_init', array( __CLASS__, 'register_category' ) );
		add_action( 'wp_abilities_api_init', array( __CLASS__, 'register_abilities' ) );
	}

	/**
	 * Register the UABB ability category.
	 *
	 * @since 1.6.8
	 */
	public static function register_category() {
		wp_register_ability_category(
			self::CATEGORY,
			array(
				'label'       => __( 'Ultimate Addons for Beaver Builder', 'uabb' ),
				'description' => __( 'Manage UABB modules, settings, and templates.', 'uabb' ),
			)
		);
	}

	/**
	 * Load ability files and register all abilities.
	 *
	 * @since 1.6.8
	 */
	public static function register_abilities() {
		if ( ! class_exists( 'FLBuilder' ) ) {
			return;
		}

		require_once BB_ULTIMATE_ADDON_DIR . 'abilities/class-uabb-plugin-abilities.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'abilities/class-uabb-module-abilities.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'abilities/class-uabb-settings-abilities.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'abilities/class-uabb-template-abilities.php';

		UABB_Plugin_Abilities::register();
		UABB_Module_Abilities::register();
		UABB_Settings_Abilities::register();
		UABB_Template_Abilities::register();
	}
}
