<?php
/**
 * Register the module and its form settings with new typography, border, align param settings provided in beaver builder version 2.2
 * Applicable for BB version greater than 2.2 and UABB version 1.14.0 or later.
 *
 * Converted font, align, border settings to respective param setting.
 *
 * @package UABB Ribbon Module
 */

FLBuilder::register_module(
	'RibbonModule',
	array(
		'general'    => array( // Tab.
			'title'    => __( 'Layout', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'general' => array(
					'title'  => '',
					'fields' => array(
						'title'       => array(
							'type'    => 'text',
							'label'   => __( 'Ribbon Message', 'uabb' ),
							'default' => __( 'SPECIAL OFFER', 'uabb' ),
							'preview' => array(
								'type'     => 'text',
								'selector' => '.uabb-ribbon-text-title',
							),
						),
						'left_icon'   => array(
							'type'        => 'icon',
							'label'       => __( 'Left Icon', 'uabb' ),
							'show_remove' => true,
						),
						'right_icon'  => array(
							'type'        => 'icon',
							'label'       => __( 'Right Icon', 'uabb' ),
							'show_remove' => true,
						),
						'ribbon_resp' => array(
							'type'    => 'select',
							'label'   => __( 'Hide Ribbon Wings', 'uabb' ),
							'default' => 'small',
							'help'    => __( 'To hide Ribbon Wings on Small or Medium device use this option.', 'uabb' ),
							'options' => array(
								'none'   => __( 'None', 'uabb' ),
								'small'  => __( 'Small Devices', 'uabb' ),
								'medium' => __( 'Medium & Small Devices', 'uabb' ),
							),
						),
					),
				),
				'style'   => array(
					'title'  => __( 'Style', 'uabb' ),
					'fields' => array(
						'ribbon_width' => array(
							'type'    => 'select',
							'label'   => __( 'Ribbon Width', 'uabb' ),
							'default' => 'auto',
							'options' => array(
								'auto'   => __( 'Auto', 'uabb' ),
								'full'   => __( 'Full', 'uabb' ),
								'custom' => __( 'Custom', 'uabb' ),
							),
							'toggle'  => array(
								'custom' => array(
									'fields' => array( 'custom_width', 'ribbon_align' ),
								),
								'auto'   => array(
									'fields' => array( 'ribbon_align' ),
								),
							),
						),
						'custom_width' => array(
							'type'        => 'unit',
							'label'       => __( 'Custom Width', 'uabb' ),
							'placeholder' => '500',
							'size'        => '6',
							'slider'      => true,
							'units'       => array( 'px' ),
						),
						'ribbon_align' => array(
							'type'    => 'align',
							'label'   => __( 'Alignment', 'uabb' ),
							'default' => 'center',
							'help'    => __( 'To align Ribbon use this setting.', 'uabb' ),
							'options' => array(
								'center' => __( 'Center', 'uabb' ),
								'left'   => __( 'Left', 'uabb' ),
								'right'  => __( 'Right', 'uabb' ),
							),
						),
						'stitching'    => array(
							'type'    => 'select',
							'label'   => __( 'Stitching', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
							'help'    => __( 'To give Stitch effect on Ribbon', 'uabb' ),
						),
						'shadow'       => array(
							'type'    => 'select',
							'label'   => __( 'Ribbon Shadow', 'uabb' ),
							'default' => 'yes',
							'options' => array(
								'yes' => __( 'Yes', 'uabb' ),
								'no'  => __( 'No', 'uabb' ),
							),
						),
					),
				),
				'colors'  => array(
					'title'  => __( 'Ribbon Colors', 'uabb' ),
					'fields' => array(
						'ribbon_bg_type' => array(
							'type'    => 'select',
							'label'   => __( 'Ribbon Color Type', 'uabb' ),
							'default' => 'color',
							'help'    => __( 'You can select one of the two background types: Color: simple one color background or Gradient: two color background.', 'uabb' ),
							'options' => array(
								'color'    => __( 'Color', 'uabb' ),
								'gradient' => __( 'Gradient', 'uabb' ),
							),
							'toggle'  => array(
								'color'    => array(
									'fields' => array( 'ribbon_color' ),
								),
								'gradient' => array(
									'fields' => array( 'gradient_color' ),
								),
							),
						),
						'ribbon_color'   => array(
							'type'        => 'color',
							'label'       => __( 'Ribbon Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'connections' => array( 'color' ),
							'show_alpha'  => true,
						),
						'gradient_color' => array(
							'type'    => 'uabb-gradient',
							'label'   => __( 'Gradient', 'uabb' ),
							'default' => array(
								'color_one' => '',
								'color_two' => '',
								'direction' => 'top_bottom',
								'angle'     => '0',
							),
						),
						'icon_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Icon Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'fold_color'     => array(
							'type'        => 'color',
							'label'       => __( 'Ribbon Fold Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'end_color'      => array(
							'type'        => 'color',
							'label'       => __( 'Ribbon Wings Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
					),
				),
			),
		),
		'typography' => array( // Tab.
			'title'    => __( 'Typography', 'uabb' ), // Tab title.
			'sections' => array( // Tab Sections.
				'text_typography' => array(
					'title'  => __( 'Ribbon Text', 'uabb' ),
					'fields' => array(
						'text_tag_selection' => array(
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
						'font_typo'          => array(
							'type'       => 'typography',
							'label'      => __( 'Font Family', 'uabb' ),
							'responsive' => true,
							'preview'    => array(
								'type'     => 'css',
								'selector' => '.uabb-ribbon-text',
							),
						),
						'text_color'         => array(
							'type'        => 'color',
							'label'       => __( 'Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
						'text_shadow_color'  => array(
							'type'        => 'color',
							'label'       => __( 'Text Shadow Color', 'uabb' ),
							'default'     => '',
							'show_reset'  => true,
							'show_alpha'  => true,
							'connections' => array( 'color' ),
						),
					),
				),
			),
		),
	)
);
