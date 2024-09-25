<?php
/**
 * Global Styling
 * Global functions
 *
 * This file contains UABB Global Functions
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
 *  @package Global Styling
 */

/**
 * Function for PHP older version
 */
if ( ! function_exists( 'array_replace_recursive' ) ) {
	/**
	 * Initializes an array to replace recursive function
	 *
	 * @param mixed $base Initial base values, can be an array or any other type.
	 * @param array $replacements returns the replacements values.
	 * @return mixed Returns an array if $base is an array, otherwise returns the original $base value.
	 */
	function array_replace_recursive( $base, $replacements ) {

		$base = recurse( $base, $replacements );
		// handle the arguments, merge one by one.
		$args = func_get_args(); // @codingStandardsIgnoreLine.
		$base = $args[0];
		if ( ! is_array( $base ) ) {
			return $base;
		}

		for ( $i = 1; $i < count( $args ); $i++ ) {
			if ( is_array( $args[ $i ] ) ) {
				$base = recurse( $base, $args[ $i ] );
			}
		}

		return $base;
	}
	/**
	 * Initializes recurse function
	 *
	 * @param mixed $base Initial base values, can be an array or any other type.
	 * @param array $replacements returns the replacements values.
	 * @return mixed Returns an array if $base is an array, otherwise returns the original $base value.
	 */
	function recurse( $base, $replacements ) {
		foreach ( $replacements as $key => $value ) {
			// create new key in $base, if it is empty or not an array.
			if ( ! isset( $base[ $key ] ) || ( isset( $base[ $key ] ) && ! is_array( $base[ $key ] ) ) ) {
				$base[ $key ] = array();
			}

			// overwrite the value in the base array.
			if ( is_array( $value ) ) {
				$value = recurse( $base[ $key ], $value );
			}

			$base[ $key ] = $value;
		}

		return $base;
	}
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default_color Checks if user has set the color, if yes, returns users value else checks for.
 * filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_base_color( $default_color ) {
	$color = '';

	if ( '' === $default_color ) {

		$color = apply_filters( 'uabb/global/theme_color', $default_color );// @codingStandardsIgnoreLine.

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_theme_color', $default_color );
		}
	} else {
		$color = $default_color;
	}

	return $color;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default_text_color Checks if user has set the color, if yes, returns users value else checks for.
 * filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_text_color( $default_text_color ) {
	$color = '';

	if ( '' === $default_text_color ) {

		$color = apply_filters( 'uabb/global/text_color', $default_text_color );// @codingStandardsIgnoreLine.

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_text_color', $default_text_color );
		}
	} else {
		$color = $default_text_color;
	}

	return $color;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default_link_color Checks if user has set the color, if yes, returns users value else checks for
 * filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_link_color( $default_link_color ) {
	$color = '';

	if ( '' === $default_link_color ) {

		$color = apply_filters( 'uabb/global/link_color', $default_link_color );// @codingStandardsIgnoreLine.

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_link_color', $default_link_color );
		}
	} else {
		$color = $default_link_color;
	}

	return $color;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default_link_hover_color Checks if user has set the color, if yes, returns users value else checks for filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_link_hover_color( $default_link_hover_color ) {
	$color = '';

	if ( '' === $default_link_hover_color ) {

		$color = apply_filters( 'uabb/global/link_hover_color', $default_link_hover_color );// @codingStandardsIgnoreLine.

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_link_hover_color', $default_link_hover_color );
		}
	} else {
		$color = $default_link_hover_color;
	}

	return $color;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default_btn_font_family Checks if user has set the font family, if yes, returns users value else checks
 * for filtered value.
 * @return string - font-family
 */
function uabb_theme_button_font_family( $default_btn_font_family ) {
	$btn_font_family = array();

	if ( '' === $default_btn_font_family['family'] || 'Default' === $default_btn_font_family['family'] ) {

		$btn_font_family = apply_filters( 'uabb_theme_button_font_family', $default_btn_font_family );

	} else {
		$btn_font_family = $default_btn_font_family;
	}

	return $btn_font_family;
}

/**
 * Button Font Size
 *
 * @param var $default_btn_font_size Checks if the user has set Font Size values.
 * @return string
 */
function uabb_theme_button_font_size( $default_btn_font_size ) {
	$font_size = '';

	if ( '' === $default_btn_font_size ) {

		$font_size = apply_filters( 'uabb/global/button_font_size', $default_btn_font_size );// @codingStandardsIgnoreLine.

		if ( '' === $font_size ) {
			$font_size = apply_filters( 'uabb_theme_button_font_size', $default_btn_font_size );
		} else {
			$font_size = $font_size . 'px';
		}
	} else {
		$font_size = $default_btn_font_size;
	}

	return $font_size;
}
/**
 * Button Font Size
 *
 * @since 1.3.1
 * @param var $default_btn_font_size Checks if the user has set Font Size values.
 * @return string
 */
function uabb_theme_default_button_font_size( $default_btn_font_size ) {
	$font_size = '';

	if ( '' === $default_btn_font_size ) {

		$font_size = apply_filters( 'uabb/global/button_font_size', $default_btn_font_size	 );// @codingStandardsIgnoreLine.

		if ( '' === $font_size ) {
			$font_size = apply_filters( 'uabb_theme_default_button_font_size', $default_btn_font_size );
		} else {
			$font_size = $font_size . 'px';
		}
	} else {
		$font_size = $default_btn_font_size;
	}

	return $font_size;
}
/**
 * Button Line Height
 *
 * @param var $default_btn_line_height Checks if the user has set text transform values.
 * @return string
 */
function uabb_theme_button_line_height( $default_btn_line_height ) {
	$line_height = '';

	if ( '' === $default_btn_line_height ) {

		$line_height = apply_filters( 'uabb/global/button_line_height', $default_btn_line_height );// @codingStandardsIgnoreLine.

		if ( '' === $line_height ) {
			$line_height = apply_filters( 'uabb_theme_button_line_height', $default_btn_line_height );
		} else {
			$line_height = $line_height . 'px';
		}
	} else {
		$line_height = $default_btn_line_height;
	}

	return $line_height;
}
/**
 * Button Line Height
 *
 * @since 1.3.1
 * @param var $default_btn_line_height Checks if the user has set text transform values.
 * @return string
 */
function uabb_theme_default_button_line_height( $default_btn_line_height ) {
	$line_height = '';

	if ( '' === $default_btn_line_height ) {

		$line_height = apply_filters( 'uabb/global/button_line_height', $default_btn_line_height );// @codingStandardsIgnoreLine.

		if ( '' === $line_height ) {
			$line_height = apply_filters( 'uabb_theme_default_button_line_height', $default_btn_line_height );
		} else {
			$line_height = $line_height . 'px';
		}
	} else {
		$line_height = $default_btn_line_height;
	}

	return $line_height;
}
/**
 * Button Letter Spacing
 *
 * @param var $default_btn_letter_spacing Checks if the user has set letter spacing values.
 * @return string
 */
function uabb_theme_button_letter_spacing( $default_btn_letter_spacing ) {
	$letter_spacing = '';

	if ( '' === $default_btn_letter_spacing ) {

		$letter_spacing = apply_filters( 'uabb/global/button_letter_spacing', $default_btn_letter_spacing );// @codingStandardsIgnoreLine.

		if ( '' === $letter_spacing ) {
			$letter_spacing = apply_filters( 'uabb_theme_button_letter_spacing', $default_btn_letter_spacing );
		} else {
			$letter_spacing = $letter_spacing . 'px';
		}
	} else {
		$letter_spacing = $default_btn_letter_spacing;
	}

	return $letter_spacing;
}
/**
 * Button Letter Spacing
 *
 * @since 1.3.1
 * @param var $default_btn_letter_spacing Checks if the user has set letter spacing values.
 * @return string
 */
function uabb_theme_default_button_letter_spacing( $default_btn_letter_spacing ) {
	$letter_spacing = '';

	if ( '' === $default_btn_letter_spacing ) {

		$letter_spacing = apply_filters( 'uabb/global/button_letter_spacing', $default_btn_letter_spacing );// @codingStandardsIgnoreLine.

		if ( '' === $letter_spacing ) {
			$letter_spacing = apply_filters( 'uabb_theme_default_button_letter_spacing', $default_btn_letter_spacing );
		} else {
			$letter_spacing = $letter_spacing . 'px';
		}
	} else {
		$letter_spacing = $default_btn_letter_spacing;
	}

	return $letter_spacing;
}
/**
 * Button Text Transform
 *
 * @param var $default_btn_text_transform Checks if the user has set text transform values.
 * @return string
 */
function uabb_theme_button_text_transform( $default_btn_text_transform ) {
	$text_transform = '';

	if ( '' === $default_btn_text_transform ) {

		$text_transform = apply_filters( 'uabb/global/button_text_transform', $default_btn_text_transform );// @codingStandardsIgnoreLine.

		if ( '' === $text_transform ) {
			$text_transform = apply_filters( 'uabb_theme_button_text_transform', $default_btn_text_transform );
		}
	} else {
		$text_transform = $default_btn_text_transform;
	}

	return $text_transform;
}
/**
 * Button Text Transform
 *
 * @since 1.3.1
 * @param var $default_btn_text_transform Checks if the user has set text transform values.
 * @return string
 */
function uabb_theme_default_button_text_transform( $default_btn_text_transform ) {
	$text_transform = '';

	if ( '' === $default_btn_text_transform ) {

		$text_transform = apply_filters( 'uabb/global/button_text_transform', $default_btn_text_transform );// @codingStandardsIgnoreLine.

		if ( '' === $text_transform ) {
			$text_transform = apply_filters( 'uabb_theme_default_button_text_transform', $default_btn_text_transform );
		}
	} else {
		$text_transform = $default_btn_text_transform;
	}

	return $text_transform;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default_btn_bg_color Checks if user has set the color, if yes, returns users value else checks for filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_button_bg_color( $default_btn_bg_color ) {
	$color = '';

	if ( '' === $default_btn_bg_color ) {

		$color = apply_filters( 'uabb/global/button_bg_color', $default_btn_bg_color );// @codingStandardsIgnoreLine.

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_button_bg_color', $default_btn_bg_color );
		}
	} else {
		$color = $default_btn_bg_color;
	}

	return $color;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default_btn_bg_color Checks if user has set the color, if yes, returns users value else checks for filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_default_button_bg_color( $default_btn_bg_color ) {
	$color = '';

	if ( '' === $default_btn_bg_color ) {

		$color = apply_filters( 'uabb/global/button_bg_color', $default_btn_bg_color );// @codingStandardsIgnoreLine.

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_default_button_bg_color', $default_btn_bg_color );
		}
	} else {
		$color = $default_btn_bg_color;
	}

	return $color;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default_btn_bg_hover_color Checks if user has set the color, if yes, returns users value else checks
 * for filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_button_bg_hover_color( $default_btn_bg_hover_color ) {
	$color = '';

	if ( '' === $default_btn_bg_hover_color ) {

		$color = apply_filters( 'uabb/global/button_bg_hover_color', $default_btn_bg_hover_color );// @codingStandardsIgnoreLine.

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_button_bg_hover_color', $default_btn_bg_hover_color );
		}
	} else {
		$color = $default_btn_bg_hover_color;
	}

	return $color;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default_btn_bg_hover_color Checks if user has set the color, if yes, returns users value else checks
 * for filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_default_button_bg_hover_color( $default_btn_bg_hover_color ) {
	$color = '';

	if ( '' === $default_btn_bg_hover_color ) {

		$color = apply_filters( 'uabb/global/button_bg_hover_color', $default_btn_bg_hover_color );// @codingStandardsIgnoreLine.

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_default_button_bg_hover_color', $default_btn_bg_hover_color );
		}
	} else {
		$color = $default_btn_bg_hover_color;
	}

	return $color;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default_btn_text_color Checks if user has set the color, if yes, returns users value else checks
 * for filtered value.
 * @return string - hex value for the color
 */
function uabb_theme_button_text_color( $default_btn_text_color ) {
	$color = '';

	if ( '' === $default_btn_text_color ) {

		$color = apply_filters( 'uabb/global/button_text_color', $default_btn_text_color );// @codingStandardsIgnoreLine.

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_button_text_color', $default_btn_text_color );
		}
	} else {
		$color = $default_btn_text_color;
	}

	return $color;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default_btn_text_color Checks if user has set the text color, if yes, returns users value else checks
 * for filtered value.
 * @return string - hex value for the text color
 */
function uabb_theme_default_button_text_color( $default_btn_text_color ) {
	$color = '';

	if ( '' === $default_btn_text_color ) {

		$color = apply_filters( 'uabb/global/button_text_color', $default_btn_text_color );// @codingStandardsIgnoreLine.

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_default_button_text_color', $default_btn_text_color );
		}
	} else {
		$color = $default_btn_text_color;
	}

	return $color;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default_btn_text_hover_color Checks if user has set the text hover color, if yes, returns users value else checks
 * for filtered value.
 *
 * @return string - hex value for the text hover color
 */
function uabb_theme_button_text_hover_color( $default_btn_text_hover_color ) {
	$color = '';

	if ( '' === $default_btn_text_hover_color ) {

		$color = apply_filters( 'uabb/global/button_text_hover_color', $default_btn_text_hover_color );// @codingStandardsIgnoreLine.

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_button_text_hover_color', $default_btn_text_hover_color );
		}
	} else {
		$color = $default_btn_text_hover_color;
	}

	return $color;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default_btn_text_hover_color Checks if user has set the text hover color, if yes, returns users value else checks
 * for filtered value.
 *
 * @return string - hex value for the text hover color
 */
function uabb_theme_default_button_text_hover_color( $default_btn_text_hover_color ) {
	$color = '';

	if ( '' === $default_btn_text_hover_color ) {

		$color = apply_filters( 'uabb/global/button_text_hover_color', $default_btn_text_hover_color );// @codingStandardsIgnoreLine.

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_default_button_text_hover_color', $default_btn_text_hover_color );
		}
	} else {
		$color = $default_btn_text_hover_color;
	}

	return $color;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default_btn_padding Checks if user has set the color, if yes, returns users value else checks
 * for filtered value.
 * @return string - padding value
 */
function uabb_theme_button_padding( $default_btn_padding ) {
	$padding = '';

	if ( '' === $default_btn_padding ) {

		$padding = apply_filters( 'uabb/global/button_padding', $default_btn_padding );// @codingStandardsIgnoreLine.

		if ( '' === $padding ) {
			$padding = apply_filters( 'uabb/theme/button_padding', $default_btn_padding );// @codingStandardsIgnoreLine.
			if ( '' === $padding ) {
				$padding = '12px 24px';
			}
		}
	} else {
		$padding = $default_btn_padding;
	}

	return $padding;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default_btn_padding Checks if user has set the padding, if yes, returns users value else checks
 * for filtered value.
 * @return string - padding value
 */
function uabb_theme_default_button_padding( $default_btn_padding ) {
	$padding = '';

	if ( '' === $default_btn_padding ) {

		$padding = apply_filters( 'uabb/global/button_padding', $default_btn_padding );// @codingStandardsIgnoreLine.

		if ( '' === $padding ) {
			$padding = apply_filters( 'uabb_theme_default_button_padding', $default_btn_padding );// @codingStandardsIgnoreLine.
		}
	} else {
		$padding = $default_btn_padding;
	}

	return $padding;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default_btn_vertical_padding Checks if user has set the padding, if yes, returns users value else checks
 * for filtered value.
 * @return string - padding value
 */
function uabb_theme_button_vertical_padding( $default_btn_vertical_padding ) {
	$padding = '';

	if ( '' === $default_btn_vertical_padding ) {

		$padding = apply_filters( 'uabb/global/button_vertical_padding', $default_btn_vertical_padding );// @codingStandardsIgnoreLine.

		if ( '' === $padding ) {
			$padding = apply_filters( 'uabb_theme_button_vertical_padding', $default_btn_vertical_padding );
			if ( '' === $padding ) {
				$padding = '12';
			}
		}
	} else {
		$padding = $default_btn_vertical_padding;
	}

	return $padding;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default_btn_horizontal_padding checks if user has set the padding, if yes, returns users value else checks
 * for filtered value.
 * @return string - padding value
 */
function uabb_theme_button_horizontal_padding( $default_btn_horizontal_padding ) {
	$padding = '';

	if ( '' === $default_btn_horizontal_padding ) {

		$padding = apply_filters( 'uabb/global/button_horizontal_padding', $default_btn_horizontal_padding );// @codingStandardsIgnoreLine.

		if ( '' === $padding ) {
			$padding = apply_filters( 'uabb_theme_button_horizontal_padding', $default_btn_horizontal_padding );
			if ( '' === $padding ) {
				$padding = '24';
			}
		}
	} else {
		$padding = $default_btn_horizontal_padding;
	}

	return $padding;
}

/**
 * Provide option to override the element defaults from theme options.
 *
 * @param var $default_btn_border_radius Checks if user has set the radius, if yes, returns users value else checks
 * for filtered value.
 * @return string - radius value
 */
function uabb_theme_button_border_radius( $default_btn_border_radius ) {
	$radius = '';

	if ( '' === $default_btn_border_radius ) {

		$radius = apply_filters( 'uabb/global/button_border_radius', $default_btn_border_radius ); // @codingStandardsIgnoreLine.

		if ( '' === $radius ) {
			$radius = apply_filters( 'uabb_theme_button_border_radius', $default_btn_border_radius );
			if ( '' === $radius ) {
				$radius = '4';
			}
		}
	} else {
		$radius = $default_btn_border_radius;
	}
	return $radius;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default_btn_border_width Checks if user has set the width, if yes, returns users value else checks
 * for filtered value.
 * @return string - width value
 */
function uabb_theme_button_border_width( $default_btn_border_width ) {
	$width = array();

	if ( '' === $default_btn_border_width ) {

		$width = apply_filters( 'uabb_global_button_border_width', $default_btn_border_width );

		if ( '' === $width ) {
			$width = apply_filters( 'uabb_theme_button_border_width', $default_btn_border_width );
		}
	} else {
		$width = $default_btn_border_width;
	}
	return $width;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default_btn_border_color Checks if user has set the color, if yes, returns users value else checks for
 * filtered value.
 * @return string - hex value for the border color
 */
function uabb_theme_border_color( $default_btn_border_color ) {
	$color = '';

	if ( '' === $default_btn_border_color ) {

		$color = apply_filters( 'uabb_global_border_color', $default_btn_border_color );

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_border_color', $default_btn_border_color );
		}
	} else {
		$color = $default_btn_border_color;
	}

	return $color;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default_btn_border_hover_color Checks if user has set the hover color, if yes, returns users value else checks for
 * filtered value.
 * @return string - hex value for the border hover color
 */
function uabb_theme_border_hover_color( $default_btn_border_hover_color ) {
	$color = '';

	if ( '' === $default_btn_border_hover_color ) {

		$color = apply_filters( 'uabb_global_border_hover_color', $default_btn_border_hover_color );

		if ( '' === $color ) {
			$color = apply_filters( 'uabb_theme_border_hover_color', $default_btn_border_hover_color );
		}
	} else {
		$color = $default_btn_border_hover_color;
	}

	return $color;
}
/**
 * Provide option to parse a color code.
 *
 * @param string $code Returns a hex value for color from rgba or #hex color.
 * @return string - hex value for the color
 */
function uabb_parse_color_to_hex( $code = '' ) {
	$color = '';
	$hex   = '';
	if ( '' !== $code ) {
		if ( false !== strpos( $code, 'rgba' ) ) {
			$code  = ltrim( $code, 'rgba(' );
			$code  = rtrim( $code, ')' );
			$rgb   = explode( ',', $code );
			$hex  .= str_pad( dechex( $rgb[0] ), 2, '0', STR_PAD_LEFT );
			$hex  .= str_pad( dechex( $rgb[1] ), 2, '0', STR_PAD_LEFT );
			$hex  .= str_pad( dechex( $rgb[2] ), 2, '0', STR_PAD_LEFT );
			$color = $hex;
		} else {
			$color = ltrim( $code, '#' );
		}
	}
	return $color;
}
/**
 * Provide option to parse a Border param.
 *
 * @since 1.3.1
 * @param mixed $default_btn_border Checks if user has set the Border, if yes, returns users value else checks for
 * filtered value.
 * @return array - Border value for the Button
 */
function uabb_theme_border( $default_btn_border ) {

	$border_width  = uabb_theme_button_border_width( '' );
	$border_color  = uabb_theme_border_color( '' );
	$border_radius = uabb_theme_button_border_radius( '' );
	$border        = array();

	if ( is_array( $default_btn_border ) && ( ! empty( $default_btn_border['style'] ) || ! empty( $default_btn_border['color'] ) || ! empty( $default_btn_border['width']['top'] ) || ! empty( $default_btn_border['width']['bottom'] ) || ! empty( $default_btn_border['width']['left'] ) || ! empty( $default_btn_border['width']['right'] ) || ! empty( $default_btn_border['radius']['top_left'] ) || ! empty( $default_btn_border['radius']['top_right'] ) || ! empty( $default_btn_border['radius']['bottom_left'] ) || ! empty( $default_btn_border['radius']['bottom_right'] ) ) ) {

		$border = $default_btn_border;
	} elseif ( is_object( $default_btn_border ) && ( ! empty( $default_btn_border->style ) || ! empty( $default_btn_border->color ) || ! empty( $default_btn_border->width->top ) || ! empty( $default_btn_border->width->bottom ) || ! empty( $default_btn_border->width->left ) || ! empty( $default_btn_border->width->right ) || ! empty( $default_btn_border->radius->top_left ) || ! empty( $default_btn_border->radius->top_right ) || ! empty( $default_btn_border->radius->bottom_left ) || ! empty( $default_btn_border->radius->bottom_right ) ) ) {

		$border = (array) $default_btn_border; // Cast objects to arrays when using them as $default.

	} else {

		if ( is_array( $border_width ) && ! empty( $border_width ) ) {

			$border['width'] = array(
				'top'    => ( array_key_exists( 'top', $border_width ) ) ? $border_width['top'] : '',
				'right'  => ( array_key_exists( 'right', $border_width ) ) ? $border_width['right'] : '',
				'bottom' => ( array_key_exists( 'bottom', $border_width ) ) ? $border_width['bottom'] : '',
				'left'   => ( array_key_exists( 'left', $border_width ) ) ? $border_width['left'] : '',
			);
		}

		$border['color'] = ( ! empty( $border_color ) ) ? substr( $border_color, 1 ) : '';

		$border['style'] = 'solid';

		if ( '' !== $border_radius ) {

			$border['radius'] = array(
				'top_left'     => $border_radius,
				'top_right'    => $border_radius,
				'bottom_left'  => $border_radius,
				'bottom_right' => $border_radius,
			);
		}
	}
	return $border;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param var $default_btn_typography Checks if user has set the radius, if yes, returns users value else checks
 * for filtered value.
 * @return array - typography value
 */
function uabb_theme_button_typography( $default_btn_typography ) {

	$typography     = array();
	$font_family    = array(
		'family'      => '',
		'font_weight' => '',
	);
	$font_size      = uabb_theme_default_button_font_size( '' );
	$line_height    = uabb_theme_default_button_line_height( '' );
	$text_transform = uabb_theme_default_button_text_transform( '' );
	$font_family    = uabb_theme_button_font_family( $font_family );
	$letter_spacing = uabb_theme_default_button_letter_spacing( '' );

	$typography['desktop-font_size']      = array();
	$typography['desktop_font_family']    = array();
	$typography['desktop_line_transform'] = array();

	if ( is_array( $default_btn_typography ) && ( ( array_key_exists( 'font_family', $default_btn_typography ) && 'Default' !== $default_btn_typography['font_family'] ) || ( array_key_exists( 'default', $default_btn_typography ) && 'default' !== $default_btn_typography['font_weight'] ) || ! empty( $default_btn_typography['font_size']['length'] ) || ! empty( $default_btn_typography['line_height']['length'] ) || ! empty( $default_btn_typography['text_transform'] ) ) ) {

		$typography['desktop'] = $default_btn_typography;

	} elseif ( '' !== $default_btn_typography && is_object( $default_btn_typography ) && ( property_exists( $default_btn_typography, 'font_family' ) && ( 'Default' !== $default_btn_typography->font_family ) || ( property_exists( $default_btn_typography, 'font_weight' ) && 'default' !== $default_btn_typography->font_weight ) || ! empty( $default_btn_typography->font_size->length ) || ! empty( $default_btn_typography->line_height->length ) || ! empty( $default_btn_typography->text_transform ) ) ) {

		$typography['desktop'] = $default_btn_typography;

	} else {

		if ( ! empty( $font_size ) && is_array( $font_size ) ) {

			$typography['desktop-font_size'] = array(
				'font_size' => array(
					'length' => ( array_key_exists( 'desktop', $font_size ) && ! empty( $font_size['desktop'] ) ) ? $font_size['desktop'] : '',
					'unit'   => ( array_key_exists( 'desktop-unit', $font_size ) && ! empty( $font_size['desktop-unit'] ) ) ? $font_size['desktop-unit'] : '',
				),
			);

			$typography['tablet'] = array(
				'font_size' => array(
					'length' => ( array_key_exists( 'tablet', $font_size ) && ! empty( $font_size['tablet'] ) ) ? $font_size['tablet'] : '',
					'unit'   => ( array_key_exists( 'tablet-unit', $font_size ) && ! empty( $font_size['tablet-unit'] ) ) ? $font_size['tablet-unit'] : '',
				),
			);

			$typography['mobile'] = array(
				'font_size' => array(
					'length' => ( array_key_exists( 'mobile', $font_size ) && ! empty( $font_size['mobile'] ) ) ? $font_size['mobile'] : '',
					'unit'   => ( array_key_exists( 'mobile-unit', $font_size ) && ! empty( $font_size['mobile-unit'] ) ) ? $font_size['mobile-unit'] : '',
				),
			);
		}
		if ( ! empty( $font_family ) && is_array( $font_family ) ) {

			$typography['desktop_font_family'] = array(
				'font_family' => ( array_key_exists( 'family', $font_family ) && ! empty( $font_family['family'] ) ) ? $font_family['family'] : '',
				'font_weight' => ( array_key_exists( 'weight', $font_family ) && ! empty( $font_family['weight'] ) ) ? $font_family['weight'] : '',
			);
		}

		$typography['desktop_line_transform'] = array(

			'line_height'    => array(
				'length' => ( ! empty( $line_height ) ) ? $line_height : '',
				'unit'   => '',
			),
			'text_transform' => ( ! empty( $text_transform ) ) ? $text_transform : '',
			'letter_spacing' => array(
				'length' => ( ! empty( $letter_spacing ) ) ? $letter_spacing : '',
				'unit'   => 'px',
			),
		);

		$typography['desktop'] = array_merge( $typography['desktop-font_size'], $typography['desktop_font_family'], $typography['desktop_line_transform'] );
		unset( $typography['desktop-font_size'] );
		unset( $typography['desktop_font_family'] );
		unset( $typography['desktop_line_transform'] );
	}
	return $typography;
}
/**
 * Provide option to override the element defaults from theme options.
 *
 * @since 1.3.1
 * @param string $mode  The mode of padding (e.g., 'top', 'bottom', etc.).
 * @param string $value Checks if user has set the Padding, if yes, returns users value else checks.
 * @return string - Padding value
 */
function uabb_theme_padding_button( $mode, $value ) {

	$padding = uabb_theme_default_button_padding( '' );

	$new_padding = '';

	$unit = $mode . '-unit';

	if ( is_array( $padding ) && array_key_exists( $mode, $padding ) && array_key_exists( $value, $padding[ $mode ] ) ) {

		$padding_unit = array_key_exists( $unit, $padding ) ? $padding[ $unit ] : 'px;';

		$new_padding = $padding[ $mode ][ $value ] . $padding[ $unit ];
	}

	return $new_padding;
}
