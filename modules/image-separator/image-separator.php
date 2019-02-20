<?php

/**
 * @class UABBImageSeparatorModule
 */
class UABBImageSeparatorModule extends FLBuilderModule {

	/**
	 * @property $data
	 */
	public $data = null;

	/**
	 * @property $_editor
	 * @protected
	 */
	protected $_editor = null;

	/**
	 * @method __construct
	 */
	public function __construct()
	{
		parent::__construct(array(
			'name'          => __('Image Separator', 'uabb'),
			'description'   => __('Use Image as a separator ', 'uabb'),
			'category'          => BB_Ultimate_Addon_Helper::module_cat(BB_Ultimate_Addon_Helper::$basic_modules),
            'group'         => UABB_CAT,
			'dir'           	=> BB_ULTIMATE_ADDON_DIR . 'modules/image-separator/',
            'url'           	=> BB_ULTIMATE_ADDON_URL . 'modules/image-separator/',
            'icon'				=> 'format-image.svg',
		));

		$this->add_js('jquery-waypoints');

		// Register and enqueue your own.
		$this->add_css( 'uabb-animate', BB_ULTIMATE_ADDON_URL . 'assets/css/uabb-animate.css' );
	}


	/**
	 * @method update
	 * @param $settings {object}
	 */
	public function update($settings)
	{
		// Make sure we have a photo_src property.
		if(!isset($settings->photo_src)) {
			$settings->photo_src = '';
		}

		// Cache the attachment data.
		$data = FLBuilderPhoto::get_attachment_data($settings->photo);

		if($data) {
			$settings->data = $data;
		}

		// Save a crop if necessary.
		$this->crop();

		return $settings;
	}

	/**
	 * @method delete
	 */
	public function delete()
	{
		$cropped_path = $this->_get_cropped_path();

		if(file_exists($cropped_path['path'])) {
			unlink($cropped_path['path']);
		}
	}

	/**
	 * @method crop
	 */
	public function crop()
	{
		// Delete an existing crop if it exists.
		$this->delete();

		// Do a crop.
		if(!empty($this->settings->image_style) && $this->settings->image_style != "simple" && $this->settings->image_style != "custom" ) {

			$editor = $this->_get_editor();

			if(!$editor || is_wp_error($editor)) {
				return false;
			}

			$cropped_path = $this->_get_cropped_path();
			$size         = $editor->get_size();
			$new_width    = $size['width'];
			$new_height   = $size['height'];

			// Get the crop ratios.
			
			
			if($this->settings->image_style == 'circle') {
				$ratio_1 = 1;
				$ratio_2 = 1;
			}
			elseif($this->settings->image_style == 'square') {
				$ratio_1 = 1;
				$ratio_2 = 1;
			}

			// Get the new width or height.
			if($size['width'] / $size['height'] < $ratio_1) {
				$new_height = $size['width'] * $ratio_2;
			}
			else {
				$new_width = $size['height'] * $ratio_1;
			}

			// Make sure we have enough memory to crop.
			@ini_set('memory_limit', '300M');

			// Crop the photo.
			$editor->resize($new_width, $new_height, true);

			// Save the photo.
			$editor->save($cropped_path['path']);

			// Return the new url.
			return $cropped_path['url'];
		}

		return false;
	}

	/**
	 * @method get_data
	 */
	public function get_data()
	{
		if(!$this->data) {


			// Photo source is set to "library".
			if(is_object($this->settings->photo)) {
				$this->data = $this->settings->photo;
			}
			else {
				$this->data = FLBuilderPhoto::get_attachment_data($this->settings->photo);
			}

			// Data object is empty, use the settings cache.
			if(!$this->data && isset($this->settings->data)) {
				$this->data = $this->settings->data;
			}
		}

		return $this->data;
	}

