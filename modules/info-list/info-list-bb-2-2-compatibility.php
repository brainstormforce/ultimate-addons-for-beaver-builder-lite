<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2
 * Applicable for BB version greater than 2.2 and UABB version 1.3.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
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
							'type'        => 'unit',
							'label'       => __( 'Icon / Image Size', 'uabb' ),
							'slider'      => true,
							'units'       => [ 'px' ],
							'size'        => '8',
							'placeholder' => '75',
						],
						'space_between_elements'     => [
							'type'        => 'unit',
							'label'       => __( 'Space Between Two Elements', 'uabb' ),
							'slider'      => true,
							'units'       => [ 'px' ],
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
							'type'        => 'color',
							'label'       => __( 'Color Option for Background', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
						],
						'list_icon_bg_color_opc'     => [
							'type'      => 'unit',
							'label'     => __( 'Opacity', 'uabb' ),
							'default'   => '',
							'slider'    => true,
							'units'     => [ 'px' ],
							'maxlength' => '3',
							'size'      => '5',
						],
						'list_icon_bg_border_radius' => [
							'type'        => 'unit',
							'label'       => __( 'Border Radius ( For Background )', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'placeholder' => '0',
							'slider'      => true,
							'units'       => [ 'px' ],
						],

						'list_icon_bg_padding'       => [
							'type'        => 'unit',
							'label'       => __( 'Padding ( For Background )', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'placeholder' => '10',
							'slider'      => true,
							'units'       => [ 'px' ],
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
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'slider'      => true,
							'units'       => [ 'px' ],
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
						],
						'list_icon_border_color'     => [
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
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
							'type'        => 'color',
							'label'       => __( 'Connector Line Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
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
								'selector'  => '.uabb-info-list-title,.uabb-info-list-title a',
								'important' => true,
							],
						],
						'heading_color'         => [
							'type'        => 'color',
							'default'     => '',
							'show_reset'  => true,
							'label'       => __( 'Choose Color', 'uabb' ),
							'connections' => [ 'color' ],
							'show_alpha'  => true,
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-info-list-title',
								'property' => 'color',
							],
						],
						'heading_margin_top'    => [
							'label'      => __( 'Margin Top', 'uabb' ),
							'type'       => 'unit',
							'size'       => '8',
							'slider'     => true,
							'units'      => [ 'px' ],
							'max_length' => '3',
						],
						'heading_margin_bottom' => [
							'label'      => __( 'Margin Bottom', 'uabb' ),
							'type'       => 'unit',
							'size'       => '8',
							'slider'     => true,
							'units'      => [ 'px' ],
							'max_length' => '3',
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
								'selector'  => '.uabb-info-list-description *',
								'important' => true,
							],
						],
						'description_color'     => [
							'type'        => 'color',
							'label'       => __( 'Choose Color', 'uabb' ),
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-info-list-content .uabb-info-list-description *',
								'property' => 'color',
							],
							'default'     => '',
							'show_reset'  => true,
							'connections' => [ 'color' ],
							'show_alpha'  => true,
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
								'type'          => 'link',
								'label'         => __( 'Link', 'uabb' ),
								'connections'   => [ 'url' ],
								'show_target'   => true,
								'show_nofollow' => true,
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
								'type'        => 'color',
								'label'       => __( 'Icon Color', 'uabb' ),
								'default'     => '',
								'show_reset'  => true,
								'connections' => [ 'color' ],
								'show_alpha'  => true,
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
