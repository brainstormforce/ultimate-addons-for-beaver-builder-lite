jQuery(document).on( 'click' , '.fl-builder-settings-tabs a', function(){
    var node = jQuery(this).closest( 'form' ).attr( 'data-node' );
    var slidebox_wrap = jQuery('.fl-node-' + node + ' .uabb-slide-box-wrap');
    
    if( jQuery(this).attr( 'href' ) == '#fl-builder-settings-tab-slide_down' || jQuery(this).attr( 'href' ) == '#fl-builder-settings-tab-style' || jQuery(this).attr( 'href' ) == '#fl-builder-settings-tab-typography' ) {
        previewSlideDown( slidebox_wrap );
    } else {
        previewSlideUp( slidebox_wrap );
    }
});

jQuery(document).on( 'click' , '.fl-lightbox-footer span', function(){
    var node = jQuery(this).closest( 'form' ).attr( 'data-node' );
    
    if( jQuery(this).hasClass('fl-builder-settings-cancel') ){
        
        var slidebox_wrap = jQuery('.fl-node-'+ node +' .uabb-slide-box-wrap');
        previewSlideUp( slidebox_wrap );
    }
});

jQuery(document).load(function(){
	jQuery(".cs-wp-color-picker").cs_wpColorPicker();
});

/* Call previewSlideDown when on Editor Slide Down tab is active */
jQuery( '.fl-builder-content' ).on( 'fl-builder.layout-rendered', function() {
    
    var active_tab = jQuery('.fl-builder-settings-tabs a.fl-active');

    if(active_tab.attr('href') == '#fl-builder-settings-tab-slide_down' || active_tab.attr('href') == '#fl-builder-settings-tab-style' || active_tab.attr( 'href' ) == '#fl-builder-settings-tab-typography' ) {
        var node = jQuery(active_tab).closest( 'form' ).attr( 'data-node' ),
            slidebox_wrap = jQuery('.fl-node-'+ node +' .uabb-slide-box-wrap');
        
        previewSlideDown( slidebox_wrap );
    }
});

/* Preview Slide Down When user Editing */
function previewSlideDown( slidebox_wrap ) {
    
    var style1 = slidebox_wrap.find( '.uabb-style1' ).first(),
        style2 = slidebox_wrap.find( '.uabb-style2' ).first(),
        style3 = slidebox_wrap.find( '.uabb-style3' ).first();

    var setMinHeight = jQuery('select[name="set_min_height"]');
    if( setMinHeight.find('option:selected').val() == 'custom' ) {
        var min_height = jQuery('input[name="slide_down_min_height"]').val();
    }
    
    min_height = (min_height != "") ? min_height : '40';

    slidebox_wrap.addClass('set-z-index');
    slidebox_wrap.find('.uabb-slide-down').css({'min-height': min_height+'px'});

    if( style1.length > 0 ) {
        style1.addClass('open-slidedown');
        
    } else if( style2.length > 0 ) {
        var dropdown_icon = style2.find('.uabb-slide-dropdown .fa');
        style2.addClass('open-slidedown');
        dropdown_icon.removeClass('fa-angle-down');
        dropdown_icon.addClass('fa-angle-up');
    
    } else if( style3.length > 0 ) {
        var dropdown_icon = style3.find('.uabb-slide-dropdown .fa');
        style3.addClass('open-slidedown');
        dropdown_icon.removeClass('fa-plus');
        dropdown_icon.addClass('fa-minus');
    }
}

