<?php
/**
 * UABB initial setup
 *
 * @since 1.0
 * @package UABB Initial Setup
 */

/**
 * This class initializes UABB Init
 *
 * @class UABB_Init
 */
class UABB_Init {
	/**
	 * Variable for UABB opotions
	 *
	 * @var string $uabb_options
	 */
	public static $uabb_options;

	/**
	 *  Constructor
	 */
	public function __construct() {

		if ( class_exists( 'FLBuilder' ) ) {

			/**
			 *  For Performance
			 *  Set UABB static object to store data from database.
			 */
			self::set_uabb_options();

			add_filter( 'fl_builder_settings_form_defaults', array( $this, 'uabb_global_settings_form_defaults' ), 10, 2 );
			// Load all the required files of bb-ultimate-addon.
			self::includes();
			
		} else {

			// disable UABB activation ntices in admin panel.
			define( 'BSF_UABB_NOTICES', false );

			// Display admin notice for activating beaver builder.
			add_action( 'admin_notices', array( $this, 'admin_notices' ) );
			add_action( 'network_admin_notices', array( $this, 'admin_notices' ) );
		}
	}
	/**
	 * Function that renders links
	 *
	 * @since 1.0
	 * @param string $actions gets an link.
	 * @return string
	 */
	public function uabb_render_plugin_action_links( $actions ) {

		$actions[] = '<a href="' . BB_ULTIMATE_ADDON_UPGRADE_URL . '" style="color:#3db634;" title="Upgrade" target="_blank">' . _x( 'Upgrade', 'Plugin action link label.', 'uabb' ) . '</a>';

		return $actions;
	}

