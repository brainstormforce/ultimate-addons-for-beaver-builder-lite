<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.2.4 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Button Module
 */

FLBuilder::register_module(
	'UABBButtonModule',
	[
		'general'             => [
			'title'    => __( 'General', 'uabb' ),
			'sections' => [
				'general' => [
					'title'  => '',
					'fields' => [
						'text' => [
							'type'        => 'text',
							'label'       => __( 'Text', 'uabb' ),
							'default'     => __( 'Click Here', 'uabb' ),
							'preview'     => [
								'type'     => 'text',
								'selector' => '.uabb-creative-button-text',
							],
							'connections' => [ 'string', 'html' ],
						],

					],
				],
				'link'    => [
					'title'  => __( 'Link', 'uabb' ),
					'fields' => [
						'link'        => [
							'type'        => 'link',
							'label'       => __( 'Link', 'uabb' ),
							'placeholder' => 'http://www.example.com',
							'default'     => '#',
							'preview'     => [
								'type' => 'none',
							],
							'connections' => [ 'url' ],
						],
						'link_target' => [
							'type'    => 'select',
							'label'   => __( 'Link Target', 'uabb' ),
							'default' => '_self',
							'options' => [
								'_self'  => __( 'Same Window', 'uabb' ),
								'_blank' => __( 'New Window', 'uabb' ),
							],
							'preview' => [
								'type' => 'none',
							],
						],
					],
				],
			],
		],
		'style'               => [
			'title'    => __( 'Style', 'uabb' ),
			'sections' => [
				'style'      => [
					'title'  => __( 'Style', 'uabb' ),
					'fields' => [
						'style'                      => [
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'default',
							'class'   => 'creative_button_styles',
							'options' => [
								'default'     => __( 'Default', 'uabb' ),
								'flat'        => __( 'Flat', 'uabb' ),
								'gradient'    => __( 'Gradient', 'uabb' ),
								'transparent' => __( 'Transparent', 'uabb' ),
								'threed'      => __( '3D', 'uabb' ),
							],
						],
						'border_size'                => [
							'type'        => 'text',
							'label'       => __( 'Border Size', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '5',
							'placeholder' => '2',
						],
						'transparent_button_options' => [
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
							'default' => 'transparent-fade',
							'options' => [
								'none'                    => __( 'None', 'uabb' ),
								'transparent-fade'        => __( 'Fade Background', 'uabb' ),
								'transparent-fill-top'    => __( 'Fill Background From Top', 'uabb' ),
								'transparent-fill-bottom' => __( 'Fill Background From Bottom', 'uabb' ),
								'transparent-fill-left'   => __( 'Fill Background From Left', 'uabb' ),
								'transparent-fill-right'  => __( 'Fill Background From Right', 'uabb' ),
								'transparent-fill-center' => __( 'Fill Background Vertical', 'uabb' ),
								'transparent-fill-diagonal' => __( 'Fill Background Diagonal', 'uabb' ),
								'transparent-fill-horizontal' => __( 'Fill Background Horizontal', 'uabb' ),
							],
						],
						'threed_button_options'      => [
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
							'default' => 'threed_down',
							'options' => [
								'threed_down'    => __( 'Move Down', 'uabb' ),
								'threed_up'      => __( 'Move Up', 'uabb' ),
								'threed_left'    => __( 'Move Left', 'uabb' ),
								'threed_right'   => __( 'Move Right', 'uabb' ),
								'animate_top'    => __( 'Animate Top', 'uabb' ),
								'animate_bottom' => __( 'Animate Bottom', 'uabb' ),
							],
						],
						'flat_button_options'        => [
							'type'    => 'select',
							'label'   => __( 'Hover Styles', 'uabb' ),
							'default' => 'none',
							'options' => [
								'none'                => __( 'None', 'uabb' ),
								'animate_to_left'     => __( 'Appear Icon From Right', 'uabb' ),
								'animate_to_right'    => __( 'Appear Icon From Left', 'uabb' ),
								'animate_from_top'    => __( 'Appear Icon From Top', 'uabb' ),
								'animate_from_bottom' => __( 'Appear Icon From Bottom', 'uabb' ),
							],
						],
					],
				],
				'icon'       => [
					'title'  => __( 'Icons', 'uabb' ),
					'fields' => [
						'icon'          => [
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
						],
						'icon_position' => [
							'type'    => 'select',
							'label'   => __( 'Icon Position', 'uabb' ),
							'default' => 'after',
							'options' => [
								'before' => __( 'Before Text', 'uabb' ),
								'after'  => __( 'After Text', 'uabb' ),
							],
						],
					],
				],
				'colors'     => [
					'title'  => __( 'Colors', 'uabb' ),
					'fields' => [
						'text_color'         => [
							'type'       => 'color',
							'label'      => __( 'Text Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'text_hover_color'   => [
							'type'       => 'color',
							'label'      => __( 'Text Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => [
								'type' => 'none',
							],
						],
						'bg_color'           => [
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'bg_color_opc'       => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],
						'bg_hover_color'     => [
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => [
								'type' => 'none',
							],
						],
						'bg_hover_color_opc' => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],
						'hover_attribute'    => [
							'type'    => 'select',
							'label'   => __( 'Apply Hover Color To', 'uabb' ),
							'default' => 'bg',
							'options' => [
								'border' => __( 'Border', 'uabb' ),
								'bg'     => __( 'Background', 'uabb' ),
							],
							'width'   => '75px',
						],

					],
				],
				'formatting' => [
					'title'  => __( 'Structure', 'uabb' ),
					'fields' => [
						'width'                    => [
							'type'    => 'select',
							'label'   => __( 'Width', 'uabb' ),
							'default' => 'auto',
							'options' => [
								'auto'   => _x( 'Auto', 'Width.', 'uabb' ),
								'full'   => __( 'Full Width', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							],
							'toggle'  => [
								'auto'   => [
									'fields' => [ 'align', 'mob_align' ],
								],
								'full'   => [
									'fields' => [],
								],
								'custom' => [
									'fields' => [ 'align', 'mob_align', 'custom_width', 'custom_height', 'padding_top_bottom', 'padding_left_right' ],
								],
							],
						],
						'button_padding_dimension' => [
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'responsive'  => true,
							'preview'     => [
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							],
						],
						'button_border_style'      => [
							'type'    => 'select',
							'label'   => __( 'Bottom Border Type', 'uabb' ),
							'default' => 'none',
							'options' => [
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							],
							'preview' => [
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a',
								'property' => 'border-style',
							],
						],
						'button_border_width'      => [
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a',
								'property' => 'border-width',
								'unit'     => 'px',
							],
						],
						'button_border_radius'     => [
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'placeholder' => '1',
							'description' => 'px',
							'maxlength'   => '2',
							'size'        => '6',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a',
								'property' => 'border-radius',
								'unit'     => 'px',
							],
						],
						'button_border_color'      => [
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => [
								'type'     => 'css',
								'selector' => '.uabb-creative-button-wrap a',
								'property' => 'border-color',
							],
						],
						'border_hover_color'       => [
							'type'       => 'color',
							'label'      => __( 'Border hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'custom_width'             => [
							'type'        => 'text',
							'label'       => __( 'Custom Width', 'uabb' ),
							'default'     => '200',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						],
						'custom_height'            => [
							'type'        => 'text',
							'label'       => __( 'Custom Height', 'uabb' ),
							'default'     => '45',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						],
						'padding_top_bottom'       => [
							'type'        => 'text',
							'label'       => __( 'Padding Top/Bottom', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						],
						'padding_left_right'       => [
							'type'        => 'text',
							'label'       => __( 'Padding Left/Right', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						],
						'border_radius'            => [
							'type'        => 'text',
							'label'       => __( 'Round Corners', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						],
						'align'                    => [
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'options' => [
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							],
						],
						'mob_align'                => [
							'type'    => 'select',
							'label'   => __( 'Mobile Alignment', 'uabb' ),
							'default' => 'center',
							'options' => [
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							],
						],
					],
				],
			],
		],
		'creative_typography' => [
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => [
				'typography' => [
					'title'  => __( 'Button Settings', 'uabb' ),
					'fields' => [
						'font_family'      => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-creative-button',
							],
						],
						'font_size_unit'   => [
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'responsive'  => [
								'placeholder' => [
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								],
							],
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-creative-button',
								'property' => 'font-size',
								'unit'     => 'px',
							],
						],
						'line_height_unit' => [
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'responsive'  => [
								'placeholder' => [
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								],
							],
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-creative-button',
								'property' => 'line-height',
								'unit'     => 'em',
							],
						],
					],
				],
			],
		],
	]
);
