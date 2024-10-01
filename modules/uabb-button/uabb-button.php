<?php
/**
 *  UABB Button Module file
 *
 *  @package UABB Button Module
 */

/**
 * Function that initializes UABB Button Module
 *
 * @class UABBButtonModule
 */
class UABBButtonModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Button Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'          => __( 'Button', 'uabb' ),
				'description'   => __( 'A simple call to action button.', 'uabb' ),
				'category'      => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$basic_modules ),
				'group'         => defined( 'UABB_CAT' ) ? UABB_CAT : '',
				'dir'           => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-button/',
				'url'           => BB_ULTIMATE_ADDON_URL . 'modules/uabb-button/',
				'editor_export' => true, // Defaults to true and can be omitted.
				'enabled'       => true, // Defaults to true and can be omitted.
				'icon'          => 'button.svg',
			)
		);
	}

	/**
	 * Function that gets the button styling.
	 *
	 * @method update
	 * @param object $settings gets the settings for the button module.
	 * @return object Updated settings object
	 */
	public function update( $settings ) {
		// Remove the old three_d setting.
		if ( isset( $settings->three_d ) ) {
			unset( $settings->three_d );
		}

		return $settings;
	}

	/**
	 * Function that gets the class names.
	 *
	 * @method get_classname
	 * @return string Classname for the button
	 */
	public function get_classname() {
		$classname = 'uabb-button-wrap uabb-creative-button-wrap';

		if ( ! empty( $this->settings->width ) ) {
			$classname .= ' uabb-button-width-' . $this->settings->width;
			$classname .= ' uabb-creative-button-width-' . $this->settings->width;
		}
		if ( ! empty( $this->settings->align ) ) {
			$classname .= ' uabb-button-' . $this->settings->align;
			$classname .= ' uabb-creative-button-' . $this->settings->align;
		}
		if ( ! empty( $this->settings->mob_align ) ) {
			$classname .= ' uabb-button-reponsive-' . $this->settings->mob_align;
			$classname .= ' uabb-creative-button-reponsive-' . $this->settings->mob_align;
		}
		if ( ! empty( $this->settings->icon ) ) {
			$classname .= ' uabb-button-has-icon';
			$classname .= ' uabb-creative-button-has-icon';
		}

		if ( empty( $this->settings->text ) ) {
			$classname .= ' uabb-creative-button-icon-no-text';
		}

		return $classname;
	}
	/**
	 * Function that gets the button styling.
	 *
	 * @method get_button_style
	 * @return string Button styling string
	 */
	public function get_button_style() {
		$btn_style = '';

		if ( ! empty( $this->settings->style ) && 'transparent' === $this->settings->style ) {
			if ( isset( $this->settings->transparent_button_options ) && ! empty( $this->settings->transparent_button_options ) ) {
				$btn_style .= ' uabb-' . $this->settings->transparent_button_options . '-btn';
			}
		}

		if ( ! empty( $this->settings->style ) && 'threed' === $this->settings->style ) {
			if ( isset( $this->settings->threed_button_options ) && ! empty( $this->settings->threed_button_options ) ) {
				$btn_style .= ' uabb-' . $this->settings->threed_button_options . '-btn';
			}
		}

		if ( ! empty( $this->settings->style ) && 'flat' === $this->settings->style ) {
			if ( isset( $this->settings->flat_button_options ) && ! empty( $this->settings->flat_button_options ) ) {
				$btn_style .= ' uabb-' . $this->settings->flat_button_options . '-btn';
			}
		}

		return $btn_style;
	}
	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.14.0
	 * @param object $settings A module settings object.
	 * @param object $helper A settings compatibility helper.
	 * @return object
	 */
	public function filter_settings( $settings, $helper ) {

		$version_bb_check        = UABB_Lite_Compatibility::Check_BB_Version();
		$page_migrated           = UABB_Lite_Compatibility::Check_Old_Page_Migration();
		$stable_version_new_page = UABB_Lite_Compatibility::Check_Stable_Version_New_page();

		if ( $version_bb_check && ( 'yes' === $page_migrated || 'yes' === $stable_version_new_page ) ) {

			// Handle color opacity fields.
			$helper->handle_opacity_inputs( $settings, 'bg_color_opc', 'bg_color' );
			$helper->handle_opacity_inputs( $settings, 'bg_hover_color_opc', 'bg_hover_color' );

			if ( ! isset( $settings->button_typo ) || ! is_array( $settings->button_typo ) ) {
				$settings->button_typo            = array();
				$settings->button_typo_medium     = array();
				$settings->button_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['family'] ) ) {

					$settings->button_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
				if ( isset( $settings->font_family['weight'] ) ) {

					if ( 'regular' === $settings->font_family['weight'] ) {
						$settings->button_typo['font_weight'] = 'normal';
					} else {
						$settings->button_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
				}
			}
			if ( isset( $settings->font_size_unit ) ) {

				$settings->button_typo['font_size'] = array(
					'length' => $settings->font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit );
			}
			if ( isset( $settings->font_size_unit_medium ) ) {
				$settings->button_typo_medium['font_size'] = array(
					'length' => $settings->font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_medium );
			}
			if ( isset( $settings->font_size_unit_responsive ) ) {
				$settings->button_typo_responsive['font_size'] = array(
					'length' => $settings->font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->font_size_unit_responsive );
			}
			if ( isset( $settings->line_height_unit ) ) {

				$settings->button_typo['line_height'] = array(
					'length' => $settings->line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit );
			}
			if ( isset( $settings->line_height_unit_medium ) ) {
				$settings->button_typo_medium['line_height'] = array(
					'length' => $settings->line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_medium );
			}
			if ( isset( $settings->line_height_unit_responsive ) ) {
				$settings->button_typo_responsive['line_height'] = array(
					'length' => $settings->line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_responsive );
			}
			if ( isset( $settings->transform ) ) {
				$settings->button_typo['text_transform'] = $settings->transform;
				unset( $settings->transform );
			}
			if ( isset( $settings->letter_spacing ) ) {
				$settings->button_typo['letter_spacing'] = array(
					'length' => $settings->letter_spacing,
					'unit'   => 'px',
				);
				unset( $settings->letter_spacing );
			}
			if ( isset( $settings->link_nofollow ) ) {
				if ( '1' === $settings->link_nofollow || 'yes' === $settings->link_nofollow ) {
					$settings->link_nofollow = 'yes';
				}
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {

			// Handle color opacity fields.
			$helper->handle_opacity_inputs( $settings, 'bg_color_opc', 'bg_color' );
			$helper->handle_opacity_inputs( $settings, 'bg_hover_color_opc', 'bg_hover_color' );

			if ( ! isset( $settings->button_typo ) || ! is_array( $settings->button_typo ) ) {
				$settings->button_typo            = array();
				$settings->button_typo_medium     = array();
				$settings->button_typo_responsive = array();
			}
			if ( isset( $settings->font_family ) ) {

				if ( isset( $settings->font_family['family'] ) ) {

					$settings->button_typo['font_family'] = $settings->font_family['family'];
					unset( $settings->font_family['family'] );
				}
				if ( isset( $settings->font_family['weight'] ) ) {

					if ( 'regular' === $settings->font_family['weight'] ) {
						$settings->button_typo['font_weight'] = 'normal';
					} else {
						$settings->button_typo['font_weight'] = $settings->font_family['weight'];
					}
					unset( $settings->font_family['weight'] );
				}
			}
			if ( isset( $settings->font_size['desktop'] ) ) {
				$settings->button_typo['font_size'] = array(
					'length' => $settings->font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['medium'] ) ) {
				$settings->button_typo_medium['font_size'] = array(
					'length' => $settings->font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->font_size['small'] ) ) {

				$settings->button_typo_responsive['font_size'] = array(
					'length' => $settings->font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 !== $settings->font_size['desktop'] ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->button_typo['line_height'] = array(
						'length' => round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 !== $settings->font_size['medium'] ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->button_typo_medium['line_height'] = array(
						'length' => round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 !== $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->button_typo_responsive['line_height'] = array(
						'length' => round( $settings->line_height['small'] / $settings->font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->link_nofollow ) ) {
				if ( '1' === $settings->link_nofollow || 'yes' === $settings->link_nofollow ) {
					$settings->link_nofollow = 'yes';
				}
			}
			if ( isset( $settings->font_size['desktop'] ) ) {
				unset( $settings->font_size['desktop'] );
			}
			if ( isset( $settings->font_size['medium'] ) ) {
				unset( $settings->font_size['medium'] );
			}
			if ( isset( $settings->font_size['small'] ) ) {
				unset( $settings->font_size['small'] );
			}
			if ( isset( $settings->line_height['desktop'] ) ) {
				unset( $settings->line_height['desktop'] );
			}
			if ( isset( $settings->line_height['medium'] ) ) {
				unset( $settings->line_height['medium'] );
			}
			if ( isset( $settings->line_height['small'] ) ) {
				unset( $settings->line_height['small'] );
			}
		}
		return $settings;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Lite_Compatibility::Check_BB_Version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-button/uabb-button-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-button/uabb-button-bb-less-than-2-2-compatibility.php';
}
