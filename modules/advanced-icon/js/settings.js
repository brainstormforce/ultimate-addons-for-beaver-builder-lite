(function($){
	FLBuilder.registerModuleHelper('advanced-icon', {

		init: function()
		{	
			var form    	= $('.fl-builder-settings'),
				icoimage_style	= form.find('select[name=icoimage_style]');

			this._toggleBorderOptions();


				// Validation events.
			icoimage_style.on('change', $.proxy( this._toggleBorderOptions, this ) ) ;
			
		},
		
		_toggleBorderOptions: function() {
			var form		= $('.fl-builder-settings'),
				icoimage_style 	= form.find('select[name=icoimage_style]').val(),
				border_style 	= form.find('select[name=border_style]').val();
				
			if( icoimage_style == 'custom' ){
				if ( border_style != 'none' ) {
					form.find('#fl-field-border_width').show();
					form.find('#fl-field-border_color').show();
					form.find('#fl-field-border_hover_color').show();
				}
			}else {
				form.find('#fl-field-border_width').hide();
				form.find('#fl-field-border_color').hide();
				form.find('#fl-field-border_hover_color').hide();
			}
		},
	});
	
	FLBuilder.registerModuleHelper('uabb_advicon_group_form', {

		init: function() {	

			var form    		= $('.fl-builder-settings'),
				image_type		= form.find('select[name=image_type]');

			this._changeImageType();

			image_type.on( 'change', this._changeImageType );
		},

		_changeImageType : function() {

			var form    		= $('.fl-builder-settings'),
				image_type		= form.find('select[name=image_type]').val(),
				icon			= form.find('input[name=icon]'),
				photo			= form.find('input[name=photo]');

			icon.rules('remove');
			photo.rules('remove');

			if ( image_type == 'photo' ) {
				photo.rules('add', { required: true });
				
			} else if ( image_type == 'icon' ) {
				icon.rules('add', { required: true });
			}
		}
	});

})(jQuery);