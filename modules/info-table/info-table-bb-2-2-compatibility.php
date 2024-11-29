<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.3.0 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Info Table Module
 */

FLBuilder::register_module(
	'UABBInfoTableModule',
	[
		'general'       => [
			'title'    => __( 'General', 'uabb' ),
			'sections' => [
				'title-section' => [
					'title'  => __( 'Info-Table', 'uabb' ),
					'fields' => [
						'it_title'     => [
							'type'        => 'text',
							'label'       => __( 'Heading', 'uabb' ),
							'default'     => __( 'Heading', 'uabb' ),
							'help'        => __( 'Enter Info-Table Title', 'uabb' ),
							'connections' => [ 'string', 'html' ],
						],
						'sub_heading'  => [
							'type'        => 'text',
							'label'       => __( 'Sub Heading', 'uabb' ),
							'default'     => __( 'Sub Heading', 'uabb' ),
							'connections' => [ 'string', 'html' ],
						],
						'it_long_desc' => [
							'type'        => 'editor',
							'label'       => '',
							'default'     => __( 'Enter description text here.', 'uabb' ),
							'connections' => [ 'string', 'html' ],
						],
						'it_link_type' => [
							'type'    => 'select',
							'label'   => __( 'Add Link', 'uabb' ),
							'default' => 'no',
							'options' => [
								'no'            => __( 'No Link', 'uabb' ),
								'cta'           => __( 'Call to Action Button', 'uabb' ),
								'complete_link' => __( 'Link to Complete Box', 'uabb' ),
							],
							'toggle'  => [
								'cta'           => [
									'sections' => [ 'btn-style-section', 'btn_typography' ],
									'fields'   => [ 'button_text', 'it_link', 'it_link_target' ],
								],
								'complete_link' => [
									'fields' => [ 'it_link', 'it_link_target' ],
								],
							],
						],
						'button_text'  => [
							'type'        => 'text',
							'label'       => __( 'Call to action button text', 'uabb' ),
							'connections' => [ 'string', 'html' ],
						],
						'it_link'      => [
							'type'          => 'link',
							'label'         => __( 'Select URL', 'uabb' ),
							'connections'   => [ 'url' ],
							'show_target'   => true,
							'show_nofollow' => true,
						],
					],
				],
			],
		],
		'style'         => [
			'title'    => __( 'Style', 'uabb' ),
			'sections' => [
				'style-section'     => [
					'title'  => __( 'Styles', 'uabb' ),
					'fields' => [
						'box_design'             => [
							'type'    => 'select',
							'label'   => __( 'Select Design Style', 'uabb' ),
							'default' => 'design01',
							'options' => [
								'design01' => __( 'Design 01', 'uabb' ),
								'design02' => __( 'Design 02', 'uabb' ),
								'design03' => __( 'Design 03', 'uabb' ),
								'design04' => __( 'Design 04', 'uabb' ),
								'design05' => __( 'Design 05', 'uabb' ),
								'design06' => __( 'Design 06', 'uabb' ),
							],
							'toggle'  => [
								'design01' => [
									'fields' => [ 'btn_radius', 'btn_top_margin', 'btn_bottom_margin' ],
								],
								'design03' => [
									'fields' => [ 'btn_radius', 'btn_top_margin', 'btn_bottom_margin' ],
								],
								'design04' => [
									'fields' => [ 'btn_radius', 'btn_top_margin', 'btn_bottom_margin' ],
								],
								'design05' => [
									'fields' => [ 'btn_radius', 'btn_top_margin', 'btn_bottom_margin' ],
								],
								'design06' => [
									'fields' => [ 'btn_radius', 'btn_top_margin', 'btn_bottom_margin' ],
								],
							],
						],
						'color_scheme'           => [
							'type'    => 'select',
							'label'   => __( 'Select Color Scheme', 'uabb' ),
							'default' => 'black',
							'options' => [
								'black'  => __( 'Black', 'uabb' ),
								'red'    => __( 'Red', 'uabb' ),
								'blue'   => __( 'Blue', 'uabb' ),
								'yellow' => __( 'Yellow', 'uabb' ),
								'green'  => __( 'Green', 'uabb' ),
								'gray'   => __( 'Gray', 'uabb' ),
								'custom' => __( 'Design Your Own', 'uabb' ),
							],
							'toggle'  => [
								'custom' => [
									'fields' => [ 'desc_back_color', 'desc_back_color_opc' ],
								],
							],
						],
						'heading_back_color'     => [
							'type'        => 'color',
							'label'       => __( 'Main background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
						'heading_back_color_opc' => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],

						'desc_back_color'        => [
							'type'        => 'color',
							'label'       => __( 'Highlight background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
						'desc_back_color_opc'    => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],

						'hover_effect'           => [
							'type'    => 'select',
							'label'   => __( 'Hover Effect', 'uabb' ),
							'default' => 'shadow',
							'options' => [
								'none'   => __( 'None', 'uabb' ),
								'shadow' => __( 'Box Shadow', 'uabb' ),
							],
						],
						'min_height'             => [
							'type'      => 'unit',
							'label'     => __( 'Min Height', 'uabb' ),
							'maxlength' => '5',
							'size'      => '6',
							'slider'    => true,
							'units'     => [ 'px' ],
						],
					],
				],
				'btn-style-section' => [
					'title'  => __( 'CTA Button Style', 'uabb' ),
					'fields' => [

						'btn_text_color'         => [
							'type'        => 'color',
							'label'       => __( 'Text Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
						'btn_text_hover_color'   => [
							'type'        => 'color',
							'label'       => __( 'Text Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
							'preview'     => [
								'type' => 'none',
							],
						],
						'btn_bg_color'           => [
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
						'btn_bg_color_opc'       => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],

						'btn_bg_hover_color'     => [
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
						'btn_bg_hover_color_opc' => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],
						'btn_radius'             => [
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'default'     => '',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '3',
							'slider'      => true,
							'units'       => [ 'px' ],
						],
						'btn_top_margin'         => [
							'type'        => 'unit',
							'label'       => __( 'Top Margin', 'uabb' ),
							'default'     => '',
							'maxlength'   => '4',
							'size'        => '6',
							'slider'      => true,
							'units'       => [ 'px' ],
							'placeholder' => '15',
						],
						'btn_bottom_margin'      => [
							'type'        => 'unit',
							'label'       => __( 'Bottom Margin', 'uabb' ),
							'default'     => '',
							'maxlength'   => '4',
							'size'        => '6',
							'slider'      => true,
							'units'       => [ 'px' ],
							'placeholder' => '15',
						],
					],
				],
			],
		],

		'it_image_icon' => [
			'title'    => __( 'Image / Icon', 'uabb' ),
			'sections' => [
				'type_general' => [ // Section.
					'title'  => __( 'Image / Icon', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'image_type' => [
							'type'    => 'select',
							'label'   => __( 'Image Type', 'uabb' ),
							'default' => 'icon',
							'options' => [
								'none'  => __( 'None', 'uabb' ),
								'icon'  => __( 'Icon', 'uabb' ),
								'photo' => __( 'Photo', 'uabb' ),
							],
							'class'   => 'class_image_type',
							'toggle'  => [
								'icon'  => [
									'sections' => [ 'icon_basic', 'icon_style', 'icon_colors' ],
								],
								'photo' => [
									'sections' => [ 'img_basic', 'img_style' ],
								],
							],
						],
					],
				],
				'icon_basic'   => [ // Section.
					'title'  => __( 'Icon Basics', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'icon'      => [
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
							'default'     => 'fa fa-child',
						],
						'icon_size' => [
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'maxlength'   => '5',
							'size'        => '6',
							'slider'      => true,
							'units'       => [ 'px' ],
							'placeholder' => '75',
							'preview'     => [
								'type' => 'refresh',
							],
						],
					],
				],

				/* Image Basic Setting */
				'img_basic'    => [ // Section.
					'title'  => __( 'Image Basics', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'photo_source' => [
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
						'photo'        => [
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
							'connections' => [ 'photo' ],
						],
						'photo_url'    => [
							'type'        => 'text',
							'label'       => __( 'Photo URL', 'uabb' ),
							'placeholder' => 'http://www.example.com/my-photo.jpg',
						],
						'img_size'     => [
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'maxlength'   => '5',
							'size'        => '6',
							'slider'      => true,
							'units'       => [ 'px' ],
							'placeholder' => '150',
							'preview'     => [
								'type' => 'refresh',
							],
						],
						'img_align'    => [
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'options' => [
								'left'    => __( 'Left', 'uabb' ),
								'center'  => __( 'Center', 'uabb' ),
								'right'   => __( 'Right', 'uabb' ),
								'inherit' => __( 'Default', 'uabb' ),
							],
							'default' => 'inherit',
						],
					],
				],
				'icon_style'   => [
					'title'  => __( 'Style', 'uabb' ),
					'fields' => [
						/* Icon Style */
						'icon_style'            => [
							'type'    => 'select',
							'label'   => __( 'Icon Background Style', 'uabb' ),
							'default' => 'simple',
							'options' => [
								'simple' => __( 'Simple', 'uabb' ),
								'circle' => __( 'Circle Background', 'uabb' ),
								'square' => __( 'Square Background', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							],
							'toggle'  => [
								'simple' => [
									'fields' => [],
								],
								'circle' => [
									'fields' => [ 'icon_color_preset', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d' ],
								],
								'square' => [
									'fields' => [ 'icon_color_preset', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d' ],
								],
								'custom' => [
									'fields' => [ 'icon_color_preset', 'icon_border_style', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d', 'icon_bg_size', 'icon_bg_border_radius' ],
								],
							],
							'trigger' => [
								'custom' => [
									'fields' => [ 'icon_border_style' ],
								],
							],
						],

						/* Icon Background SIze */
						'icon_bg_size'          => [
							'type'        => 'unit',
							'label'       => __( 'Background Size', 'uabb' ),
							'help'        => __( 'Spacing between Icon & Background edge', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '3',
							'size'        => '6',
							'slider'      => true,
							'units'       => [ 'px' ],
						],

						/* Border Style and Radius for Icon */
						'icon_border_style'     => [
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => [
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							],
							'toggle'  => [
								'solid'  => [
									'fields' => [ 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ],
								],
								'dashed' => [
									'fields' => [ 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ],
								],
								'dotted' => [
									'fields' => [ 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ],
								],
								'double' => [
									'fields' => [ 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ],
								],
							],
						],
						'icon_border_width'     => [
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'slider'      => true,
							'units'       => [ 'px' ],
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
							'preview'     => [
								'type' => 'refresh',
							],
						],
						'icon_bg_border_radius' => [
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'slider'      => true,
							'units'       => [ 'px' ],
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '20',
						],
					],
				],
				'img_style'    => [
					'title'  => __( 'Style', 'uabb' ),
					'fields' => [
						/* Image Style */
						'image_style'          => [
							'type'    => 'select',
							'label'   => __( 'Image Style', 'uabb' ),
							'default' => 'simple',
							'help'    => __( 'Circle and Square style will crop your image in 1:1 ratio', 'uabb' ),
							'options' => [
								'simple' => __( 'Simple', 'uabb' ),
								'circle' => __( 'Circle', 'uabb' ),
								'square' => __( 'Square', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							],
							'class'   => 'uabb-image-icon-style',
							'toggle'  => [
								'simple' => [
									'fields' => [],
								],
								'circle' => [
									'fields' => [],
								],
								'square' => [
									'fields' => [],
								],
								'custom' => [
									'sections' => [ 'img_colors' ],
									'fields'   => [ 'img_bg_size', 'img_border_style', 'img_border_width', 'img_bg_border_radius' ],
								],
							],
							'trigger' => [
								'custom' => [
									'fields' => [ 'img_border_style' ],
								],

							],
						],

						/* Image Background Size */
						'img_bg_size'          => [
							'type'      => 'unit',
							'label'     => __( 'Background Size', 'uabb' ),
							'help'      => __( 'Spacing between Image edge & Background edge', 'uabb' ),
							'maxlength' => '3',
							'size'      => '6',
							'slider'    => true,
							'units'     => [ 'px' ],
							'preview'   => [
								'type' => 'refresh',
							],
						],

						/* Border Style and Radius for Image */
						'img_border_style'     => [
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => [
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							],
							'toggle'  => [
								'solid'  => [
									'fields' => [ 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ],
								],
								'dashed' => [
									'fields' => [ 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ],
								],
								'dotted' => [
									'fields' => [ 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ],
								],
								'double' => [
									'fields' => [ 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ],
								],
							],
						],
						'img_border_width'     => [
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'slider'      => true,
							'units'       => [ 'px' ],
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
							'preview'     => [
								'type' => 'refresh',
							],
						],
						'img_bg_border_radius' => [
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'slider'      => true,
							'units'       => [ 'px' ],
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '0',
						],
					],
				],
				'icon_colors'  => [ // Section.
					'title'  => __( 'Colors', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.

						/* Style Options */
						'icon_color_preset'       => [
							'type'    => 'select',
							'label'   => __( 'Icon Color Presets', 'uabb' ),
							'default' => 'preset1',
							'options' => [
								'preset1' => __( 'Preset 1', 'uabb' ),
								'preset2' => __( 'Preset 2', 'uabb' ),
							],
							'help'    => __( 'Preset 1 => Icon : White, Background : Theme </br>Preset 2 => Icon : Theme, Background : #f3f3f3', 'uabb' ),
						],
						/* Icon Color */
						'icon_color'              => [
							'type'        => 'color',
							'label'       => __( 'Icon Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
						'icon_hover_color'        => [
							'type'        => 'color',
							'label'       => __( 'Icon Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
							'preview'     => [
								'type' => 'none',
							],
						],

						/* Background Color Dependent on Icon Style */
						'icon_bg_color'           => [
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
						'icon_bg_color_opc'       => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],
						'icon_bg_hover_color'     => [
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'preview'     => [
								'type' => 'none',
							],
						],
						'icon_bg_hover_color_opc' => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],

						/* Border Color Dependent on Border Style for ICon */
						'icon_border_color'       => [
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
						'icon_border_hover_color' => [
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],

						/* Gradient Color Option */
						'icon_three_d'            => [
							'type'    => 'select',
							'label'   => __( 'Gradient', 'uabb' ),
							'default' => '0',
							'options' => [
								'0' => __( 'No', 'uabb' ),
								'1' => __( 'Yes', 'uabb' ),
							],
						],
					],
				],
				'img_colors'   => [ // Section.
					'title'  => __( 'Colors', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						/* Background Color Dependent on Icon Style */
						'img_bg_color'           => [
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
						'img_bg_color_opc'       => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],
						'img_bg_hover_color'     => [
							'type'        => 'color',
							'label'       => __( 'Background Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
							'preview'     => [
								'type' => 'none',
							],
						],
						'img_bg_hover_color_opc' => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],

						/* Border Color Dependent on Border Style for Image */
						'img_border_color'       => [
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
						'img_border_hover_color' => [
							'type'        => 'color',
							'label'       => __( 'Border Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
					],
				],
			],
		],
		'typography'    => [
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => [
				'heading_typography'     => [
					'title'  => __( 'Heading', 'uabb' ),
					'fields' => [
						'heading_tag_selection' => [
							'type'     => 'select',
							'label'    => __( 'Select Tag', 'uabb' ),
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
						'heading_font_typo'     => [
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => [
								'type'      => 'css',
								'selector'  => '.info-table-main-heading',
								'important' => true,
							],
						],
						'heading_color'         => [
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
					],
				],
				'sub_heading_typography' => [
					'title'  => __( 'Sub Heading', 'uabb' ),
					'fields' => [
						'sub_heading_tag_selection' => [
							'type'     => 'select',
							'label'    => __( 'Select Tag', 'uabb' ),
							'default'  => 'h5',
							'sanitize' => [ 'FLBuilderUtils::esc_tags', 'h5' ],
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
						'sub_heading_font_typo'     => [
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => [
								'type'      => 'css',
								'selector'  => '.info-table-sub-heading',
								'important' => true,
							],
						],
						'sub_heading_color'         => [
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
					],
				],
				'description_typography' => [
					'title'  => __( 'Description', 'uabb' ),
					'fields' => [
						'description_font_typo' => [
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => [
								'type'      => 'css',
								'selector'  => '.info-table-description *',
								'important' => true,
							],
						],
						'description_color'     => [
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => [ 'color' ],
						],
					],
				],
				'btn_typography'         => [
					'title'  => __( 'Button', 'uabb' ),
					'fields' => [
						'btn_font_typo' => [
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => [
								'type'      => 'css',
								'selector'  => '.info-table-button a',
								'important' => true,
							],
						],
					],
				],
			],
		],
	]
);
