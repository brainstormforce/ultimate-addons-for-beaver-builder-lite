<?php
/**
 *  UABB Global Settings
 *
 *  @package Global Settings Form
 */

FLBuilder::register_settings_form(
	'uabb-global',
	array(
		'title' => sprintf(
			esc_attr__( '%s - Global Settings', 'uabb' ), // @codingStandardsIgnoreLine.
			UABB_PREFIX
		),
		'tabs'  => array(
			'general' => array(
				'title'    => __( 'Style', 'uabb' ),
				'sections' => array(
					'enable_disable' => array(
						'title'  => __( 'Global Styling', 'uabb' ),
						'fields' => array(
							'enable_global' => array(
								'type'    => 'uabb-toggle-switch',
								'label'   => __( 'Enable Global Styling', 'uabb' ),
								'default' => 'yes',
								'options' => array(
									'yes' => 'Yes',
									'no'  => 'No',
								),
								'toggle'  => array(
									'yes' => array(
										'sections' => array( 'theme', 'button' ),
									),
								),
							),
						),
					),
					'theme'          => array(
						'title'  => __( 'General', 'uabb' ),
						'fields' => array(
							'theme_color'      => array(
								'type'       => 'color',
								'label'      => __( 'Primary Color', 'uabb' ),
								'default'    => 'f7b91a',
								'show_reset' => true,
							),
							'theme_text_color' => array(
								'type'       => 'color',
								'label'      => __( 'Primary Text Color', 'uabb' ),
								'default'    => '808285',
								'show_reset' => true,
							),
						),
					),
					'button'         => array(
						'title'  => __( 'Button', 'uabb' ),
						'fields' => array(
							'btn_bg_color'           => array(
								'type'       => 'color',
								'label'      => __( 'Background Color', 'uabb' ),
								'default'    => 'f7b91a',
								'show_reset' => true,
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
								'default'    => '000000',
								'show_reset' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
							'btn_bg_hover_color_opc' => array(
								'type'        => 'text',
								'label'       => __( 'Opacity', 'uabb' ),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),
							'btn_text_color'         => array(
								'type'       => 'color',
								'label'      => __( 'Text Color', 'uabb' ),
								'default'    => 'ffffff',
								'show_reset' => true,
							),
							'btn_text_hover_color'   => array(
								'type'       => 'color',
								'label'      => __( 'Text Hover Color', 'uabb' ),
								'default'    => 'ffffff',
								'show_reset' => true,
								'preview'    => array(
									'type' => 'none',
								),
							),
							'btn_font_size'          => array(
								'type'        => 'text',
								'label'       => __( 'Font Size', 'uabb' ),
								'default'     => '',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_line_height'        => array(
								'type'        => 'text',
								'label'       => __( 'Line Height', 'uabb' ),
								'default'     => '',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_letter_spacing'     => array(
								'type'        => 'text',
								'label'       => __( 'Letter Spacing', 'uabb' ),
								'default'     => '',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_text_transform'     => array(
								'type'    => 'select',
								'label'   => __( 'Text Transform', 'uabb' ),
								'default' => 'none',
								'options' => array(
									'none'       => __( 'None', 'uabb' ),
									'capitalize' => __( 'Capitalize', 'uabb' ),
									'uppercase'  => __( 'Uppercase', 'uabb' ),
									'lowercase'  => __( 'Lowercase', 'uabb' ),
									'initial'    => __( 'Initial', 'uabb' ),
									'inherit'    => __( 'Inherit', 'uabb' ),
								),
							),
							'btn_border_radius'      => array(
								'type'        => 'text',
								'label'       => __( 'Border Radius', 'uabb' ),
								'default'     => '5',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_vertical_padding'   => array(
								'type'        => 'text',
								'label'       => __( 'Vertical Padding', 'uabb' ),
								'default'     => '',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
							'btn_horizontal_padding' => array(
								'type'        => 'text',
								'label'       => __( 'Horizontal Padding', 'uabb' ),
								'default'     => '',
								'maxlength'   => '3',
								'size'        => '4',
								'description' => 'px',
							),
						),
					),
				),
			),
		),
	)
);
