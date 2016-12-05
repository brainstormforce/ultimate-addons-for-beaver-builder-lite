<?php

/**
 * UABB_Extend_RowColumn setup
 *
 * @since 1.1.0.4
 */

class UABB_Extend_RowColumn {

	public function init() {
		
		//	Register column setting
		add_filter( 'fl_builder_register_settings_form', array( $this, 'column_settings' ), 10, 2);

		$uabb_options         = UABB_Init::$uabb_options['fl_builder_uabb'];
		$enable_row_separator = true;

		if ( !empty( $uabb_options ) && array_key_exists( 'uabb-row-separator', $uabb_options ) ) {
			if( $uabb_options['uabb-row-separator'] == 1 ) {
				$enable_row_separator = true;
			} else {
				$enable_row_separator = false;
			}
		}

		if ( $enable_row_separator ) {
			
			add_filter( 'fl_builder_register_settings_form',	array( $this, 'row_settings'), 10, 2);
			add_filter( 'fl_builder_row_custom_class', 			array( $this, 'row_class'), 10, 2);
			add_action( 'fl_builder_before_render_row_bg', 		array( $this, 'row_top_html'), 10, 1 );
			add_action( 'fl_builder_after_render_row_bg', 		array( $this, 'row_bottom_html'), 10, 1 );

		}

		/* Extended Settings CSS */
		add_filter('fl_builder_render_css', array( $this, 'uabb_extended_setting_css' ), 10, 3);

		/* Add Responsive div after all content */
		add_action( 'fl_builder_after_render_content',   array( $this, 'uabb_responsive_div_html' ), 10, 1 );
	}

	/**
	 * Function to append Custom CSS of extended settings
	 */
	function uabb_extended_setting_css( $css, $nodes, $global_settings) {

		ob_start();
		include BB_ULTIMATE_ADDON_DIR . 'assets/dynamic-css/uabb-extended-setting-css.php';
		$css .= ob_get_clean();
		return $css;
	}

	function uabb_responsive_div_html( $content ) {
		echo '<div id="uabb-js-breakpoint" class="uabb-js-breakpoint" style="display: none;"></div>';
	}

