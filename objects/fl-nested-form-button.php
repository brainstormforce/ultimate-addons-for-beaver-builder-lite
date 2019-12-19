<?php
/**
 *  FLBuilder Registered Nested Forms - Button Form Field
 *
 * @package Button
 */

$version_bb_check = UABB_Lite_Compatibility::check_bb_version();

if ( ! $version_bb_check ) {
	FLBuilder::register_settings_form(
		'button_form_field',
		array(
			'title' => __( 'Button', 'uabb' ),
			'tabs'  => array(
				'general'             => array(
					'title'    => __( 'General', 'uabb' ),
					'sections' => array(
						'general' => array(
							'title'  => '',
							'fields' => array(
								'text' => array(
									'type'    => 'text',
									'label'   => __( 'Text', 'uabb' ),
									'default' => __( 'Click Here', 'uabb' ),
									'preview' => array(
										'type'     => 'text',
										'selector' => '.uabb-creative-button-text',
									),
								),

							),
						),
						'link'    => array(
							'title'  => __( 'Link', 'uabb' ),
							'fields' => array(
								'link'        => array(
									'type'        => 'link',
									'label'       => __( 'Link', 'uabb' ),
									'placeholder' => 'http://www.example.com',
								),
								'link_target' => array(
									'type'    => 'select',
									'label'   => __( 'Link Target', 'uabb' ),
									'default' => '_self',
									'options' => array(
										'_self'  => __( 'Same Window', 'uabb' ),
										'_blank' => __( 'New Window', 'uabb' ),
									),
								),
							),
						),
					),
				),
				'style'               => array(
					'title'    => __( 'Style', 'uabb' ),
					'sections' => array(
						'style'      => array(
							'title'  => __( 'Style', 'uabb' ),
							'fields' => array(
								'style'                 => array(
									'type'    => 'select',
									'label'   => __( 'Style', 'uabb' ),
									'default' => 'default',
									'class'   => 'creative_button_styles',
									'options' => array(
										'default'     => __( 'Default', 'uabb' ),
										'flat'        => __( 'Flat', 'uabb' ),
										'gradient'    => __( 'Gradient', 'uabb' ),
										'transparent' => __( 'Transparent', 'uabb' ),
										'threed'      => __( '3D', 'uabb' ),
									),
									'toggle'  => array(
										'transparent' => array(
											'fields' => array( 'border_size', 'transparent_button_options' ),
										),
										'threed'      => array(
											'fields' => array( 'threed_button_options' ),
										),
										'flat'        => array(
											'fields' => array( 'flat_button_options' ),
										),

									),
								),
								'border_size'           => array(
									'type'        => 'text',
									'label'       => __( 'Border Size', 'uabb' ),
									'description' => 'px',
									'maxlength'   => '3',
									'size'        => '5',
									'placeholder' => '2',
								),
								'transparent_button_options' => array(
									'type'    => 'select',
									'label'   => __( 'Hover Styles', 'uabb' ),
									'default' => 'transparent-fade',
									'options' => array(
										'none'             => __( 'None', 'uabb' ),
										'transparent-fade' => __( 'Fade Background', 'uabb' ),
										'transparent-fill-top' => __( 'Fill Background From Top', 'uabb' ),
										'transparent-fill-bottom' => __( 'Fill Background From Bottom', 'uabb' ),
										'transparent-fill-left' => __( 'Fill Background From Left', 'uabb' ),
										'transparent-fill-right' => __( 'Fill Background From Right', 'uabb' ),
										'transparent-fill-center' => __( 'Fill Background Vertical', 'uabb' ),
										'transparent-fill-diagonal' => __( 'Fill Background Diagonal', 'uabb' ),
										'transparent-fill-horizontal' => __( 'Fill Background Horizontal', 'uabb' ),
									),
								),
								'threed_button_options' => array(
									'type'    => 'select',
									'label'   => __( 'Hover Styles', 'uabb' ),
									'default' => 'threed_down',
									'options' => array(
										'threed_down'    => __( 'Move Down', 'uabb' ),
										'threed_up'      => __( 'Move Up', 'uabb' ),
										'threed_left'    => __( 'Move Left', 'uabb' ),
										'threed_right'   => __( 'Move Right', 'uabb' ),
										'animate_top'    => __( 'Animate Top', 'uabb' ),
										'animate_bottom' => __( 'Animate Bottom', 'uabb' ),
									),
								),
								'flat_button_options'   => array(
									'type'    => 'select',
									'label'   => __( 'Hover Styles', 'uabb' ),
									'default' => 'none',
									'options' => array(
										'none'             => __( 'None', 'uabb' ),
										'animate_to_left'  => __( 'Appear Icon From Right', 'uabb' ),
										'animate_to_right' => __( 'Appear Icon From Left', 'uabb' ),
										'animate_from_top' => __( 'Appear Icon From Top', 'uabb' ),
										'animate_from_bottom' => __( 'Appear Icon From Bottom', 'uabb' ),
									),
								),
							),
						),
						'icon'       => array(
							'title'  => __( 'Icons', 'uabb' ),
							'fields' => array(
								'icon'          => array(
									'type'        => 'icon',
									'label'       => __( 'Icon', 'uabb' ),
									'show_remove' => true,
								),
								'icon_position' => array(
									'type'    => 'select',
									'label'   => __( 'Icon Position', 'uabb' ),
									'default' => 'before',
									'options' => array(
										'before' => __( 'Before Text', 'uabb' ),
										'after'  => __( 'After Text', 'uabb' ),
									),
								),
							),
						),
						'colors'     => array(
							'title'  => __( 'Colors', 'uabb' ),
							'fields' => array(
								'text_color'         => array(
									'type'       => 'color',
									'label'      => __( 'Text Color', 'uabb' ),
									'default'    => '',
									'show_reset' => true,
								),
								'text_hover_color'   => array(
									'type'       => 'color',
									'label'      => __( 'Text Hover Color', 'uabb' ),
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
								'hover_attribute'    => array(
									'type'    => 'uabb-toggle-switch',
									'label'   => __( 'Apply Hover Color To', 'uabb' ),
									'default' => 'bg',
									'options' => array(
										'border' => __( 'Border', 'uabb' ),
										'bg'     => __( 'Background', 'uabb' ),
									),
									'width'   => '75px',
								),
							),
						),
						'formatting' => array(
							'title'  => __( 'Structure', 'uabb' ),
							'fields' => array(
								'width'                    => array(
									'type'    => 'select',
									'label'   => __( 'Width', 'uabb' ),
									'default' => 'auto',
									'options' => array(
										'auto'   => _x( 'Auto', 'Width.', 'uabb' ),
										'full'   => __( 'Full Width', 'uabb' ),
										'custom' => __( 'Custom', 'uabb' ),
									),
									'toggle'  => array(
										'auto'   => array(
											'fields' => array( 'align', 'mob_align', 'line_height' ),
										),
										'full'   => array(
											'fields' => array( 'line_height' ),
										),
										'custom' => array(
											'fields' => array( 'align', 'mob_align', 'custom_width', 'custom_height', 'padding_top_bottom', 'padding_left_right' ),
										),
									),
								),
								'button_padding_dimension' => array(
									'type'        => 'dimension',
									'label'       => __( 'Padding', 'uabb' ),
									'slider'      => true,
									'description' => 'px',
									'responsive'  => true,
									'preview'     => array(
										'type'      => 'css',
										'selector'  => '.uabb-creative-button-wrap a',
										'property'  => 'padding',
										'unit'      => 'px',
										'important' => true,
									),
								),
								'button_border_style'      => array(
									'type'    => 'select',
									'label'   => __( 'Bottom Border Type', 'uabb' ),
									'default' => 'none',
									'options' => array(
										'none'   => __( 'None', 'uabb' ),
										'solid'  => __( 'Solid', 'uabb' ),
										'dashed' => __( 'Dashed', 'uabb' ),
										'dotted' => __( 'Dotted', 'uabb' ),
										'double' => __( 'Double', 'uabb' ),
									),
									'preview' => array(
										'type'     => 'css',
										'selector' => '.uabb-creative-button-wrap a',
										'property' => 'border-style',
									),
								),
								'button_border_width'      => array(
									'type'        => 'unit',
									'label'       => __( 'Border Width', 'uabb' ),
									'placeholder' => '1',
									'description' => 'px',
									'maxlength'   => '2',
									'size'        => '6',
									'preview'     => array(
										'type'     => 'css',
										'selector' => '.uabb-creative-button-wrap a',
										'property' => 'border-width',
										'unit'     => 'px',
									),
								),
								'button_border_radius'     => array(
									'type'        => 'unit',
									'label'       => __( 'Border Radius', 'uabb' ),
									'placeholder' => '1',
									'description' => 'px',
									'maxlength'   => '2',
									'size'        => '6',
									'preview'     => array(
										'type'     => 'css',
										'selector' => '.uabb-creative-button-wrap a',
										'property' => 'border-radius',
										'unit'     => 'px',
									),
								),
								'button_border_color'      => array(
									'type'       => 'color',
									'label'      => __( 'Border Color', 'uabb' ),
									'default'    => '',
									'show_reset' => true,
									'show_alpha' => true,
									'preview'    => array(
										'type'     => 'css',
										'selector' => '.uabb-creative-button-wrap a',
										'property' => 'border-color',
									),
								),
								'border_hover_color'       => array(
									'type'       => 'color',
									'label'      => __( 'Border Color', 'uabb' ),
									'default'    => '',
									'show_reset' => true,
									'show_alpha' => true,
								),
								'custom_width'             => array(
									'type'        => 'text',
									'label'       => __( 'Custom Width', 'uabb' ),
									'default'     => '200',
									'maxlength'   => '3',
									'size'        => '4',
									'description' => 'px',
								),
								'custom_height'            => array(
									'type'        => 'text',
									'label'       => __( 'Custom Height', 'uabb' ),
									'default'     => '45',
									'maxlength'   => '3',
									'size'        => '4',
									'description' => 'px',
								),
								'padding_top_bottom'       => array(
									'type'        => 'text',
									'label'       => __( 'Padding Top/Bottom', 'uabb' ),
									'placeholder' => '0',
									'maxlength'   => '3',
									'size'        => '4',
									'description' => 'px',
								),
								'padding_left_right'       => array(
									'type'        => 'text',
									'label'       => __( 'Padding Left/Right', 'uabb' ),
									'placeholder' => '0',
									'maxlength'   => '3',
									'size'        => '4',
									'description' => 'px',
								),
								'border_radius'            => array(
									'type'        => 'text',
									'label'       => __( 'Round Corners', 'uabb' ),
									'maxlength'   => '3',
									'size'        => '4',
									'description' => 'px',
								),
								'align'                    => array(
									'type'    => 'select',
									'label'   => __( 'Alignment', 'uabb' ),
									'default' => 'center',
									'options' => array(
										'center' => __( 'Center', 'uabb' ),
										'left'   => __( 'Left', 'uabb' ),
										'right'  => __( 'Right', 'uabb' ),
									),
								),
								'mob_align'                => array(
									'type'    => 'select',
									'label'   => __( 'Mobile Alignment', 'uabb' ),
									'default' => 'center',
									'options' => array(
										'center' => __( 'Center', 'uabb' ),
										'left'   => __( 'Left', 'uabb' ),
										'right'  => __( 'Right', 'uabb' ),
									),
								),
							),
						),
					),
				),
				'creative_typography' => array(
					'title'    => __( 'Typography', 'uabb' ),
					'sections' => array(
						'typography' => array(
							'title'  => __( 'Button Settings', 'uabb' ),
							'fields' => array(
								'font_family'      => array(
									'type'    => 'font',
									'label'   => __( 'Font Family', 'uabb' ),
									'default' => array(
										'family' => 'Default',
										'weight' => 'Default',
									),
									'preview' => array(
										'type'     => 'font',
										'selector' => '.uabb-creative-button',
									),
								),
								'font_size_unit'   => array(
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
								),
								'line_height_unit' => array(
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
								),
							),
						),
					),
				),
			),
		)
	);

} else {
	FLBuilder::register_settings_form(
		'button_form_field',
		array(
			'title' => __( 'Button', 'uabb' ),
			'tabs'  => array(
				'general'             => array(
					'title'    => __( 'General', 'uabb' ),
					'sections' => array(
						'general' => array(
							'title'  => '',
							'fields' => array(
								'text' => array(
									'type'    => 'text',
									'label'   => __( 'Text', 'uabb' ),
									'default' => __( 'Click Here', 'uabb' ),
									'preview' => array(
										'type'     => 'text',
										'selector' => '.uabb-creative-button-text',
									),
								),

							),
						),
						'link'    => array(
							'title'  => __( 'Link', 'uabb' ),
							'fields' => array(
								'link' => array(
									'type'          => 'link',
									'label'         => __( 'Link', 'uabb' ),
									'placeholder'   => 'http://www.example.com',
									'show_target'   => true,
									'show_nofollow' => true,
								),
							),
						),
					),
				),
				'style'               => array(
					'title'    => __( 'Style', 'uabb' ),
					'sections' => array(
						'style'      => array(
							'title'  => __( 'Style', 'uabb' ),
							'fields' => array(
								'style'                 => array(
									'type'    => 'select',
									'label'   => __( 'Style', 'uabb' ),
									'default' => 'default',
									'class'   => 'creative_button_styles',
									'options' => array(
										'default'     => __( 'Default', 'uabb' ),
										'flat'        => __( 'Flat', 'uabb' ),
										'gradient'    => __( 'Gradient', 'uabb' ),
										'transparent' => __( 'Transparent', 'uabb' ),
										'threed'      => __( '3D', 'uabb' ),
									),
									'toggle'  => array(
										'transparent' => array(
											'fields' => array( 'border_size', 'transparent_button_options', 'width', 'border_radius' ),
										),
										'threed'      => array(
											'fields' => array( 'threed_button_options', 'width', 'border_radius' ),
										),
										'flat'        => array(
											'fields' => array( 'flat_button_options', 'width', 'border_radius' ),
										),
										'gradient'    => array(
											'fields' => array( 'width', 'border_radius' ),
										),
										'default'     => array(
											'fields' => array( 'button_padding_dimension', 'button_border', 'border_hover_color' ),
										),
									),
								),
								'border_size'           => array(
									'type'        => 'unit',
									'label'       => __( 'Border Size', 'uabb' ),
									'units'       => array( 'px' ),
									'slider'      => true,
									'maxlength'   => '3',
									'size'        => '5',
									'placeholder' => '2',
								),
								'transparent_button_options' => array(
									'type'    => 'select',
									'label'   => __( 'Hover Styles', 'uabb' ),
									'default' => 'transparent-fade',
									'options' => array(
										'none'             => __( 'None', 'uabb' ),
										'transparent-fade' => __( 'Fade Background', 'uabb' ),
										'transparent-fill-top' => __( 'Fill Background From Top', 'uabb' ),
										'transparent-fill-bottom' => __( 'Fill Background From Bottom', 'uabb' ),
										'transparent-fill-left' => __( 'Fill Background From Left', 'uabb' ),
										'transparent-fill-right' => __( 'Fill Background From Right', 'uabb' ),
										'transparent-fill-center' => __( 'Fill Background Vertical', 'uabb' ),
										'transparent-fill-diagonal' => __( 'Fill Background Diagonal', 'uabb' ),
										'transparent-fill-horizontal' => __( 'Fill Background Horizontal', 'uabb' ),
									),
								),
								'threed_button_options' => array(
									'type'    => 'select',
									'label'   => __( 'Hover Styles', 'uabb' ),
									'default' => 'threed_down',
									'options' => array(
										'threed_down'    => __( 'Move Down', 'uabb' ),
										'threed_up'      => __( 'Move Up', 'uabb' ),
										'threed_left'    => __( 'Move Left', 'uabb' ),
										'threed_right'   => __( 'Move Right', 'uabb' ),
										'animate_top'    => __( 'Animate Top', 'uabb' ),
										'animate_bottom' => __( 'Animate Bottom', 'uabb' ),
									),
								),
								'flat_button_options'   => array(
									'type'    => 'select',
									'label'   => __( 'Hover Styles', 'uabb' ),
									'default' => 'none',
									'options' => array(
										'none'             => __( 'None', 'uabb' ),
										'animate_to_left'  => __( 'Appear Icon From Right', 'uabb' ),
										'animate_to_right' => __( 'Appear Icon From Left', 'uabb' ),
										'animate_from_top' => __( 'Appear Icon From Top', 'uabb' ),
										'animate_from_bottom' => __( 'Appear Icon From Bottom', 'uabb' ),
									),
								),
							),
						),
						'icon'       => array(
							'title'  => __( 'Icons', 'uabb' ),
							'fields' => array(
								'icon'          => array(
									'type'        => 'icon',
									'label'       => __( 'Icon', 'uabb' ),
									'show_remove' => true,
								),
								'icon_position' => array(
									'type'    => 'select',
									'label'   => __( 'Icon Position', 'uabb' ),
									'default' => 'before',
									'options' => array(
										'before' => __( 'Before Text', 'uabb' ),
										'after'  => __( 'After Text', 'uabb' ),
									),
								),
							),
						),
						'colors'     => array(
							'title'  => __( 'Colors', 'uabb' ),
							'fields' => array(
								'text_color'         => array(
									'type'       => 'color',
									'label'      => __( 'Text Color', 'uabb' ),
									'default'    => '',
									'show_reset' => true,
									'show_alpha' => true,
								),
								'text_hover_color'   => array(
									'type'       => 'color',
									'label'      => __( 'Text Hover Color', 'uabb' ),
									'default'    => '',
									'show_reset' => true,
									'show_alpha' => true,
									'preview'    => array(
										'type' => 'none',
									),
								),
								'bg_color'           => array(
									'type'       => 'color',
									'label'      => __( 'Background Color', 'uabb' ),
									'default'    => '',
									'show_reset' => true,
									'show_alpha' => true,
								),
								'bg_color_opc'       => array(
									'type'      => 'unit',
									'label'     => __( 'Opacity', 'uabb' ),
									'default'   => '',
									'units'     => array( 'px' ),
									'slider'    => true,
									'maxlength' => '3',
									'size'      => '5',
								),
								'bg_hover_color'     => array(
									'type'       => 'color',
									'label'      => __( 'Background Hover Color', 'uabb' ),
									'default'    => '',
									'show_reset' => true,
									'show_alpha' => true,
									'preview'    => array(
										'type' => 'none',
									),
								),
								'bg_hover_color_opc' => array(
									'type'      => 'unit',
									'label'     => __( 'Opacity', 'uabb' ),
									'default'   => '',
									'units'     => array( 'px' ),
									'slider'    => true,
									'maxlength' => '3',
									'size'      => '5',
								),
								'hover_attribute'    => array(
									'type'    => 'uabb-toggle-switch',
									'label'   => __( 'Apply Hover Color To', 'uabb' ),
									'default' => 'bg',
									'options' => array(
										'border' => __( 'Border', 'uabb' ),
										'bg'     => __( 'Background', 'uabb' ),
									),
									'width'   => '75px',
								),
							),
						),
						'formatting' => array(
							'title'  => __( 'Structure', 'uabb' ),
							'fields' => array(
								'width'                    => array(
									'type'    => 'select',
									'label'   => __( 'Width', 'uabb' ),
									'default' => 'auto',
									'options' => array(
										'auto'   => _x( 'Auto', 'Width.', 'uabb' ),
										'full'   => __( 'Full Width', 'uabb' ),
										'custom' => __( 'Custom', 'uabb' ),
									),
									'toggle'  => array(
										'auto'   => array(
											'fields' => array( 'align', 'mob_align', 'line_height' ),
										),
										'full'   => array(
											'fields' => array( 'line_height' ),
										),
										'custom' => array(
											'fields' => array( 'align', 'mob_align', 'custom_width', 'custom_height', 'padding_top_bottom', 'padding_left_right' ),
										),
									),
								),
								'button_padding_dimension' => array(
									'type'       => 'dimension',
									'label'      => __( 'Padding', 'uabb' ),
									'slider'     => true,
									'units'      => array( 'px' ),
									'responsive' => true,
									'preview'    => array(
										'type'      => 'css',
										'selector'  => '.uabb-creative-button-wrap a',
										'property'  => 'padding',
										'unit'      => 'px',
										'important' => true,
									),
								),
								'button_border'            => array(
									'type'    => 'border',
									'label'   => __( 'Border', 'uabb' ),
									'slider'  => true,
									'units'   => array( 'px' ),
									'preview' => array(
										'type'      => 'css',
										'selector'  => '.uabb-creative-button-wrap a',
										'property'  => 'border',
										'unit'      => 'px',
										'important' => true,
									),
								),
								'border_hover_color'       => array(
									'type'        => 'color',
									'label'       => __( 'Border Hover Color', 'uabb' ),
									'default'     => '',
									'show_reset'  => true,
									'connections' => array( 'color' ),
									'show_alpha'  => true,
									'preview'     => array(
										'type' => 'none',
									),
								),
								'custom_width'             => array(
									'type'      => 'unit',
									'label'     => __( 'Custom Width', 'uabb' ),
									'default'   => '200',
									'maxlength' => '3',
									'size'      => '4',
									'units'     => array( 'px' ),
									'slider'    => true,
								),
								'custom_height'            => array(
									'type'      => 'unit',
									'label'     => __( 'Custom Height', 'uabb' ),
									'default'   => '45',
									'maxlength' => '3',
									'size'      => '4',
									'units'     => array( 'px' ),
									'slider'    => true,
								),
								'padding_top_bottom'       => array(
									'type'        => 'unit',
									'label'       => __( 'Padding Top/Bottom', 'uabb' ),
									'placeholder' => '0',
									'maxlength'   => '3',
									'size'        => '4',
									'units'       => array( 'px' ),
									'slider'      => true,
								),
								'padding_left_right'       => array(
									'type'        => 'text',
									'label'       => __( 'Padding Left/Right', 'uabb' ),
									'placeholder' => '0',
									'maxlength'   => '3',
									'size'        => '4',
									'description' => 'px',
								),
								'border_radius'            => array(
									'type'      => 'unit',
									'label'     => __( 'Round Corners', 'uabb' ),
									'maxlength' => '3',
									'size'      => '4',
									'units'     => array( 'px' ),
									'slider'    => true,
								),
								'align'                    => array(
									'type'    => 'align',
									'label'   => __( 'Alignment', 'uabb' ),
									'default' => 'center',
									'options' => array(
										'center' => __( 'Center', 'uabb' ),
										'left'   => __( 'Left', 'uabb' ),
										'right'  => __( 'Right', 'uabb' ),
									),
								),
								'mob_align'                => array(
									'type'    => 'align',
									'label'   => __( 'Mobile Alignment', 'uabb' ),
									'default' => 'center',
									'options' => array(
										'center' => __( 'Center', 'uabb' ),
										'left'   => __( 'Left', 'uabb' ),
										'right'  => __( 'Right', 'uabb' ),
									),
								),
							),
						),
					),
				),
				'creative_typography' => array(
					'title'    => __( 'Typography', 'uabb' ),
					'sections' => array(
						'typography' => array(
							'title'  => __( 'Button Settings', 'uabb' ),
							'fields' => array(
								'button_typo' => array(
									'type'       => 'typography',
									'label'      => __( 'Typography', 'uabb' ),
									'responsive' => true,
									'preview'    => array(
										'type'      => 'css',
										'selector'  => '.uabb-creative-button',
										'important' => true,
									),
								),
							),
						),
					),
				),
			),
		)
	);
}
