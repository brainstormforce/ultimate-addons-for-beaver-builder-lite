<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Ribbon Module
 */

FLBuilder::register_module(
	'RibbonModule',
	[
		'general'    => [ // Tab.
			'title'    => __( 'Layout', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'general' => [
					'title'  => '',
					'fields' => [
						'title'       => [
							'type'    => 'text',
							'label'   => __( 'Ribbon Message', 'uabb' ),
							'default' => __( 'SPECIAL OFFER', 'uabb' ),
							'preview' => [
								'type'     => 'text',
								'selector' => '.uabb-ribbon-text-title',
							],
						],
						'left_icon'   => [
							'type'        => 'icon',
							'label'       => __( 'Left Icon', 'uabb' ),
							'show_remove' => true,
						],
						'right_icon'  => [
							'type'        => 'icon',
							'label'       => __( 'Right Icon', 'uabb' ),
							'show_remove' => true,
						],
						'ribbon_resp' => [
							'type'    => 'select',
							'label'   => __( 'Hide Ribbon Wings', 'uabb' ),
							'default' => 'small',
							'help'    => __( 'To hide Ribbon Wings on Small or Medium device use this option.', 'uabb' ),
							'options' => [
								'none'   => __( 'None', 'uabb' ),
								'small'  => __( 'Small Devices', 'uabb' ),
								'medium' => __( 'Medium & Small Devices', 'uabb' ),
							],
						],
					],
				],
				'style'   => [
					'title'  => __( 'Style', 'uabb' ),
					'fields' => [
						'ribbon_width' => [
							'type'    => 'select',
							'label'   => __( 'Ribbon Width', 'uabb' ),
							'default' => 'auto',
							'options' => [
								'auto'   => __( 'Auto', 'uabb' ),
								'full'   => __( 'Full', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							],
							'toggle'  => [
								'custom' => [
									'fields' => [ 'custom_width', 'ribbon_align' ],
								],
								'auto'   => [
									'fields' => [ 'ribbon_align' ],
								],
							],
						],
						'custom_width' => [
							'type'        => 'text',
							'label'       => __( 'Custom Width', 'uabb' ),
							'placeholder' => '500',
							'size'        => '6',
							'description' => 'px',
						],
						'ribbon_align' => [
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'To align Ribbon use this setting.', 'uabb' ),
							'options' => [
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							],
						],
						'stitching'    => [
							'type'    => 'select',
							'label'   => __( 'Stitching', 'uabb' ),
							'default' => 'yes',
							'options' => [
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							],
							'help'    => __( 'To give Stitch effect on Ribbon', 'uabb' ),
						],
						'shadow'       => [
							'type'    => 'select',
							'label'   => __( 'Ribbon Shadow', 'uabb' ),
							'default' => 'yes',
							'options' => [
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							],
						],
					],
				],
				'colors'  => [
					'title'  => __( 'Ribbon Colors', 'uabb' ),
					'fields' => [
						'ribbon_bg_type' => [
							'type'    => 'select',
							'label'   => __( 'Ribbon Color Type', 'uabb' ),
							'default' => 'color',
							'help'    => __( 'You can select one of the two background types: Color: simple one color background or Gradient: two color background.', 'uabb' ),
							'options' => [
								'color'    => __( 'Color', 'uabb' ),
								'gradient' => __( 'Gradient', 'uabb' ),
							],
							'toggle'  => [
								'color'    => [
									'fields' => [ 'ribbon_color' ],
								],
								'gradient' => [
									'fields' => [ 'gradient_color' ],
								],
							],
						],
						'ribbon_color'   => [
							'type'       => 'color',
							'label'      => __( 'Ribbon Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'gradient_color' => [
							'type'    => 'uabb-gradient',
							'label'   => __( 'Gradient', 'uabb' ),
							'default' => [
								'color_one' => '',
								'color_two' => '',
								'direction' => 'top_bottom',
								'angle'     => '0',
							],
						],
						'icon_color'     => [
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'fold_color'     => [
							'type'       => 'color',
							'label'      => __( 'Ribbon Fold Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'end_color'      => [
							'type'       => 'color',
							'label'      => __( 'Ribbon Wings Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
					],
				],
			],
		],
		'typography' => [ // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'text_typography' => [
					'title'  => __( 'Ribbon Text', 'uabb' ),
					'fields' => [
						'text_tag_selection'    => [
							'type'     => 'select',
							'label'    => __( 'Tag', 'uabb' ),
							'default'  => 'h3',
							'sanitize' => [ 'FLBuilderUtils::esc_tags', 'h3' ],
							'options'  => [
								'h1'   => __( 'H1', 'uabb' ),
								'h2'   => __( 'H2', 'uabb' ),
								'h3'   => __( 'H3', 'uabb' ),
								'h4'   => __( 'H4', 'uabb' ),
								'h5'   => __( 'H5', 'uabb' ),
								'h6'   => __( 'H6', 'uabb' ),
								'div'  => __( 'Div', 'uabb' ),
								'p'    => __( 'p', 'uabb' ),
								'span' => __( 'span', 'uabb' ),
							],
						],
						'text_font_family'      => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-ribbon-text',
							],
						],
						'text_font_size_unit'   => [
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
								'selector' => '.uabb-ribbon-text',
								'property' => 'font-size',
								'unit'     => 'px',
							],
						],
						'text_line_height_unit' => [
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
								'selector' => '.uabb-ribbon-text',
								'property' => 'line-height',
								'unit'     => 'em',
							],
						],
						'text_color'            => [
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'text_shadow_color'     => [
							'type'       => 'color',
							'label'      => __( 'Text Shadow Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
					],
				],
			],
		],
	]
);
