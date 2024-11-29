<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.2.4 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Image Separator Module
 */

FLBuilder::register_module(
	'UABBImageSeparatorModule',
	[
		'general'       => [ // Tab.
			'title'    => __( 'General', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				/* Image Basic Setting */
				'img_basic'    => [ // Section.
					'title'  => '', // Section Title.
					'fields' => [ // Section Fields.
						'photo'           => [
							'type'        => 'photo',
							'label'       => __( 'Separator Image', 'uabb' ),
							'show_remove' => true,
							'connections' => [ 'photo' ],
						],
						'img_size'        => [
							'type'        => 'text',
							'label'       => __( 'Desktop Size', 'uabb' ),
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
							'help'        => __( 'Image size cannot be more than parent size.', 'uabb' ),
						],
						'medium_img_size' => [
							'type'        => 'text',
							'label'       => __( 'Medium Device Size', 'uabb' ),
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
							'help'        => __( 'Apply image size for medium devices. It will inherit desktop size if empty.', 'uabb' ),
							'preview'     => [
								'type' => 'none',
							],
						],
						'small_img_size'  => [
							'type'        => 'text',
							'label'       => __( 'Small Device Size', 'uabb' ),
							'maxlength'   => '5',
							'size'        => '6',
							'description' => 'px',
							'help'        => __( 'Apply image size for small devices. It will inherit medium size if empty.', 'uabb' ),
							'preview'     => [
								'type' => 'none',
							],
						],
					],
				],
				/* Image Style Section */
				'img_style'    => [
					'title'  => __( 'Style', 'uabb' ),
					'fields' => [
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
									'fields'   => [ 'img_bg_size', 'img_border_style', 'img_bg_border_radius' ],
								],
							],
						],

						/* Image Background Size */
						'img_bg_size'          => [
							'type'        => 'text',
							'label'       => __( 'Background Size', 'uabb' ),
							'help'        => __( 'Spacing between Image edge & Background edge', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'description' => 'px',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-image .uabb-photo-img',
								'property' => 'padding',
								'unit'     => 'px',
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
							'type'        => 'text',
							'label'       => __( 'Border Width', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '1',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-image .uabb-photo-img',
								'property' => 'border-width',
								'unit'     => 'px',
							],
						],
						'img_bg_border_radius' => [
							'type'        => 'text',
							'label'       => __( 'Border Radius', 'uabb' ),
							'description' => 'px',
							'maxlength'   => '3',
							'size'        => '6',
							'placeholder' => '0',
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-image .uabb-photo-img',
								'property' => 'border-radius',
								'unit'     => 'px',
							],
						],
					],
				],
				/* Image Colors */
				'img_colors'   => [ // Section.
					'title'  => __( 'Colors', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						/* Background Color Dependent on Icon Style */
						'img_bg_color'           => [
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => [
								'type'     => 'css',
								'selector' => '.uabb-image .uabb-photo-img',
								'property' => 'background',
							],
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
							'type'       => 'color',
							'label'      => __( 'Background Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
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
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => [
								'type'     => 'css',
								'selector' => '.uabb-image .uabb-photo-img',
								'property' => 'border-color',
							],
						],
						'img_border_hover_color' => [
							'type'       => 'color',
							'label'      => __( 'Border Hover Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
							'preview'    => [
								'type' => 'none',
							],
						],
					],
				],
				/* Image Style Section */
				'img_stucture' => [
					'title'  => __( 'Structure', 'uabb' ),
					'fields' => [
						/* Image Position */
						'image_position'    => [
							'type'    => 'select',
							'label'   => __( 'Image Top / Bottom Position', 'uabb' ),
							'default' => 'bottom',
							'help'    => __( 'Select the position to display Image Separator', 'uabb' ),
							'options' => [
								'bottom' => __( 'Bottom', 'uabb' ),
								'top'    => __( 'Top', 'uabb' ),
							],
						],

						/* Image Gutter */
						'gutter'            => [
							'type'        => 'text',
							'label'       => __( 'Gutter', 'uabb' ),
							'placeholder' => '50',
							'help'        => __( '50% is default. Increase to push the image outside or decrease to pull the image inside.', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'description' => '%',
						],

						'image_position_lr' => [
							'type'    => 'select',
							'label'   => __( 'Image Left / Right Position', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'Select the position to display Image Separator', 'uabb' ),
							'options' => [
								'left'   => __( 'Left', 'uabb' ),
								'center' => __( 'Center', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							],
							'toggle'  => [
								'left'  => [
									'fields' => [ 'gutter_lr', 'responsive_center' ],
								],
								'right' => [
									'fields' => [ 'gutter_lr', 'responsive_center' ],
								],
							],
						],

						/* Image Gutter */
						'gutter_lr'         => [
							'type'        => 'text',
							'label'       => __( 'Value from Left / Right', 'uabb' ),
							'placeholder' => '50',
							'help'        => __( 'From left / From right', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'description' => '%',
						],

						'responsive_center' => [
							'type'    => 'select',
							'label'   => __( 'Responsive Alignment', 'uabb' ),
							'default' => 'none',
							'help'    => __( 'To view Image Separator center aligned on different devices use this setting', 'uabb' ),
							'options' => [
								'none'  => __( 'Default', 'uabb' ),
								'small' => __( 'Small Device', 'uabb' ),
								'both'  => __( 'Small & Medium Devices', 'uabb' ),
							],
						],

						/* Link Toggle */
						'enable_link'       => [
							'type'    => 'select',
							'label'   => __( 'Enable Link', 'uabb' ),
							'default' => 'no',
							'options' => [
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							],
							'toggle'  => [
								'yes' => [
									'fields' => [ 'link', 'link_target' ],
								],
							],
						],
						'link'              => [
							'type'    => 'link',
							'label'   => __( 'Link', 'uabb' ),
							'preview' => [
								'type' => 'none',
							],
						],
						'link_target'       => [
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
					],
				],
			],
		],
		'animation_tab' => [ // Tab.
			'title'    => __( 'Animation', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'anim_general' => [
					'title'  => '',
					'fields' => [
						'img_animation'         => [
							'type'    => 'select',
							'label'   => __( 'Animation', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'Choose one of the animation types for Separator.', 'uabb' ),
							'options' => [
								'no'                => __( 'No', 'uabb' ),
								'bounce'            => __( 'bounce', 'uabb' ),
								'flash'             => __( 'flash', 'uabb' ),
								'pulse'             => __( 'pulse', 'uabb' ),
								'rubberBand'        => __( 'rubberBand', 'uabb' ),
								'shake'             => __( 'shake', 'uabb' ),
								'headShake'         => __( 'headShake', 'uabb' ),
								'swing'             => __( 'swing', 'uabb' ),
								'tada'              => __( 'tada', 'uabb' ),
								'wobble'            => __( 'wobble', 'uabb' ),
								'jello'             => __( 'jello', 'uabb' ),
								'bounceIn'          => __( 'bounceIn', 'uabb' ),
								'bounceInDown'      => __( 'bounceInDown', 'uabb' ),
								'bounceInLeft'      => __( 'bounceInLeft', 'uabb' ),
								'bounceInRight'     => __( 'bounceInRight', 'uabb' ),
								'bounceInUp'        => __( 'bounceInUp', 'uabb' ),
								'fadeIn'            => __( 'fadeIn', 'uabb' ),
								'fadeInDown'        => __( 'fadeInDown', 'uabb' ),
								'fadeInDownBig'     => __( 'fadeInDownBig', 'uabb' ),
								'fadeInLeft'        => __( 'fadeInLeft', 'uabb' ),
								'fadeInLeftBig'     => __( 'fadeInLeftBig', 'uabb' ),
								'fadeInRight'       => __( 'fadeInRight', 'uabb' ),
								'fadeInRightBig'    => __( 'fadeInRightBig', 'uabb' ),
								'fadeInUp'          => __( 'fadeInUp', 'uabb' ),
								'fadeInUpBig'       => __( 'fadeInUpBig', 'uabb' ),
								'flipInX'           => __( 'flipInX', 'uabb' ),
								'flipInY'           => __( 'flipInY', 'uabb' ),
								'flipOutX'          => __( 'flipOutX', 'uabb' ),
								'flipOutY'          => __( 'flipOutY', 'uabb' ),
								'lightSpeedIn'      => __( 'lightSpeedIn', 'uabb' ),
								'rotateIn'          => __( 'rotateIn', 'uabb' ),
								'rotateInDownLeft'  => __( 'rotateInDownLeft', 'uabb' ),
								'rotateInDownRight' => __( 'rotateInDownRight', 'uabb' ),
								'rotateInUpLeft'    => __( 'rotateInUpLeft', 'uabb' ),
								'rotateInUpRight'   => __( 'rotateInUpRight', 'uabb' ),
								'rollIn'            => __( 'rollIn', 'uabb' ),
								'zoomIn'            => __( 'zoomIn', 'uabb' ),
								'zoomInDown'        => __( 'zoomInDown', 'uabb' ),
								'zoomInLeft'        => __( 'zoomInLeft', 'uabb' ),
								'zoomInRight'       => __( 'zoomInRight', 'uabb' ),
								'zoomInUp'          => __( 'zoomInUp', 'uabb' ),
								'slideInDown'       => __( 'slideInDown', 'uabb' ),
								'slideInLeft'       => __( 'slideInLeft', 'uabb' ),
								'slideInRight'      => __( 'slideInRight', 'uabb' ),
								'slideInUp'         => __( 'slideInUp', 'uabb' ),
							],
						],
						'img_animation_delay'   => [
							'type'        => 'text',
							'label'       => __( 'Animation Delay', 'uabb' ),
							'placeholder' => '0',
							'help'        => __( 'Delay the animation effect for seconds you entered.', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'description' => 'sec',
						],
						'img_animation_repeat'  => [
							'type'        => 'text',
							'label'       => __( 'Repeat Animation', 'uabb' ),
							'placeholder' => '1',
							'help'        => __( 'The animation effect will repeat to the count you enter. Enter 0 if you want to repeat it infinitely.', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'description' => 'times',
						],

						'img_viewport_position' => [
							'type'        => 'text',
							'label'       => __( 'Viewport Position', 'uabb' ),
							'placeholder' => '90',
							'help'        => __( 'The area of screen from top where animation effect will start working.', 'uabb' ),
							'maxlength'   => '3',
							'size'        => '6',
							'description' => '%',
						],
					],
				],
			],
		],
	]
);
