<?php
/**
 * This file returns an array of package configurations.
 *
 * @package UltimateAddonsForBeaverBuilderLite
 * @since 1.0.0
 */

return array(
	'packages' => array(
		'wordpress' => array(
			'source' => 'https://github.com/WordPress/WordPress.git',
			'tags'   => array( 'v6.5' ),
			'output' => __DIR__ . '/stubs/wordpress',
		),
	),
);
