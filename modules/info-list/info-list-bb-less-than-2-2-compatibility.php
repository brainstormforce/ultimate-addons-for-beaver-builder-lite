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
	array(
		'info_list_item'    => array( // Tab.
			'title'    => __( 'List Item', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'info_list_general' => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'add_list_item' => array(
							'type'         => 'form',
							'label'        => __( 'List Item', 'uabb' ),
							'form'         => 'info_list_item_form',
							'preview_text' => 'list_item_title',
							'multiple'     => true,
						),
					),
				),
			),
		),

		'info_list_general' => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'info_list_general'   => array( // Section.
					'title'  => __( 'List Settings', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'icon_position'              => array(
							'type'    => 'select',
							'label'   => __( 'Icon / Image Position', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'left'  => __( 'Icon to the left', 'uabb' ),
								'right' => __( 'Icon to the right', 'uabb' ),
								'top'   => __( 'Icon at top', 'uabb' ),
							),
							'toggle'  => array(
								'left'  => array(
									'fields' => array( 'align_items', 'mobile_view' ),
								),
								'right' => array(
									'fields' => array( 'align_items', 'mobile_view' ),
								),
							),
						),
						'align_items'                => array(
							'type'    => 'select',
							'label'   => __( 'Icon Vertical Alignment', 'uabb' ),
							'default' => 'top',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'top'    => __( 'Top', 'uabb' ),
							),
						),
						'mobile_view'                => array(
							'type'    => 'select',
							'label'   => __( 'Mobile Structure', 'uabb' ),
							'default' => '',
							'options' => array(
								''      => __( 'Inline', 'uabb' ),
								'stack' => __( 'Stack', 'uabb' ),
							),
							'preview' => array(
								'type' => 'none',
							),
						),
						'icon_image_size'            => array(
							'type'        => 'text',
							'label'       => __( 'Icon / Image Size', 'uabb' ),
							'description' => 'px',
							'size'        => '8',
							'placeholder' => '75',
						),
						'space_between_elements'     => array(
							'type'        => 'text',
							'label'       => __( 'Space Between Two Elements', 'uabb' ),
							'description' => 'px',
							'size'        => '8',
							'placeholder' => '20',
						),
						'list_icon_style'            => array(
							'type'        => 'select',
							'label'       => __( 'Icon / Image Style', 'uabb' ),
							'default'     => 'simple',
							'description' => '',
							'options'     => array(
								'simple' => __( 'Simple', 'uabb' ),
								'square' => __( 'Square', 'uabb' ),
								'circle' => __( 'Circle', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							),
							'toggle'      => array(
								'circle' => array(
									'fields' => array( 'list_icon_bg_color', 'list_icon_bg_color_opc' ),
								),
								'square' => array(
									'fields' => array( 'list_icon_bg_color', 'list_icon_bg_color_opc' ),
								),
								'custom' => array(
									'fields' => array( 'list_icon_bg_color', 'list_icon_bg_color_opc', 'list_icon_bg_size', 'list_icon_bg_border_radius', 'list_icon_bg_padding', 'list_icon_border_style' ),
								),
							),
						),
						'list_icon_bg_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Color Option for Background', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'list_icon_bg_color_opc'     => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'list_icon_bg_border_radius' => array(
							'type'        => 'text',
							'label'       => __( 'Border Radius ( For Background )', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'placeholder' => '0',
							'description' => 'px',
						),

						'list_icon_bg_padding'       => array(
							'type'        => 'text',
							'label'       => __( 'Padding ( For Background )', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '4',
							'placeholder' => '10',
							'description' => 'px',
						),
						'list_icon_border_style'     => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
							),
						),
						'list_icon_border_width'     => array(
							'type'        => 'text',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
						),
						'list_icon_border_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'list_icon_animation'        => array(
							'type'        => 'select',
							'label'       => __( 'Image/Icon Animation', 'uabb' ),
							'description' => '',
							'help'        => __( 'Select whether you want to animate image/icon or not', 'uabb' ),
							'default'     => 'no',
							'options'     => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
				'info_list_connector' => array( // Section.
					'title'  => __( 'List Connector', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'list_connector_option' => array(
							'type'        => 'select',
							'label'       => __( 'Show Connector', 'uabb' ),
							'description' => '',
							'help'        => __( 'Select whether you would like to show connector on list items.', 'uabb' ),
							'default'     => 'yes',
							'options'     => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'      => array(
								'yes' => array(
									'fields' => array( 'list_connector_color', 'list_connector_style' ),
								),
							),

						),
						'list_connector_color'  => array(
							'type'       => 'color',
							'label'      => __( 'Connector Line Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'list_connector_style'  => array(
							'type'        => 'select',
							'label'       => __( 'Connector Line Style', 'uabb' ),
							'description' => '',
							'default'     => 'solid',
							'options'     => array(
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
							),
						),
					),
				),
			),
		),

		'info_list_style'   => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'heading_typography'     => array(
					'title'  => __( 'Title', 'uabb' ),
					'fields' => array(
						'heading_tag_selection'    => array(
							'type'     => 'select',
							'label'    => __( 'Select Tag', 'uabb' ),
							'default'  => 'h3',
							'sanitize' => array( 'FLBuilderUtils::esc_tags', 'h3' ),
							'options'  => array(
								'h1'   => __( 'H1', 'uabb' ),
								'h2'   => __( 'H2', 'uabb' ),
								'h3'   => __( 'H3', 'uabb' ),
								'h4'   => __( 'H4', 'uabb' ),
								'h5'   => __( 'H5', 'uabb' ),
								'h6'   => __( 'H6', 'uabb' ),
								'div'  => __( 'Div', 'uabb' ),
								'p'    => __( 'p', 'uabb' ),
								'span' => __( 'span', 'uabb' ),
							),
						),
						'heading_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-info-list-title',
							),
						),
						'heading_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-info-list-title',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'heading_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-info-list-title',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'heading_color'            => array(
							'type'       => 'color',
							'default'    => '',
							'show_reset' => true,
							'label'      => __( 'Choose Color', 'uabb' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-info-list-title',
								'property' => 'color',
							),
						),
						'heading_margin_top'       => array(
							'label'       => __( 'Margin Top', 'uabb' ),
							'type'        => 'text',
							'size'        => '8',
							'description' => 'px',
							'max_length'  => '3',
						),
						'heading_margin_bottom'    => array(
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'type'        => 'text',
							'size'        => '8',
							'description' => 'px',
							'max_length'  => '3',
						),
					),
				),
				'description_typography' => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'description_font_family'      => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-info-list-description *',

							),
						),
						'description_font_size_unit'   => array(
							'type'        => 'unit',
							'label'       => __( 'Font Size', 'uabb' ),
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-info-list-description *',
								'property' => 'font-size',
								'unit'     => 'px',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'description_line_height_unit' => array(
							'type'        => 'unit',
							'label'       => __( 'Line Height', 'uabb' ),
							'description' => 'em',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-info-list-description *',
								'property' => 'line-height',
								'unit'     => 'em',
							),
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'description_color'            => array(
							'type'       => 'color',
							'label'      => __( 'Choose Color', 'uabb' ),
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-info-list-content .uabb-info-list-description *',
								'property' => 'color',
							),
							'default'    => '',
							'show_reset' => true,
						),
					),
				),
			),
		),
	)
);


