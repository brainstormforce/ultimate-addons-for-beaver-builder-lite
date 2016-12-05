jQuery( function( $ ) {

	/**
	 * AJAX Request Queue
	 * 
	 * - add()
	 * - remove()
	 * - run()
	 * - stop()
	 *
	 * @since 1.2.0.8
	 */
	var UABBajaxQueue = (function() {

		var requests = [];

		return {

			/**
			 * Add AJAX request
			 * 
			 * @since 1.2.0.8
			 */
			add:  function(opt) {
			    requests.push(opt);
			},

			/**
			 * Remove AJAX request
			 *
			 * @since 1.2.0.8
			 */
			remove:  function(opt) {
			    if( jQuery.inArray(opt, requests) > -1 )
			        requests.splice($.inArray(opt, requests), 1);
			},

			/**
			 * Run / Process AJAX request
			 *
			 * @since 1.2.0.8
			 */
			run: function() {
			    var self = this,
			        oriSuc;

			    if( requests.length ) {
			        oriSuc = requests[0].complete;

			        requests[0].complete = function() {
			             if( typeof(oriSuc) === 'function' ) oriSuc();
			             requests.shift();
			             self.run.apply(self, []);
			        };   

			        jQuery.ajax(requests[0]);

			    } else {

			      self.tid = setTimeout(function() {
			         self.run.apply(self, []);
			      }, 1000);
			    }
			},

			/**
			 * Stop AJAX request
			 *
			 * @since 1.2.0.8
			 */
			stop:  function() {

			    requests = [];
			    clearTimeout(this.tid);
			}
		};

	}());

	jQuery(document).ready(function($) {
		
		/**
		 *	Lazy Load
		 */
		jQuery(".uabb-template-screenshot img").lazyload({
		    effect : "fadeIn",
		    event : "sporty"
		});
		jQuery(window).bind("load", function() {
		    var timeout = setTimeout(function() {
		        jQuery(".uabb-template-screenshot img").trigger("sporty")
		    }, 1000);
		});

		/**
		 *	Shuffle JS
		 */
		var grid = jQuery('.uabb-templates-page-templates');

		grid.shuffle({
			itemSelector: '.uabb-single-page-templates',
		});

		// ReShuffle - When user clicks a filter item
		jQuery('.uabb-templates-filter a').click(function (e) {
			e.preventDefault();

			// set active class
			jQuery('.uabb-templates-filter a').removeClass('active');
			jQuery(this).addClass('active');

			// get group name from clicked item
			var groupName = jQuery(this).attr('data-group');

			// reshuffle grid
			grid.shuffle('shuffle', groupName );

		});

		// ReShuffle - When user clicks a tab
		jQuery('body').on('click', '.fl-settings-nav li a', function (event) {
			var hash = jQuery(this).attr('href') || '';
			if( hash == '#uabb-cloud-templates' ) {
				jQuery( window ).trigger( "resize.shuffle" );
			}
		});

	});

	/**
	 * Templates Preview
	 */
	jQuery('body').on('click', '.uabb-template-screenshot', function (event) {
		window.open( 'https://www.ultimatebeaver.com/pricing/', '_blank' )
	});

	jQuery('body').on('click', '.uabb-template-actions', function (event) {
		window.open( 'https://www.ultimatebeaver.com/pricing/', '_blank' )
	});


	/**
	 *	Template Tabs
	 */
	jQuery("#uabb-cloud-templates-tabs").tabs();

	/**
	 * Templates Count
	 */
	jQuery('body').on('click', '.uabb-filter-links a', function (event) {
		var count = jQuery(this).attr( 'data-count' ) || 0;
		jQuery('.filter-count .count').html( count );

		//	Reshuffle
		// jQuery( window ).trigger( "resize.shuffle" );
	});

	/**
	 * Process of cloud templates - (download, remove & fetch)
	 */
	UABBajaxQueue.run();

	jQuery('body').on('click', '.uabb-cloud-process', function (event) {
		event.preventDefault();

		var btn             	= jQuery(this),
			meta_id             = btn.find('.template-dat-meta-id').val() || '',
			meta_type           = btn.find('.template-dat-meta-type').val() || '',
			btn_template        = btn.parents('.uabb-template-block'),
			btn_template_image  = btn_template.find('.uabb-template-screenshot');
			btn_template_groups = btn_template.attr( 'data-groups' ) || '',
			btn_operation       = btn.attr('data-operation') || '',
			errorMessage        = UABBCloudTemplates.errorMessage,
			successMessage      = UABBCloudTemplates.successMessage,
			processAJAX         = true;

		//	add processing class
		if( meta_id != 'undefined' ) {
			$('#' + meta_id ).addClass('uabb-template-processing');
		}

		//	remove error message if exist
		if( btn_template_image.find('.notice').length ) {
			btn_template_image.find('.notice').remove();
		}

		if( '' != btn_operation ) {

			btn.find('i').addClass('uabb-reloading-iconfonts');

			switch( btn_operation ) {
				case 'fetch':
					jQuery('.wp-filter').find('.uabb-cloud-process i').addClass('uabb-reloading-iconfonts');
					btn.parents('.uabb-cloud-templates-not-found').find('.uabb-cloud-process i').show();
					var dataAJAX	=  	{
											action: 'uabb_cloud_dat_file_fetch',
										};

					break;
			}
			
			if( processAJAX ) {

		       	UABBajaxQueue.add({
					url: UABBCloudTemplates.ajaxurl,
					type: 'POST',
					data: dataAJAX,
					success: function(data){

						/**
						 * Parse response
						 */
						data = JSON.parse( data );
						// console.log('data: ' + JSON.stringify( data ) );

						var status                 = ( data.hasOwnProperty('status') ) ? data['status'] : '';
						var msg                    = ( data.hasOwnProperty('msg') ) ? data['msg'] : '';
						var template_id            = ( data.hasOwnProperty('id') ) ? data['id'] : '';
						var template_type          = ( data.hasOwnProperty('type') ) ? data['type'] : '';
						var template_dat_url       = ( data.hasOwnProperty('dat_url') ) ? decodeURIComponent( data['dat_url'] ) : '';
						var template_dat_url_local = ( data.hasOwnProperty('dat_url_local') ) ? decodeURIComponent( data['dat_url_local'] ) : '';

						if( status == 'success' ) {

							//	remove processing class
							if( meta_id != 'undefined' ) {
								$('#' + meta_id ).removeClass('uabb-template-processing');
							}

							switch( btn_operation ) {

								case 'fetch':
									jQuery( window ).trigger( 'uabb-template-fetched' );

									btn.parents('.wp-filter').find('.uabb-cloud-process').removeClass('button-secondary');
									btn.parents('.wp-filter').find('.uabb-cloud-process').addClass('button-primary');
									btn.parents('.wp-filter').find('.uabb-cloud-process i').removeClass('uabb-reloading-iconfonts dashicons-no dashicons-update');
									btn.parents('.wp-filter').find('.uabb-cloud-process i').addClass('dashicons-yes');

									btn.parents('.wp-filter').find('.uabb-cloud-process .msg').html( UABBCloudTemplates.successMessageFetch );
									location.reload();

									break;
							}

						} else {

							/**
							 * Something went wrong
							 */
							if( '' != msg ) {
	
								btn.find('.msg').html( UABBCloudTemplates.errorMessageTryAgain );
								btn.find('i').removeClass('uabb-reloading-iconfonts');

								var message = '<div class="notice notice-error uct-notice is-dismissible"><p>' + msg + '	</p></div>';
								btn_template_image.append( message );

							} else {
								btn.find('.msg').html( status );
							}
						}
					}
				});
			}
		}
	});
});
