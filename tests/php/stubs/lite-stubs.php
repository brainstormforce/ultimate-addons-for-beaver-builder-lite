<?php

if ( ! class_exists( 'WPML_Beaver_Builder_Module_With_Items' ) ) {
	class WPML_Beaver_Builder_Module_With_Items {
		// Add any necessary properties or methods
	}
}

if ( ! class_exists( 'FLBuilderModule' ) ) {
	class FLBuilderModule {
		// Add any necessary properties or methods
		/**
		 * Constructor function that initializes required actions and hooks
		 *
		 * @since 1.0
		 */
		function __construct( $settings = array() ) {
		}
	}
}

/**
 * This class initializes BB Ultiamte Addons
 *
 * @class BB_Ultimate_Addon
 */
class BB_Ultimate_Addon {

	/**
	 * Constructor function that initializes required actions and hooks
	 *
	 * @since 1.0
	 */
	function __construct() {
	}
	/**
	 * Function which resets the plugin activation if necessary memmory not found
	 *
	 * @Since 1.0
	 */
	function activation_reset() {
	}
	/**
	 * Memory Limit function that checks for memory limit for the UABB plugin
	 *
	 * @Since 1.0
	 */
	function check_memory_limit() {
	}
}
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
	}
	/**
	 * Sets the activate redirect url to the network admin settings.
	 *
	 * @since 1.0
	 * @param string $url gets the activate redirect URL.
	 */
	public static function uabb_lite_redirect_on_activation( $url ) {
	}
	/**
	 * Save network admin settings and enqueue scripts.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function admin_init() {
	}
	/**
	 * Renders the network admin menu for multisite installs.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function menu() {
	}
}
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
	}
	/**
	 * Function that renders links
	 *
	 * @since 1.0
	 * @param string $actions gets an link.
	 */
	function uabb_render_plugin_action_links( $actions ) {
	}
	/**
	 * Function that includes necessary files
	 *
	 * @since 1.0
	 */
	function includes() {
	}
	/**
	 *   For Performance.
	 *   Set UABB static object to store data from database.
	 */
	static function set_uabb_options() {
	}
	/**
	 * Function that renders UABB Global Settings form defaults
	 *
	 * @since 1.0
	 * @param array  $defaults gets the array for the form defaults.
	 * @param string $form_type gets an array to check the form type.
	 */
	function uabb_global_settings_form_defaults( $defaults, $form_type ) {
	}
	/**
	 * Function that initializes init function
	 *
	 * @since 1.0
	 */
	function init() {
	}
	/**
	 * Function that renders UABB's Text-domain.
	 *
	 * @since 1.0
	 */
	function load_plugin_textdomain() {
	}
	/**
	 * Function that loads UABB's scripts
	 *
	 * @since 1.0
	 */
	function load_scripts() {
	}
	/**
	 * Function that renders admin notices
	 *
	 * @since 1.0
	 */
	function admin_notices() {
	}
	/**
	 * Function that loads the modules.
	 *
	 * @since 1.0
	 */
	function load_modules() {
	}
}
/**
 * This class initializes BB Ultiamte Addon Helper
 *
 * @class BB_Ultimate_Addon_Helper
 */
class BB_Ultimate_Addon_Helper {

	/**
	 * Holds any category strings of modules.
	 *
	 * @since 1.0
	 * @var $basic_modules Category Strings
	 */
	public static $basic_modules = '';
	/**
	 * Constructor function that initializes required actions and hooks
	 *
	 * @since 1.0
	 */
	function __construct() {
	}
	/**
	 * Function that set constants for UABB
	 *
	 * @since 1.0
	 */
	function set_constants() {
	}
	/**
	 * Function that renders BB's modules category
	 *
	 * @since 1.0
	 * @param array $cat gets the BB's UI ControlPanel Category.
	 */
	public static function module_cat( $cat ) {
	}
	/**
	 * Function that renders builder UABB
	 *
	 * @since 1.0
	 */
	public static function get_builder_uabb() {
	}
	/**
	 * Function that renders extensions for the UABB
	 *
	 * @since 1.0
	 * @param string $request_key gets the request key's value.
	 */
	public static function get_builder_uabb_branding( $request_key = '' ) {
	}
	/**
	 * Function that renders all the UABB modules
	 *
	 * @since 1.0
	 */
	public static function get_all_modules() {
	}
	/**
	 * Function that renders premium modules
	 *
	 * @since 1.0
	 */
	public static function get_premium_modules() {
	}
	/**
	 * Function that renders UABB's modules
	 *
	 * @since 1.0
	 */
	public static function get_builder_uabb_modules() {
	}
	/**
	 *  Template status
	 *
	 *  Return the status of pages, sections, presets or all templates. Default: all
	 *
	 *  @param string $templates_type gets the templates type.
	 *  @return boolean
	 */
	public static function is_templates_exist( $templates_type = 'all' ) {
	}
	/**
	 *  Get link rel attribute
	 *
	 *  @since 1.0
	 *  @param string $target gets an string for the link.
	 *  @param string $is_nofollow gets an string for is no follow.
	 *  @param string $echo gets an string for echo.
	 *  @return string
	 */
	public static function get_link_rel( $target, $is_nofollow = 0, $echo = 0 ) {
	}
}
/**
 * This class initializes UABB Attachment
 *
 * @class UABB_Attachment
 */
class UABB_Attachment {

