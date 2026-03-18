(function($){

    FLBuilder.registerModuleHelper('flip-box', {

        init: function()
        {
            var a = $('.fl-builder-flip-box-settings').find('.fl-builder-settings-tabs a');

            a.on('click', this._toggleBackTab);
            
            $( '.fl-builder-content' ).on( 'fl-builder.layout-rendered', this._toggleAfterRender );
        },


        _toggleBackTab: function() {
            var anchorHref = $(this).attr('href');
            var node = jQuery(this).closest( 'form' ).attr( 'data-node' );
            if( anchorHref == '#fl-builder-settings-tab-flip_back' ){
                jQuery('.fl-node-' + node + ' .uabb-flip-box').addClass('uabb-hover');
            } else {
                jQuery('.fl-node-' + node + ' .uabb-flip-box').removeClass('uabb-hover');
            }
        },

        _toggleAfterRender: function() {
            
            var anchorHref = jQuery( '.fl-builder-settings-tabs' ).children('.fl-active').attr( 'href' );
            var node = jQuery( '.fl-builder-settings-tabs a' ).closest( 'form' ).attr( 'data-node' );
            if( anchorHref == '#fl-builder-settings-tab-flip_back' ){
                jQuery('.fl-node-' + node + ' .uabb-flip-box').addClass('uabb-hover');
            } else {
                jQuery('.fl-node-' + node + ' .uabb-flip-box').removeClass('uabb-hover');
            }
        },
    });
    
    FLBuilder.registerModuleHelper('button_form_field', {

        init: function()
        {
            var form          = $('.fl-form-field-settings'),
                flat_button_options      = form.find('select[name=flat_button_options]'),
                transparent_button_options = form.find('select[name=transparent_button_options]'),
                hover_attribute = form.find('select[name=hover_attribute]'),
                creative_button_styles     = form.find('select[name=style]');
            
            
            this.imgicon_postion();
            this._btn_styleChanged();

            creative_button_styles.on('change',  $.proxy( this._btn_styleChanged, this ) );
            flat_button_options.on('change',  $.proxy( this._btn_styleChanged, this ) );

            /*creative_button_styles.on('change', $.proxy( this.imgicon_postion, this ) );
            flat_button_options.on('change', $.proxy( this.imgicon_postion, this ) );*/
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
            } else if( btn_style == 'flat' ) {
                form.find('#fl-field-flat_button_options').show();
                form.find("#fl-field-hover_attribute").hide();
                form.find('#fl-field-bg_color th label').text('Background Color');
                form.find('#fl-field-bg_hover_color th label').text('Background Hover Color');
                form.find('#fl-field-threed_button_options').hide();
                form.find("#fl-field-border_size").hide();
                form.find("#fl-field-transparent_button_options").hide();
            } else if( btn_style == 'transparent' ) {
                form.find("#fl-field-border_size").show();
                form.find("#fl-field-transparent_button_options").show();
                form.find('#fl-field-threed_button_options').hide();
                form.find('#fl-field-flat_button_options').hide();
                form.find('#fl-field-bg_color th label').text('Border Color');
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
            } else {
                form.find("#fl-field-hover_attribute").hide();
                form.find('#fl-field-bg_color th label').text('Background Color');
                form.find('#fl-field-bg_hover_color th label').text('Background Hover Color');
                form.find("#fl-field-border_size").hide();
                form.find("#fl-field-transparent_button_options").hide();
                form.find('#fl-field-threed_button_options').hide();
                form.find('#fl-field-flat_button_options').hide();
            }

            this.imgicon_postion();
        },

        imgicon_postion: function () {
            var form        = $('.fl-builder-settings'),
                creative_button_styles     = form.find('select[name=style]').val();
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