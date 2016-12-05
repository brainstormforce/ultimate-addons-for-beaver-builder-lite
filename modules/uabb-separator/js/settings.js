(function($){

	FLBuilder.registerModuleHelper('uabb-separator', {

		rules: {
			height: {
				number: true
			}
		},

		init: function()
		{
			var form    		= $('.fl-builder-settings'),
				width	= form.find('input[name=width]');
				
			this._toggleSeparatorAlignment();

			width.on('keyup', $.proxy( this._toggleSeparatorAlignment, this ) );
		},

		_toggleSeparatorAlignment: function() {
			var form    			= $('.fl-builder-settings'),
				width		= form.find('input[name=width]').val(),
				alignment	= form.find('#fl-field-alignment');

			if( width != '' && width < 100 ) {
				alignment.show();				
			} else {
				alignment.hide();
			}
		},
	});

})(jQuery);