	/**
	 * Constructor function that initializes required actions and hooks
	 *
	 * @since 1.0
	 */
	function __construct() {
	}
	/**
	 * Add CTA Link field to media uploader
	 *
	 * @param array  $form_fields array, fields to include in attachment form.
	 * @param object $post object, attachment record in database.
	 * @return $form_fields, modified form fields
	 */
	function uabb_attachment_field_cta( $form_fields, $post ) {
	}
	/**
	 * Save values of CTA Link field in media uploader
	 *
	 * @param array $post array, the post data for database.
	 * @param array $attachment array, attachment fields from $_POST form.
	 * @return array $post array, modified post data.
	 */
	function uabb_attachment_field_cta_save( $post, $attachment ) {
	}
}
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
	public static $errors = array();
	/**
	 * Initializes the admin settings.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function init() {
	}
	/**
	 * Adds the admin menu and enqueues CSS/JS if we are on
	 * the builder admin settings page.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function init_hooks() {
	}
	/**
	 * Enqueues the needed CSS/JS for the builder's admin settings page.
	 *
	 * @since 1.3.0
	 */
	public static function notice_styles_scripts() {
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
	}
	/**
	 * Ask Plugin Rating
	 *
	 * @since 1.3.0
	 */
	public static function register_notices() {
	}
	/**
	 * Renders the admin settings menu.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function menu() {
	}
	/**
	 * Enqueues the needed CSS/JS for the builder's admin settings page.
	 *
	 * @since 1.0
	 * @param hook $hook get the hooks for the styles.
	 * @return void
	 */
	public static function styles_scripts( $hook ) {
	}
	/**
	 * Renders the admin settings.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function render() {
	}
	/**
	 * Renders the page class for network installs and single site installs.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function render_page_class() {
	}
	/**
	 * Renders the admin settings page heading.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function render_page_heading() {
	}
	/**
	 * Renders the update message.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function render_update_message() {
	}
	/**
	 * Renders the nav items for the admin settings menu.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function render_nav_items() {
	}
	/**
	 * Renders the admin settings forms.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function render_forms() {
	}
	/**
	 * Renders an admin settings form based on the type specified.
	 *
	 * @since 1.0
	 * @param string $type The type of form to render.
	 * @return void
	 */
	public static function render_form( $type ) {
	}
	/**
	 * Renders the action for a form.
	 *
	 * @since 1.0
	 * @param string $type The type of form being rendered.
	 * @return void
	 */
	public static function render_form_action( $type = '' ) {
	}
	/**
	 * Returns the action for a form.
	 *
	 * @since 1.0
	 * @param string $type The type of form being rendered.
	 * @return string The URL for the form action.
	 */
	public static function get_form_action( $type = '' ) {
	}
	/**
	 * Checks to see if a settings form is supported.
	 *
	 * @since 1.0
	 * @param string $type The type of form to check.
	 * @return bool
	 */
	public static function has_support( $type ) {
	}
	/**
	 * Checks to see if multisite is supported.
	 *
	 * @since 1.0
	 * @return bool
	 */
	public static function multisite_support() {
	}
	/**
	 * Adds an error message to be rendered.
	 *
	 * @since 1.0
	 * @param string $message The error message to add.
	 * @return void
	 */
	public static function add_error( $message ) {
	}
	/**
	 * Saves the admin settings.
	 *
	 * @since 1.0
	 * @return void
	 */
	public static function save() {
	}
}
/**
 * Class UABBLite_WPML_Translatable.
 *
 * @since 1.2.2
 */
final class UABBLite_WPML_Translatable {

	/**
	 * Call nodes.
	 *
	 * @since 1.2.2
	 * @return void
	 */
	public static function init() {
	}
	/**
	 * Load files.
	 *
	 * @since 1.2.2
	 */
	public static function load_files() {
	}
	/**
	 * Initialize nodes to translate
	 *
	 * @since 1.2.2
	 * @param array $form gets the forms array to be resolved.
	 * @return array
	 */
	public static function wpml_uabb_modules_translate( $form ) {
	}
}
/**
 * UABB_Plugin_Backward initial setup
 *
 * @since 1.3.0
 */
class UABB_Lite_Compatibility {

	/**
	 * Holds BB current version.
	 *
	 * @since 1.3.0
	 * @var $version_bb_check
	 */
	public static $version_bb_check;
	/**
	 * Holds uabb migration status.
	 *
	 * @since 1.3.0
	 * @var $uabb_migration
	 */
	public static $uabb_migration;
	/**
	 * Holds BB new page status.
	 *
	 * @since 1.3.0
	 * @var $stable_version_new_page
	 */
	public static $stable_version_new_page;
	/**
	 * Initiator
	 */
	public static function get_instance() {
	}
	/**
	 * Check the BB's New version.
	 *
	 * @since 1.3.0
	 * @return bool self::$version_bb_check
	 */
	public static function check_bb_version() {
	}
	/**
	 * Check if the page is created before UABB version 1.6.9 and is successfully migrated in between version 1.7.0 - version 1.13.2
	 *
	 * @since 1.3.0
	 * @return string self::$uabb_migration
	 */
	public static function check_old_page_migration() {
	}
	/**
	 * Check if the page is created in between UABB version 1.7.0 - version 1.13.2
	 *
	 * @since 1.3.0
	 * @return bool self::$stable_version_new_page
	 */
	public static function check_stable_version_new_page() {
	}
}
/**
 * UABB_lite_Plugin_Backward initial setup
 *
 * @since 1.2.4
 */
class UABB_lite_Plugin_Backward {

	/**
	 * Initiator
	 */
	public static function get_instance() {
	}
	/**
	 *  Constructor
	 */
	public function __construct() {
	}
	/**
	 * Set UABB version for new page.
	 *
	 * @since 1.2.4
	 * @param var $new_status Checks the value if user is new.
	 * @param var $old_status Checks the value if user is old.
	 * @param var $post Checks the value of the post.
	 * @return void
	 */
	public function post_status( $new_status, $old_status, $post ) {
	}
	/**
	 * Execute Layout Data.
	 *
	 * @since 1.2.4
	 * @param var $post_id Gets the post ID.
	 * @return void
	 */
	public function layout_data_execute( $post_id ) {
	}
	/**
	 * Execute Layout Draft.
	 *
	 * @since 1.2.4
	 * @param var $post_id gets the Post ID of the layout draft execute.
	 * @return void
	 */
	public function layout_draft_execute( $post_id ) {
	}
	/**
	 * Implement UABB update logic.
	 *
	 * @since 1.2.4
	 * @return void
	 */
	public function update_data() {
	}
	/**
	 * UABB Flip Box.
	 *
	 * @since 1.2.4
	 * @param object $settings gets the settings of respective module.
	 * @return void
	 */
	public function uabb_flip_box( &$settings ) {
	}
	/**
	 * UABB Info List.
	 *
	 * @since 1.2.4
	 * @param object $settings gets the settings of respective module.
	 * @return void
	 */
	public function uabb_info_list( &$settings ) {
	}
	/**
	 * UABB Info Table.
	 *
	 * @since 1.2.4
	 * @param object $settings gets the settings of respective module.
	 * @return void
	 */
	public function uabb_info_table( &$settings ) {
	}
	/**
	 * UABB Ribbon.
	 *
	 * @since 1.2.4
	 * @param object $settings gets the settings of respective module.
	 * @return void
	 */
	public function uabb_ribbon( &$settings ) {
	}
	/**
	 * UABB Slide Box.
	 *
	 * @since 1.2.4
	 * @param object $settings gets the settings of respective module.
	 * @return void
	 */
	public function uabb_slide_box( &$settings ) {
	}
	/**
	 * UABB Button.
	 *
	 * @since 1.2.4
	 * @param object $settings gets the settings of respective module.
	 * @return void
	 */
	public function uabb_button( &$settings ) {
	}
}
/**
 * UABB_IconFonts setup
 *
 * @since 1.0
 * @package UABB Iconfonts
 */
/**
 * This class initializes UABB IconFonts
 *
 * @class UABB_IconFonts
 */
class UABB_IconFonts {

