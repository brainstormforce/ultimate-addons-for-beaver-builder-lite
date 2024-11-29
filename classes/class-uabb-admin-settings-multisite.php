<?php
/**
 * Network admin settings for the page builder.
 *
 * @since 1.0
 * @package Network Admin Settings
 */

/**
 * This class initializes UABB Builder Multisite Settings
 *
 * @class UABBBuilderMultisiteSettings
 */
final class UABBBuilderMultisiteSettings {
	/**
	 * Initializes the network admin settings page for multisite installs.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function init(): void {
		add_action( 'admin_init', self::class . '::admin_init' );
		add_action( 'admin_init', self::class . '::uabb_lite_redirect_on_activation' );
		add_action( 'network_admin_menu', self::class . '::menu' );
	}

	/**
	 * Sets the activate redirect url to the network admin settings.
	 *
	 * @since 1.0
	 * @param string $url gets the activate redirect URL.
	 * @return void
	 */
	public static function uabb_lite_redirect_on_activation( $url ): void {
		if ( get_option( 'uabb_lite_redirect' ) === true ) {
			update_option( 'uabb_lite_redirect', false );
			if ( ! is_multisite() ) {
				wp_redirect( admin_url( 'options-general.php?page=uabb-builder-settings#uabb-welcome' ) );
				exit;
			}
		}
	}

	/**
	 * Save network admin settings and enqueue scripts.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function admin_init(): void {
		if ( is_network_admin() && isset( $_REQUEST['page'] ) && $_REQUEST['page'] === 'uabb-builder-multisite-settings' ) {
			add_action( 'admin_enqueue_scripts', 'UABBBuilderAdminSettings::styles_scripts' );
			UABBBuilderAdminSettings::save();
		}
	}

	/**
	 * Renders the network admin menu for multisite installs.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function menu(): void {
		$title = UABB_PREFIX; // FLBuilderModel::get_branding();.
		$cap   = 'manage_network_plugins';
		$slug  = 'uabb-builder-multisite-settings';
		$func  = 'UABBBuilderAdminSettings::render';

		add_submenu_page( 'settings.php', $title, $title, $cap, $slug, $func );
	}
}

UABBBuilderMultisiteSettings::init();
