<?php
/*
Plugin Name: Brainstorm Core
Plugin URI: https://brainstormforce.com
Author: Brainstorm Force
Author URI: https://brainstormforce.com
Version: 1.0
Description: Brainstorm Core
Text Domain: bsf
*/

/*
	Instrunctions - Product Registration & Updater
	# Copy "auto-upadater" folder to admin folder
	# Change "include_once" and "require_once" directory path as per your "auto-updater" path (Line no. 72, 78, 79)

*/
/* product registration */
require_once 'auto-update/admin-functions.php';
require_once 'auto-update/updater.php';
require_once 'BSF_License_Manager.php';
require_once 'BSF_Update_Manager.php';

if ( defined( 'WP_CLI' ) ) {
	require 'BSF_WP_CLI_Command.php';
}

// abspath of groupi

if ( ! defined( 'BSF_UPDATER_PATH' ) ) {
	define( 'BSF_UPDATER_PATH', dirname(__FILE__) );
}

if ( ! defined( 'BSF_UPDATER_FULLNAME' ) ) {
	define( 'BSF_UPDATER_FULLNAME', apply_filters( 'agency_updater_fullname', 'Brainstorm Force' ) );
}

if ( ! defined( 'BSF_UPDATER_SHORTNAME' ) ) {
	define( 'BSF_UPDATER_SHORTNAME', apply_filters( 'agency_updater_shortname', 'Brainstorm' ) );
}

if(!function_exists('bsf_convert_core_path_to_relative')) {
	function bsf_convert_core_path_to_relative($path) {
		global $bsf_core_url;
		$path = wp_normalize_path($path);
		$theme_dir = wp_normalize_path( get_template_directory() );
		$plugin_dir = wp_normalize_path( WP_PLUGIN_DIR );
		if (strpos($path, $theme_dir) !== false) {
		    return rtrim(get_template_directory_uri().'/admin/bsf-core/', '/');
		}
		elseif(strpos($path, $plugin_dir) !== false) {
			return rtrim(plugin_dir_url( __FILE__ ),'/');
		}
		return false;
	}
}

add_action('admin_init', 'set_bsf_core_constant',1);
	if(!function_exists('set_bsf_core_constant')) {
	function set_bsf_core_constant() {
		if(!defined('BSF_CORE')) {
			define('BSF_CORE',true);
		}
	}
}

if ( ! function_exists( 'register_bsf_products_registration_page' ) ) {
	function register_bsf_products_registration_page() {

		bsf_check_brainstorm_menu_location();
		$skip_brainstorm_menu = get_site_option( 'bsf_skip_braisntorm_menu', false );

		if ( ( defined( 'BSF_UNREG_MENU' ) && ( BSF_UNREG_MENU === true || BSF_UNREG_MENU === 'true' ) ) ||
			$skip_brainstorm_menu == true ) {
			
			add_submenu_page( 
		        'options.php',
		        BSF_UPDATER_FULLNAME,
		        BSF_UPDATER_SHORTNAME,
		        'manage_options',
		        'bsf-registration',
		        'bsf_registration'
        	);

			return false;
		}

		if ( empty ( $GLOBALS['admin_page_hooks']['bsf-registration'] ) ) {
			$place = bsf_get_free_menu_position( 200, 1 );
			if ( ! defined( 'BSF_MENU_POS' ) ) {
				define( 'BSF_MENU_POS', $place );
			}
			if(is_multisite()) {
				if(defined('BSF_REG_MENU_TO_SETTINGS') && (BSF_REG_MENU_TO_SETTINGS == true || BSF_REG_MENU_TO_SETTINGS == 'true')) {
					$page = add_submenu_page('settings.php', BSF_UPDATER_FULLNAME, BSF_UPDATER_SHORTNAME, 'administrator', 'bsf-registration', 'bsf_registration'); 
				} else {
					$page = add_menu_page(BSF_UPDATER_FULLNAME, BSF_UPDATER_SHORTNAME, 'administrator', 'bsf-registration', 'bsf_registration','',$place);
				}
			}
			else {
				if(defined('BSF_REG_MENU_TO_SETTINGS') && (BSF_REG_MENU_TO_SETTINGS == true || BSF_REG_MENU_TO_SETTINGS == 'true')) {
					$page = add_options_page(BSF_UPDATER_FULLNAME, BSF_UPDATER_SHORTNAME, 'administrator', 'bsf-registration', 'bsf_registration' );
				}
				else {
					$page = add_dashboard_page( BSF_UPDATER_FULLNAME, BSF_UPDATER_SHORTNAME, 'administrator', 'bsf-registration', 'bsf_registration' );
				}
			}
		}
	}
}
if ( ! function_exists( 'bsf_registration' ) ) {
	function bsf_registration() {
		include_once 'auto-update/index.php';
	}
}

add_action( 'network_admin_menu', 'register_bsf_products_registration_page', 98 );
add_action( 'admin_menu', 'register_bsf_products_registration_page', 98 );