	/**
	 *  Constructor
	 */
	public function __construct() {
	}
	/**
	 * Function that initializes UABB reload Icons
	 *
	 * @since 1.0
	 */
	public function init() {
	}
	/**
	 * Function that renders reload Icons
	 *
	 * @since 1.0
	 */
	function reload_icons() {
	}
	/**
	 * Function that registers UABB Icons
	 *
	 * @since 1.0
	 */
	function register_icons() {
	}
	/**
	 * Function that renders recurse copy for Icons
	 *
	 * @since 1.0
	 * @param array $src an array to get the src.
	 * @param array $dst an object to get destination of the file.
	 */
	function recurse_copy( $src, $dst ) {
	}
}
/**
 *  UABB Info List file for WMPL
 *
 *  @package UABB Info List WPML Compatibility
 */
/**
 * Here WPML_UABB_Infolist extends WPML_Beaver_Builder_Module_With_Items
 *
 * @class WPML_UABB_Infolist
 */
class WPML_UABB_Infolist extends WPML_Beaver_Builder_Module_With_Items {

	/**
	 * Function that renders Info List values
	 *
	 * @since 1.6.7
	 * @param object $settings an object to get values of Info List.
	 */
	public function &get_items( $settings ) {
	}
	/**
	 * Function that renders Info List's fields value
	 *
	 * @since 1.6.7
	 */
	public function get_fields() {
	}
	/**
	 * Function that renders title of the Info List module
	 *
	 * @since 1.6.7
	 * @param array $field gets the translated field values of the Info List.
	 */
	protected function get_title( $field ) {
	}
	/**
	 * Function that renders editor type of the Info List fields values
	 *
	 * @since 1.6.7
	 * @param array $field gets an field type of the WPML editor.
	 */
	protected function get_editor_type( $field ) {
	}
}
/**
 * UABB_UI_Panels setup
 *
 * @since 1.0
 * @package UABB UI Panels Setup
 */
/**
 * This class initializes UABB UI Panels
 *
 * @class UABB_UI_Panels
 */
class UABB_UI_Panels {

	/**
	 *  Constructor
	 */
	public function __construct() {
	}
	/**
	 *  Function to add toggle UABB User Interface.
	 *
	 *  @since 1.0
	 */
	function toggle_uabb_ui() {
	}
	/**
	 *  Function that initializes template selector data.
	 *
	 *  @since 1.0
	 */
	public function init() {
	}
	/**
	 *  Filter Templates
	 *  Add additional information in templates array
	 *
	 *  @since 1.0
	 *  @param array $template_data Gets the tags for the Template Data.
	 *  @param array $template Gets the author for the Template Data.
	 */
	function uabb_fl_builder_template_selector_data( $template_data, $template ) {
	}
	/**
	 * Affiliate link override function
	 *
	 * @since 1.0
	 * @param string $url Returns the URL of the Affiliate URL.
	 */
	function uabb_affiliate_url( $url ) {
	}
	/**
	 * Affiliate link override function
	 *
	 * @since 1.0
	 * @param string $url Returns the Key shortcut for showUABBGlobalSettings.
	 */
	function uabb_bsf_registration_page_url( $url ) {
	}
	/**
	 * Function that displays the UABB License Form Heading
	 *
	 * @since 1.0
	 * @param string $form_heading Gets the form Heading.
	 * @param string $license_status_class Gets the license status class.
	 * @param string $license_status Gets the license status.
	 */
	function uabb_bsf_license_form_heading( $form_heading, $license_status_class, $license_status ) {
	}
	/**
	 * Skip Brainstorm Registration screen for UABB users
	 *
	 * @param array $products Gets an array of Products.
	 */
	function uabb_skip_brainstorm_menu( $products ) {
	}
	/**
	 * Render Global uabb-layout-builder js
	 *
	 * @since 1.0
	 * @param file   $js Gets the js file contents.
	 * @param array  $nodes Gets the nodes of the layout builder.
	 * @param object $global_settings Gets the object for the Layout builder.
	 */
	function fl_uabb_render_js( $js, $nodes, $global_settings ) {
	}
	/**
	 * Render Global uabb-layout-builder css
	 *
	 * @since 1.0
	 * @param file   $css Gets the CSS file contents.
	 * @param array  $nodes Gets the nodes of the layout builder.
	 * @param object $global_settings Gets the object for the Layout builder.
	 */
	function fl_uabb_render_css( $css, $nodes, $global_settings ) {
	}
	/**
	 * Function that renders Config and templates function
	 *
	 * @since 1.0
	 */
	function config() {
	}
	/**
	 * Load cloud templates
	 *
	 * @since 1.0
	 */
	function load_templates() {
	}
	/**
	 * Function that renders Before Row Layouts
	 *
	 * @since 1.0
	 */
	function uabb_panel_before_row_layouts() {
	}
	/**
	 *  1. Return all templates 'excluding' UABB templates. If variable $status is set to 'exclude'. Default: 'exclude'
	 *  2. Return ONLY UABB templates. If variable $status is NOT set to 'exclude'.
	 *
	 * @since 1.0
	 * @param array $templates Gets the array of UABB templates.
	 * @param var   $status Checks for the status of UABB templates.
	 */
	public static function uabb_templates_data( $templates, $status = 'exclude' ) {
	}
	/**
	 *  Add Buttons to panel
	 *
	 * Row button added to the panel
	 *
	 * @since 1.0
	 * @param array $buttons Gets the buttons array for UI panel.
	 */
	function builder_ui_bar_buttons( $buttons ) {
	}
	/**
	 *  Load Rows Panel
	 *
	 * Row panel showing sections - rows & modules
	 *
	 * @since 1.0
	 */
	function render_ui() {
	}
	/**
	 * Function that renders live preview
	 *
	 * @since 1.0
	 */
	function render_live_preview() {
	}
	/**
	 * Enqueue Panel CSS and JS
	 */
	function uabb_panel_css_js() {
	}
}
/**
 * UABB_Plugin_Update initial setup
 *
 * @since 1.2.4
 */
class UABB_lite_Plugin_Update {

	/**
	 * Initiator
	 */
	public static function get_instance() {
	}
	/**
	 *  Constructor
	 */
	public function __construct() {
	}
	/**
	 * Implement UABB update logic.
	 *
	 * @since 1.2.4
	 * @return void
	 */
	public static function init() {
	}
}
/**
 *  Global Styling
 *
 *  @since 1.0
 *  @package Global Styling
 */
/**
 * This class initializes UABB Global Styling
 *
 *  @since 1.0
 * @class UABB_Global_Styling
 */
class UABB_Global_Styling {

