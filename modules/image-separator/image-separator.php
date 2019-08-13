<?php
/**
 *  UABB Image Separator Module file
 *
 *  @package UABB Image Separator Module
 */

/**
 * Function that initializes Image Separator Module
 *
 * @class UABBImageSeparatorModule
 */
class UABBImageSeparatorModule extends FLBuilderModule {

	/**
	 * Variable for Image Separator module
	 *
	 * @property $data
	 * @var $data
	 */
	public $data = null;

	/**
	 * Variable for Image Separator module
	 *
	 * @property $_editor
	 * @protected
	 * @var $_editor
	 */
	protected $_editor = null;

	/**
	 * Constructor function that constructs default values for the Image Separator Module
	 *
	 * @method __construct
	 */
	public function __construct() {
		parent::__construct(
			array(
				'name'        => __( 'Image Separator', 'uabb' ),
				'description' => __( 'Use Image as a separator ', 'uabb' ),
				'category'    => BB_Ultimate_Addon_Helper::module_cat( BB_Ultimate_Addon_Helper::$basic_modules ),
				'group'       => UABB_CAT,
				'dir'         => BB_ULTIMATE_ADDON_DIR . 'modules/image-separator/',
				'url'         => BB_ULTIMATE_ADDON_URL . 'modules/image-separator/',
				'icon'        => 'format-image.svg',
			)
		);

		$this->add_js( 'jquery-waypoints' );

		// Register and enqueue your own.
		$this->add_css( 'uabb-animate', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-animate.css' );
	}


	/**
	 * Function to update the Image src
	 *
	 * @method update
	 * @param obejct $settings gets the settings for the object.
	 */
	public function update( $settings ) {
		// Make sure we have a photo_src property.
		if ( ! isset( $settings->photo_src ) ) {
			$settings->photo_src = '';
		}

		// Cache the attachment data.
		$data = FLBuilderPhoto::get_attachment_data( $settings->photo );

		if ( $data ) {
			$settings->data = $data;
		}

		// Save a crop if necessary.
		$this->crop();

		return $settings;
	}

	/**
	 * Function to delete the cropped image src
	 *
	 * @method delete
	 */
	public function delete() {
		$cropped_path = $this->_get_cropped_path();

		if ( file_exists( $cropped_path['path'] ) ) {
			unlink( $cropped_path['path'] );
		}
	}

	/**
	 * Function to crop the the existing image
	 *
	 * @method crop
	 */
	public function crop() {
		// Delete an existing crop if it exists.
		$this->delete();

		// Do a crop.
		if ( ! empty( $this->settings->image_style ) && 'simple' != $this->settings->image_style && 'custom' != $this->settings->image_style ) {

			$editor = $this->_get_editor();

			if ( ! $editor || is_wp_error( $editor ) ) {
				return false;
			}

			$cropped_path = $this->_get_cropped_path();
			$size         = $editor->get_size();
			$new_width    = $size['width'];
			$new_height   = $size['height'];

			// Get the crop ratios.
			if ( 'circle' == $this->settings->image_style ) {
				$ratio_1 = 1;
				$ratio_2 = 1;
			} elseif ( 'square' == $this->settings->image_style ) {
				$ratio_1 = 1;
				$ratio_2 = 1;
			}

			// Get the new width or height.
			if ( $size['width'] / $size['height'] < $ratio_1 ) {
				$new_height = $size['width'] * $ratio_2;
			} else {
				$new_width = $size['height'] * $ratio_1;
			}

			// Make sure we have enough memory to crop.
			@ini_set( 'memory_limit', '300M' );  // @codingStandardsIgnoreLine.

			// Crop the photo.
			$editor->resize( $new_width, $new_height, true );

			// Save the photo.
			$editor->save( $cropped_path['path'] );

			// Return the new url.
			return $cropped_path['url'];
		}

		return false;
	}

	/**
	 * Function to get the Image src
	 *
	 * @method get_data
	 */
	public function get_data() {
		if ( ! $this->data ) {

			// Photo source is set to "library".
			if ( is_object( $this->settings->photo ) ) {
				$this->data = $this->settings->photo;
			} else {
				$this->data = FLBuilderPhoto::get_attachment_data( $this->settings->photo );
			}

			// Data object is empty, use the settings cache.
			if ( ! $this->data && isset( $this->settings->data ) ) {
				$this->data = $this->settings->data;
			}
		}

		return $this->data;
	}

	/**
	 * Function to get the classes for the Image src
	 *
	 * @method get_classes
	 */
	public function get_classes() {
		$classes = array( 'uabb-photo-img' );

		if ( ! empty( $this->settings->photo ) ) {

			$data = self::get_data();

			if ( is_object( $data ) ) {
				$classes[] = 'wp-image-' . $data->id;

				if ( isset( $data->sizes ) ) {

					foreach ( $data->sizes as $key => $size ) {

						if ( $size->url == $this->settings->photo_src ) {
							$classes[] = 'size-' . $key;
							break;
						}
					}
				}
			}
		}

		return implode( ' ', $classes );
	}

	/**
	 * Function to get src for the Image src
	 *
	 * @method get_src
	 */
	public function get_src() {
		$src = $this->_get_uncropped_url();

		// Return a cropped photo.
		if ( $this->_has_source() && ! empty( $this->settings->image_style ) ) {

			$cropped_path = $this->_get_cropped_path();

			// See if the cropped photo already exists.
			if ( file_exists( $cropped_path['path'] ) ) {
				$src = $cropped_path['url'];
			} elseif ( stristr( $src, FL_BUILDER_DEMO_URL ) && ! stristr( FL_BUILDER_DEMO_URL, $_SERVER['HTTP_HOST'] ) ) {
				$src = $this->_get_cropped_demo_url();
			} elseif ( stristr( $src, FL_BUILDER_OLD_DEMO_URL ) ) {
				$src = $this->_get_cropped_demo_url();
			} else {

				$url = $this->crop();

				if ( $url ) {
					$src = $url;
				}
			}
		}

		return $src;
	}


	/**
	 * Function to get alternate val for the Image
	 *
	 * @method get_alt
	 */
	public function get_alt() {
		$photo = $this->get_data();

		if ( ! empty( $photo->alt ) ) {
			return htmlspecialchars( $photo->alt );
		} elseif ( ! empty( $photo->description ) ) {
			return htmlspecialchars( $photo->description );
		} elseif ( ! empty( $photo->caption ) ) {
			return htmlspecialchars( $photo->caption );
		} elseif ( ! empty( $photo->title ) ) {
			return htmlspecialchars( $photo->title );
		}
	}

	/**
	 * Function to check for the Image src
	 *
	 * @method _has_source
	 * @protected
	 */
	protected function _has_source() {
		if ( ! empty( $this->settings->photo_src ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Function to get the editor for the Image src
	 *
	 * @method _get_editor
	 * @protected
	 */
	protected function _get_editor() {
		if ( $this->_has_source() && null === $this->_editor ) {

			$url_path  = $this->_get_uncropped_url();
			$file_path = str_ireplace( home_url(), ABSPATH, $url_path );

			if ( file_exists( $file_path ) ) {
				$this->_editor = wp_get_image_editor( $file_path );
			} else {
				$this->_editor = wp_get_image_editor( $url_path );
			}
		}

		return $this->_editor;
	}

	/**
	 * Function to get th cropped path for the Image src
	 *
	 * @method _get_cropped_path
	 * @protected
	 */
	protected function _get_cropped_path() {
		$crop      = empty( $this->settings->image_style ) ? 'simple' : $this->settings->image_style;
		$url       = $this->_get_uncropped_url();
		$cache_dir = FLBuilderModel::get_cache_dir();

		if ( empty( $url ) ) {
			$filename = uniqid(); // Return a file that doesn't exist.
		} else {

			if ( stristr( $url, '?' ) ) {
				$parts = explode( '?', $url );
				$url   = $parts[0];
			}

			$pathinfo = pathinfo( $url );
			$dir      = $pathinfo['dirname'];
			$ext      = $pathinfo['extension'];
			$name     = wp_basename( $url, ".$ext" );
			$new_ext  = strtolower( $ext );
			$filename = "{$name}-{$crop}.{$new_ext}";
		}

		return array(
			'filename' => $filename,
			'path'     => $cache_dir['path'] . $filename,
			'url'      => $cache_dir['url'] . $filename,
		);
	}

	/**
	 * Function to get the uncropped url of the Image src
	 *
	 * @method _get_uncropped_url
	 * @protected
	 */
	protected function _get_uncropped_url() {
		if ( ! empty( $this->settings->photo_src ) ) {
			$url = $this->settings->photo_src;
		} else {
			$url = FL_BUILDER_URL . 'img/pixel.png';
		}

		return $url;
	}

	/**
	 * Function to get the uncropped url of the Image src
	 *
	 * @method _get_uncropped_url
	 * @protected
	 */
	protected function _get_cropped_demo_url() {
		$info = $this->_get_cropped_path();

		return FL_BUILDER_DEMO_CACHE_URL . $info['filename'];
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

			// Handle opacity fields.
			$helper->handle_opacity_inputs( $settings, 'img_bg_color_opc', 'img_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'img_bg_hover_color_opc', 'img_bg_hover_color' );

		} elseif ( $version_bb_check && 'yes' != $page_migrated ) {

			// Handle opacity fields.
			$helper->handle_opacity_inputs( $settings, 'img_bg_color_opc', 'img_bg_color' );
			$helper->handle_opacity_inputs( $settings, 'img_bg_hover_color_opc', 'img_bg_hover_color' );
		}

		return $settings;
	}
}

/*
 * Condition to verify Beaver Builder version.
 * And accordingly render the required form settings file.
 *
 */
if ( UABB_Lite_Compatibility::check_bb_version() ) {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/image-separator/image-separator-bb-2-2-compatibility.php';
} else {
	require_once BB_ULTIMATE_ADDON_DIR . 'modules/image-separator/image-separator-bb-less-than-2-2-compatibility.php';
}