/*
	Instrunctions - Plugin Installer
	# Copy "plugin-installer" folder to theme's admin folder
	# Change "include_once" and "require_once" directory path as per your "plugin-installer" path (Line no. 101, 113)
*/

if ( ! function_exists( 'init_bsf_plugin_installer' ) ) {
	function init_bsf_plugin_installer() {
		require_once 'plugin-installer/admin-functions.php';

		/**
		 * Action will run after plugin installer is loaded
		 */
		do_action( 'bsf_after_plugin_installer' );
	}
}

add_action( 'admin_init', 'init_bsf_plugin_installer', 0 );
add_action( 'network_admin_init', 'init_bsf_plugin_installer', 0 );

if(!is_multisite()) {
	add_action('admin_menu', 'register_bsf_extension_page',999);
} else {
	add_action('network_admin_menu', 'register_bsf_extension_page_network',999);
}

if ( ! function_exists( 'register_bsf_extension_page' ) ) {

	function register_bsf_extension_page() {

		add_submenu_page(
			'imedica_options',
			__( 'Extensions', 'bsf' ),
			__( 'Extensions', 'bsf' ),
			'manage_options',
			'bsf-extensions-10395942',
			'bsf_extensions_callback'
		);

		$installer_menu = '';
		$reg_menu       = array();
		$reg_menu       = apply_filters( 'bsf_installer_menu', $reg_menu, $installer_menu );

		if ( is_array( $reg_menu ) ) {

			foreach ( $reg_menu as $installer => $attr ) {

				if ( empty ( $GLOBALS['admin_page_hooks'][ $attr['parent_slug'] ] ) &&
				     _bsf_maybe_add_dashboard_menu( $attr['product_id'] ) == true
				) {

					add_dashboard_page(
						$installer . ' ' . $attr['page_title'],
						$installer . ' ' . $attr['menu_title'],
						'manage_options',
						'bsf-extensions-' . $attr['product_id'],
						'bsf_extensions_callback'
					);

				} else {

					add_submenu_page(
						$attr['parent_slug'],
						$attr['page_title'],
						$attr['menu_title'],
						'manage_options',
						'bsf-extensions-' . $attr['product_id'],
						'bsf_extensions_callback'
					);

				}
			}

		}

	}

}

/**
 * Check if the dashboard menu for installer should be added.
 * Checks if theme or plugin is active, if it is not active, the menu for installer should not be registered.
 *
 * @param $product_id Product if of brainstorm product.
 *
 * @return boolean true - If menu is to be shown | false - if menu is not to be displayed.
 */
if ( ! function_exists( '_bsf_maybe_add_dashboard_menu' ) ) {

	function _bsf_maybe_add_dashboard_menu( $product_id ) {
		$brainstrom_products = ( get_option( 'brainstrom_products' ) ) ? get_option( 'brainstrom_products' ) : array();
		$template_plugin     = '';
		$template_theme      = '';
		$is_theme            = false;

		if ( is_multisite() ) {
			// Do not register menu if we are on multisite, multisite menu will be registered below the brainstorm menu.
			return false;
		}

		if ( $brainstrom_products !== array() ) {

			if ( isset( $brainstrom_products['plugins'] ) && isset( $brainstrom_products['plugins'][ $product_id ] ) ) {
				$template_plugin = $brainstrom_products['plugins'][ $product_id ]['template'];
			}

			if ( isset( $brainstrom_products['themes'] ) && isset( $brainstrom_products['themes'][ $product_id ] ) ) {
				$template_theme = $brainstrom_products['themes'][ $product_id ]['product_name'];
				$is_theme       = true;
			}

			if ( $is_theme == true && $template_theme !== '' ) {

				$themes = wp_get_theme();
				$theme_name = "";

				$parent = $themes->parent();

				if ( empty( $parent ) ) {
					$theme_name = $themes->get( 'Name' );
				} else {
					$theme_name = $themes->parent()->get( 'Name' );
				}

				if ( $theme_name == $template_theme ) {
					// Theme / Parent theme is active, hence display menu
					return true;
				}

				// don't display menu if theme/parent theme does not need extension installer
				return false;

			} elseif ( $is_theme == false && $template_plugin !== '' ) {

				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

				if ( is_plugin_active( $template_plugin ) || is_plugin_active_for_network( $template_plugin ) ) {
					// Plugin is active, hence display menu
					return true;
				}

				// don't display menu if plugin does not need extension installer
				return false;

			}

		}

		// do not register menu if all conditions fail
		return false;

	}

}