	/**
	 * Constructor function that initializes required actions and hooks
	 */
	public function __construct() {
	}
	/**
	 * Function to add options for UABB Global Settings
	 *
	 * @since 1.0
	 */
	function add_options() {
	}
	/**
	 * Function that initializes actions for UABB Global Settings
	 *
	 * @since 1.0
	 */
	public static function init_actions() {
	}
	/**
	 * Function to that renders UABB Global Settings
	 *
	 * @since 1.0
	 */
	public static function render_uabb_global_settings() {
	}
	/**
	 * Function that gets UABB Global Settings
	 *
	 * @since 1.0
	 */
	public static function get_uabb_global_settings() {
	}
	/**
	 * Function to that saves UABB Global Settings
	 *
	 * @since 1.0
	 * @param array $settings gets a array of old and new settings values.
	 */
	public static function save_uabb_global_settings( $settings = array() ) {
	}
}
/**
 * This class initializes BB Ultiamte Addon Helper
 *
 * @class UABB_Helper
 */
class UABB_Helper {

	/**
	 * Helper function to render css styles for a selected font.
	 *
	 * @since  1.0
	 * @param  array $font An array with font-family and weight.
	 * @return void
	 */
	public static function uabb_font_css( $font ) {
	}
	/**
	 * Initializes an array to replace recursive function
	 *
	 * @param var   $hex returns the bas values.
	 *
	 * @param array $opacity returns the replacements values.
	 */
	public static function uabb_get_color( $hex, $opacity ) {
	}
	/**
	 * Initializes an array to replace recursive function
	 *
	 * @param var   $color returns the bas values.
	 *
	 * @param array $opacity returns the replacements values.
	 * @param array $is_array returns the replacements values.
	 */
	public static function uabb_hex2rgba( $color, $opacity = \false, $is_array = \false ) {
	}
	/**
	 * Initializes an array to replace recursive function
	 *
	 * @param var   $settings returns the bas values.
	 *
	 * @param array $name returns the replacements values.
	 * @param array $opc returns the replacements values.
	 */
	public static function uabb_colorpicker( $settings, $name = '', $opc = \false ) {
	}
	/**
	 * Initializes an array to replace recursive function
	 *
	 * @param var $gradient returns the bas values.
	 */
	public static function uabb_gradient_css( $gradient ) {
	}
	/**
	 *  Get link rel attribute
	 *
	 *  @since 1.3.0
	 *  @param string $target gets an string for the link.
	 *  @param string $is_nofollow gets an string for is no follow.
	 *  @param string $echo gets an string for echo.
	 *  @return string
	 */
	public static function get_link_rel( $target, $is_nofollow = 0, $echo = 0 ) {
	}
}
/**
 *  Global Styling.
 *
 *  @package Global Styling.
 */
/**
 * This class initializes UABB Global Styling.
 *
 * @class UABBGlobalSetting.
 */
final class UABBGlobalSetting {

	/**
	 * Function that initializes actions for UABB Global Settings.
	 *
	 * @since 1.0
	 */
	public static function init() {
	}
	/**
	 * Function that initializes actions for UABB Global Settings.
	 *
	 * @param  String $js_strings slug.
	 * @since 1.0
	 */
	public static function add_js_string( $js_strings ) {
	}
}
/**
 * This class initializes UABB Global Settings Options
 *
 * @class UABBGlobalSettingsOptions
 */
class UABBGlobalSettingsOptions {

	/**
	 * Constructor function that initializes necessary filters
	 *
	 * @var $uabb_setting_options gets the uabb setting options
	 */
	public $uabb_setting_options;
	/**
	 * Constructor function that initializes necessary filters
	 *
	 * @since 1.0
	 */
	function __construct() {
	}
	/**
	 * Function that initializes global settings options
	 *
	 * @since 1.0
	 * @param object $option gets the options for the UABB settings.
	 * @param var    $color gets the color.
	 * @param var    $opc gets the opacity for the colorpicker.
	 */
	function uabb_get_global_option( $option, $color = \false, $opc = \false ) {
	}
	/**
	 * Theme Color -
	 */
	function uabb_global_theme_color() {
	}
	/**
	 * Text Color -
	 */
	function uabb_global_text_color() {
	}
	/**
	 * Link Color -
	 */
	function uabb_global_link_color() {
	}
	/**
	 * Link Hover Color -
	 */
	function uabb_global_link_hover_color() {
	}
	/**
	 * Button Font Family
	 */
	function uabb_global_button_font_family() {
	}
	/**
	 * Button Font Size -
	 */
	function uabb_global_button_font_size() {
	}
	/**
	 * Button Line Height -
	 */
	function uabb_global_button_line_height() {
	}
	/**
	 * Button Letter Spacing -
	 */
	function uabb_global_button_letter_spacing() {
	}
	/**
	 * Button Text Transform -
	 */
	function uabb_global_button_text_transform() {
	}
	/**
	 * Button Text Color -
	 */
	function uabb_global_button_text_color() {
	}
	/**
	 * Button Text Hover Color -
	 */
	function uabb_global_button_text_hover_color() {
	}
	/**
	 * Button Background Color -
	 */
	function uabb_global_button_bg_color() {
	}
	/**
	 * Button Background Hover Color -
	 */
	function uabb_global_button_bg_hover_color() {
	}
	/**
	 * Button Border Radius -
	 */
	function uabb_global_button_border_radius() {
	}
	/**
	 * Button Padding -
	 */
	function uabb_global_button_padding() {
	}
	/**
	 * Button Padding -
	 */
	function uabb_global_button_vertical_padding() {
	}
	/**
	 * Button Padding -
	 */
	function uabb_global_button_horizontal_padding() {
	}
}
/**
 * This class initializes UABB Cloud Templates
 *
 * @class UABB_Cloud_Templates
 */
class UABB_Cloud_Templates {

	/**
	 * Holds an UABB file system.
	 *
	 * @since 1.0
	 * @var $uabb_filesystem UABB filesystem
	 */
	protected static $uabb_filesystem = \null;
	/**
	 *  Initiator
	 *
	 * @since 1.0
	 */
	public static function get_instance() {
	}
	/**
	 * Constructor function that initializes required actions and hooks
	 *
	 * @since 1.0
	 */
	function __construct() {
	}
	/**
	 * Transient cloud templates
	 *
	 * @since 1.0
	 */
	static function reset_cloud_transient() {
	}
	/**
	 * Get cloud templates
	 *
	 * @since 1.0
	 * @param string $type gets the type of the cloud templates.
	 */
	static function get_cloud_templates_count( $type = '' ) {
	}
	/**
	 * Get cloud templates
	 *
	 * @since 1.0
	 * @param string $type gets the type of the cloud templates.
	 */
	static function get_cloud_templates( $type = '' ) {
	}
	/**
	 * Fetch cloud templates
	 *
	 * @since 1.0
	 */
	function fetch_cloud_templates() {
	}
	/**
	 * Function that renders dat file type
	 *
	 * @since 1.0
	 * @param file $dat_file_type gets the DAT file type.
	 */
	function get_right_type_key( $dat_file_type ) {
	}
	/**
	 * Function that renders load filesystem
	 *
	 * @since 1.0
	 */
	public static function load_filesystem() {
	}
	/**
	 * Messages
	 *
	 * @since 1.0
	 * @param string $msg gets an string message.
	 */
	static function message( $msg ) {
	}
	/**
	 * Template HTML
	 *
	 * @since 1.0
	 * @param string $type gets the type page-templates.
	 */
	static function template_html( $type = 'page-templates' ) {
	}
	/**
	 * Create local directory if not exist.
	 *
	 * @since 1.0
	 * @param string $dir_name verifies the dir name with bb-ultimate-addon.
	 */
	public static function create_local_dir( $dir_name = 'bb-ultimate-addon' ) {
	}
}
/**
 * This class initializes BB options and required fields
 *
 * @class UABB_BBThemeGlobalIntegration
 */
