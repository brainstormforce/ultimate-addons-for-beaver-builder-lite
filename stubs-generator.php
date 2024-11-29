<?php
/**
 * This file returns an array of package configurations.
 *
 * @package UltimateAddonsForBeaverBuilderLite
 * @since 1.0.0
 */

return [
	'packages' => [
		'wordpress' => [
			'source' => 'https://github.com/WordPress/WordPress.git',
			'tags'   => [ 'v6.5' ],
			'output' => __DIR__ . '/stubs/wordpress',
		],
	],
];
