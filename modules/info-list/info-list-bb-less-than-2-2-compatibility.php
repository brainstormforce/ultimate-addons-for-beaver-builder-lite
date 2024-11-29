<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.2.4 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Info List Module
 */

FLBuilder::register_module(
	'UABBInfoList',
	[
		'info_list_item'    => [ // Tab.
			'title'    => __( 'List Item', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'info_list_general' => [ // Section.
					'title'  => '', // Section Title.
					'fields' => [ // Section Fields.
						'add_list_item' => [
							'type'         => 'form',
							'label'        => __( 'List Item', 'uabb' ),
							'form'         => 'info_list_item_form',
							'preview_text' => 'list_item_title',
							'multiple'     => true,
						],
					],
				],
			],
		],

		'info_list_general' => [ // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'info_list_general'   => [ // Section.
					'title'  => __( 'List Settings', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'icon_position'              => [
							'type'    => 'select',
							'label'   => __( 'Icon / Image Position', 'uabb' ),
							'default' => 'left',
							'options' => [
								'left'  => __( 'Icon to the left', 'uabb' ),
								'right' => __( 'Icon to the right', 'uabb' ),
								'top'   => __( 'Icon at top', 'uabb' ),
							],
							'toggle'  => [
								'left'  => [
									'fields' => [ 'align_items', 'mobile_view' ],
								],
								'right' => [
									'fields' => [ 'align_items', 'mobile_view' ],
								],
							],
						],
						'align_items'                => [
							'type'    => 'select',
							'label'   => __( 'Icon Vertical Alignment', 'uabb' ),
							'default' => 'top',
							'options' => [
								'center' => __( 'Center', 'uabb' ),
								'top'    => __( 'Top', 'uabb' ),
							],
						],
						'mobile_view'                => [
							'type'    => 'select',
							'label'   => __( 'Mobile Structure', 'uabb' ),
							'default' => '',
							'options' => [
								''      => __( 'Inline', 'uabb' ),
								'stack' => __( 'Stack', 'uabb' ),
							],
							'preview' => [
								'type' => 'none',
							],
						],
						'icon_image_size'            => [
							'type'        => 'text',
							'label'       => __( 'Icon / Image Size', 'uabb' ),
							'description' => 'px',
							'size'        => '8',
							'placeholder' => '75',
						],
						'space_between_elements'     => [
							'type'        => 'text',
							'label'       => __( 'Space Between Two Elements', 'uabb' ),
							'description' => 'px',
							'size'        => '8',
							'placeholder' => '20',
						],
						'list_icon_style'            => [
							'type'        => 'select',
							'label'       => __( 'Icon / Image Style', 'uabb' ),
							'default'     => 'simple',
							'description' => '',
							'options'     => [
								'simple' => __( 'Simple', 'uabb' ),
								'square' => __( 'Square', 'uabb' ),
								'circle' => __( 'Circle', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							],
							'toggle'      => [
								'circle' => [
									'fields' => [ 'list_icon_bg_color', 'list_icon_bg_color_opc' ],
								],
								'square' => [
									'fields' => [ 'list_icon_bg_color', 'list_icon_bg_color_opc' ],
								],
								'custom' => [
									'fields' => [ 'list_icon_bg_color', 'list_icon_bg_color_opc', 'list_icon_bg_size', 'list_icon_bg_border_radius', 'list_icon_bg_padding', 'list_icon_border_style' ],
								],
							],
						],
						'list_icon_bg_color'         => [
							'type'       => 'color',
							'label'      => __( 'Color Option for Background', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'list_icon_bg_color_opc'     => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],
						'list_icon_bg_border_radius' => [
							'type'        => 'text',
							'label'       => __( 'Border Radius ( For Background )', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'placeholder' => '0',
							'description' => 'px',
						],

						'list_icon_bg_padding'       => [
							'type'        => 'text',
							'label'       => __( 'Padding ( For Background )', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'placeholder' => '10',
							'description' => 'px',
						],
						'list_icon_border_style'     => [
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
						],
						'list_icon_border_width'     => [
							'type'        => 'text',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
						],
						'list_icon_border_color'     => [
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'list_icon_animation'        => [
							'type'        => 'select',
							'label'       => __( 'Image/Icon Animation', 'uabb' ),
							'description' => '',
							'help'        => __( 'Select whether you want to animate image/icon or not', 'uabb' ),
							'default'     => 'no',
							'options'     => [
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							],
						],
					],
				],
				'info_list_connector' => [ // Section.
					'title'  => __( 'List Connector', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'list_connector_option' => [
							'type'        => 'select',
							'label'       => __( 'Show Connector', 'uabb' ),
							'description' => '',
							'help'        => __( 'Select whether you would like to show connector on list items.', 'uabb' ),
							'default'     => 'yes',
							'options'     => [
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							],
							'toggle'      => [
								'yes' => [
									'fields' => [ 'list_connector_color', 'list_connector_style' ],
								],
							],

						],
						'list_connector_color'  => [
							'type'       => 'color',
							'label'      => __( 'Connector Line Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'list_connector_style'  => [
							'type'        => 'select',
							'label'       => __( 'Connector Line Style', 'uabb' ),
							'description' => '',
							'default'     => 'solid',
							'options'     => [
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
							],
						],
					],
				],
			],
		],

		'info_list_style'   => [ // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'heading_typography'     => [
					'title'  => __( 'Title', 'uabb' ),
					'fields' => [
						'heading_tag_selection'    => [
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
						'heading_font_family'      => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-info-list-title',
							],
						],
						'heading_font_size_unit'   => [
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
								'selector' => '.uabb-info-list-title',
								'property' => 'font-size',
								'unit'     => 'px',
							],
						],
						'heading_line_height_unit' => [
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
								'selector' => '.uabb-info-list-title',
								'property' => 'line-height',
								'unit'     => 'em',
							],
						],
						'heading_color'            => [
							'type'       => 'color',
							'default'    => '',
							'show_reset' => true,
							'label'      => __( 'Choose Color', 'uabb' ),
							'preview'    => [
								'type'     => 'css',
								'selector' => '.uabb-info-list-title',
								'property' => 'color',
							],
						],
						'heading_margin_top'       => [
							'label'       => __( 'Margin Top', 'uabb' ),
							'type'        => 'text',
							'size'        => '8',
							'description' => 'px',
							'max_length'  => '3',
						],
						'heading_margin_bottom'    => [
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'type'        => 'text',
							'size'        => '8',
							'description' => 'px',
							'max_length'  => '3',
						],
					],
				],
				'description_typography' => [
					'title'  => __( 'Description', 'uabb' ),
					'fields' => [
						'description_font_family'      => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-info-list-description *',

							],
						],
						'description_font_size_unit'   => [
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-info-list-description *',
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
						'description_line_height_unit' => [
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-info-list-description *',
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
						'description_color'            => [
							'type'       => 'color',
							'label'      => __( 'Choose Color', 'uabb' ),
							'preview'    => [
								'type'     => 'css',
								'selector' => '.uabb-info-list-content .uabb-info-list-description *',
								'property' => 'color',
							],
							'default'    => '',
							'show_reset' => true,
						],
					],
				],
			],
		],
	]
);

