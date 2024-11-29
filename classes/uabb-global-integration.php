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

			add_filter( 'uabb/global/theme_color', [ $this, 'uabb_global_theme_color' ] );
			add_filter( 'uabb/global/text_color', [ $this, 'uabb_global_text_color' ] );

			add_filter( 'uabb/global/link_color', [ $this, 'uabb_global_link_color' ] );
			add_filter( 'uabb/global/link_hover_color', [ $this, 'uabb_global_link_hover_color' ] );

			add_filter( 'uabb/global/button_font_family', [ $this, 'uabb_global_button_font_family' ] );
			add_filter( 'uabb/global/button_font_size', [ $this, 'uabb_global_button_font_size' ] );
			add_filter( 'uabb/global/button_line_height', [ $this, 'uabb_global_button_line_height' ] );
			add_filter( 'uabb/global/button_letter_spacing', [ $this, 'uabb_global_button_letter_spacing' ] );
			add_filter( 'uabb/global/button_text_transform', [ $this, 'uabb_global_button_text_transform' ] );

			add_filter( 'uabb/global/button_text_color', [ $this, 'uabb_global_button_text_color' ] );
			add_filter( 'uabb/global/button_text_hover_color', [ $this, 'uabb_global_button_text_hover_color' ] );
			add_filter( 'uabb/global/button_bg_color', [ $this, 'uabb_global_button_bg_color' ] );
			add_filter( 'uabb/global/button_bg_hover_color', [ $this, 'uabb_global_button_bg_hover_color' ] );

			add_filter( 'uabb/global/button_border_radius', [ $this, 'uabb_global_button_border_radius' ] );
			add_filter( 'uabb/global/button_padding', [ $this, 'uabb_global_button_padding' ] );
			add_filter( 'uabb/global/button_vertical_padding', [ $this, 'uabb_global_button_vertical_padding' ] );
			add_filter( 'uabb/global/button_horizontal_padding', [ $this, 'uabb_global_button_horizontal_padding' ] );
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

			if ( isset( $uabb_setting_options->enable_global ) && ( $uabb_setting_options->enable_global === 'no' ) ) {
				return '';
			}
			if ( isset( $uabb_setting_options->$option ) && ! empty( $uabb_setting_options->$option ) ) {

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
			return $this->uabb_get_global_option( 'theme_color', true );
		}

		/**
		 * Text Color -
		 *
		 * @return string
		 */
		public function uabb_global_text_color() {
			return $this->uabb_get_global_option( 'theme_text_color', true );
		}

		/**
		 * Link Color -
		 *
		 * @return string
		 */
		public function uabb_global_link_color() {
			return $this->uabb_get_global_option( 'theme_link_color', true );
		}

		/**
		 * Link Hover Color -
		 *
		 * @return string
		 */
		public function uabb_global_link_hover_color() {
			return $this->uabb_get_global_option( 'theme_link_hover_color', true );
		}

		/**
		 * Button Font Family
		 *
		 * @return string
		 */
		public function uabb_global_button_font_family() {
			return '';
		}

		/**
		 * Button Font Size -
		 *
		 * @return string
		 */
		public function uabb_global_button_font_size() {
			return $this->uabb_get_global_option( 'btn_font_size' );
		}

		/**
		 * Button Line Height -
		 *
		 * @return string
		 */
		public function uabb_global_button_line_height() {
			return $this->uabb_get_global_option( 'btn_line_height' );
		}

		/**
		 * Button Letter Spacing -
		 *
		 * @return string
		 */
		public function uabb_global_button_letter_spacing() {
			return $this->uabb_get_global_option( 'btn_letter_spacing' );
		}

		/**
		 * Button Text Transform -
		 *
		 * @return string
		 */
		public function uabb_global_button_text_transform() {
			return $this->uabb_get_global_option( 'btn_text_transform' );
		}

		/**
		 * Button Text Color -
		 *
		 * @return string
		 */
		public function uabb_global_button_text_color() {
			return $this->uabb_get_global_option( 'btn_text_color', true );
		}

		/**
		 * Button Text Hover Color -
		 *
		 * @return string
		 */
		public function uabb_global_button_text_hover_color() {
			return $this->uabb_get_global_option( 'btn_text_hover_color', true );
		}

		/**
		 * Button Background Color -
		 *
		 * @return string
		 */
		public function uabb_global_button_bg_color() {
			return $this->uabb_get_global_option( 'btn_bg_color', true, true );
		}

		/**
		 * Button Background Hover Color -
		 *
		 * @return string
		 */
		public function uabb_global_button_bg_hover_color() {
			return $this->uabb_get_global_option( 'btn_bg_hover_color', true, true );
		}

		/**
		 * Button Border Radius -
		 *
		 * @return string
		 */
		public function uabb_global_button_border_radius() {
			return $this->uabb_get_global_option( 'btn_border_radius' );
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

			if ( $v_padding !== '' && $h_padding !== '' ) {
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

			return $this->uabb_get_global_option( 'btn_vertical_padding' );
		}
		/**
		 * Button Padding -
		 *
		 * @return string
		 */
		public function uabb_global_button_horizontal_padding() {
			$h_padding = '';

			return $this->uabb_get_global_option( 'btn_horizontal_padding' );
		}
	}

	new UABBGlobalSettingsOptions();
}