if(!function_exists('register_bsf_extension_page_network')) {
	function register_bsf_extension_page_network() {

		$themes = wp_get_themes(array('allowed' => 'network'));

		$parent_slug = 'bsf-registration';

		if(defined('BSF_REG_MENU_TO_SETTINGS') && (BSF_REG_MENU_TO_SETTINGS == true || BSF_REG_MENU_TO_SETTINGS == 'true')) {
			$parent_slug = 'settings.php';
		}

		foreach( $themes as $theme ) {
			if ( $theme->Name == 'iMedica' ) {
				add_submenu_page( $parent_slug, __('iMedica Extensions','bsf'), __('iMedica Extensions','bsf'), 'manage_options', 'bsf-extensions-10395942', 'bsf_extensions_callback' );
				break;
			}
		}

		$installer_menu = 	'';
		$reg_menu 		= 	array();
		$reg_menu 		=	get_site_option( 'bsf_installer_menu', array() );

		if( is_array( $reg_menu ) ) {

			foreach ( $reg_menu as $installer => $attr ) {
				add_submenu_page(
					$parent_slug,
					$installer .' ' . $attr['page_title'],
					$installer .' ' . $attr['menu_title'],
					'manage_options',
					'bsf-extensions-' . $attr['product_id'],
					'bsf_extensions_callback'
				);
			}

		}

	}
}
if ( ! function_exists( 'bsf_extensions_callback' ) ) {
	function bsf_extensions_callback() {
		include_once 'plugin-installer/index.php';
	}
}

if(!function_exists('bsf_extract_product_id')) {
	function bsf_extract_product_id($path) {
		$id = false;
		$file = rtrim($path,'/').'/admin/bsf.yml';
		$file_fallback = rtrim($path,'/').'/bsf.yml';
		if(is_file($file))
			$file = $file;
		else if(is_file($file_fallback))
			$file = $file_fallback;
		else
			return false;
		$filelines = file_get_contents($file);
		if(stripos($filelines,'ID:[') !== false) {
			preg_match_all("/ID:\[(.*?)\]/", $filelines, $matches);
			if(isset($matches[1])) {
				$id = (isset($matches[1][0])) ? $matches[1][0] : '';
			}
		}
		return $id;
	}
}

if ( ! function_exists( 'init_bsf_core' ) ) {

	function init_bsf_core() {

		$plugins = get_plugins();
		$themes  = wp_get_themes();

		$bsf_products = array();
		foreach ( $plugins as $plugin => $plugin_data ) {
			if ( trim( $plugin_data['Author'] ) === 'Brainstorm Force' ) {
				$plugin_data['type']     = 'plugin';
				$plugin_data['template'] = $plugin;
				$plugin_data['path']     = dirname( realpath( WP_PLUGIN_DIR . '/' . $plugin ) );
				$id                      = bsf_extract_product_id( $plugin_data['path'] );
				if ( $id !== false ) {
					$plugin_data['id'] = $id;
				} // without readme.txt filename
				array_push( $bsf_products, $plugin_data );
			}
		}

		foreach ( $themes as $theme => $theme_data ) {
			$temp         = array();
			$theme_author = trim( $theme_data->display( 'Author', false ) );
			if ( $theme_author === 'Brainstorm Force' ) {
				$temp['Name']        = $theme_data->get( 'Name' );
				$temp['ThemeURI']    = $theme_data->get( 'ThemeURI' );
				$temp['Description'] = $theme_data->get( 'Description' );
				$temp['Author']      = $theme_data->get( 'Author' );
				$temp['AuthorURI']   = $theme_data->get( 'AuthorURI' );
				$temp['Version']     = $theme_data->get( 'Version' );
				$temp['type']        = 'theme';
				$temp['template']    = $theme;
				$temp['path']        = realpath( get_theme_root() . '/' . $theme );
				$id                  = bsf_extract_product_id( $temp['path'] );
				if ( $id !== false ) {
					$temp['id'] = $id;
				} // without readme.txt filename
				array_push( $bsf_products, $temp );
			}
		}

		$brainstrom_products = ( get_option( 'brainstrom_products' ) ) ? get_option( 'brainstrom_products' ) : array();

		// Remove the brainstorm products which no longer exist on site
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$plugins = get_plugins();
		$themes  = search_theme_directories();

		if ( ! empty( $brainstrom_products ) ) {

			if ( isset( $brainstrom_products['plugins'] ) ) {

				foreach ( $brainstrom_products['plugins'] as $key => $value ) {

					if ( ! array_key_exists( $value['template'], $plugins ) ) {
						unset( $brainstrom_products['plugins'][ $key ] );
					}
				}

			}

			if ( isset( $brainstrom_products['themes'] ) ) {

				foreach ( $brainstrom_products['themes'] as $key => $value ) {

					if ( ! array_key_exists( $value['template'], $themes ) ) {
						unset( $brainstrom_products['themes'][ $key ] );
					}
				}

			}

		}

		//	Update newly added brainstorm_products

		if ( ! empty( $bsf_products ) ) {
			foreach ( $bsf_products as $key => $product ) {
				if ( ! ( isset( $product['id'] ) ) || $product['id'] === '' ) {
					continue;
				}
				if ( isset( $brainstrom_products[ $product['type'] . 's' ][ $product['id'] ] ) ) {
					$bsf_product_info = $brainstrom_products[ $product['type'] . 's' ][ $product['id'] ];
				} else {
					$bsf_product_info = array();
					do_action( 'brainstorm_updater_new_product_added' );
				}
				$bsf_product_info['template']                                    = $product['template'];
				$bsf_product_info['type']                                        = $product['type'];
				$bsf_product_info['id']                                          = $product['id'];
				$brainstrom_products[ $product['type'] . 's' ][ $product['id'] ] = $bsf_product_info;
			}

		}

		update_option( 'brainstrom_products', $brainstrom_products );
	}
}

