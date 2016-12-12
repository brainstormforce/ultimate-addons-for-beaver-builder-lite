UABB_Admin = {

	init: function()
	{
		UABB_Admin._toggleGlobal();

		jQuery('.uabb-global-enable').on('click', 	UABB_Admin._toggleGlobal );
		jQuery('.uabb-module-all-cb').on('click', UABB_Admin._moduleAllCheckboxClicked);
		jQuery('.uabb-module-cb').on('click', UABB_Admin._moduleCheckboxClicked);
	},

	_toggleGlobal: function() {
		var checked = jQuery('.uabb-global-enable').is(':checked');
		if( checked ) {
			jQuery('.uabb-admin-fields').show();
		} else {
			jQuery('.uabb-admin-fields').hide();
		}		
	},

	_moduleAllCheckboxClicked: function() {
		if( jQuery(this).is(':checked') ) {
			jQuery('.uabb-module-cb').prop('checked', true);
		}else{
			jQuery('.uabb-module-cb').prop('checked', false);
		}
	},

	_moduleCheckboxClicked: function() {
		var allChecked = true;
				
		jQuery('.uabb-module-cb').each(function() {
			
			if( !jQuery(this).is(':checked') ) {
				allChecked = false;
			}
		});
		
		if( allChecked ) {
			jQuery('.uabb-module-all-cb').prop('checked', true);
		} else {
			jQuery('.uabb-module-all-cb').prop('checked', false);
		}
	},
}

jQuery(document).ready(function( $ ) {

	UABB_Admin.init();

	/**
	 * 	Reload UABB IconFonts
	 */
	jQuery('.uabb-reload-icons').on('click', function() {

		jQuery(this).find('i').addClass('uabb-reloading-iconfonts');

		var data = {
			'action': 'uabb_reload_icons'
		};

		//	Reloading IconFonts
		jQuery.post( uabb.ajax_url, data, function(response) {
			if( response == 'success' ) {
				console.log('Reloading: ');
				location.reload(true);
			}
		});

	});

	/**
	 * 	Colorpicker Initiate
	 */

	var colorpicker = $('.uabb-wp-colopicker');

	if( colorpicker.length )
	{
		colorpicker.each(function(index) {
	    	$(this).wpColorPicker();
		});
	}

	/**
	 * Checked all the templates
	 */
	var checked_all_the_templates = function( template ) {
		jQuery('#uabb-template-manager-form .all-uabb-' + template + '-templates').on('click', function() {
			if( jQuery( this ).prop('checked') ) {
		 		jQuery( this ).closest('.fl-settings-form-content').find('input:checkbox[class^="' + template + 's-"]').prop('checked', true);
		 	}
		});
	}
	checked_all_the_templates( 'section' );
	checked_all_the_templates( 'preset' );
	checked_all_the_templates( 'page' );

	/**
	 * Update template status
	 */
	var update_template_status = function( template_name ) {
		var template         = '#uabb-template-manager-form input:checkbox[class^="' + template_name + 's-"]';
		var template_checked = '#uabb-template-manager-form input:checkbox[class^="' + template_name + 's-"]:checked';
		if( ( jQuery( template ).length === jQuery( template_checked ).length ) ) {
	 		jQuery( '.all-uabb-' + template_name + '-templates').prop('checked', true );
		} else {
			jQuery( '.all-uabb-' + template_name + '-templates').prop('checked', false );
		}
	}
	update_template_status('section');
	update_template_status('preset');
	update_template_status('page');

	/**
	 * On Change update template status
	 */
	var onchange_template_status = function( template_name ) {
		var template = '#uabb-template-manager-form input:checkbox[class^="' + template_name + 's-"]';
		jQuery( template ).on('change', function() {
			update_template_status( template_name );
		});
	}
	onchange_template_status('section');
	onchange_template_status('preset');
	onchange_template_status('page');

});
