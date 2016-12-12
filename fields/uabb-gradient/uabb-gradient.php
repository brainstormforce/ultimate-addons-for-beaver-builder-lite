<?php 
/*
	Declaration of array
	
	Ex.	'YOUR_VARIABLE_NAME'     => array(
                        'type'          => 'uabb-gradient',
                        'label'         => __( 'Gradient', 'uabb' ),
                        'default'       => array			//Required NULL or Default value
                            'color_one'		=> '',
                            'color_two'     => '',
                            'angle'      	=> '0',
                        )
                    )

Note : Default value is required here. Either pass it NULL or enter your own value.
	
    How to access variables

        .fl-node-<?php echo $id; ?> .YOUR-CLASS{
	    	<?php UABB_Helper::uabb_gradient_css( $settings->YOUR_VARIABLE_NAME ); ?>
	   }
*/

if(!class_exists('UABB_Gradient'))
{
	class UABB_Gradient
	{
		function __construct()
		{	
			add_action( 'fl_builder_control_uabb-gradient', array($this, 'uabb_gradient'), 1, 4 );
			//add_action( 'wp_enqueue_scripts', array( $this, 'uabb_gradient_assets' ) );
		}
		
		function uabb_gradient($name, $value, $field, $settings) {

			$name_new = 'uabb_'.$name;
			$value = ( array ) $value;
			$preview = json_encode( array( 'type' => 'refresh' ) );

			$default = ( isset( $field['default'] ) && $field['default'] != '' ) ? $field['default'] : '';
			$direction = array(
				'left_right' => 'Left to Right',
				'right_left' => 'Right to Left',
				'top_bottom' => 'Top to Bottom',
				'bottom_top' => 'Bottom to Top',
				'custom'     => 'Custom'
			);

			//$colorpick_class = $this->is_uabb_colorpicker() ? 'uabb-colorpick' : 'bb-colorpick';
			$colorpick_class = 'bb-colorpick';
			$html = '<div class="uabb-gradient-wrapper '.$colorpick_class.'">';

			// if ( $this->is_uabb_colorpicker() ) {
				
			// 	/* Color One */
			//     $html .= '<div class="uabb-gradient-item uabb-color uabb-gradient-color-one color-all-wrap-ajax fl-field" data-type="color" data-preview=\'' . $preview . '\'>';
			//     $html .= '<label for="uabb-gradient-color-one" class="uabb-gradient-label">Color 1</label>';
			// 	$html .= '<input type="text" class="cs-wp-color-picker" data-default-color="' . $value['color_one'] . '" value="' . $value['color_one'] . '" />';
			//     $html .= '<input type="hidden" name="' . $name . '[][color_one]'. '" class="fl-color-picker-value" value="' . $value['color_one'] . '"/>';
			//     $html .= '</div>';

			//     /* Color Two */
			//     $html .= '<div class="uabb-gradient-item uabb-color uabb-gradient-color-two color-all-wrap-ajax fl-field" data-type="color" data-preview=\'' . $preview . '\'>';
			//     $html .= '<label for="uabb-gradient-color-two" class="uabb-gradient-label">Color 2</label>';
			// 	$html .= '<input type="text" class="cs-wp-color-picker" data-default-color="' . $value['color_two'] . '" value="' . $value['color_two'] . '" />';
			//     $html .= '<input type="hidden" name="' . $name . '[][color_two]'. '" class="fl-color-picker-value" value="' . $value['color_two'] . '"/>';
			//     $html .= '</div>';

			// }else{
				/* Color One */
				$color_one_class = ( empty( $value['color_one'] ) ) ? ' fl-color-picker-empty' : '';
			    $html .= '<div class="uabb-gradient-item bb-color uabb-gradient-color-one fl-field" data-type="color" data-preview=\'' . $preview . '\'>';
					$html .= '<label for="uabb-gradient-color-one" class="uabb-gradient-label">Color 1</label>';
					$html .= '<div class="fl-color-picker">';
						$html .= '<div class="fl-color-picker-color'. $color_one_class .'"></div>';
						//if(isset($field['show_reset']) && $field['show_reset']) {
							$html .= '<div class="fl-color-picker-clear"><div class="fl-color-picker-icon-remove"></div></div>';
						//}
						$html .= '<input name="'. $name . '[][color_one]'.'" type="hidden" value="'. $value['color_one'] .'" class="fl-color-picker-value" />';
					$html .= '</div>';
				$html .= '</div>';

				/* Color Two */
				$color_two_class = ( empty( $value['color_two'] ) ) ? ' fl-color-picker-empty' : '';
			    $html .= '<div class="uabb-gradient-item bb-color uabb-gradient-color-two fl-field" data-type="color" data-preview=\'' . $preview . '\'>';
					$html .= '<label for="uabb-gradient-color-two" class="uabb-gradient-label">Color 2</label>';
					$html .= '<div class="fl-color-picker">';
						$html .= '<div class="fl-color-picker-color'. $color_two_class .'"></div>';
						//if(isset($field['show_reset']) && $field['show_reset']) {
							$html .= '<div class="fl-color-picker-clear"><div class="fl-color-picker-icon-remove"></div></div>';
						//}
						$html .= '<input name="'. $name . '[][color_two]'.'" type="hidden" value="'. $value['color_two'] .'" class="fl-color-picker-value" />';
					$html .= '</div>';
				$html .= '</div>';

			// }

				/* Direction */
				$html .= '<div class="uabb-gradient-item uabb-gradient-direction fl-field" data-type="select" data-preview=\'' . $preview . '\'>';
					$html .= '<label for="uabb-gradient-direction" class="uabb-gradient-label">Direction</label>';
					$html .= '<select name="'. $name . '[][direction]' .'" class="uabb-gradient-direction-select">';
						foreach ($direction as $direction_key => $direction_value) {
							$selected = '';
							if ( $value['direction'] == $direction_key  ) {
								$selected = 'selected="selected"';
							}
							$html .= '<option value="'.$direction_key.'" '. $selected . '>'.$direction_value.'</option>';
						}
					$html .= '</select>';
				$html .= '</div>';

				/* Angle */
				$html .= '<div class="uabb-gradient-item uabb-gradient-angle fl-field" data-type="text" data-preview=\'' . $preview . '\' >';
			    $html .= '<label for="uabb-gradient-angle" class="uabb-gradient-label">Angle</label>';
					$html .= '<input type="text" class="uabb-gradient-angle-input" name="'. $name . '[][angle]' .'" maxlength="3" size="6" value="'. $value['angle'] .'" />';
					$html .= '<span class="fl-field-description">deg</span>';
				$html .= '</div>';
			$html .= '</div>';
		
			echo $html;
		}
		
		function is_uabb_colorpicker(){
			$uabb_options = UABB_Init::$uabb_options['fl_builder_uabb'];

			if ( is_array( $uabb_options ) && array_key_exists( 'uabb-colorpicker', $uabb_options ) ) {
				if ( $uabb_options['uabb-colorpicker'] == 1 ) {
					return true;
				}else{
					return false;
				}
			}
			return true;
		}
		/*function uabb_gradient_assets() {
		    if ( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) {
		    	wp_enqueue_style( 'uabb-gradient', BB_ULTIMATE_ADDON_URL . 'fields/uabb-gradient/css/uabb-gradient.css', array(), '' );
		        wp_enqueue_script( 'uabb-gradient', BB_ULTIMATE_ADDON_URL . 'fields/uabb-gradient/js/uabb-gradient.js', array(), '', true );
		    }
		}*/
	}
	new UABB_Gradient();
}