add_action( 'admin_init', 'init_bsf_core' );

if(is_multisite()) {
	$brainstrom_products = (get_option('brainstrom_products')) ? get_option('brainstrom_products') : array();
	if(!empty($brainstrom_products)) {
		$bsf_product_themes = (isset($brainstrom_products['themes'])) ? $brainstrom_products['themes'] : array();
		if(!empty($bsf_product_themes)) {
			foreach ($bsf_product_themes as $id => $theme) {
				global $bsf_theme_template;
				$template = $theme['template'];
				$bsf_theme_template = $template;
			}
		}
	}
}
// assets
add_action( 'admin_enqueue_scripts', 'register_bsf_core_admin_styles', 1 );
if(!function_exists('register_bsf_core_admin_styles')) {
	function register_bsf_core_admin_styles($hook) {
		//echo '--------------------------------------........'.$hook;die();

		// bsf core style
		$hook_array = array(
			'toplevel_page_bsf-registration',
			'update-core.php',
			'dashboard_page_bsf-registration',
			'index_page_bsf-registration',
			'admin_page_bsf-extensions',
			'settings_page_bsf-registration',
			'admin_page_bsf-registration'
		);
		$hook_array = apply_filters('bsf_core_style_screens',$hook_array);

		if( in_array($hook, $hook_array) || strpos( $hook, 'bsf-extensions' ) !== false ){
			// add function here
			global $bsf_core_path;
			$bsf_core_url = bsf_convert_core_path_to_relative($bsf_core_path);
			$path = $bsf_core_url.'/assets/css/style.css';
			wp_register_style( 'bsf-core-admin', $path );
			wp_enqueue_style( 'bsf-core-admin' );

			wp_register_style( 'brainstorm-switch', $bsf_core_url.'/assets/css/switch.css', '' );
			wp_enqueue_style( 'brainstorm-switch' );
			
			wp_register_script( 'brainstorm-switch', $bsf_core_url.'/assets/js/switch.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'brainstorm-switch' );
		}

		// frosty script
		$hook_frosty_array = array();
		$hook_frosty_array = apply_filters('bsf_core_frosty_screens',$hook_frosty_array);
		if(in_array($hook, $hook_frosty_array)){
			global $bsf_core_path;
			$bsf_core_url = bsf_convert_core_path_to_relative($bsf_core_path);

			$path = $bsf_core_url.'/assets/js/frosty.js';
			$css_path = $bsf_core_url.'/assets/css/frosty.css';

			wp_register_script( 'bsf-core-frosty', $path );
			wp_enqueue_script( 'bsf-core-frosty' );

			wp_register_style( 'bsf-core-frosty-style', $css_path );
			wp_enqueue_style( 'bsf-core-frosty-style' );
		}
	}
}
if(is_multisite()) {
	add_action('admin_print_scripts', 'print_bsf_styles');
	if(!function_exists('print_bsf_styles')) {
		function print_bsf_styles() {
			global $bsf_core_path;
			$bsf_core_url = bsf_convert_core_path_to_relative($bsf_core_path);

			$path = $bsf_core_url.'/assets/fonts';

			echo "<style>
				@font-face {
					font-family: 'brainstorm';
					src:url('".$path."/brainstorm.eot');
					src:url('".$path."/brainstorm.eot') format('embedded-opentype'),
						url('".$path."/brainstorm.woff') format('woff'),
						url('".$path."/brainstorm.ttf') format('truetype'),
						url('".$path."/brainstorm.svg') format('svg');
					font-weight: normal;
					font-style: normal;
				}
				.toplevel_page_bsf-registration > div.wp-menu-image:before {
					content: \"\\e603\" !important;
					font-family: 'brainstorm' !important;
					speak: none;
					font-style: normal;
					font-weight: normal;
					font-variant: normal;
					text-transform: none;
					line-height: 1;
					-webkit-font-smoothing: antialiased;
					-moz-osx-font-smoothing: grayscale;
				}
			</style>";
		}
	}
}

if ( ! function_exists( 'bsf_flush_bundled_products' ) ) {

	function bsf_flush_bundled_products() {
		$bsf_force_check_extensions = get_site_option( 'bsf_force_check_extensions', false );

		if ( $bsf_force_check_extensions == true ) {
			delete_site_option( 'brainstrom_bundled_products' );
			delete_site_transient( 'bsf_get_bundled_products' );
			global $ultimate_referer;
			$ultimate_referer = 'on-flush-bundled-products';
			get_bundled_plugins();

			update_site_option( 'bsf_force_check_extensions', false );
		}
	}
}

add_action( 'bsf_after_plugin_installer', 'bsf_flush_bundled_products' );
add_action( 'deleted_plugin', 'bsf_flush_bundled_products' );

/**
 * Return array of bundled plugins for a specific
 *
 * @since Graupi 1.9
 */
if ( ! function_exists( 'bsf_bundled_plugins' ) ) {

	function bsf_bundled_plugins( $product_id = '' ) {
		$products = array();

		$brainstrom_bundled_products = get_option( 'brainstrom_bundled_products', '' );

		if ( $brainstrom_bundled_products !== '' ) {
			if ( array_key_exists( $product_id, $brainstrom_bundled_products ) ) {
				$products = $brainstrom_bundled_products[ $product_id ];
			}
		}

		return $products;
	}
}

/**
 * Get product name from product ID
 *
 * @since Graupi 1.9
 */
if ( ! function_exists( 'brainstrom_product_name' ) ) {

	function brainstrom_product_name( $product_id = '' ) {
		$product_name = '';
		$brainstrom_products =  get_option( 'brainstrom_products', '' );

		foreach ( $brainstrom_products as $key => $value ) {
			foreach ( $value as $key => $product ) {
				if ( $product_id == $key ) {
					$product_name = isset( $product['product_name'] ) ? $product['product_name'] : '';
				}
			}
		}

		return $product_name;
	}
}

/**
 * Get product id from product name
 *
 * @since Graupi 1.19
 */
if ( ! function_exists( 'brainstrom_product_id_by_name' ) ) {

	function brainstrom_product_id_by_name( $product_name ) {
		$product_id = '';
		$brainstrom_products =  get_option( 'brainstrom_products', '' );
		
		foreach ( $brainstrom_products as $key => $value ) {
			foreach ( $value as $key => $product ) {
				if ( strcasecmp( $product['product_name'], $product_name ) == 0 ) {
					$product_id = isset( $product['id'] ) ? $product['id'] : '';
				}
			}
		}

		return $product_id;
	}
}

if ( ! function_exists( 'brainstrom_product_id_by_init' ) ) {
	
	function brainstrom_product_id_by_init( $plugin_init ) {

		$brainstrom_products = get_option( 'brainstrom_products', array() );
		$brainstorm_plugins  = isset( $brainstrom_products['plugins'] ) ? $brainstrom_products['plugins'] : array();
		$brainstorm_themes   = isset( $brainstrom_products['themes'] ) ? $brainstrom_products['themes'] : array();

		$all_products = $brainstorm_plugins + $brainstorm_themes;

		foreach ( $all_products as $key => $product ) {
			
			$template = isset( $product[ 'template' ] ) ? $product[ 'template' ] : '';
			if ( $plugin_init == $template ) {

				return isset( $product[ 'id' ] ) ? $product[ 'id' ] : false;
			}
		}
	}

}

if ( ! function_exists( 'get_brainstorm_product' ) ) {
	
	function get_brainstorm_product( $product_id = '' ) {

		$all_products = brainstorm_get_all_products();

		foreach ( $all_products as $key => $product ) {
			
			$product_id_bsf = isset( $product[ 'id' ] ) ? $product[ 'id' ] : '';

			if ( $product_id == $product_id_bsf ) {
				
				return $product;
			}
		}
	}

}

if ( ! function_exists( 'brainstorm_get_all_products' ) ) {
	
	function brainstorm_get_all_products( $skip_plugins = false, $skip_themes = false, $skip_bundled = false ) {

		$brainstrom_products = get_option( 'brainstrom_products', array() );
		$brainstrom_bundled_products = get_option( 'brainstrom_bundled_products', array() );
		$brainstorm_plugins  = isset( $brainstrom_products['plugins'] ) ? $brainstrom_products['plugins'] : array();
		$brainstorm_themes   = isset( $brainstrom_products['themes'] ) ? $brainstrom_products['themes'] : array();

		if ( $skip_plugins == true ) {
			$all_products = $brainstorm_themes;
		} elseif ( $skip_themes == true ) {
			$all_products = $brainstorm_plugins;
		} else {
			$all_products = $brainstorm_plugins + $brainstorm_themes;
		}

		if ( $skip_bundled == false ) {
			
			foreach ( $brainstrom_bundled_products as $parent_id => $parent ) {

				foreach ( $parent as $key => $product ) {

					if ( isset( $all_products[ $product->id ] ) ) {
						$all_products[ $product->id ] = array_merge( $all_products[ $product->id ], (array) $product );
					} else {
						$all_products[ $product->id ] = (array) $product;
					}
				}
			}	
		}

		return $all_products;
	}

}

/**
 * Dismiss Extension installer nag
 *
 * @since Graupi 1.9
 */
if ( ! function_exists( 'bsf_dismiss_extension_nag' ) ) {

	function bsf_dismiss_extension_nag() {
		if ( isset( $_GET['bsf-dismiss-notice'] ) ) {
			$product_id =  $_GET['bsf-dismiss-notice'];
			update_user_meta( get_current_user_id(), $product_id . '-bsf_nag_dismiss', true );
		}
	}

}

add_action( 'admin_head', 'bsf_dismiss_extension_nag' );

// For debugging uncomment line below and remove query var &bsf-dismiss-notice from url and nag will be restored.
// delete_user_meta( get_current_user_id(), 'bsf-next-bsf_nag_dismiss');

/**
 * Generate's markup to generate notice to ask users to install required extensions.
 *
 * @since Graupi 1.9
 *
 * $product_id (string) Product ID of the brainstorm product
 * $mu_updater (bool) If True - give nag to separately install brainstorm updater multisite plugin
 */
if ( ! function_exists( 'bsf_extension_nag' ) ) {

	function bsf_extension_nag( $product_id = '', $mu_updater = false ) {

		$display_nag = get_user_meta( get_current_user_id(), $product_id . '-bsf_nag_dismiss', true );

		if ( $mu_updater == true ) {
			bsf_nag_brainstorm_updater_multisite();
		}

		if ( $display_nag === '1' ||
			! user_can( get_current_user_id(), 'activate_plugins' ) ||
			! user_can( get_current_user_id(), 'install_plugins' ) ) {
			return;
		}

		$bsf_installed_plugins     = '';
		$bsf_not_installed_plugins = '';
		$bsf_not_activated_plugins = '';
		$installer                 = '';
		$bsf_install               = false;
		$bsf_activate              = false;
		$bsf_bundled_products      = bsf_bundled_plugins( $product_id );
		$bsf_product_name          = brainstrom_product_name( $product_id );

		foreach ( $bsf_bundled_products as $key => $plugin ) {

			if ( ! isset( $plugin->id ) || $plugin->id == '' || ! isset( $plugin->must_have_extension ) || $plugin->must_have_extension == 'false' ) {
				continue;
			}

			$plugin_abs_path = WP_PLUGIN_DIR . '/' . $plugin->init;
			if ( is_file( $plugin_abs_path ) ) {

				if ( ! is_plugin_active( $plugin->init ) ) {
					$bsf_not_activated_plugins .= $bsf_bundled_products[ $key ]->name . ', ';
				}
			} else {
				$bsf_not_installed_plugins .= $bsf_bundled_products[ $key ]->name . ', ';
			}

		}

		$bsf_not_activated_plugins = rtrim( $bsf_not_activated_plugins, ", " );
		$bsf_not_installed_plugins = rtrim( $bsf_not_installed_plugins, ", " );

		if ( $bsf_not_activated_plugins !== '' || $bsf_not_installed_plugins !== '' ) {
			echo '<div class="updated notice is-dismissible"><p></p>';
			if ( $bsf_not_activated_plugins !== '' ) {
				echo '<p>';
				echo $bsf_product_name . __( ' requires following plugins to be active : ', 'bsf' );
				echo "<strong><em>";
				echo $bsf_not_activated_plugins;
				echo "</strong></em>";
				echo '</p>';
				$bsf_activate = true;
			}

			if ( $bsf_not_installed_plugins !== '' ) {
				echo '<p>';
				echo $bsf_product_name . __( ' requires following plugins to be installed and activated : ', 'bsf' );
				echo "<strong><em>";
				echo $bsf_not_installed_plugins;
				echo "</strong></em>";
				echo '</p>';
				$bsf_install = true;
			}

			if ( $bsf_activate == true ) {
				$installer .= '<a href="' . get_admin_url() . 'plugins.php?plugin_status=inactive">' . __( 'Begin activating plugins', 'bsf' ) . '</a> | ';
			}

			if ( $bsf_install == true ) {
				$installer .= '<a href="' . bsf_exension_installer_url( $product_id ) . '">' . __( 'Begin installing plugins', 'bsf' ) . '</a> | ';
			}

			$installer .= '<a href="' . esc_url( add_query_arg( 'bsf-dismiss-notice', $product_id ) ) . '">' . __( 'Dismiss This Notice', 'bsf' ) . '</a>';

			$installer = ltrim( $installer, '| ' );
			echo '<p><strong>';
			echo rtrim( $installer, ' |' );
			echo '</p></strong>';

			echo '<p></p></div>';
		}
	}

}

if ( ! function_exists( 'bsf_nag_brainstorm_updater_multisite' ) ) {

	function bsf_nag_brainstorm_updater_multisite() {

		if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
			require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
		}

		if ( ! is_multisite() || is_plugin_active_for_network( 'brainstorm-updater/index.php' ) ) {
			return;
		}

		echo '<div class="notice notice-error uct-notice is-dismissible"><p>';
		printf(
			__('Looks like you are on a WordPress Multisite, you will need to install and network activate %1$s Brainstorm Updater for Multisite %2$s plugin. Download it from %3$s here %4$s', 'bsf' ) ,
				'<strong><em>',
				'</strong></em>',
				'<a href="http://bsf.io/bsf-updater-mu" target="_blank">',
				'</a>'
			 );

		echo "</p>";
		echo "</div>";
	}

}

