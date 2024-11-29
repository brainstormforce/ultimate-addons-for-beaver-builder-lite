<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.2.4 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Separator Module
 */

FLBuilder::register_module(
	'UABBSeparatorModule',
	[
		'general' => [ // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'general' => [ // Section.
					'title'  => '', // Section Title.
					'fields' => [ // Section Fields.
						'color'     => [
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'height'    => [
							'type'        => 'text',
							'label'       => __( 'Thickness', 'uabb' ),
							'placeholder' => '1',
							'maxlength'   => '2',
							'size'        => '3',
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-separator',
								'property' => 'border-top-width',
								'unit'     => 'px',
							],
							'help'        => __( 'Thickness of Border', 'uabb' ),
						],
						'width'     => [
							'type'        => 'text',
							'label'       => __( 'Width', 'uabb' ),
							'placeholder' => '100',
							'maxlength'   => '3',
							'size'        => '5',
							'description' => '%',
						],
						'alignment' => [
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'options' => [
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							],
							'preview' => [
								'type'     => 'css',
								'selector' => '.uabb-separator-parent',
								'property' => 'text-align',
							],
							'help'    => __( 'Align the border.', 'uabb' ),
						],
						'style'     => [
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'solid',
							'options' => [
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							],
							'preview' => [
								'type'     => 'css',
								'selector' => '.uabb-separator',
								'property' => 'border-top-style',
							],
							'help'    => __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
						],
					],
				],
			],
		],
	]
);