	/**
	 * @method get_classes
	 */
	public function get_classes()
	{
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
	 * @method get_src
	 */
	public function get_src()
	{
		$src = $this->_get_uncropped_url();

		// Return a cropped photo.
		if($this->_has_source() && !empty($this->settings->image_style)) {

			$cropped_path = $this->_get_cropped_path();

			// See if the cropped photo already exists.
			if(file_exists($cropped_path['path'])) {
				$src = $cropped_path['url'];
			}
			// It doesn't, check if this is a demo image.
			elseif(stristr($src, FL_BUILDER_DEMO_URL) && !stristr(FL_BUILDER_DEMO_URL, $_SERVER['HTTP_HOST'])) {
				$src = $this->_get_cropped_demo_url();
			}
			// It doesn't, check if this is a OLD demo image.
			elseif(stristr($src, FL_BUILDER_OLD_DEMO_URL)) {
				$src = $this->_get_cropped_demo_url();
			}
			// A cropped photo doesn't exist, try to create one.
			else {

				$url = $this->crop();

				if($url) {
					$src = $url;
				}
			}
		}

		return $src;
	}


	/**
	 * @method get_alt
	 */
	public function get_alt()
	{
		$photo = $this->get_data();

		if(!empty($photo->alt)) {
			return htmlspecialchars($photo->alt);
		}
		else if(!empty($photo->description)) {
			return htmlspecialchars($photo->description);
		}
		else if(!empty($photo->caption)) {
			return htmlspecialchars($photo->caption);
		}
		else if(!empty($photo->title)) {
			return htmlspecialchars($photo->title);
		}
	}

	/**
	 * @method get_attributes
	 */
	/*public function get_attributes()
	{
		$attrs = '';
		
		if ( isset( $this->settings->attributes ) ) {
			foreach ( $this->settings->attributes as $key => $val ) {
				$attrs .= $key . '="' . $val . '" ';
			}
		}
		
		return $attrs;
	}*/

	/**
	 * @method _has_source
	 * @protected
	 */
	protected function _has_source()
	{
		if( !empty($this->settings->photo_src) ) {
			return true;
		}

		return false;
	}

	/**
	 * @method _get_editor
	 * @protected
	 */
	protected function _get_editor()
	{
		if($this->_has_source() && $this->_editor === null) {

			$url_path  = $this->_get_uncropped_url();
			$file_path = str_ireplace(home_url(), ABSPATH, $url_path);

			if(file_exists($file_path)) {
				$this->_editor = wp_get_image_editor($file_path);
			}
			else {
				$this->_editor = wp_get_image_editor($url_path);
			}
		}

		return $this->_editor;
	}

	/**
	 * @method _get_cropped_path
	 * @protected
	 */
	protected function _get_cropped_path()
	{
		$crop        = empty($this->settings->image_style) ? 'simple' : $this->settings->image_style;
		$url         = $this->_get_uncropped_url();
		$cache_dir   = FLBuilderModel::get_cache_dir();

		if(empty($url)) {
			$filename    = uniqid(); // Return a file that doesn't exist.
		}
		else {
			
			if ( stristr( $url, '?' ) ) {
				$parts = explode( '?', $url );
				$url   = $parts[0];
			}
			
			$pathinfo    = pathinfo($url);
			$dir         = $pathinfo['dirname'];
			$ext         = $pathinfo['extension'];
			$name        = wp_basename($url, ".$ext");
			$new_ext     = strtolower($ext);
			$filename    = "{$name}-{$crop}.{$new_ext}";
		}

		return array(
			'filename' => $filename,
			'path'     => $cache_dir['path'] . $filename,
			'url'      => $cache_dir['url'] . $filename
		);
	}

	/**
	 * @method _get_uncropped_url
	 * @protected
	 */
	protected function _get_uncropped_url()
	{
		if(!empty($this->settings->photo_src)) {
			$url = $this->settings->photo_src;
		}
		else {
			$url = FL_BUILDER_URL . 'img/pixel.png';
		}

		return $url;
	}

	/**
	 * @method _get_cropped_demo_url
	 * @protected
	 */
	protected function _get_cropped_demo_url()
	{
		$info = $this->_get_cropped_path();

		return FL_BUILDER_DEMO_CACHE_URL . $info['filename'];
	}
	/**
	 * Ensure backwards compatibility with old settings.
	 *
	 * @since 1.3.0
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
			if ( isset( $settings->link_nofollow ) ) {
				if ( '1' == $settings->link_nofollow || 'yes' == $settings->link_nofollow ) {
					$settings->link_nofollow = 'yes';
				}
			}

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
