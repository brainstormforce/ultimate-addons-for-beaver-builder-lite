<?php
/**
 * UABB Settings Abilities.
 *
 * @since 1.6.8
 * @package UABB
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers settings-related abilities:
 * - uabb/get-global-settings
 * - uabb/update-global-settings
 * - uabb/get-general-settings
 * - uabb/update-general-settings
 *
 * @since 1.6.8
 */
class UABB_Settings_Abilities {

	/**
	 * Whitelisted keys for global styling settings.
	 *
	 * @since 1.6.8
	 * @var array
	 */
	const GLOBAL_SETTING_KEYS = array(
		'enable_global',
		'theme_color',
		'theme_text_color',
		'btn_bg_color',
		'btn_bg_hover_color',
		'btn_text_color',
		'btn_text_hover_color',
		'btn_border_radius',
		'btn_font_size',
		'btn_line_height',
		'btn_letter_spacing',
		'btn_text_transform',
		'btn_vertical_padding',
		'btn_horizontal_padding',
	);

	/**
	 * Register all abilities in this class.
	 *
	 * @since 1.6.8
	 */
	public static function register() {
		self::register_get_global_settings();
		self::register_update_global_settings();
		self::register_get_general_settings();
		self::register_update_general_settings();
	}

	/**
	 * Validate a hex color value (3 or 6 characters, no hash).
	 *
	 * @since 1.6.8
	 * @param string $color The color value to validate.
	 * @return bool True if valid hex color.
	 */
	private static function is_valid_hex_color( $color ) {
		return (bool) preg_match( '/^[0-9a-fA-F]{3}([0-9a-fA-F]{3})?$/', $color );
	}

	/**
	 * Register the get-global-settings ability.
	 *
	 * @since 1.6.8
	 */
	private static function register_get_global_settings() {
		wp_register_ability(
			'uabb/get-global-settings',
			array(
				'label'               => __( 'Get Global Styling', 'uabb' ),
				'description'         => __( 'Get UABB global styling settings including theme colors, button defaults, and enabled state.', 'uabb' ),
				'category'            => UABB_Abilities::CATEGORY,
				'input_schema'        => array(
					'type'       => 'object',
					'properties' => new \stdClass(),
				),
				'output_schema'       => array(
					'type'       => 'object',
					'properties' => array(
						'enabled'      => array(
							'type'        => 'boolean',
							'description' => __( 'Whether global styling is enabled.', 'uabb' ),
						),
						'theme_color'      => array( 'type' => 'string' ),
						'theme_text_color' => array( 'type' => 'string' ),
						'button'           => array(
							'type'       => 'object',
							'properties' => array(
								'bg_color'           => array( 'type' => 'string' ),
								'bg_hover_color'     => array( 'type' => 'string' ),
								'text_color'         => array( 'type' => 'string' ),
								'text_hover_color'   => array( 'type' => 'string' ),
								'border_radius'      => array( 'type' => 'string' ),
								'font_size'          => array( 'type' => 'string' ),
								'line_height'        => array( 'type' => 'string' ),
								'letter_spacing'     => array( 'type' => 'string' ),
								'text_transform'     => array( 'type' => 'string' ),
								'vertical_padding'   => array( 'type' => 'string' ),
								'horizontal_padding' => array( 'type' => 'string' ),
							),
						),
					),
				),
				'execute_callback'    => static function () {
					$settings = UABB_Global_Styling::get_uabb_global_settings();

					return array(
						'enabled'          => isset( $settings->enable_global ) && 'yes' === $settings->enable_global,
						'theme_color'      => isset( $settings->theme_color ) ? $settings->theme_color : '',
						'theme_text_color' => isset( $settings->theme_text_color ) ? $settings->theme_text_color : '',
						'button'           => array(
							'bg_color'           => isset( $settings->btn_bg_color ) ? $settings->btn_bg_color : '',
							'bg_hover_color'     => isset( $settings->btn_bg_hover_color ) ? $settings->btn_bg_hover_color : '',
							'text_color'         => isset( $settings->btn_text_color ) ? $settings->btn_text_color : '',
							'text_hover_color'   => isset( $settings->btn_text_hover_color ) ? $settings->btn_text_hover_color : '',
							'border_radius'      => isset( $settings->btn_border_radius ) ? $settings->btn_border_radius : '',
							'font_size'          => isset( $settings->btn_font_size ) ? $settings->btn_font_size : '',
							'line_height'        => isset( $settings->btn_line_height ) ? $settings->btn_line_height : '',
							'letter_spacing'     => isset( $settings->btn_letter_spacing ) ? $settings->btn_letter_spacing : '',
							'text_transform'     => isset( $settings->btn_text_transform ) ? $settings->btn_text_transform : 'none',
							'vertical_padding'   => isset( $settings->btn_vertical_padding ) ? $settings->btn_vertical_padding : '',
							'horizontal_padding' => isset( $settings->btn_horizontal_padding ) ? $settings->btn_horizontal_padding : '',
						),
					);
				},
				'permission_callback' => static function () {
					return current_user_can( 'manage_options' );
				},
				'meta'                => array(
					'show_in_rest' => true,
					'mcp'          => array(
						'public' => true,
						'type'   => 'tool',
					),
				),
			)
		);
	}

