<?php
/**
 * Custom modules
 *
 * @package UABB Helper
 */

if ( ! class_exists( 'UABB_Helper' ) ) {
	/**
	 * This class initializes BB Ultiamte Addon Helper
	 *
	 * @class UABB_Helper
	 */
	class UABB_Helper {

		/**
		 * Helper function to render css styles for a selected font.
		 *
		 * @since  1.0
		 * @param  array $font An array with font-family and weight.
		 * @return void
		 */
		static public function uabb_font_css( $font ) {
			$css = '';

			if ( array_key_exists( $font['family'], FLBuilderFontFamilies::$system ) ) {
				$css .= 'font-family: ' . $font['family'] . ',' . FLBuilderFontFamilies::$system[ $font['family'] ]['fallback'] . ';';
			} else {
				$css .= 'font-family: ' . $font['family'] . ';';
			}

			if ( 'regular' == $font['weight'] ) {
				$css .= 'font-weight: normal;';
			} else {
				$css .= 'font-weight: ' . $font['weight'] . ';';
			}

			echo $css;
		}

		/**
		 * Initializes an array to replace recursive function
		 *
		 * @param var   $hex returns the bas values.
		 *
		 * @param array $opacity returns the replacements values.
		 */
		static public function uabb_get_color( $hex, $opacity ) {
			$rgba = $hex;
			if ( '' != $opacity ) {
				if ( 3 == strlen( $hex ) ) {
					$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
					$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
					$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
				} else {
					$r = hexdec( substr( $hex, 0, 2 ) );
					$g = hexdec( substr( $hex, 2, 2 ) );
					$b = hexdec( substr( $hex, 4, 2 ) );
				}
				return 'rgba( ' . $r . ', ' . $g . ', ' . $b . ', ' . $opacity . ' )';
			} else {
				return '#' . $hex;
			}
		}

		/**
		 * Initializes an array to replace recursive function
		 *
		 * @param var   $color returns the bas values.
		 *
		 * @param array $opacity returns the replacements values.
		 * @param array $is_array returns the replacements values.
		 */
		static public function uabb_hex2rgba( $color, $opacity = false, $is_array = false ) {

			$default = $color;

			// Return default if no color provided.
			if ( empty( $color ) ) {
				return $default;
			}

			// Sanitize $color if "#" is provided.
			if ( '#' == $color[0] ) {
				$color = substr( $color, 1 );
			}

			// Check if color has 6 or 3 characters and get values.
			if ( 6 == strlen( $color ) ) {
					$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( 3 == strlen( $color ) ) {
					$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
					return $default;
			}

			// Convert hexadec to rgb.
			$rgb = array_map( 'hexdec', $hex );

			// Check if opacity is set(rgba or rgb).
			if ( false !== $opacity && '' !== $opacity ) {
				if ( abs( $opacity ) > 1 ) {

					$opacity = $opacity / 100;
				}
				$output = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
			} else {
				$output = 'rgb(' . implode( ',', $rgb ) . ')';
			}

			if ( $is_array ) {
				return $rgb;
			} else {

				return $output;
			}
		}

		/**
		 * Initializes an array to replace recursive function
		 *
		 * @param var   $settings returns the bas values.
		 *
		 * @param array $name returns the replacements values.
		 * @param array $opc returns the replacements values.
		 */
		static public function uabb_colorpicker( $settings, $name = '', $opc = false ) {

			$hex_color = '';
			$opacity   = '';
			$hex_color = $settings->$name;

			if ( '' != $hex_color && 'r' != $hex_color[0] && 'R' != $hex_color[0] ) {

				if ( true == $opc && isset( $settings->{ $name . '_opc' } ) ) {
					if ( '' !== $settings->{ $name . '_opc' } ) {
						$opacity = $settings->{ $name . '_opc' };
						$rgba    = self::uabb_hex2rgba( $hex_color, $opacity / 100 );
						return $rgba;
					}
				}

				if ( '#' != $hex_color[0] ) {

					return '#' . $hex_color;
				}
			}

			return $hex_color;

		}

		/**
		 * Initializes an array to replace recursive function
		 *
		 * @param var $gradient returns the bas values.
		 */
		static public function uabb_gradient_css( $gradient ) {
			$gradient_angle = intval( $gradient['angle'] );
			$direction      = $gradient['direction'];
			$color1         = '';
			$color2         = '';
			$angle          = 0;
			$css            = '';

			if ( 'custom' != $direction ) {
				switch ( $direction ) {
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

			if ( isset( $gradient['color_one'] ) && '' != $gradient['color_one'] ) {
				$color1 = self::uabb_hex2rgba( $gradient['color_one'] );
			}

			if ( isset( $gradient['color_two'] ) && '' != $gradient['color_two'] ) {
				$color2 = self::uabb_hex2rgba( $gradient['color_two'] );
			}

			$angle = abs( $gradient_angle - 450 ) % 360;

			if ( '' != $color1 && '' != $color2 ) {

				$css .= 'background: -webkit-linear-gradient(' . $gradient_angle . 'deg, ' . $color1 . ' 0%, ' . $color2 . ' 100%);';
				$css .= 'background: -o-linear-gradient(' . $gradient_angle . 'deg, ' . $color1 . ' 0%, ' . $color2 . ' 100%);';
				$css .= 'background: -ms-linear-gradient(' . $gradient_angle . 'deg, ' . $color1 . ' 0%, ' . $color2 . ' 100%);';
				$css .= 'background: -moz-linear-gradient(' . $gradient_angle . 'deg, ' . $color1 . ' 0%, ' . $color2 . ' 100%);';
				$css .= 'background: linear-gradient(' . $angle . 'deg, ' . $color1 . ' 0%, ' . $color2 . ' 100%);';
			}
			echo $css;
		}
		/**
		 *  Get link rel attribute
		 *
		 *  @since 1.3.0
		 *  @param string $target gets an string for the link.
		 *  @param string $is_nofollow gets an string for is no follow.
		 *  @param string $echo gets an string for echo.
		 *  @return string
		 */
		static public function get_link_rel( $target, $is_nofollow = 0, $echo = 0 ) {

			$attr = '';
			if ( '_blank' == $target ) {
				$attr .= 'noopener';
			}

			if ( 1 == $is_nofollow || 'yes' == $is_nofollow ) {
				$attr .= ' nofollow';
			}

			if ( '' == $attr ) {
				return;
			}

			$attr = trim( $attr );
			if ( ! $echo ) {
				return 'rel="' . $attr . '"';
			}
			echo 'rel="' . $attr . '"';
		}
	}
}
