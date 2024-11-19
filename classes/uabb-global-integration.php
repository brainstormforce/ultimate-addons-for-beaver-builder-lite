<?php
/**
 * Global Filters from uabb settings global values to override defaullts in UABB
 *
 * @package Next
 */

if ( ! class_exists( 'UABBGlobalSettingsOptions' ) ) {
	/**
	 * This class initializes UABB Global Settings Options
	 *
	 * @class UABBGlobalSettingsOptions
	 */
	class UABBGlobalSettingsOptions {
		/**
		 * Constructor function that initializes necessary filters
		 *
		 * @var mixed $uabb_setting_options gets the uabb setting options
		 */
		public $uabb_setting_options;
		/**
		 * Constructor function that initializes necessary filters
		 *
		 * @since 1.0
		 */
		public function __construct() {

			$this->uabb_setting_options = UABB_Global_Styling::get_uabb_global_settings();

			add_filter( 'uabb/global/theme_color', array( $this, 'uabb_global_theme_color' ) );
			add_filter( 'uabb/global/text_color', array( $this, 'uabb_global_text_color' ) );

			add_filter( 'uabb/global/link_color', array( $this, 'uabb_global_link_color' ) );
			add_filter( 'uabb/global/link_hover_color', array( $this, 'uabb_global_link_hover_color' ) );

			add_filter( 'uabb/global/button_font_family', array( $this, 'uabb_global_button_font_family' ) );
			add_filter( 'uabb/global/button_font_size', array( $this, 'uabb_global_button_font_size' ) );
			add_filter( 'uabb/global/button_line_height', array( $this, 'uabb_global_button_line_height' ) );
			add_filter( 'uabb/global/button_letter_spacing', array( $this, 'uabb_global_button_letter_spacing' ) );
			add_filter( 'uabb/global/button_text_transform', array( $this, 'uabb_global_button_text_transform' ) );

			add_filter( 'uabb/global/button_text_color', array( $this, 'uabb_global_button_text_color' ) );
			add_filter( 'uabb/global/button_text_hover_color', array( $this, 'uabb_global_button_text_hover_color' ) );
			add_filter( 'uabb/global/button_bg_color', array( $this, 'uabb_global_button_bg_color' ) );
			add_filter( 'uabb/global/button_bg_hover_color', array( $this, 'uabb_global_button_bg_hover_color' ) );

			add_filter( 'uabb/global/button_border_radius', array( $this, 'uabb_global_button_border_radius' ) );
			add_filter( 'uabb/global/button_padding', array( $this, 'uabb_global_button_padding' ) );
			add_filter( 'uabb/global/button_vertical_padding', array( $this, 'uabb_global_button_vertical_padding' ) );
			add_filter( 'uabb/global/button_horizontal_padding', array( $this, 'uabb_global_button_horizontal_padding' ) );
		}
		/**
		 * Function that initializes global settings options
		 *
		 * @since 1.0
		 * @param object $option gets the options for the UABB settings.
		 * @param bool   $color gets the color.
		 * @param bool   $opc gets the opacity for the colorpicker.
		 * @return string
		 */
		public function uabb_get_global_option( $option, $color = false, $opc = false ) {
			$uabb_setting_options = $this->uabb_setting_options;

			if ( isset( $uabb_setting_options->enable_global ) && ( 'no' === $uabb_setting_options->enable_global ) ) {
				return '';
			} elseif ( isset( $uabb_setting_options->$option ) && ! empty( $uabb_setting_options->$option ) ) {

				if ( $color ) {
					$uabb_setting_options->$option = UABB_Helper::uabb_colorpicker( $uabb_setting_options, $option, $opc );
				}
				return $uabb_setting_options->$option;
			}

			return '';
		}
		/**
		 * Theme Color -
		 *
		 * @return string
		 */
		public function uabb_global_theme_color() {
			$color = $this->uabb_get_global_option( 'theme_color', true );

			return $color;
		}



		/**
		 * Text Color -
		 *
		 * @return string
		 */
		public function uabb_global_text_color() {
			$color = $this->uabb_get_global_option( 'theme_text_color', true );

			return $color;
		}



		/**
		 * Link Color -
		 *
		 * @return string
		 */
		public function uabb_global_link_color() {
			$color = $this->uabb_get_global_option( 'theme_link_color', true );

			return $color;
		}



		/**
		 * Link Hover Color -
		 *
		 * @return string
		 */
		public function uabb_global_link_hover_color() {
			$color = $this->uabb_get_global_option( 'theme_link_hover_color', true );

			return $color;
		}


		/**
		 * Button Font Family
		 *
		 * @return string
		 */
		public function uabb_global_button_font_family() {
			$btn_font_family = '';
			return $btn_font_family;
		}

		/**
		 * Button Font Size -
		 *
		 * @return string
		 */
		public function uabb_global_button_font_size() {
			$font_size = $this->uabb_get_global_option( 'btn_font_size' );

			return $font_size;
		}

		/**
		 * Button Line Height -
		 *
		 * @return string
		 */
		public function uabb_global_button_line_height() {
			$line_height = $this->uabb_get_global_option( 'btn_line_height' );

			return $line_height;
		}


		/**
		 * Button Letter Spacing -
		 *
		 * @return string
		 */
		public function uabb_global_button_letter_spacing() {
			$letter_spacing = $this->uabb_get_global_option( 'btn_letter_spacing' );

			return $letter_spacing;
		}


		/**
		 * Button Text Transform -
		 *
		 * @return string
		 */
		public function uabb_global_button_text_transform() {
			$text_transform = $this->uabb_get_global_option( 'btn_text_transform' );

			return $text_transform;
		}


		/**
		 * Button Text Color -
		 *
		 * @return string
		 */
		public function uabb_global_button_text_color() {
			$color = $this->uabb_get_global_option( 'btn_text_color', true );

			return $color;
		}


		/**
		 * Button Text Hover Color -
		 *
		 * @return string
		 */
		public function uabb_global_button_text_hover_color() {
			$color = $this->uabb_get_global_option( 'btn_text_hover_color', true );

			return $color;
		}


		/**
		 * Button Background Color -
		 *
		 * @return string
		 */
		public function uabb_global_button_bg_color() {
			$color = $this->uabb_get_global_option( 'btn_bg_color', true, true );

			return $color;
		}


		/**
		 * Button Background Hover Color -
		 *
		 * @return string
		 */
		public function uabb_global_button_bg_hover_color() {
			$color = $this->uabb_get_global_option( 'btn_bg_hover_color', true, true );

			return $color;
		}


		/**
		 * Button Border Radius -
		 *
		 * @return string
		 */
		public function uabb_global_button_border_radius() {
			$border_radius = $this->uabb_get_global_option( 'btn_border_radius' );

			return $border_radius;
		}



		/**
		 * Button Padding -
		 *
		 * @return string
		 */
		public function uabb_global_button_padding() {
			$padding = '';

			$v_padding = $this->uabb_get_global_option( 'btn_vertical_padding' );
			$h_padding = $this->uabb_get_global_option( 'btn_horizontal_padding' );

			if ( '' !== $v_padding && '' !== $h_padding ) {
				$padding = $v_padding . 'px ' . $h_padding . 'px';
			}

			return $padding;
		}
		/**
		 * Button Padding -
		 *
		 * @return string
		 */
		public function uabb_global_button_vertical_padding() {
			$v_padding = '';

			$v_padding = $this->uabb_get_global_option( 'btn_vertical_padding' );

			return $v_padding;
		}
		/**
		 * Button Padding -
		 *
		 * @return string
		 */
		public function uabb_global_button_horizontal_padding() {
			$h_padding = '';

			$h_padding = $this->uabb_get_global_option( 'btn_horizontal_padding' );

			return $h_padding;
		}
	}

	new UABBGlobalSettingsOptions();
}
