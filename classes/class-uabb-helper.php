<?php

/**
 * Custom modules
 */
if( !class_exists( "BB_Ultimate_Addon_Helper" ) ) {
	
	class BB_Ultimate_Addon_Helper {

		//Class variables
		// public static $uabb_field;
		// public static $uabb_param;
		// public static $uabb_object;

		/*
		* Constructor function that initializes required actions and hooks
		* @Since 1.0
		*/
		function __construct() {

			$this->set_constants();
			/* Remove after 2 update */
			$this->update_enable_modules_db();
		}

		function set_constants() {
			$branding         = BB_Ultimate_Addon_Helper::get_builder_uabb_branding();
			$branding_name    = 'UABB';
			$branding_modules = __('UABB Modules', 'uabb');

			//	Branding - %s
			if (
				is_array( $branding ) &&
				array_key_exists( 'uabb-plugin-short-name', $branding ) &&
				$branding['uabb-plugin-short-name'] != ''
			) {
				$branding_name = $branding['uabb-plugin-short-name'];
			}

			//	Branding - %s Modules
			if ( $branding_name != 'UABB') {
				$branding_modules = sprintf( __( '%s Modules', 'uabb' ), $branding_name );
			}

			define( 'UABB_PREFIX', $branding_name );
			define( 'UABB_CAT', $branding_modules );			
		}
		
		static public function get_builder_uabb()
		{
			$uabb = UABB_Init::$uabb_options['fl_builder_uabb'];

			$defaults = array(
				'load_panels'			=> 1,
				'uabb-live-preview'		=> 1,
				'load_templates' 		=> 1,
				'uabb-google-map-api'	=> '',
				'uabb-colorpicker'		=> 1,
				'uabb-row-separator'    => 1
			);

			//	if empty add all defaults
			if( empty( $uabb ) ) {
				$uabb = $defaults;
			} else {

				//	add new key
				foreach( $defaults as $key => $value ) {
					if( is_array( $uabb ) && !array_key_exists( $key, $uabb ) ) {
						$uabb[$key] = $value;
					} else {
						$uabb = wp_parse_args( $uabb, $defaults );
					}
				}
			}

			return apply_filters( 'uabb_get_builder_uabb', $uabb );
		}

		static public function get_builder_uabb_branding( $request_key = '' )
		{
			$uabb = UABB_Init::$uabb_options['fl_builder_uabb_branding'];

			$defaults = array(
				'uabb-enable-template-cloud' => 1,
			);


			//	if empty add all defaults
			if( empty( $uabb ) ) {
				$uabb = $defaults;
			} else {

				//	add new key
				foreach( $defaults as $key => $value ) {
					if( is_array( $uabb ) && !array_key_exists( $key, $uabb ) ) {
						$uabb[$key] = $value;
					} else {
						$uabb = wp_parse_args( $uabb, $defaults );
					}
				}
			}

			$uabb = apply_filters( 'uabb_get_builder_uabb_branding', $uabb );
			
			/**
			 * Return specific requested branding value
			 */
			if( !empty( $request_key ) ) {
				if( is_array($uabb) ) {
					$uabb = ( array_key_exists( $request_key, $uabb ) ) ? $uabb[ $request_key ] : '';
				}				
			}

			return $uabb;
		}

		/* Enable Disbale Modules function */
		/* Remove it after 2 update */
		function update_enable_modules_db()
		{
			//$is_updated = false;
			$is_updated = get_option( 'uabb_old_modules' );
			if ( $is_updated != 'updated' ) {
				
				$uabb 				= UABB_Init::$uabb_options['fl_builder_uabb_modules'];

				FLBuilderModel::update_admin_settings_option( '_fl_builder_uabb_modules', $uabb, false );

				UABB_Init::set_uabb_options();

				add_option( 'uabb_old_modules', 'updated' );
			}

		}

		static public function get_all_modules()
		{
			$modules_array = array(
				'spacer-gap'               	=> 'Spacer / Gap',
				'ribbon'                   	=> 'Ribbon',
				'image-separator'          	=> 'Image Separator',
				'uabb-separator'           	=> 'Simple Separator',
				'info-table'               	=> 'Info Table',
				'info-list'                	=> 'Info List',
				'slide-box'                	=> 'Slide Box',
				'flip-box'                 	=> 'Flip Box',
			);
			
			return $modules_array;
		}

		static public function get_builder_uabb_modules()
		{
			$uabb 			= UABB_Init::$uabb_options['fl_builder_uabb_modules'];
			$all_modules 	= self::get_all_modules();
			$is_all_modules = true;

			/* Delte below after test */
			//$uabb 			= self::get_all_modules();
			/* Delte above after test */

			//	if empty add all defaults
			if( empty( $uabb ) ) {
				$uabb 			= self::get_all_modules();
				$uabb['all'] 	= 'all';
			}else {
				if ( !isset( $uabb['unset_all'] ) ) {
					//	add new key
					foreach( $all_modules as $key => $value ) {
						if( is_array( $uabb ) && !array_key_exists( $key, $uabb ) ) {
							$uabb[$key] = $key;
							// $is_all_modules = false;
							// break;
						}
					}
				}
			}

			if ( $is_all_modules == false && isset( $uabb['all'] ) ) {
				unset( $uabb['all'] );
			}

			return apply_filters( 'uabb_get_builder_uabb_modules', $uabb );
		}
		
		/**
		 *	Template status
		 *
		 *	Return the status of pages, sections, presets or all templates. Default: all
		 *	@return boolean
		 */
		public static function is_templates_exist( $templates_type = 'all' ) {

			$templates       = get_site_option( '_uabb_cloud_templats', false );
			$exist_templates = array(
				'page-templates' => 0,
				'sections'       => 0,
				'presets'        => 0
			);

			if( is_array( $templates ) && count( $templates ) > 0 ) {
				foreach( $templates as $type => $type_templates ) {

					//	Individual type array - [page-templates], [layout] or [row]
					if( $type_templates ) {
						foreach( $type_templates as $template_id => $template_data ) {
							
							/**
							 *	Check [status] & [dat_url_local] exist
							 */
							if(
								isset( $template_data['status'] ) && $template_data['status'] == true &&
								isset( $template_data['dat_url_local'] ) && !empty( $template_data['dat_url_local'] )
							) {
								$exist_templates[$type] = ( count( $exist_templates[$type] ) + 1 );
							}
						}
					}
				}
			}

			switch ( $templates_type ) {
				case 'page-templates':
								$_templates_exist = ( $exist_templates['page-templates'] >= 1 ) ? true : false;
				break;

				case 'sections':
								$_templates_exist = ( $exist_templates['sections'] >= 1 ) ? true : false;
				break;

				case 'presets':
								$_templates_exist = ( $exist_templates['presets'] >= 1 ) ? true : false;
				break;

				case 'all':
					default:
								$_templates_exist = ( $exist_templates['page-templates'] >= 1 || $exist_templates['sections'] >= 1 || $exist_templates['presets'] >= 1 ) ? true : false;
				break;
			}

			return $_templates_exist;
		}
		
	}
	new BB_Ultimate_Addon_Helper();
}
