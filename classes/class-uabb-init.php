<?php

/**
 * UABB initial setup
 *
 * @since 1.1.0.4
 */
class UABB_Init {

	public static $uabb_options;

	/**
	*  Constructor
	*/

	public function __construct() {

		//register_activation_hook( __FILE__, array( __CLASS__, '::reset' ) );

		if ( class_exists( 'FLBuilder' ) ) {

			/**
			 *	For Performance
			 *	Set UABB static object to store data from database.
			 */
			self::set_uabb_options();

			add_filter( 'fl_builder_settings_form_defaults', array( $this, 'uabb_global_settings_form_defaults' ), 10, 2 );	
			// Load all the required files of bb-ultimate-addon
			self::includes();
			add_action( 'init', array( $this, 'init' ) );			

			// Enqueue scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ), 100 );

			$basename = plugin_basename( BB_ULTIMATE_ADDON_FILE );
			// Filters
			add_filter( 'plugin_action_links_' . $basename, array( $this, 'uabb_render_plugin_action_links' ) );

		} else {

			// disable UABB activation ntices in admin panel
			define( 'BSF_UABB_NOTICES', false );

			// Display admin notice for activating beaver builder
			add_action( 'admin_notices', array( $this, 'admin_notices' ) );
			add_action( 'network_admin_notices', array( $this, 'admin_notices' ) );
		}

	}

	function uabb_render_plugin_action_links( $actions ) {

		$actions[] = '<a href="' . BB_ULTIMATE_ADDON_UPGRADE_URL . '" style="color:#3db634;" title="Upgrade" target="_blank">' . _x( 'Upgrade', 'Plugin action link label.', 'uabb' ) . '</a>';

		return $actions;
	}

	function includes() {

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-helper.php';

 		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-cloud-templates.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-admin-settings.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-admin-settings-multisite.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-global-settings.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-functions.php';

		// Attachment Fields

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-attachment.php';

		//	fields
		require_once BB_ULTIMATE_ADDON_DIR . 'fields/_config.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-settings-form.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/helper.php';
		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-ui-panel.php';

		// Load the appropriate text-domain
		$this->load_plugin_textdomain();

	}

	/**
	*	For Performance
	*	Set UABB static object to store data from database.
	*/
	static function set_uabb_options() {
		self::$uabb_options = array(
			'fl_builder_uabb'          => FLBuilderModel::get_admin_settings_option( '_fl_builder_uabb', true ),
			'fl_builder_uabb_branding' => FLBuilderModel::get_admin_settings_option( '_fl_builder_uabb_branding', false ),
			'uabb_global_settings'     => get_option('_uabb_global_settings'),

			'fl_builder_uabb_modules' => FLBuilderModel::get_admin_settings_option( '_fl_builder_uabb_modules', false ),
		);
	}

	function uabb_global_settings_form_defaults( $defaults, $form_type ) {

		if ( class_exists( 'FLCustomizer' ) && 'uabb-global' == $form_type ) {

        	$defaults->enable_global = 'no';
	    }

	    return $defaults; // Must be returned!
	}

	function init() {
		
		if ( apply_filters( 'uabb_global_support', true ) && class_exists( 'FLBuilderAJAX' ) ) {
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-settings.php';
			require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-global-integration.php';
		}


		if ( class_exists( 'FLCustomizer' ) ) {
			$uabb_global_style = UABB_Global_Styling::get_uabb_global_settings();
			
			if ( ( isset( $uabb_global_style->enable_global ) && ( $uabb_global_style->enable_global == 'no' ) ) ) {
				require_once BB_ULTIMATE_ADDON_DIR . 'classes/uabb-bbtheme-global-integration.php';
			}
		}

		//	Nested forms
		require_once BB_ULTIMATE_ADDON_DIR . 'objects/fl-nested-form-button.php';

		require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-iconfonts.php';
		//require_once BB_ULTIMATE_ADDON_DIR . 'classes/class-uabb-model-helper.php';

		// Ultimate Modules
		$this->load_modules();
	}