// Add List Items.
FLBuilder::register_settings_form(
	'info_list_item_form',
	[
		'title' => __( 'Add List Item', 'uabb' ),
		'tabs'  => [
			'list_item_general' => [
				'title'    => __( 'General', 'uabb' ),
				'sections' => [
					'title' => [
						'title'  => __( 'General Settings', 'uabb' ),
						'fields' => [
							'list_item_title'       => [
								'type'        => 'text',
								'label'       => __( 'Title', 'uabb' ),
								'description' => '',
								'default'     => __( 'Name of the element', 'uabb' ),
								'help'        => __( 'Provide a title for this icon list item.', 'uabb' ),
								'placeholder' => __( 'Title', 'uabb' ),
								'class'       => 'uabb-list-item-title',
								'connections' => [ 'string', 'html' ],
							],
							'list_item_url'         => [
								'type'        => 'link',
								'label'       => __( 'Link', 'uabb' ),
								'connections' => [ 'url' ],
							],
							'list_item_link'        => [
								'type'    => 'select',
								'label'   => __( 'Apply Link To', 'uabb' ),
								'default' => 'no',
								'options' => [
									'no'         => __( 'No Link', 'uabb' ),
									'complete'   => __( 'Complete Box', 'uabb' ),
									'list-title' => __( 'List Title', 'uabb' ),
									'icon'       => __( 'Icon', 'uabb' ),
								],
								'preview' => 'none',
							],
							'list_item_link_target' => [
								'type'    => 'select',
								'label'   => __( 'Link Target', 'uabb' ),
								'default' => '_self',
								'options' => [
									'_self'  => __( 'Same Window', 'uabb' ),
									'_blank' => __( 'New Window', 'uabb' ),
								],
							],
							'list_item_description' => [
								'type'        => 'editor',
								'default'     => __( 'Enter description text here.', 'uabb' ),
								'label'       => '',
								'rows'        => 13,
								'connections' => [ 'string', 'html' ],
							],
						],
					],
				],
			],

			'list_item_image'   => [
				'title'    => __( 'Icon / Image', 'uabb' ),
				'sections' => [
					'title'      => [
						'title'  => __( 'Icon / Image', 'uabb' ),
						'fields' => [
							'image_type' => [
								'type'    => 'select',
								'label'   => __( 'Image Type', 'uabb' ),
								'default' => 'none',
								'options' => [
									'none'  => __( 'None', 'uabb' ),
									'icon'  => __( 'Icon', 'uabb' ),
									'photo' => __( 'Photo', 'uabb' ),
								],
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
					/* Icon Basic Setting */
					'icon_basic' => [ // Section.
						'title'  => __( 'Icon', 'uabb' ), // Section Title.
						'fields' => [ // Section Fields.
							'icon'       => [
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'show_remove' => true,
							],
							'icon_color' => [
								'type'       => 'color',
								'label'      => __( 'Icon Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							],
						],
					],
					/* Image Basic Setting */
					'img_basic'  => [ // Section.
						'title'  => __( 'Image', 'uabb' ), // Section Title.
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
						],
					],
				],
			],
		],
	]
);