class UABB_BBThemeGlobalIntegration {

	/**
	 * Gets the Beaver Builder theme's options
	 *
	 * @var $bb_options
	 */
	public $bb_options;
	/**
	 * Constructor function that initializes required actions and hooks
	 */
	function __construct() {
	}
	/**
	 * Theme Color -
	 */
	function uabb_global_theme_color() {
	}
	/**
	 * Theme Text Color -
	 */
	function uabb_global_text_color() {
	}
	/**
	 * Button Background Color -
	 */
	function uabb_global_button_bg_color() {
	}
	/**
	 * Button Background Hover Color -
	 */
	function uabb_global_button_bg_hover_color() {
	}
	/**
	 * Button Text Color -
	 */
	function uabb_global_button_text_color() {
	}
	/**
	 * Button Text Hover Color -
	 */
	function uabb_global_button_text_hover_color() {
	}
}
/**
 * BSF analytics stat class.
 */
class BSF_Analytics_Stats {

	/**
	 * Create only once instance of a class.
	 *
	 * @return object
	 * @since 1.0.0
	 */
	public static function instance() {
	}
	/**
	 * Get stats.
	 *
	 * @return array stats data.
	 * @since 1.0.0
	 */
	public function get_stats() {
	}
	/**
	 * Format plugin data.
	 *
	 * @param string $plugin plugin.
	 * @return array formatted plugin data.
	 * @since 1.0.0
	 */
	public function format_plugin( $plugin ) {
	}
}
/**
 * BSF analytics
 */
class BSF_Analytics {

	/**
	 * Setup actions, load files.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
	}
	/**
	 * BSF Analytics URL
	 *
	 * @return String URL of bsf-analytics directory.
	 * @since 1.0.0
	 */
	public function bsf_analytics_url() {
	}
	/**
	 * Enqueue Scripts.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function enqueue_assets() {
	}
	/**
	 * Send analytics API call.
	 *
	 * @since 1.0.0
	 */
	public function send() {
	}
	/**
	 * Check if usage tracking is enabled.
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function is_tracking_enabled() {
	}
	/**
	 * Check if WHITE label is enabled for BSF products.
	 *
	 * @return bool
	 * @since 1.0.0
	 */
	public function is_white_label_enabled() {
	}
	/**
	 * Display admin notice for usage tracking.
	 *
	 * @since 1.0.0
	 */
	public function option_notice() {
	}
	/**
	 * Process usage tracking opt out.
	 *
	 * @since 1.0.0
	 */
	public function handle_optin_optout() {
	}
	/**
	 * Add two days event schedule variables.
	 *
	 * @param array $schedules scheduled array data.
	 * @since 1.0.0
	 */
	public function every_two_days_schedule( $schedules ) {
	}
	/**
	 * Register usage tracking option in General settings page.
	 *
	 * @since 1.0.0
	 */
	public function register_usage_tracking_setting() {
	}
	/**
	 * Sanitize Callback Function
	 *
	 * @param bool $input Option value.
	 * @since 1.0.0
	 */
	public function sanitize_option( $input ) {
	}
	/**
	 * Print settings field HTML.
	 *
	 * @since 1.0.0
	 */
	public function render_settings_field_html() {
	}
	/**
	 * Schedule/unschedule cron event on updation of option.
	 *
	 * @param string $old_value old value of option.
	 * @param string $value value of option.
	 * @param string $option Option name.
	 * @since 1.0.0
	 */
	public function update_analytics_option_callback( $old_value, $value, $option ) {
	}
	/**
	 * Analytics option add callback.
	 *
	 * @param string $option Option name.
	 * @param string $value value of option.
	 * @since 1.0.0
	 */
	public function add_analytics_option_callback( $option, $value ) {
	}
	/**
	 * Schedule or unschedule event based on analytics option value.
	 *
	 * @since 1.0.0
	 */
	public function schedule_unschedule_event() {
	}
	/**
	 * Save analytics option to network.
	 *
	 * @param string $value value of option.
	 * @since 1.0.0
	 */
	public function add_option_to_network( $value ) {
	}
}
/**
 * Astra_Notices
 *
 * @since 1.0.0
 */
class Astra_Notices {

	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object initialized object of class.
	 */
	public static function get_instance() {
	}
	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
	}
	/**
	 * Filters and Returns a list of allowed tags and attributes for a given context.
	 *
	 * @param array  $allowedposttags array of allowed tags.
	 * @param string $context Context type (explicit).
	 * @since 1.0.0
	 * @return array
	 */
	public function add_data_attributes( $allowedposttags, $context ) {
	}
	/**
	 * Add Notice.
	 *
	 * @since 1.0.0
	 * @param array $args Notice arguments.
	 * @return void
	 */
	public static function add_notice( $args = array() ) {
	}
	/**
	 * Dismiss Notice.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function dismiss_notice() {
	}
	/**
	 * Enqueue Scripts.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function enqueue_scripts() {
	}
	/**
	 * Sort the notices based on the given priority of the notice.
	 * This function is called from usort()
	 *
	 * @since 1.5.2
	 * @param array $notice_1 First notice.
	 * @param array $notice_2 Second Notice.
	 * @return array
	 */
	public function sort_notices( $notice_1, $notice_2 ) {
	}
	/**
	 * Display the notices in the WordPress admin.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function show_notices() {
	}
	/**
	 * Render a notice.
	 *
	 * @since 1.0.0
	 * @param  array $notice Notice markup.
	 * @return void
	 */
	public static function markup( $notice = array() ) {
	}
	/**
	 * Get base URL for the astra-notices.
	 *
	 * @return mixed URL.
	 */
	public static function get_url() {
	}
}
/**
 * This class initializes Gradient
 *
 * @class UABB_Gradient
 */
class UABB_Gradient {

