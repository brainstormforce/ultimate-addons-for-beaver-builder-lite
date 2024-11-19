<?php
/**
 *  UABB Info List Module file
 *
 *  @package UABB Info List Module
 */

/**
 * Function that initializes Info List Module
 *
 * @class UABBInfoList
 */
class UABBInfoList extends FLBuilderModule {
	/**
	 * Constructor function that constructs default values for the Info List Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'            => __( 'Info List', 'uabb' ),
				'description'     => __( 'A totally awesome module!', 'uabb' ),
				'category'        => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$basic_modules ),
				'group'           => defined( 'UABB_CAT' ) ? UABB_CAT : '',
				'dir'             => BB_ULTIMATE_ADDON_DIR . 'modules/info-list/',
				'url'             => BB_ULTIMATE_ADDON_URL . 'modules/info-list/',
				'editor_export'   => true, // Defaults to true and can be omitted.
				'enabled'         => true, // Defaults to true and can be omitted.
				'partial_refresh' => false, // Defaults to false and can be omitted.
				'icon'            => 'info-list.svg',
			)
		);

		$this->add_js( 'jquery-waypoints' );

		// Register and enqueue your own.
		$this->add_css( 'uabb-animate', $this->url . 'css/animate.css' );
	}

	/**
	 * Function to get the icon for the Info List
	 *
	 * @method get_icons
	 * @param string $icon gets the icon for the module.
	 */
	public function get_icon( $icon = '' ) {

		// Initialize $path before the first if statement.
		$path = '';

		// check if $icon is referencing an included icon.
		if ( '' !== $icon && file_exists( BB_ULTIMATE_ADDON_DIR . 'modules/info-list/icon/' . $icon ) ) {
			$path = BB_ULTIMATE_ADDON_DIR . 'modules/info-list/icon/' . $icon;
		}

		if ( file_exists( $path ) ) {
			$contents = file_get_contents( $path ); //phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			if ( false !== $contents ) {
				return $contents;
			}
		}

