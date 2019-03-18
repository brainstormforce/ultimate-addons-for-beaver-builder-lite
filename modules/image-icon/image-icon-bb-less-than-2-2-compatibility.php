<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.2.4 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Image Icon Module
 */

FLBuilder::register_module(
	'ImageIconModule',
	array(
		'general' => array( // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'type_general' => array( // Section.
					'title'  => __( 'Image / Icon', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'image_type' => array(
							'type'    => 'select',
							'label'   => __( 'Image Type', 'uabb' ),
							'default' => 'icon',
							'options' => array(
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
				'icon_basic'   => array( // Section.
					'title'  => __( 'Icon Basics', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'icon'       => array(
							'type'        => 'icon',
							'label'       => __( 'Icon', 'uabb' ),
							'default'     => 'ua-icon ua-icon-mail2',
							'show_remove' => true,
						),
						'icon_size'  => array(
							'type'        => 'text',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => '30',
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
						),
						'icon_align' => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
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
							'connections' => array( 'url' ),
						),
						'img_size'     => array(
							'type'        => 'text',
							'label'       => __( 'Size', 'uabb' ),
							'placeholder' => 'auto',
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
						),
						'img_align'    => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'options' => array(
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
					),
				),

				/* Icon Style Section */
				'icon_style'   => array(
					'title'  => 'Style',
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
							'type'        => 'text',
							'label'       => __( 'Background Size', 'uabb' ),
							'help'        => __( 'Spacing between Icon & Background edge', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'description' => 'px',
							'placeholder' => '30',
						),

						/* Border Style and Radius for Icon */
						'icon_border_style'     => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'solid',
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
							'type'        => 'text',
							'label'       => __( 'Border Width', 'uabb' ),
							'default'     => '',
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-icon i',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'icon_bg_border_radius' => array(
							'type'        => 'text',
							'label'       => __( 'Border Radius', 'uabb' ),
							'default'     => '',
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '20',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-icon i',
								'property' => 'border-radius',
								'unit'     => 'px',
							),
						),
					),
				),

				/* Image Style Section */
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
							'type'        => 'text',
							'label'       => __( 'Background Size', 'uabb' ),
							'default'     => '',
							'help'        => __( 'Spacing between Image edge & Background edge', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'description' => 'px',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-image .uabb-photo-img',
								'property' => 'padding',
								'unit'     => 'px',
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
							'type'        => 'text',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-image .uabb-photo-img',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'img_bg_border_radius' => array(
							'type'        => 'text',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '0',
						),
					),
				),
				/* Icon Colors */
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
						),
						'icon_hover_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Icon Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
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
						),
						'icon_border_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Border Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
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

				/* Image Colors */
				'img_colors'   => array( // Section.
					'title'  => __( 'Colors', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						/* Background Color Dependent on Icon Style **/
						'img_bg_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
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
						),
						'img_border_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Border Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
					),
				),
			),
		),
	)
);
