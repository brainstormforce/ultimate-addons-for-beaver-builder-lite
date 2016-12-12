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
		add_action( 'admin_init',                        __CLASS__ . '::admin_init' );
		add_action( 'network_admin_menu',                __CLASS__ . '::menu' );
		// add_filter( 'fl_builder_activate_redirect_url',  __CLASS__ . '::activate_redirect_url' );
	}

	/**
	 * Sets the activate redirect url to the network admin settings.
	 *
	 * @since 1.8
	 * @return string
	 */
	static public function activate_redirect_url( $url )
	{
		if ( current_user_can( 'manage_network_plugins' ) ) {
			return network_admin_url( '/settings.php?page=uabb-builder-multisite-settings#license' );
		}
		
		return $url;
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