/*
 * Load BSF core frosty scripts on front end
*/
add_action( 'wp_enqueue_scripts', 'register_bsf_core_styles', 1 );
function register_bsf_core_styles( $hook ) {

	global $bsf_core_path;
	$bsf_core_url = bsf_convert_core_path_to_relative($bsf_core_path);
	$frosty_script_path = $bsf_core_url.'/assets/js/frosty.js';
	$frosty_style_path = $bsf_core_url.'/assets/css/frosty.css';

	// Register Frosty script and style
	wp_register_script( 'bsf-core-frosty', $frosty_script_path );
	wp_register_style( 'bsf-core-frosty-style', $frosty_style_path );

}

/**
 * Add link to debug settings for braisntorm updater on license registration page
 */
if ( ! function_exists( 'bsf_core_debug_link' ) ) {

	function bsf_core_debug_link( $text ) {
		$screen = get_current_screen();

		$screens = array(
			'dashboard_page_bsf-registration',
			'toplevel_page_bsf-registration-network',
			'settings_page_bsf-registration',
			'settings_page_bsf-registration-network'
		);

		$screens = apply_filters( 'bsf_core_debug_link_screens', $screens );

		if ( ! in_array( $screen->id, $screens ) ) {
			return $text;
		}

		$url  = bsf_registration_page_url( '&author' );
		$link = '<a href="' . $url . '">'. BSF_UPDATER_SHORTNAME .' Updater debug settings</a>';
		$text = $link . ' | ' . $text;

		return $text;
	}

}

