<?php

/**
 * Network admin settings for the page builder.
 *
 * @since 1.0
 */
final class UABBBuilderMultisiteSettings {

	/**
	 * Initializes the network admin settings page for multisite installs.
	 *
	 * @since 1.0
	 * @return void
	 */
	static public function init()
	{
		add_action( 'admin_init', __CLASS__ . '::admin_init' );
		add_action( 'admin_init', __CLASS__ . '::uabb_lite_redirect_on_activation' );
		add_action( 'network_admin_menu',                __CLASS__ . '::menu' );
	}

	/**
	 * Redirects to UABB Lite Welcome page on activation
	 *
	 * @since 1.0
	 * @return null
	 */
	static public function uabb_lite_redirect_on_activation( $url )
	{
		if( get_option( 'uabb_lite_redirect' ) == true ) {
			update_option( 'uabb_lite_redirect', false );
			if( !is_multisite() ) :
				wp_redirect( admin_url( 'options-general.php?page=uabb-builder-settings#uabb-welcome' ) );
				exit();
			endif;
		}
	}

	/**
	 * Save network admin settings and enqueue scripts.
	 *
	 * @since 1.8
	 * @return void
	 */
	static public function admin_init()
	{
		if ( is_network_admin() && isset( $_REQUEST['page'] ) && $_REQUEST['page'] == 'uabb-builder-multisite-settings' ) {
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
	static public function menu()
	{
		$title = UABB_PREFIX; // FLBuilderModel::get_branding();
		$cap   = 'manage_network_plugins';
		$slug  = 'uabb-builder-multisite-settings';
		$func  = 'UABBBuilderAdminSettings::render';
		
		add_submenu_page( 'settings.php', $title, $title, $cap, $slug, $func );
	}
}

UABBBuilderMultisiteSettings::init();
