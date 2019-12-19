<?php
/**
 * Custom modules
 *
 * @package UABB Helper
 */

if ( ! class_exists( 'BB_Ultimate_Addon_Helper' ) ) {
	/**
	 * This class initializes BB Ultiamte Addon Helper
	 *
	 * @class BB_Ultimate_Addon_Helper
	 */
	class BB_Ultimate_Addon_Helper {

		/**
		 * Holds any category strings of modules.
		 *
		 * @since 1.0
		 * @var $basic_modules Category Strings
		 */
		static public $basic_modules = '';

		/**
		 * Constructor function that initializes required actions and hooks
		 *
		 * @since 1.0
		 */
		function __construct() {

			$this->set_constants();
		}

		/**
		 * Function that set constants for UABB
		 *
		 * @since 1.0
		 */
		function set_constants() {
			$branding            = BB_Ultimate_Addon_Helper::get_builder_uabb_branding();
			self::$basic_modules = __( 'Basic', 'uabb' );
			$branding_name       = 'UABB';
			$branding_modules    = __( 'UABB Modules', 'uabb' );

			// Branding - %s.
			if ( is_array( $branding ) && array_key_exists( 'uabb-plugin-short-name', $branding ) && '' != $branding['uabb-plugin-short-name'] ) {
				$branding_name = $branding['uabb-plugin-short-name'];
			}

			// Branding - %s Modules.
			if ( 'UABB' != $branding_name ) {
				$branding_modules = sprintf( __( '%s Modules', 'uabb' ), $branding_name ); // @codingStandardsIgnoreLine.
			}

			define( 'UABB_PREFIX', $branding_name );
			define( 'UABB_CAT', $branding_modules );
		}

		/**
		 * Function that renders BB's modules category
		 *
		 * @since 1.0
		 * @param array $cat gets the BB's UI ControlPanel Category.
		 */
		static public function module_cat( $cat ) {
			return class_exists( 'FLBuilderUIContentPanel' ) ? $cat : UABB_CAT;
		}

		/**
		 * Function that renders builder UABB
		 *
		 * @since 1.0
		 */
		static public function get_builder_uabb() {
			$uabb = UABB_Init::$uabb_options['fl_builder_uabb'];

			$defaults = array(
				'load_panels'         => 1,
				'uabb-live-preview'   => 1,
				'load_templates'      => 1,
				'uabb-google-map-api' => '',
				'uabb-colorpicker'    => 1,
				'uabb-row-separator'  => 1,
			);

			// if empty add all defaults.
			if ( empty( $uabb ) ) {
				$uabb = $defaults;
			} else {

				// add new key.
				foreach ( $defaults as $key => $value ) {
					if ( is_array( $uabb ) && ! array_key_exists( $key, $uabb ) ) {
						$uabb[ $key ] = $value;
					} else {
						$uabb = wp_parse_args( $uabb, $defaults );
					}
				}
			}

			return apply_filters( 'uabb_get_builder_uabb', $uabb );
		}

		/**
		 * Function that renders extensions for the UABB
		 *
		 * @since 1.0
		 * @param string $request_key gets the request key's value.
		 */
		static public function get_builder_uabb_branding( $request_key = '' ) {
			$uabb = UABB_Init::$uabb_options['fl_builder_uabb_branding'];

			$defaults = array(
				'uabb-enable-template-cloud' => 1,
			);

			// if empty add all defaults.
			if ( empty( $uabb ) ) {
				$uabb = $defaults;
			} else {

				// add new key.
				foreach ( $defaults as $key => $value ) {
					if ( is_array( $uabb ) && ! array_key_exists( $key, $uabb ) ) {
						$uabb[ $key ] = $value;
					} else {
						$uabb = wp_parse_args( $uabb, $defaults );
					}
				}
			}

			$uabb = apply_filters( 'uabb_get_builder_uabb_branding', $uabb );

			/**
			 * Return specific requested branding value
			 */
			if ( ! empty( $request_key ) ) {
				if ( is_array( $uabb ) ) {
					$uabb = ( array_key_exists( $request_key, $uabb ) ) ? $uabb[ $request_key ] : '';
				}
			}

			return $uabb;
		}

		/**
		 * Function that renders all the UABB modules
		 *
		 * @since 1.0
		 */
		static public function get_all_modules() {
			$modules_array = array(
				'spacer-gap'      => 'Spacer / Gap',
				'ribbon'          => 'Ribbon',
				'image-separator' => 'Image Separator',
				'uabb-separator'  => 'Simple Separator',
				'info-table'      => 'Info Table',
				'info-list'       => 'Info List',
				'slide-box'       => 'Slide Box',
				'flip-box'        => 'Flip Box',
				'image-icon'      => 'Image / Icon',
				'uabb-button'     => 'Button',
				'uabb-heading'    => 'Heading',
			);

			return $modules_array;
		}

		/**
		 * Function that renders premium modules
		 *
		 * @since 1.0
		 */
		static public function get_premium_modules() {
			$premium_modules_array = array(

				'advanced-accordion'       => array(
					'label'     => 'Advanced Accordion',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/advanced-accordion/',
					'class'     => '',
					'tag_title' => '',
				),
				'advanced-icon'            => array(
					'label'     => 'Advanced Icons',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/advanced-icon/',
					'class'     => '',
					'tag_title' => '',
				),
				'uabb-advanced-menu'       => array(
					'label'     => 'Advanced Menu',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/advanced-menu/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'New!',
				),
				'blog-posts'               => array(
					'label'     => 'Advanced Posts',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/advanced-posts/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'Updated',
				),
				'advanced-separator'       => array(
					'label'     => 'Advanced Separator',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/advanced-separator/',
					'class'     => '',
					'tag_title' => '',
				),
				'advanced-tabs'            => array(
					'label'     => 'Advanced Tabs',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/advanced-tabs/',
					'class'     => '',
					'tag_title' => '',
				),
				'uabb-beforeafterslider'   => array(
					'label'     => 'Before After Slider',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/before-after-slider/',
					'class'     => '',
					'tag_title' => '',
				),
				'uabb-call-to-action'      => array(
					'label'     => 'Call To Action',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/call-to-action/',
					'class'     => '',
					'tag_title' => '',
				),
				'uabb-col-gradient'        => array(
					'label'     => 'Column Gradient',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/row-column-gradient/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'New!',
				),
				'uabb-col-shadow'          => array(
					'label'     => 'Column Shadow',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/column-shadow/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'New!',
				),
				'uabb-contact-form7'       => array(
					'label'     => 'CF7 Styler',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/contact-form7-styler/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'New!',
				),
				'uabb-contact-form'        => array(
					'label'     => 'Contact Form',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/contact-form/',
					'class'     => '',
					'tag_title' => '',
				),
				'uabb-countdown'           => array(
					'label'     => 'Countdown',
					'demo_url'  => '',
					'class'     => '',
					'tag_title' => '',
				),
				'uabb-numbers'             => array(
					'label'     => 'Counter',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/counter/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'Updated',
				),
				'creative-link'            => array(
					'label'     => 'Creative Link',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/creative-link/',
					'class'     => '',
					'tag_title' => '',
				),
				'dual-button'              => array(
					'label'     => 'Dual Button',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/dual-button/',
					'class'     => '',
					'tag_title' => '',
				),
				'dual-color-heading'       => array(
					'label'     => 'Dual Color Heading',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/dual-color-heading/',
					'class'     => '',
					'tag_title' => '',
				),
				'fancy-text'               => array(
					'label'     => 'Fancy Text',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/fancy-text/',
					'class'     => 'uabb-premium-flyout-purple',
					'tag_title' => 'Popular',
				),
				'google-map'               => array(
					'label'     => 'Google Map',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/google-map/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'Updated',
				),
				'uabb-gravity-form'        => array(
					'label'     => 'Gravity Forms Styler',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/gravity-forms/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'Popular',
				),
				'uabb-heading'             => array(
					'label'     => 'Heading',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/heading/',
					'class'     => '',
					'tag_title' => '',
				),
				'uabb-hotspot'             => array(
					'label'     => 'Hotspot',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/hotspot/',
					'class'     => 'uabb-premium-flyout-purple',
					'tag_title' => 'Popular',
				),
				'uabb-image-carousel'      => array(
					'label'     => 'Image Carousel',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/image-carousel/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'NEW!',
				),
				'info-banner'              => array(
					'label'     => 'Info Banner',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/info-banner/',
					'class'     => '',
					'tag_title' => '',
				),
				'info-box'                 => array(
					'label'     => 'Info Box',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/info-box/',
					'class'     => 'uabb-premium-flyout-purple',
					'tag_title' => 'Popular',
				),
				'info-circle'              => array(
					'label'     => 'Info Circle',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/info-circle/',
					'class'     => 'uabb-premium-flyout-red',
					'tag_title' => 'Unique',
				),
				'ihover'                   => array(
					'label'     => 'iHover',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/ihover/',
					'class'     => '',
					'tag_title' => '',
				),
				'interactive-banner-1'     => array(
					'label'     => 'Interactive Banner 1',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/interactive-banner/',
					'class'     => '',
					'tag_title' => '',
				),
				'interactive-banner-2'     => array(
					'label'     => 'Interactive Banner 2',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/interactive-banner-2/',
					'class'     => '',
					'tag_title' => '',
				),
				'list-icon'                => array(
					'label'     => 'List Icon',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/list-icon/',
					'class'     => '',
					'tag_title' => '',
				),
				'mailchimp-subscribe-form' => array(
					'label'     => 'MailChimp Subscription Form',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/mailchimp-subscribe-form/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'Updated',
				),
				'modal-popup'              => array(
					'label'     => 'Modal Popup',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/modal-popup/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'Updated',
				),
				'uabb-photo'               => array(
					'label'     => 'Photo',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/photo/',
					'class'     => '',
					'tag_title' => '',
				),
				'photo-gallery'            => array(
					'label'     => 'Photo Gallery',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/photo-gallery/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'Updated',
				),
				'pricing-box'              => array(
					'label'     => 'Price Box',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/price-box/',
					'class'     => '',
					'tag_title' => '',
				),
				'progress-bar'             => array(
					'label'     => 'Progress Bar',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/progress-bar/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'Updated',
				),
				'row-separator'            => array(
					'label'     => 'Row Separator',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/row-separators/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'Updated',
				),
				'uabb-row-gradient'        => array(
					'label'     => 'Row Gradient',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/row-column-gradient/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'New!',
				),
				'uabb-social-share'        => array(
					'label'     => 'Social Share',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/social-share/',
					'class'     => '',
					'tag_title' => '',
				),
				'team'                     => array(
					'label'     => 'Team',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/team/',
					'class'     => '',
					'tag_title' => '',
				),
				'adv-testimonials'         => array(
					'label'     => 'Testimonials',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/testimonials/',
					'class'     => '',
					'tag_title' => '',
				),
				'uabb-content-toggle'      => array(
					'label'     => 'Content Toggle',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/content-toggle/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'New!',
				),
				'uabb-business-hours'      => array(
					'label'     => 'Business Hours',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/business-hours/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'New!',
				),
				'uabb-woo-add-to-cart'     => array(
					'label'     => 'Woo Add to Cart',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/woo-add-to-cart/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'New!',
				),
				'uabb-woo-categories'      => array(
					'label'     => 'Woo Categories',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/woo-categories/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'New!',
				),
				'uabb-woo-products'        => array(
					'label'     => 'Woo Products',
					'demo_url'  => 'https://www.ultimatebeaver.com/modules/woo-products/',
					'class'     => 'uabb-premium-flyout-green',
					'tag_title' => 'New!',
				),
			);

			return $premium_modules_array;
		}

		/**
		 * Function that renders UABB's modules
		 *
		 * @since 1.0
		 */
		static public function get_builder_uabb_modules() {
			$uabb           = UABB_Init::$uabb_options['fl_builder_uabb_modules'];
			$all_modules    = self::get_all_modules();
			$is_all_modules = true;

			// if empty add all defaults.
			if ( empty( $uabb ) ) {
				$uabb        = self::get_all_modules();
				$uabb['all'] = 'all';
			} else {
				if ( ! isset( $uabb['unset_all'] ) ) {
					// add new key.
					foreach ( $all_modules as $key => $value ) {
						if ( is_array( $uabb ) && ! array_key_exists( $key, $uabb ) ) {
							$uabb[ $key ] = $key;
						}
					}
				}
			}

			if ( false == $is_all_modules && isset( $uabb['all'] ) ) {
				unset( $uabb['all'] );
			}

			$uabb['image-icon']     = 'image-icon';
			$uabb['uabb-separator'] = 'uabb-separator';
			$uabb['uabb-button']    = 'uabb-button';

			return apply_filters( 'uabb_get_builder_uabb_modules', $uabb );
		}

		/**
		 *  Template status
		 *
		 *  Return the status of pages, sections, presets or all templates. Default: all
		 *
		 *  @param string $templates_type gets the templates type.
		 *  @return boolean
		 */
		public static function is_templates_exist( $templates_type = 'all' ) {

			$templates       = get_site_option( '_uabb_cloud_templats', false );
			$exist_templates = array(
				'page-templates' => 0,
				'sections'       => 0,
				'presets'        => 0,
			);

			if ( is_array( $templates ) && count( $templates ) > 0 ) {
				foreach ( $templates as $type => $type_templates ) {

					if ( $type_templates ) {
						foreach ( $type_templates as $template_id => $template_data ) {

							/**
							 *  Check [status] & [dat_url_local] exist
							 */
							if ( isset( $template_data['status'] ) && true == $template_data['status'] &&
								isset( $template_data['dat_url_local'] ) && ! empty( $template_data['dat_url_local'] ) ) {
								if ( is_array( $exist_templates[ $type ] ) ) {
									$exist_templates[ $type ] = ( count( $exist_templates[ $type ] ) + 1 );
								}
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

		/**
		 *  Get link rel attribute
		 *
		 *  @since 1.0
		 *  @param string $target gets an string for the link.
		 *  @param string $is_nofollow gets an string for is no follow.
		 *  @param string $echo gets an string for echo.
		 *  @return string
		 */
		static public function get_link_rel( $target, $is_nofollow = 0, $echo = 0 ) {

			$attr = '';
			if ( '_blank' == $target ) {
				$attr .= 'noopener';
			}

			if ( 1 == $is_nofollow ) {
				$attr .= ' nofollow';
			}

			if ( '' == $attr ) {
				return;
			}

			$attr = trim( $attr );
			if ( ! $echo ) {
				return 'rel="' . $attr . '"';
			}
			echo 'rel="' . $attr . '"';
		}

		/**
		 * Get flag if more than 5 pages are build using UABB.
		 *
		 * @since  1.3.0
		 * @return boolean true/false Flag if more than 5 pages are build using UABB.
		 */
		public static function show_rating_notice() {

			$posts_created_with_uabb = get_option( 'posts-created-with-uabb' );

			if ( ! empty( $posts_created_with_uabb ) && 5 === $posts_created_with_uabb ) {

				return true;

			} else {

				global $wpdb;

				$get_posts = $wpdb->prepare( "SELECT count(*) FROM $wpdb->posts wpp INNER JOIN $wpdb->postmeta wppm WHERE wpp.ID = wppm.post_id AND wpp.post_status = '%s' AND wppm.meta_key = %s AND ( wppm.meta_value LIKE '%s' OR wppm.meta_value LIKE '%s' OR  wppm.meta_value LIKE '%s' OR wppm.meta_value LIKE '%s' OR wppm.meta_value LIKE '%s' OR wppm.meta_value LIKE '%s' OR wppm.meta_value LIKE '%s' OR wppm.meta_value LIKE '%s' OR wppm.meta_value LIKE '%s' OR wppm.meta_value LIKE '%s' OR wppm.meta_value LIKE '%s' OR wppm.meta_value LIKE '%s') LIMIT %d ", 'publish', '_fl_builder_data', '%uabb-advanced-menu%', '%flip-box%', '%info-list%', '%info-table%', '%ribbon%', '%slide-box%', '%uabb-button%', '%spacer-gap%', '%image-separator%', '%uabb-separator%', '%image-icon%', '%uabb-heading%', 5 );

				$uabb_post_count = $wpdb->get_var( $get_posts );

				if ( $uabb_post_count == 5 ) {

					update_option( 'posts-created-with-uabb', $uabb_post_count );

					return true;
				}
			}

			return false;
		}
	}
	new BB_Ultimate_Addon_Helper();
}