	function load_plugin_textdomain() {
		//Traditional WordPress plugin locale filter
		$locale = apply_filters( 'plugin_locale', get_locale(), 'uabb' );

		//Setup paths to current locale file
		$mofile_global = trailingslashit( WP_LANG_DIR ) . 'plugins/bb-ultimate-addon/' . $locale . '.mo';
		$mofile_local  = trailingslashit( BB_ULTIMATE_ADDON_DIR ) . 'languages/' . $locale . '.mo';

		if ( file_exists( $mofile_global ) ) {
			//Look in global /wp-content/languages/plugins/bb-ultimate-addon/ folder
			return load_textdomain( 'uabb', $mofile_global );
		}
		else if ( file_exists( $mofile_local ) ) {
			//Look in local /wp-content/plugins/bb-ultimate-addon/languages/ folder
			return load_textdomain( 'uabb', $mofile_local );
		} 

		//Nothing found
		return false;
	}

	function load_scripts() {

		if( FLBuilderModel::is_builder_active() ) {
			
			wp_enqueue_style( 'uabb-builder-css', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-builder.css', array() );
			wp_enqueue_script('uabb-builder-js',  BB_ULTIMATE_ADDON_URL . 'assets/js/uabb-builder.js', array('jquery'), '', true);

			if ( apply_filters( 'uabb_global_support', true ) ) {
				
				wp_localize_script( 'uabb-builder-js', 'uabb_global', array( 'show_global_button' => true ) );
				
				$uabb = UABB_Global_Styling::get_uabb_global_settings();

				if( isset( $uabb->enable_global ) && ( $uabb->enable_global == 'no' ) ) {
					wp_localize_script( 'uabb-builder-js', 'uabb_presets', array( 'show_presets' => true ) );
				}
			}
		}

		/* RTL Support */
        if(is_rtl()) {
            wp_enqueue_style('uabb-rtl-css', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-rtl.css', array() );
        }
		
	}

	function admin_notices() {

		if ( file_exists( plugin_dir_path( 'bb-plugin-agency/fl-builder.php' ) ) 
			|| file_exists( plugin_dir_path( 'beaver-builder-lite-version/fl-builder.php' ) ) ) {

			$url = network_admin_url() . 'plugins.php?s=Beaver+Builder+Plugin';
		} else {
			$url = network_admin_url() . 'plugin-install.php?s=billyyoung&tab=search&type=author';
		}

		echo '<div class="notice notice-error">';
	    echo "<p>The <strong>Ultimate Addon for Beaver Builder</strong> " . __( 'plugin requires', 'uabb' )." <strong><a href='".$url."'>Beaver Builder</strong></a>" . __( ' plugin installed & activated.', 'uabb' ) . "</p>";
	    echo '</div>';
  	}

  	function load_modules() {

  		$enable_modules = BB_Ultimate_Addon_Helper::get_builder_uabb_modules();
		foreach ( $enable_modules as $file => $name ) {

			if ( $name == 'false' ) {
				continue;
			}

			$module_path	= $file . '/' .$file . '.php';
			$child_path		= get_stylesheet_directory() . '/bb-ultimate-addon/modules/'.$module_path;
			$theme_path		= get_template_directory() . '/bb-ultimate-addon/modules/'.$module_path;
			$addon_path		= BB_ULTIMATE_ADDON_DIR . 'modules/' . $module_path;

			// Check for the module class in a child theme.
			if( is_child_theme() && file_exists($child_path) ) {
				require_once $child_path;
			}

			// Check for the module class in a parent theme.
			else if( file_exists($theme_path) ) {
				require_once $theme_path;
			}

			// Check for the module class in the builder directory.
			else if( file_exists($addon_path) ) {
				require_once $addon_path;
			}
		}
  	}
}

/**
 * Initialize the class only after all the plugins are loaded.
 */

function init_uabb() {
	$UABB_Init = new UABB_Init();
}

add_action( 'plugins_loaded', 'init_uabb' );