	/**
	 * Constructor function that initializes required actions
	 *
	 * @since 1.0
	 */
	function __construct() {
	}
	/**
	 * Function that renders row's CSS
	 *
	 * @since 1.0
	 * @param array $fields gets the fields for the gradient.
	 */
	function ui_fields( $fields ) {
	}
	/**
	 * Function that renders row's CSS
	 * Declaration of array
	 * Ex. 'YOUR_VARIABLE_NAME'     => array(
	 * 'type'    => 'uabb-gradient',
	 * 'label'   => __( 'Gradient', 'uabb' ),
	 * 'default'  => array  //Required NULL or Default value
	 * 'color_one' => '',
	 * 'color_two' => '',
	 * 'angle'     => '0',
	 *  )
	 *  )
	 * Note : Default value is required here. Either pass it NULL or enter your own value.
	 * How to access variables
	 * fl-node-<?php echo $id; ?> .YOUR-CLASS{
	 *  <?php UABB_Helper::uabb_gradient_css( $settings->YOUR_VARIABLE_NAME ); ?>
	 * }
	 *
	 * @since 1.0
	 * @param var    $name gets the name for the gradient field.
	 * @param array  $value gets an array of gradient values.
	 * @param array  $field gets an array of field values.
	 * @param object $settings gets the object of respective fields.
	 */
	function uabb_gradient( $name, $value, $field, $settings ) {
	}
}
/**
 * Class to enqueue field scripts
 *
 * @package  UABB_Custom_Field_Scripts
 */
class UABB_Custom_Field_Scripts {

	/**
	 * Constructor that initializes custom field scripts
	 *
	 * @since 1.0
	 */
	function __construct() {
	}
	/**
	 * Function that enqueue styles and scripts
	 *
	 * @since 1.0
	 */
	function custom_field_scripts() {
	}
}
/**
 *  UABB Spacer Gap Module file.
 *
 *  @package UABB Spacer Gap Module
 */
/**
 * Function that initializes UABB Spacer Gap Module.
 *
 * @class UABBSpacerGap
 */
class UABBSpacerGap extends \FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Spacer Gap Module
	 *
	 * @method __construct
	 */
	public function __construct() {
	}
}
/**
 *  UABB Button Module file
 *
 *  @package UABB Button Module
 */
/**
 * Function that initializes UABB Button Module
 *
 * @class UABBButtonModule
 */
class UABBButtonModule extends \FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Button Module
	 *
	 * @method __construct
	 */
	public function __construct() {
	}
	/**
	 * Function that gets the button styling.
	 *
	 * @method update
	 * @param object $settings gets the settings for the button module.
	 */
	public function update( $settings ) {
	}
	/**
	 * Function that gets the class names.
	 *
	 * @method get_classname
	 */
	public function get_classname() {
	}
	/**
	 * Function that gets the button styling.
	 *
	 * @method get_button_style
	 */
	public function get_button_style() {
	}
	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {
	}
}
/**
 *  UABB Flip Box Module file
 *
 *  @package UABB Flip Box Module
 */
/**
 * Function that initializes UABB Flip Box Module
 *
 * @class FlipBoxModule
 */
class FlipBoxModule extends \FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Flip Box Module
	 *
	 * @method __construct
	 */
	public function __construct() {
	}
	/**
	 * Function that gets the Icons for the Flip Box module
	 *
	 * @method get_icons
	 * @param string $icon gets an string to check if $icon is referencing an included icon.
	 */
	public function get_icon( $icon = '' ) {
	}
	/**
	 * Function that renders the button for the button
	 *
	 * @method render_button
	 */
	public function render_button() {
	}
	/**
	 * Function that renders the Icon or Photo for the Flip Box
	 *
	 * @method render_icon
	 */
	public function render_icon() {
	}
	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {
	}
}
/**
 *  UABB Advanced Icon Module file
 *
 *  @package UABB Advanced Icon Module
 */
/**
 * Function that initializes UABB Advanced Icon Module
 *
 * @class UABBAdvancedIconModule
 */
class UABBAdvancedIconModule extends \FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Advanced Icon module.
	 *
	 * @method __construct
	 */
	public function __construct() {
	}
}
/**
 *  UABB Image Separator Module file
 *
 *  @package UABB Image Separator Module
 */
/**
 * Function that initializes Image Separator Module
 *
 * @class UABBImageSeparatorModule
 */
class UABBImageSeparatorModule extends \FLBuilderModule {

	/**
	 * Variable for Image Separator module
	 *
	 * @property $data
	 * @var $data
	 */
	public $data = \null;
	/**
	 * Variable for Image Separator module
	 *
	 * @property $_editor
	 * @protected
	 * @var $_editor
	 */
	protected $_editor = \null;
	/**
	 * Constructor function that constructs default values for the Image Separator Module
	 *
	 * @method __construct
	 */
	public function __construct() {
	}
	/**
	 * Function to update the Image src
	 *
	 * @method update
	 * @param obejct $settings gets the settings for the object.
	 */
	public function update( $settings ) {
	}
	/**
	 * Function to delete the cropped image src
	 *
	 * @method delete
	 */
	public function delete() {
	}
	/**
	 * Function to crop the the existing image
	 *
	 * @method crop
	 */
	public function crop() {
	}
	/**
	 * Function to get the Image src
	 *
	 * @method get_data
	 */
	public function get_data() {
	}
	/**
	 * Function to get the classes for the Image src
	 *
	 * @method get_classes
	 */
	public function get_classes() {
	}
	/**
	 * Function to get src for the Image src
	 *
	 * @method get_src
	 */
	public function get_src() {
	}
	/**
	 * Function to get alternate val for the Image
	 *
	 * @method get_alt
	 */
	public function get_alt() {
	}
	/**
	 * Function to check for the Image src
	 *
	 * @method _has_source
	 * @protected
	 */
	protected function _has_source() {
	}
	/**
	 * Function to get the editor for the Image src
	 *
	 * @method _get_editor
	 * @protected
	 */
	protected function _get_editor() {
	}
	/**
	 * Function to get th cropped path for the Image src
	 *
	 * @method _get_cropped_path
	 * @protected
	 */
	protected function _get_cropped_path() {
	}
	/**
	 * Function to get the uncropped url of the Image src
	 *
	 * @method _get_uncropped_url
	 * @protected
	 */
	protected function _get_uncropped_url() {
	}
	/**
	 * Function to get the uncropped url of the Image src
	 *
	 * @method _get_uncropped_url
	 * @protected
	 */
	protected function _get_cropped_demo_url() {
	}
	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {
	}
}
/**
 *  UABB Slide Box Module file
 *
 *  @package UABB Slide Box Module
 */
/**
 * Function that initializes UABB Slide Box Module
 *
 * @class SlideBoxModule
 */
