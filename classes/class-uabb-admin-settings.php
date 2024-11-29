<?php
/**
 * Handles logic for the admin settings page.
 *
 * @since 1.0
 * @package UABB Admin Settings.
 */

/**
 * This class initializes UABB Builder Admin Settings
 *
 * @class UABBBuilderAdminSettings
 */
final class UABBBuilderAdminSettings {
	/**
	 * Holds any errors that may arise from
	 * saving admin settings.
	 *
	 * @since 1.0
	 * @var array $errors
	 */
	public static $errors = [];

	/**
	 * Initializes the admin settings.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function init(): void {
		add_action( 'after_setup_theme', self::class . '::init_hooks' );
	}

	/**
	 * Adds the admin menu and enqueues CSS/JS if we are on
	 * the builder admin settings page.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function init_hooks(): void {
		if ( ! is_admin() ) {
			return;
		}

		add_action( 'network_admin_menu', self::class . '::menu' );
		add_action( 'admin_menu', self::class . '::menu' );

		if ( isset( $_REQUEST['page'] ) && $_REQUEST['page'] === 'uabb-builder-settings' ) {
			add_action( 'admin_enqueue_scripts', self::class . '::styles_scripts' );
			self::save();
		}
		add_action( 'admin_notices', self::class . '::register_notices' );
		add_filter( 'wp_kses_allowed_html', self::class . '::add_data_attributes', 10, 2 );
		add_action( 'admin_enqueue_scripts', self::class . '::notice_styles_scripts' );
	}
	/**
	 * Enqueues the needed CSS/JS for the builder's admin settings page.
	 *
	 * @since 1.3.0
	 * @return void
	 */
	public static function notice_styles_scripts(): void {
		// Styles.
		wp_enqueue_style( 'uabb-notice-settings', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-admin-notice.css', [] );
	}
	/**
	 * Filters and Returns a list of allowed tags and attributes for a given context.
	 *
	 * @param Array  $allowedposttags Array of allowed tags.
	 * @param String $context Context type (explicit).
	 * @since 1.3.0
	 * @return Array
	 */
	public static function add_data_attributes( $allowedposttags, $context ) {
		$allowedposttags['a']['data-repeat-notice-after'] = true;

		return $allowedposttags;
	}
	/**
	 * Ask Plugin Rating
	 *
	 * @since 1.3.0
	 * @return void
	 */
	public static function register_notices(): void {

		$image_path = BB_ULTIMATE_ADDON_URL . 'assets/images/uabb_notice.svg';

		Astra_Notices::add_notice(
			[
				'id'                         => 'uabb-admin-rating',
				'type'                       => '',
				'message'                    => sprintf(
					'<div class="notice-image">
						<img src="%1$s" class="custom-logo" alt="Ultimate Addon for Beaver Builder" itemprop="logo"></div>
						<div class="notice-content">
							<div class="notice-heading">
								%2$s
							</div>
							%3$s<br />
							<div class="uabb-review-notice-container">
								<a href="%4$s" class="astra-notice-close uabb-review-notice button-primary" target="_blank">
								%5$s
								</a>
							<span class="dashicons dashicons-calendar"></span>
								<a href="#" data-repeat-notice-after="%6$s" class="astra-notice-close uabb-review-notice">
								%7$s
								</a>
							<span class="dashicons dashicons-smiley"></span>
								<a href="#" class="astra-notice-close uabb-review-notice">
								%8$s
								</a>
							</div>
						</div>',
					$image_path,
					__( 'Hello! Thank you for choosing the Ultimate Addon for Beaver Builder to build this website!', 'ultimate-addon-for-beaver-builder', 'uabb' ),
					__( 'Would you please mind sharing your views and give it a 5 star rating on the WordPress repository?', 'ultimate-addon-for-beaver-builder', 'uabb' ),
					'https://wordpress.org/support/plugin/ultimate-addons-for-beaver-builder-lite/reviews/?filter=5',
					__( 'Ok, you deserve it', 'ultimate-addon-for-beaver-builder', 'uabb' ),
					MONTH_IN_SECONDS,
					__( 'Nope, maybe later', 'ultimate-addon-for-beaver-builder', 'uabb' ),
					__( 'I already did', 'ultimate-addon-for-beaver-builder', 'uabb' )
				),
				'repeat-notice-after'        => MONTH_IN_SECONDS,
				'display-notice-after'       => 2 * WEEK_IN_SECONDS, // Display notice after 2 weeks.
				'priority'                   => 25,
				'display-with-other-notices' => false,
			]
		);
	}
	/**
	 * Renders the admin settings menu.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function menu(): void {
		if ( current_user_can( 'delete_users' ) ) {

			$title = UABB_PREFIX;
			$cap   = 'delete_users';
			$slug  = 'uabb-builder-settings';
			$func  = self::class . '::render';
			add_submenu_page( 'options-general.php', $title, $title, $cap, $slug, $func );
		}
	}

	/**
	 * Enqueues the needed CSS/JS for the builder's admin settings page.
	 *
	 * @since 1.0
	 * @param hook $hook get the hooks for the styles.
	 * @return void
	 */
	public static function styles_scripts( $hook ): void {
		wp_register_style( 'uabb-admin-css', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-admin.css', [] );
		wp_register_script( 'uabb-admin-js', BB_ULTIMATE_ADDON_URL . 'assets/js/uabb-admin.js', [ 'jquery' ], '', true );
		wp_localize_script(
			'uabb-admin-js',
			'uabb',
			[
				'ajax_url'          => admin_url( 'admin-ajax.php' ),
				'reload-icon-nonce' => wp_create_nonce( 'uabb-reload-icons' ),
			]
		);

		// Load AJAX script only on Builder UI Panel.
		wp_register_script( 'uabb-lazyload', BB_ULTIMATE_ADDON_URL . 'assets/js/jquery.lazyload.min.js', [ 'jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-tabs' ], null, true );
		wp_register_script( 'uabb-cloud-templates-shuffle', BB_ULTIMATE_ADDON_URL . 'assets/js/jquery.shuffle.min.js', [ 'jquery' ], null, true );
		wp_register_script( 'uabb-cloud-templates', BB_ULTIMATE_ADDON_URL . 'assets/js/uabb-cloud-templates.js', [ 'jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-tabs', 'uabb-lazyload', 'uabb-cloud-templates-shuffle' ], null, true );
		wp_enqueue_script( 'uabb-admin-menu-js', BB_ULTIMATE_ADDON_URL . 'assets/js/uabb-admin-menu.js' );
		wp_register_style( 'uabb-admin-menu-css', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-admin-menu.css' );

		$UABBCloudTemplates = [ // @codingStandardsIgnoreLine.
			'ajaxurl'                => admin_url( 'admin-ajax.php' ),
			'uabb_cloud_nonce'       => wp_create_nonce( 'uabb_cloud_nonce' ),
			'errorMessage'           => __( 'Something went wrong!', 'uabb' ),
			'successMessage'         => __( 'Complete', 'uabb' ),
			'successMessageFetch'    => __( 'Refreshed!', 'uabb' ),
			'errorMessageTryAgain'   => __( 'Try Again!', 'uabb' ),
			'successMessageDownload' => __( 'Installed!', 'uabb' ),
			'btnTextRemove'          => __( 'Remove', 'uabb' ),
			'btnTextDownload'        => __( 'Install', 'uabb' ),
			'btnTextInstall'         => __( 'Installed', 'uabb' ),
			'successMessageRemove'   => __( 'Removed!', 'uabb' ),
		]; // @codingStandardsIgnoreLine.
		wp_localize_script( 'uabb-cloud-templates', 'UABBCloudTemplates', $UABBCloudTemplates ); // @codingStandardsIgnoreLine.

		if ( $hook === 'settings_page_uabb-builder-settings' || $hook === 'settings_page_uabb-builder-multisite-settings' ) {

			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'uabb-admin-css' );
			wp_enqueue_script( 'uabb-admin-js' );
			wp_enqueue_script( 'uabb-cloud-templates' );
			wp_enqueue_script( 'uabb-lazyload' );

			wp_enqueue_script( 'uabb-cloud-templates' );
			wp_enqueue_script( 'uabb-lazyload' );

			wp_enqueue_style( 'uabb-admin-menu-css' );

			wp_enqueue_media();

			// Added ThickBox support.
			add_thickbox();

			/** BB Admin CSS */
			wp_enqueue_style( 'fl-builder-admin-settings' );
		}
	}

	/**
	 * Renders the admin settings.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function render(): void {
		include BB_ULTIMATE_ADDON_DIR . 'includes/admin-settings.php';
	}

	/**
	 * Renders the page class for network installs and single site installs.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function render_page_class(): void {
		if ( self::multisite_support() ) {
			echo 'fl-settings-network-admin';
		} else {
			echo 'fl-settings-single-install';
		}
	}

	/**
	 * Renders the admin settings page heading.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function render_page_heading(): void {

		if ( ! empty( $icon ) ) {
			echo '<img src="' . esc_url( $icon ) . '" />';
		}

		echo '<span>' . sprintf( _x( '%s Settings', '%s stands for custom branded "UABB" name.', 'uabb' ), UABB_PREFIX ) . '</span>'; // @codingStandardsIgnoreLine.
	}

	/**
	 * Renders the update message.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function render_update_message(): void {
		if ( ! empty( self::$errors ) ) {
			foreach ( self::$errors as $message ) {
				echo wp_kses(
					'<div class="error"><p>' . $message . '</p></div>',
					[
						'div' => [
							'class' => [],
						],
						'p'   => [],
					]
				);
			}
		} elseif ( ! empty( $_POST ) && ! isset( $_POST['email'] ) ) {
			echo wp_kses(
				'<div class="updated"><p>' . __( 'Settings updated!', 'uabb' ) . '</p></div>',
				[
					'div' => [
						'class' => [],
					],
					'p'   => [],
				]
			);
		}
	}

	/**
	 * Renders the nav items for the admin settings menu.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function render_nav_items(): void {
		$items['uabb-welcome'] = [
			'title'    => __( 'Welcome', 'uabb' ),
			'show'     => ! is_network_admin() || ! FLBuilderAdminSettings::multisite_support(),
			'priority' => 504,
		];

		if ( ! class_exists( 'FLBuilderUIContentPanel' ) ) {
			$items['uabb'] = [
				'title'    => __( 'General Settings', 'uabb' ),
				'show'     => ! is_network_admin() || ! FLBuilderAdminSettings::multisite_support(),
				'priority' => 506,
			];
		}

		$items['uabb-modules'] = [
			'title'    => __( 'Modules', 'uabb' ),
			'show'     => is_network_admin() || ! FLBuilderAdminSettings::multisite_support(),
			'priority' => 507,
		];

		if ( BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-enable-template-cloud' ) ) {

			$items['uabb-cloud-templates'] = [
				'title'    => __( 'Template Cloud', 'uabb' ),
				'show'     => is_network_admin() || ! FLBuilderAdminSettings::multisite_support(),
				'priority' => 508,
			];
		}

		$items['uabb-icons'] = [
			'title'    => __( 'Font Icon Manager', 'uabb' ),
			'show'     => ! is_network_admin() || ! FLBuilderAdminSettings::multisite_support(),
			'priority' => 509,
		];

		$items['uabb-premium'] = [
			'title'    => __( 'Premium Features', 'uabb' ),
			'show'     => is_network_admin() || ! FLBuilderAdminSettings::multisite_support(),
			'priority' => 510,
		];

		$item_data = apply_filters( 'uabb_builder_admin_settings_nav_items', $items );

		$sorted_data = [];

		foreach ( $item_data as $key => $data ) {
			$data['key']                      = $key;
			$sorted_data[ $data['priority'] ] = $data;
		}

		ksort( $sorted_data );

		foreach ( $sorted_data as $data ) {
			if ( $data['show'] ) {
				echo '<li><a href="#' . esc_attr( $data['key'] ) . '">' . esc_html( $data['title'] ) . '</a></li>';
			}
		}
	}

	/**
	 * Renders the admin settings forms.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function render_forms(): void {
		self::render_form( 'welcome' );
		self::render_form( 'general' );
		self::render_form( 'modules' );
		self::render_form( 'icons' );
		self::render_form( 'template-cloud' );
		self::render_form( 'premium' );

		// Let extensions hook into form rendering.
		do_action( 'uabb_builder_admin_settings_render_forms' );
	}

	/**
	 * Renders an admin settings form based on the type specified.
	 *
	 * @since 1.0
	 * @param string $type The type of form to render.
	 * @return void
	 */
	public static function render_form( $type ): void {
		if ( self::has_support( $type ) ) {
			include BB_ULTIMATE_ADDON_DIR . 'includes/admin-settings-' . $type . '.php';
		}
	}

	/**
	 * Renders the action for a form.
	 *
	 * @since 1.0
	 * @param string $type The type of form being rendered.
	 * @return void
	 */
	public static function render_form_action( $type = '' ): void {
		if ( is_network_admin() ) {
			echo esc_url( network_admin_url( '/settings.php?page=uabb-builder-multisite-settings#' . $type ) );
		} else {
			echo esc_url( admin_url( '/options-general.php?page=uabb-builder-settings#' . $type ) );
		}
	}

	/**
	 * Returns the action for a form.
	 *
	 * @since 1.0
	 * @param string $type The type of form being rendered.
	 * @return string The URL for the form action.
	 */
	public static function get_form_action( $type = '' ) {
		if ( is_network_admin() ) {
			return network_admin_url( '/settings.php?page=uabb-builder-multisite-settings#' . $type );
		}
			return admin_url( '/options-general.php?page=uabb-builder-settings#' . $type );

	}

	/**
	 * Checks to see if a settings form is supported.
	 *
	 * @since 1.0
	 * @param string $type The type of form to check.
	 * @return bool
	 */
	public static function has_support( $type ) {
		return file_exists( BB_ULTIMATE_ADDON_DIR . 'includes/admin-settings-' . $type . '.php' );
	}

	/**
	 * Checks to see if multisite is supported.
	 *
	 * @since 1.0
	 * @return bool
	 */
	public static function multisite_support() {
		return is_multisite() && class_exists( 'FLBuilderMultisiteSettings' );
	}

	/**
	 * Adds an error message to be rendered.
	 *
	 * @since 1.0
	 * @param string $message The error message to add.
	 * @return void
	 */
	public static function add_error( $message ): void {
		self::$errors[] = $message;
	}

	/**
	 * Saves the admin settings.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function save(): void {
		// Only admins can save settings.
		if ( ! current_user_can( 'delete_users' ) ) {
			return;
		}

		if ( isset( $_POST['fl-uabb-nonce'] ) && wp_verify_nonce( $_POST['fl-uabb-nonce'], 'uabb' ) ) {

			$uabb['load_panels']    = false;
			$uabb['load_templates'] = false;
			/*$uabb['uabb-colorpicker']   = false;*/
			$uabb['uabb-live-preview'] = false;

			if ( isset( $_POST['uabb-enabled-panels'] ) ) {
				$uabb['load_panels'] = true;
            }
			if ( isset( $_POST['uabb-live-preview'] ) ) {
				$uabb['uabb-live-preview'] = true;
            }
			if ( isset( $_POST['uabb-load-templates'] ) ) {
				$uabb['load_templates'] = true;
            }

			FLBuilderModel::update_admin_settings_option( '_fl_builder_uabb', $uabb, false );
		}

		if ( isset( $_POST['fl-uabb-modules-nonce'] ) && wp_verify_nonce( $_POST['fl-uabb-modules-nonce'], 'uabb-modules' ) ) {
			$modules = [];

			$modules_array = BB_Ultimate_Addon_Helper::get_all_modules();

			if ( isset( $_POST['uabb-modules'] ) && is_array( $_POST['uabb-modules'] ) ) {

				$modules = array_map( 'sanitize_text_field', $_POST['uabb-modules'] );

				foreach ( $modules_array as $key => $value ) {
					if ( ! array_key_exists( $key, $modules ) ) {
						$modules[ $key ] = 'false';
					}
				}
			} else {
				$modules = [ 'unset_all' => 'unset_all' ];
			}

			FLBuilderModel::update_admin_settings_option( '_fl_builder_uabb_modules', $modules, false );
		}

		/**
		 *  For Performance
		 *  Update UABB static object from database.
		 */
		UABB_Init::set_uabb_options();

		// Clear all asset cache.
		FLBuilderModel::delete_asset_cache_for_all_posts();
	}
}

UABBBuilderAdminSettings::init();
