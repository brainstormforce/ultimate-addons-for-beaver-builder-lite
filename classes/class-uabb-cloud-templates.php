<?php

/**
 * UABB Cloud Templates initial setup
 *
 * @since 1.2.0.2
 */

if( !class_exists('UABB_Cloud_Templates') ) {

	class UABB_Cloud_Templates {

		private static $instance;
		private static $cloud_url;
		protected static $uabb_filesystem = null;

		/**
		 *  Initiator
		 *
		 * @since 1.2.0.2
		 */
		public static function get_instance(){
			if ( ! isset( self::$instance ) ) {
				self::$instance = new UABB_Cloud_Templates();
			}
			return self::$instance;
		}

		/**
		 * Constructor function that initializes required actions and hooks
		 *
		 * @since 1.2.0.2
		 */
		function __construct() {

			self::$cloud_url = array(
				'page-templates' => 'http://templates.ultimatebeaver.com/wp-json/uabb/v1/template/layouts/',
				'sections'       => 'http://templates.ultimatebeaver.com/wp-json/uabb/v1/template/sections/',
				'presets'        => 'http://templates.ultimatebeaver.com/wp-json/uabb/v1/template/presets/',
			);

			self::$cloud_url = apply_filters( 'uabb_template_cloud_api', self::$cloud_url );

			add_action( 'wp_ajax_uabb_cloud_dat_file', array( $this, 'download_cloud_templates' ) );
			add_action( 'wp_ajax_uabb_cloud_dat_file_remove', array( $this, 'remove_local_dat_file' ) );
			add_action( 'wp_ajax_uabb_cloud_dat_file_fetch', array( $this, 'fetch_cloud_templates' ) );
		}

		static function reset_cloud_transient() {

			//	get - downloaded templates
			$cloud_templates      = array();
			$downloaded_templates = get_site_option( '_uabb_cloud_templats', false );

			//	get - cloud templates by type
			foreach( self::$cloud_url as $type => $url ) {

				$response = wp_remote_get( $url, array(
					'timeout'     => 30,
					'sslverify'   => false,
					'httpversion' => '1.1'
				) );

				if( is_wp_error( $response ) ) {
					$type_templates = 'wp_error';
				}

				$type_templates = json_decode( wp_remote_retrieve_body( $response ), 1 );

				/**
				 * 	has {cloud} && has {downloaded}
				 *
				 * 	Then, keep latest & installed templates.
				 */
				if(
					( is_array( $type_templates ) && count( $type_templates ) > 0 ) &&
					( is_array( $downloaded_templates[$type] ) && count( $downloaded_templates[$type] ) > 0 )
				) {

					/**
					 * Handle unexpected JSON response
					 */
					if(
						array_key_exists( 'code', $type_templates ) ||
						array_key_exists( 'message', $type_templates ) ||
						array_key_exists( 'data', $type_templates )
					) {
						return;
					}

					foreach(  $downloaded_templates[$type] as $key => $template ) {

						/**
						 *	Found in template id in local templates?
						 *	then, add 'status' & 'dat_url_local' to the template by matching its template id
						 */
						if( array_key_exists( $key, $type_templates ) ) {

							$type_templates[$key]['status']        = ( isset( $downloaded_templates[$type][$key]['status'] ) ) ? $downloaded_templates[$type][$key]['status'] : '';
							$type_templates[$key]['dat_url_local'] = ( isset( $downloaded_templates[$type][$key]['dat_url_local'] ) ) ? $downloaded_templates[$type][$key]['dat_url_local'] : '';

						/**
						 *	Not found local template id in new templates
						 *	then add template to new template array
						 */
						} else {

							/**
							 *	Only downloaded old templates are added in new templates
							 *	If old template is not downloaded recently then it'll be removed.
							 */
							if(
								( array_key_exists( 'status', $downloaded_templates[$type][$key] ) ) &&
								( array_key_exists( 'dat_url_local', $downloaded_templates[$type][$key] ) )
							) {

								/**
								 *	Add if 'status' == 'true' &&
								 *	Add if not empty 'dat_url_local'
								 */
								if(
									( $downloaded_templates[$type][$key]['status'] == 'true' ) &&
									( !empty( $downloaded_templates[$type][$key]['dat_url_local'] ) )
								) {
									$type_templates[$key] = $downloaded_templates[$type][$key];
								}
							}

						}
					}

					$cloud_templates[ $type ] = $type_templates;

				/**
				 * 	has {cloud} && NOT has {downloaded}
				 *
				 * 	Then, keep cloud.
				 */
				} else if(
						( is_array( $type_templates ) && count( $type_templates ) > 0 ) &&
						( count( $downloaded_templates[$type] ) == 0 )
					) {

					$cloud_templates[ $type ] = $type_templates;

				/**
				 * 	NOT has {cloud} && has {downloaded}
				 *
				 * 	Then, keep downloaded.
				 */
				} else if( $type_templates == 0 && count( $downloaded_templates[$type] ) > 0 ) {

					$cloud_templates[ $type ] = $downloaded_templates[$type];
				}
			}

			/**
		     * Finally update the cloud templates
		     *
		     * So, used update_site_option() to update network option '_uabb_cloud_templats'
		     */
			update_site_option( '_uabb_cloud_templats', $cloud_templates, true );
		}

		/**
		 * Get cloud templates
		 *
		 * @since 1.2.0.2
		 */
		static function get_cloud_templates_count( $type = '' ) {
			$templates       = get_site_option( '_uabb_cloud_templats', false );
			$templates_count = 0;

			if( is_array( $templates ) && count( $templates ) > 0 ) {
				switch( $type ) {
					case 'page-templates':
					case 'presets':
										if( array_key_exists($type, $templates) ) {
											$templates_count = count( $templates[$type] );
										}
						break;
					case 'sections':
										if( array_key_exists($type, $templates) ) {
											if( is_array( $templates[$type] ) && count( $templates[$type] ) > 1 ) {
												foreach ( $templates[$type] as $id => $template) {
													$count           = ( isset( $template['count'] ) ) ? $template['count'] : 0;
													$templates_count = $templates_count + $count;
												}
											}
										}
						break;
					default:
										foreach( self::$cloud_url as $type => $url ) {
											$templates_count = $templates_count + count( $templates[$type] );
										}
						break;
				}
			}

			return $templates_count;
		}

		/**
		 * Get cloud templates
		 *
		 * @since 1.2.0.2
		 */
		static function get_cloud_templates( $type = '' ) {

			$templates = get_site_option( '_uabb_cloud_templats', false );

			if( !empty( $templates ) ) {

				//	Return all templates
				if( empty( $type ) ) {
					return $templates;

				//	Return specific templates
				} else {
					return $templates[ $type ];
				}

			} else {
				return array();
			}

		}

		/**
		 * Remove local dat files
		 *
		 * @since 1.2.0.2
		 */
		function remove_local_dat_file() {

			//	Get template details
			$dat_file_id        = ( $_POST['dat_file_id'] ) ? $_POST['dat_file_id'] : '';
			$dat_url_local      = ( $_POST['dat_file_url_local'] ) ? $_POST['dat_file_url_local'] : '';
			$dat_file_type      = ( $_POST['dat_file_type'] ) ? $this->get_right_type_key( $_POST['dat_file_type'] ) : '';
			$templates          = get_site_option( '_uabb_cloud_templats', false );
			$updatedStatus      = false;
			$removedDatFile     = false;
			$msg                = array();
			$ajaxResult['id']   = $dat_file_id;
			$ajaxResult['type'] = $dat_file_type;

			/**
			 *	1. Update template status
			 * 	is [page-templates / sections / presets] exist?
			 */
			if( array_key_exists($dat_file_type, $templates ) ) {

				//	is template [ID] exist?
				if( array_key_exists($dat_file_id, $templates[$dat_file_type] ) ) {

					//	[status] key exist?
					if( array_key_exists('status', $templates[$dat_file_type][$dat_file_id] ) ) {
						$templates[$dat_file_type][$dat_file_id]['status'] = false;
						$updatedStatus = true;
					} else {
						$msg[] = "Not found [status] for ID: " . $dat_file_id;
					}

					/**
					 *	2. Remove .dat file from local
					 */
					$local_dat_file = ( isset( $templates[$dat_file_type][$dat_file_id]['dat_url_local'] ) ) ? $templates[$dat_file_type][$dat_file_id]['dat_url_local'] : '';
					if( !empty( $local_dat_file ) && file_exists( $local_dat_file ) ) {
						unlink( $local_dat_file );
						$removedDatFile = true;
					} else {
						$msg[] = "Not found [dat_url_local] for ID: " . $dat_file_id;
					}

					/**
					 *	3. Setting AJAX response to initialize Download button
					 */
					$remote_dat_file       = ( isset( $templates[$dat_file_type][$dat_file_id]['dat_url'] ) ) ? urlencode( $templates[$dat_file_type][$dat_file_id]['dat_url'] ) : '';
					$ajaxResult['dat_url'] = $remote_dat_file;
					$ajaxResult['status']  = 'success';

					/**
				      * Finally update the cloud templates
				      *
				      * So, used update_site_option() to update network option '_uabb_cloud_templats'
				      */
				    update_site_option( '_uabb_cloud_templats', $templates, true );
				}

			} else {
				$ajaxResult['status'] = "failed";
			}

			//	Result
			echo json_encode( $ajaxResult );

			die();
		}

		/**
		 * Fetch cloud templates
		 *
		 * @since 1.2.0.2
		 */
		function fetch_cloud_templates() {
			self::reset_cloud_transient();
			$ajaxResult['status'] = 'success';

			//	Result
			echo json_encode( $ajaxResult );

			die();
		}

		function get_right_type_key( $dat_file_type ) {

			//	Update the key
			if( 'module' == $dat_file_type ) {
				$dat_file_type = 'presets';
			}
			if( 'layout' == $dat_file_type ) {
				$dat_file_type = 'page-templates';
			}
			if( 'row' == $dat_file_type ) {
				$dat_file_type = 'sections';
			}

			return $dat_file_type;
		}

		public static function load_filesystem() {
            if ( self::$uabb_filesystem === null ) {
                require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-base.php';
                require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-direct.php';
                self::$uabb_filesystem = new WP_Filesystem_Direct( array() );
            }
        }

		/**
		 * Download cloud templates
		 *
		 * @since 1.2.0.2
		 */
		function download_cloud_templates() {

			//	Check folder exist or not?
			$dir_info                    = self::create_local_dir();

			//	Get template details
			$dat_file_url                = $dir_info['url'] . basename( $_POST['dat_file'] );
			$remote_file                 = ( isset( $_POST['dat_file'] ) ) ? $_POST['dat_file'] : '';
			$local_file                  = trailingslashit( $dir_info['path'] ) . basename( $remote_file );
			$dat_file_id                 = ( isset( $_POST['dat_file_id'] ) ) ? $_POST['dat_file_id'] : '';
			$dat_file_type               = ( isset( $_POST['dat_file_type'] ) ) ? $this->get_right_type_key( $_POST['dat_file_type'] ) : '';
			$ajaxResult['id']            = $dat_file_id;
			$ajaxResult['type']          = $dat_file_type;
			$ajaxResult['dat_url_local'] = urlencode( $local_file );

			//	Download file to /temp/ directory
			$temp_file = download_url( $remote_file, $timeout = 300 );

			if( ! is_wp_error( $temp_file ) ) {

				//	Initialize file system
				self::load_filesystem();

				//	Copy remote .dat file
				if( self::$uabb_filesystem->copy( $temp_file, $local_file, true ) ) {

					if( !empty($dat_file_id) ) {

						$templates = get_site_option( '_uabb_cloud_templats', false );

						if( !empty( $dat_file_type ) ) {
							foreach( $templates[$dat_file_type] as $key => $template ) {
								if( $dat_file_id == $templates[$dat_file_type][$key]['id'] ) {
									$templates[$dat_file_type][$key]['status']        = 'true';
									$templates[$dat_file_type][$key]['dat_url_local'] = $local_file;
								}
							}
						}

					    /**
					     * 	Here FLBuilderModel::update_admin_settings_option() not works!
					     *
					     * So, used update_site_option() to update network option '_uabb_cloud_templats'
					     */
					    update_site_option( '_uabb_cloud_templats', $templates, true );

					    $ajaxResult['status'] = "success";
					}

				} else {

					//	Could not copy the file
				    $ajaxResult['status'] = "failed";
				}

				//	Remove temporary file from /temp/ directory
				unlink( $temp_file );

			//	Could not download .dat then show error message
			} else {

				$ajaxResult['status'] = "failed";
				$ajaxResult['msg']    = $temp_file->get_error_message();
			}

			//	Result
			echo json_encode( $ajaxResult );

			die();
		}

		/**
		 * Messages
		 *
		 * @since 1.2.0.2
		 */
		static function message( $msg ) {
			if( !empty( $msg ) ) {
				if( 'not-found' == $msg ) { ?>
					<div class="uabb-cloud-templates-not-found">

						<h3> <?php printf( __( 'Welcome to %s Template Cloud!', 'uabb' ), UABB_PREFIX ); ?> </h3>
						<p> <?php printf( __( '%s Template Cloud would allow you to browse through our growing library of 150+ professionally designed templates and download the only ones that you need.', 'uabb' ), UABB_PREFIX ); ?> <span class="uabb-cloud-process button-primary" data-operation="fetch"> <i class="dashicons dashicons-update " style="display: none; padding: 3px;"></i> <?php _e( "Let's get started", "uabb" ); ?> &rarr; </span></p>

					</div>
				<?php }
			}
		}

		/**
		 * Template HTML
		 *
		 * @since 1.2.0.2
		 */
		static function template_html( $type = 'page-templates' ) {

			$templates = self::get_cloud_templates( $type );

			if( is_array( $templates ) && count( $templates ) > 0 ) {
				?>

				<div class="uabb-templates-showcase-<?php echo $type; ?>">

					<?php if( $type == 'page-templates' ) { ?>

						<ul class="uabb-templates-filter">
							<li><a class="active" href="#" data-group="all"><?php _e( 'All', 'uabb' ); ?> </a></li>
							<?php

								$tags = array();
								foreach( $templates as $temp_id => $temp_meta ) {
									$temp_meta_tags = ( isset($temp_meta['tags']) ) ? $temp_meta['tags'] : '';
									if( is_array( $temp_meta_tags ) ) {
										foreach ($temp_meta_tags as $curr_tag) {
											$tags[] = $curr_tag;
										}
									}
								}

								$tags = array_unique( $tags ); 		//	Remove duplicates
								sort( $tags );						//	Sort

								foreach ($tags as $key => $tag) {
									$tag_title = strtolower( str_replace(' ', '-', $tag) );
									if( 'home-pages' == $tag_title ) {
										echo '<li><a href="#" data-group="home-pages" class="home-pages">Home Pages</a></li>';
										unset( $tags[ $key ] );
									}
								}

								$tags[] = 'installed';

								foreach ($tags as $tag) {
									$tag_title = strtolower( str_replace(' ', '-', $tag) ); ?>
									<li><a href="#" data-group='<?php echo $tag_title; ?>' class="<?php echo $tag_title; ?>"><?php echo $tag; ?></a></li>
								<?php } ?>
						</ul><!-- #uabb-templates-filter -->
					<?php } ?>

					<div id="uabb-templates-<?php echo $type; ?>" class="uabb-templates-<?php echo $type; ?>">

						<?php
						foreach( $templates as $template_id => $single_post ) {

							$data['id']            = ( isset($single_post['id']) ) ? $single_post['id'] : '';
							$data['name']          = ( isset($single_post['name']) ) ? $single_post['name'] : '';
							$data['image']         = ( isset($single_post['image']) ) ? $single_post['image'] : '';
							$data['type']          = ( isset($single_post['type']) ) ? $single_post['type'] : '';
							$data['status']        = ( isset($single_post['status']) ) ? $single_post['status'] : '';
							$data['dat_url']       = ( isset($single_post['dat_url']) ) ? $single_post['dat_url'] : '';
							$data['count']         = ( isset($single_post['count']) ) ? $single_post['count'] : '';
							$data['preview_url']   = ( isset($single_post['preview_url']) ) ? $single_post['preview_url'] : '';
							$data['dat_url_local'] = ( isset($single_post['dat_url_local']) ) ? $single_post['dat_url_local'] : '';
							$data['tags']          = ( isset($single_post['tags']) ) ? $single_post['tags'] : '';

							$template_class        = ( $data['status'] == 'true' ) ? 'uabb-downloaded' : '';

							//	get all single template tags.
							$tags = array();
							if( is_array( $data['tags'] ) ) {
								foreach( $data['tags'] as $curr_tag) {
									$tag_title = strtolower( str_replace(' ', '-', $curr_tag) );
									$tags[]    = $tag_title;
								}
							}

							/* Add downloaded tag */
							if( $data['status'] == 'true' ) {
								$tags[] = 'installed';
							}

							$tags = array_unique( $tags );
							$tags = implode('", "', $tags);
							?>
							<div id="<?php echo $data['id']; ?>" data-groups='["<?php echo $tags; ?>"]' class="uabb-template-block uabb-single-<?php echo $type; ?> <?php echo $template_class; ?>" data-is-downloaded="<?php echo $data['status']; ?>">
								<div class="uabb-template">

								    <div class="uabb-template-screenshot" data-template-name="<?php echo $data['name']; ?>" data-preview-url="<?php echo $data['preview_url']; ?>" data-template-id='<?php echo $data['id']; ?>' data-template-type='<?php echo $type; ?>' data-template-dat-url='<?php echo $data['dat_url']; ?>'>

										<?php if( $type == 'page-templates' ) { ?>
									    	<img data-original="<?php echo $data['image']; ?>" alt="">
									    	<noscript>
											    <img src="<?php echo $data['image']; ?>" alt="">
											</noscript>
											<span class="more-details"> <?php _e('Preview', 'uabb'); ?> </span>
										<?php } else { ?>
											<h2 class="uabb-template-name"> <?php echo $data['name']; ?> </h2>
											<div class="uabb-count"><?php echo $data['count']; ?></div>
										<?php } ?>

								    </div>
								    <div class="uabb-template-info">
									    <h2 class="uabb-template-name"> <?php echo $data['name']; ?> </h2>
									    <div class="uabb-template-actions">

									        <?php if( 'true' == $data['status'] ) { ?>

										        <span class="button button-primary uabb-cloud-process" data-operation="remove">
										        	<i class="dashicons dashicons-no" style="padding: 3px;"></i>
										        	<span class="msg"> <?php _e('Remove', 'uabb'); ?> </span>
										       		<input type="hidden" class="template-dat-meta-id" value='<?php echo $data['id']; ?>' />
										       		<input type="hidden" class="template-dat-meta-type" value='<?php echo $type; ?>' />
										       		<input type="hidden" class="template-dat-meta-dat_url_local" value='<?php echo $data['dat_url_local']; ?>' />
										       	</span>
										       	<span class="button button-sucess uabb-installed-btn">
										        	<i class="dashicons dashicons-yes" style="padding: 3px;"></i>
										        	<span class="msg"> <?php _e('Installed', 'uabb'); ?> </span>
										       	</span>

										    <?php } else { ?>

									        	<?php if( empty( $data['dat_url'] ) ) { ?>

									        		<span class="button button-disabled button-secondary button-disabled">
											        	<i class="dashicons dashicons-no" style="padding: 3px;"></i>
											        	<span class="msg"> <?php _e('Not .dat found', 'uabb'); ?> </span>
											       	</span>

												<?php } else { ?>

											        <span class="button button-primary uabb-cloud-process" data-operation="download">
											        	<i class="dashicons dashicons-update " style="padding: 3px;"></i>
											        	<span class="msg"> <?php _e('Install', 'uabb'); ?> </span>
											       		<input type="hidden" class="template-dat-meta-id" value='<?php echo $data['id']; ?>' />
											       		<input type="hidden" class="template-dat-meta-type" value='<?php echo $type; ?>' />
											       		<input type="hidden" class="template-dat-meta-dat_url" value='<?php echo $data['dat_url']; ?>' />
											       	</span>

												<?php } ?>

										    <?php } ?>

									    </div>
								    </div>
								</div>
							</div>

						<?php } ?>

					</div><!-- #uabb-templates-list -->

				</div><!-- #uabb-templates -->

				<?php

				/**
				 * Debugging
				 */
				if( isset( $_GET['debug'] ) ) {
					if( count( $templates ) < 1 ) {
						?>
						<h2> <?php _e( 'Templates are disabled from RestAPI.', 'uabb' ); ?> </h2>
						<?php
						print_r( $templates );
					}
				}

			} else {

				//	Message for no templates found.
				UABB_Cloud_Templates::message( 'not-found' );
			}

		}

		/**
		 * Create local directory if not exist.
		 *
		 * @since 1.2.0.2
		 */
		static public function create_local_dir( $dir_name = 'bb-ultimate-addon' ) {

			$wp_info  = wp_upload_dir();

			if( function_exists('FLBuilderModel') ) {
				// SSL workaround.
				if ( FLBuilderModel::is_ssl() ) {
					$wp_info['baseurl'] = str_ireplace( 'http://', 'https://', $wp_info['baseurl'] );
				}
			}

			// Build the paths.
			$dir_info = array(
				'path'	 => $wp_info['basedir'] . '/' . $dir_name . '/',
				'url'	 => $wp_info['baseurl'] . '/' . $dir_name . '/'
			);

			// Create the upload dir if it doesn't exist.
			if ( ! file_exists( $dir_info['path'] ) ) {

				// Create the directory.
				mkdir( $dir_info['path'] );

				// Add an index file for security.
				file_put_contents( $dir_info['path'] . 'index.html', '' );
			}

			return $dir_info;
		}

	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
$UABB_Cloud_Templates = UABB_Cloud_Templates::get_instance();
