<?php
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

		// Enqueue CSS & JS.
		add_action( 'wp_enqueue_scripts', array( $this, 'uabb_panel_css_js' ) );

		add_action( 'wp_footer', array( $this, 'render_live_preview' ), 9 );

		// Render JS & CSS.
		add_filter( 'fl_builder_render_css', array( $this, 'fl_uabb_render_css' ), 10, 3 );
		add_filter( 'fl_builder_render_js', array( $this, 'fl_uabb_render_js' ), 10, 3 );

		// skip brainstorm registration for updater.
		add_filter( 'bsf_skip_author_registration', array( $this, 'uabb_skip_brainstorm_menu' ) );
		add_filter( 'bsf_skip_braisntorm_menu', array( $this, 'uabb_skip_brainstorm_menu' ) );

		// Registration page URL for UABB.
		add_filter( 'bsf_registration_page_url_uabb', array( $this, 'uabb_bsf_registration_page_url' ) );
		add_filter( 'bsf_license_form_heading_uabb', array( $this, 'uabb_bsf_license_form_heading' ), 10, 3 );

		/* Affiliate link override */
		add_filter( 'fl_builder_upgrade_url', array( $this, 'uabb_affiliate_url' ) );

		$this->config();
		$this->init();
	}
	/**
	 *  Function to add toggle UABB User Interface.
	 *
	 *  @since 1.0
	 */
	function toggle_uabb_ui() {

		// Added ui panel.
		add_action( 'wp_footer', array( $this, 'render_ui' ), 9 );

		// Added buttons in ui panel.
		add_filter( 'fl_builder_ui_bar_buttons', array( $this, 'builder_ui_bar_buttons' ) );

		// Excluded UABB templates.
		add_filter( 'fl_builder_row_templates_data', array( $this, 'uabb_templates_data' ), 50 );
		add_filter( 'fl_builder_module_templates_data', array( $this, 'uabb_templates_data' ), 50 );

		// Added search html in BB 'add content' panel.
		add_action( 'fl_builder_ui_panel_before_rows', array( $this, 'uabb_panel_before_row_layouts' ) );
	}

	/**
	 *  Function that initializes template selector data.
	 *
	 *  @since 1.0
	 */
	public function init() {
		add_filter( 'fl_builder_template_selector_data', array( $this, 'uabb_fl_builder_template_selector_data' ), 10, 2 );
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
		$template_data['tags']   = isset( $template->tags ) ? $template->tags : array();
		$template_data['author'] = isset( $template->author ) ? $template->author : '';
		return $template_data;
	}
	/**
	 * Affiliate link override function
	 *
	 * @since 1.0
	 * @param string $url Returns the URL of the Affiliate URL.
	 */
	function uabb_affiliate_url( $url ) {

		$url = 'https://www.wpbeaverbuilder.com/?fla=713';
		return $url;
	}
	/**
	 * Affiliate link override function
	 *
	 * @since 1.0
	 * @param string $url Returns the Key shortcut for showUABBGlobalSettings.
	 */
	function uabb_bsf_registration_page_url( $url ) {

		if ( is_multisite() && false === FL_BUILDER_LITE ) {
			return network_admin_url( '/settings.php?page=uabb-builder-multisite-settings#uabb-license' );
		} else {
			return admin_url( 'options-general.php?page=uabb-builder-settings#uabb-license' );
		}
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

		$branding_name       = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-name' );
		$branding_short_name = BB_Ultimate_Addon_Helper::get_builder_uabb_branding( 'uabb-plugin-short-name' );

		if ( 'bsf-license-not-active-uabb' == $license_status_class ) {
			if ( empty( $branding_name ) && empty( $branding_short_name ) ) {
				$license_string = '<a href="https://store.brainstormforce.com/purchase-history/" target="_blank">license key</a>';
			} else {
				$license_string = 'license key';
			}
			$form_heading = $form_heading . '<p>Enter your ' . $license_string . ' to enable remote updates and support.</p>';
		}

		return $form_heading;
	}

	/**
	 * Skip Brainstorm Registration screen for UABB users
	 *
	 * @param array $products Gets an array of Products.
	 */
	function uabb_skip_brainstorm_menu( $products ) {

		if ( function_exists( 'bsf_extract_product_id' ) ) {
			$priduct_id = bsf_extract_product_id( BB_ULTIMATE_ADDON_DIR );
			$products[] = $priduct_id;
		}

		return $products;
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
		$temp = file_get_contents( BB_ULTIMATE_ADDON_DIR . 'assets/js/uabb-frontend.js' ) . $js;
		$js   = $temp;
		return $js;
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

		$css .= file_get_contents( BB_ULTIMATE_ADDON_DIR . 'assets/css/uabb-frontend.css' );
		$css .= include( BB_ULTIMATE_ADDON_DIR . 'assets/dynamic-css/uabb-theme-dynamic-css.php' );

		return $css;
	}

	/**
	 * Function that renders Config and templates function
	 *
	 * @since 1.0
	 */
	function config() {

		$is_templates_exist = BB_Ultimate_Addon_Helper::is_templates_exist();
		if ( $is_templates_exist ) {
			$this->load_templates();
		}

		$uabb = UABB_Init::$uabb_options['fl_builder_uabb'];
		if ( ! empty( $uabb ) && is_array( $uabb ) ) {

			// Load UI Panel if option exist.
			if ( array_key_exists( 'load_panels', $uabb ) ) {
				if ( 1 == $uabb['load_panels'] ) {
					$this->toggle_uabb_ui();
				}
			}

			// Initially load the UABB UI Panel.
		} else {
			$this->toggle_uabb_ui();
		}
	}

	/**
	 * Load cloud templates
	 *
	 * @since 1.0
	 */
	function load_templates() {

		if ( ! method_exists( 'FLBuilder', 'register_templates' ) ) {
			return;
		}

		$templates = get_site_option( '_uabb_cloud_templats', false );

		if ( is_array( $templates ) && count( $templates ) > 0 ) {
			foreach ( $templates as $type => $type_templates ) {

				// Individual type array - [page-templates], [layout] or [row].
				if ( $type_templates ) {
					foreach ( $type_templates as $template_id => $template_data ) {

						/**
						 *  Check [status] & [dat_url_local] exist
						 */
						if (
							isset( $template_data['status'] ) && true == $template_data['status'] &&
							isset( $template_data['dat_url_local'] ) && ! empty( $template_data['dat_url_local'] )
						) {
							FLBuilder::register_templates( $template_data['dat_url_local'] );
						}
					}
				}
			}
		}
	}


	/**
	 * Function that renders Before Row Layouts
	 *
	 * @since 1.0
	 */
	function uabb_panel_before_row_layouts() {
		?>
			<!-- Search Module -->
			<div id="fl-builder-blocks-rows" class="fl-builder-blocks-section">
				<input type="text" id="module_search" placeholder="<?php _e( 'Search Module...', 'uabb' ); ?>" style="width: 100%;">
				<div class="filter-count"></div>
			</div><!-- Search Module -->
		<?php
	}

	/**
	 *  1. Return all templates 'excluding' UABB templates. If variable $status is set to 'exclude'. Default: 'exclude'
	 *  2. Return ONLY UABB templates. If variable $status is NOT set to 'exclude'.
	 *
	 * @since 1.0
	 * @param array $templates Gets the array of UABB templates.
	 * @param var   $status Checks for the status of UABB templates.
	 */
	static public function uabb_templates_data( $templates, $status = 'exclude' ) {

		if ( isset( $templates['categorized'] ) && count( $templates['categorized'] ) > 0 ) {

			foreach ( $templates['categorized'] as $ind => $cat ) {

				foreach ( $cat['templates'] as $cat_id => $cat_data ) {

					// Return all templates 'excluding' UABB templates.
					if ( 'exclude' == $status ) {
						if ( ( isset( $cat_data['author'] ) && 'brainstormforce' == $cat_data['author'] )
						) {
							unset( $templates['categorized'][ $ind ]['templates'][ $cat_id ] );
						}

						// Return ONLY UABB templates.
					} else {
						if ( ( isset( $cat_data['author'] ) && 'brainstormforce' != $cat_data['author'] )
						) {
							unset( $templates['categorized'][ $ind ]['templates'][ $cat_id ] );
						}
					}
				}

				// Delete category if not templates found.
				if ( count( $templates['categorized'][ $ind ]['templates'] ) <= 0 ) {
					unset( $templates['categorized'][ $ind ] );
				}
			}
		}

		return $templates;
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

		if ( is_callable( 'FLBuilderUserAccess::current_user_can' ) ) {
			$simple_ui = ! FLBuilderUserAccess::current_user_can( 'unrestricted_editing' );
		} else {
			$simple_ui = ! FLBuilderModel::current_user_has_editing_capability();
		}

		$has_presets  = BB_Ultimate_Addon_Helper::is_templates_exist( 'presets' );
		$has_sections = BB_Ultimate_Addon_Helper::is_templates_exist( 'sections' );

		$buttons['add-ultimate-presets'] = array(
			'label' => __( 'Presets', 'uabb' ),
			'show'  => ( ! $simple_ui && $has_presets ),
		);

		$buttons['add-ultimate-rows'] = array(
			'label' => __( 'Sections', 'uabb' ),
			'show'  => ( ! $simple_ui && $has_sections ),
		);

		// Move button 'Add Content' at the start.
		$add_content = $buttons['add-content'];
		unset( $buttons['add-content'] );
		$buttons['add-content'] = $add_content;

		return $buttons;
	}

	/**
	 *  Load Rows Panel
	 *
	 * Row panel showing sections - rows & modules
	 *
	 * @since 1.0
	 */
	function render_ui() {

		global $wp_the_query;

		if ( FLBuilderModel::is_builder_active() ) {

			if ( is_callable( 'FLBuilderUserAccess::current_user_can' ) ) {
				$has_editing_cap = FLBuilderUserAccess::current_user_can( 'unrestricted_editing' );
				$simple_ui       = ! $has_editing_cap;
			} else {
				$has_editing_cap = FLBuilderModel::current_user_has_editing_capability();
				$simple_ui       = ! $has_editing_cap;
			}

			// Panel.
			$post_id    = $wp_the_query->post->ID;
			$categories = FLBuilderModel::get_categorized_modules();

			/**
			 * Renders categorized row & module templates in the UI panel.
			 */
			$is_row_template    = FLBuilderModel::is_post_user_template( 'row' );
			$is_module_template = FLBuilderModel::is_post_user_template( 'module' );
			$row_templates      = FLBuilderModel::get_template_selector_data( 'row' );
			$module_templates   = FLBuilderModel::get_template_selector_data( 'module' );

			if ( BB_Ultimate_Addon_Helper::is_templates_exist( 'sections' ) ) {
				include BB_ULTIMATE_ADDON_DIR . 'includes/ui-panel-sections.php';
			}

			if ( BB_Ultimate_Addon_Helper::is_templates_exist( 'presets' ) ) {
				include BB_ULTIMATE_ADDON_DIR . 'includes/ui-panel-presets.php';
			}
		}
	}

	/**
	 * Function that renders live preview
	 *
	 * @since 1.0
	 */
	function render_live_preview() {
		if ( FLBuilderModel::is_builder_active() ) {
			/* Live Preview */
			$uabb = BB_Ultimate_Addon_Helper::get_builder_uabb();

			if ( is_array( $uabb ) && array_key_exists( 'uabb-live-preview', $uabb ) && 1 == $uabb['uabb-live-preview'] ) {

				/* Live Preview HTML */
				$live_preview = '<span class="uabb-live-preview-button fl-builder-button-primary fl-builder-button" >Live Preview</span>';

				echo $live_preview;
			}
		}
	}

	/**
	 * Enqueue Panel CSS and JS
	 */
	function uabb_panel_css_js() {
		if ( FLBuilderModel::is_builder_active() ) {
			wp_enqueue_script( 'uabb-panel-js', BB_ULTIMATE_ADDON_URL . 'assets/js/uabb-panel.js', array( 'jquery' ), '', true );
		}
	}

}

new UABB_UI_Panels();
