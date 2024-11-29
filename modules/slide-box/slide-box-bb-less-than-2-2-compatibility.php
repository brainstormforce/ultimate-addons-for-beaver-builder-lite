<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.2.4 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Slide Box Module
 */

FLBuilder::register_module(
	'SlideBoxModule',
	[
		'slide_front' => [ // Tab.
			'title'    => __( 'Slide Box Front', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'title'           => [ // Section.
					'title'  => __( 'Slide Box Front', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'title_front' => [
							'type'        => 'text',
							'label'       => __( 'Title', 'uabb' ),
							'default'     => __( 'Slide Box Front', 'uabb' ),
							'preview'     => [
								'type'     => 'text',
								'selector' => '.uabb-slide-face-text-title',
							],
							'connections' => [ 'string', 'html' ],
						],
						'desc_front'  => [
							'type'          => 'editor',
							'media_buttons' => false,
							'rows'          => 10,
							'label'         => '',
							'default'       => __( 'Add description text here. Lorem Ipsum is a dummy content.', 'uabb' ),
							'connections'   => [ 'string', 'html' ],
						],
					],
				],
				'general'         => [ // Section.
					'title'  => __( 'Image / Icon', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'image_type' => [
							'type'    => 'select',
							'label'   => __( 'Image Type', 'uabb' ),
							'default' => 'icon',
							'options' => [
								'none'  => _x( 'None', 'Image type.', 'uabb' ),
								'photo' => __( 'Photo', 'uabb' ),
								'icon'  => __( 'Icon', 'uabb' ),
							],
							'toggle'  => [
								'none'  => [],
								'photo' => [
									'sections' => [ 'photo', 'img_icon_styles' ],
								],
								'icon'  => [
									'sections' => [ 'icon', 'img_icon_styles' ],
								],
							],
						],
					],
				],
				'icon'            => [
					'title'  => __( 'Icon', 'uabb' ),
					'fields' => [
						'icon'             => [
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'default'     => 'ua-icon ua-icon-head',
							'show_remove' => true,
						],
						'icon_color'       => [
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'icon_hover_color' => [
							'type'       => 'color',
							'label'      => __( 'Icon Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => [
								'type' => 'none',
							],
						],
						'icon_size'        => [
							'type'        => 'text',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '32',
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
						],
					],
				],
				'photo'           => [
					'title'  => __( 'Photo', 'uabb' ),
					'fields' => [
						'photo'            => [
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
							'connections' => [ 'photo' ],
						],
						'image_style'      => [
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
									'fields'   => [ 'img_bg_size', 'img_bg_color', 'img_bg_color_opc' ],
								],
							],
							'trigger' => [
								'custom' => [
									'fields' => [ 'img_border_style' ],
								],

							],
						],
						'img_size'         => [
							'type'        => 'text',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '60',
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
						],
						'img_bg_size'      => [
							'type'        => 'text',
							'label'       => __( 'Background Size', 'uabb' ),
							'help'        => __( 'Spacing between Image edge & Background edge', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '6',
							'description' => 'px',
						],
						'img_bg_color'     => [
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'img_bg_color_opc' => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],
					],
				],

				'img_icon_styles' => [ // Section.
					'title'  => __( 'Image / Icon Position', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'front_img_icon_position'       => [
							'type'    => 'select',
							'label'   => __( 'Position', 'uabb' ),
							'default' => 'above-title',
							'help'    => __( 'Image / Icon position', 'uabb' ),
							'options' => [
								'above-title' => __( 'Above Heading', 'uabb' ),
								'left-title'  => __( 'Left of Heading', 'uabb' ),
								'right-title' => __( 'Right of Heading', 'uabb' ),
								'left'        => __( 'Left of Text and Heading', 'uabb' ),
								'right'       => __( 'Right of Text and Heading', 'uabb' ),
							],
							'toggle'  => [
								'above-title' => [
									'fields' => [ 'front_alignment' ],
								],
								'left'        => [
									'fields' => [ 'front_align_items', 'front_icon_border', 'mobile_view' ],
								],
								'right'       => [
									'fields' => [ 'front_align_items', 'front_icon_border', 'mobile_view' ],
								],
							],
						],
						'front_alignment'               => [
							'type'    => 'select',
							'label'   => __( 'Overall Alignment', 'uabb' ),
							'default' => 'center',
							'options' => [
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							],
						],
						'front_align_items'             => [
							'type'    => 'select',
							'label'   => __( 'Icon Vertical Alignment', 'uabb' ),
							'default' => 'top',
							'options' => [
								'top'    => __( 'Top', 'uabb' ),
								'middle' => __( 'Center', 'uabb' ),
							],
						],
						'front_icon_border'             => [
							'type'    => 'select',
							'label'   => __( 'Border between Icon and Text', 'uabb' ),
							'default' => '',
							'options' => [
								'yes' => __( 'Yes', 'uabb' ),
								''    => __( 'No', 'uabb' ),
							],
							'toggle'  => [
								'yes' => [
									'fields' => [ 'front_icon_border_size', 'front_icon_border_color', 'front_icon_border_color_opc', 'front_icon_border_hover_color', 'front_icon_border_hover_color_opc' ],
								],
							],
						],
						'front_icon_border_size'        => [
							'type'        => 'text',
							'label'       => __( 'Border Thickness', 'uabb' ),
							'placeholder' => '1',
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
						],
						'front_icon_border_color'       => [
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'front_icon_border_color_opc'   => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],

						'front_icon_border_hover_color' => [
							'type'       => 'color',
							'label'      => __( 'Border Hover / Focus Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'front_icon_border_hover_color_opc' => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],
						'mobile_view'                   => [
							'type'    => 'select',
							'label'   => __( 'Mobile Structure', 'uabb' ),
							'default' => '',
							'options' => [
								''      => __( 'Inline', 'uabb' ),
								'stack' => __( 'Stack', 'uabb' ),
							],
						],
						'stacking_order'                => [
							'type'    => 'select',
							'label'   => __( 'Stacking Order', 'uabb' ),
							'default' => 'default',
							'options' => [
								'reversed' => __( 'Reversed', 'uabb' ),
								'default'  => __( 'Default', 'uabb' ),
							],
							'help'    => __( 'Use this option to show Icon / Image above title in small devices.', 'uabb' ),
						],
					],
				],
			],
		],
		'slide_down'  => [ // Tab.
			'title'    => __( 'Slide Box Back', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'title'           => [ // Section.
					'title'  => __( 'Slide Box Back', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'title_back' => [
							'type'    => 'text',
							'label'   => __( 'Title on Back', 'uabb' ),
							'default' => __( 'Slide Box Back', 'uabb' ),
							'help'    => 'Perhaps, this is the most highlighted text.',
							'preview' => [
								'type'     => 'text',
								'selector' => '.uabb-slide-back-text-title',
							],
						],
					],
				],
				'description'     => [ // Section.
					'title'  => '', // Section Title.
					'fields' => [ // Section Fields.
						'desc_back' => [
							'type'          => 'editor',
							'media_buttons' => false,
							'rows'          => 10,
							'label'         => __( 'Description', 'uabb' ),
							'default'       => __( '<ul><li>Enter description text here.</li><li>Enter description text here.</li></ul>', 'uabb' ), //phpcs:ignore WordPress.WP.I18n.NoHtmlWrappedStrings
						],
					],
				],
				'cta'             => [
					'title'  => __( 'Call to Action', 'uabb' ),
					'fields' => [
						'cta_type' => [
							'type'    => 'select',
							'label'   => __( 'Type', 'uabb' ),
							'default' => 'link',
							'options' => [
								'none'   => _x( 'None', 'Call to action.', 'uabb' ),
								'link'   => __( 'Text', 'uabb' ),
								'button' => __( 'Button', 'uabb' ),
							],
							'toggle'  => [
								'none'   => [],
								'link'   => [
									'sections' => [ 'cta_type_text', 'link_typography' ],
								],
								'button' => [
									'sections' => [ 'cta_type_button' ],
								],
							],
						],
					],
				],
				'cta_type_text'   => [ // Section.
					'title'  => __( 'Text', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'link'        => [
							'type'    => 'link',
							'label'   => __( 'Link', 'uabb' ),
							'help'    => __( 'The link applies to the entire module. If choosing a call to action type below, this link will also be used for the text or button.', 'uabb' ),
							'preview' => [
								'type' => 'none',
							],
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
						'cta_text'    => [
							'type'    => 'text',
							'label'   => __( 'Text', 'uabb' ),
							'default' => __( 'Read More', 'uabb' ),
						],
					],
				],
				'cta_type_button' => [ // Section.
					'title'  => __( 'Button', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'button' => [
							'type'         => 'form',
							'label'        => __( 'Button Settings', 'uabb' ),
							'form'         => 'button_form_field', // ID of a registered form.
							'preview_text' => 'text', // ID of a field to use for the preview text.
						],
					],
				],
			],
		],
		'style'       => [ // Tab.
			'title'    => __( 'Styles', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'general'              => [ // Section.
					'title'  => __( 'Description', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'slide_type' => [
							'type'    => 'select',
							'label'   => __( 'Select Style', 'uabb' ),
							'default' => 'style1',
							'help'    => __( 'Select Slide style for this slide box.', 'uabb' ),
							'options' => [
								'style1' => __( 'Style 1', 'uabb' ),
								'style2' => __( 'Style 2', 'uabb' ),
								'style3' => __( 'Style 3', 'uabb' ),
							],
							'toggle'  => [
								'style1' => [
									'sections' => [ 'overlay' ],
								],
								'style2' => [
									'fields'   => [ 'focused_front_title_color', 'focused_front_desc_color', 'dropdown_icon_bg_color', 'dropdown_icon_bg_color_opc', 'dropdown_icon_color' ],
									'sections' => [ 'dropdown_icon' ],
								],
								'style3' => [
									'fields'   => [ 'focused_front_title_color', 'focused_front_desc_color', 'dropdown_plus_icon_color' ],
									'sections' => [ 'dropdown_icon' ],
								],
							],
						],
					],
				],
				'front_styles'         => [ // Section.
					'title'  => __( 'Slide Box Front Style', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'front_padding_dimension'        => [

							'type'        => 'dimension',
							'label'       => __( 'Content Padding', 'uabb' ),
							'help'        => __( 'To apply padding to Slide Box Front use this setting', 'uabb' ),
							'description' => 'px',
							'responsive'  => [
								'placeholder' => [
									'default'    => '25',
									'medium'     => '',
									'responsive' => '',
								],
							],
						],
						'front_background_color'         => [
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => 'f6f6f6',
							'show_reset' => true,
							'preview'    => [
								'type'     => 'css',
								'selector' => '.uabb-slide-front',
								'property' => 'background',
							],
						],
						'front_background_color_opc'     => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],

						'focused_front_background_color' => [
							'type'       => 'color',
							'label'      => __( 'Background Hover/Focus Color', 'uabb' ),
							'default'    => 'e5e5e5',
							'show_reset' => true,
						],
						'focused_front_background_color_opc' => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],

					],
				],
				'back_styles'          => [ // Section.
					'title'  => __( 'Slide Box Back Style', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'back_padding_dimension'    => [
							'type'        => 'dimension',
							'label'       => __( 'Content Padding', 'uabb' ),
							'help'        => __( 'To apply padding to Slide Box Back use this setting', 'uabb' ),
							'description' => 'px',
							'responsive'  => [
								'placeholder' => [
									'default'    => '25',
									'medium'     => '',
									'responsive' => '',
								],
							],
						],
						'back_alignment'            => [
							'type'    => 'select',
							'label'   => __( 'Overall Alignment', 'uabb' ),
							'default' => 'left',
							'options' => [
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							],
							'preview' => [
								'type'     => 'css',
								'selector' => '.uabb-slide-down',
								'property' => 'text-align',
							],
						],
						'back_background_color'     => [
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'show_reset' => true,
							'default'    => 'f6f6f6',
							'preview'    => [
								'type'     => 'css',
								'selector' => '.uabb-slide-down',
								'property' => 'background',
							],
						],
						'back_background_color_opc' => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],

					],
				],
				'overlay'              => [ // Section.
					'title'  => __( 'Overlay', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'overlay'                   => [
							'type'    => 'select',
							'label'   => __( 'Enable Overlay', 'uabb' ),
							'default' => 'yes',
							'options' => [
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							],
							'toggle'  => [
								'no'  => [
									'fields' => [],
								],
								'yes' => [
									'fields' => [ 'overlay_color', 'overlay_color_opc', 'overlay_opacity', 'overlay_icon', 'overlay_icon_color', 'overlay_icon_bg_color', 'overlay_icon_bg_color_opc', 'overlay_icon_size' ],
								],
							],
						],
						'overlay_color'             => [
							'type'       => 'color',
							'label'      => __( 'Overlay Color', 'uabb' ),
							'default'    => '000000',
							'show_reset' => true,
						],
						'overlay_color_opc'         => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '50',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],

						'overlay_icon'              => [
							'type'        => 'icon',
							'default'     => 'fa fa-plus-square-o',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
						],
						'overlay_icon_color'        => [
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],

						'overlay_icon_bg_color'     => [
							'type'       => 'color',
							'label'      => __( 'Icon Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'overlay_icon_bg_color_opc' => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],

						'overlay_icon_size'         => [
							'type'        => 'text',
							'label'       => __( 'Icon Size', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						],
					],
				],
				'dropdown_icon'        => [ // Section.
					'title'  => __( 'Drop Down Icon', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'dropdown_icon_color'        => [
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'default'    => 'ffffff',
							'show_reset' => true,
						],
						'dropdown_plus_icon_color'   => [
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'dropdown_icon_bg_color'     => [
							'type'       => 'color',
							'label'      => __( 'Icon Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'dropdown_icon_bg_color_opc' => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],

						'dropdown_icon_size'         => [
							'type'        => 'text',
							'label'       => __( 'Icon Size', 'uabb' ),
							'placeholder' => '20',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						],
						'dropdown_icon_align'        => [
							'type'    => 'select',
							'label'   => __( 'Icon Alignment', 'uabb' ),
							'default' => 'center',
							'options' => [
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							],
						],
					],
				],
				'slide_box_min_height' => [ // Section.
					'title'  => __( 'Slide Box Min Height', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'set_min_height'       => [
							'type'    => 'select',
							'label'   => __( 'Minimum Height', 'uabb' ),
							'default' => 'default',
							'options' => [
								'default' => __( 'No', 'uabb' ),
								'custom'  => __( 'Yes', 'uabb' ),
							],
							'toggle'  => [
								'default' => [
									'fields' => [],
								],
								'custom'  => [
									'fields' => [ 'slide_min_height', 'slide_vertical_align' ],
								],
							],
						],
						'slide_min_height'     => [
							'type'        => 'text',
							'label'       => __( 'Enter Height', 'uabb' ),
							'description' => '',
							'size'        => '8',
							'help'        => __( 'Apply minimum height to complete SlideBox. It is useful when multiple SlideBox are in same row.', 'uabb' ),
						],
						'slide_vertical_align' => [
							'type'    => 'select',
							'label'   => __( 'Overall Vertical Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'If enabled, the Content would align vertically center', 'uabb' ),
							'options' => [
								'center'  => __( 'Center', 'uabb' ),
								'inherit' => __( 'Top', 'uabb' ),
							],
						],
					],
				],
			],
		],
		'typography'  => [ // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'front_title_typography' => [
					'title'  => __( 'Front Title', 'uabb' ),
					'fields' => [
						'front_title_tag_selection'    => [
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
						'front_title_font_family'      => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-slide-face-text-title',
							],
						],
						'front_title_font_size_unit'   => [
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-slide-face-text-title',
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
						'front_title_line_height_unit' => [
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-slide-face-text-title',
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
						'front_title_color'            => [
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'front_title_focused_color'    => [
							'type'       => 'color',
							'label'      => __( 'Hover/Focus Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'front_title_margin_top'       => [
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'size'        => '8',
							'description' => 'px',
						],
						'front_title_margin_bottom'    => [
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'size'        => '8',
							'description' => 'px',
						],
					],
				],
				'front_desc_typography'  => [
					'title'  => __( 'Front Description', 'uabb' ),
					'fields' => [
						'front_desc_font_family'      => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-slide-box-section-content',
							],
						],
						'front_desc_font_size_unit'   => [
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-slide-box-section-content',
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
						'front_desc_line_height_unit' => [
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-slide-box-section-content',
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
						'front_desc_color'            => [
							'type'       => 'color',
							'label'      => __( 'Description Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'front_desc_focused_color'    => [
							'type'       => 'color',
							'label'      => __( 'Hover/Focus Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'front_desc_margin_top'       => [
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'size'        => '8',
							'description' => 'px',
						],
						'front_desc_margin_bottom'    => [
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'size'        => '8',
							'description' => 'px',
						],
					],
				],
				'back_title_typography'  => [
					'title'  => __( 'Back Title', 'uabb' ),
					'fields' => [
						'back_title_tag_selection'    => [
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
						'back_title_font_family'      => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-slide-back-text-title',
							],
						],
						'back_title_font_size_unit'   => [
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-slide-back-text-title',
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
						'back_title_line_height_unit' => [
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-slide-back-text-title',
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
						'back_title_color'            => [
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => [
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-slide-back-text-title',
							],
						],
						'back_title_margin_top'       => [
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'size'        => '8',
							'description' => 'px',
						],
						'back_title_margin_bottom'    => [
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'size'        => '8',
							'description' => 'px',
						],
					],
				],
				'back_desc_typography'   => [
					'title'  => __( 'Back Description', 'uabb' ),
					'fields' => [
						'back_desc_font_family'      => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-slide-down-box-section-content',
							],
						],
						'back_desc_font_size_unit'   => [
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-slide-down-box-section-content',
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
						'back_desc_line_height_unit' => [
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-slide-down-box-section-content',
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
						'back_desc_color'            => [
							'type'       => 'color',
							'default'    => '',
							'show_reset' => true,
							'label'      => __( 'Description Color', 'uabb' ),
							'preview'    => [
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-slide-down-box-section-content',
							],
						],
						'back_desc_margin_top'       => [
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'size'        => '8',
							'description' => 'px',
						],
						'back_desc_margin_bottom'    => [
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'size'        => '8',
							'placeholder' => '10',
							'description' => 'px',
						],
					],
				],
				'link_typography'        => [
					'title'  => __( 'Link Text', 'uabb' ),
					'fields' => [
						'link_font_family'      => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-callout-cta-link',
							],
						],
						'link_font_size_unit'   => [
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-callout-cta-link',
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
						'link_line_height_unit' => [
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-callout-cta-link',
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
						'link_color'            => [
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
					],
				],
			],
		],
	]
);
