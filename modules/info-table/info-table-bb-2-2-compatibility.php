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
	array(
		'general'       => array(
			'title'    => __( 'General', 'uabb' ),
			'sections' => array(
				'title-section' => array(
					'title'  => __( 'Info-Table', 'uabb' ),
					'fields' => array(
						'it_title'     => array(
							'type'        => 'text',
							'label'       => __( 'Heading', 'uabb' ),
							'default'     => __( 'Heading', 'uabb' ),
							'help'        => __( 'Enter Info-Table Title', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'sub_heading'  => array(
							'type'        => 'text',
							'label'       => __( 'Sub Heading', 'uabb' ),
							'default'     => __( 'Sub Heading', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'it_long_desc' => array(
							'type'        => 'editor',
							'label'       => '',
							'default'     => __( 'Enter description text here.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'it_link_type' => array(
							'type'    => 'select',
							'label'   => __( 'Add Link', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'            => __( 'No Link', 'uabb' ),
								'cta'           => __( 'Call to Action Button', 'uabb' ),
								'complete_link' => __( 'Link to Complete Box', 'uabb' ),
							),
							'toggle'  => array(
								'cta'           => array(
									'sections' => array( 'btn-style-section', 'btn_typography' ),
									'fields'   => array( 'button_text', 'it_link', 'it_link_target' ),
								),
								'complete_link' => array(
									'fields' => array( 'it_link', 'it_link_target' ),
								),
							),
						),
						'button_text'  => array(
							'type'        => 'text',
							'label'       => __( 'Call to action button text', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'it_link'      => array(
							'type'          => 'link',
							'label'         => __( 'Select URL', 'uabb' ),
							'connections'   => array( 'url' ),
							'show_target'   => true,
							'show_nofollow' => true,
						),
					),
				),
			),
		),
		'style'         => array(
			'title'    => __( 'Style', 'uabb' ),
			'sections' => array(
				'style-section'     => array(
					'title'  => __( 'Styles', 'uabb' ),
					'fields' => array(
						'box_design'             => array(
							'type'    => 'select',
							'label'   => __( 'Select Design Style', 'uabb' ),
							'default' => 'design01',
							'options' => array(
								'design01' => __( 'Design 01', 'uabb' ),
								'design02' => __( 'Design 02', 'uabb' ),
								'design03' => __( 'Design 03', 'uabb' ),
								'design04' => __( 'Design 04', 'uabb' ),
								'design05' => __( 'Design 05', 'uabb' ),
								'design06' => __( 'Design 06', 'uabb' ),
							),
							'toggle'  => array(
								'design01' => array(
									'fields' => array( 'btn_radius', 'btn_top_margin', 'btn_bottom_margin' ),
								),
								'design03' => array(
									'fields' => array( 'btn_radius', 'btn_top_margin', 'btn_bottom_margin' ),
								),
								'design04' => array(
									'fields' => array( 'btn_radius', 'btn_top_margin', 'btn_bottom_margin' ),
								),
								'design05' => array(
									'fields' => array( 'btn_radius', 'btn_top_margin', 'btn_bottom_margin' ),
								),
								'design06' => array(
									'fields' => array( 'btn_radius', 'btn_top_margin', 'btn_bottom_margin' ),
								),
							),
						),
						'color_scheme'           => array(
							'type'    => 'select',
							'label'   => __( 'Select Color Scheme', 'uabb' ),
							'default' => 'black',
							'options' => array(
								'black'  => __( 'Black', 'uabb' ),
								'red'    => __( 'Red', 'uabb' ),
								'blue'   => __( 'Blue', 'uabb' ),
								'yellow' => __( 'Yellow', 'uabb' ),
								'green'  => __( 'Green', 'uabb' ),
								'gray'   => __( 'Gray', 'uabb' ),
								'custom' => __( 'Design Your Own', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'desc_back_color', 'desc_back_color_opc' ),
								),
							),
						),
						'heading_back_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Main background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'heading_back_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

						'desc_back_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Highlight background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'desc_back_color_opc'    => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

						'hover_effect'           => array(
							'type'    => 'select',
							'label'   => __( 'Hover Effect', 'uabb' ),
							'default' => 'shadow',
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'shadow' => __( 'Box Shadow', 'uabb' ),
							),
						),
						'min_height'             => array(
							'type'      => 'unit',
							'label'     => __( 'Min Height', 'uabb' ),
							'maxlength' => '5',
							'size'      => '6',
							'slider'    => true,
							'units'     => array( 'px' ),
						),
					),
				),
				'btn-style-section' => array(
					'title'  => __( 'CTA Button Style', 'uabb' ),
					'fields' => array(

						'btn_text_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Text Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'btn_text_hover_color'   => array(
							'type'       => 'color',
							'label'      => __( 'Text Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'btn_bg_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'btn_bg_color_opc'       => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

						'btn_bg_hover_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'btn_bg_hover_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'btn_radius'             => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'default'     => '',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '3',
							'slider'      => true,
							'units'       => array( 'px' ),
						),
						'btn_top_margin'         => array(
							'type'        => 'unit',
							'label'       => __( 'Top Margin', 'uabb' ),
							'default'     => '',
							'maxlength'   => '4',
							'size'        => '6',
							'slider'      => true,
							'units'       => array( 'px' ),
							'placeholder' => '15',
						),
						'btn_bottom_margin'      => array(
							'type'        => 'unit',
							'label'       => __( 'Bottom Margin', 'uabb' ),
							'default'     => '',
							'maxlength'   => '4',
							'size'        => '6',
							'slider'      => true,
							'units'       => array( 'px' ),
							'placeholder' => '15',
						),
					),
				),
			),
		),

		'it_image_icon' => array(
			'title'    => __( 'Image / Icon', 'uabb' ),
			'sections' => array(
				'type_general' => array( // Section.
					'title'  => __( 'Image / Icon', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'image_type' => array(
							'type'    => 'select',
							'label'   => __( 'Image Type', 'uabb' ),
							'default' => 'icon',
							'options' => array(
								'none'  => __( 'None', 'uabb' ),
								'icon'  => __( 'Icon', 'uabb' ),
								'photo' => __( 'Photo', 'uabb' ),
							),
							'class'   => 'class_image_type',
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
				'icon_basic'   => array( // Section.
					'title'  => __( 'Icon Basics', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'icon'      => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'show_remove' => true,
							'default'     => 'fa fa-child',
						),
						'icon_size' => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'maxlength'   => '5',
							'size'        => '6',
							'slider'      => true,
							'units'       => array( 'px' ),
							'placeholder' => '75',
							'preview'     => array(
								'type' => 'refresh',
							),
						),
					),
				),

				/* Image Basic Setting */
				'img_basic'    => array( // Section.
					'title'  => __( 'Image Basics', 'uabb' ), // Section Title.
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
						'img_size'     => array(
							'type'        => 'unit',
							'label'       => __( 'Size', 'uabb' ),
							'maxlength'   => '5',
							'size'        => '6',
							'slider'      => true,
							'units'       => array( 'px' ),
							'placeholder' => '150',
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'img_align'    => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'options' => array(
								'left'    => __( 'Left', 'uabb' ),
								'center'  => __( 'Center', 'uabb' ),
								'right'   => __( 'Right', 'uabb' ),
								'inherit' => __( 'Default', 'uabb' ),
							),
							'default' => 'inherit',
						),
					),
				),
				'icon_style'   => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						/* Icon Style */
						'icon_style'            => array(
							'type'    => 'select',
							'label'   => __( 'Icon Background Style', 'uabb' ),
							'default' => 'simple',
							'options' => array(
								'simple' => __( 'Simple', 'uabb' ),
								'circle' => __( 'Circle Background', 'uabb' ),
								'square' => __( 'Square Background', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							),
							'toggle'  => array(
								'simple' => array(
									'fields' => array(),
								),
								'circle' => array(
									'fields' => array( 'icon_color_preset', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d' ),
								),
								'square' => array(
									'fields' => array( 'icon_color_preset', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d' ),
								),
								'custom' => array(
									'fields' => array( 'icon_color_preset', 'icon_border_style', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d', 'icon_bg_size', 'icon_bg_border_radius' ),
								),
							),
							'trigger' => array(
								'custom' => array(
									'fields' => array( 'icon_border_style' ),
								),
							),
						),

						/* Icon Background SIze */
						'icon_bg_size'          => array(
							'type'        => 'unit',
							'label'       => __( 'Background Size', 'uabb' ),
							'help'        => __( 'Spacing between Icon & Background edge', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '3',
							'size'        => '6',
							'slider'      => true,
							'units'       => array( 'px' ),
						),

						/* Border Style and Radius for Icon */
						'icon_border_style'     => array(
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
							'toggle'  => array(
								'solid'  => array(
									'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
								),
								'dashed' => array(
									'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
								),
								'dotted' => array(
									'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
								),
								'double' => array(
									'fields' => array( 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ),
								),
							),
						),
						'icon_border_width'     => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'slider'      => true,
							'units'       => array( 'px' ),
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'icon_bg_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'slider'      => true,
							'units'       => array( 'px' ),
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '20',
						),
					),
				),
				'img_style'    => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						/* Image Style */
						'image_style'          => array(
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
									'fields'   => array( 'img_bg_size', 'img_border_style', 'img_border_width', 'img_bg_border_radius' ),
								),
							),
							'trigger' => array(
								'custom' => array(
									'fields' => array( 'img_border_style' ),
								),

							),
						),

						/* Image Background Size */
						'img_bg_size'          => array(
							'type'      => 'unit',
							'label'     => __( 'Background Size', 'uabb' ),
							'help'      => __( 'Spacing between Image edge & Background edge', 'uabb' ),
							'maxlength' => '3',
							'size'      => '6',
							'slider'    => true,
							'units'     => array( 'px' ),
							'preview'   => array(
								'type' => 'refresh',
							),
						),

						/* Border Style and Radius for Image */
						'img_border_style'     => array(
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
							'toggle'  => array(
								'solid'  => array(
									'fields' => array( 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ),
								),
								'dashed' => array(
									'fields' => array( 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ),
								),
								'dotted' => array(
									'fields' => array( 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ),
								),
								'double' => array(
									'fields' => array( 'img_border_width', 'img_border_radius', 'img_border_color', 'img_border_hover_color' ),
								),
							),
						),
						'img_border_width'     => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'slider'      => true,
							'units'       => array( 'px' ),
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
							'preview'     => array(
								'type' => 'refresh',
							),
						),
						'img_bg_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'slider'      => true,
							'units'       => array( 'px' ),
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '0',
						),
					),
				),
				'icon_colors'  => array( // Section.
					'title'  => __( 'Colors', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.

						/* Style Options */
						'icon_color_preset'       => array(
							'type'    => 'select',
							'label'   => __( 'Icon Color Presets', 'uabb' ),
							'default' => 'preset1',
							'options' => array(
								'preset1' => __( 'Preset 1', 'uabb' ),
								'preset2' => __( 'Preset 2', 'uabb' ),
							),
							'help'    => __( 'Preset 1 => Icon : White, Background : Theme </br>Preset 2 => Icon : Theme, Background : #f3f3f3', 'uabb' ),
						),
						/* Icon Color */
						'icon_color'              => array(
							'type'       => 'color',
							'label'      => __( 'Icon Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'icon_hover_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Icon Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),

						/* Background Color Dependent on Icon Style **/
						'icon_bg_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'icon_bg_color_opc'       => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'icon_bg_hover_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'icon_bg_hover_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

						/* Border Color Dependent on Border Style for ICon */
						'icon_border_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'icon_border_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Border Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),

						/* Gradient Color Option */
						'icon_three_d'            => array(
							'type'    => 'select',
							'label'   => __( 'Gradient', 'uabb' ),
							'default' => '0',
							'options' => array(
								'0' => __( 'No', 'uabb' ),
								'1' => __( 'Yes', 'uabb' ),
							),
						),
					),
				),
				'img_colors'   => array( // Section.
					'title'  => __( 'Colors', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						/* Background Color Dependent on Icon Style **/
						'img_bg_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'img_bg_color_opc'       => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'img_bg_hover_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'img_bg_hover_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

						/* Border Color Dependent on Border Style for Image */
						'img_border_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
						'img_border_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Border Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
					),
				),
			),
		),
		'typography'    => array(
			'title'    => __( 'Typography', 'uabb' ),
			'sections' => array(
				'heading_typography'     => array(
					'title'  => __( 'Heading', 'uabb' ),
					'fields' => array(
						'heading_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Select Tag', 'uabb' ),
							'default' => 'h3',
							'options' => array(
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
						'heading_font_typo'     => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.info-table-main-heading',
								'important' => true,
							),
						),
						'heading_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
					),
				),
				'sub_heading_typography' => array(
					'title'  => __( 'Sub Heading', 'uabb' ),
					'fields' => array(
						'sub_heading_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Select Tag', 'uabb' ),
							'default' => 'h5',
							'options' => array(
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
						'sub_heading_font_typo'     => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.info-table-sub-heading',
								'important' => true,
							),
						),
						'sub_heading_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
					),
				),
				'description_typography' => array(
					'title'  => __( 'Description', 'uabb' ),
					'fields' => array(
						'description_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.info-table-description *',
								'important' => true,
							),
						),
						'description_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'show_alpha' => true,
						),
					),
				),
				'btn_typography'         => array(
					'title'  => __( 'Button', 'uabb' ),
					'fields' => array(
						'btn_font_typo' => array(
							'type'       => 'typography',
							'label'      => __( 'Typography', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'      => 'css',
								'selector'  => '.info-table-button a',
								'important' => true,
							),
						),
					),
				),
			),
		),
	)
);