	/**
	 * Register the update-global-settings ability.
	 *
	 * @since 1.6.8
	 */
	private static function register_update_global_settings() {
		wp_register_ability(
			'uabb/update-global-settings',
			array(
				'label'               => __( 'Update Global Styling', 'uabb' ),
				'description'         => __( 'Update UABB global styling settings. Accepts theme colors (hex without #), button styles, and enable/disable flag.', 'uabb' ),
				'category'            => UABB_Abilities::CATEGORY,
				'input_schema'        => array(
					'type'       => 'object',
					'properties' => array(
						'enable_global'          => array(
							'type'        => 'string',
							'enum'        => array( 'yes', 'no' ),
							'description' => __( 'Enable or disable global styling.', 'uabb' ),
						),
						'theme_color'            => array(
							'type'        => 'string',
							'description' => __( 'Primary theme color (hex without #, e.g. "f7b91a").', 'uabb' ),
						),
						'theme_text_color'       => array(
							'type'        => 'string',
							'description' => __( 'Default text color (hex without #).', 'uabb' ),
						),
						'btn_bg_color'           => array(
							'type'        => 'string',
							'description' => __( 'Button background color (hex without #).', 'uabb' ),
						),
						'btn_bg_hover_color'     => array(
							'type'        => 'string',
							'description' => __( 'Button hover background color (hex without #).', 'uabb' ),
						),
						'btn_text_color'         => array(
							'type'        => 'string',
							'description' => __( 'Button text color (hex without #).', 'uabb' ),
						),
						'btn_text_hover_color'   => array(
							'type'        => 'string',
							'description' => __( 'Button hover text color (hex without #).', 'uabb' ),
						),
						'btn_border_radius'      => array(
							'type'        => 'string',
							'description' => __( 'Button border radius in px.', 'uabb' ),
						),
						'btn_font_size'          => array(
							'type'        => 'string',
							'description' => __( 'Button font size in px.', 'uabb' ),
						),
						'btn_line_height'        => array(
							'type'        => 'string',
							'description' => __( 'Button line height.', 'uabb' ),
						),
						'btn_letter_spacing'     => array(
							'type'        => 'string',
							'description' => __( 'Button letter spacing in px.', 'uabb' ),
						),
						'btn_text_transform'     => array(
							'type'        => 'string',
							'enum'        => array( 'none', 'capitalize', 'uppercase', 'lowercase' ),
							'description' => __( 'Button text transform.', 'uabb' ),
						),
						'btn_vertical_padding'   => array(
							'type'        => 'string',
							'description' => __( 'Button vertical padding in px.', 'uabb' ),
						),
						'btn_horizontal_padding' => array(
							'type'        => 'string',
							'description' => __( 'Button horizontal padding in px.', 'uabb' ),
						),
					),
				),
				'output_schema'       => array(
					'type'       => 'object',
					'properties' => array(
						'success'  => array( 'type' => 'boolean' ),
						'updated'  => array(
							'type'  => 'array',
							'items' => array( 'type' => 'string' ),
						),
					),
				),
				'execute_callback'    => static function ( array $input ) {
					$color_keys = array(
						'theme_color',
						'theme_text_color',
						'btn_bg_color',
						'btn_bg_hover_color',
						'btn_text_color',
						'btn_text_hover_color',
					);

					// Validate hex colors.
					foreach ( $color_keys as $key ) {
						if ( isset( $input[ $key ] ) && '' !== $input[ $key ] ) {
							if ( ! self::is_valid_hex_color( $input[ $key ] ) ) {
								return new WP_Error(
									'uabb_invalid_color',
									sprintf(
										/* translators: 1: setting key, 2: color value */
										__( 'Invalid hex color for "%1$s": "%2$s". Use 3 or 6 character hex without #.', 'uabb' ),
										$key,
										sanitize_text_field( $input[ $key ] )
									)
								);
							}
						}
					}

					// Filter to whitelisted keys only.
					$settings_to_save = array();
					$updated_keys     = array();
					foreach ( self::GLOBAL_SETTING_KEYS as $key ) {
						if ( isset( $input[ $key ] ) ) {
							$settings_to_save[ $key ] = sanitize_text_field( $input[ $key ] );
							$updated_keys[]           = $key;
						}
					}

					if ( empty( $settings_to_save ) ) {
						return new WP_Error(
							'uabb_no_settings',
							__( 'No valid settings provided to update.', 'uabb' )
						);
					}

					// Merge externally: save_uabb_global_settings() saves the raw
					// parameter to the DB, so we must pass a fully-merged array to
					// avoid losing existing settings on partial updates.
					$current = (array) UABB_Global_Styling::get_uabb_global_settings();
					$merged  = array_merge( $current, $settings_to_save );

					UABB_Global_Styling::save_uabb_global_settings( $merged );

					return array(
						'success' => true,
						'updated' => $updated_keys,
					);
				},
				'permission_callback' => static function () {
					return current_user_can( 'manage_options' );
				},
				'meta'                => array(
					'show_in_rest' => true,
					'mcp'          => array(
						'public' => true,
						'type'   => 'tool',
					),
				),
			)
		);
	}

