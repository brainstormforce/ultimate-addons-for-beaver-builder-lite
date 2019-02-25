<?php
/**
 *  UABB Heading module file
 *
 *  @package UABB Heading
 */

/**
 * Function that initializes UABB Heading Module
 *
 * @class UABBHeadingModule
 */
class UABBHeadingModule extends FLBuilderModule {

	/**
	 * Constructor function that constructs default values for the Heading module.
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Heading', 'uabb' ),
				'description'     => __( 'Display a title/page heading.', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$basic_modules ),
				'group'           => UABB_CAT,
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/uabb-heading/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/uabb-heading/',
				'partial_refresh' => true,
				'icon'            => 'text.svg',
			)
		);
	}

	/**
	 * Function that renders pos.
	 *
	 * @method render_image
	 */
	public function render_image() {
		if ( 'line_image' == $this->settings->separator_style || 'line_icon' == $this->settings->separator_style ) {
			$imageicon_array = array(

				/* General Section */
				'image_type'   => ( 'line_image' == $this->settings->separator_style ) ? 'photo' : ( ( 'line_icon' == $this->settings->separator_style ) ? 'icon' : '' ),

				/* Icon Basics */
				'icon'         => $this->settings->icon,
				'icon_size'    => $this->settings->icon_size,
				'icon_align'   => 'center',

				/* Image Basics */
				'photo_source' => $this->settings->photo_source,
				'photo'        => $this->settings->photo,
				'photo_url'    => $this->settings->photo_url,
				'img_size'     => $this->settings->img_size,
				'img_align'    => 'center',
				'photo_src'    => ( isset( $this->settings->photo_src ) ) ? $this->settings->photo_src : '',
			);

			/* Render HTML Function */
			if ( 'line_image' == $this->settings->separator_style ) {
				echo '<div class="uabb-image-outter-wrap">';
			}

			FLBuilder::render_module_html( 'image-icon', $imageicon_array );

			if ( 'line_image' == $this->settings->separator_style ) {
				echo '</div>';
			}
		}
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

		$version_bb_check        = UABB_Lite_Compatibility::check_bb_version();
		$page_migrated           = UABB_Lite_Compatibility::check_old_page_migration();
		$stable_version_new_page = UABB_Lite_Compatibility::check_stable_version_new_page();

		if ( $version_bb_check && ( 'yes' == $page_migrated || 'yes' == $stable_version_new_page ) ) {

			if ( ! isset( $settings->font_typo ) || ! is_array( $settings->font_typo ) ) {

				$settings->font_typo            = array();
				$settings->font_typo_medium     = array();
				$settings->font_typo_responsive = array();
			}
			if ( isset( $settings->font ) ) {

				if ( isset( $settings->font['family'] ) ) {

					$settings->font_typo['font_family'] = $settings->font['family'];
					unset( $settings->font['family'] );
				}
				if ( isset( $settings->font['weight'] ) ) {

					if ( 'regular' == $settings->font['weight'] ) {
						$settings->font_typo['font_weight'] = 'normal';
					} else {
						$settings->font_typo['font_weight'] = $settings->font['weight'];
					}
					unset( $settings->font['weight'] );
				}
			}
			if ( isset( $settings->new_font_size_unit ) ) {
				$settings->font_typo['font_size'] = array(
					'length' => $settings->new_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->new_font_size_unit );
			}
			if ( isset( $settings->new_font_size_unit_medium ) ) {
				$settings->font_typo_medium['font_size'] = array(
					'length' => $settings->new_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->new_font_size_unit_medium );
			}
			if ( isset( $settings->new_font_size_unit_responsive ) ) {
				$settings->font_typo_responsive['font_size'] = array(
					'length' => $settings->new_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->new_font_size_unit_responsive );
			}
			if ( isset( $settings->line_height_unit ) ) {

				$settings->font_typo['line_height'] = array(
					'length' => $settings->line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit );
			}
			if ( isset( $settings->line_height_unit_medium ) ) {
				$settings->font_typo_medium['line_height'] = array(
					'length' => $settings->line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_medium );
			}
			if ( isset( $settings->line_height_unit_responsive ) ) {
				$settings->font_typo_responsive['line_height'] = array(
					'length' => $settings->line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->line_height_unit_responsive );
			}
			// Compatibility for description typography settings.
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_font_family ) ) {

				if ( isset( $settings->desc_font_family['family'] ) ) {

					$settings->desc_font_typo['font_family'] = $settings->desc_font_family['family'];
					unset( $settings->desc_font_family['family'] );
				}
				if ( isset( $settings->desc_font_family['weight'] ) ) {

					if ( 'regular' == $settings->desc_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_font_family['weight'];
					}
					unset( $settings->desc_font_family['weight'] );
				}
			}
			if ( isset( $settings->desc_font_size_unit ) ) {

				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->desc_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit );
			}
			if ( isset( $settings->desc_font_size_unit_medium ) ) {
				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->desc_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit_medium );
			}

			if ( isset( $settings->desc_font_size_unit_responsive ) ) {
				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->desc_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->desc_font_size_unit_responsive );
			}
			if ( isset( $settings->desc_line_height_unit ) ) {

				$settings->desc_font_typo['line_height'] = array(
					'length' => $settings->desc_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit );
			}
			if ( isset( $settings->desc_line_height_unit_medium ) ) {
				$settings->desc_font_typo_medium['line_height'] = array(
					'length' => $settings->desc_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit_medium );
			}
			if ( isset( $settings->desc_line_height_unit_responsive ) ) {
				$settings->desc_font_typo_responsive['line_height'] = array(
					'length' => $settings->desc_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->desc_line_height_unit_responsive );
			}
			if ( ! isset( $settings->separator_font_typo ) || ! is_array( $settings->separator_font_typo ) ) {

				$settings->separator_font_typo            = array();
				$settings->separator_font_typo_medium     = array();
				$settings->separator_font_typo_responsive = array();
			}
			if ( isset( $settings->separator_text_font_family ) ) {

				if ( isset( $settings->separator_text_font_family['family'] ) ) {

					$settings->separator_font_typo['font_family'] = $settings->separator_text_font_family['family'];
					unset( $settings->separator_text_font_family['family'] );
				}
				if ( isset( $settings->separator_text_font_family['weight'] ) ) {

					if ( 'regular' == $settings->separator_text_font_family['weight'] ) {
						$settings->separator_font_typo['font_weight'] = 'normal';
					} else {
						$settings->separator_font_typo['font_weight'] = $settings->separator_text_font_family['weight'];
					}
					unset( $settings->separator_text_font_family['weight'] );
				}
			}
			if ( isset( $settings->separator_text_font_size_unit ) ) {

				$settings->separator_font_typo['font_size'] = array(
					'length' => $settings->separator_text_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->separator_text_font_size_unit );
			}
			if ( isset( $settings->separator_text_font_size_unit_medium ) ) {
				$settings->separator_font_typo_medium['font_size'] = array(
					'length' => $settings->separator_text_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->separator_text_font_size_unit_medium );
			}
			if ( isset( $settings->separator_text_font_size_unit_responsive ) ) {
				$settings->separator_font_typo_responsive['font_size'] = array(
					'length' => $settings->separator_text_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->separator_text_font_size_unit_responsive );
			}
			if ( isset( $settings->separator_text_line_height_unit ) ) {

				$settings->separator_font_typo['line_height'] = array(
					'length' => $settings->separator_text_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->separator_text_line_height_unit );
			}
			if ( isset( $settings->separator_text_line_height_unit_medium ) ) {
				$settings->separator_font_typo_medium['line_height'] = array(
					'length' => $settings->separator_text_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->separator_text_line_height_unit_medium );
			}
			if ( isset( $settings->separator_text_line_height_unit_responsive ) ) {
				$settings->separator_font_typo_responsive['line_height'] = array(
					'length' => $settings->separator_text_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->separator_text_line_height_unit_responsive );
			}
		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {
			if ( ! isset( $settings->font_typo ) || ! is_array( $settings->font_typo ) ) {

				$settings->font_typo            = array();
				$settings->font_typo_medium     = array();
				$settings->font_typo_responsive = array();
			}
			if ( isset( $settings->font ) ) {

				if ( isset( $settings->font['family'] ) ) {

					$settings->font_typo['font_family'] = $settings->font['family'];
					unset( $settings->font['family'] );
				}
				if ( isset( $settings->font['weight'] ) ) {

					if ( 'regular' == $settings->font['weight'] ) {
						$settings->font_typo['font_weight'] = 'normal';
					} else {
						$settings->font_typo['font_weight'] = $settings->font['weight'];
					}
					unset( $settings->font['weight'] );
				}
			}
			if ( isset( $settings->heading_font_size['small'] ) && ! isset( $settings->font_typo_responsive['font_size'] ) ) {

				$settings->font_typo_responsive['font_size'] = array(
					'length' => $settings->heading_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_font_size['medium'] ) && ! isset( $settings->font_typo_medium['font_size'] ) ) {

				$settings->font_typo_medium['font_size'] = array(
					'length' => $settings->heading_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_font_size['desktop'] ) && ! isset( $settings->font_typo['font_size'] ) ) {

				$settings->font_typo['font_size'] = array(
					'length' => $settings->heading_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_line_height['desktop'] ) && isset( $settings->heading_font_size['desktop'] ) && 0 != $settings->heading_font_size['desktop'] && ! isset( $settings->font_typo['line_height'] ) ) {
				if ( is_numeric( $settings->heading_line_height['desktop'] ) && is_numeric( $settings->heading_font_size['desktop'] ) ) {
					$settings->font_typo['line_height'] = array(
						'length' => round( $settings->heading_line_height['desktop'] / $settings->heading_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->heading_line_height['medium'] ) && isset( $settings->heading_font_size['medium'] ) && 0 != $settings->heading_font_size['medium'] && ! isset( $settings->font_typo_medium['line_height'] ) ) {
				if ( is_numeric( $settings->heading_line_height['medium'] ) && is_numeric( $settings->heading_font_size['medium'] ) ) {
					$settings->font_typo_medium['line_height'] = array(
						'length' => round( $settings->heading_line_height['medium'] / $settings->heading_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->heading_line_height['small'] ) && isset( $settings->heading_font_size['small'] ) && 0 != $settings->heading_font_size['small'] && ! isset( $settings->font_typo_responsive['line_height'] ) ) {
				if ( is_numeric( $settings->heading_line_height['small'] ) && is_numeric( $settings->heading_font_size['small'] ) ) {
					$settings->font_typo_responsive['line_height'] = array(
						'length' => round( $settings->heading_line_height['small'] / $settings->heading_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->desc_font_typo ) || ! is_array( $settings->desc_font_typo ) ) {

				$settings->desc_font_typo            = array();
				$settings->desc_font_typo_medium     = array();
				$settings->desc_font_typo_responsive = array();
			}
			if ( isset( $settings->desc_font_family ) ) {

				if ( isset( $settings->desc_font_family['family'] ) ) {

					$settings->desc_font_typo['font_family'] = $settings->desc_font_family['family'];
					unset( $settings->desc_font_family['family'] );
				}
				if ( isset( $settings->desc_font_family['weight'] ) ) {

					if ( 'regular' == $settings->desc_font_family['weight'] ) {
						$settings->desc_font_typo['font_weight'] = 'normal';
					} else {
						$settings->desc_font_typo['font_weight'] = $settings->desc_font_family['weight'];
					}
					unset( $settings->desc_font_family['weight'] );
				}
			}
			if ( isset( $settings->description_font_size['desktop'] ) && ! isset( $settings->desc_font_typo['font_size'] ) ) {

				$settings->desc_font_typo['font_size'] = array(
					'length' => $settings->description_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->description_font_size['medium'] ) && ! isset( $settings->desc_font_typo_medium['font_size'] ) ) {
				$settings->desc_font_typo_medium['font_size'] = array(
					'length' => $settings->description_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->description_font_size['small'] ) && ! isset( $settings->desc_font_typo_responsive['font_size'] ) ) {
				$settings->desc_font_typo_responsive['font_size'] = array(
					'length' => $settings->description_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->description_line_height['desktop'] ) && isset( $settings->description_font_size['desktop'] ) && 0 != $settings->description_font_size['desktop'] && ! isset( $settings->description_line_height_unit ) ) {
				if ( is_numeric( $settings->description_line_height['desktop'] ) && is_numeric( $settings->description_font_size['desktop'] ) ) {
					$settings->desc_font_typo['line_height'] = array(
						'length' => round( $settings->description_line_height['desktop'] / $settings->description_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->description_line_height['medium'] ) && isset( $settings->description_font_size['medium'] ) && 0 != $settings->description_font_size['medium'] && ! isset( $settings->description_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->description_line_height['medium'] ) && is_numeric( $settings->description_font_size['medium'] ) ) {
					$settings->desc_font_typo_medium['line_height'] = array(
						'length' => round( $settings->description_line_height['medium'] / $settings->description_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->description_line_height['small'] ) && isset( $settings->description_font_size['small'] ) && 0 != $settings->description_font_size['small'] && ! isset( $settings->description_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->description_line_height['small'] ) && is_numeric( $settings->description_font_size['small'] ) ) {
					$settings->desc_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->description_line_height['small'] / $settings->description_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( ! isset( $settings->separator_font_typo ) || ! is_array( $settings->separator_font_typo ) ) {

				$settings->separator_font_typo            = array();
				$settings->separator_font_typo_medium     = array();
				$settings->separator_font_typo_responsive = array();
			}
			if ( isset( $settings->separator_text_font_family ) ) {

				if ( isset( $settings->separator_text_font_family['family'] ) ) {

					$settings->separator_font_typo['font_family'] = $settings->separator_text_font_family['family'];
					unset( $settings->separator_text_font_family['family'] );
				}
				if ( isset( $settings->separator_text_font_family['weight'] ) ) {

					if ( 'regular' == $settings->separator_text_font_family['weight'] ) {
						$settings->separator_font_typo['font_weight'] = 'normal';
					} else {
						$settings->separator_font_typo['font_weight'] = $settings->separator_text_font_family['weight'];
					}
					unset( $settings->separator_text_font_family['weight'] );
				}
			}
			if ( isset( $settings->separator_text_font_size['desktop'] ) && ! isset( $settings->separator_font_typo['font_size'] ) ) {
				$settings->separator_font_typo['font_size'] = array(
					'length' => $settings->separator_text_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->separator_text_font_size['medium'] ) && ! isset( $settings->separator_font_medium['font_size'] ) ) {
				$settings->separator_font_typo_medium['font_size'] = array(
					'length' => $settings->separator_text_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->separator_text_font_size['small'] ) && ! isset( $settings->separator_font_responsive['font_size'] ) ) {
				$settings->separator_font_typo_responsive['font_size'] = array(
					'length' => $settings->separator_text_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->separator_text_line_height['desktop'] ) && isset( $settings->separator_text_font_size['desktop'] ) && 0 != $settings->separator_text_font_size['desktop'] && ! isset( $settings->separator_text_line_height_unit ) ) {
				if ( is_numeric( $settings->separator_text_line_height['desktop'] ) && is_numeric( $settings->separator_text_font_size['desktop'] ) ) {
					$settings->separator_font_typo['line_height'] = array(
						'length' => round( $settings->separator_text_line_height['desktop'] / $settings->separator_text_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->separator_text_line_height['medium'] ) && isset( $settings->separator_text_font_size['medium'] ) && 0 != $settings->separator_text_font_size['medium'] && ! isset( $settings->separator_text_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->separator_text_line_height['medium'] ) && is_numeric( $settings->separator_text_font_size['medium'] ) ) {
					$settings->separator_font_typo_medium['line_height'] = array(
						'length' => round( $settings->separator_text_line_height['medium'] / $settings->separator_text_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->separator_text_line_height['small'] ) && isset( $settings->separator_text_font_size['small'] ) && 0 != $settings->separator_text_font_size['small'] && ! isset( $settings->separator_text_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->separator_text_line_height['small'] ) && is_numeric( $settings->separator_text_font_size['small'] ) ) {
					$settings->separator_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->separator_text_line_height['small'] / $settings->separator_text_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			// Unset the old values.
			if ( isset( $settings->heading_font_size['desktop'] ) ) {
				unset( $settings->heading_font_size['desktop'] );
			}
			if ( isset( $settings->heading_font_size['medium'] ) ) {
				unset( $settings->heading_font_size['medium'] );
			}
			if ( isset( $settings->heading_font_size['small'] ) ) {
				unset( $settings->heading_font_size['small'] );
			}
			if ( isset( $settings->heading_line_height['desktop'] ) ) {
				unset( $settings->heading_line_height['desktop'] );
			}
			if ( isset( $settings->heading_line_height['medium'] ) ) {
				unset( $settings->heading_line_height['medium'] );
			}
			if ( isset( $settings->heading_line_height['small'] ) ) {
				unset( $settings->heading_line_height['small'] );
			}
			// Unset the old values.
			if ( isset( $settings->description_font_size['desktop'] ) ) {
				unset( $settings->description_font_size['desktop'] );
			}
			if ( isset( $settings->description_font_size['medium'] ) ) {
				unset( $settings->description_font_size['medium'] );
			}
			if ( isset( $settings->description_font_size['small'] ) ) {
				unset( $settings->description_font_size['small'] );
			}
			if ( isset( $settings->description_line_height['desktop'] ) ) {
				unset( $settings->description_line_height['desktop'] );
			}
			if ( isset( $settings->description_line_height['medium'] ) ) {
				unset( $settings->description_line_height['medium'] );
			}
			if ( isset( $settings->description_line_height['small'] ) ) {
				unset( $settings->description_line_height['small'] );
			}
			// Unset the old values.
			if ( isset( $settings->separator_text_font_size['desktop'] ) ) {
				unset( $settings->separator_text_font_size['desktop'] );
			}
			if ( isset( $settings->separator_text_font_size['medium'] ) ) {
				unset( $settings->separator_text_font_size['medium'] );
			}
			if ( isset( $settings->separator_text_font_size['small'] ) ) {
				unset( $settings->separator_text_font_size['small'] );
			}
			if ( isset( $settings->separator_text_line_height['desktop'] ) ) {
				unset( $settings->separator_text_line_height['desktop'] );
			}
			if ( isset( $settings->separator_text_line_height['medium'] ) ) {
				unset( $settings->separator_text_line_height['medium'] );
			}
			if ( isset( $settings->separator_text_line_height['small'] ) ) {
				unset( $settings->separator_text_line_height['small'] );
			}
		}

		return $settings;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */

if ( UABB_Lite_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-heading/uabb-heading-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/uabb-heading/uabb-heading-bb-less-than-2-2-compatibility.php';
}
