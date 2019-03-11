<?php
/**
 * This file should contain frontend JavaScript that
 * will be applied to individual module instances.
 *
 * You have access to three variables in this file:
 *
 * $module An instance of your module class.
 * $id The module's ID.
 * $settings The module's settings.
 *
 * @package Slide Box
 */

?>
if(! /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
	var is_touch_device = false;
else
	var is_touch_device = true;

<?php if ( 'style1' == $settings->slide_type ) { ?>
var isMobile = { 
	Android: function() { 
		return navigator.userAgent.match(/Android/i);
	},
	BlackBerry: function() { 
		return navigator.userAgent.match(/BlackBerry/i);
	},
	iOS: function() { 
		return navigator.userAgent.match(/iPhone|iPad|iPod/i);
	},
	Opera: function() { 
		return navigator.userAgent.match(/Opera Mini/i);
	},
	Windows: function() { 
		return navigator.userAgent.match(/IEMobile/i);
	},
	any: function() { 
		return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows()); 
	}
};
var device = isMobile.any();
if( device == null ) {
	jQuery('.fl-node-<?php echo $id; ?>').find('.uabb-slide-box-wrap').hover( function() {
		_hideAll_SlideBox('');

		var style1 = jQuery(this).find('.uabb-style1');

		if( ! jQuery(this).hasClass('set-z-index') ) {
			jQuery(this).addClass('set-z-index');
		}
		if( ! style1.hasClass('open-slidedown') ) {
			style1.addClass('open-slidedown');
		}
	},
	function() {

		var style1 = jQuery(this).find('.uabb-style1');

		$this = jQuery(this);
		setTimeout(function(){
			$this.removeClass('set-z-index');
		}, 250);
		style1.removeClass('open-slidedown');
	});	
} 
else if( device != null ) {
	jQuery('.fl-node-<?php echo $id; ?>').find('.uabb-slide-box-wrap').click( function() {

		var style1 = jQuery(this).find('.uabb-style1');
		$this = jQuery(this);

		if( ! jQuery(this).hasClass('set-z-index') ) {
			jQuery(this).addClass('set-z-index');
			style1.addClass('open-slidedown');

		} else {
			$this.removeClass('set-z-index');
			style1.removeClass('open-slidedown');
		}
	});
}



<?php } else { ?>
jQuery('.fl-node-<?php echo $id; ?>').on( 'click' , '.uabb-slide-face', function(){
	var self = jQuery(this),
		slide_type = self.closest('.uabb-slide-type').data('style'),
		style2 = self.closest('.uabb-style2'),
		style3 = self.closest('.uabb-style3');
	if( slide_type == 'style2' ) {
		var dropdown_icon = style2.find('.uabb-slide-dropdown .fa'),
			slidebox_wrap = style2.closest('.uabb-slide-box-wrap');

		if( style2.hasClass('open-slidedown') ){

			style2.removeClass('open-slidedown');
			setTimeout(function(){
				style2.closest('.uabb-slide-box-wrap').removeClass('set-z-index');
			},250);
			dropdown_icon.removeClass('fa-angle-up');
			dropdown_icon.addClass('fa-angle-down');
		} else {
			style2.addClass('open-slidedown');
			slidebox_wrap.addClass('set-z-index');
			dropdown_icon.removeClass('fa-angle-down');
			dropdown_icon.addClass('fa-angle-up');
		}
	}

	if( 'style3' == slide_type ) {
		var dropdown_icon = style3.find('.uabb-slide-dropdown .fa'),
			slidebox_wrap = style3.closest('.uabb-slide-box-wrap');

		if( style3.hasClass('open-slidedown') ){

			style3.removeClass('open-slidedown');
			setTimeout(function(){
				style3.closest('.uabb-slide-box-wrap').removeClass('set-z-index');
			}, 250);
			dropdown_icon.removeClass('fa-minus');
			dropdown_icon.addClass('fa-plus');
		} else {
			style3.addClass('open-slidedown');
			slidebox_wrap.addClass('set-z-index');
			dropdown_icon.removeClass('fa-plus');
			dropdown_icon.addClass('fa-minus');
		}
	}
});
<?php } ?>
