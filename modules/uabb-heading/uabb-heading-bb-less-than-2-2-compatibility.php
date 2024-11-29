<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.2.4 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Heading Module
 */

FLBuilder::register_module(
	'UABBHeadingModule',
	[
		'general'    => [
			'title'    => __( 'General', 'uabb' ),
			'sections' => [
				'general'     => [
					'title'  => '',
					'fields' => [
						'heading'     => [
							'type'        => 'text',
							'label'       => __( 'Heading', 'uabb' ),
							'default'     => __( 'Design is a funny word', 'uabb' ),
							'preview'     => [
								'type'     => 'text',
								'selector' => '.uabb-heading-text',
							],
							'connections' => [ 'string', 'html' ],
						],
						'link'        => [
							'type'        => 'link',
							'label'       => __( 'Link', 'uabb' ),
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
				'description' => [
					'title'  => __( 'Description', 'uabb' ),
					'fields' => [
						'description' => [
							'type'        => 'editor',
							'label'       => '',
							'rows'        => 7,
							'default'     => '',
							'connections' => [ 'string', 'html' ],
						],
					],
				],
				'structure'   => [
					'title'  => __( 'Structure', 'uabb' ),
					'fields' => [
						'alignment'          => [
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'options' => [
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							],
							'help'    => __( 'This is the overall alignment and would apply to all Heading elements', 'uabb' ),
							'preview' => [
								'type'     => 'css',
								'selector' => '.uabb-heading-wrapper .uabb-heading, .uabb-heading-wrapper .uabb-subheading *',
								'property' => 'text-align',
							],
						],
						'r_custom_alignment' => [
							'type'    => 'select',
							'label'   => __( 'Responsive Alignment', 'uabb' ),
							'default' => 'center',
							'options' => [
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							],
							'preview' => [
								'type' => 'none',
							],
							'help'    => __( 'The alignment will apply on Mobile', 'uabb' ),
						],
					],
				],
			],
		],
		'style'      => [
			'title'    => __( 'Separator', 'uabb' ),
			'sections' => [
				'separator'            => [
					'title'  => __( 'Separator', 'uabb' ),
					'fields' => [
						'separator_style'    => [
							'type'    => 'select',
							'label'   => __( 'Separator Style', 'uabb' ),
							'default' => 'none',
							'options' => [
								'none'       => __( 'None', 'uabb' ),
								'line'       => __( 'Line', 'uabb' ),
								'line_icon'  => __( 'Line With Icon', 'uabb' ),
								'line_image' => __( 'Line With Image', 'uabb' ),
								'line_text'  => __( 'Line With Text', 'uabb' ),
							],
							'toggle'  => [
								'line'       => [
									'sections' => [ 'separator_line' ],
									'fields'   => [ 'separator_position' ],
								],
								'line_icon'  => [
									'sections' => [ 'separator_line', 'separator_icon_basic' ],
									'fields'   => [ 'separator_position' ],
								],
								'line_image' => [
									'sections' => [ 'separator_line', 'separator_img_basic' ],
									'fields'   => [ 'separator_position' ],
								],
								'line_text'  => [
									'sections' => [ 'separator_line', 'separator_text', 'separator_text_typography' ],
									'fields'   => [ 'separator_position' ],
								],
							],
						],
						'separator_position' => [
							'type'    => 'select',
							'label'   => __( 'Separator Position', 'uabb' ),
							'default' => 'center',
							'options' => [
								'center' => __( 'Between Heading & Description', 'uabb' ),
								'top'    => __( 'Top', 'uabb' ),
								'bottom' => __( 'Bottom', 'uabb' ),
							],
						],
					],
				],
				'separator_icon_basic' => [
					'title'  => __( 'Icon Basics', 'uabb' ),
					'fields' => [
						'icon'                 => [
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
						],
						'icon_size'            => [
							'type'        => 'text',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-icon-wrap .uabb-icon i, .uabb-icon-wrap .uabb-icon i:before',
								'property' => 'font-size',
								'unit'     => 'px',
							],
						],
						'separator_icon_color' => [
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => [
								'type'     => 'css',
								'selector' => '.uabb-icon-wrap .uabb-icon i, .uabb-icon-wrap .uabb-icon i:before',
								'property' => 'color',
							],
						],
					],
				],
				'separator_img_basic'  => [
					'title'  => __( 'Image Basics', 'uabb' ),
					'fields' => [
						'photo_source'        => [
							'type'    => 'select',
							'label'   => __( 'Photo Source', 'uabb' ),
							'default' => 'library',
							'options' => [
								'library' => __( 'Media Library', 'uabb' ),
								'url'     => __( 'URL', 'uabb' ),
							],
							'toggle'  => [
								'library' => [
									'fields' => [ 'photo' ],
								],
								'url'     => [
									'fields' => [ 'photo_url' ],
								],
							],
						],
						'photo'               => [
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
							'connections' => [ 'photo' ],
						],
						'photo_url'           => [
							'type'        => 'text',
							'label'       => __( 'Photo URL', 'uabb' ),
							'placeholder' => 'http://www.example.com/my-photo.jpg',
						],
						'img_size'            => [
							'type'        => 'text',
							'label'       => __( 'Size', 'uabb' ),
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
							'placeholder' => '50',
						],
						'responsive_img_size' => [
							'type'        => 'text',
							'label'       => __( 'Responsive Size', 'uabb' ),
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
							'help'        => __( 'Image size below medium devices. Leave it blank if you want to keep same size', 'uabb' ),
							'preview'     => [
								'type' => 'none',
							],
						],
					],
				],
				'separator_text'       => [
					'title'  => __( 'Text', 'uabb' ),
					'fields' => [
						'text_inline'              => [
							'type'    => 'text',
							'label'   => __( 'Text', 'uabb' ),
							'default' => 'Ultimate',
							'preview' => [
								'type'     => 'text',
								'selector' => '.uabb-divider-text',
							],
						],
						'responsive_compatibility' => [
							'type'    => 'select',
							'label'   => __( 'Responsive Compatibility', 'uabb' ),
							'help'    => __( 'There might be responsive issues for long texts. If you are facing such issues then select appropriate devices width to make your module responsive.', 'uabb' ),
							'default' => '',
							'options' => [
								''                         => __( 'None', 'uabb' ),
								'uabb-responsive-mobile'   => __( 'Small Devices', 'uabb' ),
								'uabb-responsive-medsmall' => __( 'Medium & Small Devices', 'uabb' ),
							],
						],
					],
				],
				'separator_line'       => [
					'title'  => __( 'Line Style', 'uabb' ),
					'fields' => [
						'separator_line_style'  => [
							'type'    => 'select',
							'label'   => __( 'Style', 'uabb' ),
							'default' => 'solid',
							'options' => [
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							],
							'help'    => __( 'The type of border to use. Double borders must have a height of at least 3px to render properly.', 'uabb' ),
							'preview' => [
								'type'     => 'css',
								'selector' => '.uabb-separator, .uabb-separator-line > span',
								'property' => 'border-top-style',
							],
						],
						'separator_line_color'  => [
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => [
								'type'     => 'css',
								'selector' => '.uabb-separator, .uabb-separator-line > span',
								'property' => 'border-top-color',
							],
						],
						'separator_line_height' => [
							'type'        => 'text',
							'label'       => __( 'Thickness', 'uabb' ),
							'placeholder' => '1',
							'maxlength'   => '2',
							'size'        => '3',
							'description' => 'px',
							'help'        => __( 'Thickness of Border', 'uabb' ),
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-separator, .uabb-separator-line > span',
								'property' => 'border-top-width',
								'unit'     => 'px',
							],
						],
						'separator_line_width'  => [
							'type'        => 'text',
							'label'       => __( 'Width', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '3',
							'size'        => '5',
							'description' => '%',
						],
					],
				],
			],
		],
		'typography' => [
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => [
				'heading_typo'              => [
					'title'  => __( 'Heading', 'uabb' ),
					'fields' => [
						'tag'                   => [
							'type'     => 'select',
							'label'    => __( 'HTML Tag', 'uabb' ),
							'default'  => 'h3',
							'sanitize' => [ 'FLBuilderUtils::esc_tags', 'h3' ],
							'options'  => [
								'h1' => 'h1',
								'h2' => 'h2',
								'h3' => 'h3',
								'h4' => 'h4',
								'h5' => 'h5',
								'h6' => 'h6',
							],
						],
						'font'                  => [
							'type'    => 'font',
							'default' => [
								'family' => 'Default',
								'weight' => 300,
							],
							'label'   => __( 'Font', 'uabb' ),
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-heading .uabb-heading-text',
							],
						],
						'new_font_size_unit'    => [
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-heading .uabb-heading-text',
								'property' => 'font-size',
								'unit'     => 'px',
							],
							'responsive'  => [
								'placeholder' => [
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								],
							],
						],
						'line_height_unit'      => [
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-heading .uabb-heading-text',
								'property' => 'line-height',
								'unit'     => 'em',
							],
							'responsive'  => [
								'placeholder' => [
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								],
							],
						],
						'color'                 => [
							'type'       => 'color',
							'label'      => __( 'Text Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => [
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.fl-module-content.fl-node-content .uabb-heading  .uabb-heading-text',
							],
						],
						'heading_margin_top'    => [
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'property' => 'margin-top',
								'selector' => '.uabb-heading',
								'unit'     => 'px',
							],
						],
						'heading_margin_bottom' => [
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'size'        => '5',
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-heading',
								'unit'     => 'px',
							],
						],
						'bg_color'              => [
							'type'        => 'color',
							'connections' => [ 'color' ],
							'label'       => __( 'Heading Background Color', 'uabb' ),
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => [
								'type'     => 'css',
								'property' => 'background',
								'selector' => '.fl-module-content.fl-node-content .uabb-heading  .uabb-heading-text',
							],
						],
						'heading_padding'       => [
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'description' => 'px',
							'responsive'  => [
								'placeholder' => [
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								],
							],
							'preview'     => [
								'type'      => 'css',
								'selector'  => '.fl-module-content.fl-node-content .uabb-heading  .uabb-heading-text',
								'property'  => 'padding',
								'unit'      => 'px',
								'important' => true,
							],
						],
					],
				],
				'description_typo'          => [
					'title'  => __( 'Description', 'uabb' ),
					'fields' => [
						'desc_font_family'      => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-subheading, .uabb-subheading *',
							],
						],
						'desc_font_size_unit'   => [
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'property' => 'font-size',
								'selector' => '.uabb-subheading, .uabb-subheading *',
								'unit'     => 'px',
							],
							'responsive'  => [
								'placeholder' => [
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								],
							],
						],
						'desc_line_height_unit' => [
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => [
								'type'     => 'css',
								'property' => 'line-height',
								'selector' => '.uabb-subheading, .uabb-subheading *',
								'unit'     => 'em',
							],
							'responsive'  => [
								'placeholder' => [
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								],
							],
						],
						'desc_color'            => [
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => [
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.fl-module-content.fl-node-content .uabb-subheading, .fl-module-content.fl-node-content .uabb-subheading *',
							],
						],
						'desc_margin_top'       => [
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '15',
							'size'        => '5',
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'property' => 'margin-top',
								'selector' => '.uabb-subheading',
								'unit'     => 'px',
							],
						],
						'desc_margin_bottom'    => [
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'property' => 'margin-bottom',
								'selector' => '.uabb-subheading',
								'unit'     => 'px',
							],
						],
					],
				],
				'separator_text_typography' => [
					'title'  => __( 'Separator Text Typography', 'uabb' ),
					'fields' => [
						'separator_text_tag_selection'    => [
							'type'     => 'select',
							'label'    => __( 'Text Tag', 'uabb' ),
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
						'separator_text_font_family'      => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-divider-text',
							],
						],
						'separator_text_font_size_unit'   => [
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'property' => 'font-size',
								'selector' => '.uabb-divider-text',
								'unit'     => 'px',
							],
							'responsive'  => [
								'placeholder' => [
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								],
							],
						],
						'separator_text_line_height_unit' => [
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => [
								'type'     => 'css',
								'property' => 'line-height',
								'selector' => '.uabb-divider-text',
								'unit'     => 'em',
							],
							'responsive'  => [
								'placeholder' => [
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								],
							],
						],
						'separator_text_color'            => [
							'type'       => 'color',
							'label'      => __( 'Text Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => [
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-divider-text',
							],
						],
					],
				],
			],
		],
	]
);
