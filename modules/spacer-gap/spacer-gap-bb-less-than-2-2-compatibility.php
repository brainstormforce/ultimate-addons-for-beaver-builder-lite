<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.2.4 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Spacer Gap Module
 */

FLBuilder::register_module(
	'UABBSpacerGap',
	[
		'spacer_gap_general' => [ // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'spacer_gap_general' => [ // Section.
					'title'  => '', // Section Title.
					'fields' => [ // Section Fields.
						'desktop_space' => [
							'type'        => 'text',
							'label'       => __( 'Desktop', 'uabb' ),
							'size'        => '8',
							'placeholder' => '10',
							'class'       => 'uabb-spacer-gap-desktop',
							'description' => 'px',
							'help'        => __( 'This value will work for all devices.', 'uabb' ),
						],
						'medium_device' => [
							'type'        => 'text',
							'label'       => __( 'Medium Device ( Tabs )', 'uabb' ),
							'default'     => '',
							'size'        => '8',
							'class'       => 'uabb-spacer-gap-tab-landscape',
							'description' => 'px',
						],

						'small_device'  => [
							'type'        => 'text',
							'label'       => __( 'Small Device ( Mobile )', 'uabb' ),
							'default'     => '',
							'size'        => '8',
							'class'       => 'uabb-spacer-gap-mobile',
							'description' => 'px',
						],
					],
				],
			],
		],
	]
);
