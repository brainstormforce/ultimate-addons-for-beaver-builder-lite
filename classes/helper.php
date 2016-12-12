<?php

/**
 * 		UABB Helper
 *
 * 	Helper functions, actions & filter hooks etc.
 */

if( !class_exists( 'UABB_Helper' ) ) {

	class UABB_Helper
	{
		/**
		 * Helper function to render css styles for a selected font.
		 *
		 * @since  1.0
		 * @param  array $font An array with font-family and weight.
		 * @return void
		 */
		static public function uabb_font_css( $font ){
			$css = '';
			
			if( array_key_exists( $font['family'], FLBuilderFontFamilies::$system ) ){
				$css .= 'font-family: '. $font['family'] .','. FLBuilderFontFamilies::$system[ $font['family'] ]['fallback'] .';';
			} else {
				$css .= 'font-family: '. $font['family'] .';';
			}

			if( $font['weight'] == 'regular' ) {
				$css .= 'font-weight: normal;';
			}else {
				$css .= 'font-weight: '. $font['weight'] .';';
			}	
			
			echo $css;
		}

		/**
		 *  Get - Color
		 *
		 * Get HEX color and return RGBA. Default return HEX color.
		 *
		 * @param   $hex        HEX color code
		 * @param   $opacity    Opacity of HEX color
		 * @return  $rgba       Return RGBA if opacity is set. Default return HEX.
		 * @since 1.0
		 */
		static public function uabb_get_color( $hex, $opacity )
		{
		    $rgba = $hex;
		    if( $opacity != '' ) {
		        if(strlen( $hex ) == 3) {
		            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
		        } else {
		            $r = hexdec(substr($hex,0,2));
		            $g = hexdec(substr($hex,2,2));
		            $b = hexdec(substr($hex,4,2));
		        }
		        return 'rgba( ' . $r . ', ' . $g . ', ' . $b . ', ' . $opacity . ' )';
		    } else {
		        return '#' . $hex;
		    }
		}

		/**
		 *	Get - RGBA Color
		 *
		 *  Get HEX color and return RGBA. Default return RGB color.
		 *
		 * @param   $hex        HEX color code
		 * @param   $opacity    Opacity of HEX color
		 * @return  $rgba       Return RGBA if opacity is set. Default return RGB.
		 * @since 	1.0
		 */
		static public function uabb_hex2rgba($color, $opacity = false, $is_array = false ) {
 
			$default = $color;
		 
			//Return default if no color provided
			if(empty($color))
		          return $default; 
		 
			//Sanitize $color if "#" is provided 
	        if ($color[0] == '#' ) {
	        	$color = substr( $color, 1 );
	        }
	 
	        //Check if color has 6 or 3 characters and get values
	        if (strlen($color) == 6) {
	                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	        } elseif ( strlen( $color ) == 3 ) {
	                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	        } else {
	                return $default;
	        }
	 
	        //Convert hexadec to rgb
	        $rgb =  array_map('hexdec', $hex);
	 
	        //Check if opacity is set(rgba or rgb)
	       if( $opacity !== false && $opacity !== '' ){
	        	if(abs($opacity) > 1) {
	        		//$opacity = 1.0;
	        		$opacity = $opacity / 100;
	        	}
	        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	        } else {
	        	$output = 'rgb('.implode(",",$rgb).')';
	        }
	 
	 		if ( $is_array ) {
	        	return $rgb;
	 		}else{
	        	//Return rgb(a) color string
	        	return $output;
	 		}
		}

		/**
		 *	Get - Colorpicker Value based on colorpicker
		 *
		 * @param   $hex        HEX color code
		 * @param   $opacity    Opacity of HEX color
		 * @return  $rgba       Return RGBA if opacity is set. Default return RGB.
		 * @since 	1.0
		 */
		static public function uabb_colorpicker( $settings, $name = '', $opc = false ) {
			
			$hex_color = $opacity = '';
			$hex_color = $settings->$name;

			if ( $hex_color != '' && $hex_color[0] != 'r' && $hex_color[0] != 'R' ) {

				if ( $opc == true && $settings->{ $name.'_opc' } !== '' ) {
					$opacity 	= $settings->{ $name.'_opc' };
					$rgba 		= self::uabb_hex2rgba( $hex_color, $opacity/100  );
					return $rgba;
				}
				
				if ( $hex_color[0] != '#' ) {
					
					return '#'.$hex_color;
				}
			}

			return $hex_color;
		}

		/**
		 *	Get - Gradient color CSS
		 *
		 * @param   $hex        HEX color code
		 * @param   $opacity    Opacity of HEX color
		 * @return  $rgba       Return RGBA if opacity is set. Default return RGB.
		 * @since 	1.0
		 */

		static public function uabb_gradient_css( $gradient ){
			$gradient_angle = intval( $gradient['angle'] );
			$direction      = $gradient['direction'];
			$color1         = '';
			$color2         = '';
			$angle          = 0;
			$css            = '';

			if ( $direction != 'custom' ) {
				switch ( $direction  ) {
					case 'left_right':
						$gradient_angle = 0;
						break;
					case 'right_left':
						$gradient_angle = 180;
						break;
					case 'top_bottom':
						$gradient_angle = 270;
						break;
					case 'bottom_top':
						$gradient_angle = 90;
						break;
					default:
						break;
				}
			}

			if( isset( $gradient['color_one'] ) && $gradient['color_one'] != '' ){
				$color1 = self::uabb_hex2rgba( $gradient['color_one'] );
			}

			if( isset( $gradient['color_two'] ) && $gradient['color_two'] != '' ){
				$color2 = self::uabb_hex2rgba( $gradient['color_two'] );
			}

			$angle = abs( $gradient_angle - 450 ) % 360;

			if ( $color1 != '' && $color2 != '' ) {
				
				$css .= 'background: -webkit-linear-gradient('.$gradient_angle.'deg, '.$color1.' 0%, '.$color2.' 100%);';
				$css .= 'background: -o-linear-gradient('.$gradient_angle.'deg, '.$color1.' 0%, '.$color2.' 100%);';
				$css .= 'background: -ms-linear-gradient('.$gradient_angle.'deg, '.$color1.' 0%, '.$color2.' 100%);';
				$css .= 'background: -moz-linear-gradient('.$gradient_angle.'deg, '.$color1.' 0%, '.$color2.' 100%);';
				$css .= 'background: linear-gradient('.$angle.'deg, '.$color1.' 0%, '.$color2.' 100%);';			
			}
			echo $css;
		}
	}
}