	/**
	 * Register the get-general-settings ability.
	 *
	 * @since 1.6.8
	 */
	private static function register_get_general_settings() {
		wp_register_ability(
			'uabb/get-general-settings',
			array(
				'label'               => __( 'Get General Settings', 'uabb' ),
				'description'         => __( 'Get UABB general settings including UI panel, live preview, and template cloud status.', 'uabb' ),
				'category'            => UABB_Abilities::CATEGORY,
				'input_schema'        => array(
					'type'       => 'object',
					'properties' => new \stdClass(),
				),
				'output_schema'       => array(
					'type'       => 'object',
					'properties' => array(
						'ui_panel_enabled'       => array(
							'type'        => 'boolean',
							'description' => __( 'Whether the UABB UI panel is loaded.', 'uabb' ),
						),
						'live_preview_enabled'   => array(
							'type'        => 'boolean',
							'description' => __( 'Whether live preview is enabled.', 'uabb' ),
						),
						'template_cloud_enabled' => array(
							'type'        => 'boolean',
							'description' => __( 'Whether template cloud is enabled.', 'uabb' ),
						),
						'colorpicker_enabled'    => array(
							'type'        => 'boolean',
							'description' => __( 'Whether the custom color picker is enabled.', 'uabb' ),
						),
						'row_separator_enabled'  => array(
							'type'        => 'boolean',
							'description' => __( 'Whether row separators are enabled.', 'uabb' ),
						),
						'google_map_api_key'     => array(
							'type'        => 'string',
							'description' => __( 'Google Maps API key (masked if set).', 'uabb' ),
						),
					),
				),
				'execute_callback'    => static function () {
					$uabb     = BB_Ultimate_Addon_Helper::get_builder_uabb();
					$branding = BB_Ultimate_Addon_Helper::get_builder_uabb_branding();

					$api_key = isset( $uabb['uabb-google-map-api'] ) ? $uabb['uabb-google-map-api'] : '';
					if ( ! empty( $api_key ) ) {
						// Mask the API key for security — show only last 4 chars.
						$api_key = str_repeat( '*', max( 0, strlen( $api_key ) - 4 ) ) . substr( $api_key, -4 );
					}

					return array(
						'ui_panel_enabled'       => ! empty( $uabb['load_panels'] ),
						'live_preview_enabled'   => ! empty( $uabb['uabb-live-preview'] ),
						'template_cloud_enabled' => is_array( $branding ) && ! empty( $branding['uabb-enable-template-cloud'] ),
						'colorpicker_enabled'    => ! empty( $uabb['uabb-colorpicker'] ),
						'row_separator_enabled'  => ! empty( $uabb['uabb-row-separator'] ),
						'google_map_api_key'     => $api_key,
					);
				},
				'permission_callback' => static function () {
					return current_user_can( 'manage_options' );
				},
				'meta'                => array(
					'show_in_rest' => true,
					'mcp'          => array(
						'public' => true,
						'type'   => 'tool',
					),
				),
			)
		);
	}