add_filter( 'update_footer', 'bsf_core_debug_link', 999 );

/**
 * Return brainstorm registration page URL
 *
 * @param $append (string) - Append at string at the end of the url
 */
if ( ! function_exists( 'bsf_registration_page_url' ) ) {

	function bsf_registration_page_url( $append = '', $product_id = '' ) {

		$bsf_updater_options       = get_option( 'bsf_updater_options', array() );
		$option                    = $constant = false;
		$skip_brainstorm_menu      = get_site_option( 'bsf_skip_braisntorm_menu', false );
		$product_registration_link = apply_filters( "bsf_registration_page_url_{$product_id}", '' );

		// If Brainstorm meu is not registered
		if ( ( defined( 'BSF_UNREG_MENU' ) && ( BSF_UNREG_MENU === true || BSF_UNREG_MENU === 'true' ) ) ||
		     $skip_brainstorm_menu == true
		) {

			if ( $append == '&author' ) {

				return admin_url( 'options.php?page=bsf-registration' . $append );
			}
		}

		if ( isset( $bsf_updater_options['brainstorm_menu'] ) && $bsf_updater_options['brainstorm_menu'] == "1" ) {
			$option = true;
		}

		if ( defined( 'BSF_REG_MENU_TO_SETTINGS' ) && 'BSF_REG_MENU_TO_SETTINGS' == true || 'BSF_REG_MENU_TO_SETTINGS' == 'true' ) {
			$constant = true;
		}

		if ( $product_registration_link !== '' ) {

			return $product_registration_link . '' . $append;
		} else {

			if ( $option == true || $constant == true ) {
				// bsf menu in settings
				if ( is_multisite() ) {
					return network_admin_url( 'settings.php?page=bsf-registration' . $append );
				} else {
					return admin_url( 'options-general.php?page=bsf-registration' . $append );
				}
			} else {
				if ( is_multisite() ) {
					return network_admin_url( 'admin.php?page=bsf-registration' . $append );
				} else {
					return admin_url( 'index.php?page=bsf-registration' . $append );
				}
			}
		}
	}
}