class SlideBoxModule extends \FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Slide Box Module
	 *
	 * @method __construct
	 */
	public function __construct() {
	}
	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.3.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {
	}
	/**
	 * Function that renders the link for the Slide Box
	 *
	 * @method render_link
	 */
	public function render_link() {
	}
	/**
	 * Function that renders the button for the Slide Box
	 *
	 * @method render_button
	 */
	public function render_button() {
	}
	/**
	 * Function that renders the Image for the Slide Box module.
	 *
	 * @method render_image
	 * @param var $pos gets the position of the image.
	 */
	public function render_image( $pos ) {
	}
	/**
	 * Function that renders the overlay icon for the Slide Box
	 *
	 * @method render_overlay_icon
	 */
	public function render_overlay_icon() {
	}
	/**
	 * Function that renders the overlay icon for the Slide Box
	 *
	 * @method render_overlay_icon
	 */
	public function render_dropdown_icon() {
	}
}
/**
 *  UABB Info Table Module file
 *
 *  @package UABB Info Table Module
 */
/**
 * Function that initializes Info Table Module
 *
 * @class UABBInfoTableModule
 */
class UABBInfoTableModule extends \FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Info Table Module
	 *
	 * @method __construct
	 */
	public function __construct() {
	}
	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {
	}
}
/**
 *  UABB Ribbon Module file
 *
 *  @package UABB Ribbon Module
 */
/**
 * Function that initializes UABB Ribbon Module
 *
 * @class RibbonModule
 */
class RibbonModule extends \FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Ribbon Module
	 *
	 * @method __construct
	 */
	public function __construct() {
	}
	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {
	}
	/**
	 * Function to get the icon for the Progress Bar
	 *
	 * @method get_icon
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {
	}
}
/**
 *  UABB Info List Module file
 *
 *  @package UABB Info List Module
 */
/**
 * Function that initializes Info List Module
 *
 * @class UABBInfoList
 */
class UABBInfoList extends \FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Info List Module
	 *
	 * @method __construct
	 */
	public function __construct() {
	}
	/**
	 * Function to get the icon for the Info List
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {
	}
	/**
	 * Render Image
	 *
	 * @method render_image
	 * @param object $item gets the object for the module.
	 * @param object $settings gets the settings for the module.
	 */
	public function render_image( $item, $settings ) {
	}
	/**
	 * Render text
	 *
	 * @method render_text
	 * @param object $item gets the items.
	 * @param var    $list_item_counter  counts the list item counter value.
	 */
	public function render_each_item( $item, $list_item_counter ) {
	}
	/**
	 * Render List text
	 *
	 * @method render_text
	 */
	public function render_list() {
	}
	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {
	}
}
/**
 *  UABB Heading module file
 *
 *  @package UABB Heading
 */
/**
 * Function that initializes UABB Heading Module
 *
 * @class UABBHeadingModule
 */
class UABBHeadingModule extends \FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Heading module.
	 *
	 * @method __construct
	 */
	public function __construct() {
	}
	/**
	 * Function that renders pos.
	 *
	 * @method render_image
	 */
	public function render_image() {
	}
	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {
	}
}
/**
 *  UABB Star Rating Module file
 *
 *  @package UABB Star Rating
 */
/**
 * Function that initializes UABB Table of Content Module
 *
 * @class UABBStarRatingModule
 */
class UABBStarRatingModule extends \FLBuilderModule {

	/**
	 * Constructor function for the module. You must pass the
	 * name, description, dir and url in an array to the parent class.
	 *
	 * @method __construct
	 */
	public function __construct() {
	}
	/**
	 * Function to get the icon for the Star Rating
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {
	}
}
/**
 *  UABB Image Icon Module file
 *
 *  @package UABB Image Icon Module
 */
/**
 * Function that initializes Image Icon Module
 *
 * @class ImageIconModule
 */
class ImageIconModule extends \FLBuilderModule {

	/**
	 * Variable for Image Icon module
	 *
	 * @property $data
	 * @var $data
	 */
	public $data = \null;
	/**
	 * Variable for Image Icon module
	 *
	 * @property $_editor
	 * @protected
	 * @var $_editor
	 */
	protected $_editor = \null;
	/**
	 * Constructor function that constructs default values for the Image icon Module
	 *
	 * @method __construct
	 */
	public function __construct() {
	}
	/**
	 * Function to update the Image src
	 *
	 * @method update
	 * @param object $settings {object}.
	 */
	public function update( $settings ) {
	}
	/**
	 * Function to delete the path if not required
	 *
	 * @method delete
	 */
	public function delete() {
	}
	/**
	 * Function for cropping the image
	 *
	 * @method crop
	 */
	public function crop() {
	}
	/**
	 * Function that gets the data for the Image Icon module.
	 *
	 * @method get_data
	 */
	public function get_data() {
	}
	/**
	 * Function that gets classes for the Photo image
	 *
	 * @method get_classes
	 */
	public function get_classes() {
	}
	/**
	 * Function that gets the src for the Uncropped Image URL
	 *
	 * @method get_src
	 */
	public function get_src() {
	}
	/**
	 * Function that gets the alternate value of the Image
	 *
	 * @method get_alt
	 */
	public function get_alt() {
	}
	/**
	 * Function that checks for the source
	 *
	 * @method _has_source
	 * @protected
	 */
	protected function _has_source() {
	}
	/**
	 * Function that gets the editor
	 *
	 * @method _get_editor
	 * @protected
	 */
	protected function _get_editor() {
	}
	/**
	 * Function that gets the cropped path
	 *
	 * @method _get_cropped_path
	 * @protected
	 */
	protected function _get_cropped_path() {
	}
	/**
	 * Functions that gets the uncropped URL of the Image
	 *
	 * @method _get_uncropped_url
	 * @protected
	 */
	protected function _get_uncropped_url() {
	}
	/**
	 * Functions that gets the cropped demo URL
	 *
	 * @method _get_cropped_demo_url
	 * @protected
	 */
	protected function _get_cropped_demo_url() {
	}
	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {
	}
}
/**
 *  UABB Separator Module file
 *
 *  @package UABB Separator Module
 */
/**
 * Function that initializes UABB Separator Module
 *
 * @class UABBSeparatorModule
 */
class UABBSeparatorModule extends \FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Separator module.
	 *
	 * @method __construct
	 */
	public function __construct() {
	}
}
\define( 'BB_ULTIMATE_ADDON_DIR', \plugin_dir_path( __FILE__ ) );
\define( 'BB_ULTIMATE_ADDON_URL', \plugins_url( '/', __FILE__ ) );
\define( 'BB_ULTIMATE_ADDON_LITE_VERSION', '1.6.1' );
\define( 'BSF_REMOVE_UABB_FROM_REGISTRATION_LISTING', \true );
\define( 'BB_ULTIMATE_ADDON_FILE', \trailingslashit( __DIR__ ) . 'bb-ultimate-addon.php' );
// @codingStandardsIgnoreLine.
\define('BB_ULTIMATE_ADDON_LITE', \true);
\define( 'BB_ULTIMATE_ADDON_UPGRADE_URL', 'https://www.ultimatebeaver.com/pricing/?utm_source=uabb-dashboard&utm_campaign=uabblite_upgrade&utm_medium=upgrade-button' );
\define( 'BB_ULTIMATE_ADDON_FB_URL', 'https://www.brainstormforce.com/go/uabb-facebook-group/?utm_source=uabb-dashboard&utm_campaign=Lite&utm_medium=FB' );
\define( 'BB_ULTIMATE_ADDON_TWITTER_URL', 'https://twitter.com/WeBrainstorm' );
/**
 * Initialize the class only after all the plugins are loaded.
 */