	/**
	 * Function to extend row settings for row separator
	 */
	function row_settings( $form, $id ) {
		if ( $id == 'row' ) {
			$row_setting_arr = array(
				'title'         => __('Effects', 'uabb'),
				'sections'      => array(
					'general'       => array(
						'title'         => __( 'Top Row Separator', 'uabb' ),
						'fields'        => array(
							'separator_shape' => array(
								'type'          => 'select',
								'label'         => __('Type', 'uabb'),
								'default'       => 'none',
								'options'       => array(
									'none'						=>	__( 'None', 'uabb' ),
									'triangle_svg'				=>	__( 'Triangle', 'uabb' ),
									'xlarge_triangle'			=>	__( 'Big Triangle', 'uabb' ),
									'xlarge_triangle_left'		=>	__( 'Big Triangle Left', 'uabb' ),
									'xlarge_triangle_right'		=>	__( 'Big Triangle Right', 'uabb' ),
									'circle_svg'				=>	__( 'Half Circle', 'uabb' ),
									'xlarge_circle'				=>	__( 'Curve Center', 'uabb' ),
									'curve_up'					=>	__( 'Curve Left', 'uabb' ),
									'curve_down'				=>	__( 'Curve Right', 'uabb' ),
									'tilt_left'					=>	__( 'Tilt Left', 'uabb' ),
									'tilt_right'				=>	__( 'Tilt Right', 'uabb' ),
									'round_split'				=>	__( 'Round Split', 'uabb' ),
									'waves'						=>	__( 'Waves', 'uabb' ),
									'clouds'					=>	__( 'Clouds', 'uabb' ),
									'multi_triangle'			=>	__( 'Multi Triangle', 'uabb' ),
								),
								'toggle'	=> array(
									'triangle_svg'				=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color', 'separator_color_opc' )
									),
									'xlarge_triangle'			=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color', 'separator_color_opc' )
									),
									'xlarge_triangle_left'		=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color', 'separator_color_opc' )
									),
									'xlarge_triangle_right'		=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color', 'separator_color_opc' )
									),
									'circle_svg'				=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color', 'separator_color_opc' )
									),
									'xlarge_circle'				=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color', 'separator_color_opc' )
									),
									'curve_up'					=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color', 'separator_color_opc' )
									),
									'curve_down'				=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color', 'separator_color_opc' )
									),
									'tilt_left'					=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color', 'separator_color_opc' )
									),
									'tilt_right'				=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color', 'separator_color_opc' )
									),
									'round_split'				=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color', 'separator_color_opc' )
									),
									'waves'						=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color', 'separator_color_opc' )
									),
									'clouds'					=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color', 'separator_color_opc' )
									),
									'multi_triangle'			=> array(
										'fields'		=> array( 'separator_shape_height', 'separator_shape_height_medium', 'separator_shape_height_small', 'separator_color' )
									),
								)
							),
							'separator_shape_height'   => array(
								'type'          => 'text',
								'label'         => __('Size', 'uabb'),
								'default'       => '60',
								'description'   => 'px',
								'maxlength'     => '3',
								'size'          => '6',
								'placeholder'   => '60'
							),
							'separator_shape_height_medium'   => array(
								'type'          => 'text',
								'label'         => __('Medium Device Size', 'uabb'),
								'default'       => '',
								'description'   => 'px',
								'maxlength'     => '3',
								'size'          => '6',
							),
							'separator_shape_height_small'   => array(
								'type'          => 'text',
								'label'         => __('Small Device Size', 'uabb'),
								'default'       => '',
								'description'   => 'px',
								'maxlength'     => '3',
								'size'          => '6',
							),
							'separator_color' => array( 
								'type'       => 'color',
								'label'      => __('Background', 'uabb'),
								'default'    => 'ffffff',
								'show_reset' => true,
								'help'       => __('Mostly, this should be background color of your adjacent row section. (Default - White)', 'uabb'),
							),
		                	'separator_color_opc' => array( 
								'type'        => 'text',
								'label'       => __('Opacity', 'uabb'),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),
						)
					),
					'general_bottom'       => array(
						'title'         => __( 'Bottom Row Separator', 'uabb' ),
						'fields'        => array(
							'bot_separator_shape' => array(
								'type'          => 'select',
								'label'         => __('Type', 'uabb'),
								'default'       => 'none',
								'options'       => array(
									'none'						=>	__( 'None', 'uabb' ),
									'triangle_svg'				=>	__( 'Triangle', 'uabb' ),
									'xlarge_triangle'			=>	__( 'Big Triangle', 'uabb' ),
									'xlarge_triangle_left'		=>	__( 'Big Triangle Left', 'uabb' ),
									'xlarge_triangle_right'		=>	__( 'Big Triangle Right', 'uabb' ),
									'circle_svg'				=>	__( 'Half Circle', 'uabb' ),
									'xlarge_circle'				=>	__( 'Curve Center', 'uabb' ),
									'curve_up'					=>	__( 'Curve Left', 'uabb' ),
									'curve_down'				=>	__( 'Curve Right', 'uabb' ),
									'tilt_left'					=>	__( 'Tilt Left', 'uabb' ),
									'tilt_right'				=>	__( 'Tilt Right', 'uabb' ),
									'round_split'				=>	__( 'Round Split', 'uabb' ),
									'waves'						=>	__( 'Waves', 'uabb' ),
									'clouds'					=>	__( 'Clouds', 'uabb' ),
									'multi_triangle'			=>	__( 'Multi Triangle', 'uabb' ),
								),
								'toggle'	=> array(
									'triangle_svg'				=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color', 'bot_separator_color_opc' )
									),
									'xlarge_triangle'			=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color', 'bot_separator_color_opc' )
									),
									'xlarge_triangle_left'		=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color', 'bot_separator_color_opc' )
									),
									'xlarge_triangle_right'		=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color', 'bot_separator_color_opc' )
									),
									'circle_svg'				=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color', 'bot_separator_color_opc' )
									),
									'xlarge_circle'				=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color', 'bot_separator_color_opc' )
									),
									'curve_up'					=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color', 'bot_separator_color_opc' )
									),
									'curve_down'				=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color', 'bot_separator_color_opc' )
									),
									'tilt_left'					=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color', 'bot_separator_color_opc' )
									),
									'tilt_right'				=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color', 'bot_separator_color_opc' )
									),
									'round_split'				=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color', 'bot_separator_color_opc' )
									),
									'waves'						=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color', 'bot_separator_color_opc' )
									),
									'clouds'					=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color', 'bot_separator_color_opc' )
									),
									'multi_triangle'			=> array(
										'fields'		=> array( 'bot_separator_shape_height', 'bot_separator_shape_height_medium', 'bot_separator_shape_height_small', 'bot_separator_color' )
									),
								)
							),
							'bot_separator_shape_height'   => array(
								'type'          => 'text',
								'label'         => __('Size', 'uabb'),
								'default'       => '60',
								'description'   => 'px',
								'maxlength'     => '3',
								'size'          => '6',
								'placeholder'   => '60'
							),
							'bot_separator_shape_height_medium'   => array(
								'type'          => 'text',
								'label'         => __('Medium Device Size', 'uabb'),
								'default'       => '',
								'description'   => 'px',
								'maxlength'     => '3',
								'size'          => '6',
							),
							'bot_separator_shape_height_small'   => array(
								'type'          => 'text',
								'label'         => __('Small Device Size', 'uabb'),
								'default'       => '',
								'description'   => 'px',
								'maxlength'     => '3',
								'size'          => '6',
							),
							'bot_separator_color' => array( 
								'type'       => 'color',
								'label'         => __('Background', 'uabb'),
								'default'		=> 'ffffff',
								'show_reset' => true,
								'help'			=> __('Mostly, this should be background color of your adjacent row section. (Default - White)', 'uabb'),
							),
		                	'bot_separator_color_opc' => array( 
								'type'        => 'text',
								'label'       => __('Opacity', 'uabb'),
								'default'     => '',
								'description' => '%',
								'maxlength'   => '3',
								'size'        => '5',
							),
						)
					),
				)
			);
				
			/*$advanced = $form['tabs']['advanced'];
        	unset($form['tabs']['advanced']);
			
			$form['tabs']['effects'] = $row_setting_arr;
			
			$form['tabs']['advanced'] = $advanced;*/

			$form['tabs'] = array_merge(
				array_slice( $form['tabs'], 0, 1 ), 
				array( 'effect' => $row_setting_arr ),
				array_slice( $form['tabs'], 1 ) 
			);
			/*print_r( $form['tabs'] );*/
		}
		return $form;
	}

	/**
	 * Function to append Custom Vertical Alignment Setting in Column
	 */
	function column_settings( $form, $id ) {

		if($id == 'col') {
			$column_form = array(
				'tabs' => array(
					'style' => array(
						'sections' => array(
							'general' => array(
								'fields'  => array(
									'content_alignment'  => array(
										'options' => array(
											'bottom'   	=> __('Bottom', 'uabb')
										),
										/*'preview'	=> array(
											'type'          => 'css',
										    'selector'      => '.fl-col-content',
										    'property'      => 'justify-content',
										)*/
									)
								)
							),
							'border'       => array(
								'title'         => __('Border', 'uabb'),
								'fields'        => array(
									'border_type'   => array(
										'toggle'        => array(
											''              => array(
												'fields'        => array()
											),
											'solid'         => array(
												'fields'        => array('hide_border_mobile')
											),
											'dashed'        => array(
												'fields'        => array('hide_border_mobile')
											),
											'dotted'        => array(
												'fields'        => array('hide_border_mobile')
											),
											'double'        => array(
												'fields'        => array('hide_border_mobile')
											)
										),
										'preview'         => array(
											'type'            => 'none'
										)
									),
									'hide_border_mobile'	=> array(
										'type'          => 'select',
										'label'         => __('Hide Border on Mobile', 'uabb'),
										'default'       => 'no',
										'options'       => array(
											'no'        	=> __('No', 'uabb'),
											'yes'         	=> __('Yes', 'uabb')
										),
										'preview'		=> array(
											'type'			=> 'none'
										)
									)
								)
							),
						)
					)
				)
			);
			$form = array_replace_recursive( ( array )$form, ( array )$column_form );
		}
		return $form;
	}

	/* Function to add row class according to setting */
	function row_class( $class, $row_object ) {
		$row = $row_object->settings;
		if ( $row->separator_shape != 'none' ) {
			$class = $class.' uabb-'.$row->separator_shape;
		}
		return $class;
	}

	/**
	 * Function to add Custom html of extended setting
	 */
	function row_top_html( $row_object ) {
		$row = $row_object->settings;
		if( ( isset( $row->separator_position ) && ( $row->separator_position =='top' || $row->separator_position == 'top_bottom' ) ) || $row->separator_shape != 'none' ) {
			$row->separator_flag = 'top';
			include BB_ULTIMATE_ADDON_DIR . 'classes/class-extended-row-html.php';
		}
	}

	function row_bottom_html( $row_object ) {
		$row = $row_object->settings;
		if( ( isset( $row->separator_position ) && ( $row->separator_position =='bottom' || $row->separator_position == 'top_bottom' ) ) || $row->bot_separator_shape != 'none' ) {
			$row->separator_flag = 'bottom';
			include BB_ULTIMATE_ADDON_DIR . 'classes/class-extended-row-html.php';
		}
	}
}

$UABB_Extend_RowColumn = new UABB_Extend_RowColumn();
$UABB_Extend_RowColumn->init();