	/**
	 * Register the update-general-settings ability.
	 *
	 * @since 1.6.8
	 */
	private static function register_update_general_settings() {
		wp_register_ability(
			'uabb/update-general-settings',
			array(
				'label'               => __( 'Update General Settings', 'uabb' ),
				'description'         => __( 'Update UABB general settings. Can toggle UI panel and live preview.', 'uabb' ),
				'category'            => UABB_Abilities::CATEGORY,
				'input_schema'        => array(
					'type'       => 'object',
					'properties' => array(
						'ui_panel_enabled'     => array(
							'type'        => 'boolean',
							'description' => __( 'Enable or disable the UABB UI panel.', 'uabb' ),
						),
						'live_preview_enabled' => array(
							'type'        => 'boolean',
							'description' => __( 'Enable or disable live preview.', 'uabb' ),
						),
					),
				),
				'output_schema'       => array(
					'type'       => 'object',
					'properties' => array(
						'success' => array( 'type' => 'boolean' ),
						'updated' => array(
							'type'  => 'array',
							'items' => array( 'type' => 'string' ),
						),
					),
				),
				'execute_callback'    => static function ( array $input ) {
					$current      = BB_Ultimate_Addon_Helper::get_builder_uabb();
					$updated_keys = array();

					if ( isset( $input['ui_panel_enabled'] ) ) {
						$current['load_panels'] = (bool) $input['ui_panel_enabled'] ? 1 : 0;
						$updated_keys[]         = 'ui_panel_enabled';
					}

					if ( isset( $input['live_preview_enabled'] ) ) {
						$current['uabb-live-preview'] = (bool) $input['live_preview_enabled'] ? 1 : 0;
						$updated_keys[]               = 'live_preview_enabled';
					}

					if ( empty( $updated_keys ) ) {
						return new WP_Error(
							'uabb_no_settings',
							__( 'No valid settings provided to update.', 'uabb' )
						);
					}

					FLBuilderModel::update_admin_settings_option( '_fl_builder_uabb', $current );
					FLBuilderModel::delete_asset_cache_for_all_posts();
					UABB_Init::set_uabb_options();

					return array(
						'success' => true,
						'updated' => $updated_keys,
					);
				},
				'permission_callback' => static function () {
					return current_user_can( 'manage_options' );
				},
				'meta'                => array(
					'show_in_rest' => true,
					'mcp'          => array(
						'public' => true,
						'type'   => 'tool',
					),
				),
			)
		);
	}
}
