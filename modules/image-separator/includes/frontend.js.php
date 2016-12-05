(function($) {

	$(document).ready(function() {
	
		new UABBAnimation({
			id: '<?php echo $id ?>',
			animation_delay: '<?php echo ( $settings->img_animation_delay != '' && $settings->img_animation_delay != '0' ) ? $settings->img_animation_delay : ''; ?>',
			animation: '<?php echo ( $settings->img_animation == 'no' ) ? 'no' : 'animated '.$settings->img_animation; ?>',
			viewport_position: '<?php echo ( $settings->img_viewport_position != '' ) ? $settings->img_viewport_position : '90'; ?>'

		});
	});
	
})(jQuery);