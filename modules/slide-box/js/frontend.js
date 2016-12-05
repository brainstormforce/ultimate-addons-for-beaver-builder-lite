jQuery(document).on( 'click', function(e){
	//e.stopImmediatePropagation();
    var target = e.target,
        slidebox = jQuery(e.target).closest('.fl-module-slide-box');

    if( ( ! jQuery(e.target).closest('.fl-builder-settings-lightbox' ).length && jQuery('.fl-builder-settings-lightbox:hidden').length ) || ! jQuery('html').hasClass('fl-builder-edit') ) {
        _hideAll_SlideBox( slidebox );
    }
});

function _hideAll_SlideBox( slidebox ) {
    jQuery(document).find('.fl-module-slide-box').each(function(i,e) {

            var thisNode = jQuery(this).data('node'),
                slideboxNode = jQuery(slidebox).data('node');

                if( thisNode != slideboxNode ) { 
                    var style1 = jQuery(this).find('.uabb-style1'),
                        slidebox_wrap = style1.closest('.uabb-slide-box-wrap');

                        style1.removeClass('open-slidedown');
                        slidebox_wrap.removeClass('set-z-index');
                        
                    var style2 = jQuery(this).find('.uabb-style2'),
                        dropdown_icon = style2.find('.uabb-slide-dropdown .fa'),
                        slidebox_wrap = style2.closest('.uabb-slide-box-wrap');

                    if( style2.hasClass('open-slidedown') ) {
                        style2.removeClass('open-slidedown');
                        slidebox_wrap.removeClass('set-z-index');
                        dropdown_icon.removeClass('fa-angle-up');
                        dropdown_icon.addClass('fa-angle-down');
                    }

                    var style3 = jQuery(this).find('.uabb-style3'),
                        dropdown_icon = style3.find('.uabb-slide-dropdown .fa'),
                        slidebox_wrap = style3.closest('.uabb-slide-box-wrap');

                    if( style3.hasClass('open-slidedown') ) {
                        style3.removeClass('open-slidedown');
                        slidebox_wrap.removeClass('set-z-index');
                        dropdown_icon.removeClass('fa-minus');
                        dropdown_icon.addClass('fa-plus');
                    }
                }
        });
}

jQuery(document).ready(function(){

    /* Accordion Click Trigger */
    UABBTrigger.addHook( 'uabb-accordion-click', function( argument, selector ) {
        var slide_box_wrap = jQuery( selector ).find('.fl-module-slide-box');
       _setHeight(slide_box_wrap);
    });

    /* Tab Click Trigger */
    UABBTrigger.addHook( 'uabb-tab-click', function( argument, selector ) {
        var slide_box_wrap = jQuery( selector ).find('.fl-module-slide-box');
       _setHeight(slide_box_wrap);
    });

    function _setHeight( selector ) {
            
        if( selector != '' ) {
            var  front_slide = jQuery(selector).find('.uabb-slide-front:first').outerHeight(),
                back_slide = jQuery(selector).find('.uabb-slide-down:first').outerHeight(),
                total = parseInt(front_slide) /*+ parseInt(back_slide)*/;
            
            jQuery(selector).find('> .fl-module-content').css('height', total+'px');

        } else {
            jQuery(document).find('.fl-module-slide-box').each(function(i,e) {
                // Add Initial Height for Tabs & Accordion
                if( jQuery(this).closest('.uabb-tab-acc-content').length > 0 || jQuery(this).closest('.uabb-adv-accordion-content').length > 0 ) {
                    
                    var front_slide = jQuery(this).find('.uabb-slide-front:first').outerHeight(),
                        back_slide = jQuery(this).find('.uabb-slide-down:first').outerHeight(),
                        total = parseInt(front_slide) /*+ parseInt(back_slide)*/;
                    
                    jQuery(this).find('> .fl-module-content').css('height', total+'px');
                }
            });
        }
    }

    _setHeight( '' );   
});
