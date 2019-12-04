(function($){
	FLBuilder.registerModuleHelper('uabb-button', {

		rules: {
			text: {
				required: true
			},
			link: {
				required: true
			},
			border_size: {
				number: true
			}
		},

		init: function()
		{
			var form        = $('.fl-builder-settings'),
				btn_style   = form.find('select[name=style]'),
				transparent_button_options = form.find('select[name=transparent_button_options]'),
				hover_attribute = form.find('select[name=hover_attribute]'),
				btn_style_opt   = form.find('select[name=flat_button_options]');

			
			// Init validation events.
			this._btn_styleChanged();
			this.imgicon_postion();
			
			// Validation events.
			btn_style.on('change',  $.proxy( this._btn_styleChanged, this ) );
			btn_style_opt.on('change',  $.proxy( this._btn_styleChanged, this ) );
			transparent_button_options.on( 'change', $.proxy( this._btn_styleChanged, this ) );
			hover_attribute.on( 'change', $.proxy( this._btn_styleChanged, this ) );
		},

		_btn_styleChanged: function()
		{
			var form        = $('.fl-builder-settings'),
				btn_style   = form.find('select[name=style]').val(),
				btn_style_opt   = form.find('select[name=flat_button_options]').val(),
				hover_attribute = form.find('select[name=hover_attribute]').val(),
				transparent_button_options = form.find('select[name=transparent_button_options]').val(),
				icon       = form.find('input[name=icon]');
				
			icon.rules('remove');
			
			if(btn_style == 'flat' && btn_style_opt != 'none' ) {
				icon.rules('add', { required: true });
			}

            if( btn_style == 'threed' ) {
            	form.find('#fl-field-threed_button_options').show();
            	form.find("#fl-field-hover_attribute").hide();
            	form.find('#fl-field-bg_color th label').text('Background Color');
            	form.find('#fl-field-bg_hover_color th label').text('Background Hover Color');
            	form.find("#fl-field-border_size").hide();
            	form.find("#fl-field-transparent_button_options").hide();
            	form.find('#fl-field-flat_button_options').hide();
            	form.find( "#fl-field-width" ).show();
            } else if( btn_style == 'flat' ) {
            	form.find('#fl-field-flat_button_options').show();
            	form.find("#fl-field-hover_attribute").hide();
            	form.find('#fl-field-bg_color th label').text('Background Color');
            	form.find('#fl-field-bg_hover_color th label').text('Background Hover Color');
            	form.find('#fl-field-threed_button_options').hide();
            	form.find("#fl-field-border_size").hide();
            	form.find("#fl-field-transparent_button_options").hide();
            	form.find( "#fl-field-width" ).show();
            } else if( btn_style == 'transparent' ) {
            	form.find("#fl-field-border_size").show();
            	form.find("#fl-field-transparent_button_options").show();
            	form.find('#fl-field-threed_button_options').hide();
            	form.find('#fl-field-flat_button_options').hide();
            	form.find('#fl-field-bg_color th label').text('Border Color');
            	form.find( "#fl-field-width" ).show();
            	if( transparent_button_options == 'none' ) {
            		form.find("#fl-field-hover_attribute").show();
            		if( hover_attribute == 'bg' ) {
	            		form.find('#fl-field-bg_hover_color th label').text('Background Hover Color');
	                } else {
	            		form.find('#fl-field-bg_hover_color th label').text('Border Hover Color');
	                }
            	} else {
            		form.find("#fl-field-hover_attribute").hide();
            		form.find('#fl-field-bg_hover_color th label').text('Background Hover Color');
            	}
            } else if ( 'default' == btn_style ) {
            	form.find( "#fl-field-width" ).hide();
            	form.find( "#fl-field-border_radius" ).hide();
            	form.find( "#fl-field-border_size" ).hide();
            	form.find( "#fl-field-transparent_button_options" ).hide();
            	form.find( "#fl-field-threed_button_options" ).hide();
            	form.find( "#fl-field-button_gradient" ).hide();
            	form.find( "#fl-field-button_gradient" ).hide();
            	form.find( "#fl-field-hover_attribute" ).hide();
            	form.find('#fl-field-flat_button_options').hide();
            } else {
            	form.find("#fl-field-hover_attribute").hide();
            	form.find('#fl-field-bg_color th label').text('Background Color');
            	form.find('#fl-field-bg_hover_color th label').text('Background Hover Color');
            	form.find("#fl-field-border_size").hide();
            	form.find("#fl-field-transparent_button_options").hide();
            	form.find('#fl-field-threed_button_options').hide();
            	form.find('#fl-field-flat_button_options').hide();
            	form.find( "#fl-field-width" ).show();
            }

			this.imgicon_postion();
		},
		imgicon_postion: function () {
            var form        = $('.fl-builder-settings'),
                creative_button_styles     = form.find('select[name=style]').val(),
                transparent_button_options = form.find().val('select[name=transparent_button_options]'),
                flat_button_options     = form.find('select[name=flat_button_options]').val();

                if ( creative_button_styles == 'flat' && flat_button_options != 'none' ) {
                    setTimeout(function(){
                        jQuery("#fl-field-icon_position").hide();
                    },100);
                }else{
                    jQuery("#fl-field-icon_position").show();
                }
        },


	});

})(jQuery);