<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2
 * Applicable for BB version greater than 2.2 and UABB version 1.3.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
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
						'link' => [
							'type'          => 'link',
							'label'         => __( 'Link', 'uabb' ),
							'placeholder'   => 'http://www.example.com',
							'default'       => '#',
							'show_target'   => true,
							'show_nofollow' => true,
							'preview'       => [
								'type' => 'none',
							],
							'connections'   => [ 'url' ],
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
							'toggle'  => [
								'default' => [
									'fields' => [ 'button_padding_dimension', 'button_border', 'border_hover_color' ],
								],
							],
						],
						'border_size'                => [
							'type'        => 'unit',
							'label'       => __( 'Border Size', 'uabb' ),
							'slider'      => true,
							'units'       => [ 'px' ],
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
						'text_color'       => [
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
						],
						'text_hover_color' => [
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'preview'     => [
								'type' => 'none',
							],
						],
						'bg_color'         => [
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
						],
						'bg_hover_color'   => [
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'preview'     => [
								'type' => 'none',
							],
						],
						'hover_attribute'  => [
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
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'units'      => [ 'px' ],
							'responsive' => true,
							'preview'    => [
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							],
						],
						'button_border'            => [
							'type'    => 'border',
							'label'   => __( 'Border', 'uabb' ),
							'slider'  => true,
							'units'   => [ 'px' ],
							'preview' => [
								'type'      => 'css',
								'selector'  => '.uabb-creative-button-wrap a',
								'property'  => 'border',
								'unit'      => 'px',
								'important' => true,
							],
						],
						'border_hover_color'       => [
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'preview'     => [
								'type' => 'none',
							],
						],
						'custom_width'             => [
							'type'      => 'unit',
							'label'     => __( 'Custom Width', 'uabb' ),
							'default'   => '200',
							'maxlength' => '3',
							'size'      => '4',
							'slider'    => true,
							'units'     => [ 'px' ],
						],
						'custom_height'            => [
							'type'      => 'unit',
							'label'     => __( 'Custom Height', 'uabb' ),
							'default'   => '45',
							'maxlength' => '3',
							'size'      => '4',
							'slider'    => true,
							'units'     => [ 'px' ],
						],
						'padding_top_bottom'       => [
							'type'        => 'unit',
							'label'       => __( 'Padding Top/Bottom', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'slider'      => true,
							'units'       => [ 'px' ],
						],
						'padding_left_right'       => [
							'type'        => 'unit',
							'label'       => __( 'Padding Left/Right', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '4',
							'slider'      => true,
							'units'       => [ 'px' ],
						],
						'border_radius'            => [
							'type'      => 'unit',
							'label'     => __( 'Round Corners', 'uabb' ),
							'maxlength' => '3',
							'size'      => '4',
							'slider'    => true,
							'units'     => [ 'px' ],
						],
						'align'                    => [
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'options' => [
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							],
						],
						'mob_align'                => [
							'type'    => 'align',
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
						'button_typo' => [
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => [
								'type'     => 'css',
								'selector' => '.uabb-creative-button',
							],
						],
					],
				],
			],
		],
	]
);