/**
 * Return extension installer page URL
 */
if ( ! function_exists( 'bsf_exension_installer_url' ) ) {

	function bsf_exension_installer_url( $priduct_id ) {

		if ( is_multisite() ) {

			if ( defined( 'BSF_REG_MENU_TO_SETTINGS' ) && ( BSF_REG_MENU_TO_SETTINGS == true || BSF_REG_MENU_TO_SETTINGS == 'true' ) ) {
				return network_admin_url( 'settings.php?page=bsf-extensions-' . $priduct_id );
			} else {
				return network_admin_url( 'admin.php?page=bsf-extensions-' . $priduct_id );
			}

		} else {
			return admin_url( 'admin.php?page=bsf-extensions-' . $priduct_id );
		}
	}
}

/**
 * Check whether the brainstorm menu needs to be added to WordPress settings menu
 */
if ( ! function_exists( 'bsf_check_brainstorm_menu_location' ) ) {
	
	function bsf_check_brainstorm_menu_location() {

		$bsf_updater_options = get_option( 'bsf_updater_options', array() );

		if ( isset( $bsf_updater_options['brainstorm_menu'] ) && $bsf_updater_options['brainstorm_menu'] == true ) {
			define( 'BSF_REG_MENU_TO_SETTINGS', true );
		}
	}

}

/**
 * Set options based on reading $_GET parameters and $_POST parameters
 *
 * 1. force Check updates
 * 2. Skip Brainstorm Account Registration
 * 3. Reset Brainstorm Registration data
 */
