<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2
 * Applicable for BB version greater than 2.2 and UABB version 1.3.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
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
						'heading' => [
							'type'        => 'text',
							'label'       => __( 'Heading', 'uabb' ),
							'default'     => __( 'Design is a funny word', 'uabb' ),
							'preview'     => [
								'type'     => 'text',
								'selector' => '.uabb-heading-text',
							],
							'connections' => [ 'string', 'html' ],
						],
						'link'    => [
							'type'          => 'link',
							'label'         => __( 'Link', 'uabb' ),
							'preview'       => [
								'type' => 'none',
							],
							'connections'   => [ 'url' ],
							'show_target'   => true,
							'show_nofollow' => true,
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
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'This is the overall alignment and would apply to all Heading elements', 'uabb' ),
							'preview' => [
								'type'     => 'css',
								'selector' => '.uabb-heading-wrapper .uabb-heading, .uabb-heading-wrapper .uabb-subheading *',
								'property' => 'text-align',
							],
						],
						'r_custom_alignment' => [
							'type'    => 'align',
							'label'   => __( 'Responsive Alignment', 'uabb' ),
							'default' => 'center',
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
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '5',
							'size'        => '6',
							'units'       => [ 'px' ],
							'slider'      => true,
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-icon-wrap .uabb-icon i, .uabb-icon-wrap .uabb-icon i:before',
								'property' => 'font-size',
								'unit'     => 'px',
							],
						],
						'separator_icon_color' => [
							'type'        => 'color',
							'label'       => __( 'Icon Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'preview'     => [
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
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'maxlength'   => '5',
							'size'        => '6',
							'units'       => [ 'px' ],
							'slider'      => true,
							'placeholder' => '50',
						],
						'responsive_img_size' => [
							'type'      => 'unit',
							'label'     => __( 'Responsive Size', 'uabb' ),
							'maxlength' => '5',
							'size'      => '6',
							'units'     => [ 'px' ],
							'slider'    => true,
							'help'      => __( 'Image size below medium devices. Leave it blank if you want to keep same size', 'uabb' ),
							'preview'   => [
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
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-separator, .uabb-separator-line > span',
								'property' => 'border-top-color',
							],
						],
						'separator_line_height' => [
							'type'        => 'unit',
							'label'       => __( 'Thickness', 'uabb' ),
							'placeholder' => '1',
							'maxlength'   => '2',
							'size'        => '3',
							'units'       => [ 'px' ],
							'slider'      => true,
							'help'        => __( 'Thickness of Border', 'uabb' ),
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-separator, .uabb-separator-line > span',
								'property' => 'border-top-width',
								'unit'     => 'px',
							],
						],
						'separator_line_width'  => [
							'type'        => 'unit',
							'label'       => __( 'Width', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '3',
							'size'        => '5',
							'units'       => [ '%' ],
							'slider'      => true,
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
						'font_typo'             => [
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => [
								'type'      => 'css',
								'selector'  => '.uabb-heading .uabb-heading-text, .uabb-heading *, .uabb-heading-text',
								'important' => true,
							],
						],
						'color'                 => [
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'preview'     => [
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.fl-module-content.fl-node-content .uabb-heading  .uabb-heading-text',
							],
						],
						'heading_margin_top'    => [
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'units'       => [ 'px' ],
							'slider'      => true,
							'preview'     => [
								'type'     => 'css',
								'property' => 'margin-top',
								'selector' => '.uabb-heading',
								'unit'     => 'px',
							],
						],
						'heading_margin_bottom' => [
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'size'        => '5',
							'units'       => [ 'px' ],
							'slider'      => true,
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
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'preview'     => [
								'type'     => 'css',
								'property' => 'background',
								'selector' => '.fl-module-content.fl-node-content .uabb-heading  .uabb-heading-text',
							],
						],
						'heading_padding'       => [
							'type'       => 'dimension',
							'label'      => __( 'Padding', 'uabb' ),
							'slider'     => true,
							'responsive' => true,
							'units'      => [ 'px' ],
							'preview'    => [
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
						'desc_font_typo'     => [
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => [
								'type'      => 'css',
								'selector'  => '.uabb-text-editor',
								'important' => true,
							],
						],
						'desc_color'         => [
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'preview'     => [
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.fl-module-content.fl-node-content .uabb-subheading, .fl-module-content.fl-node-content .uabb-subheading *',
							],
						],
						'desc_margin_top'    => [
							'type'        => 'unit',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '15',
							'size'        => '5',
							'units'       => [ 'px' ],
							'slider'      => true,
							'preview'     => [
								'type'     => 'css',
								'property' => 'margin-top',
								'selector' => '.uabb-subheading',
								'unit'     => 'px',
							],
						],
						'desc_margin_bottom' => [
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '0',
							'size'        => '5',
							'units'       => [ 'px' ],
							'slider'      => true,
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
						'separator_text_tag_selection' => [
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
						'separator_font_typo'          => [
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => [
								'type'      => 'css',
								'selector'  => '.uabb-divider-text',
								'important' => true,
							],
						],
						'separator_text_color'         => [
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'preview'     => [
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