function init_uabb() {
}
/**
 * Initializes recurse function
 *
 * @param var   $base returns the base values.
 * @param array $replacements returns the replacements values.
 */
function recurse( $base, $replacements ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default Checks if user has set the color, if yes, returns users value else checks for.
 * filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_base_color( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default Checks if user has set the color, if yes, returns users value else checks for.
 * filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_text_color( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default Checks if user has set the color, if yes, returns users value else checks for
 * filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_link_color( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default Checks if user has set the color, if yes, returns users value else checks for filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_link_hover_color( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default Checks if user has set the font family, if yes, returns users value else checks
 * for filtered value.
 * @return string - font-family
 */
function uabb_theme_button_font_family( $default ) {
}
/**
 * Button Font Size
 *
 * @param var $default Checks if the user has set Font Size values.
 */
function uabb_theme_button_font_size( $default ) {
}
/**
 * Button Font Size
 *
 * @since 1.3.1
 * @param var $default Checks if the user has set Font Size values.
 */
function uabb_theme_default_button_font_size( $default ) {
}
/**
 * Button Line Height
 *
 * @param var $default Checks if the user has set text transform values.
 */
function uabb_theme_button_line_height( $default ) {
}
/**
 * Button Line Height
 *
 * @since 1.3.1
 * @param var $default Checks if the user has set text transform values.
 */
function uabb_theme_default_button_line_height( $default ) {
}
/**
 * Button Letter Spacing
 *
 * @param var $default Checks if the user has set letter spacing values.
 */
function uabb_theme_button_letter_spacing( $default ) {
}
/**
 * Button Letter Spacing
 *
 * @since 1.3.1
 * @param var $default Checks if the user has set letter spacing values.
 */
function uabb_theme_default_button_letter_spacing( $default ) {
}
/**
 * Button Text Transform
 *
 * @param var $default Checks if the user has set text transform values.
 */
function uabb_theme_button_text_transform( $default ) {
}
/**
 * Button Text Transform
 *
 * @since 1.3.1
 * @param var $default Checks if the user has set text transform values.
 */
function uabb_theme_default_button_text_transform( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default Checks if user has set the color, if yes, returns users value else checks for filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_button_bg_color( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default Checks if user has set the color, if yes, returns users value else checks for filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_default_button_bg_color( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default Checks if user has set the color, if yes, returns users value else checks
 * for filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_button_bg_hover_color( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default Checks if user has set the color, if yes, returns users value else checks
 * for filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_default_button_bg_hover_color( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default Checks if user has set the color, if yes, returns users value else checks
 * for filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_button_text_color( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default Checks if user has set the text color, if yes, returns users value else checks
 * for filtered value.
 * @return string - hex value for the text color
 */
function uabb_theme_default_button_text_color( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default Checks if user has set the text hover color, if yes, returns users value else checks
 * for filtered value.
 *
 * @return string - hex value for the text hover color
 */
function uabb_theme_button_text_hover_color( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default Checks if user has set the text hover color, if yes, returns users value else checks
 * for filtered value.
 *
 * @return string - hex value for the text hover color
 */
function uabb_theme_default_button_text_hover_color( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default Checks if user has set the color, if yes, returns users value else checks
 * for filtered value.
 * @return string - padding value
 */
function uabb_theme_button_padding( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default Checks if user has set the padding, if yes, returns users value else checks
 * for filtered value.
 * @return string - padding value
 */
function uabb_theme_default_button_padding( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default Checks if user has set the padding, if yes, returns users value else checks
 * for filtered value.
 * @return string - padding value
 */
function uabb_theme_button_vertical_padding( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default checks if user has set the padding, if yes, returns users value else checks
 * for filtered value.
 * @return string - padding value
 */
function uabb_theme_button_horizontal_padding( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default Checks if user has set the radius, if yes, returns users value else checks
 * for filtered value.
 * @return string - radius value
 */
function uabb_theme_button_border_radius( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default Checks if user has set the width, if yes, returns users value else checks
 * for filtered value.
 * @return string - width value
 */
function uabb_theme_button_border_width( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default Checks if user has set the color, if yes, returns users value else checks for
 * filtered value.
 * @return string - hex value for the border color
 */
function uabb_theme_border_color( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default Checks if user has set the hover color, if yes, returns users value else checks for
 * filtered value.
 * @return string - hex value for the border hover color
 */
function uabb_theme_border_hover_color( $default ) {
}
/**
 * Provide option to parse a color code.
 *
 * @param var $code Returns a hex value for color from rgba or #hex color.
 * @return string - hex value for the color
 */
function uabb_parse_color_to_hex( $code = '' ) {
}
/**
 * Provide option to parse a Border param.
 *
 * @since 1.3.1
 * @param var $default Checks if user has set the Border, if yes, returns users value else checks for
 * filtered value.
 * @return array - Border value for the Button
 */
function uabb_theme_border( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default Checks if user has set the radius, if yes, returns users value else checks
 * for filtered value.
 * @return array - typography value
 */
function uabb_theme_button_typography( $default ) {
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $value Checks if user has set the Padding, if yes, returns users value else checks
 * for filtered value.
 * @return array - Padding value
 */
function uabb_theme_padding_button( $mode, $value ) {
}
/**
*  Kicking this off by calling 'get_instance()' method
*/
$UABB_Cloud_Templates = \UABB_Cloud_Templates::get_instance();
/**
 *  FLBuilder Registered Nested Forms - Button Form Field
 *
 * @package Button
 */
$version_bb_check = \UABB_Lite_Compatibility::check_bb_version();
/**
 *  UABB Image Separator Module front-end file
 *
 *  @package UABB Image Separator Module
 */
if ( isset( $module ) && $module !== null ) {
	$module->get_classes();
} else {
	// Handle the case where $module is null
}
/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 * @package Slide Box
 */

// Define $settings if not already defined
if ( ! isset( $settings ) ) {
	$settings = new class() {
		public $front_img_icon_position = 'default_position'; // Replace with appropriate default
		public $rating_title            = 'default_title'; // Replace with appropriate default
	};
}

$pos = $settings->front_img_icon_position;

/**
 *  UABB Star Ratting Module front-end CSS php file
 *
 *  @package UABB Star Ratting Module
 */
$title = $settings->rating_title;
