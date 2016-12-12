(function($){

	FLBuilder.registerModuleHelper('info-list', {

		rules: {
			title: {
				required: true
			}
		},
		
		init: function()
		{
			var form    	= $('.fl-builder-settings'),
				image_style 	= form.find('select[name=list_icon_style]'),
				list_icon_border_style = form.find('select[name=list_icon_border_style]');

			this.image_style_changed();
			
			image_style.on('change', this.image_style_changed );
			list_icon_border_style.on('change', this.image_style_changed );
		},
		
		image_style_changed: function() {
			var form		= $('.fl-builder-settings'),
				image_style 	= form.find('select[name=list_icon_style]').val(),
				list_icon_border_style = form.find('select[name=list_icon_border_style]').val();


			if ( image_style == "custom" && list_icon_border_style != "none" ) {
				$("#fl-field-list_icon_border_color").css({"display":"table-row"});
				$("#fl-field-list_icon_border_width").css({"display":"table-row"});
			}else{
				$("#fl-field-list_icon_border_color").css({"display":"none"});
				$("#fl-field-list_icon_border_width").css({"display":"none"});
			}
		}
	});

})(jQuery);