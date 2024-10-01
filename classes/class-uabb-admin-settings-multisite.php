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
	public static function init() {
		add_action( 'admin_init', __CLASS__ . '::admin_init' );
		add_action( 'admin_init', __CLASS__ . '::uabb_lite_redirect_on_activation' );
		add_action( 'network_admin_menu', __CLASS__ . '::menu' );
	}

	/**
	 * Sets the activate redirect url to the network admin settings.
	 *
	 * @since 1.0
	 * @param string $url gets the activate redirect URL.
	 * @return void
	 */
	public static function uabb_lite_redirect_on_activation( $url ) {
		if ( true === get_option( 'uabb_lite_redirect' ) ) {
			update_option( 'uabb_lite_redirect', false );
			if ( ! is_multisite() ) :
				wp_redirect( admin_url( 'options-general.php?page=uabb-builder-settings#uabb-welcome' ) );
				exit();
			endif;
		}
	}

	/**
	 * Save network admin settings and enqueue scripts.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function admin_init() {
		if ( is_network_admin() && isset( $_REQUEST['page'] ) && 'uabb-builder-multisite-settings' === $_REQUEST['page'] ) {
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
	public static function menu() {
		$title = UABB_PREFIX; // FLBuilderModel::get_branding();.
		$cap   = 'manage_network_plugins';
		$slug  = 'uabb-builder-multisite-settings';
		$func  = 'UABBBuilderAdminSettings::render';

		add_submenu_page( 'settings.php', $title, $title, $cap, $slug, $func );
	}
}

UABBBuilderMultisiteSettings::init();
