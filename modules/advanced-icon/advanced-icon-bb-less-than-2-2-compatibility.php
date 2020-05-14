<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.13.2 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Advanced Icon Module
 */

FLBuilder::register_module(
	'UABBAdvancedIconModule',
	array(
		'advimgicons' => array(
			'title'    => __( 'Image / Icon', 'uabb' ),
			'sections' => array(
				'general' => array(
					'title'  => '',
					'fields' => array(
						'icons' => array(
							'type'         => 'form',
							'label'        => __( 'Image / Icon', 'uabb' ),
							'form'         => 'uabb_advicon_group_form', // ID from registered form below.
							'preview_text' => 'image_type', // Name of a field to use for the preview text.
							'multiple'     => true,
						),
					),
				),
			),
		),
		'style'       => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'structure' => array( // Section.
					'title'  => __( 'Structure', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'icon_struc_align' => array(
							'type'    => 'select',
							'label'   => __( 'Icons Structure', 'uabb' ),
							'default' => 'horizontal',
							'options' => array(
								'horizontal' => __( 'Horizontal', 'uabb' ),
								'vertical'   => __( 'Vertical', 'uabb' ),
							),
							'width'   => '70px',
						),
						'size'             => array(
							'type'        => 'unit',
							'label'       => __( 'Image / Icon Size', 'uabb' ),
							'placeholder' => '40',
							'maxlength'   => '3',
							'size'        => '4',
							'description' => 'px',
						),
						'spacing'          => array(
							'type'        => 'unit',
							'label'       => __( 'Spacing', 'uabb' ),
							'placeholder' => '10',
							'maxlength'   => '2',
							'size'        => '4',
							'description' => 'px',
							'help'        => __( 'To manage the space between Icons / Image use this option', 'uabb' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.adv-icon-link',
								'property' => 'margin-right',
								'unit'     => 'px',
							),
						),
						'icoimage_style'   => array(
							'type'    => 'select',
							'label'   => __( 'Image / Icon Background Style', 'uabb' ),
							'default' => 'simple',
							'options' => array(
								'simple' => __( 'Simple', 'uabb' ),
								'circle' => __( 'Circle Background', 'uabb' ),
								'square' => __( 'Square Background', 'uabb' ),
								'custom' => __( 'Design your own', 'uabb' ),
							),
							'toggle'  => array(
								'circle' => array(
									'fields' => array( 'color_preset', 'bg_color', 'bg_color_opc', 'bg_hover_color', 'bg_hover_color_opc', 'three_d' ),
								),
								'square' => array(
									'fields' => array( 'color_preset', 'bg_color', 'bg_color_opc', 'bg_hover_color', 'bg_hover_color_opc', 'three_d' ),
								),
								'custom' => array(
									'fields' => array( 'color_preset', 'border_style', 'bg_color', 'bg_color_opc', 'bg_hover_color', 'bg_hover_color_opc', 'three_d', 'bg_size', 'bg_border_radius' ),
								),
							),
						),
						'bg_size'          => array(
							'type'        => 'unit',
							'label'       => __( 'Background Size', 'uabb' ),
							'help'        => __( 'Spacing between Icon / Photo & Background edge', 'uabb' ),
							'placeholder' => '0',
							'maxlength'   => '3',
							'size'        => '6',
							'description' => 'px',
						),
						'border_style'     => array(
							'type'    => 'select',
							'label'   => __( 'Border Style', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ), // Removed args  'Border type.'.
								'solid'  => __( 'Solid', 'uabb' ), // Removed args  'Border type.'.
								'dashed' => __( 'Dashed', 'uabb' ), // Removed args  'Border type.'.
								'dotted' => __( 'Dotted', 'uabb' ), // Removed args  'Border type.'.
								'double' => __( 'Double', 'uabb' ), // Removed args  'Border type.'.
							),
							'toggle'  => array(
								'solid'  => array(
									'fields' => array( 'border_width', 'border_color', 'border_hover_color' ),
								),
								'dashed' => array(
									'fields' => array( 'border_width', 'border_color', 'border_hover_color' ),
								),
								'dotted' => array(
									'fields' => array( 'border_width', 'border_color', 'border_hover_color' ),
								),
								'double' => array(
									'fields' => array( 'border_width', 'border_color', 'border_hover_color' ),
								),
							),
						),
						'border_width'     => array(
							'type'        => 'unit',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
						),
						'bg_border_radius' => array(
							'type'        => 'unit',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '0',
						),
						'align'            => array(
							'type'    => 'select',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'The overall alignment of Image / Icon', 'uabb' ),
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'responsive_align' => array(
							'type'    => 'select',
							'label'   => __( 'Mobile Alignment', 'uabb' ),
							'default' => 'default',
							'help'    => __( 'This alignment will apply on Mobile', 'uabb' ),
							'options' => array(
								'default' => __( 'Default', 'uabb' ),
								'center'  => __( 'Center', 'uabb' ),
								'left'    => __( 'Left', 'uabb' ),
								'right'   => __( 'Right', 'uabb' ),
							),
						),
					),
				),
				'colors'    => array( // Section.
					'title'  => __( 'Colors', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'color_preset'       => array(
							'type'    => 'select',
							'label'   => __( 'Icon Color Presets', 'uabb' ),
							'default' => 'preset1',
							'options' => array(

								'preset1' => __( 'Preset 1', 'uabb' ),
								'preset2' => __( 'Preset 2', 'uabb' ),
							),
							'help'    => __( 'Preset 1 => Icon : White, Background : Theme </br>Preset 2 => Icon : Theme, Background : #f3f3f3', 'uabb' ),
						),
						'color'              => array(
							'type'       => 'color',
							'label'      => __( 'Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'hover_color'        => array(
							'type'       => 'color',
							'label'      => __( 'Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'bg_color'           => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'bg_color_opc'       => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'bg_hover_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => array(
								'type' => 'none',
							),
						),
						'bg_hover_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),

						'border_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'border_hover_color' => array(
							'type'       => 'color',
							'label'      => __( 'Border Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'three_d'            => array(
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
			),
		),
	)
);

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form(
	'uabb_advicon_group_form',
	array(
		'title' => __( 'Add Icon', 'uabb' ),
		'tabs'  => array(
			'form_general' => array( // Tab.
				'title'    => __( 'General', 'uabb' ), // Tab title.
				'sections' => array( // Tab Sections.
					'general' => array( // Section.
						'title'  => '', // Section Title.
						'fields' => array( // Section Fields.
							'image_type'    => array(
								'type'    => 'select',
								'label'   => __( 'Image Type', 'uabb' ),
								'default' => 'icon',
								'options' => array(
									'icon'  => __( 'Icon', 'uabb' ),
									'photo' => __( 'Photo', 'uabb' ),
								),
								'toggle'  => array(
									'icon'  => array(
										'fields' => array( 'icon', 'icocolor', 'icohover_color' ),
										'tabs'   => array( 'form_style' ),
									),
									'photo' => array(
										'fields' => array( 'photo' ),
									),
								),
							),
							'icon'          => array(
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'default'     => 'ua-icon ua-icon-facebook-with-circle',
								'show_remove' => true,
							),
							'photo'         => array(
								'type'        => 'photo',
								'label'       => __( 'Photo', 'uabb' ),
								'show_remove' => true,
							),
							'link'          => array(
								'type'        => 'link',
								'label'       => __( 'Link', 'uabb' ),
								'connections' => array( 'url' ),
							),
							'link_target'   => array(
								'type'    => 'select',
								'label'   => __( 'Link Target', 'uabb' ),
								'default' => '_self',
								'options' => array(
									'_self'  => __( 'Same Window', 'uabb' ),
									'_blank' => __( 'New Window', 'uabb' ),
								),
								'preview' => array(
									'type' => 'none',
								),
							),
							'link_nofollow' => array(
								'type'        => 'select',
								'label'       => __( 'Link nofollow', 'uabb' ),
								'description' => '',
								'default'     => '0',
								'help'        => __( 'Enable this to make this link nofollow', 'uabb' ),
								'options'     => array(
									'1' => __( 'Yes', 'uabb' ),
									'0' => __( 'No', 'uabb' ),
								),
							),
						),
					),
				),
			),
			'form_style'   => array( // Tab.
				'title'       => __( 'Style', 'uabb' ), // Tab title.
				'description' => __( 'This background color properties will work only when Icon background style is not simple. Also the border color properties will work for Design your own.', 'uabb' ),
				'sections'    => array( // Tab Sections.
					'colors' => array( // Section.
						'title'  => __( 'Colors', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.

							'icocolor'           => array(
								'type'       => 'color',
								'label'      => __( 'Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'icohover_color'     => array(
								'type'       => 'color',
								'label'      => __( 'Hover Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
							'bg_color'           => array(
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'bg_color_opc'       => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),
							'bg_hover_color'     => array(
								'type'       => 'color',
								'label'      => __( 'Background Hover Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
							'bg_hover_color_opc' => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),
							/* Border Color Dependent on Border Style for ICon */
							'border_color'       => array(
								'type'       => 'color',
								'label'      => __( 'Border Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'border_hover_color' => array(
								'type'       => 'color',
								'label'      => __( 'Border Hover Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
						),
					),
				),
			),
		),
	)
);
