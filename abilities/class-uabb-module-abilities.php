<?php
/**
 * UABB Module Abilities.
 *
 * @since 1.6.8
 * @package UABB
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers module-related abilities:
 * - uabb/list-modules
 * - uabb/get-module-details
 * - uabb/update-module-status
 *
 * @since 1.6.8
 */
class UABB_Module_Abilities {

	/**
	 * Modules that cannot be disabled.
	 *
	 * @since 1.6.8
	 * @var array
	 */
	const ALWAYS_ON_MODULES = array( 'image-icon', 'uabb-separator', 'uabb-button' );

	/**
	 * Register all abilities in this class.
	 *
	 * @since 1.6.8
	 */
	public static function register() {
		self::register_list_modules();
		self::register_get_module_details();
		self::register_update_module_status();
	}

	/**
	 * Register the list-modules ability.
	 *
	 * @since 1.6.8
	 */
	private static function register_list_modules() {
		wp_register_ability(
			'uabb/list-modules',
			array(
				'label'               => __( 'List UABB Modules', 'uabb' ),
				'description'         => __( 'List all 13 UABB Lite modules with their enabled/disabled status. Optionally filter by status.', 'uabb' ),
				'category'            => UABB_Abilities::CATEGORY,
				'input_schema'        => array(
					'type'       => 'object',
					'properties' => array(
						'status' => array(
							'type'        => 'string',
							'enum'        => array( 'all', 'enabled', 'disabled' ),
							'description' => __( 'Filter modules by status. Defaults to "all".', 'uabb' ),
						),
					),
				),
				'output_schema'       => array(
					'type'       => 'object',
					'properties' => array(
						'modules' => array(
							'type'  => 'array',
							'items' => array(
								'type'       => 'object',
								'properties' => array(
									'slug'      => array( 'type' => 'string' ),
									'label'     => array( 'type' => 'string' ),
									'enabled'   => array( 'type' => 'boolean' ),
									'always_on' => array( 'type' => 'boolean' ),
								),
							),
						),
						'total'   => array(
							'type' => 'integer',
						),
					),
				),
				'execute_callback'    => static function ( array $input ) {
					$filter         = isset( $input['status'] ) ? $input['status'] : 'all';
					$all_modules    = BB_Ultimate_Addon_Helper::get_all_modules();
					$active_modules = BB_Ultimate_Addon_Helper::get_builder_uabb_modules();

					$modules = array();
					foreach ( $all_modules as $slug => $label ) {
						$is_enabled   = isset( $active_modules[ $slug ] ) && 'false' !== $active_modules[ $slug ];
						$is_always_on = in_array( $slug, self::ALWAYS_ON_MODULES, true );

						if ( 'enabled' === $filter && ! $is_enabled ) {
							continue;
						}
						if ( 'disabled' === $filter && $is_enabled ) {
							continue;
						}

						$modules[] = array(
							'slug'      => $slug,
							'label'     => $label,
							'enabled'   => $is_enabled,
							'always_on' => $is_always_on,
						);
					}

					return array(
						'modules' => $modules,
						'total'   => count( $modules ),
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
	 * Register the get-module-details ability.
	 *
	 * @since 1.6.8
	 */
	private static function register_get_module_details() {
		wp_register_ability(
			'uabb/get-module-details',
			array(
				'label'               => __( 'Get Module Details', 'uabb' ),
				'description'         => __( 'Get detailed information about a specific UABB module including its settings schema, description, and category.', 'uabb' ),
				'category'            => UABB_Abilities::CATEGORY,
				'input_schema'        => array(
					'type'       => 'object',
					'properties' => array(
						'slug' => array(
							'type'        => 'string',
							'description' => __( 'The module slug (e.g. "uabb-button", "flip-box").', 'uabb' ),
						),
					),
					'required'   => array( 'slug' ),
				),
				'output_schema'       => array(
					'type'       => 'object',
					'properties' => array(
						'slug'        => array( 'type' => 'string' ),
						'label'       => array( 'type' => 'string' ),
						'description' => array( 'type' => 'string' ),
						'category'    => array( 'type' => 'string' ),
						'enabled'     => array( 'type' => 'boolean' ),
						'always_on'   => array( 'type' => 'boolean' ),
						'settings'    => array(
							'type'        => 'array',
							'description' => __( 'List of settings tab names and their section/field names.', 'uabb' ),
						),
					),
				),
				'execute_callback'    => static function ( array $input ) {
					$slug        = sanitize_text_field( $input['slug'] );
					$all_modules = BB_Ultimate_Addon_Helper::get_all_modules();

					if ( ! isset( $all_modules[ $slug ] ) ) {
						return new WP_Error(
							'uabb_invalid_module',
							sprintf(
								/* translators: %s: module slug */
								__( 'Module "%s" does not exist.', 'uabb' ),
								$slug
							)
						);
					}

					$active_modules = BB_Ultimate_Addon_Helper::get_builder_uabb_modules();
					$is_enabled     = isset( $active_modules[ $slug ] ) && 'false' !== $active_modules[ $slug ];

					$result = array(
						'slug'        => $slug,
						'label'       => $all_modules[ $slug ],
						'description' => '',
						'category'    => '',
						'enabled'     => $is_enabled,
						'always_on'   => in_array( $slug, self::ALWAYS_ON_MODULES, true ),
						'settings'    => array(),
					);

					// Try to get richer details from the registered BB module.
					if ( class_exists( 'FLBuilderModel' ) && isset( FLBuilderModel::$modules[ $slug ] ) ) {
						$module = FLBuilderModel::$modules[ $slug ];

						if ( ! empty( $module->description ) ) {
							$result['description'] = $module->description;
						}
						if ( ! empty( $module->category ) ) {
							$result['category'] = $module->category;
						}

						// Extract settings tabs/sections/field names.
						if ( ! empty( $module->form ) ) {
							$settings = array();
							foreach ( $module->form as $tab_id => $tab ) {
								$tab_info = array(
									'tab'      => $tab_id,
									'title'    => isset( $tab['title'] ) ? $tab['title'] : $tab_id,
									'sections' => array(),
								);

								if ( isset( $tab['sections'] ) && is_array( $tab['sections'] ) ) {
									foreach ( $tab['sections'] as $section_id => $section ) {
										$section_info = array(
											'section' => $section_id,
											'title'   => isset( $section['title'] ) ? $section['title'] : $section_id,
											'fields'  => array(),
										);

										if ( isset( $section['fields'] ) && is_array( $section['fields'] ) ) {
											$section_info['fields'] = array_keys( $section['fields'] );
										}

										$tab_info['sections'][] = $section_info;
									}
								}

								$settings[] = $tab_info;
							}
							$result['settings'] = $settings;
						}
					}

					return $result;
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
	 * Register the update-module-status ability.
	 *
	 * @since 1.6.8
	 */
	private static function register_update_module_status() {
		wp_register_ability(
			'uabb/update-module-status',
			array(
				'label'               => __( 'Enable/Disable Modules', 'uabb' ),
				'description'         => __( 'Toggle UABB modules on or off. Always-on modules (image-icon, uabb-separator, uabb-button) cannot be disabled and will be skipped.', 'uabb' ),
				'category'            => UABB_Abilities::CATEGORY,
				'input_schema'        => array(
					'type'       => 'object',
					'properties' => array(
						'modules' => array(
							'type'        => 'object',
							'description' => __( 'Object mapping module slugs to boolean (true=enable, false=disable). Example: {"flip-box": false, "ribbon": true}', 'uabb' ),
						),
					),
					'required'   => array( 'modules' ),
				),
				'output_schema'       => array(
					'type'       => 'object',
					'properties' => array(
						'updated' => array(
							'type'  => 'array',
							'items' => array(
								'type'       => 'object',
								'properties' => array(
									'slug'    => array( 'type' => 'string' ),
									'enabled' => array( 'type' => 'boolean' ),
								),
							),
						),
						'skipped' => array(
							'type'  => 'array',
							'items' => array(
								'type'       => 'object',
								'properties' => array(
									'slug'   => array( 'type' => 'string' ),
									'reason' => array( 'type' => 'string' ),
								),
							),
						),
					),
				),
				'execute_callback'    => static function ( array $input ) {
					if ( ! isset( $input['modules'] ) || ! is_array( $input['modules'] ) ) {
						return new WP_Error(
							'uabb_invalid_input',
							__( 'The "modules" parameter must be an object mapping slugs to booleans.', 'uabb' )
						);
					}

					$all_modules     = BB_Ultimate_Addon_Helper::get_all_modules();
					$current_modules = BB_Ultimate_Addon_Helper::get_builder_uabb_modules();
					$updated         = array();
					$skipped         = array();

					foreach ( $input['modules'] as $raw_slug => $enable ) {
						$slug   = sanitize_text_field( $raw_slug );
						$enable = (bool) $enable;

						if ( ! isset( $all_modules[ $slug ] ) ) {
							$skipped[] = array(
								'slug'   => $slug,
								'reason' => __( 'Module does not exist.', 'uabb' ),
							);
							continue;
						}

						if ( ! $enable && in_array( $slug, self::ALWAYS_ON_MODULES, true ) ) {
							$skipped[] = array(
								'slug'   => $slug,
								'reason' => __( 'This module is always enabled and cannot be disabled.', 'uabb' ),
							);
							continue;
						}

						$current_modules[ $slug ] = $enable ? $slug : 'false';
						$updated[]                = array(
							'slug'    => $slug,
							'enabled' => (bool) $enable,
						);
					}

					if ( ! empty( $updated ) ) {
						// Mark that not all modules are selected (prevent auto-enable of all).
						$current_modules['unset_all'] = 'unset_all';
						unset( $current_modules['all'] );

						FLBuilderModel::update_admin_settings_option( '_fl_builder_uabb_modules', $current_modules );
						FLBuilderModel::delete_asset_cache_for_all_posts();
						UABB_Init::set_uabb_options();
					}

					return array(
						'updated' => $updated,
						'skipped' => $skipped,
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