		// If we reach this point, either the file doesn't exist or file_get_contents failed.
		return '';
	}

	/**
	 * Render Image
	 *
	 * @method render_image
	 * @param object $item gets the object for the module.
	 * @param object $settings gets the settings for the module.
	 * @return void
	 */
	public function render_image( $item, $settings ) {

		$infolist_icon_size = isset( $settings->icon_image_size ) ? $settings->icon_image_size : 75;

		if ( 'circle' === $settings->list_icon_style ) {
			if ( is_numeric( $infolist_icon_size ) ) {
				$infolist_icon_size = $infolist_icon_size / 2;
			}
		} elseif ( 'square' === $settings->list_icon_style ) {
			if ( is_numeric( $infolist_icon_size ) ) {
				$infolist_icon_size = $infolist_icon_size / 2;
			}
		} elseif ( 'custom' === $settings->list_icon_style ) {
			$infolist_icon_size = $infolist_icon_size;
		} else {
			$infolist_icon_size = $infolist_icon_size;
		}
		$imageicon_array = array(

			/* General Section */
			'image_type'            => $item->image_type,

			/* Icon Basics */
			'icon'                  => $item->icon,
			'icon_size'             => $infolist_icon_size,
			'icon_align'            => 'center',

			/* Image Basics */
			'photo_source'          => $item->photo_source,
			'photo'                 => $item->photo,
			'photo_url'             => $item->photo_url,
			'img_size'              => $settings->icon_image_size,
			'img_align'             => 'center',
			'photo_src'             => ( isset( $item->photo_src ) ) ? $item->photo_src : '',

			/* Icon Style */
			'icon_style'            => $settings->list_icon_style,
			'icon_bg_size'          => $settings->list_icon_bg_padding,
			'icon_border_style'     => '',
			'icon_border_width'     => '',
			'icon_bg_border_radius' => $settings->list_icon_bg_border_radius,

			/* Image Style */
			'image_style'           => $settings->list_icon_style,
			'img_bg_size'           => $settings->list_icon_bg_padding,
			'img_border_style'      => '',
			'img_border_width'      => '',
			'img_bg_border_radius'  => $settings->list_icon_bg_border_radius,
		);
		/* Render HTML Function */
		FLBuilder::render_module_html( 'image-icon', $imageicon_array );
	}
	/**
	 * Render text
	 *
	 * @method render_text
	 * @param object $item gets the items.
	 * @param var    $list_item_counter  counts the list item counter value.
	 * @return void
	 */
	public function render_each_item( $item, $list_item_counter ) {
		$target   = '';
		$nofollow = '';
		if ( ! UABB_Lite_Compatibility::check_bb_version() ) {

			if ( isset( $item->list_item_link_target ) ) {
				$target = $item->list_item_link_target;
			}
			if ( isset( $item->list_item_link_nofollow ) ) {
				$nofollow = $item->list_item_link_nofollow;
			}
		} else {
			if ( isset( $item->list_item_url_target ) ) {
				$target = $item->list_item_url_target;
			}
			if ( isset( $item->list_item_url_nofollow ) ) {
				$nofollow = $item->list_item_url_nofollow;
			}
		}
		echo '<li class="uabb-info-list-item info-list-item-dynamic' . esc_attr( $list_item_counter ) . '">';
		echo '<div class="uabb-info-list-content-wrapper uabb-info-list-' . esc_attr( $this->settings->icon_position ) . '">';

		if ( ! empty( $item->list_item_link ) && 'complete' === $item->list_item_link && ! empty( $item->list_item_url ) ) {

			echo '<a href="' . esc_url( $item->list_item_url ) . '" class="uabb-info-list-link" target="' . esc_attr( $target ) . '" ' . esc_attr( UABB_Helper::get_link_rel( $target, $nofollow, 0 ) ) . '></a>';
		}

		if ( 'none' !== $item->image_type ) {
			echo '<div class="uabb-info-list-icon info-list-icon-dynamic' . esc_attr( $list_item_counter ) . '">';

			if ( ! empty( $item->list_item_link ) && 'icon' === $item->list_item_link ) {
				echo '<a href="' . esc_url( $item->list_item_url ) . '" class="uabb-info-list-link" target="' . esc_attr( $target ) . '" ' . esc_attr( UABB_Helper::get_link_rel( esc_attr( $target ), esc_attr( $nofollow ), 0 ) ) . '></a>';
			}
				$this->render_image( $item, $this->settings );

			echo '</div>';
		}

		echo '<div class="uabb-info-list-content uabb-info-list-' . esc_attr( $this->settings->icon_position ) . ' info-list-content-dynamic' . esc_attr( $list_item_counter ) . '">';
		// Define a whitelist of allowed tags.
		$allowed_tags = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'p', 'span' );
		$infolist_tag = in_array( $this->settings->heading_tag_selection, $allowed_tags, true ) ? $this->settings->heading_tag_selection : 'h3';
		echo '<' . esc_attr( $infolist_tag ) . ' class="uabb-info-list-title">';
		if ( ! empty( $item->list_item_link ) && 'list-title' === $item->list_item_link && ! empty( $item->list_item_url ) ) {

			echo '<a href="' . esc_url( $item->list_item_url ) . '" target="' . esc_attr( $target ) . '" ' . esc_attr( UABB_Helper::get_link_rel( $target, $nofollow, 0 ) ) . '>';

		}
		echo wp_kses_post( $item->list_item_title );
		if ( ! empty( $item->list_item_link ) && 'list-title' === $item->list_item_link && ! empty( $item->list_item_url ) ) {

			echo '</a>';

		}
		echo '</' . esc_attr( $infolist_tag ) . ' >';

		echo '<div class="uabb-info-list-description uabb-text-editor info-list-description-dynamic' . esc_attr( $list_item_counter ) . '">';
		if ( strpos( $item->list_item_description, '</p>' ) > 0 ) {
			echo wp_kses_post( $item->list_item_description );
		} else {
			echo '<p>' . wp_kses_post( $item->list_item_description ) . '</p>';
		}

		echo '</div>';

		echo '</div>';

		$list_item_counter = $list_item_counter + 1;
		echo '</div>';
		if ( 'none' !== $item->image_type ) {
			if ( 'center' === $this->settings->align_items && 'top' !== $this->settings->icon_position ) {
				echo '<div class="uabb-info-list-connector-top uabb-info-list-' . esc_attr( $this->settings->icon_position ) . '"></div>';
			}
			echo '<div class="uabb-info-list-connector uabb-info-list-' . esc_attr( $this->settings->icon_position ) . '"></div>';
		}

		echo '</li>';
	}
	/**
	 * Render List text
	 *
	 * @method render_text
	 * @return void
	 */
	public function render_list() {
		$info_list_html    = '';
		$list_item_counter = 0;
		foreach ( $this->settings->add_list_item as $item ) {
			$this->render_each_item( $item, $list_item_counter );
			$list_item_counter = $list_item_counter + 1;
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

		if ( $version_bb_check && ( 'yes' === $page_migrated || 'yes' === $stable_version_new_page ) ) {
			/* Heading */
			if ( ! isset( $settings->heading_font_typo ) || ! is_array( $settings->heading_font_typo ) ) {

				$settings->heading_font_typo            = array();
				$settings->heading_font_typo_medium     = array();
				$settings->heading_font_typo_responsive = array();
			}
			if ( isset( $settings->heading_font_family ) ) {

				if ( isset( $settings->heading_font_family['family'] ) ) {

					$settings->heading_font_typo['font_family'] = $settings->heading_font_family['family'];
					unset( $settings->heading_font_family['family'] );
				}
				if ( isset( $settings->heading_font_family['weight'] ) ) {

					if ( 'regular' === $settings->heading_font_family['weight'] ) {
						$settings->heading_font_typo['font_weight'] = 'normal';
					} else {
						$settings->heading_font_typo['font_weight'] = $settings->heading_font_family['weight'];
					}
					unset( $settings->heading_font_family['weight'] );
				}
			}
			if ( isset( $settings->heading_font_size_unit ) ) {

				$settings->heading_font_typo['font_size'] = array(
					'length' => $settings->heading_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->heading_font_size_unit );
			}
			if ( isset( $settings->heading_font_size_unit_medium ) ) {
				$settings->heading_font_typo_medium['font_size'] = array(
					'length' => $settings->heading_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->heading_font_size_unit_medium );
			}
			if ( isset( $settings->heading_font_size_unit_responsive ) ) {
				$settings->heading_font_typo_responsive['font_size'] = array(
					'length' => $settings->heading_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->heading_font_size_unit_responsive );
			}
			if ( isset( $settings->heading_line_height_unit ) ) {

				$settings->heading_font_typo['line_height'] = array(
					'length' => $settings->heading_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->heading_line_height_unit );
			}
			if ( isset( $settings->heading_line_height_unit_medium ) ) {
				$settings->heading_font_typo_medium['line_height'] = array(
					'length' => $settings->heading_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->heading_line_height_unit_medium );
			}
			if ( isset( $settings->heading_line_height_unit_responsive ) ) {
				$settings->heading_font_typo_responsive['line_height'] = array(
					'length' => $settings->heading_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->heading_line_height_unit_responsive );
			}
			/* Description */
			if ( ! isset( $settings->description_font_typo ) || ! is_array( $settings->description_font_typo ) ) {

				$settings->description_font_typo            = array();
				$settings->description_font_typo_medium     = array();
				$settings->description_font_typo_responsive = array();
			}
			if ( isset( $settings->description_font_family ) ) {

				if ( isset( $settings->description_font_family['family'] ) ) {

					$settings->description_font_typo['font_family'] = $settings->description_font_family['family'];
					unset( $settings->description_font_family['family'] );
				}
				if ( isset( $settings->description_font_family['weight'] ) ) {

					if ( 'regular' === $settings->description_font_family['weight'] ) {
						$settings->description_font_typo['font_weight'] = 'normal';
					} else {
						$settings->description_font_typo['font_weight'] = $settings->description_font_family['weight'];
					}
					unset( $settings->description_font_family['weight'] );
				}
			}
			if ( isset( $settings->description_font_size_unit ) ) {

				$settings->description_font_typo['font_size'] = array(
					'length' => $settings->description_font_size_unit,
					'unit'   => 'px',
				);
				unset( $settings->description_font_size_unit );
			}
			if ( isset( $settings->description_font_size_unit_medium ) ) {
				$settings->description_font_typo_medium['font_size'] = array(
					'length' => $settings->description_font_size_unit_medium,
					'unit'   => 'px',
				);
				unset( $settings->description_font_size_unit_medium );
			}
			if ( isset( $settings->description_font_size_unit_responsive ) ) {
				$settings->description_font_typo_responsive['font_size'] = array(
					'length' => $settings->description_font_size_unit_responsive,
					'unit'   => 'px',
				);
				unset( $settings->description_font_size_unit_responsive );
			}
			if ( isset( $settings->description_line_height_unit ) ) {

				$settings->description_font_typo['line_height'] = array(
					'length' => $settings->description_line_height_unit,
					'unit'   => 'em',
				);
				unset( $settings->description_line_height_unit );
			}
			if ( isset( $settings->description_line_height_unit_medium ) ) {
				$settings->description_font_typo_medium['line_height'] = array(
					'length' => $settings->description_line_height_unit_medium,
					'unit'   => 'em',
				);
				unset( $settings->description_line_height_unit_medium );
			}
			if ( isset( $settings->description_line_height_unit_responsive ) ) {
				$settings->description_font_typo_responsive['line_height'] = array(
					'length' => $settings->description_line_height_unit_responsive,
					'unit'   => 'em',
				);
				unset( $settings->description_line_height_unit_responsive );
			}
			foreach ( $settings->add_list_item as $item ) {

				if ( isset( $item->list_item_link_target ) ) {
					$item->list_item_url_target = $item->list_item_link_target;
					unset( $item->list_item_link_target );
				}
				if ( isset( $item->list_item_link_nofollow ) ) {
					$item->list_item_url_nofollow = ( '1' === $item->list_item_link_nofollow ) ? 'yes' : '';
					unset( $item->list_item_link_nofollow );
				}
			}
		} elseif ( $version_bb_check && 'yes' !== $page_migrated ) {

			if ( ! isset( $settings->heading_font_typo ) || ! is_array( $settings->heading_font_typo ) ) {

				$settings->heading_font_typo            = array();
				$settings->heading_font_typo_medium     = array();
				$settings->heading_font_typo_responsive = array();
			}
			if ( isset( $settings->heading_font_family ) ) {

				if ( isset( $settings->heading_font_family['family'] ) ) {
					$settings->heading_font_typo['font_family'] = $settings->heading_font_family['family'];
					unset( $settings->heading_font_family['family'] );
				}
				if ( isset( $settings->heading_font_family['weight'] ) ) {

					if ( 'regular' === $settings->heading_font_family['weight'] ) {
						$settings->heading_font_typo['font_weight'] = 'normal';
					} else {
						$settings->heading_font_typo['font_weight'] = $settings->heading_font_family['weight'];
					}
					unset( $settings->heading_font_family['weight'] );
				}
			}
			if ( isset( $settings->heading_font_size['desktop'] ) ) {

				$settings->heading_font_typo['font_size'] = array(
					'length' => $settings->heading_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_font_size['medium'] ) ) {

				$settings->heading_font_typo_medium['font_size'] = array(
					'length' => $settings->heading_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_font_size['small'] ) ) {
				$settings->heading_font_typo_responsive['font_size'] = array(
					'length' => $settings->heading_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->heading_line_height['desktop'] ) && isset( $settings->heading_font_size['desktop'] ) && 0 !== $settings->heading_font_size['desktop'] ) {
				if ( is_numeric( $settings->heading_line_height['desktop'] ) && is_numeric( $settings->heading_font_size['desktop'] ) ) {
					$settings->heading_font_typo['line_height'] = array(
						'length' => round( $settings->heading_line_height['desktop'] / $settings->heading_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->heading_line_height['medium'] ) && isset( $settings->heading_font_size['medium'] ) && 0 !== $settings->heading_font_size['medium'] ) {
				if ( is_numeric( $settings->heading_line_height['medium'] ) && is_numeric( $settings->heading_font_size['medium'] ) ) {
					$settings->heading_font_typo_medium['line_height'] = array(
						'length' => round( $settings->heading_line_height['medium'] / $settings->heading_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->heading_line_height['small'] ) && isset( $settings->heading_font_size['small'] ) && 0 !== $settings->heading_font_size['small'] ) {
				if ( is_numeric( $settings->heading_line_height['small'] ) && is_numeric( $settings->heading_font_size['small'] ) ) {
					$settings->heading_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->heading_line_height['small'] / $settings->heading_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			/* Description */
			if ( ! isset( $settings->description_font_typo ) || ! is_array( $settings->description_font_typo ) ) {

				$settings->description_font_typo            = array();
				$settings->description_font_typo_medium     = array();
				$settings->description_font_typo_responsive = array();
			}
			if ( isset( $settings->description_font_family ) ) {

				if ( isset( $settings->description_font_family['family'] ) ) {

					$settings->description_font_typo['font_family'] = $settings->description_font_family['family'];
					unset( $settings->description_font_family['family'] );
				}
				if ( isset( $settings->description_font_family['weight'] ) ) {

					if ( 'regular' === $settings->description_font_family['weight'] ) {
						$settings->description_font_typo['font_weight'] = 'normal';
					} else {
						$settings->description_font_typo['font_weight'] = $settings->description_font_family['weight'];
					}
					unset( $settings->description_font_family['weight'] );
				}
			}
			if ( isset( $settings->description_font_size['desktop'] ) ) {
				$settings->description_font_typo['font_size'] = array(
					'length' => $settings->description_font_size['desktop'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->description_font_size['medium'] ) ) {
				$settings->description_font_typo_medium['font_size'] = array(
					'length' => $settings->description_font_size['medium'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->description_font_size['small'] ) ) {
				$settings->description_font_typo_responsive['font_size'] = array(
					'length' => $settings->description_font_size['small'],
					'unit'   => 'px',
				);
			}
			if ( isset( $settings->description_line_height['desktop'] ) && isset( $settings->description_font_size['desktop'] ) && 0 !== $settings->description_font_size['desktop'] ) {
				if ( is_numeric( $settings->description_line_height['desktop'] ) && is_numeric( $settings->description_font_size['desktop'] ) ) {
					$settings->description_font_typo['line_height'] = array(
						'length' => round( $settings->description_line_height['desktop'] / $settings->description_font_size['desktop'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->description_line_height['medium'] ) && isset( $settings->description_font_size['medium'] ) && 0 !== $settings->description_font_size['medium'] ) {
				if ( is_numeric( $settings->description_line_height['medium'] ) && is_numeric( $settings->description_font_size['medium'] ) ) {
					$settings->description_font_typo_medium['line_height'] = array(
						'length' => round( $settings->description_line_height['medium'] / $settings->description_font_size['medium'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			if ( isset( $settings->description_line_height['small'] ) && isset( $settings->description_font_size['small'] ) && 0 !== $settings->description_font_size['small'] ) {
				if ( is_numeric( $settings->description_line_height['small'] ) && is_numeric( $settings->description_font_size['small'] ) ) {
					$settings->description_font_typo_responsive['line_height'] = array(
						'length' => round( $settings->description_line_height['small'] / $settings->description_font_size['small'], 2 ),
						'unit'   => 'em',
					);
				}
			}
			foreach ( $settings->add_list_item as $item ) {
				if ( isset( $item->list_item_link_target ) ) {
					$item->list_item_url_target = $item->list_item_link_target;
					unset( $item->list_item_link_target );
				}
				if ( isset( $item->list_item_link_nofollow ) ) {
					$item->list_item_url_nofollow = ( '1' === $item->list_item_link_nofollow ) ? 'yes' : '';
					unset( $item->list_item_link_nofollow );
				}
			}
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
		}
		return $settings;
	}
}
/**
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 */
if ( UABB_Lite_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/info-list/info-list-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/info-list/info-list-bb-less-than-2-2-compatibility.php';
}
