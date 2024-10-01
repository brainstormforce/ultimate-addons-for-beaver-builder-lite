<?php
/**
 *  UABB Gradient file
 * This initializes UABB Gradient
 *
 *  @package UABB Gradient
 */

if ( ! class_exists( 'UABB_Gradient' ) ) {
	/**
	 * This class initializes Gradient
	 *
	 * @class UABB_Gradient
	 */
	class UABB_Gradient {
		/**
		 * Constructor function that initializes required actions
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'fl_builder_control_uabb-gradient', array( $this, 'uabb_gradient' ), 1, 4 );
			add_action( 'fl_builder_custom_fields', array( $this, 'ui_fields' ), 10, 1 );
		}

		/**
		 * Function that renders row's CSS
		 *
		 * @since 1.0
		 * @param array<string, mixed> $fields gets the fields for the gradient.
		 * @return array<string, mixed>
		 */
		public function ui_fields( $fields ) {
			$fields['uabb-gradient'] = BB_ULTIMATE_ADDON_DIR . 'fields/uabb-gradient/ui-field-uabb-gradient.php';

			return $fields;
		}

		/**
		 * Function that renders row's CSS
		 * Declaration of array
		 * Ex. 'YOUR_VARIABLE_NAME'     => array(
		 * 'type'    => 'uabb-gradient',
		 * 'label'   => __( 'Gradient', 'uabb' ),
		 * 'default'  => array  //Required NULL or Default value
		 * 'color_one' => '',
		 * 'color_two' => '',
		 * 'angle'     => '0',
		 *  )
		 *  )
		 * Note : Default value is required here. Either pass it NULL or enter your own value.
		 * How to access variables
		 * fl-node-<?php echo $id; ?> .YOUR-CLASS{
		 *  <?php UABB_Helper::uabb_gradient_css( $settings->YOUR_VARIABLE_NAME ); ?>
		 * }
		 *
		 * @since 1.0
		 * @param var    $name gets the name for the gradient field.
		 * @param array  $value gets an array of gradient values.
		 * @param array  $field gets an array of field values.
		 * @param object $settings gets the object of respective fields.
		 * @return void
		 */
		public function uabb_gradient( $name, $value, $field, $settings ) {

			$name_new = 'uabb_' . $name;
			$value    = (array) $value;
			$preview  = json_encode( array( 'type' => 'refresh' ) ); //	phpcs:ignore WordPress.WP.AlternativeFunctions.json_encode_json_encode	

			$default   = ( isset( $field['default'] ) && '' !== $field['default'] ) ? $field['default'] : '';
			$direction = array(
				'left_right' => 'Left to Right',
				'right_left' => 'Right to Left',
				'top_bottom' => 'Top to Bottom',
				'bottom_top' => 'Bottom to Top',
				'custom'     => 'Custom',
			);

			$colorpick_class = 'bb-colorpick';
			$html            = '<div class="uabb-gradient-wrapper ' . $colorpick_class . '">';

			/* Color One */
			$color_one_class = ( empty( $value['color_one'] ) ) ? ' fl-color-picker-empty' : '';
			$html           .= '<div class="uabb-gradient-item bb-color uabb-gradient-color-one fl-field" data-type="color" data-preview=\'' . $preview . '\'>';
			$html           .= '<label for="uabb-gradient-color-one" class="uabb-gradient-label">Color 1</label>';
			$html           .= '<div class="fl-color-picker">';
			$html           .= '<div class="fl-color-picker-color' . $color_one_class . '"></div>';
			$html           .= '<div class="fl-color-picker-clear"><div class="fl-color-picker-icon-remove"></div></div>';
			$html           .= '<input name="' . $name . '[][color_one]' . '" type="hidden" value="' . $value['color_one'] . '" class="fl-color-picker-value" />';
			$html           .= '</div>';
			$html           .= '</div>';

			/* Color Two */
			$color_two_class = ( empty( $value['color_two'] ) ) ? ' fl-color-picker-empty' : '';
			$html           .= '<div class="uabb-gradient-item bb-color uabb-gradient-color-two fl-field" data-type="color" data-preview=\'' . $preview . '\'>';
			$html           .= '<label for="uabb-gradient-color-two" class="uabb-gradient-label">Color 2</label>';
			$html           .= '<div class="fl-color-picker">';
			$html           .= '<div class="fl-color-picker-color' . $color_two_class . '"></div>';
			$html           .= '<div class="fl-color-picker-clear"><div class="fl-color-picker-icon-remove"></div></div>';
			$html           .= '<input name="' . $name . '[][color_two]' . '" type="hidden" value="' . $value['color_two'] . '" class="fl-color-picker-value" />';
			$html           .= '</div>';
			$html           .= '</div>';

			/* Direction */
			$html .= '<div class="uabb-gradient-item uabb-gradient-direction fl-field" data-type="select" data-preview=\'' . $preview . '\'>';
			$html .= '<label for="uabb-gradient-direction" class="uabb-gradient-label">Direction</label>';
			$html .= '<select name="' . $name . '[][direction]' . '" class="uabb-gradient-direction-select">';
			foreach ( $direction as $direction_key => $direction_value ) {
				$selected = '';
				if ( $direction_key === $value['direction'] ) {
					$selected = 'selected="selected"';
				}
				$html .= '<option value="' . $direction_key . '" ' . $selected . '>' . $direction_value . '</option>';
			}
			$html .= '</select>';
			$html .= '</div>';

			/* Angle */
			$angle = ( isset( $value['angle'] ) ) ? $value['angle'] : '';
			$html .= '<div class="uabb-gradient-item uabb-gradient-angle fl-field" data-type="text" data-preview=\'' . $preview . '\' >';
			$html .= '<label for="uabb-gradient-angle" class="uabb-gradient-label">Angle</label>';
			$html .= '<input type="text" class="uabb-gradient-angle-input" name="' . $name . '[][angle]' . '" maxlength="3" size="6" value="' . $angle . '" />';
			$html .= '<span class="fl-field-description">deg</span>';
			$html .= '</div>';
			$html .= '</div>';

			echo wp_kses_post( $html );
		}
	}
	new UABB_Gradient();
}
