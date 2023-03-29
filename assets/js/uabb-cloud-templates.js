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

		var template_preview_url = jQuery(this).attr( 'data-preview-url' ) || '',
			template_name        = jQuery(this).attr( 'data-template-name' ) || '',
			is_downlaoded        = jQuery(this).parents( '.uabb-template-block' ).attr('data-is-downloaded') || '',
			template_id          = jQuery(this).attr( 'data-template-id' ),
			template_type        = jQuery(this).attr( 'data-template-type' );

		if( '' != template_preview_url ) {

			/**
			 * Thickbox options
			 */
			template_preview_url = template_preview_url + '?TB_iframe=true'; // Required

			/**
			 * Open ThickBox
			 */
			tb_show( template_name , template_preview_url );

			jQuery('#TB_window').addClass('UABB_TB_window');
			jQuery("#TB_window").append("<div class='UABB_TB_loader spinner is-active'></div>");
			jQuery('#TB_iframeContent').addClass('UABB_TB_iframeContent');

			/**
			 * Add Download Button
			 */
			console.log(is_downlaoded != 'true');

			var output   = '<span class="button button-primary button-small uabb-cloud-process" data-operation="upgrade">'
						 + '<i class="dashicons dashicons-update"></i>'
						 + '<span class="msg"> Upgrade </span>'
						 + '</span>';

			jQuery('#TB_title').append( output );
	
			//	hide iframe until complete load and show loader
			//	once complete iframe loaded then disable loader
			jQuery('#TB_iframeContent').hide();
			jQuery('#TB_iframeContent').bind('load', function(){
		        jQuery("#TB_window").find(".spinner").remove();
		        jQuery('#TB_iframeContent').show();
		    });
		}
	});

	jQuery('body').on('click', '.uabb-template-actions', function (event) {
		window.open( 'https://www.ultimatebeaver.com/pricing/?utm_source=uabb-dashboard&utm_campaign=uabblite_upgrade&utm_medium=upgrade-button', '_blank' );
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
			form_nonce          = UABBCloudTemplates.uabb_cloud_nonce;

		//	add processing class
		if( meta_id != 'undefined' ) {
			$('#' + meta_id ).addClass('uabb-template-processing');
		}

		//	remove error message if exist
		if( btn_template_image.find('.notice').length ) {
			btn_template_image.find('.notice').remove();
		}

		if( '' != btn_operation ) {

			switch( btn_operation ) {
				case 'fetch':
					btn.find('i').addClass('uabb-reloading-iconfonts');
					jQuery('.wp-filter').find('.uabb-cloud-process i').addClass('uabb-reloading-iconfonts');
					btn.parents('.uabb-cloud-templates-not-found').find('.uabb-cloud-process i').show();
					var dataAJAX	=  	{
											action: 'uabb_cloud_dat_file_fetch',
											form_nonce:form_nonce,
										};

					break;
				case 'upgrade' :
					window.open( 'https://www.ultimatebeaver.com/pricing/?utm_source=uabb-dashboard&utm_campaign=uabblite_upgrade&utm_medium=upgrade-button', '_blank' );
					return true;
					break;
			}
			
			if( processAJAX ) {

		       	UABBajaxQueue.add({
					url: UABBCloudTemplates.ajaxurl,
					type: 'POST',
					data: dataAJAX,
					success: function(data){

						if( data.success ) {

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
							btn.find('.msg').html( UABBCloudTemplates.errorMessageTryAgain );
							btn.find('i').removeClass('uabb-reloading-iconfonts');

							var message = '<div class="notice notice-error uct-notice is-dismissible"><p>' + data.message + '	</p></div>';
							btn_template_image.append( message );
						}
					}
				});
			}
		}
	});
});
