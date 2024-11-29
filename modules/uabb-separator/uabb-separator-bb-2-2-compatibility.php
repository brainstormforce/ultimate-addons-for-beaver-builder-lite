<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2.
 * Applicable for BB version greater than 2.2 and UABB version 1.3.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
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
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
						],
						'height'    => [
							'type'        => 'unit',
							'label'       => __( 'Thickness', 'uabb' ),
							'placeholder' => '1',
							'maxlength'   => '2',
							'size'        => '3',
							'slider'      => true,
							'units'       => [ 'px' ],
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-separator',
								'property' => 'border-top-width',
								'unit'     => 'px',
							],
							'help'        => __( 'Thickness of Border', 'uabb' ),
						],
						'width'     => [
							'type'        => 'unit',
							'label'       => __( 'Width', 'uabb' ),
							'placeholder' => '100',
							'maxlength'   => '3',
							'size'        => '5',
							'slider'      => true,
							'units'       => [ '%' ],
						],
						'alignment' => [
							'type'    => 'align',
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
