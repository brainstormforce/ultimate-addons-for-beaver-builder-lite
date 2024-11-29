<?php
/**
 * Register the module and its form settings for beaver builder version less than 2.2.
 * Applicable for UABB version 1.2.4 and before.
 * Converted font, text size, and text transform settings to a responsive typography setting.
 *
 * @package UABB Flip Box Module
 */

FLBuilder::register_settings_form(
	'flip_box_icon_form_field',
	[
		'title' => __( 'Icon', 'uabb' ),
		'tabs'  => [
			[
				'title'    => __( 'Image / Icon', 'uabb' ),
				'sections' => [
					'icon_basic'  => [
						'title'  => __( 'Icon Basics', 'uabb' ), // Section Title.
						'fields' => [ // Section Fields.
							'icon'      => [
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'default'     => 'ua-icon ua-icon-cog',
								'show_remove' => true,
							],
							'icon_size' => [
								'type'        => 'text',
								'label'       => __( 'Size', 'uabb' ),
								'placeholder' => '30',
								'maxlength'   => '5',
								'size'        => '6',
								'description' => 'px',
							],
						],
					],
					'icon_style'  => [
						'title'  => __( 'Style', 'uabb' ),
						'fields' => [
							/* Icon Style */
							'icon_style'            => [
								'type'    => 'select',
								'label'   => __( 'Icon Background Style', 'uabb' ),
								'default' => 'simple',
								'options' => [
									'simple' => __( 'Simple', 'uabb' ),
									'circle' => __( 'Circle Background', 'uabb' ),
									'square' => __( 'Square Background', 'uabb' ),
									'custom' => __( 'Design your own', 'uabb' ),
								],
								'toggle'  => [
									'simple' => [
										'fields' => [],
									],
									'circle' => [
										'fields' => [ 'icon_color_preset', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d' ],
									],
									'square' => [
										'fields' => [ 'icon_color_preset', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d' ],
									],
									'custom' => [
										'fields' => [ 'icon_color_preset', 'icon_border_style', 'icon_bg_color', 'icon_bg_color_opc', 'icon_bg_hover_color', 'icon_bg_hover_color_opc', 'icon_three_d', 'icon_bg_size', 'icon_bg_border_radius' ],
									],
								],
								'trigger' => [
									'custom' => [
										'fields' => [ 'icon_border_style' ],
									],
								],
							],

							/* Icon Background SIze */
							'icon_bg_size'          => [
								'type'        => 'text',
								'label'       => __( 'Background Size', 'uabb' ),
								'help'        => 'Spacing between Icon & Background edge',
								'placeholder' => '30',
								'maxlength'   => '3',
								'size'        => '6',
								'description' => 'px',
							],

							/* Border Style and Radius for Icon */
							'icon_border_style'     => [
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
										'fields' => [ 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ],
									],
									'dashed' => [
										'fields' => [ 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ],
									],
									'dotted' => [
										'fields' => [ 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ],
									],
									'double' => [
										'fields' => [ 'icon_border_width', 'icon_border_color', 'icon_border_hover_color' ],
									],
								],
							],
							'icon_border_width'     => [
								'type'        => 'text',
								'label'       => __( 'Border Width', 'uabb' ),
								'description' => 'px',
								'maxlength'   => '3',
								'size'        => '6',
								'placeholder' => '1',
							],
							'icon_bg_border_radius' => [
								'type'        => 'text',
								'label'       => __( 'Border Radius', 'uabb' ),
								'description' => 'px',
								'maxlength'   => '3',
								'size'        => '6',
								'placeholder' => '20',
							],
						],
					],
					'icon_colors' => [ // Section.
						'title'  => __( 'Colors', 'uabb' ), // Section Title.
						'fields' => [ // Section Fields.

							/* Style Options */
							'icon_color_preset' => [
								'type'    => 'select',
								'label'   => __( 'Icon Color Presets', 'uabb' ),
								'default' => 'preset1',
								'options' => [
									'preset1' => __( 'Preset 1', 'uabb' ),
									'preset2' => __( 'Preset 2', 'uabb' ),
								],
								'help'    => __( 'Preset 1 => Icon : White, Background : Theme </br>Preset 2 => Icon : Theme, Background : #f3f3f3', 'uabb' ),
							],
							/* Icon Color */
							'icon_color'        => [
								'type'       => 'color',
								'label'      => __( 'Icon Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							],

							/* Background Color Dependent on Icon Style */
							'icon_bg_color'     => [
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							],
							'icon_bg_color_opc' => [
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							],

							/* Border Color Dependent on Border Style for ICon */
							'icon_border_color' => [
								'type'       => 'color',
								'label'      => __( 'Border Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							],

							/* Gradient Color Option */
							'icon_three_d'      => [
								'type'    => 'select',
								'label'   => __( 'Gradient', 'uabb' ),
								'default' => '0',
								'options' => [
									'0' => __( 'No', 'uabb' ),
									'1' => __( 'Yes', 'uabb' ),
								],
							],
						],
					],
				],
			],
		],
	]
);

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module(
	'FlipBoxModule',
	[
		'flip_front' => [ // Tab.
			'title'    => __( 'Flip Box Front', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'title'        => [ // Section.
					'title'  => __( 'Front', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'smile_icon'  => [
							'type'         => 'form',
							'label'        => __( 'Icon Settings', 'uabb' ),
							'form'         => 'flip_box_icon_form_field', // ID of a registered form.
							'preview_text' => 'icon', // ID of a field to use for the preview text.
						],
						'title_front' => [
							'type'        => 'text',
							'label'       => __( 'Title on Front', 'uabb' ),
							'default'     => __( "Let's Flip!", 'uabb' ),
							'help'        => __( 'Perhaps, this is the most highlighted text.', 'uabb' ),
							'connections' => [ 'string', 'html' ],
						],
						'desc_front'  => [
							'type'          => 'editor',
							'media_buttons' => false,
							'rows'          => 10,
							'label'         => '',
							'default'       => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', 'uabb' ),
							'connections'   => [ 'string', 'html' ],
						],
					],
				],
				'front_styles' => [ // Section.
					'title'  => __( 'Front Styles', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'front_background_type'      => [
							'type'    => 'select',
							'label'   => __( 'Background Type', 'uabb' ),
							'default' => 'color',
							'help'    => __( 'If enabled, the Content would align vertically center.', 'uabb' ),
							'options' => [
								'color' => __( 'Color', 'uabb' ),
								'image' => __( 'Image', 'uabb' ),
							],
							'toggle'  => [
								'color' => [
									'fields' => [ 'front_background_color' ],
								],
								'image' => [
									'fields' => [ 'front_bg_image', 'front_bg_image_repeat', 'front_bg_image_display', 'front_bg_image_pos' ],
								],
							],
						],
						'front_bg_image'             => [
							'type'        => 'photo',
							'label'       => __( 'Background Image', 'uabb' ),
							'show_remove' => true,
						],
						'front_bg_image_pos'         => [
							'type'    => 'select',
							'label'   => __( 'Background Image Position', 'uabb' ),
							'default' => 'center center',
							'options' => [
								'left top'      => __( 'Left Top', 'uabb' ),
								'left center'   => __( 'Left Center', 'uabb' ),
								'left bottom'   => __( 'Left Bottom', 'uabb' ),
								'center top'    => __( 'Center Top', 'uabb' ),
								'center center' => __( 'Center Center', 'uabb' ),
								'center bottom' => __( 'Center Bottom', 'uabb' ),
								'right top'     => __( 'Right Top', 'uabb' ),
								'right center'  => __( 'Right Center', 'uabb' ),
								'right bottom'  => __( 'Right Bottom', 'uabb' ),
							],
						],
						'front_bg_image_repeat'      => [
							'type'    => 'select',
							'label'   => __( 'Repeat', 'uabb' ),
							'default' => 'no',
							'options' => [
								'yes' => 'Yes',
								'no'  => 'No',
							],
						],
						'front_bg_image_display'     => [
							'type'    => 'select',
							'label'   => __( 'Display Sizes', 'uabb' ),
							'default' => 'cover',
							'options' => [
								'initial' => __( 'Initial', 'uabb' ),
								'cover'   => __( 'Cover', 'uabb' ),
								'contain' => __( 'Contain', 'uabb' ),
							],
						],
						'front_background_color'     => [
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'front_background_color_opc' => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],
						'front_box_border_style'     => [
							'type'    => 'select',
							'label'   => __( 'Box Border Style', 'uabb' ),
							'default' => 'solid',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => [
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
								'inset'  => __( 'Inset', 'uabb' ),
								'outset' => __( 'Outset', 'uabb' ),
							],
							'toggle'  => [
								'none'   => [
									'fields' => [],
								],
								'solid'  => [
									'fields' => [ 'front_border_size', 'front_border_color' ],
								],
								'dashed' => [
									'fields' => [ 'front_border_size', 'front_border_color' ],
								],
								'dotted' => [
									'fields' => [ 'front_border_size', 'front_border_color' ],
								],
								'double' => [
									'fields' => [ 'front_border_size', 'front_border_color' ],
								],
								'inset'  => [
									'fields' => [ 'front_border_size', 'front_border_color' ],
								],
								'outset' => [
									'fields' => [ 'front_border_size', 'front_border_color' ],
								],
							],
						],
						'front_border_size'          => [
							'type'        => 'text',
							'label'       => __( 'Border Size', 'uabb' ),
							'placeholder' => '1',
							'size'        => '8',
							'class'       => '',
							'description' => 'px',
							'help'        => __( 'Enter value in pixels.', 'uabb' ),
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-front',
								'property' => 'border-width',
								'unit'     => 'px',
							],
						],
						'front_border_color'         => [
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'dbdbdb',
							'show_reset' => true,
						],
					],
				],
			],
		],
		'flip_back'  => [ // Tab.
			'title'    => __( 'Flip Box Back', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'title'       => [ // Section.
					'title'  => __( 'Back', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'title_back' => [
							'type'    => 'text',
							'label'   => __( 'Title on Back', 'uabb' ),
							'default' => __( 'Cool!', 'uabb' ),
							'help'    => __( 'Perhaps, this is the most highlighted text.', 'uabb' ),
						],
						'desc_back'  => [
							'type'          => 'editor',
							'media_buttons' => false,
							'rows'          => 10,
							'label'         => '',
							'default'       => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'uabb' ),
						],
					],
				],
				'back_styles' => [ // Section.
					'title'  => __( 'Back Styles', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'back_background_type'      => [
							'type'    => 'select',
							'label'   => __( 'Background Type', 'uabb' ),
							'default' => 'color',
							'help'    => __( 'If enabled, the Content would align vertically center.', 'uabb' ),
							'options' => [
								'color' => __( 'Color', 'uabb' ),
								'image' => __( 'Image', 'uabb' ),
							],
							'toggle'  => [
								'color' => [
									'fields' => [ 'back_background_color', 'back_background_color_opc' ],
								],
								'image' => [
									'fields' => [ 'back_bg_image', 'back_bg_image_repeat', 'back_bg_image_display', 'back_bg_image_pos' ],
								],
							],
						],
						'back_bg_image'             => [
							'type'        => 'photo',
							'label'       => __( 'Background Image', 'uabb' ),
							'show_remove' => true,
						],
						'back_bg_image_pos'         => [
							'type'    => 'select',
							'label'   => __( 'Background Image Position', 'uabb' ),
							'default' => 'center center',
							'options' => [
								'left top'      => __( 'Left Top', 'uabb' ),
								'left center'   => __( 'Left Center', 'uabb' ),
								'left bottom'   => __( 'Left Bottom', 'uabb' ),
								'center top'    => __( 'Center Top', 'uabb' ),
								'center center' => __( 'Center Center', 'uabb' ),
								'center bottom' => __( 'Center Bottom', 'uabb' ),
								'right top'     => __( 'Right Top', 'uabb' ),
								'right center'  => __( 'Right Center', 'uabb' ),
								'right bottom'  => __( 'Right Bottom', 'uabb' ),
							],
						],
						'back_bg_image_repeat'      => [
							'type'    => 'select',
							'label'   => __( 'Repeat', 'uabb' ),
							'default' => 'no',
							'options' => [
								'yes' => 'Yes',
								'no'  => 'No',
							],
						],
						'back_bg_image_display'     => [
							'type'    => 'select',
							'label'   => __( 'Display Sizes', 'uabb' ),
							'default' => 'cover',
							'options' => [
								'initial' => __( 'Initial', 'uabb' ),
								'cover'   => __( 'Cover', 'uabb' ),
								'contain' => __( 'Contain', 'uabb' ),
							],
						],
						'back_background_color'     => [
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'back_background_color_opc' => [
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						],
						'back_box_border_style'     => [
							'type'    => 'select',
							'label'   => __( 'Box Border Style', 'uabb' ),
							'default' => 'solid',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => [
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
								'inset'  => __( 'Inset', 'uabb' ),
								'outset' => __( 'Outset', 'uabb' ),
							],
							'toggle'  => [
								'none'   => [
									'fields' => [],
								],
								'solid'  => [
									'fields' => [ 'back_border_size', 'back_border_color' ],
								],
								'dashed' => [
									'fields' => [ 'back_border_size', 'back_border_color' ],
								],
								'dotted' => [
									'fields' => [ 'back_border_size', 'back_border_color' ],
								],
								'double' => [
									'fields' => [ 'back_border_size', 'back_border_color' ],
								],
								'inset'  => [
									'fields' => [ 'back_border_size', 'back_border_color' ],
								],
								'outset' => [
									'fields' => [ 'back_border_size', 'back_border_color' ],
								],
							],

						],
						'back_border_size'          => [
							'type'        => 'text',
							'label'       => __( 'Border Size', 'uabb' ),
							'placeholder' => '1',
							'size'        => '8',
							'class'       => '',
							'description' => 'px',
							'help'        => __( 'Enter value in pixels.', 'uabb' ),
							'preview'     => [
								'type'     => 'css',
								'selector' => '.uabb-back',
								'property' => 'border-width',
								'unit'     => 'px',
							],
						],
						'back_border_color'         => [
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'dbdbdb',
							'show_reset' => true,
						],
					],
				],
				'button'      => [ // Section.
					'title'  => __( 'Button', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'show_button' => [
							'type'    => 'select',
							'label'   => __( 'Show button', 'uabb' ),
							'default' => 'no',
							'options' => [
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							],
							'toggle'  => [
								'no'  => [
									'fields' => [],
								],
								'yes' => [
									'fields' => [ 'button', 'button_margin_top', 'button_margin_bottom' ],
								],
							],
						],
						'button'      => [
							'type'         => 'form',
							'label'        => __( 'Button Settings', 'uabb' ),
							'form'         => 'button_form_field', // ID of a registered form.
							'preview_text' => 'text', // ID of a field to use for the preview text.
						],
					],
				],
			],
		],
		'style'      => [ // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'general' => [ // Section.
					'title'  => __( 'Flipbox Styles', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'flip_type'                   => [
							'type'    => 'select',
							'label'   => __( 'Flip Type', 'uabb' ),
							'default' => 'horizontal_flip_left',
							'help'    => __( 'Select Flip type for this flip box.', 'uabb' ),
							'options' => [
								'horizontal_flip_left'  => __( 'Flip Horizontally From Left', 'uabb' ),
								'horizontal_flip_right' => __( 'Flip Horizontally From Right', 'uabb' ),
								'vertical_flip_top'     => __( 'Flip Vertically From Top', 'uabb' ),
								'vertical_flip_bottom'  => __( 'Flip Vertically From Bottom', 'uabb' ),
							],
						],
						'flip_box_min_height_options' => [
							'type'    => 'select',
							'label'   => __( 'Box Height', 'uabb' ),
							'default' => 'uabb-jq-height',
							'options' => [
								'uabb-jq-height'     => __( 'Display full content and adjust height of box accordingly', 'uabb' ),
								'uabb-custom-height' => __( 'Give a custom height of your choice to the box', 'uabb' ),
							],
							'toggle'  => [
								'uabb-jq-height'     => [
									'fields' => [],
								],
								'uabb-custom-height' => [
									'fields' => [ 'flip_box_min_height', 'flip_box_min_height_medium', 'flip_box_min_height_small', 'responsive_compatibility' ],
								],
							],
						],
						'flip_box_min_height'         => [
							'type'        => 'text',
							'label'       => __( 'Desktop Height', 'uabb' ),
							'placeholder' => '300',
							'description' => 'px',
							'size'        => '8',
							'help'        => __( 'Apply height to complete Flipbox. It is useful when multiple Flipboxes are in same row.', 'uabb' ),
						],
						'flip_box_min_height_medium'  => [
							'type'        => 'text',
							'label'       => __( 'Medium Device Height', 'uabb' ),
							'description' => 'px',
							'size'        => '8',
							'help'        => __( 'Apply height to complete Flipbox for medium devices. It will inherit desktop height if empty.', 'uabb' ),
						],
						'flip_box_min_height_small'   => [
							'type'        => 'text',
							'label'       => __( 'Small Device Height', 'uabb' ),
							'description' => 'px',
							'size'        => '8',
							'help'        => __( 'Apply height to complete Flipbox for small devices. It will inherit medium height if empty.', 'uabb' ),
						],
						'responsive_compatibility'    => [
							'type'    => 'select',
							'label'   => __( 'Responsive Compatibility', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'If enabled your Flip Box would automatically manage its height for small devices.', 'uabb' ),
							'options' => [
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							],
						],
						'display_vertically_center'   => [
							'type'    => 'select',
							'label'   => __( 'Overall Vertical Alignment', 'uabb' ),
							'default' => 'vertical-middle',
							'help'    => __( 'If enabled, the Content would align vertically center.', 'uabb' ),
							'options' => [
								'vertical-middle' => __( 'Yes', 'uabb' ),
								'no'              => __( 'No', 'uabb' ),
							],
						],
						'inner_padding_dimension'     => [
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'help'        => __( 'Manage the outside spacing of content area of flipbox.', 'uabb' ),
							'description' => 'px',
							'responsive'  => [
								'placeholder' => [
									'default'    => '15',
									'medium'     => '',
									'responsive' => '',
								],
							],
						],
					],
				],
			],
		],
		'typography' => [ // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => [ // Tab Sections.
				'front_title_typography' => [
					'title'  => __( 'Front Title', 'uabb' ),
					'fields' => [
						'front_title_typography_tag_selection' => [
							'type'     => 'select',
							'label'    => __( 'Title Tag', 'uabb' ),
							'default'  => 'h2',
							'sanitize' => [ 'FLBuilderUtils::esc_tags', 'h2' ],
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
						'front_title_typography_font_family' => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-face-text-title',
							],
						],
						'front_title_typography_font_size_unit' => [
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
								'selector' => '.uabb-face-text-title',
								'property' => 'font-size',
								'unit'     => 'px',
							],
						],
						'front_title_typography_line_height_unit' => [
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
								'selector' => '.uabb-face-text-title',
								'property' => 'line-height',
								'unit'     => 'em',
							],
						],
						'front_title_typography_color' => [
							'type'       => 'color',
							'label'      => __( 'Front Title Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'front_title_typography_margin_top' => [
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '0',
							'description' => 'px',
							'size'        => '8',
						],
						'front_title_typography_margin_bottom' => [
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '12',
							'description' => 'px',
							'size'        => '8',
						],
					],
				],
				'front_desc_typography'  => [
					'title'  => __( 'Front Description', 'uabb' ),
					'fields' => [
						'front_desc_typography_font_family' => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-flip-box-section-content',
							],
						],
						'front_desc_typography_font_size_unit' => [
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
								'selector' => '.uabb-flip-box-section-content',
								'property' => 'font-size',
								'unit'     => 'px',
							],
						],
						'front_desc_typography_line_height_unit' => [
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
								'selector' => '.uabb-flip-box-section-content',
								'property' => 'line-height',
								'unit'     => 'em',
							],
						],
						'front_desc_typography_color'      => [
							'type'       => 'color',
							'label'      => __( 'Front Description Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'front_desc_typography_margin_top' => [
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '0',
							'description' => 'px',
							'size'        => '8',
						],
						'front_desc_typography_margin_bottom' => [
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '25',
							'description' => 'px',
							'size'        => '8',
						],
					],
				],
				'back_title_typography'  => [
					'title'  => __( 'Back Title', 'uabb' ),
					'fields' => [
						'back_title_typography_tag_selection' => [
							'type'     => 'select',
							'label'    => __( 'Title Tag', 'uabb' ),
							'default'  => 'h2',
							'sanitize' => [ 'FLBuilderUtils::esc_tags', 'h2' ],
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
						'back_title_typography_font_family' => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-back-text-title',
							],
						],
						'back_title_typography_font_size_unit' => [
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
								'selector' => '.uabb-back-text-title',
								'property' => 'font-size',
								'unit'     => 'px',
							],
						],
						'back_title_typography_line_height_unit' => [
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
								'selector' => '.uabb-back-text-title',
								'property' => 'line-height',
								'unit'     => 'em',
							],
						],
						'back_title_typography_color'      => [
							'type'       => 'color',
							'label'      => __( 'Back Title Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'back_title_typography_margin_top' => [
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '25',
							'description' => 'px',
							'size'        => '8',
						],
						'back_title_typography_margin_bottom' => [
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '12',
							'description' => 'px',
							'size'        => '8',
						],
					],
				],
				'back_desc_typography'   => [
					'title'  => __( 'Back Description', 'uabb' ),
					'fields' => [
						'back_desc_typography_font_family' => [
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => [
								'family' => 'Default',
								'weight' => 'Default',
							],
							'preview' => [
								'type'     => 'font',
								'selector' => '.uabb-back-flip-box-section-content',
							],
						],
						'back_desc_typography_font_size_unit' => [
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
								'selector' => '.uabb-back-flip-box-section-content',
								'property' => 'font-size',
								'unit'     => 'px',
							],
						],
						'back_desc_typography_line_height_unit' => [
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
								'selector' => '.uabb-back-flip-box-section-content',
								'property' => 'line-height',
								'unit'     => 'em',
							],
						],
						'back_desc_typography_color'       => [
							'type'       => 'color',
							'label'      => __( 'Back Description Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						],
						'back_desc_typography_margin_top'  => [
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '0',
							'description' => 'px',
							'size'        => '8',
						],
						'back_desc_typography_margin_bottom' => [
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '0',
							'description' => 'px',
							'size'        => '8',
						],
					],
				],
				'margin_options'         => [ // Section.
					'title'  => __( 'Margin', 'uabb' ), // Section Title.
					'fields' => [ // Section Fields.
						'icon_margin_top'      => [
							'type'        => 'text',
							'label'       => __( 'Icon Margin Top', 'uabb' ),
							'placeholder' => '25',
							'description' => 'px',
							'size'        => '8',
						],
						'icon_margin_bottom'   => [
							'type'        => 'text',
							'label'       => __( 'Icon Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'description' => 'px',
							'size'        => '8',
						],
						'button_margin_top'    => [
							'type'        => 'text',
							'label'       => __( 'Button Margin Top', 'uabb' ),
							'placeholder' => '15',
							'description' => 'px',
							'size'        => '8',
						],
						'button_margin_bottom' => [
							'type'        => 'text',
							'label'       => __( 'Button Margin Bottom', 'uabb' ),
							'placeholder' => '0',
							'description' => 'px',
							'size'        => '8',
						],
					],
				],
			],
		],
	]
);