/* Preview Slide Up */
function previewSlideUp( slidebox_wrap ) {

    if(slidebox_wrap.hasClass('set-z-index')) {
        var style1 = slidebox_wrap.find( '.uabb-style1' ).first(),
            style2 = slidebox_wrap.find( '.uabb-style2' ).first(),
            style3 = slidebox_wrap.find( '.uabb-style3' ).first();

        slidebox_wrap.find('.uabb-slide-down').css({'min-height': '40px'});
        if( style1.length > 0 ) {
            style1.removeClass('open-slidedown');
            
        } else if( style2.length > 0 ) {
            var dropdown_icon = style2.find('.uabb-slide-dropdown .fa');
            style2.removeClass('open-slidedown');
            dropdown_icon.addClass('fa-angle-down');
            dropdown_icon.removeClass('fa-angle-up');
        
        } else if( style3.length > 0 ) {
            var dropdown_icon = style3.find('.uabb-slide-dropdown .fa');
            style3.removeClass('open-slidedown');
            dropdown_icon.addClass('fa-plus');
            dropdown_icon.removeClass('fa-minus');
        }
        
        window.setTimeout( function() {
            slidebox_wrap.removeClass('set-z-index');
        },200);
    }
}

(function($){

    FLBuilder.registerModuleHelper('slide-box', {
       
       init: function()
        {   
            var form        = jQuery('.fl-builder-settings'),
                image_type   = form.find('select[name=image_type]'),        
                icon_style  = form.find('select[name=icon_style]'),
                image_style = form.find('select[name=image_style]'),
                photoSource     = form.find('select[name=photo_source]'),
                librarySource   = form.find('select[name=photo_src]'),
                front_img_icon_position   = form.find('select[name=front_img_icon_position]'),
                urlSource       = form.find('input[name=photo_url]'),
                mobile_view = form.find('select[name=mobile_view]');
            
            //console.log( this );
            
            this._imageTypeChanged();
            this._toggleImageIcon();
            this._toggleSeparatorOptions();
            this._mobileViewChange();

                // Validation events
            //imageType.on('change', this._imageTypeChanged);
            photoSource.on('change', jQuery.proxy( this._photoSourceChanged, this ) );
            image_type.on('change', jQuery.proxy( this._toggleImageIcon, this ) );
            icon_style.on('change', jQuery.proxy( this._toggleBorderOptions, this ) ) ;
            image_style.on('change', jQuery.proxy( this._toggleBorderOptions, this ) ) ;
            mobile_view.on('change', jQuery.proxy( this._mobileViewChange, this ) ) ;
            front_img_icon_position.on('change', jQuery.proxy( this._toggleSeparatorOptions, this ) ) ;
            //image_type.trigger('change');

        },
        
        _toggleSeparatorOptions: function()
        {
            var form                    = jQuery('.fl-builder-settings'),
                icon_position           = form.find('select[name=front_img_icon_position]').val(),
                icon_border             = form.find('select[name=front_icon_border]').val(),
                border_size             = form.find('#fl-field-front_icon_border_size'),
                border_color            = form.find('#fl-field-front_icon_border_color'),
                border_hover            = form.find('#fl-field-front_icon_border_hover_color');
                
            border_size.css( 'display', 'none' );
            border_color.css( 'display', 'none' );
            border_hover.css( 'display', 'none' );
                
            if( ( icon_position == 'left' || icon_position == 'right' ) && icon_border == 'yes' ) {
                border_size.css( 'display', 'table-row' );
                border_color.css( 'display', 'table-row' );
                border_hover.css( 'display', 'table-row' );
            }

            this._mobileViewChange();
        },
        _imageTypeChanged: function()
        {
            var form        = jQuery('.fl-builder-settings'),
                imageType   = form.find('select[name=image_type]').val(),
                photo       = form.find('input[name=photo]'),
                icon       = form.find('input[name=icon]');
                
            photo.rules('remove');
            icon.rules('remove');
            
            if(imageType == 'photo') {
                photo.rules('add', { required: true });
            }
            else if(imageType == 'icon') {
                icon.rules('add', { required: true });
            }
            this._mobileViewChange();
        },
        _toggleBorderOptions: function() {
            var form        = jQuery('.fl-builder-settings'),
                show_border = false
                image_type  = form.find('select[name=image_type]').val(),
                icon_style  = form.find('select[name=icon_style]').val(),
                border_style    = form.find('select[name=icon_border_style]').val(),
                image_style     = form.find('select[name=image_style]').val(),
                img_border_style    = form.find('select[name=img_border_style]').val();

            
            if( image_type == 'icon' ){
                if( icon_style == 'custom'  ){
                    show_border = true;
                }

                if( show_border == false ){
                    form.find('#fl-field-icon_border_width').hide();
                    form.find('#fl-field-icon_border_color').hide();
                    form.find('#fl-field-icon_border_hover_color').hide();
                }else if( show_border ){
                    if ( border_style != 'none' ) {
                        form.find('#fl-field-icon_border_width').show();
                        form.find('#fl-field-icon_border_color').show();
                        form.find('#fl-field-icon_border_hover_color').show();
                    }
                }
            }else if( image_type == 'photo' ){
                if( image_style == 'custom' ){
                    show_border = true;
                }

                if( show_border == false ){
                    form.find('#fl-field-img_border_width').hide();
                    form.find('#fl-field-img_border_color').hide();
                    form.find('#fl-field-img_border_hover_color').hide();
                }else if( show_border ){
                    if ( img_border_style != 'none' ) {
                        form.find('#fl-field-img_border_width').show();
                        form.find('#fl-field-img_border_color').show();
                        form.find('#fl-field-img_border_hover_color').show();
                    }
                }
            }
        },
        _toggleImageIcon: function() {
            var form        = jQuery('.fl-builder-settings'),
                show_color  = false,
                image_type  = form.find('select[name=image_type]').val(),
                image_style = form.find('select[name=image_style]').val();
            
            // console.log( this );
            //console.log( image_style );
            if( image_type == 'photo' && image_style == 'custom' ){
                show_color = true;
            }

            if( show_color == false ){
                form.find('#fl-builder-settings-section-img_colors').hide();
            }else if( show_color ){
                form.find('#fl-builder-settings-section-img_colors').show();
            }
            this._toggleBorderOptions();
            this._photoSourceChanged();
        },
        _photoSourceChanged: function()
        {
            var form            = jQuery('.fl-builder-settings'),
                image_type      = form.find('select[name=image_type]').val(),
                photo           = form.find('input[name=photo]'),
                iconSize        = form.find('input[name=icon_size]');


            photo.rules('remove');

            if ( image_type == 'photo' ) {
                photo.rules('add', { required: true });
            }
        },
        _mobileViewChange: function() {
            var form        = $('.fl-builder-settings'),
                image_type  = form.find('select[name=image_type]').val(),
                position    = form.find('select[name=front_img_icon_position]').val(),
                mobile_view = form.find('select[name=mobile_view]').val(),
                stacking_order = form.find('#fl-field-stacking_order');

            if( image_type != 'none' &&  position == 'right' && mobile_view == 'stack' ) {
                stacking_order.show();
            } else {
                stacking_order.hide();
            }
        },

    });

    FLBuilder.registerModuleHelper('button_form_field', {

     
        init: function()
        {
            var form        = $('.fl-form-field-settings'),
                btn_style   = form.find('select[name=style]'),
                transparent_button_options = form.find('select[name=transparent_button_options]'),
                hover_attribute = form.find('select[name=hover_attribute]'),
                btn_style_opt   = form.find('select[name=flat_button_options]');

            // Init validation events.
            this.imgicon_postion();
            this._btn_styleChanged();
            
            // Validation events.
            /*btn_style.on('change',  $.proxy( this.imgicon_postion, this ) );
            btn_style_opt.on('change',  $.proxy( this.imgicon_postion, this ) );*/
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
            } else if( btn_style == 'flat' ) {
                form.find('#fl-field-flat_button_options').show();
                form.find("#fl-field-hover_attribute").hide();
                form.find('#fl-field-bg_color th label').text('Background Color');
                form.find('#fl-field-bg_hover_color th label').text('Background Hover Color');
                form.find("#fl-field-border_size").hide();
                form.find('#fl-field-threed_button_options').hide();
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
            var form        = $('.fl-form-field-settings'),
                creative_button_styles     = form.find('select[name=style]').val(),
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