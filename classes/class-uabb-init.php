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
			add_action( 'init', array( $this, 'init' ) );

			// Enqueue scripts.
			add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ), 100 );

			$basename = plugin_basename( BB_ULTIMATE_ADDON_FILE );
			// Filters.
			add_filter( 'plugin_action_links_' . $basename, array( $this, 'uabb_render_plugin_action_links' ) );

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
	 */
	function uabb_render_plugin_action_links( $actions ) {

		$actions[] = '<a href="' . BB_ULTIMATE_ADDON_UPGRADE_URL . '" style="color:#3db634;" title="Upgrade" target="_blank">' . _x( 'Upgrade', 'Plugin action link label.', 'uabb' ) . '</a>';

		return $actions;
	}

	/**
	 * Function that includes necessary files
	 *
	 * @since 1.0
	 */
	function includes() {

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-update.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-compatibility.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-backward.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-helper.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-cloud-templates.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-admin-settings.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-admin-settings-multisite.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'lib/notices/class-astra-notices.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-global-settings.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-functions.php';
		// Attachment Fields.
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-attachment.php';

		// fields.
		require_once BB_ULTIMATE_ADDON_DIR . 'fields/_config.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-settings-form.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/helper.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-ui-panel.php';

		// wpml.
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-wpml.php';
		// BSF Analytics Tracker.
		require_once BB_ULTIMATE_ADDON_DIR . 'admin/bsf-analytics/class-bsf-analytics.php';

		// Load the appropriate text-domain.
		$this->load_plugin_textdomain();

	}

	/**
	 *   For Performance.
	 *   Set UABB static object to store data from database.
	 */
	static function set_uabb_options() {
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
	 */
	function uabb_global_settings_form_defaults( $defaults, $form_type ) {

		if ( class_exists( 'FLCustomizer' ) && 'uabb-global' == $form_type ) {

			$defaults->enable_global = 'no';
		}

		return $defaults; // Must be returned!
	}

	/**
	 * Function that initializes init function
	 *
	 * @since 1.0
	 */
	function init() {

		if ( apply_filters( 'uabb_global_support', true ) && class_exists( 'FLBuilderAJAX' ) ) {
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-settings.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-integration.php';
		}

		if ( class_exists( 'FLCustomizer' ) ) {
			$uabb_global_style = UABB_Global_Styling::get_uabb_global_settings();

			if ( ( isset( $uabb_global_style->enable_global ) && ( 'no' == $uabb_global_style->enable_global ) ) ) {
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-bbtheme-global-integration.php';
			}
		}

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
	 */
	function load_plugin_textdomain() {
		// Traditional WordPress plugin locale filter.
		$locale = apply_filters( 'plugin_locale', get_locale(), 'uabb' );

		// Setup paths to current locale file.
		$mofile_global = trailingslashit( WP_LANG_DIR ) . 'plugins/bb-ultimate-addon/' . $locale . '.mo';
		$mofile_local  = trailingslashit( BB_ULTIMATE_ADDON_DIR ) . 'languages/' . $locale . '.mo';

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/plugins/bb-ultimate-addon/ folder.
			return load_textdomain( 'uabb', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/bb-ultimate-addon/languages/ folder.
			return load_textdomain( 'uabb', $mofile_local );
		}

		// Nothing found.
		return false;
	}

	/**
	 * Function that loads UABB's scripts
	 *
	 * @since 1.0
	 */
	function load_scripts() {

		if ( FLBuilderModel::is_builder_active() ) {

			wp_enqueue_style( 'uabb-builder-css', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-builder.css', array() );
			wp_enqueue_script( 'uabb-builder-js', BB_ULTIMATE_ADDON_URL . 'assets/js/uabb-builder.js', array( 'jquery' ), '', true );

			if ( apply_filters( 'uabb_global_support', true ) ) {

				wp_localize_script( 'uabb-builder-js', 'uabb_global', array( 'show_global_button' => true ) );

				$uabb = UABB_Global_Styling::get_uabb_global_settings();

				if ( isset( $uabb->enable_global ) && ( 'no' == $uabb->enable_global ) ) {
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
	 */
	function admin_notices() {

		if ( file_exists( plugin_dir_path( 'bb-plugin-agency/fl-builder.php' ) )
			|| file_exists( plugin_dir_path( 'beaver-builder-lite-version/fl-builder.php' ) ) ) {

			$url = network_admin_url() . 'plugins.php?s=Beaver+Builder+Plugin';
		} else {
			$url = network_admin_url() . 'plugin-install.php?s=billyyoung&tab=search&type=author';
		}

		echo '<div class="notice notice-error">';
		echo '<p>The <strong>Ultimate Addon for Beaver Builder</strong> ' . __( 'plugin requires', 'uabb' ) . " <strong><a href='" . $url . "'>Beaver Builder</strong></a>" . __( ' plugin installed & activated.', 'uabb' ) . '</p>';
		echo '</div>';
	}

	/**
	 * Function that loads the modules.
	 *
	 * @since 1.0
	 */
	function load_modules() {

		$enable_modules = BB_Ultimate_Addon_Helper::get_builder_uabb_modules();
		foreach ( $enable_modules as $file => $name ) {

			if ( 'false' == $name ) {
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
 */
function init_uabb() {
	$UABB_Init = new UABB_Init(); // @codingStandardsIgnoreLine.
}

add_action( 'plugins_loaded', 'init_uabb' );
