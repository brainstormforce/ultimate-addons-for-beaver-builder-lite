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
			'category'      	=> UABB_CAT,
			'dir'           	=> BB_ULTIMATE_ADDON_DIR . 'modules/image-separator/',
            'url'           	=> BB_ULTIMATE_ADDON_URL . 'modules/image-separator/',
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
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('UABBImageSeparatorModule', array(
	'general'       => array( // Tab
		'title'         => __('General', 'uabb'), // Tab title
		'sections'      => array( // Tab Sections
			/* Image Basic Setting */
			'img_basic'		=> array( // Section
				'title'         => '', // Section Title
				'fields'        => array( // Section Fields
					'photo'         => array(
						'type'          => 'photo',
						'label'         => __('Separator Image', 'uabb'),
						'show_remove'	=> true,
					),
					'img_size'     => array(
						'type'          => 'text',
						'label'         => __('Desktop Size', 'uabb'),
						'maxlength'     => '5',
						'size'          => '6',
						'description'   => 'px',
						'help'         => __('Image size cannot be more than parent size.', 'uabb'),
					),
					'medium_img_size'     => array(
						'type'          => 'text',
						'label'         => __('Medium Device Size', 'uabb'),
						'maxlength'     => '5',
						'size'          => '6',
						'description'   => 'px',
						'help'			=> __('Apply image size for medium devices. It will inherit desktop size if empty.', 'uabb'),
						'preview'		=> array(
                        		'type' 		=> 'none'
                        )
					),
					'small_img_size'     => array(
						'type'          => 'text',
						'label'         => __('Small Device Size', 'uabb'),
						'maxlength'     => '5',
						'size'          => '6',
						'description'   => 'px',
						'help'			=> __('Apply image size for small devices. It will inherit medium size if empty.', 'uabb'),
						'preview'		=> array(
                        		'type' 		=> 'none'
                        )
					),
				)
			),
			/* Image Style Section */
			'img_style'			=> array(
				'title'			=> __('Style','uabb'),
				'fields'		=> array(
					/* Image Style */
					'image_style'         => array(
                    	'type'          => 'select',
                    	'label'         => __('Image Style', 'uabb'),
                    	'default'       => 'simple',
                    	'help'			=> __('Circle and Square style will crop your image in 1:1 ratio','uabb'),
                    	'options'       => array(
                        	'simple'        => __('Simple', 'uabb'),
                        	'circle'        => __('Circle', 'uabb'),
                        	'square'        => __('Square', 'uabb'),
                        	'custom'        => __('Design your own', 'uabb'),
                    	),
                        'toggle' => array(
                            'simple' => array(
                                'fields' => array()
                            ),
                            'circle' => array(
                                'fields' => array( ),
                            ),
                            'square' => array(
                                'fields' => array( ),
                            ),
                            'custom' => array(
                                'sections'  => array( 'img_colors' ),
                                'fields'	=> array( 'img_bg_size', 'img_border_style', 'img_bg_border_radius' ) 
                            )
                        )
                	),

                    /* Image Background Size */
                    'img_bg_size'          => array(
                        'type'          => 'text',
                        'label'         => __('Background Size', 'uabb'),
                        'help'          => __('Spacing between Image edge & Background edge','uabb'),
                        'maxlength'     => '3',
                        'size'          => '6',
                        'description'   => 'px',
                        'preview'		=> array(
                        		'type' 		=> 'css',
                        		'selector'	=> '.uabb-image .uabb-photo-img',
                        		'property'	=> 'padding',
                        		'unit'		=> 'px'
                        )
                    ),

                    /* Border Style and Radius for Image */
					'img_border_style'   => array(
		                'type'          => 'select',
		                'label'         => __('Border Style', 'uabb'),
		                'default'       => 'none',
		                'help'          => __('The type of border to use. Double borders must have a width of at least 3px to render properly.', 'uabb'),
		                'options'       => array(
		                    'none'   => __( 'None', 'Border type.', 'uabb' ),
		                    'solid'  => __( 'Solid', 'Border type.', 'uabb' ),
		                    'dashed' => __( 'Dashed', 'Border type.', 'uabb' ),
		                    'dotted' => __( 'Dotted', 'Border type.', 'uabb' ),
		                    'double' => __( 'Double', 'Border type.', 'uabb' )
		                ),
		                'toggle'        => array(
		                    'solid'         => array(
		                        'fields'        => array('img_border_width', 'img_border_radius','img_border_color','img_border_hover_color' )
		                    ),
		                    'dashed'        => array(
		                        'fields'        => array('img_border_width', 'img_border_radius','img_border_color','img_border_hover_color' )
		                    ),
		                    'dotted'        => array(
		                        'fields'        => array('img_border_width', 'img_border_radius','img_border_color','img_border_hover_color' )
		                    ),
		                    'double'        => array(
		                        'fields'        => array('img_border_width', 'img_border_radius','img_border_color','img_border_hover_color' )
		                    )
		                ),
		                /*'preview'		=> array(
                        		'type' 		=> 'css',
                        		'selector'	=> '.uabb-image .uabb-photo-img',
                        		'property'	=> 'border-style',
                        )*/
		            ),
		            'img_border_width'    => array(
		                'type'          => 'text',
		                'label'         => __('Border Width', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '6',
		                'placeholder'   => '1',
		                'preview'		=> array(
                        		'type' 		=> 'css',
                        		'selector'	=> '.uabb-image .uabb-photo-img',
                        		'property'	=> 'border-width',
                        		'unit'		=> 'px'
                        )
		            ),
		            'img_bg_border_radius'    => array(
		                'type'          => 'text',
		                'label'         => __('Border Radius', 'uabb'),
		                'description'   => 'px',
		                'maxlength'     => '3',
		                'size'          => '6',
		                'placeholder'   => '0',
		                'preview'		=> array(
                        		'type' 		=> 'css',
                        		'selector'	=> '.uabb-image .uabb-photo-img',
                        		'property'	=> 'border-radius',
                        		'unit'		=> 'px'
                        )
		            ),
				)
			),
			/* Image Colors */
			'img_colors'        => array( // Section
                'title'         => __('Colors', 'uabb'), // Section Title
                'fields'        => array( // Section Fields
                    /* Background Color Dependent on Icon Style **/
                    'img_bg_color' => array( 
						'type'       => 'color',
	                	'label'      => __('Background Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
                        'preview'		=> array(
                        		'type' 		=> 'css',
                        		'selector'	=> '.uabb-image .uabb-photo-img',
                        		'property'	=> 'background',
                        )
					),
		            'img_bg_color_opc' => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
                    'img_bg_hover_color' => array( 
						'type'       => 'color',
	                    'label'      => __('Background Hover Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
					),
		            'img_bg_hover_color_opc' => array( 
						'type'        => 'text',
						'label'       => __('Opacity', 'uabb'),
						'default'     => '',
						'description' => '%',
						'maxlength'   => '3',
						'size'        => '5',
					),
                    
                     /* Border Color Dependent on Border Style for Image */
                    'img_border_color' => array( 
						'type'       => 'color',
	                    'label'      => __('Border Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
                        'preview'		=> array(
                        		'type' 		=> 'css',
                        		'selector'	=> '.uabb-image .uabb-photo-img',
                        		'property'	=> 'border-color',
                        )
					),
		            'img_border_hover_color' => array( 
						'type'       => 'color',
	                    'label'      => __('Border Hover Color', 'uabb'),
						'default'    => '',
						'show_reset' => true,
                        'preview'		=> array(
                        		'type' 		=> 'none',
                        )
					),
                )
            ),
			/* Image Style Section */
			'img_stucture'			=> array(
				'title'			=> __('Structure','uabb'),
				'fields'		=> array(
					/* Image Position */
					'image_position'         => array(
                    	'type'          => 'select',
                    	'label'         => __('Image Top / Bottom Position', 'uabb'),
                    	'default'       => 'bottom',
                    	'help'			=> __('Select the position to display Image Separator','uabb'),
                    	'options'       => array(
                        	'bottom'     => __('Bottom', 'uabb'),
                        	'top'        => __('Top', 'uabb')
                        ),
                	),

                    /* Image Gutter */
                    'gutter'          => array(
                        'type'          => 'text',
                        'label'         => __('Gutter', 'uabb'),
                        'placeholder'   => '50',
                        'help'          => __('50% is default. Increase to push the image outside or decrease to pull the image inside.','uabb'),
                        'maxlength'     => '3',
                        'size'          => '6',
                        'description'   => '%',
                    ),

                    'image_position_lr'         => array(
                    	'type'          => 'select',
                    	'label'         => __('Image Left / Right Position', 'uabb'),
                    	'default'       => 'center',
                    	'help'			=> __('Select the position to display Image Separator','uabb'),
                    	'options'       => array(
                        	'left'     	 => __('Left', 'uabb'),
                        	'center'     => __('Center', 'uabb'),
                        	'right'      => __('Right', 'uabb')
                        ),
                        'toggle'		=> array(
                        	'left'	=> array( 
                        		'fields'	=> array( 'gutter_lr', 'responsive_center' )
                        	),
                        	'right'	=> array( 
                        		'fields'	=> array( 'gutter_lr' , 'responsive_center' )
                        	)
                        )
                	),

                    /* Image Gutter */
                    'gutter_lr'          => array(
                        'type'          => 'text',
                        'label'         => __('Value from Left / Right', 'uabb'),
                        'placeholder'   => '50',
                        'help'          => __('From left / From right','uabb'),
                        'maxlength'     => '3',
                        'size'          => '6',
                        'description'   => '%',
                    ),

                    
                    'responsive_center'     => array(
                        'type'          => 'select',
                        'label'         => __( 'Responsive Alignment', 'uabb' ),
                        'default'       => 'none',
                        'help'          => __('To view Image Separator center aligned on different devices use this setting','uabb'),
                        'options'       => array(
                         	'none'		=> __('Default','uabb'),
                          	'small'		=> __('Small Device','uabb'),
                          	'both' 		=> __('Small & Medium Devices','uabb'),
                        ),
                    ),

                    /* Link Toggle */
                    'enable_link'     => array(
                        'type'          => 'uabb-toggle-switch',
                        'label'         => __( 'Enable Link', 'uabb' ),
                        'default'       => 'no',
                        'options'       => array(
                         	'yes'		=> __('Yes','uabb'),
                          	'no'		=> __('No','uabb'),
                        ),
                        'toggle'        => array(
		                    'yes'         => array(
		                        'fields'        => array( 'link', 'link_target' )
		                    ),
		                ),
                    ),
					'link'          => array(
						'type'          => 'link',
						'label'         => __('Link', 'uabb'),
						'preview'         => array(
							'type'            => 'none'
						)
					),
					'link_target'   => array(
						'type'          => 'select',
						'label'         => __('Link Target', 'uabb'),
						'default'       => '_self',
						'options'       => array(
							'_self'         => __('Same Window', 'uabb'),
							'_blank'        => __('New Window', 'uabb')
						),
						'preview'       => array(
							'type'          => 'none'
						)
					),
				)
			),
		)
	),
	'animation_tab'       => array( // Tab
		'title'         => __('Animation', 'uabb'), // Tab title
		'sections'      => array( // Tab Sections
			'anim_general'			=> array(
				'title'			=> '',
				'fields'		=> array(
					'img_animation'         => array(
                    	'type'          => 'select',
                    	'label'         => __('Animation', 'uabb'),
                    	'default'       => 'no',
                    	'help'			=> __('Choose one of the animation types for Separator.','uabb'),
                    	'options'       => array(
                        	'no'				=> __('No', 'uabb'),
							'bounce'			=> __( 'bounce' , 'uabb' ),
							'flash'				=> __( 'flash' , 'uabb' ),
							'pulse'				=> __( 'pulse' , 'uabb' ),
							'rubberBand'		=> __( 'rubberBand' , 'uabb' ),
							'shake'				=> __( 'shake' , 'uabb' ),
							'headShake'		 	=> __( 'headShake' , 'uabb' ),
							'swing'				=> __( 'swing' , 'uabb' ),
							'tada'				=> __( 'tada' , 'uabb' ),
							'wobble'			=> __( 'wobble' , 'uabb' ),
							'jello'				=> __( 'jello' , 'uabb' ),
							'bounceIn'			=> __( 'bounceIn' , 'uabb' ),
							'bounceInDown'	 	=> __( 'bounceInDown' , 'uabb' ),
							'bounceInLeft'	 	=> __( 'bounceInLeft' , 'uabb' ),
							'bounceInRight'	 	=> __( 'bounceInRight' , 'uabb' ),
							'bounceInUp'	 	=> __( 'bounceInUp' , 'uabb' ),
							'fadeIn'			=> __( 'fadeIn' , 'uabb' ),
							'fadeInDown'	 	=> __( 'fadeInDown' , 'uabb' ),
							'fadeInDownBig'	 	=> __( 'fadeInDownBig' , 'uabb' ),
							'fadeInLeft'		=> __( 'fadeInLeft' , 'uabb' ),
							'fadeInLeftBig'		=> __( 'fadeInLeftBig' , 'uabb' ),
							'fadeInRight'		=> __( 'fadeInRight' , 'uabb' ),
							'fadeInRightBig'	=> __( 'fadeInRightBig' , 'uabb' ),
							'fadeInUp'			=> __( 'fadeInUp' , 'uabb' ),
							'fadeInUpBig'		=> __( 'fadeInUpBig' , 'uabb' ),
							'flipInX'			=> __( 'flipInX' , 'uabb' ),
							'flipInY'			=> __( 'flipInY' , 'uabb' ),
							'flipOutX'			=> __( 'flipOutX' , 'uabb' ),
							'flipOutY'			=> __( 'flipOutY' , 'uabb' ),
							'lightSpeedIn'		=> __( 'lightSpeedIn' , 'uabb' ),
							'rotateIn'			=> __( 'rotateIn' , 'uabb' ),
							'rotateInDownLeft'	=> __( 'rotateInDownLeft' , 'uabb' ),
							'rotateInDownRight'	=> __( 'rotateInDownRight' , 'uabb' ),
							'rotateInUpLeft'	=> __( 'rotateInUpLeft' , 'uabb' ),
							'rotateInUpRight'	=> __( 'rotateInUpRight' , 'uabb' ),
							'rollIn'			=> __( 'rollIn' , 'uabb' ),
							'zoomIn'			=> __( 'zoomIn' , 'uabb' ),
							'zoomInDown'		=> __( 'zoomInDown' , 'uabb' ),
							'zoomInLeft'		=> __( 'zoomInLeft' , 'uabb' ),
							'zoomInRight'		=> __( 'zoomInRight' , 'uabb' ),
							'zoomInUp'			=> __( 'zoomInUp' , 'uabb' ),
							'slideInDown'		=> __( 'slideInDown' , 'uabb' ),
							'slideInLeft'		=> __( 'slideInLeft' , 'uabb' ),
							'slideInRight'		=> __( 'slideInRight' , 'uabb' ),
							'slideInUp'			=> __( 'slideInUp' , 'uabb' ),
                    	),
                    ),

                    /*'img_animation_duration'          => array(
                        'type'          => 'text',
                        'label'         => __('Animation Duration', 'uabb'),
                        'default'       => '',
                        'help'          => 'How long the animation effect should last. Decides the speed of effect.',
                        'maxlength'     => '3',
                        'size'          => '6',
                        'description'   => 's',
                    ),*/

                    'img_animation_delay'          => array(
                        'type'          => 'text',
                        'label'         => __('Animation Delay', 'uabb'),
                        'placeholder'   => '0',
                        'help'          => __('Delay the animation effect for seconds you entered.','uabb'),
                        'maxlength'     => '3',
                        'size'          => '6',
                        'description'   => 'sec',
                    ),

                    'img_animation_repeat'          => array(
                        'type'          => 'text',
                        'label'         => __('Repeat Animation', 'uabb'),
                        'placeholder'   => '1',
                        'help'          => __('The animation effect will repeat to the count you enter. Enter 0 if you want to repeat it infinitely.','uabb'),
                        'maxlength'     => '3',
                        'size'          => '6',
                        'description'   => 'times',
                    ),

                    'img_viewport_position'          => array(
                        'type'          => 'text',
                        'label'         => __('Viewport Position', 'uabb'),
                        'placeholder'   => '90',
                        'help'          => __('The area of screen from top where animation effect will start working.','uabb'),
                        'maxlength'     => '3',
                        'size'          => '6',
                        'description'   => '%',
                    ),
				)
			),
		)
	),
));