if ( ! function_exists( 'bsf_set_options' ) ) {

	function bsf_set_options() {

		// Force check updates
		if ( isset( $_GET['force-check-update'] ) || isset( $_GET['force-check'] ) ) {

			global $pagenow;

			if ( $pagenow == 'update-core.php' && $_GET['force-check'] == '1' ) {

				global $ultimate_referer;
				$ultimate_referer = 'on-force-check-update-update-core';
				bsf_check_product_update();
				set_transient( 'bsf_check_product_updates', true, 2 * 24 * 60 * 60 );
				update_option( 'bsf_local_transient', current_time( 'timestamp' ) );

			} else {

				global $ultimate_referer;
				$ultimate_referer = 'on-force-check-update';
				bsf_check_product_update();
				set_transient( 'bsf_check_product_updates', true, 2 * 24 * 60 * 60 );
				update_option( 'bsf_local_transient', current_time( 'timestamp' ) );

				if ( is_multisite() ) {
					$redirect = network_admin_url( 'update-core.php#brainstormforce-products' );
				} else {
					$redirect = admin_url( 'update-core.php#brainstormforce-products' );
				}

				echo '<script type="text/javascript">window.location = "' . $redirect . '";</script>';

			}

		}

		// Skip Author registration

		$skip_author_products = apply_filters( 'bsf_skip_author_registration', $products = array() );
		$ids                  = array();
		$skip_author_option   = get_site_option( 'bsf_skip_author', false );
		$brainstorm_products  = bsf_get_brainstorm_products( true );
		foreach ( $brainstorm_products as $key => $product ) {

			if ( isset( $product['id'] ) && ! in_array( $product['id'], $skip_author_products ) ) {
				$ids[] = $product['id'];
			}

		}		

		if ( isset( $_GET['bsf-skip-author'] ) || empty( $ids ) && $skip_author_option == '' ) {
			update_site_option( 'bsf_skip_author', true );
		} elseif ( ! empty( $ids ) && $skip_author_option == '1' ) {
			update_site_option( 'bsf_skip_author', false );
		}

		// Skip Brainstorm Menu

		$skip_brainstorm_menu_products = apply_filters( 'bsf_skip_braisntorm_menu', $products = array() );
		$ids                           = array();
		$skip_brainstorm_menu          = get_site_option( 'bsf_skip_braisntorm_menu', false );
		$brainstorm_products           = bsf_get_brainstorm_products( true );
		foreach ( $brainstorm_products as $key => $product ) {

			if ( isset( $product['id'] ) && ! in_array( $product['id'], $skip_brainstorm_menu_products ) ) {
				$ids[] = $product['id'];
			}

		}

		if ( empty( $ids ) && $skip_brainstorm_menu == '' ) {
			update_site_option( 'bsf_skip_braisntorm_menu', true );
		} elseif ( ! empty( $ids ) && $skip_brainstorm_menu == '1' ) {
			update_site_option( 'bsf_skip_braisntorm_menu', false );
		}

		// Reset Brainstorm Registration

		if ( isset( $_GET['reset-bsf-users'] ) ) {
			delete_option( 'brainstrom_users' );
			delete_option( 'brainstrom_products' );
			delete_option( 'brainstrom_bundled_products' );
			delete_site_transient( 'bsf_get_bundled_products' );
			delete_site_option( 'bsf_skip_author' );
		}

		// Reset Bundled products

		if ( isset( $_GET['remove-bundled-products'] ) ) {

			global $ultimate_referer;
			$ultimate_referer = 'on-refresh-bundled-products';
			delete_option( 'brainstrom_bundled_products' );
			get_bundled_plugins();
			set_site_transient( 'bsf_get_bundled_products', true, 7 * 24 * 60 * 60 );
			update_option( 'bsf_local_transient_bundled', current_time( 'timestamp' ) );

			$redirect = isset( $_GET['redirect'] ) ? urldecode( esc_attr( $_GET['redirect'] ) ) : '';

			if ( $redirect != '' ) {

				$redirect = add_query_arg( 'bsf-reload-page', '', $redirect );
				echo '<script type="text/javascript">window.location = "' . $redirect . '";</script>';
			}			
		}

	}

}

add_action( 'admin_init', 'bsf_set_options', 0 );
add_action( 'network_admin_init', 'bsf_set_options', 0 );

/**
 * Flush skip registration option when any new brainstorm product is installed on the site.
 */
function bsf_flush_skip_registration() {
	delete_site_option( 'bsf_skip_author' );
}

add_action( 'brainstorm_updater_new_product_added', 'bsf_flush_skip_registration' );

/**
 * Return site option brainstorm_products
 *
 * brainstorm_options option saves the data related to all the brainstorm products required for license management and updates.
 *
 * @param (boolean) $mix true: the output will be combined array of themes and plugins.
 * @return (array) $brainstorm_products
 */
if ( ! function_exists( 'bsf_get_brainstorm_products' ) ) {

	function bsf_get_brainstorm_products( $mix = false ) {
		$brainstorm_products = get_option( 'brainstrom_products', array() );
		
		if ( $mix == true ) {
			$plugins = ( isset( $brainstorm_products['plugins'] ) ) ? $brainstorm_products['plugins'] : array();
			$themes  = ( isset( $brainstorm_products['themes'] ) ) ? $brainstorm_products['themes'] : array();

			$brainstorm_products = array_merge( $plugins, $themes );
		}

		return $brainstorm_products;
	}

}
