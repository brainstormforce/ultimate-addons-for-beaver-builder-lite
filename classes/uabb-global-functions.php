<?php 

/**
 * = Global functions
 *
 * array_replace_recursive()
 * recurse()
 * uabb_theme_base_color()
 * uabb_theme_text_color()
 * uabb_theme_link_color()
 * uabb_theme_link_hover_color()
 * uabb_theme_button_font_family()
 * uabb_theme_button_font_size()
 * uabb_theme_button_line_height()
 * uabb_theme_button_letter_spacing()
 * uabb_theme_button_text_transform()
 * uabb_theme_button_bg_color()
 * uabb_theme_button_bg_hover_color()
 * uabb_theme_button_text_color()
 * uabb_theme_button_text_hover_color()
 * uabb_theme_button_padding()
 * uabb_theme_button_vertical_padding()
 * uabb_theme_button_horizontal_padding()
 * uabb_theme_button_border_radius()
 * uabb_parse_color_to_hex()
 *
 */

/**
 * array_replace_recursive() function for PHP older version
 */

if ( !function_exists('array_replace_recursive') ) {
	function array_replace_recursive($base, $replacements) {

		$base = recurse($base, $replacements);
    	// handle the arguments, merge one by one
    	$args = func_get_args();
    	$base = $args[0];
    	if ( !is_array($base) ) {
      		return $base;
    	}
    
    	for ($i = 1; $i < count($args); $i++) {
      		if ( is_array($args[$i]) ) {
        		$base = recurse($base, $args[$i]);
      		}
    	}
    
    	return $base;
  	}

  	function recurse($base, $replacements) {
    	foreach ($replacements as $key => $value) {
        	// create new key in $base, if it is empty or not an array
        	if (!isset($base[$key]) || (isset($base[$key]) && !is_array($base[$key]))) {
          		$base[$key] = array();
        	}

        	// overwrite the value in the base array
        	if (is_array($value)) {
          		$value = recurse($base[$key], $value);
        	}
        	
        	$base[$key] = $value;
      	}
      	
      	return $base;
    }
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * checks if user has set the color, if yes, returns users value else checks for filtered value.
 *
 * @return string - hex value for the color
 */
function uabb_theme_base_color( $default ) {
	$color = '';

	if ( $default == '' ) {

		$color = apply_filters( 'uabb/global/theme_color', $default );
		
		if ( $color == '' ) {
			$color = apply_filters( 'uabb/theme/theme_color', $default );
		}
	} else {
		$color = $default;
	}

	return $color;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * checks if user has set the color, if yes, returns users value else checks for filtered value.
 *
 * @return string - hex value for the color
 */
function uabb_theme_text_color( $default ) {
	$color = '';

	if ( $default == '' ) {

		$color = apply_filters( 'uabb/global/text_color', $default );
		
		if ( $color == '' ) {
			$color = apply_filters( 'uabb/theme/text_color', $default );
		}
	} else {
		$color = $default;
	}

	return $color;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * checks if user has set the color, if yes, returns users value else checks for filtered value.
 *
 * @return string - hex value for the color
 */
function uabb_theme_link_color( $default ) {
	$color = '';

	if ( $default == '' ) {

		$color = apply_filters( 'uabb/global/link_color', $default );
				
		if ( $color == '' ) {
			$color = apply_filters( 'uabb/theme/link_color', $default );
		}
	} else {
		$color = $default;
	}

	return $color;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * checks if user has set the color, if yes, returns users value else checks for filtered value.
 *
 * @return string - hex value for the color
 */
function uabb_theme_link_hover_color( $default ) {
	$color = '';

	if ( $default == '' ) {

		$color = apply_filters( 'uabb/global/link_hover_color', $default );
				
		if ( $color == '' ) {
			$color = apply_filters( 'uabb/theme/link_hover_color', $default );
		}
	} else {
		$color = $default;
	}

	return $color;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * checks if user has set the font family, if yes, returns users value else checks for filtered value.
 *
 * @return string - font-family
 */
function uabb_theme_button_font_family( $default ) {
	$btn_font_family = array();

	if ( $default['family'] == '' ||  $default['family'] == 'Default' ) {

		$btn_font_family = apply_filters( 'uabb/theme/button_font_family', $default );

	} else {
		$btn_font_family = $default;
	}

	return $btn_font_family;
}

/**
 * Button Font Size
 */
function uabb_theme_button_font_size( $default ) {
	$font_size = '';

	if ( $default == '' ) {

		$font_size = apply_filters( 'uabb/global/button_font_size', $default );
				
		if ( $font_size == '' ) {
			$font_size = apply_filters( 'uabb/theme/button_font_size', $default );
		}else{
			$font_size = $font_size.'px';
		}
	} else {
		$font_size = $default;
	}

	return $font_size;
}

/**
 * Button Line Height
 */
function uabb_theme_button_line_height( $default ) {
	$line_height = '';

	if ( $default == '' ) {

		$line_height = apply_filters( 'uabb/global/button_line_height', $default );
				
		if ( $line_height == '' ) {
			$line_height = apply_filters( 'uabb/theme/button_line_height', $default );
		}else{
			$line_height = $line_height.'px';
		}
	} else {
		$line_height = $default;
	}

	return $line_height;
}

/**
 * Button Letter Spacing
 */
function uabb_theme_button_letter_spacing( $default ) {
	$letter_spacing = '';

	if ( $default == '' ) {

		$letter_spacing = apply_filters( 'uabb/global/button_letter_spacing', $default );
				
		if ( $letter_spacing == '' ) {
			$letter_spacing = apply_filters( 'uabb/theme/button_letter_spacing', $default );
		}else{
			$letter_spacing = $letter_spacing.'px';
		}
	} else {
		$letter_spacing = $default;
	}

	return $letter_spacing;
}

/**
 * Button Text Transform
 */
function uabb_theme_button_text_transform( $default ) {
	$text_transform = '';

	if ( $default == '' ) {

		$text_transform = apply_filters( 'uabb/global/button_text_transform', $default );
				
		if ( $text_transform == '' ) {
			$text_transform = apply_filters( 'uabb/theme/button_text_transform', $default );
		}
	} else {
		$text_transform = $default;
	}

	return $text_transform;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * checks if user has set the color, if yes, returns users value else checks for filtered value.
 *
 * @return string - hex value for the color
 */
function uabb_theme_button_bg_color( $default ) {
	$color = '';

	if ( $default == '' ) {

		$color = apply_filters( 'uabb/global/button_bg_color', $default );
				
		if ( $color == '' ) {
			$color = apply_filters( 'uabb/theme/button_bg_color', $default );
		}
	} else {
		$color = $default;
	}

	return $color;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * checks if user has set the color, if yes, returns users value else checks for filtered value.
 *
 * @return string - hex value for the color
 */
function uabb_theme_button_bg_hover_color( $default ) {
	$color = '';

	if ( $default == '' ) {

		$color = apply_filters( 'uabb/global/button_bg_hover_color', $default );
				
		if ( $color == '' ) {
			$color = apply_filters( 'uabb/theme/button_bg_hover_color', $default );
		}
	} else {
		$color = $default;
	}

	return $color;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * checks if user has set the color, if yes, returns users value else checks for filtered value.
 *
 * @return string - hex value for the color
 */
function uabb_theme_button_text_color( $default ) {
	$color = '';

	if ( $default == '' ) {

		$color = apply_filters( 'uabb/global/button_text_color', $default );
				
		if ( $color == '' ) {
			$color = apply_filters( 'uabb/theme/button_text_color', $default );
		}
	} else {
		$color = $default;
	}

	return $color;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * checks if user has set the color, if yes, returns users value else checks for filtered value.
 *
 * @return string - hex value for the color
 */
function uabb_theme_button_text_hover_color( $default ) {
	$color = '';

	if ( $default == '' ) {

		$color = apply_filters( 'uabb/global/button_text_hover_color', $default );
				
		if ( $color == '' ) {
			$color = apply_filters( 'uabb/theme/button_text_hover_color', $default );
		}
	} else {
		$color = $default;
	}

	return $color;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * checks if user has set the color, if yes, returns users value else checks for filtered value.
 *
 * @return string - padding value
 */
function uabb_theme_button_padding( $default ) {
	$padding = '';

	if ( $default == '' ) {

		$padding = apply_filters( 'uabb/global/button_padding', $default );
							
		if ( $padding == '' ) {
			$padding = apply_filters( 'uabb/theme/button_padding', $default );
			if ( $padding == '' ) {
				$padding = '12px 24px';
			}
		}
	} else {
		$padding = $default;
	}

	return $padding;
}

function uabb_theme_button_vertical_padding( $default ) {
	$padding = '';

	if ( $default == '' ) {

		$padding = apply_filters( 'uabb/global/button_vertical_padding', $default );
							
		if ( $padding == '' ) {
			$padding = apply_filters( 'uabb/theme/button_vertical_padding', $default );
			if ( $padding == '' ) {
				$padding = '12';
			}
		}
	} else {
		$padding = $default;
	}

	return $padding;
}

function uabb_theme_button_horizontal_padding( $default ) {
	$padding = '';

	if ( $default == '' ) {

		$padding = apply_filters( 'uabb/global/button_horizontal_padding', $default );
							
		if ( $padding == '' ) {
			$padding = apply_filters( 'uabb/theme/button_horizontal_padding', $default );
			if ( $padding == '' ) {
				$padding = '24';
			}
		}
	} else {
		$padding = $default;
	}

	return $padding;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * checks if user has set the radius, if yes, returns users value else checks for filtered value.
 *
 * @return string - radius value
 */
function uabb_theme_button_border_radius( $default ) {
	$radius = '';

	if ( $default == '' ) {
	
		$radius = apply_filters( 'uabb/global/button_border_radius', $default );

		if ( $radius == '' ) {
			$radius = apply_filters( 'uabb/theme/button_border_radius', $default );
			if ( $radius == '' ) {
				$radius = '4';
			}
		}
	} else {
		$radius = $default;
	}

	return $radius;
}



/**
 * Provide option to parse a color code.
 *
 * returns a hex value for color from rgba or #hex color.
 *
 * @return string - hex value for the color
 */
function uabb_parse_color_to_hex( $code = '' ) {
	$color = '';
	$hex = '';
	if( $code != '' ) {
		if ( strpos( $code, 'rgba' ) !== false ) {
			$code = ltrim( $code, 'rgba(' );
			$code = rtrim( $code, ')' );
			$rgb = explode( ',', $code );
			$hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
			$hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
			$hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);
			$color = $hex;
		} else {
			$color = ltrim( $code, '#' );
		}
	}
	//var_dump($hex); die;
	return $color;
}
