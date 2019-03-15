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
	array(
		'title' => __( 'Icon', 'uabb' ),
		'tabs'  => array(
			array(
				'title'    => __( 'Image / Icon', 'uabb' ),
				'sections' => array(
					'icon_basic'  => array(
						'title'  => __( 'Icon Basics', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.
							'icon'      => array(
								'type'        => 'icon',
								'label'       => __( 'Icon', 'uabb' ),
								'default'     => 'ua-icon ua-icon-cog',
								'show_remove' => true,
							),
							'icon_size' => array(
								'type'        => 'text',
								'label'       => __( 'Size', 'uabb' ),
								'placeholder' => '30',
								'maxlength'   => '5',
								'size'        => '6',
								'description' => 'px',
							),
						),
					),
					'icon_style'  => array(
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
								'type'        => 'text',
								'label'       => __( 'Background Size', 'uabb' ),
								'help'        => 'Spacing between Icon & Background edge',
								'placeholder' => '30',
								'maxlength'   => '3',
								'size'        => '6',
								'description' => 'px',
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
								'type'        => 'text',
								'label'       => __( 'Border Width', 'uabb' ),
								'description' => 'px',
								'maxlength'   => '3',
								'size'        => '6',
								'placeholder' => '1',
							),
							'icon_bg_border_radius' => array(
								'type'        => 'text',
								'label'       => __( 'Border Radius', 'uabb' ),
								'description' => 'px',
								'maxlength'   => '3',
								'size'        => '6',
								'placeholder' => '20',
							),
						),
					),
					'icon_colors' => array( // Section.
						'title'  => __( 'Colors', 'uabb' ), // Section Title.
						'fields' => array( // Section Fields.

							/* Style Options */
							'icon_color_preset' => array(
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
							'icon_color'        => array(
								'type'       => 'color',
								'label'      => __( 'Icon Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),

							/* Background Color Dependent on Icon Style **/
							'icon_bg_color'     => array(
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),
							'icon_bg_color_opc' => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),

							/* Border Color Dependent on Border Style for ICon */
							'icon_border_color' => array(
								'type'       => 'color',
								'label'      => __( 'Border Color', 'uabb' ),
								'default'    => '',
								'show_reset' => true,
							),

							/* Gradient Color Option */
							'icon_three_d'      => array(
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
		),
	)
);

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module(
	'FlipBoxModule',
	array(
		'flip_front' => array( // Tab.
			'title'    => __( 'Flip Box Front', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title'        => array( // Section.
					'title'  => __( 'Front', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'smile_icon'  => array(
							'type'         => 'form',
							'label'        => __( 'Icon Settings', 'uabb' ),
							'form'         => 'flip_box_icon_form_field', // ID of a registered form.
							'preview_text' => 'icon', // ID of a field to use for the preview text.
						),
						'title_front' => array(
							'type'        => 'text',
							'label'       => __( 'Title on Front', 'uabb' ),
							'default'     => __( "Let's Flip!", 'uabb' ),
							'help'        => __( 'Perhaps, this is the most highlighted text.', 'uabb' ),
							'connections' => array( 'string', 'html' ),
						),
						'desc_front'  => array(
							'type'          => 'editor',
							'media_buttons' => false,
							'rows'          => 10,
							'label'         => '',
							'default'       => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', 'uabb' ),
							'connections'   => array( 'string', 'html' ),
						),
					),
				),
				'front_styles' => array( // Section.
					'title'  => __( 'Front Styles', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'front_background_type'      => array(
							'type'    => 'select',
							'label'   => __( 'Background Type', 'uabb' ),
							'default' => 'color',
							'help'    => __( 'If enabled, the Content would align vertically center.', 'uabb' ),
							'options' => array(
								'color' => __( 'Color', 'uabb' ),
								'image' => __( 'Image', 'uabb' ),
							),
							'toggle'  => array(
								'color' => array(
									'fields' => array( 'front_background_color' ),
								),
								'image' => array(
									'fields' => array( 'front_bg_image', 'front_bg_image_repeat', 'front_bg_image_display', 'front_bg_image_pos' ),
								),
							),
						),
						'front_bg_image'             => array(
							'type'        => 'photo',
							'label'       => __( 'Background Image', 'uabb' ),
							'show_remove' => true,
						),
						'front_bg_image_pos'         => array(
							'type'    => 'select',
							'label'   => __( 'Background Image Position', 'uabb' ),
							'default' => 'center center',
							'options' => array(
								'left top'      => __( 'Left Top', 'uabb' ),
								'left center'   => __( 'Left Center', 'uabb' ),
								'left bottom'   => __( 'Left Bottom', 'uabb' ),
								'center top'    => __( 'Center Top', 'uabb' ),
								'center center' => __( 'Center Center', 'uabb' ),
								'center bottom' => __( 'Center Bottom', 'uabb' ),
								'right top'     => __( 'Right Top', 'uabb' ),
								'right center'  => __( 'Right Center', 'uabb' ),
								'right bottom'  => __( 'Right Bottom', 'uabb' ),
							),
						),
						'front_bg_image_repeat'      => array(
							'type'    => 'select',
							'label'   => __( 'Repeat', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => 'Yes',
								'no'  => 'No',
							),
						),
						'front_bg_image_display'     => array(
							'type'    => 'select',
							'label'   => __( 'Display Sizes', 'uabb' ),
							'default' => 'cover',
							'options' => array(
								'initial' => __( 'Initial', 'uabb' ),
								'cover'   => __( 'Cover', 'uabb' ),
								'contain' => __( 'Contain', 'uabb' ),
							),
						),
						'front_background_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'front_background_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'front_box_border_style'     => array(
							'type'    => 'select',
							'label'   => __( 'Box Border Style', 'uabb' ),
							'default' => 'solid',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
								'inset'  => __( 'Inset', 'uabb' ),
								'outset' => __( 'Outset', 'uabb' ),
							),
							'toggle'  => array(
								'none'   => array(
									'fields' => array(),
								),
								'solid'  => array(
									'fields' => array( 'front_border_size', 'front_border_color' ),
								),
								'dashed' => array(
									'fields' => array( 'front_border_size', 'front_border_color' ),
								),
								'dotted' => array(
									'fields' => array( 'front_border_size', 'front_border_color' ),
								),
								'double' => array(
									'fields' => array( 'front_border_size', 'front_border_color' ),
								),
								'inset'  => array(
									'fields' => array( 'front_border_size', 'front_border_color' ),
								),
								'outset' => array(
									'fields' => array( 'front_border_size', 'front_border_color' ),
								),
							),
						),
						'front_border_size'          => array(
							'type'        => 'text',
							'label'       => __( 'Border Size', 'uabb' ),
							'placeholder' => '1',
							'size'        => '8',
							'class'       => '',
							'description' => 'px',
							'help'        => __( 'Enter value in pixels.', 'uabb' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-front',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'front_border_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'dbdbdb',
							'show_reset' => true,
						),
					),
				),
			),
		),
		'flip_back'  => array( // Tab.
			'title'    => __( 'Flip Box Back', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'title'       => array( // Section.
					'title'  => __( 'Back', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'title_back' => array(
							'type'    => 'text',
							'label'   => __( 'Title on Back', 'uabb' ),
							'default' => __( 'Cool!', 'uabb' ),
							'help'    => __( 'Perhaps, this is the most highlighted text.', 'uabb' ),
						),
						'desc_back'  => array(
							'type'          => 'editor',
							'media_buttons' => false,
							'rows'          => 10,
							'label'         => '',
							'default'       => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'uabb' ),
						),
					),
				),
				'back_styles' => array( // Section.
					'title'  => __( 'Back Styles', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'back_background_type'      => array(
							'type'    => 'select',
							'label'   => __( 'Background Type', 'uabb' ),
							'default' => 'color',
							'help'    => __( 'If enabled, the Content would align vertically center.', 'uabb' ),
							'options' => array(
								'color' => __( 'Color', 'uabb' ),
								'image' => __( 'Image', 'uabb' ),
							),
							'toggle'  => array(
								'color' => array(
									'fields' => array( 'back_background_color', 'back_background_color_opc' ),
								),
								'image' => array(
									'fields' => array( 'back_bg_image', 'back_bg_image_repeat', 'back_bg_image_display', 'back_bg_image_pos' ),
								),
							),
						),
						'back_bg_image'             => array(
							'type'        => 'photo',
							'label'       => __( 'Background Image', 'uabb' ),
							'show_remove' => true,
						),
						'back_bg_image_pos'         => array(
							'type'    => 'select',
							'label'   => __( 'Background Image Position', 'uabb' ),
							'default' => 'center center',
							'options' => array(
								'left top'      => __( 'Left Top', 'uabb' ),
								'left center'   => __( 'Left Center', 'uabb' ),
								'left bottom'   => __( 'Left Bottom', 'uabb' ),
								'center top'    => __( 'Center Top', 'uabb' ),
								'center center' => __( 'Center Center', 'uabb' ),
								'center bottom' => __( 'Center Bottom', 'uabb' ),
								'right top'     => __( 'Right Top', 'uabb' ),
								'right center'  => __( 'Right Center', 'uabb' ),
								'right bottom'  => __( 'Right Bottom', 'uabb' ),
							),
						),
						'back_bg_image_repeat'      => array(
							'type'    => 'select',
							'label'   => __( 'Repeat', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'yes' => 'Yes',
								'no'  => 'No',
							),
						),
						'back_bg_image_display'     => array(
							'type'    => 'select',
							'label'   => __( 'Display Sizes', 'uabb' ),
							'default' => 'cover',
							'options' => array(
								'initial' => __( 'Initial', 'uabb' ),
								'cover'   => __( 'Cover', 'uabb' ),
								'contain' => __( 'Contain', 'uabb' ),
							),
						),
						'back_background_color'     => array(
							'type'       => 'color',
							'label'      => __( 'Background Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'back_background_color_opc' => array(
							'type'        => 'text',
							'label'       => __( 'Opacity', 'uabb' ),
							'default'     => '',
							'description' => '%',
							'maxlength'   => '3',
							'size'        => '5',
						),
						'back_box_border_style'     => array(
							'type'    => 'select',
							'label'   => __( 'Box Border Style', 'uabb' ),
							'default' => 'solid',
							'help'    => __( 'The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'solid'  => __( 'Solid', 'uabb' ),
								'dashed' => __( 'Dashed', 'uabb' ),
								'dotted' => __( 'Dotted', 'uabb' ),
								'double' => __( 'Double', 'uabb' ),
								'inset'  => __( 'Inset', 'uabb' ),
								'outset' => __( 'Outset', 'uabb' ),
							),
							'toggle'  => array(
								'none'   => array(
									'fields' => array(),
								),
								'solid'  => array(
									'fields' => array( 'back_border_size', 'back_border_color' ),
								),
								'dashed' => array(
									'fields' => array( 'back_border_size', 'back_border_color' ),
								),
								'dotted' => array(
									'fields' => array( 'back_border_size', 'back_border_color' ),
								),
								'double' => array(
									'fields' => array( 'back_border_size', 'back_border_color' ),
								),
								'inset'  => array(
									'fields' => array( 'back_border_size', 'back_border_color' ),
								),
								'outset' => array(
									'fields' => array( 'back_border_size', 'back_border_color' ),
								),
							),

						),
						'back_border_size'          => array(
							'type'        => 'text',
							'label'       => __( 'Border Size', 'uabb' ),
							'placeholder' => '1',
							'size'        => '8',
							'class'       => '',
							'description' => 'px',
							'help'        => __( 'Enter value in pixels.', 'uabb' ),
							'preview'     => array(
								'type'     => 'css',
								'selector' => '.uabb-back',
								'property' => 'border-width',
								'unit'     => 'px',
							),
						),
						'back_border_color'         => array(
							'type'       => 'color',
							'label'      => __( 'Border Color', 'uabb' ),
							'default'    => 'dbdbdb',
							'show_reset' => true,
						),
					),
				),
				'button'      => array( // Section.
					'title'  => __( 'Button', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'show_button' => array(
							'type'    => 'select',
							'label'   => __( 'Show button', 'uabb' ),
							'default' => 'no',
							'options' => array(
								'no'  => __( 'No', 'uabb' ),
								'yes' => __( 'Yes', 'uabb' ),
							),
							'toggle'  => array(
								'no'  => array(
									'fields' => array(),
								),
								'yes' => array(
									'fields' => array( 'button', 'button_margin_top', 'button_margin_bottom' ),
								),
							),
						),
						'button'      => array(
							'type'         => 'form',
							'label'        => __( 'Button Settings', 'uabb' ),
							'form'         => 'button_form_field', // ID of a registered form.
							'preview_text' => 'text', // ID of a field to use for the preview text.
						),
					),
				),
			),
		),
		'style'      => array( // Tab.
			'title'    => __( 'Style', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general' => array( // Section.
					'title'  => __( 'Flipbox Styles', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'flip_type'                   => array(
							'type'    => 'select',
							'label'   => __( 'Flip Type', 'uabb' ),
							'default' => 'horizontal_flip_left',
							'help'    => __( 'Select Flip type for this flip box.', 'uabb' ),
							'options' => array(
								'horizontal_flip_left'  => __( 'Flip Horizontally From Left', 'uabb' ),
								'horizontal_flip_right' => __( 'Flip Horizontally From Right', 'uabb' ),
								'vertical_flip_top'     => __( 'Flip Vertically From Top', 'uabb' ),
								'vertical_flip_bottom'  => __( 'Flip Vertically From Bottom', 'uabb' ),
							),
						),
						'flip_box_min_height_options' => array(
							'type'    => 'select',
							'label'   => __( 'Box Height', 'uabb' ),
							'default' => 'uabb-jq-height',
							'options' => array(
								'uabb-jq-height'     => __( 'Display full content and adjust height of box accordingly', 'uabb' ),
								'uabb-custom-height' => __( 'Give a custom height of your choice to the box', 'uabb' ),
							),
							'toggle'  => array(
								'uabb-jq-height'     => array(
									'fields' => array(),
								),
								'uabb-custom-height' => array(
									'fields' => array( 'flip_box_min_height', 'flip_box_min_height_medium', 'flip_box_min_height_small', 'responsive_compatibility' ),
								),
							),
						),
						'flip_box_min_height'         => array(
							'type'        => 'text',
							'label'       => __( 'Desktop Height', 'uabb' ),
							'placeholder' => '300',
							'description' => 'px',
							'size'        => '8',
							'help'        => __( 'Apply height to complete Flipbox. It is useful when multiple Flipboxes are in same row.', 'uabb' ),
						),
						'flip_box_min_height_medium'  => array(
							'type'        => 'text',
							'label'       => __( 'Medium Device Height', 'uabb' ),
							'description' => 'px',
							'size'        => '8',
							'help'        => __( 'Apply height to complete Flipbox for medium devices. It will inherit desktop height if empty.', 'uabb' ),
						),
						'flip_box_min_height_small'   => array(
							'type'        => 'text',
							'label'       => __( 'Small Device Height', 'uabb' ),
							'description' => 'px',
							'size'        => '8',
							'help'        => __( 'Apply height to complete Flipbox for small devices. It will inherit medium height if empty.', 'uabb' ),
						),
						'responsive_compatibility'    => array(
							'type'    => 'select',
							'label'   => __( 'Responsive Compatibility', 'uabb' ),
							'default' => 'no',
							'help'    => __( 'If enabled your Flip Box would automatically manage its height for small devices.', 'uabb' ),
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
						'display_vertically_center'   => array(
							'type'    => 'select',
							'label'   => __( 'Overall Vertical Alignment', 'uabb' ),
							'default' => 'vertical-middle',
							'help'    => __( 'If enabled, the Content would align vertically center.', 'uabb' ),
							'options' => array(
								'vertical-middle' => __( 'Yes', 'uabb' ),
								'no'              => __( 'No', 'uabb' ),
							),
						),
						'inner_padding_dimension'     => array(
							'type'        => 'dimension',
							'label'       => __( 'Padding', 'uabb' ),
							'help'        => __( 'Manage the outside spacing of content area of flipbox.', 'uabb' ),
							'description' => 'px',
							'responsive'  => array(
								'placeholder' => array(
									'default'    => '15',
									'medium'     => '',
									'responsive' => '',
								),
							),
						),
					),
				),
			),
		),
		'typography' => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'front_title_typography' => array(
					'title'  => __( 'Front Title', 'uabb' ),
					'fields' => array(
						'front_title_typography_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Title Tag', 'uabb' ),
							'default' => 'h2',
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
						'front_title_typography_font_family' => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-face-text-title',
							),
						),
						'front_title_typography_font_size_unit' => array(
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
								'selector' => '.uabb-face-text-title',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'front_title_typography_line_height_unit' => array(
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
								'selector' => '.uabb-face-text-title',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'front_title_typography_color' => array(
							'type'       => 'color',
							'label'      => __( 'Front Title Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'front_title_typography_margin_top' => array(
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '0',
							'description' => 'px',
							'size'        => '8',
						),
						'front_title_typography_margin_bottom' => array(
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '12',
							'description' => 'px',
							'size'        => '8',
						),
					),
				),
				'front_desc_typography'  => array(
					'title'  => __( 'Front Description', 'uabb' ),
					'fields' => array(
						'front_desc_typography_font_family' => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-flip-box-section-content',
							),
						),
						'front_desc_typography_font_size_unit' => array(
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
								'selector' => '.uabb-flip-box-section-content',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'front_desc_typography_line_height_unit' => array(
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
								'selector' => '.uabb-flip-box-section-content',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'front_desc_typography_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Front Description Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'front_desc_typography_margin_top' => array(
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '0',
							'description' => 'px',
							'size'        => '8',
						),
						'front_desc_typography_margin_bottom' => array(
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '25',
							'description' => 'px',
							'size'        => '8',
						),
					),
				),
				'back_title_typography'  => array(
					'title'  => __( 'Back Title', 'uabb' ),
					'fields' => array(
						'back_title_typography_tag_selection' => array(
							'type'    => 'select',
							'label'   => __( 'Title Tag', 'uabb' ),
							'default' => 'h2',
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
						'back_title_typography_font_family' => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-back-text-title',
							),
						),
						'back_title_typography_font_size_unit' => array(
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
								'selector' => '.uabb-back-text-title',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'back_title_typography_line_height_unit' => array(
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
								'selector' => '.uabb-back-text-title',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'back_title_typography_color'      => array(
							'type'       => 'color',
							'label'      => __( 'Back Title Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'back_title_typography_margin_top' => array(
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '25',
							'description' => 'px',
							'size'        => '8',
						),
						'back_title_typography_margin_bottom' => array(
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '12',
							'description' => 'px',
							'size'        => '8',
						),
					),
				),
				'back_desc_typography'   => array(
					'title'  => __( 'Back Description', 'uabb' ),
					'fields' => array(
						'back_desc_typography_font_family' => array(
							'type'    => 'font',
							'label'   => __( 'Font Family', 'uabb' ),
							'default' => array(
								'family' => 'Default',
								'weight' => 'Default',
							),
							'preview' => array(
								'type'     => 'font',
								'selector' => '.uabb-back-flip-box-section-content',
							),
						),
						'back_desc_typography_font_size_unit' => array(
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
								'selector' => '.uabb-back-flip-box-section-content',
								'property' => 'font-size',
								'unit'     => 'px',
							),
						),
						'back_desc_typography_line_height_unit' => array(
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
								'selector' => '.uabb-back-flip-box-section-content',
								'property' => 'line-height',
								'unit'     => 'em',
							),
						),
						'back_desc_typography_color'       => array(
							'type'       => 'color',
							'label'      => __( 'Back Description Color', 'uabb' ),
							'default'    => '',
							'show_reset' => true,
						),
						'back_desc_typography_margin_top'  => array(
							'type'        => 'text',
							'label'       => __( 'Margin Top', 'uabb' ),
							'placeholder' => '0',
							'description' => 'px',
							'size'        => '8',
						),
						'back_desc_typography_margin_bottom' => array(
							'type'        => 'text',
							'label'       => __( 'Margin Bottom', 'uabb' ),
							'placeholder' => '0',
							'description' => 'px',
							'size'        => '8',
						),
					),
				),
				'margin_options'         => array( // Section.
					'title'  => __( 'Margin', 'uabb' ), // Section Title.
					'fields' => array( // Section Fields.
						'icon_margin_top'      => array(
							'type'        => 'text',
							'label'       => __( 'Icon Margin Top', 'uabb' ),
							'placeholder' => '25',
							'description' => 'px',
							'size'        => '8',
						),
						'icon_margin_bottom'   => array(
							'type'        => 'text',
							'label'       => __( 'Icon Margin Bottom', 'uabb' ),
							'placeholder' => '15',
							'description' => 'px',
							'size'        => '8',
						),
						'button_margin_top'    => array(
							'type'        => 'text',
							'label'       => __( 'Button Margin Top', 'uabb' ),
							'placeholder' => '15',
							'description' => 'px',
							'size'        => '8',
						),
						'button_margin_bottom' => array(
							'type'        => 'text',
							'label'       => __( 'Button Margin Bottom', 'uabb' ),
							'placeholder' => '0',
							'description' => 'px',
							'size'        => '8',
						),
					),
				),
			),
		),
	)
);
