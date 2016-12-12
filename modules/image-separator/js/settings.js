(function($){
	FLBuilder.registerModuleHelper('image-separator', {
		rules: {
			photo: {
				required: true
			}
		},

		init: function()
		{	
			var form    	= $('.fl-builder-settings'),
				image_style	= form.find('select[name=image_style]');
			
			this._toggleBorderOptions();

			image_style.on('change', $.proxy( this._toggleBorderOptions, this ) ) ;
		},
		
		_toggleBorderOptions: function() {
			var form		= $('.fl-builder-settings'),
				image_style 	= form.find('select[name=image_style]').val(),
				img_border_style 	= form.find('select[name=img_border_style]').val();

			if( image_style == 'custom' ){
				if( img_border_style == 'none' ){
					form.find('#fl-field-img_border_width').hide();
					form.find('#fl-field-img_border_color').hide();
					form.find('#fl-field-img_border_hover_color').hide();
				}else {
					form.find('#fl-field-img_border_width').show();
					form.find('#fl-field-img_border_color').show();
					form.find('#fl-field-img_border_hover_color').show();
				}
			}else {
				form.find('#fl-field-img_border_width').hide();
				form.find('#fl-field-img_border_color').hide();
				form.find('#fl-field-img_border_hover_color').hide();
			}

			this._toggleImageIcon();
		},
		
		_toggleImageIcon: function() {
			var form        = $('.fl-builder-settings'),
				image_style = form.find('select[name=image_style]').val();
			
			if( image_style == 'custom' ) {
				form.find('#fl-builder-settings-section-img_colors').show();
			}else {
				form.find('#fl-builder-settings-section-img_colors').hide();
			}
		}
	});
})(jQuery);