<?php
/**
 * UABB Template Abilities.
 *
 * @since 1.6.8
 * @package UABB
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers template-related abilities:
 * - uabb/list-cloud-templates
 * - uabb/refresh-cloud-templates
 *
 * @since 1.6.8
 */
class UABB_Template_Abilities {

	/**
	 * Register all abilities in this class.
	 *
	 * @since 1.6.8
	 */
	public static function register() {
		self::register_list_cloud_templates();
		self::register_refresh_cloud_templates();
	}

	/**
	 * Register the list-cloud-templates ability.
	 *
	 * @since 1.6.8
	 */
	private static function register_list_cloud_templates() {
		wp_register_ability(
			'uabb/list-cloud-templates',
			array(
				'label'               => __( 'List Cloud Templates', 'uabb' ),
				'description'         => __( 'Browse UABB cloud templates including page templates, sections, and presets with counts.', 'uabb' ),
				'category'            => UABB_Abilities::CATEGORY,
				'input_schema'        => array(
					'type'       => 'object',
					'properties' => array(
						'type' => array(
							'type'        => 'string',
							'enum'        => array( 'all', 'page-templates', 'sections', 'presets' ),
							'description' => __( 'Filter by template type. Defaults to "all".', 'uabb' ),
						),
					),
				),
				'output_schema'       => array(
					'type'       => 'object',
					'properties' => array(
						'counts'    => array(
							'type'       => 'object',
							'properties' => array(
								'total'          => array( 'type' => 'integer' ),
								'page_templates' => array( 'type' => 'integer' ),
								'sections'       => array( 'type' => 'integer' ),
								'presets'        => array( 'type' => 'integer' ),
							),
						),
						'templates' => array(
							'type'        => 'object',
							'description' => __( 'Template data grouped by type.', 'uabb' ),
						),
					),
				),
				'execute_callback'    => static function ( array $input ) {
					$type = isset( $input['type'] ) ? $input['type'] : 'all';

					$counts = array(
						'total'          => UABB_Cloud_Templates::get_cloud_templates_count(),
						'page_templates' => UABB_Cloud_Templates::get_cloud_templates_count( 'page-templates' ),
						'sections'       => UABB_Cloud_Templates::get_cloud_templates_count( 'sections' ),
						'presets'        => UABB_Cloud_Templates::get_cloud_templates_count( 'presets' ),
					);

					$templates = array();

					if ( 'all' === $type ) {
						$all = UABB_Cloud_Templates::get_cloud_templates();
						if ( ! empty( $all ) ) {
							foreach ( $all as $template_type => $items ) {
								$templates[ $template_type ] = self::format_template_list( $items );
							}
						}
					} else {
						$items = UABB_Cloud_Templates::get_cloud_templates( $type );
						if ( ! empty( $items ) ) {
							$templates[ $type ] = self::format_template_list( $items );
						}
					}

					return array(
						'counts'    => $counts,
						'templates' => $templates,
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
	 * Register the refresh-cloud-templates ability.
	 *
	 * @since 1.6.8
	 */
	private static function register_refresh_cloud_templates() {
		wp_register_ability(
			'uabb/refresh-cloud-templates',
			array(
				'label'               => __( 'Refresh Cloud Templates', 'uabb' ),
				'description'         => __( 'Fetch the latest templates from the UABB cloud server (templates.ultimatebeaver.com) and update the local cache.', 'uabb' ),
				'category'            => UABB_Abilities::CATEGORY,
				'input_schema'        => array(
					'type'       => 'object',
					'properties' => new \stdClass(),
				),
				'output_schema'       => array(
					'type'       => 'object',
					'properties' => array(
						'success' => array( 'type' => 'boolean' ),
						'counts'  => array(
							'type'       => 'object',
							'properties' => array(
								'total'          => array( 'type' => 'integer' ),
								'page_templates' => array( 'type' => 'integer' ),
								'sections'       => array( 'type' => 'integer' ),
								'presets'        => array( 'type' => 'integer' ),
							),
						),
					),
				),
				'execute_callback'    => static function () {
					UABB_Cloud_Templates::reset_cloud_transient();

					return array(
						'success' => true,
						'counts'  => array(
							'total'          => UABB_Cloud_Templates::get_cloud_templates_count(),
							'page_templates' => UABB_Cloud_Templates::get_cloud_templates_count( 'page-templates' ),
							'sections'       => UABB_Cloud_Templates::get_cloud_templates_count( 'sections' ),
							'presets'        => UABB_Cloud_Templates::get_cloud_templates_count( 'presets' ),
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
	 * Format a template list for output — extract key info, skip large data blobs.
	 *
	 * @since 1.6.8
	 * @param array $items Raw template items from the cloud.
	 * @return array Formatted list.
	 */
	private static function format_template_list( $items ) {
		if ( ! is_array( $items ) ) {
			return array();
		}

		$formatted = array();
		foreach ( $items as $id => $item ) {
			$entry = array( 'id' => $id );

			if ( isset( $item['name'] ) ) {
				$entry['name'] = $item['name'];
			}
			if ( isset( $item['image'] ) ) {
				$entry['image'] = $item['image'];
			}
			if ( isset( $item['count'] ) ) {
				$entry['count'] = (int) $item['count'];
			}
			if ( isset( $item['status'] ) ) {
				$entry['installed'] = 'true' === $item['status'];
			}

			$formatted[] = $entry;
		}

		return $formatted;
	}
}
