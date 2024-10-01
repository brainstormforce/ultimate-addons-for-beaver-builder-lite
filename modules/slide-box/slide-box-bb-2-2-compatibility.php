<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2
 * Applicable for BB version greater than 2.2 and UABB version 1.3.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Slide Box Module
 */

FLBuilder::register_module(
	'SlideBoxModule',
	array(
		'slide_front' => array( // Tab.
			'title'    => __( 'Slide Box Front', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title'           => array( // Section.
					'title'  => __( 'Slide Box Front', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'title_front' => array(
							'type'        => 'text',
							'label'       => __( 'Title', 'uabb' ),
							'default'     => __( 'Slide Box Front', 'uabb' ),
							'preview'     => array(
								'type'     => 'text',
								'selector' => '.uabb-slide-face-text-title',
							),
							'connections' => array( 'string', 'html' ),
						),
						'desc_front'  => array(
							'type'          => 'editor',
							'media_buttons' => false,
							'rows'          => 10,
							'label'         => '',
							'default'       => __( 'Add description text here. Lorem Ipsum is a dummy content.', 'uabb' ),
							'connections'   => array( 'string', 'html' ),
						),
					),
				),
				'general'         => array( // Section.
					'title'  => __( 'Image / Icon', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'image_type' => array(
							'type'    => 'select',
							'label'   => __( 'Image Type', 'uabb' ),
							'default' => 'icon',
							'options' => array(
								'none'  => _x( 'None', 'Image type.', 'uabb' ),
								'photo' => __( 'Photo', 'uabb' ),
								'icon'  => __( 'Icon', 'uabb' ),
							),
							'toggle'  => array(
								'none'  => array(),
								'photo' => array(
									'sections' => array( 'photo', 'img_icon_styles' ),
								),
								'icon'  => array(
									'sections' => array( 'icon', 'img_icon_styles' ),
								),
							),
						),
					),
				),
				'icon'            => array(
					'title'  => __( 'Icon', 'uabb' ),
					'fields' => array(
						'icon'             => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'default'     => 'ua-icon ua-icon-head',
							'show_remove' => true,
						),
						'icon_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Icon Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'icon_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Icon Hover Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type' => 'none',
							),
						),
						'icon_size'        => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '32',
							'maxlength'   => '5',
							'size'        => '6',
							'units'       => array( 'px' ),
							'slider'      => true,
						),
					),
				),
				'photo'           => array(
					'title'  => __( 'Photo', 'uabb' ),
					'fields' => array(
						'photo'        => array(
							'type'        => 'photo',
							'label'       => __( 'Photo', 'uabb' ),
							'show_remove' => true,
							'connections' => array( 'photo' ),
						),
						'image_style'  => array(
							'type'    => 'select',
							'label'   => __( 'Image Style', 'uabb' ),
							'default' => 'simple',
							'help'    => __( 'Circle and Square style will crop your image in 1:1 ratio', 'uabb' ),
							'options' => array(
								'simple' => __( 'Simple', 'uabb' ),
								'circle' => __( 'Circle', 'uabb' ),
								'square' => __( 'Square', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							),
							'class'   => 'uabb-image-icon-style',
							'toggle'  => array(
								'simple' => array(
									'fields' => array(),
								),
								'circle' => array(
									'fields' => array(),
								),
								'square' => array(
									'fields' => array(),
								),
								'custom' => array(
									'sections' => array( 'img_colors' ),
									'fields'   => array( 'img_bg_size', 'img_bg_color' ),
								),
							),
							'trigger' => array(
								'custom' => array(
									'fields' => array( 'img_border_style' ),
								),

							),
						),
						'img_size'     => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '60',
							'maxlength'   => '5',
							'size'        => '6',
							'units'       => array( 'px' ),
							'slider'      => true,
						),
						'img_bg_size'  => array(
							'type'        => 'unit',
							'label'       => __( 'Background Size', 'uabb' ),
							'help'        => __( 'Spacing between Image edge & Background edge', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '6',
							'units'       => array( 'px' ),
							'slider'      => true,
						),
						'img_bg_color' => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
					),
				),

				'img_icon_styles' => array( // Section.
					'title'  => __( 'Image / Icon Position', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'front_img_icon_position'       => array(
							'type'    => 'select',
							'label'   => __( 'Position', 'uabb' ),
							'default' => 'above-title',
							'help'    => __( 'Image / Icon position', 'uabb' ),
							'options' => array(
								'above-title' => __( 'Above Heading', 'uabb' ),
								'left-title'  => __( 'Left of Heading', 'uabb' ),
								'right-title' => __( 'Right of Heading', 'uabb' ),
								'left'        => __( 'Left of Text and Heading', 'uabb' ),
								'right'       => __( 'Right of Text and Heading', 'uabb' ),
							),
							'toggle'  => array(
								'above-title' => array(
									'fields' => array( 'front_alignment' ),
								),
								'left'        => array(
									'fields' => array( 'front_align_items', 'front_icon_border', 'mobile_view' ),
								),
								'right'       => array(
									'fields' => array( 'front_align_items', 'front_icon_border', 'mobile_view' ),
								),
							),
						),
						'front_alignment'               => array(
							'type'    => 'align',
							'label'   => __( 'Overall Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'front_align_items'             => array(
							'type'    => 'select',
							'label'   => __( 'Icon Vertical Alignment', 'uabb' ),
							'default' => 'top',
							'options' => array(
								'top'    => __( 'Top', 'uabb' ),
								'middle' => __( 'Center', 'uabb' ),
							),
						),
						'front_icon_border'             => array(
							'type'    => 'select',
							'label'   => __( 'Border between Icon and Text', 'uabb' ),
							'default' => '',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								''    => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'yes' => array(
									'fields' => array( 'front_icon_border_size', 'front_icon_border_color', 'front_icon_border_hover_color' ),
								),
							),
						),
						'front_icon_border_size'        => array(
							'type'        => 'unit',
							'label'       => __( 'Border Thickness', 'uabb' ),
							'placeholder' => '1',
							'maxlength'   => '5',
							'size'        => '6',
							'units'       => array( 'px' ),
							'slider'      => true,
						),
						'front_icon_border_color'       => array(
							'type'        => 'color',
							'label'       => __( 'Border Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'front_icon_border_hover_color' => array(
							'type'        => 'color',
							'label'       => __( 'Border Hover / Focus Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'mobile_view'                   => array(
							'type'    => 'select',
							'label'   => __( 'Mobile Structure', 'uabb' ),
							'default' => '',
							'options' => array(
								''      => __( 'Inline', 'uabb' ),
								'stack' => __( 'Stack', 'uabb' ),
							),
						),
						'stacking_order'                => array(
							'type'    => 'select',
							'label'   => __( 'Stacking Order', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'reversed' => __( 'Reversed', 'uabb' ),
								'default'  => __( 'Default', 'uabb' ),
							),
							'help'    => __( 'Use this option to show Icon / Image above title in small devices.', 'uabb' ),
						),
					),
				),
			),
		),
		'slide_down'  => array( // Tab.
			'title'    => __( 'Slide Box Back', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title'           => array( // Section.
					'title'  => __( 'Slide Box Back', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'title_back' => array(
							'type'    => 'text',
							'label'   => __( 'Title on Back', 'uabb' ),
							'default' => __( 'Slide Box Back', 'uabb' ),
							'help'    => 'Perhaps, this is the most highlighted text.',
							'preview' => array(
								'type'     => 'text',
								'selector' => '.uabb-slide-back-text-title',
							),
						),
					),
				),
				'description'     => array( // Section.
					'title'  => '', // Section Title.
					'fields' => array( // Section Fields.
						'desc_back' => array(
							'type'          => 'editor',
							'media_buttons' => false,
							'rows'          => 10,
							'label'         => __( 'Description', 'uabb' ),
							'default'       => __( '<ul><li>Enter description text here.</li><li>Enter description text here.</li></ul>', 'uabb' ), //phpcs:ignore	WordPress.WP.I18n.NoHtmlWrappedStrings
						),
					),
				),
				'cta'             => array(
					'title'  => __( 'Call to Action', 'uabb' ),
					'fields' => array(
						'cta_type' => array(
							'type'    => 'select',
							'label'   => __( 'Type', 'uabb' ),
							'default' => 'link',
							'options' => array(
								'none'   => _x( 'None', 'Call to action.', 'uabb' ),
								'link'   => __( 'Text', 'uabb' ),
								'button' => __( 'Button', 'uabb' ),
							),
							'toggle'  => array(
								'none'   => array(),
								'link'   => array(
									'sections' => array( 'cta_type_text', 'link_typography' ),
								),
								'button' => array(
									'sections' => array( 'cta_type_button' ),
								),
							),
						),
					),
				),
				'cta_type_text'   => array( // Section.
					'title'  => __( 'Text', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'link'     => array(
							'type'          => 'link',
							'label'         => __( 'Link', 'uabb' ),
							'show_target'   => true,
							'show_nofollow' => true,
							'help'          => __( 'The link applies to the entire module. If choosing a call to action type below, this link will also be used for the text or button.', 'uabb' ),
							'preview'       => array(
								'type' => 'none',
							),
						),
						'cta_text' => array(
							'type'    => 'text',
							'label'   => __( 'Text', 'uabb' ),
							'default' => __( 'Read More', 'uabb' ),
						),
					),
				),
				'cta_type_button' => array( // Section.
					'title'  => __( 'Button', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'button' => array(
							'type'         => 'form',
							'label'        => __( 'Button Settings', 'uabb' ),
							'form'         => 'button_form_field', // ID of a registered form.
							'preview_text' => 'text', // ID of a field to use for the preview text.
						),
					),
				),
			),
		),
		'style'       => array( // Tab.
			'title'    => __( 'Styles', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general'              => array( // Section.
					'title'  => __( 'Description', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'slide_type' => array(
							'type'    => 'select',
							'label'   => __( 'Select Style', 'uabb' ),
							'default' => 'style1',
							'help'    => __( 'Select Slide style for this slide box.', 'uabb' ),
							'options' => array(
								'style1' => __( 'Style 1', 'uabb' ),
								'style2' => __( 'Style 2', 'uabb' ),
								'style3' => __( 'Style 3', 'uabb' ),
							),
							'toggle'  => array(
								'style1' => array(
									'sections' => array( 'overlay' ),
								),
								'style2' => array(
									'fields'   => array( 'focused_front_title_color', 'focused_front_desc_color', 'dropdown_icon_bg_color', 'dropdown_icon_color' ),
									'sections' => array( 'dropdown_icon' ),
								),
								'style3' => array(
									'fields'   => array( 'focused_front_title_color', 'focused_front_desc_color', 'dropdown_plus_icon_color' ),
									'sections' => array( 'dropdown_icon' ),
								),
							),
						),
					),
				),
				'front_styles'         => array( // Section.
					'title'  => __( 'Slide Box Front Style', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'front_padding_dimension'        => array(

							'type'        => 'dimension',
							'label'       => __( 'Content Padding', 'uabb' ),
							'help'        => __( 'To apply padding to Slide Box Front use this setting', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '25',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'front_background_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'default'     => 'f6f6f6',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-slide-front',
								'property' => 'background',
							),
						),
						'front_background_color_opc'     => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

						'focused_front_background_color' => array(
							'type'        => 'color',
							'label'       => __( 'Background Hover/Focus Color', 'uabb' ),
							'default'     => 'e5e5e5',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'focused_front_background_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

					),
				),
				'back_styles'          => array( // Section.
					'title'  => __( 'Slide Box Back Style', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'back_padding_dimension' => array(
							'type'       => 'dimension',
							'label'      => __( 'Content Padding', 'uabb' ),
							'help'       => __( 'To apply padding to Slide Box Back use this setting', 'uabb' ),
							'units'      => array( 'px' ),
							'slider'     => true,
							'responsive' => array(
								'placeholder' => array(
									'default'    => '25',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
						'back_alignment'         => array(
							'type'    => 'select',
							'label'   => __( 'Overall Alignment', 'uabb' ),
							'default' => 'left',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
							'preview' => array(
								'type'     => 'css',
								'selector' => '.uabb-slide-down',
								'property' => 'text-align',
							),
						),
						'back_background_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Background Color', 'uabb' ),
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'default'     => 'f6f6f6',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-slide-down',
								'property' => 'background',
							),
						),
					),
				),
				'overlay'              => array( // Section.
					'title'  => __( 'Overlay', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'overlay'                   => array(
							'type'    => 'select',
							'label'   => __( 'Enable Overlay', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'toggle'  => array(
								'no'  => array(
									'fields' => array(),
								),
								'yes' => array(
									'fields' => array( 'overlay_color', 'overlay_opacity', 'overlay_icon', 'overlay_icon_color', 'overlay_icon_bg_color', 'overlay_icon_bg_color_opc', 'overlay_icon_size' ),
								),
							),
						),
						'overlay_color'             => array(
							'type'        => 'color',
							'label'       => __( 'Overlay Color', 'uabb' ),
							'default'     => '000000',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'overlay_icon'              => array(
							'type'        => 'icon',
							'default'     => 'fa fa-plus-square-o',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
						),
						'overlay_icon_color'        => array(
							'type'        => 'color',
							'label'       => __( 'Icon Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),

						'overlay_icon_bg_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Icon Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'overlay_icon_bg_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

						'overlay_icon_size'         => array(
							'type'        => 'unit',
							'label'       => __( 'Icon Size', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '3',
							'size'        => '4',
							'units'       => array( 'px' ),
							'slider'      => true,
						),
					),
				),
				'dropdown_icon'        => array( // Section.
					'title'  => __( 'Drop Down Icon', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'dropdown_icon_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Icon Color', 'uabb' ),
							'default'     => 'ffffff',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'dropdown_plus_icon_color' => array(
							'type'        => 'color',
							'label'       => __( 'Icon Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'dropdown_icon_bg_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Icon Background Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'dropdown_icon_size'       => array(
							'type'        => 'unit',
							'label'       => __( 'Icon Size', 'uabb' ),
							'placeholder' => '20',
							'maxlength'   => '3',
							'size'        => '4',
							'units'       => array( 'px' ),
							'slider'      => true,
						),
						'dropdown_icon_align'      => array(
							'type'    => 'select',
							'label'   => __( 'Icon Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
					),
				),
				'slide_box_min_height' => array( // Section.
					'title'  => __( 'Slide Box Min Height', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'set_min_height'       => array(
							'type'    => 'select',
							'label'   => __( 'Minimum Height', 'uabb' ),
							'default' => 'default',
							'options' => array(
								'default' => __( 'No', 'uabb' ),
								'custom'  => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'default' => array(
									'fields' => array(),
								),
								'custom'  => array(
									'fields' => array( 'slide_min_height', 'slide_vertical_align' ),
								),
							),
						),
						'slide_min_height'     => array(
							'type'   => 'unit',
							'label'  => __( 'Enter Height', 'uabb' ),
							'units'  => array( 'px' ),
							'slider' => true,
							'size'   => '8',
							'help'   => __( 'Apply minimum height to complete SlideBox. It is useful when multiple SlideBox are in same row.', 'uabb' ),
						),
						'slide_vertical_align' => array(
							'type'    => 'select',
							'label'   => __( 'Overall Vertical Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'If enabled, the Content would align vertically center', 'uabb' ),
							'options' => array(
								'center'  => __( 'Center', 'uabb' ),
								'inherit' => __( 'Top', 'uabb' ),
							),
						),
					),
				),
			),
		),
		'typography'  => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'front_title_typography' => array(
					'title'  => __( 'Front Title', 'uabb' ),
					'fields' => array(
						'front_title_tag_selection' => array(
							'type'     => 'select',
							'label'    => __( 'Tag', 'uabb' ),
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
						'front_title_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-slide-face-text-title',
								'important' => true,
							),
						),
						'front_title_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'front_title_focused_color' => array(
							'type'        => 'color',
							'label'       => __( 'Hover/Focus Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'front_title_margin_top'    => array(
							'type'   => 'unit',
							'label'  => __( 'Margin Top', 'uabb' ),
							'size'   => '8',
							'units'  => array( 'px' ),
							'slider' => true,
						),
						'front_title_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'size'        => '8',
							'units'       => array( 'px' ),
							'slider'      => true,
						),
					),
				),
				'front_desc_typography'  => array(
					'title'  => __( 'Front Description', 'uabb' ),
					'fields' => array(
						'front_desc_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-slide-box-section-content',
								'important' => true,
							),
						),
						'front_desc_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Description Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'front_desc_focused_color' => array(
							'type'        => 'color',
							'label'       => __( 'Hover/Focus Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'front_desc_margin_top'    => array(
							'type'   => 'unit',
							'label'  => __( 'Margin Top', 'uabb' ),
							'size'   => '8',
							'units'  => array( 'px' ),
							'slider' => true,
						),
						'front_desc_margin_bottom' => array(
							'type'   => 'unit',
							'label'  => __( 'Margin Bottom', 'uabb' ),
							'size'   => '8',
							'units'  => array( 'px' ),
							'slider' => true,
						),
					),
				),
				'back_title_typography'  => array(
					'title'  => __( 'Back Title', 'uabb' ),
					'fields' => array(
						'back_title_tag_selection' => array(
							'type'     => 'select',
							'label'    => __( 'Tag', 'uabb' ),
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
						'back_title_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-slide-back-text-title',
								'important' => true,
							),
						),
						'back_title_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-slide-back-text-title',
							),
						),
						'back_title_margin_top'    => array(
							'type'   => 'unit',
							'label'  => __( 'Margin Top', 'uabb' ),
							'size'   => '8',
							'units'  => array( 'px' ),
							'slider' => true,
						),
						'back_title_margin_bottom' => array(
							'type'   => 'unit',
							'label'  => __( 'Margin Bottom', 'uabb' ),
							'size'   => '8',
							'units'  => array( 'px' ),
							'slider' => true,
						),
					),
				),
				'back_desc_typography'   => array(
					'title'  => __( 'Back Description', 'uabb' ),
					'fields' => array(
						'back_desc_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-slide-down-box-section-content',
								'important' => true,
							),
						),
						'back_desc_color'         => array(
							'type'        => 'color',
							'default'     => '',
							'show_reset'  => true,
							'label'       => __( 'Description Color', 'uabb' ),
							'connections' => array( 'color' ),
							'show_alpha'  => true,
							'preview'     => array(
								'type'     => 'css',
								'property' => 'color',
								'selector' => '.uabb-slide-down-box-section-content',
							),
						),
						'back_desc_margin_top'    => array(
							'type'   => 'unit',
							'label'  => __( 'Margin Top', 'uabb' ),
							'size'   => '8',
							'units'  => array( 'px' ),
							'slider' => true,
						),
						'back_desc_margin_bottom' => array(
							'type'        => 'unit',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'size'        => '8',
							'placeholder' => '10',
							'units'       => array( 'px' ),
							'slider'      => true,
						),
					),
				),
				'link_typography'        => array(
					'title'  => __( 'Link Text', 'uabb' ),
					'fields' => array(
						'link_typo'  => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.uabb-callout-cta-link',
								'important' => true,
							),
						),
						'link_color' => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
					),
				),
			),
		),
	)
);