	/**
	 * Function that includes necessary files
	 *
	 * @since 1.0
	 * @return void
	 */
	public function includes() {

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-update.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-compatibility.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-backward.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-helper.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-cloud-templates.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-admin-settings.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-admin-settings-multisite.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'lib/astra-notices/class-astra-notices.php';

		/*
		* BSF Analytics Integration tracker.
		*/
		if ( ! class_exists( 'BSF_Analytics_Loader' ) ) {
			require_once BB_ULTIMATE_ADDON_DIR . 'admin/bsf-analytics/class-bsf-analytics-loader.php';
		
		add_action( 'admin_init', array( $this, 'uabb_lite_maybe_migrate_analytics_tracking' ) );

		$bsf_analytics = \BSF_Analytics_Loader::get_instance();

		$bsf_analytics->set_entity(
			array(
				'uabb' => array(
					'product_name'        => 'Ultimate Addons for Beaver Builder Lite',
					'path'                => BB_ULTIMATE_ADDON_DIR . 'admin/bsf-analytics',
					'author'              => 'Brainstorm Force',
					'time_to_display'     => '+24 hours',
						'deactivation_survey' => array( // UABB Lite Plugin deactivation survey key.
							array(
								'id'                => 'deactivation-survey-ultimate-addons-for-beaver-builder-lite', // 'deactivation-survey-<your-plugin-slug>'
								'popup_logo'        => BB_ULTIMATE_ADDON_URL . 'assets/images/uabb_notice.svg',
								'plugin_slug'       => 'ultimate-addons-for-beaver-builder-lite', // <your-plugin-slug>
								'plugin_version'    => BB_ULTIMATE_ADDON_LITE_VERSION,
								'popup_title'       => 'Quick Feedback',
								'support_url'       => 'https://www.ultimatebeaver.com/contact/',
								'popup_description' => 'If you have a moment, please share why you are deactivating Ultimate Addons for Beaver Builder Lite :',
								'show_on_screens'   => array( 'plugins' ),
							),
						),
						'hide_optin_checkbox' => true, // Hide the opt-in checkbox.
					),
				)
			);
		}
		
		add_action( 'init', function(){

			require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-global-settings.php';

			require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-functions.php';
			// Attachment Fields.
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-attachment.php';

			// fields.
			require_once BB_ULTIMATE_ADDON_DIR . 'fields/_config.php';

			require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-settings-form.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/helper.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-ui-panel.php';

			
			// Load the NPS Survey library.
			if ( ! class_exists( 'Uabb_Lite_Nps_Survey' ) ) {
				require_once BB_ULTIMATE_ADDON_DIR . 'lib/class-uabb-lite-nps-survey.php';
			}

			// Load the appropriate text-domain.
			$this->load_uabb_textdomain();
		}, 10 );

		add_action( 'init', array( $this, 'init' ), 40 );

		// Enqueue scripts.
		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ), 100 );

		$basename = plugin_basename( BB_ULTIMATE_ADDON_FILE );
		// Filters.
		add_filter( 'plugin_action_links_' . $basename, array( $this, 'uabb_render_plugin_action_links' ) );

	}

	/**
	 * Migrates analytics tracking option from 'bsf_analytics_optin' to 'uabb_usage_optin'.
	 *
	 * Checks if the old analytics tracking option ('bsf_analytics_optin') is set to 'yes'
	 * and if the new option ('uabb_usage_optin') is not already set.
	 * If so, updates the new tracking option to 'yes' to maintain user consent during migration.
	 *
	 * @since x.x.x
	 * @access public
	 *
	 * @return void
	 */
	public function uabb_lite_maybe_migrate_analytics_tracking() {
		$old_tracking = get_option( 'bsf_usage_optin', false );
		$new_tracking = get_option( 'uabb_usage_optin', false );
		if ( 'yes' === $old_tracking && false === $new_tracking ) {
			update_option( 'uabb_usage_optin', 'yes' );
			$time = get_option( 'bsf_usage_installed_time' );
			update_option( 'uabb_usage_installed_time', $time );
		}
	}

	/**
	 *   For Performance.
	 *   Set UABB static object to store data from database.
	 *
	 * @return void
	 */
	public static function set_uabb_options() {
		self::$uabb_options = array(
			'fl_builder_uabb'          => FLBuilderModel::get_admin_settings_option( '_fl_builder_uabb', true ),
			'fl_builder_uabb_branding' => FLBuilderModel::get_admin_settings_option( '_fl_builder_uabb_branding', false ),
			'uabb_global_settings'     => get_option( '_uabb_global_settings' ),

			'fl_builder_uabb_modules'  => FLBuilderModel::get_admin_settings_option( '_fl_builder_uabb_modules', false ),
		);
	}

	/**
	 * Function that renders UABB Global Settings form defaults
	 *
	 * @since 1.0
	 * @param array  $defaults gets the array for the form defaults.
	 * @param string $form_type gets an array to check the form type.
	 * @return array
	 */
	public function uabb_global_settings_form_defaults( $defaults, $form_type ) {

		if ( class_exists( 'FLCustomizer' ) && 'uabb-global' === $form_type ) {

			$defaults->enable_global = 'no';
		}

		return $defaults; // Must be returned!
	}

	/**
	 * Function that initializes init function
	 *
	 * @since 1.0
	 * @return void
	 */
	public function init() {

		if ( apply_filters( 'uabb_global_support', true ) && class_exists( 'FLBuilderAJAX' ) ) {
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-settings.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-integration.php';
		}

		if ( class_exists( 'FLCustomizer' ) ) {
			$uabb_global_style = UABB_Global_Styling::get_uabb_global_settings();

			if ( ( isset( $uabb_global_style->enable_global ) && ( 'no' === $uabb_global_style->enable_global ) ) ) {
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-bbtheme-global-integration.php';
			}
		}

		// wpml.
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-wpml.php';

		// Nested forms.
		require_once BB_ULTIMATE_ADDON_DIR . 'objects/fl-nested-form-button.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-iconfonts.php';
		// require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-model-helper.php';.
		// Ultimate Modules.
		$this->load_modules();
	}

	/**
	 * Function that renders UABB's Text-domain.
	 *
	 * @since 1.0
	 * @return bool
	 */
	public function load_uabb_textdomain() {
		// Default languages directory for "ultimate-addons-for-beaver-builder-lite".
		$lang_dir = BB_ULTIMATE_ADDON_DIR . 'languages/';

		/**
		 * Filters the languages directory path to use for AffiliateWP.
		 *
		 * @param string $lang_dir The languages directory path.
		 */
		$lang_dir = apply_filters( 'uabb_languages_directory', $lang_dir );

		// Traditional WordPress plugin locale filter.
		global $wp_version;

		$get_locale = get_locale();

		if ( $wp_version >= 4.7 ) {
			$get_locale = get_user_locale();
		}

		/**
		 * Language Locale for Ultimate BB
		 *
		 * @var $get_locale The locale to use. Uses get_user_locale()` in WordPress 4.7 or greater,
		 *                  otherwise uses `get_locale()`.
		 */
		$locale = apply_filters( 'plugin_locale', $get_locale, 'uabb' );
		$mofile = sprintf( '%1$s-%2$s.mo', 'uabb', $locale );

		// Setup paths to current locale file.
		$mofile_local  = $lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/ultimate-addons-for-beaver-builder-lite/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/ultimate-addons-for-beaver-builder-lite/ folder.
			load_textdomain( 'uabb', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/ultimate-addons-for-beaver-builder-lite/languages/ folder.
			load_textdomain( 'uabb', $mofile_local );
		} else {
			// Load the default language files.
			load_plugin_textdomain( 'uabb', false, $lang_dir );
		}
	}

	/**
	 * Function that loads UABB's scripts
	 *
	 * @since 1.0
	 * @return void
	 */
	public function load_scripts() {

		if ( FLBuilderModel::is_builder_active() ) {

			wp_enqueue_style( 'uabb-builder-css', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-builder.css', array() );
			wp_enqueue_script( 'uabb-builder-js', BB_ULTIMATE_ADDON_URL . 'assets/js/uabb-builder.js', array( 'jquery' ), '', true );

			if ( apply_filters( 'uabb_global_support', true ) ) {

				wp_localize_script( 'uabb-builder-js', 'uabb_global', array( 'show_global_button' => true ) );

				$uabb = UABB_Global_Styling::get_uabb_global_settings();

				if ( isset( $uabb->enable_global ) && ( 'no' === $uabb->enable_global ) ) {
					wp_localize_script( 'uabb-builder-js', 'uabb_presets', array( 'show_presets' => true ) );
				}
			}
		}

		/* RTL Support */
		if ( is_rtl() ) {
			wp_enqueue_style( 'uabb-rtl-css', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-rtl.css', array() );
		}
	}

	/**
	 * Function that renders admin notices
	 *
	 * @since 1.0
	 * @return void
	 */
	public function admin_notices() {

		if ( file_exists( plugin_dir_path( 'bb-plugin-agency/fl-builder.php' ) )
			|| file_exists( plugin_dir_path( 'beaver-builder-lite-version/fl-builder.php' ) ) ) {

			$url = network_admin_url() . 'plugins.php?s=Beaver+Builder+Plugin';
		} else {
			$url = network_admin_url() . 'plugin-install.php?s=billyyoung&tab=search&type=author';
		}

		echo '<div class="notice notice-error">';
		echo wp_kses(
			sprintf(
				'<p>The <strong>Ultimate Addon for Beaver Builder</strong> %s <strong><a href="%s">Beaver Builder</strong></a> %s</p>',
				__( 'plugin requires', 'uabb' ),
				esc_url( $url ),
				__( ' plugin installed & activated.', 'uabb' )
			),
			array(
				'p'      => array(),
				'strong' => array(),
				'a'      => array(
					'href' => array(),
				),
			)
		);
		echo '</div>';
	}

	/**
	 * Function that loads the modules.
	 *
	 * @since 1.0
	 * @return void
	 */
	public function load_modules() {

		$enable_modules = BB_Ultimate_Addon_Helper::get_builder_uabb_modules();
		foreach ( $enable_modules as $file => $name ) {

			if ( 'false' === $name ) {
				continue;
			}

			$module_path = $file . '/' . $file . '.php';
			$child_path  = get_stylesheet_directory() . '/bb-ultimate-addon/modules/' . $module_path;
			$theme_path  = get_template_directory() . '/bb-ultimate-addon/modules/' . $module_path;
			$addon_path  = BB_ULTIMATE_ADDON_DIR . 'modules/' . $module_path;

			// Check for the module class in a child theme.
			if ( is_child_theme() && file_exists( $child_path ) ) {
				require_once $child_path;
			} elseif ( file_exists( $theme_path ) ) {
				require_once $theme_path;
			} elseif ( file_exists( $addon_path ) ) {
				require_once $addon_path;
			}
		}
	}
}

/**
 * Initialize the class only after all the plugins are loaded.
 *
 * @return void
 */
function init_uabb() {
	$UABB_Init = new UABB_Init(); // @codingStandardsIgnoreLine.
}

add_action( 'plugins_loaded', 'init_uabb' );
