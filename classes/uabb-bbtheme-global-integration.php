<?php
/**
 * Global Filters for Beaver Builder theme customizer values
 *
 * @package Beaver Builder Theme Global Integration
 */

if ( ! class_exists( 'UABB_BBThemeGlobalIntegration' ) ) {
	/**
	 * This class initializes BB options and required fields
	 *
	 * @class UABB_BBThemeGlobalIntegration
	 */
	class UABB_BBThemeGlobalIntegration {
		/**
		 * Gets the Beaver Builder theme's options
		 *
		 * @var $bb_options
		 */
		public $bb_options;
		/**
		 * Constructor function that initializes required actions and hooks
		 */
		function __construct() {
			/**
			 *  **
			 *  * Tracing Beaver Builder Theme Colors
			 *  **
			 *
			 *  # Theme
			 *  Primary Color           - Accent Color          - fl-accent
			 *  Primary Text Color      - Text Color            - fl-body-text-color
			 *
			 *  # Button
			 *  Background Color        - Accent Color          - fl-accent
			 *  Background Hover Color  - Accent Hover Color    - fl-accent-hover
			 *  Text Color              - accent-fg-color       - accent-fg-color
			 *  Text Hover Color        - accent-fg-hover-color - accent-fg-hover-color
			 */

			/* Get BB Theme Customizer Options */
			$mods = FLCustomizer::get_mods();

			/* Primary Color */
			$var['theme_color'] = FLColor::hex( array( $mods['fl-accent'] ) );
			/* Primary Text Color */
			$var['theme_text_color'] = FLColor::hex( $mods['fl-body-text-color'] );

			/* Background Colors */
			$var['btn_bg_color']       = FLColor::hex( array( $mods['fl-accent'] ) );
			$var['btn_bg_hover_color'] = FLColor::hex( array( $mods['fl-accent-hover'] ) );

			/* Text Colors */
			$var['btn_text_color']       = FLColor::foreground( $var['btn_bg_color'] );
			$var['btn_text_hover_color'] = FLColor::foreground( $var['btn_bg_hover_color'] );

			$this->bb_options = $var;

			add_filter( 'uabb/global/theme_color', array( $this, 'uabb_global_theme_color' ) );
			add_filter( 'uabb/global/text_color', array( $this, 'uabb_global_text_color' ) );

			add_filter( 'uabb/global/button_bg_color', array( $this, 'uabb_global_button_bg_color' ) );
			add_filter( 'uabb/global/button_bg_hover_color', array( $this, 'uabb_global_button_bg_hover_color' ) );

			add_filter( 'uabb/global/button_text_color', array( $this, 'uabb_global_button_text_color' ) );
			add_filter( 'uabb/global/button_text_hover_color', array( $this, 'uabb_global_button_text_hover_color' ) );

		}

		/**
		 * Theme Color -
		 */
		function uabb_global_theme_color() {
			$color = $this->bb_options['theme_color'];

			return $color;
		}

		/**
		 * Theme Text Color -
		 */
		function uabb_global_text_color() {
			$color = $this->bb_options['theme_text_color'];

			return $color;
		}

		/**
		 * Button Background Color -
		 */
		function uabb_global_button_bg_color() {
			$color = $this->bb_options['btn_bg_color'];

			return $color;
		}


		/**
		 * Button Background Hover Color -
		 */
		function uabb_global_button_bg_hover_color() {
			$color = $this->bb_options['btn_bg_hover_color'];

			return $color;
		}

		/**
		 * Button Text Color -
		 */
		function uabb_global_button_text_color() {
			$color = $this->bb_options['btn_text_color'];

			return $color;
		}


		/**
		 * Button Text Hover Color -
		 */
		function uabb_global_button_text_hover_color() {
			$color = $this->bb_options['btn_text_hover_color'];

			return $color;
		}
	}

	new UABB_BBThemeGlobalIntegration();
}
