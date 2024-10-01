<?php
/**
 * Backward compatibility.
 *
 * @since 1.2.4
 * @package BAckward Compatibility
 */

if ( ! class_exists( 'UABB_lite_Plugin_Backward' ) ) {

	/**
	 * UABB_lite_Plugin_Backward initial setup
	 *
	 * @since 1.2.4
	 */
	class UABB_lite_Plugin_Backward { // @codingStandardsIgnoreLine.

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @return self
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 *  Constructor
		 */
		public function __construct() {

			// UABB Updates.
			add_action( 'wp', array( $this, 'update_data' ) );
			add_action( 'transition_post_status', array( $this, 'post_status' ), 10, 3 );
		}

		/**
		 * Set UABB version for new page.
		 *
		 * @since 1.2.4
		 * @param var $new_status Checks the value if user is new.
		 * @param var $old_status Checks the value if user is old.
		 * @param var $post Checks the value of the post.
		 * @return void
		 */
		public function post_status( $new_status, $old_status, $post ) {

			if ( 'new' === $old_status && 'auto-draft' === $new_status ) {
				/* Update Version */
				update_post_meta( $post->ID, '_uabb_lite_version', BB_ULTIMATE_ADDON_LITE_VERSION );
			}
		}

		/**
		 * Execute Layout Data.
		 *
		 * @since 1.2.4
		 * @param var $post_id Gets the post ID.
		 * @return void
		 */
		public function layout_data_execute( $post_id ) {

			/* Layout Data */
			$layout_data = get_post_meta( $post_id, '_fl_builder_data', true );
			update_post_meta( $post_id, '_fl_builder_data_back', $layout_data );

			if ( is_array( $layout_data ) ) {
				foreach ( $layout_data as $id => $data ) {
					if ( isset( $layout_data[ $id ]->settings->type ) ) {

						switch ( $layout_data[ $id ]->settings->type ) {
							case 'flip-box':
								$this->uabb_flip_box( $layout_data[ $id ]->settings );
								break;
							case 'info-list':
								$this->uabb_info_list( $layout_data[ $id ]->settings );
								break;
							case 'info-table':
								$this->uabb_info_table( $layout_data[ $id ]->settings );
								break;
							case 'ribbon':
								$this->uabb_ribbon( $layout_data[ $id ]->settings );
								break;
							case 'slide-box':
								$this->uabb_slide_box( $layout_data[ $id ]->settings );
								break;
							case 'uabb-button':
								$this->uabb_button( $layout_data[ $id ]->settings );
								break;

							default:
								break;
						}
					}
				}

				update_post_meta( $post_id, '_fl_builder_data', $layout_data );

				$layout_data = null;
				unset( $layout_data );
			}
		}

		/**
		 * Execute Layout Draft.
		 *
		 * @since 1.2.4
		 * @param var $post_id gets the Post ID of the layout draft execute.
		 * @return void
		 */
		public function layout_draft_execute( $post_id ) {

			$layout_draft = get_post_meta( $post_id, '_fl_builder_draft', true );
			update_post_meta( $post_id, '_fl_builder_draft_back', $layout_draft );

			if ( is_array( $layout_draft ) ) {
				foreach ( $layout_draft as $id => $data ) {
					if ( isset( $layout_draft[ $id ]->settings->type ) ) {

						switch ( $layout_draft[ $id ]->settings->type ) {
							case 'flip-box':
								$this->uabb_flip_box( $layout_draft[ $id ]->settings );
								break;
							case 'info-list':
								$this->uabb_info_list( $layout_draft[ $id ]->settings );
								break;
							case 'info-table':
								$this->uabb_info_table( $layout_draft[ $id ]->settings );
								break;
							case 'ribbon':
								$this->uabb_ribbon( $layout_draft[ $id ]->settings );
								break;
							case 'slide-box':
								$this->uabb_slide_box( $layout_draft[ $id ]->settings );
								break;
							case 'uabb-button':
								$this->uabb_button( $layout_draft[ $id ]->settings );
								break;

							default:
								break;
						}
					}
				}

				update_post_meta( $post_id, '_fl_builder_draft', $layout_draft );

				$layout_draft = null;
				unset( $layout_draft );
			}
		}

		/**
		 * Implement UABB update logic.
		 *
		 * @since 1.2.4
		 * @return void
		 */
		public function update_data() {

			if ( ! FLBuilderModel::is_builder_active() && FLBuilderAJAX::doing_ajax() ) {
				return;
			}

			$update_journey = get_option( '_uabb_lite_journey_details', '0' );

			$new_user = get_option( '_uabb_lite_1_2_4_ver', '0' );

			if ( 'yes' === $new_user ) {
				return;
			}

			$post_id = get_the_ID();

			$new_page = get_post_meta( $post_id, '_uabb_lite_version', true );

			if ( '' !== $new_page ) {
				return;
			}

			$flag = get_post_meta( $post_id, '_uabb_lite_converted', true );

			if ( 'yes' === $flag ) {
				return;
			}

			$this->layout_data_execute( $post_id );

			$this->layout_draft_execute( $post_id );

			/* Update Flag */
			update_post_meta( $post_id, '_uabb_lite_converted', 'yes' );
		}

		/**
		 * UABB Flip Box.
		 *
		 * @since 1.2.4
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_flip_box( &$settings ) {

			if ( isset( $settings->front_title_typography_font_size['small'] ) && ! isset( $settings->front_title_typography_font_size_unit_responsive ) ) {
				$settings->front_title_typography_font_size_unit_responsive = $settings->front_title_typography_font_size['small'];
			}
			if ( isset( $settings->front_title_typography_font_size['medium'] ) && ! isset( $settings->front_title_typography_font_size_unit_medium ) ) {
				$settings->front_title_typography_font_size_unit_medium = $settings->front_title_typography_font_size['medium'];
			}
			if ( isset( $settings->front_title_typography_font_size['desktop'] ) && ! isset( $settings->front_title_typography_font_size_unit ) ) {
				$settings->front_title_typography_font_size_unit = $settings->front_title_typography_font_size['desktop'];
			}

			if ( isset( $settings->front_title_typography_line_height['small'] ) && isset( $settings->front_title_typography_font_size['small'] ) && 0 !== $settings->front_title_typography_font_size['small'] && ! isset( $settings->front_title_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->front_title_typography_line_height['small'] ) && is_numeric( $settings->front_title_typography_font_size['small'] ) ) {
					$settings->front_title_typography_line_height_unit_responsive = round( $settings->front_title_typography_line_height['small'] / $settings->front_title_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->front_title_typography_line_height['medium'] ) && isset( $settings->front_title_typography_font_size['medium'] ) && 0 !== $settings->front_title_typography_font_size['medium'] && ! isset( $settings->front_title_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->front_title_typography_line_height['medium'] ) && is_numeric( $settings->front_title_typography_font_size['medium'] ) ) {
					$settings->front_title_typography_line_height_unit_medium = round( $settings->front_title_typography_line_height['medium'] / $settings->front_title_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->front_title_typography_line_height['desktop'] ) && isset( $settings->front_title_typography_font_size['desktop'] ) && 0 !== $settings->front_title_typography_font_size['desktop'] && ! isset( $settings->front_title_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->front_title_typography_line_height['desktop'] ) && is_numeric( $settings->front_title_typography_font_size['desktop'] ) ) {
					$settings->front_title_typography_line_height_unit = round( $settings->front_title_typography_line_height['desktop'] / $settings->front_title_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->front_desc_typography_font_size['small'] ) && ! isset( $settings->front_desc_typography_font_size_unit_responsive ) ) {
				$settings->front_desc_typography_font_size_unit_responsive = $settings->front_desc_typography_font_size['small'];
			}
			if ( isset( $settings->front_desc_typography_font_size['medium'] ) && ! isset( $settings->front_desc_typography_font_size_unit_medium ) ) {
				$settings->front_desc_typography_font_size_unit_medium = $settings->front_desc_typography_font_size['medium'];
			}
			if ( isset( $settings->front_desc_typography_font_size['desktop'] ) && ! isset( $settings->front_desc_typography_font_size_unit ) ) {
				$settings->front_desc_typography_font_size_unit = $settings->front_desc_typography_font_size['desktop'];
			}

			if ( isset( $settings->front_desc_typography_line_height['small'] ) && isset( $settings->front_desc_typography_font_size['small'] ) && 0 !== $settings->front_desc_typography_font_size['small'] && ! isset( $settings->front_desc_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->front_desc_typography_line_height['small'] ) && is_numeric( $settings->front_desc_typography_font_size['small'] ) ) {
					$settings->front_desc_typography_line_height_unit_responsive = round( $settings->front_desc_typography_line_height['small'] / $settings->front_desc_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->front_desc_typography_line_height['medium'] ) && isset( $settings->front_desc_typography_font_size['medium'] ) && 0 !== $settings->front_desc_typography_font_size['medium'] && ! isset( $settings->front_desc_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->front_desc_typography_line_height['medium'] ) && is_numeric( $settings->front_desc_typography_font_size['medium'] ) ) {
					$settings->front_desc_typography_line_height_unit_medium = round( $settings->front_desc_typography_line_height['medium'] / $settings->front_desc_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->front_desc_typography_line_height['desktop'] ) && isset( $settings->front_desc_typography_font_size['desktop'] ) && 0 !== $settings->front_desc_typography_font_size['desktop'] && ! isset( $settings->front_desc_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->front_desc_typography_line_height['desktop'] ) && is_numeric( $settings->front_desc_typography_font_size['desktop'] ) ) {
					$settings->front_desc_typography_line_height_unit = round( $settings->front_desc_typography_line_height['desktop'] / $settings->front_desc_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->back_title_typography_font_size['small'] ) && ! isset( $settings->back_title_typography_font_size_unit_responsive ) ) {
				$settings->back_title_typography_font_size_unit_responsive = $settings->back_title_typography_font_size['small'];
			}
			if ( isset( $settings->back_title_typography_font_size['medium'] ) && ! isset( $settings->back_title_typography_font_size_unit_medium ) ) {
				$settings->back_title_typography_font_size_unit_medium = $settings->back_title_typography_font_size['medium'];
			}
			if ( isset( $settings->back_title_typography_font_size['desktop'] ) && ! isset( $settings->back_title_typography_font_size_unit ) ) {
				$settings->back_title_typography_font_size_unit = $settings->back_title_typography_font_size['desktop'];
			}

			if ( isset( $settings->back_title_typography_line_height['small'] ) && isset( $settings->back_title_typography_font_size['small'] ) && 0 !== $settings->back_title_typography_font_size['small'] && ! isset( $settings->back_title_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->back_title_typography_line_height['small'] ) && is_numeric( $settings->back_title_typography_font_size['small'] ) ) {
					$settings->back_title_typography_line_height_unit_responsive = round( $settings->back_title_typography_line_height['small'] / $settings->back_title_typography_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->back_title_typography_line_height['medium'] ) && isset( $settings->back_title_typography_font_size['medium'] ) && 0 !== $settings->back_title_typography_font_size['medium'] && ! isset( $settings->back_title_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->back_title_typography_line_height['medium'] ) && is_numeric( $settings->back_title_typography_font_size['medium'] ) ) {
					$settings->back_title_typography_line_height_unit_medium = round( $settings->back_title_typography_line_height['medium'] / $settings->back_title_typography_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->back_title_typography_line_height['desktop'] ) && isset( $settings->back_title_typography_font_size['desktop'] ) && 0 !== $settings->back_title_typography_font_size['desktop'] && ! isset( $settings->back_title_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->back_title_typography_line_height['desktop'] ) && is_numeric( $settings->back_title_typography_font_size['desktop'] ) ) {
					$settings->back_title_typography_line_height_unit = round( $settings->back_title_typography_line_height['desktop'] / $settings->back_title_typography_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->back_desc_typography_font_size['small'] ) && ! isset( $settings->back_desc_typography_font_size_unit_responsive ) ) {
				$settings->back_desc_typography_font_size_unit_responsive = $settings->back_desc_typography_font_size['small'];
			}
			if ( isset( $settings->back_desc_typography_font_size['medium'] ) && ! isset( $settings->back_desc_typography_font_size_unit_medium ) ) {
				$settings->back_desc_typography_font_size_unit_medium = $settings->back_desc_typography_font_size['medium'];
			}
			if ( isset( $settings->back_desc_typography_font_size['desktop'] ) && ! isset( $settings->back_desc_typography_font_size_unit ) ) {
				$settings->back_desc_typography_font_size_unit = $settings->back_desc_typography_font_size['desktop'];
			}

			if ( isset( $settings->back_desc_typography_line_height['small'] ) && isset( $settings->back_desc_typography_font_size['small'] ) && 0 !== $settings->back_desc_typography_font_size['small'] && ! isset( $settings->back_desc_typography_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->back_desc_typography_line_height['small'] ) && is_numeric( $settings->back_desc_typography_font_size['small'] ) ) {
					$settings->back_desc_typography_line_height_unit_responsive = $settings->back_desc_typography_line_height['small'] / $settings->back_desc_typography_font_size['small'];
				}
			}
			if ( isset( $settings->back_desc_typography_line_height['medium'] ) && isset( $settings->back_desc_typography_font_size['medium'] ) && 0 !== $settings->back_desc_typography_font_size['medium'] && ! isset( $settings->back_desc_typography_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->back_desc_typography_line_height['medium'] ) && is_numeric( $settings->back_desc_typography_font_size['medium'] ) ) {
					$settings->back_desc_typography_line_height_unit_medium = $settings->back_desc_typography_line_height['medium'] / $settings->back_desc_typography_font_size['medium'];
				}
			}
			if ( isset( $settings->back_desc_typography_line_height['desktop'] ) && isset( $settings->back_desc_typography_font_size['desktop'] ) && 0 !== $settings->back_desc_typography_font_size['desktop'] && ! isset( $settings->back_desc_typography_line_height_unit ) ) {
				if ( is_numeric( $settings->back_desc_typography_line_height['desktop'] ) && is_numeric( $settings->back_desc_typography_font_size['desktop'] ) ) {
					$settings->back_desc_typography_line_height_unit = $settings->back_desc_typography_line_height['desktop'] / $settings->back_desc_typography_font_size['desktop'];
				}
			}

			if ( isset( $settings->button->font_size->small ) && ! isset( $settings->button->font_size_unit_responsive ) ) {
				$settings->button->font_size_unit_responsive = $settings->button->font_size->small;
			}
			if ( isset( $settings->button->font_size->medium ) && ! isset( $settings->button->font_size_unit_medium ) ) {
				$settings->button->font_size_unit_medium = $settings->button->font_size->medium;
			}
			if ( isset( $settings->button->font_size->desktop ) && ! isset( $settings->button->font_size_unit ) ) {
				$settings->button->font_size_unit = $settings->button->font_size->desktop;
			}

			if ( isset( $settings->button->line_height->small ) && isset( $settings->button->font_size->small ) && 0 !== $settings->button->font_size->small && ! isset( $settings->button->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->button->line_height->small ) && is_numeric( $settings->button->font_size->small ) ) {
					$settings->button->line_height_unit_responsive = round( $settings->button->line_height->small / $settings->button->font_size->small );
				}
			}
			if ( isset( $settings->button->line_height->medium ) && isset( $settings->button->font_size->medium ) && 0 !== $settings->button->font_size->medium && ! isset( $settings->button->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->button->line_height->medium ) && is_numeric( $settings->button->font_size->medium ) ) {
					$settings->button->line_height_unit_medium = round( $settings->button->line_height->medium / $settings->button->font_size->medium );
				}
			}
			if ( isset( $settings->button->line_height->desktop ) && isset( $settings->button->font_size->desktop ) && 0 !== $settings->button->font_size->desktop && ! isset( $settings->button->line_height_unit ) ) {
				if ( is_numeric( $settings->button->line_height->desktop ) && is_numeric( $settings->button->font_size->desktop ) ) {
					$settings->button->line_height_unit = round( $settings->button->line_height->desktop / $settings->button->font_size->desktop );
				}
			}

			if ( isset( $settings->inner_padding ) && ! isset( $settings->inner_padding_dimension_top ) && ! isset( $settings->inner_padding_dimension_bottom ) && ! isset( $settings->inner_padding_dimension_left ) && ! isset( $settings->inner_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->inner_padding );

				$output       = array();
				$uabb_default = array_filter( preg_split( '/\s*;\s*/', $value ) );

				$settings->inner_padding_dimension_top    = '';
				$settings->inner_padding_dimension_bottom = '';
				$settings->inner_padding_dimension_left   = '';
				$settings->inner_padding_dimension_right  = '';

				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->inner_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->inner_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->inner_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->inner_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->inner_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->inner_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->inner_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->inner_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}
		}

		/**
		 * UABB Info List.
		 *
		 * @since 1.2.4
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_info_list( &$settings ) {

			if ( isset( $settings->heading_font_size['small'] ) && ! isset( $settings->heading_font_size_unit_responsive ) ) {
				$settings->heading_font_size_unit_responsive = $settings->heading_font_size['small'];
			}
			if ( isset( $settings->heading_font_size['medium'] ) && ! isset( $settings->heading_font_size_unit_medium ) ) {
				$settings->heading_font_size_unit_medium = $settings->heading_font_size['medium'];
			}
			if ( isset( $settings->heading_font_size['desktop'] ) && ! isset( $settings->heading_font_size_unit ) ) {
				$settings->heading_font_size_unit = $settings->heading_font_size['desktop'];
			}

			if ( isset( $settings->heading_line_height['small'] ) && isset( $settings->heading_font_size['small'] ) && 0 !== $settings->heading_font_size['small'] && ! isset( $settings->heading_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->heading_line_height['small'] ) && is_numeric( $settings->heading_font_size['small'] ) ) {
					$settings->heading_line_height_unit_responsive = round( $settings->heading_line_height['small'] / $settings->heading_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->heading_line_height['medium'] ) && isset( $settings->heading_font_size['medium'] ) && 0 !== $settings->heading_font_size['medium'] && ! isset( $settings->heading_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->heading_line_height['medium'] ) && is_numeric( $settings->heading_font_size['medium'] ) ) {
					$settings->heading_line_height_unit_medium = round( $settings->heading_line_height['medium'] / $settings->heading_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->heading_line_height['desktop'] ) && isset( $settings->heading_font_size['desktop'] ) && 0 !== $settings->heading_font_size['desktop'] && ! isset( $settings->heading_line_height_unit ) ) {
				if ( is_numeric( $settings->heading_line_height['desktop'] ) && is_numeric( $settings->heading_font_size['desktop'] ) ) {
					$settings->heading_line_height_unit = round( $settings->heading_line_height['desktop'] / $settings->heading_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->description_font_size['small'] ) && ! isset( $settings->description_font_size_unit_responsive ) ) {
				$settings->description_font_size_unit_responsive = $settings->description_font_size['small'];
			}
			if ( isset( $settings->description_font_size['medium'] ) && ! isset( $settings->description_font_size_unit_medium ) ) {
				$settings->description_font_size_unit_medium = $settings->description_font_size['medium'];
			}
			if ( isset( $settings->description_font_size['desktop'] ) && ! isset( $settings->description_font_size_unit ) ) {
				$settings->description_font_size_unit = $settings->description_font_size['desktop'];
			}

			if ( isset( $settings->description_line_height['small'] ) && isset( $settings->description_font_size['small'] ) && 0 !== $settings->description_font_size['small'] && ! isset( $settings->description_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->description_line_height['small'] ) && is_numeric( $settings->description_font_size['small'] ) ) {
					$settings->description_line_height_unit_responsive = round( $settings->description_line_height['small'] / $settings->description_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->description_line_height['medium'] ) && isset( $settings->description_font_size['medium'] ) && 0 !== $settings->description_font_size['medium'] && ! isset( $settings->description_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->description_line_height['medium'] ) && is_numeric( $settings->description_font_size['medium'] ) ) {
					$settings->description_line_height_unit_medium = round( $settings->description_line_height['medium'] / $settings->description_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->description_line_height['desktop'] ) && isset( $settings->description_font_size['desktop'] ) && 0 !== $settings->description_font_size['desktop'] && ! isset( $settings->description_line_height_unit ) ) {
				if ( is_numeric( $settings->description_line_height['desktop'] ) && is_numeric( $settings->description_font_size['desktop'] ) ) {
					$settings->description_line_height_unit = round( $settings->description_line_height['desktop'] / $settings->description_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Info Table.
		 *
		 * @since 1.2.4
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_info_table( &$settings ) {

			if ( isset( $settings->heading_font_size['small'] ) && ! isset( $settings->heading_font_size_unit_responsive ) ) {
				$settings->heading_font_size_unit_responsive = $settings->heading_font_size['small'];
			}
			if ( isset( $settings->heading_font_size['medium'] ) && ! isset( $settings->heading_font_size_unit_medium ) ) {
				$settings->heading_font_size_unit_medium = $settings->heading_font_size['medium'];
			}
			if ( isset( $settings->heading_font_size['desktop'] ) && ! isset( $settings->heading_font_size_unit ) ) {
				$settings->heading_font_size_unit = $settings->heading_font_size['desktop'];
			}

			if ( isset( $settings->heading_line_height['small'] ) && isset( $settings->heading_font_size['small'] ) && 0 !== $settings->heading_font_size['small'] && ! isset( $settings->heading_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->heading_line_height['small'] ) && is_numeric( $settings->heading_font_size['small'] ) ) {
					$settings->heading_line_height_unit_responsive = round( $settings->heading_line_height['small'] / $settings->heading_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->heading_line_height['medium'] ) && isset( $settings->heading_font_size['medium'] ) && 0 !== $settings->heading_font_size['medium'] && ! isset( $settings->heading_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->heading_line_height['medium'] ) && is_numeric( $settings->heading_font_size['medium'] ) ) {
					$settings->heading_line_height_unit_medium = round( $settings->heading_line_height['medium'] / $settings->heading_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->heading_line_height['desktop'] ) && isset( $settings->heading_font_size['desktop'] ) && 0 !== $settings->heading_font_size['desktop'] && ! isset( $settings->heading_line_height_unit ) ) {
				if ( is_numeric( $settings->heading_line_height['desktop'] ) && is_numeric( $settings->heading_font_size['desktop'] ) ) {
					$settings->heading_line_height_unit = round( $settings->heading_line_height['desktop'] / $settings->heading_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->description_font_size['small'] ) && ! isset( $settings->description_font_size_unit_responsive ) ) {
				$settings->description_font_size_unit_responsive = $settings->description_font_size['small'];
			}
			if ( isset( $settings->description_font_size['medium'] ) && ! isset( $settings->description_font_size_unit_medium ) ) {
				$settings->description_font_size_unit_medium = $settings->description_font_size['medium'];
			}
			if ( isset( $settings->description_font_size['desktop'] ) && ! isset( $settings->description_font_size_unit ) ) {
				$settings->description_font_size_unit = $settings->description_font_size['desktop'];
			}

			if ( isset( $settings->description_line_height['small'] ) && isset( $settings->description_font_size['small'] ) && 0 !== $settings->description_font_size['small'] && ! isset( $settings->description_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->description_line_height['small'] ) && is_numeric( $settings->description_font_size['small'] ) ) {
					$settings->description_line_height_unit_responsive = round( $settings->description_line_height['small'] / $settings->description_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->description_line_height['medium'] ) && isset( $settings->description_font_size['medium'] ) && 0 !== $settings->description_font_size['medium'] && ! isset( $settings->description_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->description_line_height['medium'] ) && is_numeric( $settings->description_font_size['medium'] ) ) {
					$settings->description_line_height_unit_medium = round( $settings->description_line_height['medium'] / $settings->description_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->description_line_height['desktop'] ) && isset( $settings->description_font_size['desktop'] ) && 0 !== $settings->description_font_size['desktop'] && ! isset( $settings->description_line_height_unit ) ) {
				if ( is_numeric( $settings->description_line_height['desktop'] ) && is_numeric( $settings->description_font_size['desktop'] ) ) {
					$settings->description_line_height_unit = round( $settings->description_line_height['desktop'] / $settings->description_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->sub_heading_font_size['small'] ) && ! isset( $settings->sub_heading_font_size_unit_responsive ) ) {
				$settings->sub_heading_font_size_unit_responsive = $settings->sub_heading_font_size['small'];
			}
			if ( isset( $settings->sub_heading_font_size['medium'] ) && ! isset( $settings->sub_heading_font_size_unit_medium ) ) {
				$settings->sub_heading_font_size_unit_medium = $settings->sub_heading_font_size['medium'];
			}
			if ( isset( $settings->sub_heading_font_size['desktop'] ) && ! isset( $settings->sub_heading_font_size_unit ) ) {
				$settings->sub_heading_font_size_unit = $settings->sub_heading_font_size['desktop'];
			}

			if ( isset( $settings->sub_heading_line_height['small'] ) && isset( $settings->sub_heading_font_size['small'] ) && 0 !== $settings->sub_heading_font_size['small'] && ! isset( $settings->sub_heading_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->sub_heading_line_height['small'] ) && is_numeric( $settings->sub_heading_font_size['small'] ) ) {
					$settings->sub_heading_line_height_unit_responsive = round( $settings->sub_heading_line_height['small'] / $settings->sub_heading_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->sub_heading_line_height['medium'] ) && isset( $settings->sub_heading_font_size['medium'] ) && 0 !== $settings->sub_heading_font_size['medium'] && ! isset( $settings->sub_heading_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->sub_heading_line_height['medium'] ) && is_numeric( $settings->sub_heading_font_size['medium'] ) ) {
					$settings->sub_heading_line_height_unit_medium = round( $settings->sub_heading_line_height['medium'] / $settings->sub_heading_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->sub_heading_line_height['desktop'] ) && isset( $settings->sub_heading_font_size['desktop'] ) && 0 !== $settings->sub_heading_font_size['desktop'] && ! isset( $settings->sub_heading_line_height_unit ) ) {
				if ( is_numeric( $settings->sub_heading_line_height['desktop'] ) && is_numeric( $settings->sub_heading_font_size['desktop'] ) ) {
					$settings->sub_heading_line_height_unit = round( $settings->sub_heading_line_height['desktop'] / $settings->sub_heading_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->btn_font_size['small'] ) && ! isset( $settings->btn_font_size_unit_responsive ) ) {
				$settings->btn_font_size_unit_responsive = $settings->btn_font_size['small'];
			}
			if ( isset( $settings->btn_font_size['medium'] ) && ! isset( $settings->btn_font_size_unit_medium ) ) {
				$settings->btn_font_size_unit_medium = $settings->btn_font_size['medium'];
			}
			if ( isset( $settings->btn_font_size['desktop'] ) && ! isset( $settings->btn_font_size_unit ) ) {
				$settings->btn_font_size_unit = $settings->btn_font_size['desktop'];
			}

			if ( isset( $settings->btn_line_height['small'] ) && isset( $settings->btn_font_size['small'] ) && 0 !== $settings->btn_font_size['small'] && ! isset( $settings->btn_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->btn_line_height['small'] ) && is_numeric( $settings->btn_font_size['small'] ) ) {
					$settings->btn_line_height_unit_responsive = round( $settings->btn_line_height['small'] / $settings->btn_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['medium'] ) && isset( $settings->btn_font_size['medium'] ) && 0 !== $settings->btn_font_size['medium'] && ! isset( $settings->btn_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->btn_line_height['medium'] ) && is_numeric( $settings->btn_font_size['medium'] ) ) {
					$settings->btn_line_height_unit_medium = round( $settings->btn_line_height['medium'] / $settings->btn_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->btn_line_height['desktop'] ) && isset( $settings->btn_font_size['desktop'] ) && 0 !== $settings->btn_font_size['desktop'] && ! isset( $settings->btn_line_height_unit ) ) {
				if ( is_numeric( $settings->btn_line_height['desktop'] ) && is_numeric( $settings->btn_font_size['desktop'] ) ) {
					$settings->btn_line_height_unit = round( $settings->btn_line_height['desktop'] / $settings->btn_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Ribbon.
		 *
		 * @since 1.2.4
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_ribbon( &$settings ) {

			if ( isset( $settings->text_font_size['small'] ) && ! isset( $settings->text_font_size_unit_responsive ) ) {
				$settings->text_font_size_unit_responsive = $settings->text_font_size['small'];
			}
			if ( isset( $settings->text_font_size['medium'] ) && ! isset( $settings->text_font_size_unit_medium ) ) {
				$settings->text_font_size_unit_medium = $settings->text_font_size['medium'];
			}
			if ( isset( $settings->text_font_size['desktop'] ) && ! isset( $settings->text_font_size_unit ) ) {
				$settings->text_font_size_unit = $settings->text_font_size['desktop'];
			}

			if ( isset( $settings->text_line_height['small'] ) && isset( $settings->text_font_size['small'] ) && 0 !== $settings->text_font_size['small'] && ! isset( $settings->text_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->text_line_height['small'] ) && is_numeric( $settings->text_font_size['small'] ) ) {
					$settings->text_line_height_unit_responsive = round( $settings->text_line_height['small'] / $settings->text_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->text_line_height['medium'] ) && isset( $settings->text_font_size['medium'] ) && 0 !== $settings->text_font_size['medium'] && ! isset( $settings->text_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->text_line_height['medium'] ) && is_numeric( $settings->text_font_size['medium'] ) ) {
					$settings->text_line_height_unit_medium = round( $settings->text_line_height['medium'] / $settings->text_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->text_line_height['desktop'] ) && isset( $settings->text_font_size['desktop'] ) && 0 !== $settings->text_font_size['desktop'] && ! isset( $settings->text_line_height_unit ) ) {
				if ( is_numeric( $settings->text_line_height['desktop'] ) && is_numeric( $settings->text_font_size['desktop'] ) ) {
					$settings->text_line_height_unit = round( $settings->text_line_height['desktop'] / $settings->text_font_size['desktop'], 2 );
				}
			}
		}

		/**
		 * UABB Slide Box.
		 *
		 * @since 1.2.4
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_slide_box( &$settings ) {

			if ( isset( $settings->front_title_font_size['small'] ) && ! isset( $settings->front_title_font_size_unit_responsive ) ) {
				$settings->front_title_font_size_unit_responsive = $settings->front_title_font_size['small'];
			}
			if ( isset( $settings->front_title_font_size['medium'] ) && ! isset( $settings->front_title_font_size_unit_medium ) ) {
				$settings->front_title_font_size_unit_medium = $settings->front_title_font_size['medium'];
			}
			if ( isset( $settings->front_title_font_size['desktop'] ) && ! isset( $settings->front_title_font_size_unit ) ) {
				$settings->front_title_font_size_unit = $settings->front_title_font_size['desktop'];
			}

			if ( isset( $settings->front_title_line_height['small'] ) && isset( $settings->front_title_font_size['small'] ) && 0 !== $settings->front_title_font_size['small'] && ! isset( $settings->front_title_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->front_title_line_height['small'] ) && is_numeric( $settings->front_title_font_size['small'] ) ) {
					$settings->front_title_line_height_unit_responsive = round( $settings->front_title_line_height['small'] / $settings->front_title_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->front_title_line_height['medium'] ) && isset( $settings->front_title_font_size['medium'] ) && 0 !== $settings->front_title_font_size['medium'] && ! isset( $settings->front_title_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->front_title_line_height['medium'] ) && is_numeric( $settings->front_title_font_size['medium'] ) ) {
					$settings->front_title_line_height_unit_medium = round( $settings->front_title_line_height['medium'] / $settings->front_title_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->front_title_line_height['desktop'] ) && isset( $settings->front_title_font_size['desktop'] ) && 0 !== $settings->front_title_font_size['desktop'] && ! isset( $settings->front_title_line_height_unit ) ) {
				if ( is_numeric( $settings->front_title_line_height['desktop'] ) && is_numeric( $settings->front_title_font_size['desktop'] ) ) {
					$settings->front_title_line_height_unit = round( $settings->front_title_line_height['desktop'] / $settings->front_title_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->front_desc_font_size['small'] ) && ! isset( $settings->front_desc_font_size_unit_responsive ) ) {
				$settings->front_desc_font_size_unit_responsive = $settings->front_desc_font_size['small'];
			}
			if ( isset( $settings->front_desc_font_size['medium'] ) && ! isset( $settings->front_desc_font_size_unit_medium ) ) {
				$settings->front_desc_font_size_unit_medium = $settings->front_desc_font_size['medium'];
			}
			if ( isset( $settings->front_desc_font_size['desktop'] ) && ! isset( $settings->front_desc_font_size_unit ) ) {
				$settings->front_desc_font_size_unit = $settings->front_desc_font_size['desktop'];
			}

			if ( isset( $settings->front_desc_line_height['small'] ) && isset( $settings->front_desc_font_size['small'] ) && 0 !== $settings->front_desc_font_size['small'] && ! isset( $settings->front_desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->front_desc_line_height['small'] ) && is_numeric( $settings->front_desc_font_size['small'] ) ) {
					$settings->front_desc_line_height_unit_responsive = round( $settings->front_desc_line_height['small'] / $settings->front_desc_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->front_desc_line_height['medium'] ) && isset( $settings->front_desc_font_size['medium'] ) && 0 !== $settings->front_desc_font_size['medium'] && ! isset( $settings->front_desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->front_desc_line_height['medium'] ) && is_numeric( $settings->front_desc_font_size['medium'] ) ) {
					$settings->front_desc_line_height_unit_medium = round( $settings->front_desc_line_height['medium'] / $settings->front_desc_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->front_desc_line_height['desktop'] ) && isset( $settings->front_desc_font_size['desktop'] ) && 0 !== $settings->front_desc_font_size['desktop'] && ! isset( $settings->front_desc_line_height_unit ) ) {
				if ( is_numeric( $settings->front_desc_line_height['desktop'] ) && is_numeric( $settings->front_desc_font_size['desktop'] ) ) {
					$settings->front_desc_line_height_unit = round( $settings->front_desc_line_height['desktop'] / $settings->front_desc_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->back_title_font_size['small'] ) && ! isset( $settings->back_title_font_size_unit_responsive ) ) {
				$settings->back_title_font_size_unit_responsive = $settings->back_title_font_size['small'];
			}
			if ( isset( $settings->back_title_font_size['medium'] ) && ! isset( $settings->back_title_font_size_unit_medium ) ) {
				$settings->back_title_font_size_unit_medium = $settings->back_title_font_size['medium'];
			}
			if ( isset( $settings->back_title_font_size['desktop'] ) && ! isset( $settings->back_title_font_size_unit ) ) {
				$settings->back_title_font_size_unit = $settings->back_title_font_size['desktop'];
			}

			if ( isset( $settings->back_title_line_height['small'] ) && isset( $settings->back_title_font_size['small'] ) && 0 !== $settings->back_title_font_size['small'] && ! isset( $settings->back_title_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->back_title_line_height['small'] ) && is_numeric( $settings->back_title_font_size['small'] ) ) {
					$settings->back_title_line_height_unit_responsive = round( $settings->back_title_line_height['small'] / $settings->back_title_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->back_title_line_height['medium'] ) && isset( $settings->back_title_font_size['medium'] ) && 0 !== $settings->back_title_font_size['medium'] && ! isset( $settings->back_title_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->back_title_line_height['medium'] ) && is_numeric( $settings->back_title_font_size['medium'] ) ) {
					$settings->back_title_line_height_unit_medium = round( $settings->back_title_line_height['medium'] / $settings->back_title_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->back_title_line_height['desktop'] ) && isset( $settings->back_title_font_size['desktop'] ) && 0 !== $settings->back_title_font_size['desktop'] && ! isset( $settings->back_title_line_height_unit ) ) {
				if ( is_numeric( $settings->back_title_line_height['desktop'] ) && is_numeric( $settings->back_title_font_size['desktop'] ) ) {
					$settings->back_title_line_height_unit = round( $settings->back_title_line_height['desktop'] / $settings->back_title_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->back_desc_font_size['small'] ) && ! isset( $settings->back_desc_font_size_unit_responsive ) ) {
				$settings->back_desc_font_size_unit_responsive = $settings->back_desc_font_size['small'];
			}
			if ( isset( $settings->back_desc_font_size['medium'] ) && ! isset( $settings->back_desc_font_size_unit_medium ) ) {
				$settings->back_desc_font_size_unit_medium = $settings->back_desc_font_size['medium'];
			}
			if ( isset( $settings->back_desc_font_size['desktop'] ) && ! isset( $settings->back_desc_font_size_unit ) ) {
				$settings->back_desc_font_size_unit = $settings->back_desc_font_size['desktop'];
			}

			if ( isset( $settings->back_desc_line_height['small'] ) && isset( $settings->back_desc_font_size['small'] ) && 0 !== $settings->back_desc_font_size['small'] && ! isset( $settings->back_desc_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->back_desc_line_height['small'] ) && is_numeric( $settings->back_desc_font_size['small'] ) ) {
					$settings->back_desc_line_height_unit_responsive = round( $settings->back_desc_line_height['small'] / $settings->back_desc_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->back_desc_line_height['medium'] ) && isset( $settings->back_desc_font_size['medium'] ) && 0 !== $settings->back_desc_font_size['medium'] && ! isset( $settings->back_desc_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->back_desc_line_height['medium'] ) && is_numeric( $settings->back_desc_font_size['medium'] ) ) {
					$settings->back_desc_line_height_unit_medium = round( $settings->back_desc_line_height['medium'] / $settings->back_desc_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->back_desc_line_height['desktop'] ) && isset( $settings->back_desc_font_size['desktop'] ) && 0 !== $settings->back_desc_font_size['desktop'] && ! isset( $settings->back_desc_line_height_unit ) ) {
				if ( is_numeric( $settings->back_desc_line_height['desktop'] ) && is_numeric( $settings->back_desc_font_size['desktop'] ) ) {
					$settings->back_desc_line_height_unit = round( $settings->back_desc_line_height['desktop'] / $settings->back_desc_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->link_font_size['small'] ) && ! isset( $settings->link_font_size_unit_responsive ) ) {
				$settings->link_font_size_unit_responsive = $settings->link_font_size['small'];
			}
			if ( isset( $settings->link_font_size['medium'] ) && ! isset( $settings->link_font_size_unit_medium ) ) {
				$settings->link_font_size_unit_medium = $settings->link_font_size['medium'];
			}
			if ( isset( $settings->link_font_size['desktop'] ) && ! isset( $settings->link_font_size_unit ) ) {
				$settings->link_font_size_unit = $settings->link_font_size['desktop'];
			}

			if ( isset( $settings->link_line_height['small'] ) && isset( $settings->link_font_size['small'] ) && 0 !== $settings->link_font_size['small'] && ! isset( $settings->link_line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->link_line_height['small'] ) && is_numeric( $settings->link_font_size['small'] ) ) {
					$settings->link_line_height_unit_responsive = round( $settings->link_line_height['small'] / $settings->link_font_size['small'], 2 );
				}
			}
			if ( isset( $settings->link_line_height['medium'] ) && isset( $settings->link_font_size['medium'] ) && 0 !== $settings->link_font_size['medium'] && ! isset( $settings->link_line_height_unit_medium ) ) {
				if ( is_numeric( $settings->link_line_height['medium'] ) && is_numeric( $settings->link_font_size['medium'] ) ) {
					$settings->link_line_height_unit_medium = round( $settings->link_line_height['medium'] / $settings->link_font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->link_line_height['desktop'] ) && isset( $settings->link_font_size['desktop'] ) && 0 !== $settings->link_font_size['desktop'] && ! isset( $settings->link_line_height_unit ) ) {
				if ( is_numeric( $settings->link_line_height['desktop'] ) && is_numeric( $settings->link_font_size['desktop'] ) ) {
					$settings->link_line_height_unit = round( $settings->link_line_height['desktop'] / $settings->link_font_size['desktop'], 2 );
				}
			}

			if ( isset( $settings->button->font_size->small ) && ! isset( $settings->button->font_size_unit_responsive ) ) {
				$settings->button->font_size_unit_responsive = $settings->button->font_size->small;
			}
			if ( isset( $settings->button->font_size->medium ) && ! isset( $settings->button->font_size_unit_medium ) ) {
				$settings->button->font_size_unit_medium = $settings->button->font_size->medium;
			}
			if ( isset( $settings->button->font_size->desktop ) && ! isset( $settings->button->font_size_unit ) ) {
				$settings->button->font_size_unit = $settings->button->font_size->desktop;
			}

			if ( isset( $settings->button->line_height->small ) && isset( $settings->button->font_size->small ) && 0 !== $settings->button->font_size->small && ! isset( $settings->button->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->button->line_height->small ) && is_numeric( $settings->button->font_size->small ) ) {
					$settings->button->line_height_unit_responsive = round( $settings->button->line_height->small / $settings->button->font_size->small );
				}
			}
			if ( isset( $settings->button->line_height->medium ) && isset( $settings->button->font_size->medium ) && 0 !== $settings->button->font_size->medium && ! isset( $settings->button->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->button->line_height->medium ) && is_numeric( $settings->button->font_size->medium ) ) {
					$settings->button->line_height_unit_medium = round( $settings->button->line_height->medium / $settings->button->font_size->medium );
				}
			}
			if ( isset( $settings->button->line_height->desktop ) && isset( $settings->button->font_size->desktop ) && 0 !== $settings->button->font_size->desktop && ! isset( $settings->button->line_height_unit ) ) {
				if ( is_numeric( $settings->button->line_height->desktop ) && is_numeric( $settings->button->font_size->desktop ) ) {
					$settings->button->line_height_unit = round( $settings->button->line_height->desktop / $settings->button->font_size->desktop );
				}
			}

			if ( isset( $settings->front_padding ) && ! isset( $settings->front_padding_dimension_top ) && ! isset( $settings->front_padding_dimension_bottom ) && ! isset( $settings->front_padding_dimension_left ) && ! isset( $settings->front_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->front_padding );

				$output                                   = array();
				$uabb_default                             = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->front_padding_dimension_top    = '0';
				$settings->front_padding_dimension_bottom = '0';
				$settings->front_padding_dimension_right  = '0';
				$settings->front_padding_dimension_left   = '0';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {

					switch ( $output[ $i ][0] ) {
						case 'padding-top':
							$settings->front_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->front_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->front_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->front_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->front_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->front_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->front_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->front_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}

			if ( isset( $settings->back_padding ) && ! isset( $settings->back_padding_dimension_top ) && ! isset( $settings->back_padding_dimension_bottom ) && ! isset( $settings->back_padding_dimension_left ) && ! isset( $settings->back_padding_dimension_right ) ) {

				$value = '';
				$value = str_replace( 'px', '', $settings->back_padding );

				$output                                  = array();
				$uabb_default                            = array_filter( preg_split( '/\s*;\s*/', $value ) );
				$settings->back_padding_dimension_top    = '0';
				$settings->back_padding_dimension_bottom = '0';
				$settings->back_padding_dimension_right  = '0';
				$settings->back_padding_dimension_left   = '0';
				foreach ( $uabb_default as $val ) {
					$new      = explode( ':', $val );
					$output[] = $new;
				}
				for ( $i = 0; $i < count( $output ); $i++ ) {
					switch ( $output[ $i ][0] ) {

						case 'padding-top':
							$settings->back_padding_dimension_top = (int) $output[ $i ][1];
							break;
						case 'padding-bottom':
							$settings->back_padding_dimension_bottom = (int) $output[ $i ][1];
							break;
						case 'padding-right':
							$settings->back_padding_dimension_right = (int) $output[ $i ][1];
							break;
						case 'padding-left':
							$settings->back_padding_dimension_left = (int) $output[ $i ][1];
							break;
						case 'padding':
							$settings->back_padding_dimension_top    = (int) $output[ $i ][1];
							$settings->back_padding_dimension_bottom = (int) $output[ $i ][1];
							$settings->back_padding_dimension_left   = (int) $output[ $i ][1];
							$settings->back_padding_dimension_right  = (int) $output[ $i ][1];
							break;
					}
				}
			}
		}

		/**
		 * UABB Button.
		 *
		 * @since 1.2.4
		 * @param object $settings gets the settings of respective module.
		 * @return void
		 */
		public function uabb_button( &$settings ) {

			if ( isset( $settings->font_size['small'] ) && ! isset( $settings->font_size_unit_responsive ) ) {
				$settings->font_size_unit_responsive = $settings->font_size['small'];
			}
			if ( isset( $settings->font_size['medium'] ) && ! isset( $settings->font_size_unit_medium ) ) {
				$settings->font_size_unit_medium = $settings->font_size['medium'];
			}
			if ( isset( $settings->font_size['desktop'] ) && ! isset( $settings->font_size_unit ) ) {
				$settings->font_size_unit = $settings->font_size['desktop'];
			}

			if ( isset( $settings->line_height['small'] ) && isset( $settings->font_size['small'] ) && 0 !== $settings->font_size['small'] && ! isset( $settings->line_height_unit_responsive ) ) {
				if ( is_numeric( $settings->line_height['small'] ) && is_numeric( $settings->font_size['small'] ) ) {
					$settings->line_height_unit_responsive = round( $settings->line_height['small'] / $settings->font_size['small'], 2 );
				}
			}
			if ( isset( $settings->line_height['medium'] ) && isset( $settings->font_size['medium'] ) && 0 !== $settings->font_size['medium'] && ! isset( $settings->line_height_unit_medium ) ) {
				if ( is_numeric( $settings->line_height['medium'] ) && is_numeric( $settings->font_size['medium'] ) ) {
					$settings->line_height_unit_medium = round( $settings->line_height['medium'] / $settings->font_size['medium'], 2 );
				}
			}
			if ( isset( $settings->line_height['desktop'] ) && isset( $settings->font_size['desktop'] ) && 0 !== $settings->font_size['desktop'] && ! isset( $settings->line_height_unit ) ) {
				if ( is_numeric( $settings->line_height['desktop'] ) && is_numeric( $settings->font_size['desktop'] ) ) {
					$settings->line_height_unit = round( $settings->line_height['desktop'] / $settings->font_size['desktop'], 2 );
				}
			}
		}
	}
}// End if().
UABB_lite_Plugin_Backward::get_instance();