// Add List Items.
FLBuilder::register_settings_form(
	'info_list_item_form',
	array(
		'title' => __( 'Add List Item', 'uabb' ),
		'tabs'  => array(
			'list_item_general' => array(
				'title'    => __( 'General', 'uabb' ),
				'sections' => array(
					'title' => array(
						'title'  => __( 'General Settings', 'uabb' ),
						'fields' => array(
							'list_item_title'       => array(
								'type'        => 'text',
								'label'       => __( 'Title', 'uabb' ),
								'description' => '',
								'default'     => __( 'Name of the element', 'uabb' ),
								'help'        => __( 'Provide a title for this icon list item.', 'uabb' ),
								'placeholder' => __( 'Title', 'uabb' ),
								'class'       => 'uabb-list-item-title',
								'connections' => array( 'string', 'html' ),
							),
							'list_item_url'         => array(
								'type'        => 'link',
								'label'       => __( 'Link', 'uabb' ),
								'connections' => array( 'url' ),
							),
							'list_item_link'        => array(
								'type'    => 'select',
								'label'   => __( 'Apply Link To', 'uabb' ),
								'default' => 'no',
								'options' => array(
									'no'         => __( 'No Link', 'uabb' ),
									'complete'   => __( 'Complete Box', 'uabb' ),
									'list-title' => __( 'List Title', 'uabb' ),
									'icon'       => __( 'Icon', 'uabb' ),
								),
								'preview' => 'none',
							),
							'list_item_link_target' => array(
								'type'    => 'select',
								'label'   => __( 'Link Target', 'uabb' ),
								'default' => '_self',
								'options' => array(
									'_self'  => __( 'Same Window', 'uabb' ),
									'_blank' => __( 'New Window', 'uabb' ),
								),
							),
							'list_item_description' => array(
								'type'        => 'editor',
								'default'     => __( 'Enter description text here.', 'uabb' ),
								'label'       => '',
								'rows'        => 13,
								'connections' => array( 'string', 'html' ),
							),
						),
					),
				),
			),

			'list_item_image'   => array(
				'title'    => __( 'Icon / Image', 'uabb' ),
				'sections' => array(
					'title'      => array(
						'title'  => __( 'Icon / Image', 'uabb' ),
						'fields' => array(
							'image_type' => array(
								'type'    => 'select',
								'label'   => __( 'Image Type', 'uabb' ),
								'default' => 'none',
								'options' => array(
									'none'  => __( 'None', 'uabb' ),
									'icon'  => __( 'Icon', 'uabb' ),
									'photo' => __( 'Photo', 'uabb' ),
								),
								'toggle'  => array(
									'icon'  => array(
										'sections' => array( 'icon_basic', 'icon_style', 'icon_colors' ),
									),
									'photo' => array(
										'sections' => array( 'img_basic', 'img_style' ),
									),
								),
							),
						),
					),
					/* Icon Basic Setting */
					'icon_basic' => array( // Section.
						'title'  => __( 'Icon', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'icon'       => array(
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'show_remove' => true,
							),
							'icon_color' => array(
								'type'       => 'color',
								'label'      => __( 'Icon Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
						),
					),
					/* Image Basic Setting */
					'img_basic'  => array( // Section.
						'title'  => __( 'Image', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'photo_source' => array(
								'type'    => 'select',
								'label'   => __( 'Photo Source', 'uabb' ),
								'default' => 'library',
								'options' => array(
									'library' => __( 'Media Library', 'uabb' ),
									'url'     => __( 'URL', 'uabb' ),
								),
								'toggle'  => array(
									'library' => array(
										'fields' => array( 'photo' ),
									),
									'url'     => array(
										'fields' => array( 'photo_url' ),
									),
								),
							),
							'photo'        => array(
								'type'        => 'photo',
								'label'       => __( 'Photo', 'uabb' ),
								'show_remove' => true,
								'connections' => array( 'photo' ),
							),
							'photo_url'    => array(
								'type'        => 'text',
								'label'       => __( 'Photo URL', 'uabb' ),
								'placeholder' => 'http://www.example.com/my-photo.jpg',
							),
						),
					),
				),
			),
		),
	)
);
