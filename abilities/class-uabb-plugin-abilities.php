<?php
/**
 * UABB Plugin Info Ability.
 *
 * @since 1.6.8
 * @package UABB
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the uabb/get-plugin-info ability.
 *
 * @since 1.6.8
 */
class UABB_Plugin_Abilities {

	/**
	 * Register all abilities in this class.
	 *
	 * @since 1.6.8
	 */
	public static function register() {
		self::register_get_plugin_info();
	}

	/**
	 * Register the get-plugin-info ability.
	 *
	 * Returns UABB version, Beaver Builder status, module counts, and settings flags.
	 *
	 * @since 1.6.8
	 */
	private static function register_get_plugin_info() {
		wp_register_ability(
			'uabb/get-plugin-info',
			array(
				'label'               => __( 'Get UABB Plugin Info', 'uabb' ),
				'description'         => __( 'Get UABB Lite plugin information including version, Beaver Builder status, module counts, and settings summary.', 'uabb' ),
				'category'            => UABB_Abilities::CATEGORY,
				'input_schema'        => array(
					'type'       => 'object',
					'properties' => new \stdClass(),
				),
				'output_schema'       => array(
					'type'       => 'object',
					'properties' => array(
						'version'          => array(
							'type'        => 'string',
							'description' => __( 'UABB Lite plugin version.', 'uabb' ),
						),
						'is_lite'          => array(
							'type'        => 'boolean',
							'description' => __( 'Whether this is the lite version.', 'uabb' ),
						),
						'beaver_builder'   => array(
							'type'       => 'object',
							'properties' => array(
								'active'  => array(
									'type' => 'boolean',
								),
								'version' => array(
									'type' => 'string',
								),
							),
						),
						'modules'          => array(
							'type'       => 'object',
							'properties' => array(
								'total'    => array(
									'type' => 'integer',
								),
								'enabled'  => array(
									'type' => 'integer',
								),
								'disabled' => array(
									'type' => 'integer',
								),
							),
						),
						'settings'         => array(
							'type'       => 'object',
							'properties' => array(
								'global_styling_enabled' => array(
									'type' => 'boolean',
								),
								'ui_panel_enabled'       => array(
									'type' => 'boolean',
								),
								'live_preview_enabled'   => array(
									'type' => 'boolean',
								),
								'template_cloud_enabled' => array(
									'type' => 'boolean',
								),
							),
						),
					),
				),
				'execute_callback'    => static function () {
					$all_modules    = BB_Ultimate_Addon_Helper::get_all_modules();
					$active_modules = BB_Ultimate_Addon_Helper::get_builder_uabb_modules();
					$uabb_settings  = BB_Ultimate_Addon_Helper::get_builder_uabb();
					$branding       = BB_Ultimate_Addon_Helper::get_builder_uabb_branding();

					$enabled_count = 0;
					foreach ( $all_modules as $slug => $label ) {
						if ( isset( $active_modules[ $slug ] ) && 'false' !== $active_modules[ $slug ] ) {
							++$enabled_count;
						}
					}

					$bb_version = '';
					if ( defined( 'FL_BUILDER_VERSION' ) ) {
						$bb_version = FL_BUILDER_VERSION;
					}

					$global_settings = UABB_Global_Styling::get_uabb_global_settings();

					return array(
						'version'        => BB_ULTIMATE_ADDON_LITE_VERSION,
						'is_lite'        => true,
						'beaver_builder' => array(
							'active'  => class_exists( 'FLBuilder' ),
							'version' => $bb_version,
						),
						'modules'        => array(
							'total'    => count( $all_modules ),
							'enabled'  => $enabled_count,
							'disabled' => count( $all_modules ) - $enabled_count,
						),
						'settings'       => array(
							'global_styling_enabled' => isset( $global_settings->enable_global ) && 'yes' === $global_settings->enable_global,
							'ui_panel_enabled'       => ! empty( $uabb_settings['load_panels'] ),
							'live_preview_enabled'   => ! empty( $uabb_settings['uabb-live-preview'] ),
							'template_cloud_enabled' => is_array( $branding ) && ! empty( $branding['uabb-enable-template-cloud'] ),
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
}
